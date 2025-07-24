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

		<?php // --- HERO SECTION --- ?>
		<?php
		$hero_query = new WP_Query( array( 'posts_per_page' => 1, 'ignore_sticky_posts' => true ) );
		?>
		<section class="homepage-section homepage-hero">
			<div class="container hero-grid">
				<?php if ( $hero_query->have_posts() ) : ?>
					<?php
					while ( $hero_query->have_posts() ) :
						$hero_query->the_post();
						?>
						<div class="hero-content">
							<h2 class="hero-title"><?php the_title(); ?></h2>
							<div class="hero-excerpt"><?php the_excerpt(); ?></div>
							<a href="<?php the_permalink(); ?>" class="button hero-button"><?php esc_html_e( 'Read The Article', 'forgepress' ); ?></a>
						</div>
						<div class="hero-image">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'large' ); ?>
							<?php else : ?>
								<img src="https://picsum.photos/seed/heroside/800/600" alt="Placeholder Image for Hero Section">
							<?php endif; ?>
						</div>
						<?php
					endwhile;
					wp_reset_postdata();
					?>
				<?php else : // Fallback content if no posts exist. ?>
					<div class="hero-content">
						<h2 class="hero-title">A Powerful Headline Grabs the Reader's Attention</h2>
						<p class="hero-excerpt">This is a short, compelling excerpt from the featured article, designed to make the visitor want to click through and read more.</p>
						<a href="#" class="button hero-button">Read The Article</a>
					</div>
					<div class="hero-image">
						<img src="https://picsum.photos/seed/heroside/800/600" alt="Placeholder Image for Hero Section">
					</div>
				<?php endif; ?>
			</div>
		</section>

		<?php // --- LATEST POSTS SECTION --- ?>
		<?php
		$latest_posts_query = new WP_Query( array( 'posts_per_page' => 3, 'offset' => 1, 'ignore_sticky_posts' => true ) );
		?>
		<section class="homepage-section homepage-blog-archive">
			<div class="container">
				<h3 class="section-title"><?php esc_html_e( 'Latest Posts', 'forgepress' ); ?></h3>
				<div class="featured-posts-grid">
					<?php if ( $latest_posts_query->have_posts() ) : ?>
						<?php
						while ( $latest_posts_query->have_posts() ) :
							$latest_posts_query->the_post();
							get_template_part( 'template-parts/content-card' ); // We will create this new template part
						endwhile;
						wp_reset_postdata();
						?>
					<?php else : // Fallback content if less than 4 posts exist. ?>
						<div class="featured-post-card">
							<img src="https://picsum.photos/seed/post4/600/400" alt="Placeholder Image 4">
							<div class="card-content"><span class="card-meta">Category</span><h4 class="card-title">How to Grow Your Audience</h4></div>
						</div>
						<div class="featured-post-card">
							<img src="https://picsum.photos/seed/post5/600/400" alt="Placeholder Image 5">
							<div class="card-content"><span class="card-meta">Category</span><h4 class="card-title">The Art of Storytelling</h4></div>
						</div>
						<div class="featured-post-card">
							<img src="https://picsum.photos/seed/post6/600/400" alt="Placeholder Image 6">
							<div class="card-content"><span class="card-meta">Category</span><h4 class="card-title">A Third Post to Complete the Row</h4></div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</section>

		<?php // --- ABOUT SECTIONS --- ?>
		<section class="homepage-section homepage-about-sections">
			<div class="container about-grid">
				<div class="about-card">
					<h4 class="section-title-small"><?php esc_html_e( 'Why This Blog', 'forgepress' ); ?></h4>
					<p><?php esc_html_e( 'This is a placeholder description explaining the mission and purpose of the blog. This will be editable in the Customizer in a future step.', 'forgepress' ); ?></p>
				</div>
				<div class="about-card">
					<h4 class="section-title-small"><?php esc_html_e( 'Short About Section', 'forgepress' ); ?></h4>
					<p><?php esc_html_e( 'A short, personal bio of the author. This will be editable in the Customizer in a future step.', 'forgepress' ); ?></p>
				</div>
			</div>
		</section>

	</main>
</div>

<?php
get_footer();