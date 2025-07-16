<?php
// phpcs:ignoreFile
/**
 * The sidebar containing the secondary widget area
 *
 * @package ForgePress
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>
<aside id="tertiary" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
</aside>