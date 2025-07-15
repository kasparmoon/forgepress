<?php
// phpcs:ignoreFile
/**
 * The template for displaying the footer
 *
 * @package ForgePress
 */
?>

	</div><footer id="colophon" class="site-footer">
		<nav class="footer-navigation">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'menu_id'        => 'footer-menu',
					'depth'          => 1, // Only show top-level menu items in the footer.
				)
			);
			?>
		</nav>

		<div class="site-info">
			<p>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></p>
		</div></footer></div><?php wp_footer(); ?>

</body>
</html>