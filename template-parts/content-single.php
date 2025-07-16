<?php
// phpcs:ignoreFile
/**
 * Template part for displaying single posts
 *
 * @package ForgePress
 */
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
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'forgepress' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><footer class="entry-footer">
		<?php edit_post_link( esc_html__( 'Edit', 'forgepress' ), '<span class="edit-link">', '</span>' ); ?>
	</footer></article>