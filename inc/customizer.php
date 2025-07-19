<?php
//phpcs:ignoreFile
/**
 * ForgePress Theme Customizer
 *
 * @package ForgePress
 */

/**
 * An array of all the color settings we want to add to the theme.
 *
 * @return array
 */
function forgepress_get_color_settings() {
	return array(
		// General Colors
		'website_background_color'   => array(
			'label'   => __( 'Website Background Color', 'forgepress' ),
			'default' => '#F0F0F0',
			'section' => 'forgepress_general_colors_section',
		),
		'content_background_color'   => array(
			'label'   => __( 'Content Background Color', 'forgepress' ),
			'default' => '#FFFFFF',
			'section' => 'forgepress_general_colors_section',
		),
		'primary_text_color'         => array(
			'label'   => __( 'Primary Text Color', 'forgepress' ),
			'default' => '#111827',
			'section' => 'forgepress_general_colors_section',
		),
		'secondary_text_color'       => array(
			'label'   => __( 'Secondary Text Color', 'forgepress' ),
			'default' => '#6B7280',
			'section' => 'forgepress_general_colors_section',
		),
		// Header Colors
		'header_background_color'    => array(
			'label'   => __( 'Header Background Color', 'forgepress' ),
			'default' => '#FFFFFF',
			'section' => 'forgepress_header_colors_section',
		),
		'site_title_color'           => array(
			'label'   => __( 'Site Title Color', 'forgepress' ),
			'default' => '#111827',
			'section' => 'forgepress_header_colors_section',
		),
		'header_menu_text_color'     => array(
			'label'   => __( 'Menu Text Color', 'forgepress' ),
			'default' => '#111827',
			'section' => 'forgepress_header_colors_section',
		),
		// Footer Colors
		'footer_background_color'    => array(
			'label'   => __( 'Footer Background Color', 'forgepress' ),
			'default' => '#111827',
			'section' => 'forgepress_footer_colors_section',
		),
		'footer_text_color'          => array(
			'label'   => __( 'Footer Text Color', 'forgepress' ),
			'default' => '#E5E7EB',
			'section' => 'forgepress_footer_colors_section',
		),
		'footer_menu_text_color'     => array(
			'label'   => __( 'Footer Menu Link Color', 'forgepress' ),
			'default' => '#FFFFFF',
			'section' => 'forgepress_footer_colors_section',
		),
	);
}

/**
 * Adds Customizer settings for ForgePress.
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function forgepress_customize_register( $wp_customize ) {

	$wp_customize->add_panel( 'forgepress_theme_options', array( 'title' => __( 'ForgePress Options', 'forgepress' ), 'priority' => 10 ) );

	// --- Layout Section (Existing) ---
	$wp_customize->add_section( 'forgepress_layout_section', array( 'title' => __( 'Layout', 'forgepress' ), 'panel' => 'forgepress_theme_options' ) );
	// ... (Your existing layout controls are here and will remain)

	// --- Color Sections ---
	$wp_customize->add_section( 'forgepress_general_colors_section', array( 'title' => __( 'General Colors', 'forgepress' ), 'panel' => 'forgepress_theme_options' ) );
	$wp_customize->add_section( 'forgepress_header_colors_section', array( 'title' => __( 'Header Colors', 'forgepress' ), 'panel' => 'forgepress_theme_options' ) );
	$wp_customize->add_section( 'forgepress_footer_colors_section', array( 'title' => __( 'Footer Colors', 'forgepress' ), 'panel' => 'forgepress_theme_options' ) );

	// --- Loop to create all our new color controls ---
	$color_settings = forgepress_get_color_settings();
	foreach ( $color_settings as $id => $setting ) {
		// 1. Add Setting
		$wp_customize->add_setting(
			'forgepress_' . $id,
			array(
				'default'           => $setting['default'],
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		// 2. Add Control
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'forgepress_' . $id . '_control',
				array(
					'label'    => $setting['label'],
					'section'  => $setting['section'],
					'settings' => 'forgepress_' . $id,
				)
			)
		);
	}

	// --- Primary Accent Color (Moved to General Colors section for neatness) ---
	$wp_customize->add_setting( 'forgepress_accent_color', array( 'default' => '#0073aa', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'forgepress_accent_color_control',
			array(
				'label'   => __( 'Primary Accent Color (Links & Buttons)', 'forgepress' ),
				'section' => 'forgepress_general_colors_section',
			)
		)
	);
}
add_action( 'customize_register', 'forgepress_customize_register' );

/**
 * Generate CSS variables from the Customizer settings.
 */
function forgepress_generate_customizer_css() {
	?>
	<style type="text/css" id="forgepress-customizer-css">
		:root {
			--primary-accent-color: <?php echo esc_attr( get_theme_mod( 'forgepress_accent_color', '#0073aa' ) ); ?>;
			<?php
			$color_settings = forgepress_get_color_settings();
			foreach ( $color_settings as $id => $setting ) {
				$theme_mod = get_theme_mod( 'forgepress_' . $id, $setting['default'] );
				// Sanitize the output just in case.
				$css_var_name = str_replace( '_', '-', $id );
				echo '--color-' . esc_attr( $css_var_name ) . ': ' . esc_attr( $theme_mod ) . ';';
			}
			?>
		}
	</style>
	<?php
}
add_action( 'wp_head', 'forgepress_generate_customizer_css' );