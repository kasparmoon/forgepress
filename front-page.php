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
		<section class="homepage-section homepage-hero">
			<div class="container">
				<div class="hero-content">
					<span class="hero-meta">Featured Post / Category</span>
					<h2 class="hero-title">A Powerful Headline Grabs the Reader's Attention</h2>
					<p class="hero-excerpt">This is a short, compelling excerpt from the featured article, designed to make the visitor want to click through and read more.</p>
					<a href="#" class="button hero-button">Read The Article</a>
				</div>
			</div>
		</section>

		<?php // --- FEATURED POSTS GRID SECTION --- ?>
		<section class="homepage-section homepage-featured-posts">
			<div class="container">
				<h3 class="section-title">Featured Posts</h3>
				<div class="featured-posts-grid">
					<div class="featured-post-card">
						<img src="https://picsum.photos/seed/post1/600/400" alt="Placeholder Image 1">
						<div class="card-content">
							<span class="card-meta">Category</span>
							<h4 class="card-title">Optimizing Your Workflow for Maximum Productivity</h4>
						</div>
					</div>
					<div class="featured-post-card">
						<img src="https://picsum.photos/seed/post2/600/400" alt="Placeholder Image 2">
						<div class="card-content">
							<span class="card-meta">Category</span>
							<h4 class="card-title">A Guide to Modern, Minimalist Web Design</h4>
						</div>
					</div>
					<div class="featured-post-card">
						<img src="https://picsum.photos/seed/post3/600/400" alt="Placeholder Image 3">
						<div class="card-content">
							<span class="card-meta">Category</span>
							<h4 class="card-title">The Top 10 Tools for Content Creators in 2025</h4>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php // --- BLOG ARCHIVE SECTION --- ?>
		<section class="homepage-section homepage-blog-archive">
			<div class="container">
				<h3 class="section-title">Latest From The Blog</h3>
				<div class="blog-archive-grid">
					<div class="blog-post-item">
						<div class="post-item-content">
							<span class="card-meta">Category</span>
							<h4 class="card-title">How to Grow Your Audience with Strategic Content</h4>
							<p class="post-item-excerpt">An engaging excerpt goes here, providing a glimpse into the article and encouraging readers to learn more...</p>
							<span class="post-item-meta">July 21, 2025 · 5 min read</span>
						</div>
					</div>
					<div class="blog-post-item">
						<div class="post-item-content">
							<span class="card-meta">Category</span>
							<h4 class="card-title">The Art of Storytelling in Digital Marketing</h4>
							<p class="post-item-excerpt">An engaging excerpt goes here, providing a glimpse into the article and encouraging readers to learn more...</p>
							<span class="post-item-meta">July 20, 2025 · 7 min read</span>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php // --- ABOUT SECTIONS --- ?>
		<section class="homepage-section homepage-about-sections">
			<div class="container">
				<div class="about-grid">
					<div class="about-card">
						<h4 class="section-title">Why This Blog?</h4>
						<p>This is a placeholder description explaining the mission and purpose of the blog. It connects with the target audience and tells them what kind of value they can expect to find here.</p>
					</div>
					<div class="about-card">
						<h4 class="section-title">About The Blogger</h4>
						<p>A short, personal bio of the author. This is where you build a personal connection with your readers by sharing a bit about your journey, your expertise, and your passion for the subject matter.</p>
					</div>
				</div>
			</div>
		</section>

	</main>
</div>

<?php
get_footer();