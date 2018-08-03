<?php
/**
 * Implement Custom Header functionality
 *
 * @package NepalBuzz
 */


if ( ! function_exists( 'nepalbuzz_custom_header' ) ) :
/**
 * Implementation of the Custom Header feature
 * Setup the WordPress core custom header feature and default custom headers packaged with the theme.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
	function nepalbuzz_custom_header() {
		/**
		 * Get Theme Options Values
		 */
		$options 	= nepalbuzz_get_options();

		$default_image = trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'images/header-1920x720.jpg';

		if ( function_exists( 'get_parent_theme_file_uri' ) ) {
			$default_image =  get_parent_theme_file_uri( '/images/header-1920x720.jpg' );
		}

		$args = array(
			'default-text-color' => '#cc2b3a',
			'default-image'      => $default_image,
			'width'              => 1920,
			'height'             => 1080,
			'flex-height'        => true,
			'flex-width'         => true,
			'video'              => true,
		);

		$args = apply_filters( 'custom-header', $args );

		// Add support for custom header
		add_theme_support( 'custom-header', $args );

		register_default_headers( array(
			'default-image' => array(
				'url'           => '%s/images/header-1920x720.jpg',
				'thumbnail_url' => '%s/images/header-275x103.jpg',
				'description'   => esc_html__( 'Default Header Image', 'nepalbuzz' ),
			),
		) );

	}
endif; // nepalbuzz_custom_header
add_action( 'after_setup_theme', 'nepalbuzz_custom_header' );


if ( ! function_exists( 'nepalbuzz_header_media_status' ) ) :
	/**
	 * Send status of header media
	 *
	 * @since NepalBuzz Pro 1.0
	 */
	function nepalbuzz_header_media_status() {
		global $post, $wp_query;

		//Check if header image is active or not
		$header_image = nepalbuzz_featured_image();

		$options = nepalbuzz_get_options();
		$enable  = $options['enable_featured_header_image'];

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		$page_for_posts = get_option('page_for_posts');

		// Check Enable/Disable header image in Page/Post Meta box
		if ( is_singular() ) {
			//Individual Page/Post Image Setting
			$individual_featured_image = get_post_meta( $post->ID, 'nepalbuzz-header-image', true );

			$enable = $individual_featured_image;
		}

		if ( $header_image || ( ( 'enable' == $enable || 'homepage' == $enable || 'entire-site' == $enable || 'entire-site-page-post' == $enable ) && has_header_video() && is_header_video_active() ) ) {
			return true;
		}

		return false;
	} // nepalbuzz_header_media_status
endif;


