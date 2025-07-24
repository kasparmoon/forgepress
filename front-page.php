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
		if ( $hero_query->have_posts() ) :
			while ( $hero_query->have_posts() ) :
				$hero_query->the_post();
				// ... (The hero section loop content remains the same) ...
			endwhile;
			wp_reset_postdata();
		else :
			// ... (The hero section fallback content remains the same) ...
		endif;
		?>

		<?php // --- LATEST POSTS SECTION --- ?>
		<?php
		$latest_posts_query = new WP_Query( array( 'posts_per_page' => 3, 'offset' => 1, 'ignore_sticky_posts' => true ) );
		if ( $latest_posts_query->have_posts() ) :
			?>
			<section class="homepage-section homepage-blog-archive">
				<div class="container">
					<h3 class="section-title"><?php esc_html_e( 'Latest Posts', 'forgepress' ); ?></h3>
					<div class="featured-posts-grid">
						<?php
						while ( $latest_posts_query->have_posts() ) :
							$latest_posts_query->the_post();
							get_template_part( 'template-parts/content-card' );
						endwhile;
						wp_reset_postdata();
						?>
					</div>
				</div>
			</section>
			<?php
		endif;
		?>

		<?php // --- ABOUT SECTIONS (NOW DYNAMIC) --- ?>
		<section class="homepage-section homepage-about-sections">
			<div class="container about-grid">
				<div class="about-card">
					<h4 class="section-title-small"><?php esc_html_e( 'Why This Blog', 'forgepress' ); ?></h4>
					<p><?php echo wp_kses_post( get_theme_mod( 'forgepress_homepage_why_text', 'This is a placeholder description explaining the mission and purpose of the blog. It connects with the target audience and tells them what kind of value they can expect to find here.' ) ); ?></p>
				</div>
				<div class="about-card">
					<h4 class="section-title-small"><?php esc_html_e( 'Short About Section', 'forgepress' ); ?></h4>
					<p><?php echo wp_kses_post( get_theme_mod( 'forgepress_homepage_about_text', 'A short, personal bio of the author. This is where you build a personal connection with your readers by sharing a bit about your journey, your expertise, and your passion for the subject matter.' ) ); ?></p>
				</div>
			</div>
		</section>

	</main>
</div>

<?php
get_footer();