<?php
/**
 * Active callbacks for Theme/Customzer Options
 *
 * @package NepalBuzz
 */

if( ! function_exists( 'nepalbuzz_is_slider_active' ) ) :
	/**
	* Return true if slider is active
	*
	* @since  NepalBuzz 0.1
	*/
	function nepalbuzz_is_slider_active( $control ) {
		$enable = $control->manager->get_setting( 'nepalbuzz_theme_options[featured_slider_option]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected
		return ( nepalbuzz_check_section( $enable ) );
	}
endif;


if( ! function_exists( 'nepalbuzz_is_featured_content_active' ) ) :
	/**
	* Return true if featured content is active
	*
	* @since  NepalBuzz 0.1
	*/
	function nepalbuzz_is_featured_content_active( $control ) {
		$enable = $control->manager->get_setting( 'nepalbuzz_theme_options[featured_content_option]' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( nepalbuzz_check_section( $enable ) );
	}
endif;


if( ! function_exists( 'nepalbuzz_is_news_ticker_active' ) ) :
	/**
	* Return true if news ticker is active
	*
	* @since  NepalBuzz 0.1
	*/
	function nepalbuzz_is_news_ticker_active( $control ) {
		$enable = $control->manager->get_setting( 'nepalbuzz_theme_options[news_ticker_option]' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( nepalbuzz_check_section( $enable ) );
	}
endif;
