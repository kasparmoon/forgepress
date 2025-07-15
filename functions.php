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
		// Add support for block-based widgets.
		add_theme_support( 'widgets-block-editor' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Register navigation menus.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'forgepress' ),
				'footer'  => esc_html__( 'Footer Menu', 'forgepress' ),
			)
		);
	}
	add_action( 'after_setup_theme', 'forgepress_setup' );

// =============================================================================
// 2. VITE ASSET INTEGRATION
// =============================================================================
define( 'FORGEPRESS_DEV_SERVER', 'http://localhost:5173' );
define( 'FORGEPRESS_PROD_URL', get_template_directory_uri() . '/dist' );
define( 'FORGEPRESS_PROD_PATH', get_template_directory() . '/dist' );

/**
 * Checks if the Vite development server is running.
 *
 * @since 1.0.0
 * @return bool True if dev mode is active, false otherwise.
 */
function forgepress_is_vite_dev() {
	// To force dev mode for debugging, add `define( 'FORGEPRESS_VITE_DEV', true );` to your wp-config.php file.
	// This check is written to be friendly to static analysis tools like Intelephense.
	return defined( 'FORGEPRESS_VITE_DEV' ) && true === constant( 'FORGEPRESS_VITE_DEV' );
}

function forgepress_enqueue_scripts() {
	if ( forgepress_is_vite_dev() ) {
		// Development mode (npm run dev)
		wp_enqueue_script( 'vite-client', FORGEPRESS_DEV_SERVER . '/@vite/client', array(), null, true );
		wp_enqueue_script( 'forgepress-main-js', FORGEPRESS_DEV_SERVER . '/src/main.jsx', array( 'vite-client' ), '1.0.0', true );
	} else {
		// Production mode (npm run build)
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
// 3. INCLUDE ADDITIONAL FILES
// =============================================================================
require_once get_template_directory() . '/inc/customizer.php';