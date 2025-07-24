<?php
// phpcs:ignoreFile
/**
 * Template part for displaying posts as cards.
 *
 * @package ForgePress
 */
?>
<div class="featured-post-card">
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" class="card-image-link"><?php the_post_thumbnail( 'medium_large' ); ?></a>
	<?php else : ?>
		<a href="<?php the_permalink(); ?>" class="card-image-link"><img src="https://picsum.photos/seed/<?php echo esc_attr( get_the_ID() ); ?>/600/400" alt="Placeholder Image"></a>
	<?php endif; ?>
	<div class="card-content">
		<div class="card-meta">
			<?php
			$categories = get_the_category();
			if ( ! empty( $categories ) ) {
				echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
			}
			?>
		</div>
		<h4 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
	</div>
</div>