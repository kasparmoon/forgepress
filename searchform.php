<?php
// phpcs:ignoreFile
/**
 * The template for displaying search forms in ForgePress
 *
 * @package ForgePress
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="s" class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'forgepress' ); ?></label>
	<input type="search" id="s" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'forgepress' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit"><span class="dashicons dashicons-search"></span><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'forgepress' ); ?></span></button>
</form>