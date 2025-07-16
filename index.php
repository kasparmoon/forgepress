<?php
// phpcs:ignoreFile
/**
 * The main template file
 *
 * @package ForgePress
 */

get_header(); ?>

<div class="site-content-grid">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', get_post_type() );
				endwhile;
				the_posts_navigation();
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>

		</main>
	</div>

	<?php get_sidebar(); ?>
	<?php get_sidebar( 'secondary' ); ?>
</div>

<?php
get_footer();