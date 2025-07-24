<?php
// phpcs:ignoreFile
/**
 * ForgePress Theme Functions
 *
 * @package ForgePress
 * @author  Abu Saeed M Sayem AKA Kaspar Moon
 * @license GPL-2.0+
 * @link    https://github.com/kaspar-moon/forgepress
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// =============================================================================
// 1. INCLUDE ADDITIONAL FILES
// =============================================================================
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/icons.php';

if ( class_exists( 'WooCommerce' ) ) {
	require_once get_template_directory() . '/inc/woocommerce.php';
}


// =============================================================================
// 2. CONSTANTS
// =============================================================================
define( 'FORGEPRESS_DEV_SERVER', 'http://localhost:5173' );
define( 'FORGEPRESS_PROD_URL', get_template_directory_uri() . '/dist' );
define( 'FORGEPRESS_PROD_PATH', get_template_directory() . '/dist' );


// =============================================================================
// 3. THEME SETUP HOOKS
// =============================================================================
function forgepress_setup() {
	add_theme_support( 'widgets-block-editor' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'woocommerce' );
	register_nav_menus(
		array(
			'primary'   => esc_html__( 'Primary Menu', 'forgepress' ),
			'secondary' => esc_html__( 'Secondary Menu (Header Top)', 'forgepress' ),
			'footer'    => esc_html__( 'Footer Menu', 'forgepress' ),
		)
	);
}
add_action( 'after_setup_theme', 'forgepress_setup' );

function forgepress_widgets_init() {
	register_sidebar( array( 'name' => esc_html__( 'Primary Sidebar', 'forgepress' ), 'id' => 'sidebar-1', 'description' => esc_html__( 'Add widgets here.', 'forgepress' ), 'before_widget' => '<section id="%1$s" class="widget %2$s">', 'after_widget' => '</section>', 'before_title' => '<h2 class="widget-title">', 'after_title' => '</h2>' ) );
	register_sidebar( array( 'name' => esc_html__( 'Secondary Sidebar', 'forgepress' ), 'id' => 'sidebar-2', 'description' => esc_html__( 'Add widgets here for three-column layouts.', 'forgepress' ), 'before_widget' => '<section id="%1$s" class="widget %2$s">', 'after_widget' => '</section>', 'before_title' => '<h2 class="widget-title">', 'after_title' => '</h2>' ) );
}
add_action( 'widgets_init', 'forgepress_widgets_init' );


// =============================================================================
// 4. SCRIPTS & STYLES HOOKS
// =============================================================================
function forgepress_enqueue_scripts_and_styles() {
	if ( is_admin() ) { return; }
	wp_enqueue_style( 'forgepress-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap', array(), null );
	if ( forgepress_is_vite_dev() ) {
		wp_enqueue_script( 'vite-client', FORGEPRESS_DEV_SERVER . '/@vite/client', array(), null, true );
		wp_enqueue_script( 'forgepress-main-js', FORGEPRESS_DEV_SERVER . '/src/main.jsx', array( 'vite-client' ), '1.0.0', true );
	} else {
		$manifest_path = FORGEPRESS_PROD_PATH . '/.vite/manifest.json';
		if ( file_exists( $manifest_path ) ) {
			$manifest = json_decode( file_get_contents( $manifest_path ), true );
			if ( ! empty( $manifest['src/main.jsx']['file'] ) ) {
				wp_enqueue_script( 'forgepress-main-js', FORGEPRESS_PROD_URL . '/' . $manifest['src/main.jsx']['file'], array(), false, true );
			}
			if ( ! empty( $manifest['src/main.jsx']['css'] ) ) {
				foreach ( $manifest['src/main.jsx']['css'] as $css_file ) {
					wp_enqueue_style( 'forgepress-main-css', FORGEPRESS_PROD_URL . '/' . $css_file );
				}
			}
		}
	}
}
add_action( 'wp_enqueue_scripts', 'forgepress_enqueue_scripts_and_styles' );

/**
 * Add custom CSS to the Customizer controls panel to hide the placeholder.
 */
function forgepress_customize_controls_css() {
	?>
	<style>
		/* THIS IS THE FIX: Target only the input field within the placeholder control */
		#customize-control-forgepress_reset_placeholder_control input[type="text"] {
			display: none !important;
		}
	</style>
	<?php
}
add_action( 'customize_controls_print_styles', 'forgepress_customize_controls_css' );


