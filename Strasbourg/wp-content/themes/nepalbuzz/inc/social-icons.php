<?php
/**
 * The template for displaying Social Icons
 *
 * @package NepalBuzz
 */


if ( ! function_exists( 'nepalbuzz_get_social_icons' ) ) :
/**
 * Generate social icons.
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_get_social_icons(){
	if( ( !$output = get_transient( 'nepalbuzz_social_icons' ) ) ) {
		$output  = '';
		$options = nepalbuzz_get_options(); // Get options

		//Pre defined Social Icons Link Start
		$pre_def_icons = nepalbuzz_get_social_icons_list();
		foreach ( $pre_def_icons as $key => $item ) {
			if( isset( $options[ $key ] ) && '' != $options[ $key ] ) {
				$value = $options[ $key ];
				if ( 'email_link' == $key  ) {
					$output .= '<a class="fa fa-'. sanitize_key( $item['fa_class'] ) .'" target="_blank" title="'. esc_attr__( 'Email', 'nepalbuzz') . '" href="mailto:'. esc_attr( antispambot( sanitize_email( $value ) ) ) .'"><span class="screen-reader-text">'. esc_html__( 'Email', 'nepalbuzz') . '</span> </a>';
				}
				else if ( 'skype_link' == $key  ) {
					$output .= '<a class="fa fa-'. sanitize_key( $item['fa_class'] ) .'" target="_blank" title="'. esc_attr( $item['label'] ) . '" href="'. esc_attr( $value ) .'"><span class="screen-reader-text">'. esc_attr( $item['label'] ). '</span> </a>';
				}
				else if ( 'phone_link' == $key || 'handset_link' == $key ) {
					$output .= '<a class="fa fa-'. sanitize_key( $item['fa_class'] ) .'" target="_blank" title="'. esc_attr( $item['label'] ) . '" href="tel:' . preg_replace( '/\s+/', '', esc_attr( $value ) ) . '"><span class="screen-reader-text">'. esc_attr( $item['label'] ) . '</span> </a>';
				}
				else {
					$output .= '<a class="fa fa-'. sanitize_key( $item['fa_class'] ) .'" target="_blank" title="'. esc_attr( $item['label'] ) .'" href="'. esc_url( $value ) .'"><span class="screen-reader-text">'. esc_attr( $item['label'] ) .'</span> </a>';
				}
			}
		}
		//Pre defined Social Icons Link End
		//
		set_transient( 'nepalbuzz_social_icons', $output, 86940 );
	}
	return $output;
} // nepalbuzz_get_social_icons
endif;