if ( ! function_exists( 'nepalbuzz_featured_page_post_image' ) ) :
	/**
	 * Template for Featured Header Image from Post and Page
	 *
	 * To override this in a child theme
	 * simply create your own nepalbuzz_featured_imaage_pagepost(), and that function will be used instead.
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_featured_page_post_image() {
		global $post, $wp_query;

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();
		$page_for_posts = get_option('page_for_posts');

		$header_page_id = '';

		$image = get_header_image();

		if ( get_post() ) {
			if ( is_home() && $page_for_posts == $page_id ) {
				$header_page_id = $page_id;
			}
			else {
				$header_page_id = $post->ID;
			}
		}

		if ( has_post_thumbnail( $header_page_id ) ) {
			$options             = nepalbuzz_get_options();
			$featured_image_size = $options['featured_image_size'];
			$feat_image          = wp_get_attachment_image_src( get_post_thumbnail_id( $header_page_id ), $featured_image_size );

			$image = $feat_image[0];
		}

		return $image;
	} // nepalbuzz_featured_page_post_image
endif;


if ( ! function_exists( 'nepalbuzz_featured_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own nepalbuzz_featured_image(), and that function will be used instead.
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_featured_image() {
		global $post, $wp_query;
		$options             = nepalbuzz_get_options();
		$enable_header_image = $options['enable_featured_header_image'];
		$header_image        = get_header_image();
		$image               = false;

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		$page_for_posts = get_option('page_for_posts');

		// Check Enable/Disable header image in Page/Post Meta box
		if ( is_page() || is_single() ) {
			//Individual Page/Post Image Setting
			$individual_featured_image = get_post_meta( $post->ID, 'nepalbuzz-header-image', true );

			if ( 'disable' == $individual_featured_image || ( 'default' == $individual_featured_image && 'disable' == $enable_header_image ) ) {
				return false;
			}
			elseif ( 'enable' == $individual_featured_image ) {
				$image = nepalbuzz_featured_page_post_image();

				return $image;
			}
		}

		// Check Homepage
		if ( 'homepage' == $enable_header_image  ) {
			if ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) {
				$image = $header_image;
			}
		}
		// Check Excluding Homepage
		elseif ( 'exclude-home' == $enable_header_image  ) {
			if ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) {
				return false;
			}
			else {
				$image = $header_image;
			}
		}
		elseif ( 'exclude-home-page-post' == $enable_header_image  ) {
			if ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) {
				return false;
			}
			elseif ( is_page() || is_single() ) {
				$image = nepalbuzz_featured_page_post_image();
			}
			else {
				$image = $header_image;
			}
		}
		// Check Entire Site
		elseif ( 'entire-site' == $enable_header_image  ) {
			$image = $header_image;
		}
		// Check Entire Site (Post/Page)
		elseif ( 'entire-site-page-post' == $enable_header_image  ) {
			if ( is_page() || is_single() ) {
				$image = nepalbuzz_featured_page_post_image();
			}
			else {
				$image = $header_image;
			}
		}
		// Check Page/Post
		elseif ( 'pages-posts' == $enable_header_image  ) {
			if ( is_page() || is_single() ) {
				$image = nepalbuzz_featured_page_post_image();
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}

		return $image;
	} // nepalbuzz_featured_image
endif;

if ( ! function_exists( 'nepalbuzz_header_div' ) ) :
	/**
	 * Display Featured Header Image div
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_header_div() {
		$status = nepalbuzz_header_media_status();

		if ( $status ) {
			global $post;

			$header_image = nepalbuzz_featured_image();

			$options             = nepalbuzz_get_options();
			$title               = $options['featured_header_title'];
			$content             = $options['featured_header_content'];
			$button_text         = $options['featured_header_button_text'];
			$button_link         = $options['featured_header_button_link'];
			$button_target       = $options['featured_header_button_target'];
			$enable_header_image = $options['enable_featured_header_image'];

			if ( is_page() || is_single() ) {
				//Individual Page/Post Image Setting
				$individual_featured_image = get_post_meta( $post->ID, 'nepalbuzz-header-image', true );

				if ( 'disable' == $individual_featured_image || ( 'default' == $individual_featured_image && 'disable' == $enable_header_image ) ) {
					echo '<!-- Page/Post Disable Header Image -->';
					return false;
				}
			}

			$button_target_value = '_self';

			if ( $button_target ) {
				$button_target_value = '_blank';
			}

			$classes = array();

			$default_image = trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'images/header-1920x1080.jpg';

			if ( function_exists( 'get_parent_theme_file_uri' ) ) {
				$default_image =  get_parent_theme_file_uri( '/images/header-1920x1080.jpg' );
			}

			echo '<div class="custom-header">';

			if ( 'video' == $header_image ) {
				$classes[] = 'video';
			} else if ( $default_image == $header_image ) {
				$classes[] = 'default';
			}

			if ( has_custom_header() ) {
				echo '<div class="custom-header-media">';
						the_custom_header_markup();
				echo '</div>';
			}

			echo '
				<div class="custom-header-content ' . esc_attr( implode( ' ', $classes ) ) . '">
					<article class="hentry header-image">
						<div class="entry-container">';
							if ( '' != $title ) {
								echo '
								<header class="entry-header">
									<h2 class="entry-title">
										<a href="' . esc_url( $button_link ) . '" target="' . esc_attr( $button_target_value ) . '">' . wp_kses_post( $title ) . '</a>
									</h2>
								</header>';
							}

							if ( '' != $content || '' != $button_text ) {
								echo '
								<div class="entry-content"><p>
									' . $content;

								if ( '' != $button_text ) {
									echo '<span class="more-button"><a class="more-link" href="' . esc_url( $button_link ) . '" target="' . esc_attr( $button_target_value ) . '">'. esc_html( $button_text ) .'</a></span>';
								}
								echo '</p></div>';
							}

						echo '
						</div><!-- .entry-container -->
					</article><!-- .hentry.header-image -->
				</div><!-- #header-featured-image -->
			</div><!-- .custom-header -->';
		}
	} // nepalbuzz_header_div
endif;
add_action( 'nepalbuzz_header', 'nepalbuzz_header_div', 60 );


if ( ! function_exists( 'nepalbuzz_site_branding' ) ) :
	/**
	 * Get the logo and display
	 *
	 * @uses get_transient, nepalbuzz_get_options, get_header_textcolor, get_bloginfo, set_transient, display_header_text
	 * @get logo from options
	 *
	 * @display logo
	 *
	 * @action
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_site_branding() {
		$options 			= nepalbuzz_get_options();

		$site_logo = '';

		//Checking Logo
		if ( function_exists( 'has_custom_logo' ) ) {
			if ( has_custom_logo() ) {
				$site_logo = '
				<div id="site-logo">'. get_custom_logo() . '</div><!-- #site-logo -->';
			}
		}

		$header_text = '<div id="site-header">';
			if ( is_front_page() ) :
				$header_text .= '<h1 class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . get_bloginfo( 'name' ) . '</a></h1>';
			else :
				$header_text .= '<p class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . get_bloginfo( 'name' ) . '</a></p>';
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) :
				$header_text .= '<p class="site-description">' . $description . '</p>';
			endif;
		$header_text .= '</div><!-- #site-header -->';


		$text_color = get_header_textcolor();
		if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
			if ( ! $options['move_title_tagline'] && 'blank' != $text_color ) {
				$site_branding  = '<div class="site-branding logo-left">';
				$site_branding .= $site_logo;
				$site_branding .= $header_text;
			}
			else {
				$site_branding  = '<div class="site-branding logo-right">';
				$site_branding .= $header_text;
				$site_branding .= $site_logo;
			}

		}
		else {
			$site_branding	= '<div class="site-branding">';
			$site_branding	.= $header_text;
		}

		$site_branding 	.= '</div><!-- .site-branding-->';

		echo $site_branding ;
	}
endif; // nepalbuzz_site_branding
add_action( 'nepalbuzz_header', 'nepalbuzz_site_branding', 30 );


/**
 * Customize video play/pause button in the custom header.
 */
function nepalbuzz_video_controls( $settings ) {
	$settings['l10n']['play'] = '<span class="screen-reader-text">' . esc_html__( 'Play background video', 'nepalbuzz' ) . '</span>';
	$settings['l10n']['pause'] = '<span class="screen-reader-text">' . esc_html__( 'Pause background video', 'nepalbuzz' ) . '</span>';
	return $settings;
}
add_filter( 'header_video_settings', 'nepalbuzz_video_controls' );
