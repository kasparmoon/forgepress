<?php
// phpcs:ignoreFile
/**
 * The template for displaying all static pages
 *
 * @package ForgePress
 */

get_header(); ?>

<div class="site-content-grid">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'page' ); // We will create this file next
			endwhile;
			?>

		</main>
	</div>
	
	<?php get_sidebar(); ?>
	<?php get_sidebar( 'secondary' ); ?>
</div>

<?php
get_footer();