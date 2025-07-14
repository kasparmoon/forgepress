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

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 *  @since 1.0.0
 *  @return void
 */
function forgepress_setup()
{
	// Add support for block-based widgets.
	add_theme_support('widgets-block-editor');

	// Register navigation menus.
	register_nav_menus(
		array(
			'primary' => esc_html__('Primary Menu', 'forgepress'),
			'footer'  => esc_html__('Footer Menu', 'forgepress'),
		)
	);
}
add_action('after_setup_theme', 'forgepress_setup');


// =============================================================================
// 2. VITE ASSET INTEGRATION
// =============================================================================

// Define constants for assets.
define('FORGEPRESS_DEV_SERVER', 'http://localhost:5173'); // Default Vite dev server URL.
define('FORGEPRESS_PROD_URL', get_template_directory_uri() . '/dist');
define('FORGEPRESS_PROD_PATH', get_template_directory() . '/dist');

/**
 * Checks if the Vite development server is running.
 *
 * @since 1.0.0
 * @return bool True if the dev server is running, false otherwise.
 */
function forgepress_is_vite_dev()
{
	// Simple check: is the dev server URL reachable?
	$url      = FORGEPRESS_DEV_SERVER . '/@vite/client';
	$response = wp_remote_get($url, array('timeout' => 1, 'sslverify' => false));
	return ! is_wp_error($response);
}

/**
 * Enqueue scripts and styles from Vite.
 *
 * @since 1.0.0
 * @return void
 */
function forgepress_enqueue_scripts()
{
	if (forgepress_is_vite_dev()) {
		// Development: Load scripts from Vite dev server.
		wp_enqueue_script('main-js', FORGEPRESS_DEV_SERVER . '/src/main.jsx', array(), null, true);
	} else {
		// Production: Load scripts from the manifest.
		$manifest_path = FORGEPRESS_PROD_PATH . '/manifest.json';
		if (file_exists($manifest_path)) {
			$manifest = json_decode(file_get_contents($manifest_path), true);

			if (isset($manifest['src/main.jsx']['file'])) {
				wp_enqueue_script('main-js', FORGEPRESS_PROD_URL . '/' . $manifest['src/main.jsx']['file'], array(), null, true);
			}
			if (isset($manifest['src/main.jsx']['css'])) {
				foreach ($manifest['src/main.jsx']['css'] as $css_file) {
					wp_enqueue_style('main-css', FORGEPRESS_PROD_URL . '/' . $css_file);
				}
			}
		}
	}
}
add_action('wp_enqueue_scripts', 'forgepress_enqueue_scripts');


// =============================================================================
// 3. INCLUDE ADDITIONAL FILES
// =============================================================================

// Include the Customizer settings.
require_once get_template_directory() . '/inc/customizer.php';