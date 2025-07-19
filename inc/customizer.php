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
		'website_background_color' => array(
			'label'   => __( 'Website Background Color', 'forgepress' ),
			'default' => '#F0F0F0',
			'section' => 'forgepress_general_colors_section',
		),
		'content_background_color' => array(
			'label'   => __( 'Content Background Color', 'forgepress' ),
			'default' => '#FFFFFF',
			'section' => 'forgepress_general_colors_section',
		),
		'primary_text_color'       => array(
			'label'   => __( 'Primary Text Color', 'forgepress' ),
			'default' => '#111827',
			'section' => 'forgepress_general_colors_section',
		),
		'secondary_text_color'     => array(
			'label'   => __( 'Secondary Text Color', 'forgepress' ),
			'default' => '#6B7280',
			'section' => 'forgepress_general_colors_section',
		),
		'header_background_color'  => array(
			'label'   => __( 'Header Background Color', 'forgepress' ),
			'default' => '#FFFFFF',
			'section' => 'forgepress_header_colors_section',
		),
		'site_title_color'         => array(
			'label'   => __( 'Site Title Color', 'forgepress' ),
			'default' => '#111827',
			'section' => 'forgepress_header_colors_section',
		),
		'header_menu_text_color'   => array(
			'label'   => __( 'Menu Text Color', 'forgepress' ),
			'default' => '#111827',
			'section' => 'forgepress_header_colors_section',
		),
		'footer_background_color'  => array(
			'label'   => __( 'Footer Background Color', 'forgepress' ),
			'default' => '#111827',
			'section' => 'forgepress_footer_colors_section',
		),
		'footer_text_color'        => array(
			'label'   => __( 'Footer Text Color', 'forgepress' ),
			'default' => '#E5E7EB',
			'section' => 'forgepress_footer_colors_section',
		),
		'footer_menu_text_color'   => array(
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

	// Add Panel for all our theme options.
	$wp_customize->add_panel( 'forgepress_theme_options', array( 'title' => __( 'ForgePress Options', 'forgepress' ), 'priority' => 10 ) );

	// --- Layout Section (RESTORED) ---
	$wp_customize->add_section(
		'forgepress_layout_section',
		array(
			'title' => __( 'Layout', 'forgepress' ),
			'panel' => 'forgepress_theme_options',
		)
	);

	// Global Site Layout Setting & Control (RESTORED)
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

	// Sidebar Layout Setting & Control (RESTORED)
	$wp_customize->add_setting( 'forgepress_sidebar_layout', array( 'default' => 'no-sidebar', 'sanitize_callback' => 'sanitize_key' ) );
	$wp_customize->add_control(
		'forgepress_sidebar_layout_control',
		array(
			'label'    => __( 'Sidebar Layout', 'forgepress' ),
			'section'  => 'forgepress_layout_section',
			'settings' => 'forgepress_sidebar_layout',
			'type'     => 'select',
			'choices'  => array(
				'no-sidebar'           => __( 'No Sidebar', 'forgepress' ),
				'sidebar-right'        => __( 'Right Single Sidebar', 'forgepress' ),
				'sidebar-left'         => __( 'Left Single Sidebar', 'forgepress' ),
				'sidebar-both'         => __( 'Left and Right Sidebars', 'forgepress' ),
				'sidebar-double-right' => __( 'Right Side Double Sidebar', 'forgepress' ),
			),
		)
	);

	// --- Sidebar Display Section (RESTORED) ---
	$wp_customize->add_section(
		'forgepress_sidebar_display_section',
		array(
			'title'       => __( 'Sidebar Display', 'forgepress' ),
			'description' => __( 'Choose where to display your chosen sidebar layout.', 'forgepress' ),
			'panel'       => 'forgepress_theme_options',
		)
	);

	// Show Sidebar on Blog/Archives Setting & Control (RESTORED)
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

	// Show Sidebar on Single Posts Setting & Control (RESTORED)
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

	// --- Color Sections (NEW) ---
	$wp_customize->add_section( 'forgepress_general_colors_section', array( 'title' => __( 'General Colors', 'forgepress' ), 'panel' => 'forgepress_theme_options' ) );
	$wp_customize->add_section( 'forgepress_header_colors_section', array( 'title' => __( 'Header Colors', 'forgepress' ), 'panel' => 'forgepress_theme_options' ) );
	$wp_customize->add_section( 'forgepress_footer_colors_section', array( 'title' => __( 'Footer Colors', 'forgepress' ), 'panel' => 'forgepress_theme_options' ) );

	// Loop to create all our new color controls
	$color_settings = forgepress_get_color_settings();
	foreach ( $color_settings as $id => $setting ) {
		$wp_customize->add_setting( 'forgepress_' . $id, array( 'default' => $setting['default'], 'sanitize_callback' => 'sanitize_hex_color' ) );
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

	// Primary Accent Color
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
				$theme_mod      = get_theme_mod( 'forgepress_' . $id, $setting['default'] );
				$css_var_name   = str_replace( '_', '-', $id );
				echo '--color-' . esc_attr( $css_var_name ) . ': ' . esc_attr( $theme_mod ) . ';';
			}
			?>
		}
	</style>
	<?php
}
add_action( 'wp_head', 'forgepress_generate_customizer_css' );