// =============================================================================
// 5. FILTERS & ACTIONS
// =============================================================================
function forgepress_add_module_to_script( $tag, $handle, $src ) {
	if ( 'vite-client' === $handle || 'forgepress-main-js' === $handle ) {
		return '<script type="module" src="' . esc_url( $src ) . '" id="' . esc_attr( $handle ) . '-js"></script>';
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'forgepress_add_module_to_script', 10, 3 );

function forgepress_body_classes( $classes ) {
	$site_layout    = get_theme_mod( 'forgepress_site_layout', 'boxed' );
	$classes[]      = 'layout-' . $site_layout;
	$sidebar_layout = 'layout-no-sidebar';
	$show_on_blog   = get_theme_mod( 'forgepress_sidebar_show_on_blog', false );
	$show_on_posts  = get_theme_mod( 'forgepress_sidebar_show_on_posts', false );
	$chosen_layout  = get_theme_mod( 'forgepress_sidebar_layout', 'no-sidebar' );
	if ( ( is_home() || is_archive() || is_search() ) && true === $show_on_blog ) {
		$sidebar_layout = 'layout-' . $chosen_layout;
	} elseif ( ( is_singular( 'post' ) ) && true === $show_on_posts ) {
		$sidebar_layout = 'layout-' . $chosen_layout;
	}
	$classes[] = $sidebar_layout;
	return $classes;
}
add_filter( 'body_class', 'forgepress_body_classes' );

function forgepress_handle_customizer_reset() {
	if ( ! isset( $_GET['action'] ) || 'forgepress_reset_customizer' !== $_GET['action'] ) { return; }
	if ( ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( sanitize_key( $_GET['_wpnonce'] ), 'forgepress_reset_nonce' ) ) { return; }
	$setting_ids = forgepress_get_all_setting_ids();
	foreach ( $setting_ids as $id ) {
		remove_theme_mod( $id );
	}
	wp_redirect( admin_url( 'customize.php' ) );
	exit;
}
add_action( 'admin_post_nopriv_forgepress_reset_customizer', 'forgepress_handle_customizer_reset' );
add_action( 'admin_post_forgepress_reset_customizer', 'forgepress_handle_customizer_reset' );

/**
 * Provides a fallback for wp_nav_menu() when no menu is assigned.
 * Displays a list of pages, or an "Add a Menu" link for admins if no pages exist.
 *
 * @param array $args Arguments for wp_nav_menu.
 */
function forgepress_nav_menu_fallback( $args ) {
	// Get the pages to display.
	$pages = get_pages(
		array(
			'sort_column' => 'menu_order, post_title',
		)
	);

	// If pages exist, display them in a list.
	if ( $pages ) {
		$menu_html  = '<ul id="%1$s" class="%2$s">';
		$menu_html .= wp_list_pages(
			array(
				'title_li' => '',
				'echo'     => 0,
			)
		);
		$menu_html .= '</ul>';

		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		printf( $menu_html, esc_attr( $args['menu_id'] ), esc_attr( $args['menu_class'] ) );
		return;
	}

	// If no pages exist and user can edit, show the "Add a menu" link.
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}
	$menu_html = '<ul id="%1$s" class="%2$s">';
	$menu_html .= '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Assign a menu', 'forgepress' ) . '</a></li>';
	$menu_html .= '</ul>';
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	printf( $menu_html, esc_attr( $args['menu_id'] ), esc_attr( $args['menu_class'] ) );
}

// =============================================================================
// 6. HELPER FUNCTIONS
// =============================================================================
function forgepress_is_vite_dev() {
	return defined( 'FORGEPRESS_VITE_DEV' ) && true === constant( 'FORGEPRESS_VITE_DEV' );
}

function forgepress_display_reading_time() {
	$content      = get_post_field( 'post_content', get_the_ID() );
	$word_count   = str_word_count( strip_tags( $content ) );
	$wpm          = 200;
	$minutes      = ceil( $word_count / $wpm );
	$reading_time = ( $minutes < 1 ) ? 1 : $minutes;
	$text         = sprintf( esc_html__( '%s min read', 'forgepress' ), $reading_time );
	echo '<span class="reading-time"><span class="dashicons dashicons-clock"></span>' . esc_html( $text ) . '</span>';
}

function forgepress_get_all_setting_ids() {
	$color_settings  = forgepress_get_color_settings();
	$social_networks = array( 'facebook', 'twitter', 'instagram', 'linkedin', 'youtube' );
	$ids             = array( 'forgepress_site_layout', 'forgepress_sidebar_layout', 'forgepress_sidebar_show_on_blog', 'forgepress_sidebar_show_on_posts', 'forgepress_accent_color' );
	foreach ( $color_settings as $id => $setting ) {
		$ids[] = 'forgepress_' . $id;
	}
	foreach ( $social_networks as $network ) {
		$ids[] = 'forgepress_social_' . $network . '_link';
	}
	return $ids;
}