<?php
// phpcs:ignoreFile
/**
 * The main template file
 *
 * @package ForgePress
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<?php
		if ( have_posts() ) :

			// Start the Loop.
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', get_post_type() );
			endwhile;

			// Previous/next page navigation.
			the_posts_navigation();

		else :
			// If no content, include the "No posts found" template.
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main></div><?php
get_sidebar();
get_footer();