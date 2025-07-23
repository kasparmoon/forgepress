<?php
// phpcs:ignoreFile
/**
 * ForgePress Theme Functions
 *
 * @package ForgePress
 * @author  Abu Saeed M Sayem AKA Kaspar Moon
 * @license GPL-2.0+
 * @link    https://github.com/kaspar-moon/forgepress
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<?php
		// --- HERO SECTION ---
		// For now, this will query the very latest post.
		// In a future step, we can add a Customizer option to select a specific featured post.
		$hero_query = new WP_Query(
			array(
				'posts_per_page'      => 1,
				'ignore_sticky_posts' => true,
			)
		);
		if ( $hero_query->have_posts() ) :
			while ( $hero_query->have_posts() ) :
				$hero_query->the_post();
				?>
				<section class="homepage-section homepage-hero">
					<div class="container hero-grid">
						<div class="hero-content">
							<h2 class="hero-title"><?php the_title(); ?></h2>
							<div class="hero-excerpt">
								<?php the_excerpt(); ?>
							</div>
							<a href="<?php the_permalink(); ?>" class="button hero-button"><?php esc_html_e( 'Read The Article', 'forgepress' ); ?></a>
						</div>
						<div class="hero-image">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'large' ); ?>
							<?php else : ?>
								<img src="https://picsum.photos/seed/heroside/800/600" alt="Placeholder Image for Hero Section">
							<?php endif; ?>
						</div>
					</div>
				</section>
				<?php
			endwhile;
			wp_reset_postdata();
		endif;
		?>


		<?php
		// --- LATEST POSTS SECTION ---
		// Query the next 3 latest posts, skipping the one we already showed in the hero.
		$latest_posts_query = new WP_Query(
			array(
				'posts_per_page' => 3,
				'offset'         => 1, // Skip the first post.
				'ignore_sticky_posts' => true,
			)
		);
		if ( $latest_posts_query->have_posts() ) :
			?>
			<section class="homepage-section homepage-blog-archive">
				<div class="container">
					<h3 class="section-title"><?php esc_html_e( 'Latest Posts', 'forgepress' ); ?></h3>
					<div class="featured-posts-grid">
						<?php
						while ( $latest_posts_query->have_posts() ) :
							$latest_posts_query->the_post();
							?>
							<div class="featured-post-card">
								<?php if ( has_post_thumbnail() ) : ?>
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium_large' ); ?></a>
								<?php else : ?>
									<a href="<?php the_permalink(); ?>"><img src="https://picsum.photos/seed/<?php echo esc_attr( get_the_ID() ); ?>/600/400" alt="Placeholder Image"></a>
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
							<?php
						endwhile;
						wp_reset_postdata();
						?>
					</div>
				</div>
			</section>
			<?php
		endif;
		?>


		<?php // --- ABOUT SECTIONS --- ?>
		<section class="homepage-section homepage-about-sections">
			<div class="container about-grid">
				<div class="about-card">
					<h4 class="section-title-small"><?php esc_html_e( 'Why This Blog', 'forgepress' ); ?></h4>
					<p><?php esc_html_e( 'This is a placeholder description explaining the mission and purpose of the blog. A user can edit this by creating a page with the slug "why-this-blog".', 'forgepress' ); ?></p>
				</div>
				<div class="about-card">
					<h4 class="section-title-small"><?php esc_html_e( 'Short About Section', 'forgepress' ); ?></h4>
					<p><?php esc_html_e( 'A short, personal bio of the author. A user can edit this by going to their profile page in the WordPress admin.', 'forgepress' ); ?></p>
				</div>
			</div>
		</section>

	</main>
</div>

<?php
get_footer();