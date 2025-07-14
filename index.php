<?php
/**
 * The main template file
 *
 * @package ForgePress
 */

get_header();
?>

<main id="main" class="site-main">

	<?php
	if ( have_posts() ) :

		// Start the Loop.
		while ( have_posts() ) :
			the_post();
			?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
					</header><div class="entry-content">
						<?php the_content(); ?>
					</div></article><?php
		endwhile;

	else :
		// If no content, include the "No posts found" template.
		echo '<p>No posts found.</p>';

	endif;
	?>

</main><?php
get_footer();