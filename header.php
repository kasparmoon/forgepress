<?php
// phpcs:ignoreFile
/**
 * The header for our theme
 *
 * @package ForgePress
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'forgepress' ); ?></a>

<header id="masthead" class="site-header">
	<div class="header-inner container">

		<div class="site-branding">
			<?php
			// We will add a Site Logo option here in a future step.
			// For now, it will display the site title.
			?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		</div><div class="header-top">
			<nav id="secondary-navigation" class="secondary-navigation">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'secondary',
						'menu_id'        => 'secondary-menu',
						'depth'          => 1,
					)
				);
				?>
			</nav><div class="header-social-links">
				<?php
				$social_networks = array( 'facebook', 'twitter', 'instagram', 'linkedin', 'youtube' );
				foreach ( $social_networks as $network ) {
					$link = get_theme_mod( 'forgepress_social_' . $network . '_link' );
					if ( ! empty( $link ) ) {
						echo '<a href="' . esc_url( $link ) . '" class="social-link social-' . esc_attr( $network ) . '" target="_blank" rel="noopener noreferrer">' . forgepress_get_svg_icon( $network ) . '<span class="screen-reader-text">' . esc_html( ucwords( $network ) ) . '</span></a>';
					}
				}
				?>
			</div></div><div class="header-main">
			<nav id="site-navigation" class="main-navigation">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
					)
				);
				?>
			</nav><div class="header-search">
				<button class="search-toggle" aria-controls="search-modal" aria-expanded="false">
					<?php echo forgepress_get_svg_icon( 'search' ); ?>
					<span class="screen-reader-text"><?php esc_html_e( 'Search', 'forgepress' ); ?></span>
				</button>
			</div></div></div></header><div class="search-modal-container">
	<div class="search-modal">
		<?php get_search_form(); ?>
	</div>
</div>

<div id="page" class="site">
	<div id="content" class="site-content">