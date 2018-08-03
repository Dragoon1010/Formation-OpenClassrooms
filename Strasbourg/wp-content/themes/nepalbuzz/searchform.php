<?php
/**
 * The template for displaying search form
 *
 * @package NepalBuzz
 */
?>

<?php $options  = nepalbuzz_get_options(); // Get options. ?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label','nepalbuzz' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr( $options['search_text'] ); ?>" value="<?php the_search_query(); ?>" name="s" title="<?php echo esc_attr( _x( 'Search for:', 'label', 'nepalbuzz' ) ); ?>">
	</label>
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'nepalbuzz' ); ?>">
</form>
