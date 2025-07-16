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
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'forgepress' ),
			'footer'  => esc_html__( 'Footer Menu', 'forgepress' ),
		)
	);
}
add_action( 'after_setup_theme', 'forgepress_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
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
// 2. VITE ASSET INTEGRATION
// =============================================================================
define( 'FORGEPRESS_DEV_SERVER', 'http://localhost:5173' );
define( 'FORGEPRESS_PROD_URL', get_template_directory_uri() . '/dist' );
define( 'FORGEPRESS_PROD_PATH', get_template_directory() . '/dist' );

function forgepress_is_vite_dev() {
	// To force dev mode for debugging, add `define( 'FORGEPRESS_VITE_DEV', true );` to your wp-config.php file.
	return defined( 'FORGEPRESS_VITE_DEV' ) && true === constant( 'FORGEPRESS_VITE_DEV' );
}

function forgepress_enqueue_scripts() {
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
add_action( 'wp_enqueue_scripts', 'forgepress_enqueue_scripts' );

function forgepress_add_module_to_script( $tag, $handle, $src ) {
	if ( 'vite-client' === $handle || 'forgepress-main-js' === $handle ) {
		return '<script type="module" src="' . esc_url( $src ) . '" id="' . esc_attr( $handle ) . '-js"></script>';
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'forgepress_add_module_to_script', 10, 3 );


// =============================================================================
// 3. FILTERS AND ACTIONS
// =============================================================================

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function forgepress_body_classes( $classes ) {
	$site_layout = get_theme_mod( 'forgepress_site_layout', 'boxed' );
	$classes[]   = 'layout-' . $site_layout;
	return $classes;
}
add_filter( 'body_class', 'forgepress_body_classes' );


// =============================================================================
// 4. INCLUDE ADDITIONAL FILES
// =============================================================================
require_once get_template_directory() . '/inc/customizer.php';