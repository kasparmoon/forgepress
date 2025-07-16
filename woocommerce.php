<?php
// phpcs:ignoreFile
/**
 * The template for displaying all pages
 *
 * @package ForgePress
 */

get_header(); ?>

<div class="site-content-grid">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php woocommerce_content(); ?>
		</main>
	</div>

	<?php get_sidebar(); ?>
	<?php get_sidebar( 'secondary' ); ?>
</div>

<?php
get_footer();