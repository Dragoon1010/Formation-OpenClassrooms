<?php
/**
 * The template for displaying the Slider
 *
 * @package NepalBuzz
 */

if( !function_exists( 'nepalbuzz_featured_slider' ) ) :
/**
 * Add slider.
 *
 * @uses action hook nepalbuzz_before_content.
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_featured_slider() {
	//nepalbuzz_flush_transients();
	// get data value from options
	$options 		= nepalbuzz_get_options();
	$enable_slider 	= $options['featured_slider_option'];

	if ( nepalbuzz_check_section( $enable_slider ) ) {
		$output = '';

		if( ! $output = get_transient( 'nepalbuzz_featured_slider' ) ) {
			echo '<!-- refreshing slider cache -->';
			$output = '
				<div id="feature-slider" class="sections">
					<div class="wrapper">
						<div class="cycle-slideshow"
							    data-cycle-log="false"
							    data-cycle-pause-on-hover="true"
							    data-cycle-swipe="true"
							    data-cycle-fx="'. esc_attr( $options['featured_slider_transition_effect'] ) .'"
								data-cycle-speed="'. esc_attr( $options['featured_slider_transition_length'] ) * 1000 .'"
								data-cycle-timeout="'. esc_attr( $options['featured_slider_transition_delay'] ) * 1000 .'"
								data-cycle-slides="article"
								data-cycle-pager="#per-slide-template"
								>

							    <!-- prev/next links -->
							    <div class="cycle-prev"></div>
							    <div class="cycle-next"></div>' . nepalbuzz_post_page_category_slider( $options ) . '
						</div><!-- .cycle-slideshow -->

						<!-- empty element for pager links -->
    					<div id="per-slide-template" class="center external slide-numbers-' . absint( $options['featured_slider_number'] ) . '"></div>
					</div><!-- .wrapper -->
				</div><!-- #feature-slider -->';

			set_transient( 'nepalbuzz_featured_slider', $output, 86940 );
		}

		echo $output;
	}

}
endif;
add_action( 'nepalbuzz_header', 'nepalbuzz_featured_slider', 70 );


if ( ! function_exists( 'nepalbuzz_post_page_category_slider' ) ) :
	/**
	 * This function to display featured posts/page/category slider
	 *
	 * @param $options: nepalbuzz_theme_options from customizer
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_post_page_category_slider( $options ) {
		$quantity     = $options['featured_slider_number'];
		$no_of_post   = 0; // for number of posts
		$post_list    = array();// list of valid post/page ids
		$show_content = $options['featured_slider_content_show'];
		$output     = '';

		$args = array(
			'post_type'           => 'page',
			'orderby'             => 'post__in',
			'ignore_sticky_posts' => 1 // ignore sticky posts
		);

		//Get valid number of posts
		for( $i = 1; $i <= $quantity; $i++ ){
			$post_id = '';

			$post_id = isset( $options['featured_slider_page_' . $i] ) ? $options['featured_slider_page_' . $i] : false;

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

		while ( $loop->have_posts()) :
			$loop->the_post();

			$title_attribute = the_title_attribute( 'echo=0' );

			$classes = 'slider-image images-' . esc_attr( get_the_ID() ) . ' hentry slides';

			//Adding in Classes for Display block and none
			if ( 0 == $loop->current_post ) {
				$classes .= ' displayblock';
			} else {
				$classes .= ' displaynone';
			}

			//Default value if there is no featurd image or first image
			$image_url = esc_url( get_template_directory_uri() ). '/images/no-featured-image-1920x800.jpg';

			if ( has_post_thumbnail() ) {
				$image_url = get_the_post_thumbnail_url( get_the_ID(), 'nepalbuzz-slider' );
			}
			else {
				//Get the first image in page, returns false if there is no image
				$first_image_url = nepalbuzz_get_first_image( get_the_ID(), 'nepalbuzz-slider', '', true );

				//Set value of image as first image if there is an image present in the page
				if ( '' != $first_image_url ) {
					$image_url = $first_image_url;
				}
			}

			$output .= '
			<article class="' . $classes . '" data-cycle-pager-template="<a class=\'thumbnail thumbnail-1\' style=\'background-image: url(' . esc_url( $image_url ) . ')\'><span class=\'cover\'></span><span class=\'title\'>' . $title_attribute . '</span></a>">
				<div class="slider-image-wrapper">
					<div class="slider-image-thumbnail" style="background-image: url(' . esc_url( $image_url ) . ');"></div>
				</div><!-- .slider-image-wrapper -->

				<div class="slider-content-wrapper">
					<div class="entry-container">
						<header class="entry-header">
							<p class="entry-meta">' . nepalbuzz_default_category() . '</p><!-- .entry-meta -->
							<h2 class="entry-title">
								<a title="' . $title_attribute . '" href="' . esc_url( get_permalink() ) . '">'.the_title( '<span>','</span>', false ).'</a>
							</h2>
						</header>
							';

						if ( 'excerpt' == $show_content ) {
							$excerpt = get_the_excerpt();

							$output .= '<div class="entry-summary"><p>' . $excerpt . '</p></div><!-- .entry-summary -->';
						} elseif ( 'full-content' == $show_content ) {
							$content = apply_filters( 'the_content', get_the_content() );
							$content = str_replace( ']]>', ']]&gt;', $content );
							$output .= '<div class="entry-content">' . $content . '</div><!-- .entry-content -->';
						}

						$output .= '
					</div><!-- .entry-container -->
				</div><!-- .slider-content-wrapper -->
			</article><!-- .slides -->';
		endwhile;

		wp_reset_postdata();

		return $output;
	}
endif; // nepalbuzz_post_page_category_slider
