<?php
//phpcs:ignoreFile
/**
 * ForgePress Theme Customizer
 *
 * @package ForgePress
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

function forgepress_customize_register( $wp_customize ) {

	$wp_customize->add_panel( 'forgepress_theme_options', array( 'title' => __( 'ForgePress Options', 'forgepress' ), 'priority' => 10 ) );

	// --- Layout Section ---
	$wp_customize->add_section( 'forgepress_layout_section', array( 'title' => __( 'Layout', 'forgepress' ), 'panel' => 'forgepress_theme_options' ) );
	$wp_customize->add_setting( 'forgepress_site_layout', array( 'default' => 'boxed', 'sanitize_callback' => 'sanitize_key' ) );
	$wp_customize->add_control( 'forgepress_site_layout_control', array( 'label' => __( 'Global Site Layout', 'forgepress' ), 'section' => 'forgepress_layout_section', 'settings' => 'forgepress_site_layout', 'type' => 'radio', 'choices' => array( 'boxed' => __( 'Boxed', 'forgepress' ), 'full-width' => __( 'Full Width', 'forgepress' ) ) ) );
	$wp_customize->add_setting( 'forgepress_sidebar_layout', array( 'default' => 'no-sidebar', 'sanitize_callback' => 'sanitize_key' ) );
	$wp_customize->add_control( 'forgepress_sidebar_layout_control', array( 'label' => __( 'Sidebar Layout', 'forgepress' ), 'section' => 'forgepress_layout_section', 'settings' => 'forgepress_sidebar_layout', 'type' => 'select', 'choices' => array( 'no-sidebar' => __( 'No Sidebar', 'forgepress' ), 'sidebar-right' => __( 'Right Single Sidebar', 'forgepress' ), 'sidebar-left' => __( 'Left Single Sidebar', 'forgepress' ), 'sidebar-both' => __( 'Left and Right Sidebars', 'forgepress' ), 'sidebar-double-right' => __( 'Right Side Double Sidebar', 'forgepress' ) ) ) );

	// --- Sidebar Display Section ---
	$wp_customize->add_section( 'forgepress_sidebar_display_section', array( 'title' => __( 'Sidebar Display', 'forgepress' ), 'description' => __( 'Choose where to display your chosen sidebar layout.', 'forgepress' ), 'panel' => 'forgepress_theme_options' ) );
	$wp_customize->add_setting( 'forgepress_sidebar_show_on_blog', array( 'default' => false, 'sanitize_callback' => 'rest_sanitize_boolean' ) );
	$wp_customize->add_control( 'forgepress_sidebar_show_on_blog_control', array( 'label' => __( 'Show on Blog / Archives', 'forgepress' ), 'section' => 'forgepress_sidebar_display_section', 'settings' => 'forgepress_sidebar_show_on_blog', 'type' => 'checkbox' ) );
	$wp_customize->add_setting( 'forgepress_sidebar_show_on_posts', array( 'default' => false, 'sanitize_callback' => 'rest_sanitize_boolean' ) );
	$wp_customize->add_control( 'forgepress_sidebar_show_on_posts_control', array( 'label' => __( 'Show on Single Posts', 'forgepress' ), 'section' => 'forgepress_sidebar_display_section', 'settings' => 'forgepress_sidebar_show_on_posts', 'type' => 'checkbox' ) );

	// --- Color Sections ---
	$wp_customize->add_section( 'forgepress_general_colors_section', array( 'title' => __( 'General Colors', 'forgepress' ), 'panel' => 'forgepress_theme_options' ) );
	$wp_customize->add_section( 'forgepress_header_colors_section', array( 'title' => __( 'Header Colors', 'forgepress' ), 'panel' => 'forgepress_theme_options' ) );
	$wp_customize->add_section( 'forgepress_footer_colors_section', array( 'title' => __( 'Footer Colors', 'forgepress' ), 'panel' => 'forgepress_theme_options' ) );

	$color_settings = forgepress_get_color_settings();
	foreach ( $color_settings as $id => $setting ) {
		$wp_customize->add_setting( 'forgepress_' . $id, array( 'default' => $setting['default'], 'sanitize_callback' => 'sanitize_hex_color' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'forgepress_' . $id . '_control', array( 'label' => $setting['label'], 'section' => $setting['section'], 'settings' => 'forgepress_' . $id ) ) );
	}
	$wp_customize->add_setting( 'forgepress_accent_color', array( 'default' => '#0073aa', 'sanitize_callback' => 'sanitize_hex_color' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'forgepress_accent_color_control', array( 'label' => __( 'Primary Accent Color (Links & Buttons)', 'forgepress' ), 'section' => 'forgepress_general_colors_section' ) ) );

	// --- Social Links Section (NEW) ---
	$wp_customize->add_section(
		'forgepress_social_links_section',
		array(
			'title'       => __( 'Social Links', 'forgepress' ),
			'description' => __( 'Enter the full URLs for your social media profiles.', 'forgepress' ),
			'panel'       => 'forgepress_theme_options',
		)
	);
	$social_networks = array( 'facebook', 'twitter', 'instagram', 'linkedin', 'youtube' );
	foreach ( $social_networks as $network ) {
		$wp_customize->add_setting( 'forgepress_social_' . $network . '_link', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
		$wp_customize->add_control( 'forgepress_social_' . $network . '_link_control', array( 'label' => ucwords( $network ) . ' URL', 'section' => 'forgepress_social_links_section', 'type' => 'url', 'settings' => 'forgepress_social_' . $network . '_link' ) );
	}

	// --- Reset Section (NEW) ---
	$wp_customize->add_section(
		'forgepress_reset_section',
		array(
			'title'       => __( 'Reset Settings', 'forgepress' ),
			'priority'    => 200, // Place it at the end.
			'panel'       => 'forgepress_theme_options',
		)
	);

	// Dummy setting for the reset button control.
	$wp_customize->add_setting( 'forgepress_reset_button', array( 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control(
		'forgepress_reset_button_control',
		array(
			'label'       => __( 'Reset All Options', 'forgepress' ),
			'description' => __( 'CAUTION: This will reset ALL ForgePress options in the Customizer to their default values. This action cannot be undone.', 'forgepress' ),
			'section'     => 'forgepress_reset_section',
			'settings'    => 'forgepress_reset_button',
			'type'        => 'button', // This is just a placeholder type.
		)
	);

}
add_action( 'customize_register', 'forgepress_customize_register' );

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