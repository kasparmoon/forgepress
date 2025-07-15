<?php
// phpcs:ignoreFile
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @package ForgePress
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password,
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$comment_count = get_comments_number();
			if ( '1' === $comment_count ) {
				printf(
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'forgepress' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf(
					/* translators: 1: comment count, 2: post title. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'forgepress' ) ),
					esc_html( number_format_i18n( $comment_count ) ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2><?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size' => 56,
				)
			);
			?>
		</ol><?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'forgepress' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	comment_form(); // The "Leave a Reply" form.
	?>

</div>```

#### 3. Update `single.php` to Display the Comments Template
Now we need to tell our single post template to actually show this new comments section. Open **`single.php`** and replace its entire content with this updated version, which now calls our new `comments.php` file.
```php
<?php
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
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); // Use h1 for single post titles. ?>
					</header><?php get_template_part( 'template-parts/entry-meta' ); ?>

					<div class="entry-content">
						<?php the_content(); ?>
					</div></article><?php
				// If comments are open or there is at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				?>
			<?php
		endwhile;
		?>

	</main><?php
get_footer();