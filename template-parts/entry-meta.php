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
			'Posted on %s',
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . esc_html( get_the_date() ) . '</a>'
		);
		?>
	</span>
	<span class="byline">
		<?php
		printf(
			'by %s',
			'<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
		);
		?>
	</span>
</div>```