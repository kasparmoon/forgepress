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
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><?php get_template_part( 'template-parts/entry-meta' ); ?>

				<div class="entry-content">
					<?php the_content(); ?>
				</div></article><?php
	endwhile;
	?>

</main><?php
get_footer();