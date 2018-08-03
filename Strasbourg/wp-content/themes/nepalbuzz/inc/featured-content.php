<?php
/**
 * The template for displaying the Featured Content
 *
 * @package NepalBuzz
 */


if( !function_exists( 'nepalbuzz_featured_content_display' ) ) :
/**
* Add Featured content.
*
* @uses action hook nepalbuzz_before_content.
*
* @since NepalBuzz 0.1
*/
function nepalbuzz_featured_content_display() {
	$options        = nepalbuzz_get_options();
	$enable_content = $options['featured_content_option'];

	if ( nepalbuzz_check_section( $enable_content ) ) {
		$output = '';

		if ( ! $output = get_transient( 'nepalbuzz_featured_content' ) ) {

			$layouts        = $options['featured_content_layout'];
			$headline       = $options['featured_content_headline'];
			$subheadline    = $options['featured_content_subheadline'];

			echo '<!-- refreshing cache -->';

			$classes[] = $layouts;

			$position = $options['featured_content_position'];

			if ( $position ) {
				$classes[] = ' border-top' ;
			}

			$output ='
				<aside id="featured-content" class="' . esc_attr( implode( ' ', $classes ) ) . '" role="complementary">
					<div class="wrapper">
						<section class="widget widget_' . esc_attr( implode( ' ', $classes ) ) . '">';
							if ( !empty( $headline ) || !empty( $subheadline ) ) {
								$output .='<div class="featured-heading-wrap">';
									if ( !empty( $headline ) ) {
										$output .='<h2 id="featured-heading" class="entry-title">' . wp_kses_post( $headline ) . '</h2>';
									}
									if ( !empty( $subheadline ) ) {
										$output .='<p>' . wp_kses_post( $subheadline ) . '</p>';
									}
								$output .='</div><!-- .featured-heading-wrap -->';
							}

							$output .='
							<div class="featured-content-wrap">' . nepalbuzz_page_post_category_content( $options ) . '
							</div><!-- .featured-content-wrap -->
						</section><!-- .widget -->
					</div><!-- .wrapper -->
				</aside><!-- #featured-content -->';
		set_transient( 'nepalbuzz_featured_content', $output, 86940 );
		}
		echo $output;
	}
}
endif;


if ( ! function_exists( 'nepalbuzz_featured_content_display_position' ) ) :
/**
 * Homepage Featured Content Position
 *
 * @action nepalbuzz_content, nepalbuzz_after_secondary
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_featured_content_display_position() {
	// Getting data from Theme Options
	$options  = nepalbuzz_get_options();
	$position = $options['featured_content_position'];

	if ( $position ) {
		add_action( 'nepalbuzz_after_content', 'nepalbuzz_featured_content_display', 30 );
	} else {
		add_action( 'nepalbuzz_before_content', 'nepalbuzz_featured_content_display', 70 );
	}
}
endif; // nepalbuzz_featured_content_display_position
add_action( 'nepalbuzz_before', 'nepalbuzz_featured_content_display_position' );


if ( ! function_exists( 'nepalbuzz_page_post_category_content' ) ) :
	/**
	 * This function to display featured posts/post/category content
	 *
	 * @param $options: nepalbuzz_theme_options from customizer
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_page_post_category_content( $options ) {
		$no_of_post   = 0; // for number of posts
		$post_list    = array();// list of valid post/page ids
		$layouts      = 3;
		$quantity     = $options['featured_content_number'];
		$show_content = $options['featured_content_show'];

		$output     = '<div class="featured_content_slider_wrap">';

		if( 'layout-four' == $options['featured_content_layout'] ) {
			$layouts = 4;
		} elseif ( 'layout-two' == $options['featured_content_layout'] ) {
			$layouts = 2;
		}

		$args = array(
			'post_type'           => 'page',
			'orderby'             => 'post__in',
			'ignore_sticky_posts' => 1 // ignore sticky posts
		);

		//Get valid number of posts
		for( $i = 1; $i <= $quantity; $i++ ){
			$post_id = '';

			$post_id = isset( $options['featured_content_page_' . $i] ) ? $options['featured_content_page_' . $i] : false;

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
		while ( $loop->have_posts()) :
			$loop->the_post();

			$i++;

			$title_attribute = the_title_attribute( 'echo=0' );
			$excerpt         = get_the_excerpt();
			$output .= '
				<article id="featured-post-' . esc_attr( $i ) . '" class="post hentry post">';

				//Default value if there is no first image
				$image = '<img class="wp-post-image" src="'.esc_url( get_template_directory_uri() ).'/images/no-featured-image-350x263.jpg" >';

				if ( has_post_thumbnail() ) {
					$image = get_the_post_thumbnail( get_the_ID(), 'nepalbuzz-featured', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );
				}
				else {
					//Get the first image in page, returns false if there is no image
					$first_image = nepalbuzz_get_first_image( get_the_ID(), 'nepalbuzz-featured', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );

					//Set value of image as first image if there is an image present in the page
					if ( '' != $first_image ) {
						$image = $first_image;
					}
				}

				$output .= '
					<figure class="featured-homepage-image">
						<a href="' . esc_url( get_permalink() ) . '" title="' . $title_attribute . '">
						'. $image .'
						</a>
					</figure>';

				$output .= '
					<div class="entry-container">
						<header class="entry-header">
							<h2 class="entry-title">
								<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . the_title( '','', false ) . '</a>
							</h2>
						</header>';
						if ( 'excerpt' == $show_content ) {
							$output .= '<div class="entry-summary"><p>' . $excerpt . '</p></div><!-- .entry-summary -->';
						}
						elseif ( 'full-content' == $show_content ) {
							$content = apply_filters( 'the_content', get_the_content() );
							$content = str_replace( ']]>', ']]&gt;', $content );
							$output .= '<div class="entry-content">' . $content . '</div><!-- .entry-content -->';
						}
					$output .= '
					</div><!-- .entry-container -->
				</article><!-- .featured-post-'. $i .' -->';
		endwhile;

		wp_reset_postdata();

		return $output;
	}
endif; // nepalbuzz_post_content
