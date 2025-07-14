<?php
// phpcs:ignoreFile
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package ForgePress
 */
?>

	</div>
	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
		</div>
	</footer>
</div>
<?php wp_footer(); ?>

</body>
</html>