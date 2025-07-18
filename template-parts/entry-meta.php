<?php
// phpcs:ignoreFile
/**
 * Template part for displaying post entry meta.
 *
 * @package ForgePress
 */
?>
<div class="entry-meta">
	<span class="posted-on">
		<?php
		printf(
			/* translators: %s: post date. */
			esc_html__( 'Posted on %s', 'forgepress' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . esc_html( get_the_date() ) . '</a>'
		);
		?>
	</span>
	<span class="byline">
		<?php
		printf(
			/* translators: %s: post author. */
			esc_html__( 'by %s', 'forgepress' ),
			'<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
		);
		?>
	</span>
	<span class="meta-separator" aria-hidden="true">&middot;</span>
	<?php forgepress_display_reading_time(); ?>
</div>