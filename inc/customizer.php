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
/**
 * Adds Customizer settings for ForgePress.
 *
 * @since 1.0.0
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function forgepress_customize_register( $wp_customize ) {
	// 1. Add a new Panel for all our theme options.
	$wp_customize->add_panel(
		'forgepress_theme_options',
		array(
			'title'    => __( 'ForgePress Options', 'forgepress' ),
			'priority' => 10,
		)
	);

	// 2. Add a Section for Colors.
	$wp_customize->add_section(
		'forgepress_colors_section',
		array(
			'title' => __( 'Colors', 'forgepress' ),
			'panel' => 'forgepress_theme_options',
		)
	);

	// 3. Add a Setting for the Primary Accent Color.
	$wp_customize->add_setting(
		'forgepress_accent_color',
		array(
			'default'           => '#0073aa',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	// 4. Add a Control (the color picker UI) for the Setting.
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
/**
 * Generate CSS from the Customizer settings and output to the head.
 *
 * @since 1.0.0
 * @return void
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