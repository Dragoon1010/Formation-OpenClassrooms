<?php
/**
 * Custom CSS addition
 *
 * @package NepalBuzz
 */


if ( ! function_exists( 'nepalbuzz_custom_css' ) ) :
	/**
	 * Enqueue Custon CSS
	 *
	 * @uses  set_transient, wp_head, wp_enqueue_style
	 *
	 * @action wp_enqueue_scripts
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_custom_css() {
		$options    = nepalbuzz_get_options();
		$defaults   = nepalbuzz_default_options();

		$output = '';

		$text_color = get_header_textcolor();

		if ( 'blank' === $text_color ) {
			$output	.= ".site-title a, .site-description { position: absolute !important; clip: rect(1px 1px 1px 1px); clip: rect(1px, 1px, 1px, 1px); }" . "\n";
		} elseif ( get_theme_support( 'custom-header', 'default-text-color' ) !== $text_color ) {
			$output	.=  ".site-title a { color: #" . $text_color . "; }" . "\n";
		}

		$output .= nepalbuzz_header_bg_custom_css();

		if ( '' !== $output ) {
			echo '<!-- refreshing cache -->' . "\n";

			$output = '<!-- ' . get_bloginfo( 'name' ) . ' inline CSS Styles -->' . "\n" . '<style type="text/css" media="screen">' . "\n" . $output;

			$output .= '</style>' . "\n";

		}

		echo $output;
	}
endif; //nepalbuzz_custom_css
add_action( 'wp_head', 'nepalbuzz_custom_css', 101  );


if ( ! function_exists( 'nepalbuzz_header_bg_custom_css' ) ) :
	/**
	 * Header Image Background Custom CSS
	 *
	 *
	 * @action wp_enqueue_scripts
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_header_bg_custom_css() {
		$output = '';

		$header_image  = nepalbuzz_featured_image();

		if ( $header_image ) {
			$output .='.custom-header:before {
                background-image: url( ' . esc_url( $header_image ) . ' );
				background-position: center;
				background-repeat: no-repeat;
				background-size: cover;
				content: "";
				display: block;
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				z-index: -1;
            }';
		}

		return $output;
	}
endif; //nepalbuzz_header_bg_custom_css
