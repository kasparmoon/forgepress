<?php
// phpcs:ignoreFile
/**
 * The template for displaying the footer
 *
 * @package ForgePress
 */
?>

	</div></div><footer id="colophon" class="site-footer">
	<div class="footer-inner container">
		<div class="site-info">
			<p>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></p>
		</div><nav class="footer-navigation">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'menu_id'        => 'footer-menu',
					'depth'          => 1,
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>
	</div></footer><?php wp_footer(); ?>

</body>
</html>