<?php
// phpcs:ignoreFile
/**
 * ForgePress Theme Customizer
 *
 * @package ForgePress
 * @author  Abu Saeed M Sayem AKA Kaspar Moon
 * @license GPL-2.0+
 * @link    https://github.com/kaspar-moon/forgepress
 */

/**
 * Adds Customizer settings for ForgePress.
 *
 * @since 1.0.0
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function forgepress_customize_register( $wp_customize ) {

	// Add Panel for all our theme options.
	$wp_customize->add_panel(
		'forgepress_theme_options',
		array(
			'title'    => __( 'ForgePress Options', 'forgepress' ),
			'priority' => 10,
		)
	);

	// --- Layout Section ---
	$wp_customize->add_section(
		'forgepress_layout_section',
		array(
			'title' => __( 'Layout', 'forgepress' ),
			'panel' => 'forgepress_theme_options',
		)
	);

	// Global Site Layout Setting & Control
	$wp_customize->add_setting( 'forgepress_site_layout', array( 'default' => 'boxed', 'sanitize_callback' => 'sanitize_key' ) );
	$wp_customize->add_control(
		'forgepress_site_layout_control',
		array(
			'label'    => __( 'Global Site Layout', 'forgepress' ),
			'section'  => 'forgepress_layout_section',
			'settings' => 'forgepress_site_layout',
			'type'     => 'radio',
			'choices'  => array(
				'boxed'      => __( 'Boxed', 'forgepress' ),
				'full-width' => __( 'Full Width', 'forgepress' ),
			),
		)
	);

	// Sidebar Layout Setting & Control
	$wp_customize->add_setting( 'forgepress_sidebar_layout', array( 'default' => 'no-sidebar', 'sanitize_callback' => 'sanitize_key' ) );
	$wp_customize->add_control(
		'forgepress_sidebar_layout_control',
		array(
			'label'    => __( 'Sidebar Layout', 'forgepress' ),
			'section'  => 'forgepress_layout_section',
			'settings' => 'forgepress_sidebar_layout',
			'type'     => 'select',
			'choices'  => array(
				'no-sidebar'       => __( 'No Sidebar', 'forgepress' ),
				'sidebar-right'    => __( 'Right Single Sidebar', 'forgepress' ),
				'sidebar-left'     => __( 'Left Single Sidebar', 'forgepress' ),
				'sidebar-both'     => __( 'Left and Right Sidebars', 'forgepress' ),
				'sidebar-double-right' => __( 'Right Side Double Sidebar', 'forgepress' ),
			),
		)
	);

	// --- Sidebar Display Section ---
	$wp_customize->add_section(
		'forgepress_sidebar_display_section',
		array(
			'title'       => __( 'Sidebar Display', 'forgepress' ),
			'description' => __( 'Choose where to display your chosen sidebar layout.', 'forgepress' ),
			'panel'       => 'forgepress_theme_options',
		)
	);

	// Show Sidebar on Blog/Archives Setting & Control
	$wp_customize->add_setting( 'forgepress_sidebar_show_on_blog', array( 'default' => false, 'sanitize_callback' => 'rest_sanitize_boolean' ) );
	$wp_customize->add_control(
		'forgepress_sidebar_show_on_blog_control',
		array(
			'label'    => __( 'Show on Blog / Archives', 'forgepress' ),
			'section'  => 'forgepress_sidebar_display_section',
			'settings' => 'forgepress_sidebar_show_on_blog',
			'type'     => 'checkbox',
		)
	);

	// Show Sidebar on Single Posts Setting & Control
	$wp_customize->add_setting( 'forgepress_sidebar_show_on_posts', array( 'default' => false, 'sanitize_callback' => 'rest_sanitize_boolean' ) );
	$wp_customize->add_control(
		'forgepress_sidebar_show_on_posts_control',
		array(
			'label'    => __( 'Show on Single Posts', 'forgepress' ),
			'section'  => 'forgepress_sidebar_display_section',
			'settings' => 'forgepress_sidebar_show_on_posts',
			'type'     => 'checkbox',
		)
	);

	// --- Colors Section ---
	$wp_customize->add_section(
		'forgepress_colors_section',
		array(
			'title' => __( 'Colors', 'forgepress' ),
			'panel' => 'forgepress_theme_options',
		)
	);

	// Primary Accent Color Setting & Control
	$wp_customize->add_setting( 'forgepress_accent_color', array( 'default' => '#0073aa', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'forgepress_accent_color_control',
			array(
				'label'    => __( 'Primary Accent Color', 'forgepress' ),
				'section'  => 'forgepress_colors_section',
				'settings' => 'forgepress_accent_color',
			)
		)
	);

}
add_action( 'customize_register', 'forgepress_customize_register' );


/**
 * Generate CSS from the Customizer settings and output to the head.
 *
 * @since 1.0.0
 */
function forgepress_generate_customizer_css() {
	$accent_color = get_theme_mod( 'forgepress_accent_color', '#0073aa' );

	?>
	<style type="text/css" id="forgepress-customizer-css">
		:root {
			--primary-accent-color: <?php echo esc_attr( $accent_color ); ?>;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'forgepress_generate_customizer_css' );