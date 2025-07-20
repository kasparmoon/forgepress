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
// 1. THEME SETUP
// =============================================================================
function forgepress_setup() {
	add_theme_support( 'widgets-block-editor' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'woocommerce' );
	register_nav_menus(
		array(
			'primary'   => esc_html__( 'Primary Menu', 'forgepress' ),
			'secondary' => esc_html__( 'Secondary Menu (Header Top)', 'forgepress' ), // NEW
			'footer'    => esc_html__( 'Footer Menu', 'forgepress' ),
		)
	);
}
add_action( 'after_setup_theme', 'forgepress_setup' );

function forgepress_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Primary Sidebar', 'forgepress' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'forgepress' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Secondary Sidebar', 'forgepress' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Add widgets here for three-column layouts.', 'forgepress' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'forgepress_widgets_init' );


// =============================================================================
// 2. SCRIPTS & STYLES
// =============================================================================
define( 'FORGEPRESS_DEV_SERVER', 'http://localhost:5173' );
define( 'FORGEPRESS_PROD_URL', get_template_directory_uri() . '/dist' );
define( 'FORGEPRESS_PROD_PATH', get_template_directory() . '/dist' );

function forgepress_enqueue_fonts() {
	wp_enqueue_style( 'forgepress-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap', array(), null );
}
add_action( 'wp_enqueue_scripts', 'forgepress_enqueue_fonts' );

function forgepress_is_vite_dev() {
	return defined( 'FORGEPRESS_VITE_DEV' ) && true === constant( 'FORGEPRESS_VITE_DEV' );
}

function forgepress_enqueue_vite_assets() {
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
add_action( 'wp_enqueue_scripts', 'forgepress_enqueue_vite_assets' );

function forgepress_add_module_to_script( $tag, $handle, $src ) {
	if ( 'vite-client' === $handle || 'forgepress-main-js' === $handle ) {
		return '<script type="module" src="' . esc_url( $src ) . '" id="' . esc_attr( $handle ) . '-js"></script>';
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'forgepress_add_module_to_script', 10, 3 );

/**
 * Enqueue scripts for the Customizer controls.
 *
 * @since 1.0.0
 */
function forgepress_customize_controls_js() {
	// Get all the setting IDs we need to reset.
	$setting_ids = array_keys( forgepress_get_all_setting_ids() );

	wp_enqueue_script( 'forgepress-customizer-reset', get_template_directory_uri() . '/assets/js/customizer-reset.js', array( 'customize-controls' ), '1.0.0', true );

	// Pass the setting IDs to our script.
	wp_localize_script( 'forgepress-customizer-reset', 'forgepress_reset_data', array( 'setting_ids' => $setting_ids ) );
}
add_action( 'customize_controls_enqueue_scripts', 'forgepress_customize_controls_js' );


// =============================================================================
// 3. FILTERS AND ACTIONS
// =============================================================================
function forgepress_body_classes( $classes ) {
	$site_layout = get_theme_mod( 'forgepress_site_layout', 'boxed' );
	$classes[]   = 'layout-' . $site_layout;
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


// =============================================================================
// 4. TEMPLATE TAGS & HELPERS
// =============================================================================

/**
 * Calculates and displays the estimated reading time for a post.
 *
 * @since 1.0.0
 */
function forgepress_display_reading_time() {
	$content    = get_post_field( 'post_content', get_the_ID() );
	$word_count = str_word_count( strip_tags( $content ) );
	$wpm        = 200; // Average words per minute.
	$minutes    = ceil( $word_count / $wpm );

	// If the reading time is less than 1 minute, show "1 min read".
	$reading_time = ( $minutes < 1 ) ? 1 : $minutes;

	// Translators: %s is the estimated reading time in minutes.
	$text = sprintf( esc_html__( '%s min read', 'forgepress' ), $reading_time );

	echo '<span class="reading-time"><span class="dashicons dashicons-clock"></span>' . esc_html( $text ) . '</span>';
}

/**
 * Gathers all theme setting IDs for the reset button.
 *
 * @return array
 */
function forgepress_get_all_setting_ids() {
	$color_settings  = forgepress_get_color_settings();
	$social_networks = array( 'facebook', 'twitter', 'instagram', 'linkedin', 'youtube' );

	$ids = array(
		'forgepress_site_layout',
		'forgepress_sidebar_layout',
		'forgepress_sidebar_show_on_blog',
		'forgepress_sidebar_show_on_posts',
		'forgepress_accent_color',
	);

	foreach ( $color_settings as $id => $setting ) {
		$ids[] = 'forgepress_' . $id;
	}

	foreach ( $social_networks as $network ) {
		$ids[] = 'forgepress_social_' . $network . '_link';
	}

	return array_flip( $ids ); // Use array_flip to make checking keys easier.
}

// =============================================================================
// 5. INCLUDE ADDITIONAL FILES
// =============================================================================
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/icons.php';

if ( class_exists( 'WooCommerce' ) ) {
	require_once get_template_directory() . '/inc/woocommerce.php';
}