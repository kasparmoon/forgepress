<?php
// phpcs:ignoreFile
/**
 * The template for displaying WooCommerce pages
 *
 * @package ForgePress
 */

get_header(); ?>

<div class="site-content-grid">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php
			if ( class_exists( 'WooCommerce' ) && function_exists( 'woocommerce_content' ) ) {
				// If WooCommerce is active, display the WooCommerce content.
				woocommerce_content();
			} else {
				echo '<p>WooCommerce is not active. Please activate the WooCommerce plugin.</p>';
			}
			?>
		</main>
	</div>

	<?php get_sidebar(); ?>
	<?php get_sidebar( 'secondary' ); ?>
</div>

<?php
get_footer();