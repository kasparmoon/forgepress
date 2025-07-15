<?php
// phpcs:ignoreFile
/**
 * The template for displaying all single posts
 *
 * @package ForgePress
 */

get_header();
?>

	<main id="main" class="site-main">

		<?php
		// Start the Loop.
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="post-thumbnail">
						<?php the_post_thumbnail( 'large' ); ?>
					</div>
				<?php endif; ?>

				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><?php get_template_part( 'template-parts/entry-meta' ); ?>

				<div class="entry-content">
					<?php the_content(); ?>
				</div></article><?php
			// If comments are open or there is at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><?php
get_footer();