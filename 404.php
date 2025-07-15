<?php
// phpcs:ignoreFile
/**
 * The template for displaying 404 pages (not found)
 *
 * @package ForgePress
 */

get_header();
?>

	<main id="main" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'forgepress' ); ?></h1>
			</header><div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'forgepress' ); ?></p>
				<?php get_search_form(); ?>
			</div></section></main><?php
get_footer();