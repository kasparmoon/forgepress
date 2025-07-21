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

<div id="primary" class="content-area container">
	<main id="main" class="site-main">

		<?php // --- HERO SECTION --- ?>
		<section class="homepage-section homepage-hero">
			<div class="hero-grid">
				<div class="hero-content">
					<h2 class="hero-title">A Powerful Headline Grabs the Reader's Attention</h2>
					<p class="hero-excerpt">This is a short, compelling excerpt from the featured article, designed to make the visitor want to click through and read more.</p>
					<a href="#" class="button hero-button">Read The Article</a>
				</div>
				<div class="hero-image">
					<img src="https://picsum.photos/seed/heroside/800/600" alt="Placeholder Image for Hero Section">
				</div>
			</div>
		</section>

		<?php // --- BLOG ARCHIVE SECTION --- ?>
		<section class="homepage-section homepage-blog-archive">
			<h3 class="section-title">Latest Posts</h3>
			<div class="featured-posts-grid">
				<div class="featured-post-card">
					<img src="https://picsum.photos/seed/post4/600/400" alt="Placeholder Image 4">
					<div class="card-content">
						<span class="card-meta">Category</span>
						<h4 class="card-title">How to Grow Your Audience with Strategic Content</h4>
					</div>
				</div>
				<div class="featured-post-card">
					<img src="https://picsum.photos/seed/post5/600/400" alt="Placeholder Image 5">
					<div class="card-content">
						<span class="card-meta">Category</span>
						<h4 class="card-title">The Art of Storytelling in Digital Marketing</h4>
					</div>
				</div>
				<div class="featured-post-card">
					<img src="https://picsum.photos/seed/post6/600/400" alt="Placeholder Image 6">
					<div class="card-content">
						<span class="card-meta">Category</span>
						<h4 class="card-title">A Third Post to Complete the Row of Three</h4>
					</div>
				</div>
			</div>
		</section>

		<?php // --- ABOUT SECTIONS --- ?>
		<section class="homepage-section homepage-about-sections">
			<div class="about-grid">
				<div class="about-card">
					<h4 class="section-title-small">Why This Blog</h4>
					<p>This is a placeholder description explaining the mission and purpose of the blog.</p>
				</div>
				<div class="about-card">
					<h4 class="section-title-small">Short About Section</h4>
					<p>A short, personal bio of the author goes here to build a personal connection.</p>
				</div>
			</div>
		</section>

	</main>
</div>

<?php
get_footer();