<?php
/**
 * The template for displaying the News Ticker
 *
 * @package NepalBuzz
 */


if( !function_exists( 'nepalbuzz_news_ticker' ) ) :
/**
* Add News Ticker
*
* @since NepalBuzz 0.1
*/
function nepalbuzz_news_ticker() {
	// get data value from options
	$options        = nepalbuzz_get_options();
	$enable_content = $options['news_ticker_option'];

	if ( nepalbuzz_check_section( $enable_content ) ) {
		$output = '';
		if ( ! $output = get_transient( 'nepalbuzz_news_ticker' ) ) {
			echo '<!-- refreshing cache -->';

			$headline = $options['news_ticker_label'];

			$output ='
				<div id="news-ticker" class="page">
					<div class="wrapper">';
						if ( !empty( $headline ) ) {
							$output .='<h3 class="news-ticker-label">' . wp_kses_post( $headline ) . '</h3>';
						}
						$output .='

						<div class="new-ticket-content">
							<div class="news-ticker-slider cycle-slideshow"
							    data-cycle-log="false"
							    data-cycle-pause-on-hover="true"
							    data-cycle-swipe="true"
							    data-cycle-auto-height=container
								data-cycle-slides="> h3"
								data-cycle-fx="'. esc_attr( $options['news_ticker_transition_effect'] ) .'"
								>' . nepalbuzz_post_page_category_ticker( $options ) . '
							</div><!-- .news-ticker-slider -->
						</div><!-- .new-ticket-content -->
					</div><!-- .wrapper -->
				</div><!-- #news-ticker -->';
			set_transient( 'nepalbuzz_news_ticker', $output, 86940 );
		}

		echo $output;
	}

}
endif;
add_action( 'nepalbuzz_before_content', 'nepalbuzz_news_ticker', 40 );


if ( ! function_exists( 'nepalbuzz_post_page_category_ticker' ) ) :
	/**
	 * This function to display featured posts content
	 *
	 * @param $options: nepalbuzz_theme_options from customizer
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_post_page_category_ticker( $options ) {
		$no_of_post = 0; // for number of posts
		$post_list  = array();// list of valid post/page ids
		$quantity   = $options['news_ticker_number'];
		$output     = '';

		$args = array(
			'post_type'           => 'page',
			'orderby'             => 'post__in',
			'ignore_sticky_posts' => 1 // ignore sticky posts
		);

		//Get valid number of posts
		for( $i = 1; $i <= $quantity; $i++ ){
			$post_id = '';

			$post_id = isset( $options['news_ticker_page_' . $i] ) ? $options['news_ticker_page_' . $i] : false;

			if ( $post_id && '' != $post_id ) {
				$post_list = array_merge( $post_list, array( $post_id ) );

				$no_of_post++;
			}
		}

		$args['post__in'] = $post_list;

		if ( 0 == $no_of_post ) {
			return;
		}

		$args['posts_per_page'] = $no_of_post;

		$loop = new WP_Query( $args );

		$i=0;

		while ( $loop->have_posts() ) {
			$loop->the_post();

			$classes = 'new-ticker-text text-' .  $i . ' news-ticker-title displaynone';

			if ( 1 === $i ) {
				$classes = 'new-ticker-text text-' . $i . ' news-ticker-title displayblock';
			}

			$output .= '
			<h3 class="' . $classes . '">
				<a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a>
			</h3>';

			$i++;
		} // End while().

		wp_reset_postdata();

		return $output;
	}
endif; // nepalbuzz_post_content
