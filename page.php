<?php
// phpcs:ignoreFile
/**
 * The template for displaying all static pages
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
				</header><div class="entry-content">
					<?php
					the_content();

					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'forgepress' ),
							'after'  => '</div>',
						)
					);
					?>
				</div></article><?php
	endwhile;
	?>

</main><?php
get_footer();