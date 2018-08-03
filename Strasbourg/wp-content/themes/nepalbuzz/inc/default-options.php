<?php
/**
 * Implement Default Theme/Customizer Options
 *
 * @package NepalBuzz
 */


/**
 * Returns the default options for NepalBuzz.
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_default_options() {
	$theme_data = wp_get_theme();

	$options = array(
		//Site Title an Tagline
		'move_title_tagline'                               => 0,

		//Layout
		'theme_layout'                                     => 'three-columns-content-left',
		'single_layout'                                    => 'no-sidebar',
		'content_layout'                                   => 'excerpt-image-top',
		'single_post_image_layout'                         => 'disabled',
		'hide_archive_footer_meta'                         => 1,

		//Header Image
		'enable_featured_header_image'                     => 'entire-site-page-post',
		'featured_image_size'                              => 'full',
		'featured_header_title'                            => esc_html( get_bloginfo( 'name') ),
		'featured_header_content'                          => esc_html( get_bloginfo( 'description' ) ),
		'featured_header_button_text'                      => esc_html__( 'Continue Reading', 'nepalbuzz' ),
		'featured_header_button_link'                      => '#',
		'featured_header_button_target'                    => 0,

		'featured_header_image_url'                        => '',
		'featured_header_image_alt'                        => '',
		'featured_header_image_base'                       => 0,

		//Breadcrumb Options
		'breadcrumb_option'                                => 0,
		'breadcrumb_on_homepage'                           => 0,
		'breadcrumb_seperator'                             => '&raquo;',

		//Scrollup Options
		'disable_scrollup'                                 => 0,

		//Excerpt Options
		'excerpt_length'                                   => '45',
		'excerpt_more_text'                                => esc_html__( 'Continue Reading', 'nepalbuzz' ),

		//Homepage / Frontpage Settings
		'front_page_category'                              => '0',

		//Pagination Options
		'pagination_type'                                  => 'default',

		//Promotion Headline Options
		'promotion_headline_option'                        => 'disabled',
		'promotion_headline'                               => esc_html__( 'NepalBuzz is a Responsive WordPress Theme', 'nepalbuzz' ),
		'promotion_subheadline'                            => esc_html__( 'This is promotion headline.', 'nepalbuzz' ),
		'promotion_headline_button'                        => esc_html__( 'Buy Now', 'nepalbuzz' ),
		'promotion_headline_url'                           => '#',
		'promotion_headline_target'                        => 1,

		//Search Options
		'search_text'                                      => esc_html__( 'Search...', 'nepalbuzz' ),

		//Font Family Options
		'body_font'                                        => 'merriweather',
		'title_font'                                       => 'oswald',
		'tagline_font'                                     => 'merriweather',
		'menu_font'                                        => 'oswald',
		'content_title_font'                               => 'oswald',
		'content_font'                                     => 'merriweather',
		'headings_font'                                    => 'oswald',
		'reset_typography'                                 => 0,

		//Featured Content Options
		'featured_content_option'                          => 'disabled',
		'featured_content_layout'                          => 'layout-four',
		'featured_content_position'                        => 1,
		'featured_content_headline'                        => '',
		'featured_content_subheadline'                     => '',
		'featured_content_number'                          => '3',
		'featured_content_select_category'                 => array(),
		'featured_content_show'                            => 'excerpt',

		//News Ticker Options
		'news_ticker_option'                               => 'disabled',
		'news_ticker_label'                                => '',
		'news_ticker_transition_effect'                    => 'flipVert',
		'news_ticker_number'                               => '4',
		'news_ticker_select_category'                      => array(),

		//Featured Slider Options
		'featured_slider_option'                           => 'disabled',
		'featured_slider_transition_effect'                => 'fadeout',
		'featured_slider_transition_delay'                 => '4',
		'featured_slider_transition_length'                => '1',
		'featured_slider_number'                           => '4',
		'featured_slider_content_show'                     => 'excerpt',
		'featured_slider_select_category'                  => array(),

		//Reset all settings
		'reset_all_settings'                               => 0,
	);

	return apply_filters( 'nepalbuzz_default_theme_options', $options );
}

/**
 * Returns an array of layout options registered for NepalBuzz.
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_layouts() {
	$layout_options = array(
		'three-columns-content-left' => esc_html__( 'Three Columns ( Content, Secondary Sidebar, Primary Sidebar )', 'nepalbuzz' ),
		'right-sidebar'              => esc_html__( 'Content, Primary Sidebar', 'nepalbuzz' ),
		'no-sidebar'                 => esc_html__( 'No Sidebar ( Content Width )', 'nepalbuzz' ),
		);
	return apply_filters( 'nepalbuzz_layouts', $layout_options );
}


/**
 * Returns an array of content layout options registered for NepalBuzz.
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_get_archive_content_layout() {
	$layout_options = array(
		'excerpt-image-top'   => esc_html__( 'Excerpt Image Top', 'nepalbuzz' ),
		'full-content'        => esc_html__( 'Show Full Content (No Featured Image)', 'nepalbuzz' ),
	);

	return apply_filters( 'nepalbuzz_get_archive_content_layout', $layout_options );
}


/**
 * Returns an array of feature header enable options
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_enable_featured_header_image_options() {
	$options = array(
		'homepage'               => esc_html__( 'Homepage / Frontpage', 'nepalbuzz' ),
		'exclude-home'           => esc_html__( 'Excluding Homepage', 'nepalbuzz' ),
		'exclude-home-page-post' => esc_html__( 'Excluding Homepage, Page/Post Featured Image', 'nepalbuzz' ),
		'entire-site'            => esc_html__( 'Entire Site', 'nepalbuzz' ),
		'entire-site-page-post'  => esc_html__( 'Entire Site, Page/Post Featured Image', 'nepalbuzz' ),
		'pages-posts'            => esc_html__( 'Pages and Posts', 'nepalbuzz' ),
		'disabled'               => esc_html__( 'Disabled', 'nepalbuzz' ),
	);

	return apply_filters( 'nepalbuzz_enable_featured_header_image_options', $options );
}


/**
 * Returns an array of content and slider layout options registered for NepalBuzz.
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_featured_section_options() {
	$options = array(
		'homepage'    => esc_html__( 'Homepage / Frontpage', 'nepalbuzz' ),
		'entire-site' => esc_html__( 'Entire Site', 'nepalbuzz' ),
		'disabled'    => esc_html__( 'Disabled', 'nepalbuzz' ),
	);

	return apply_filters( 'nepalbuzz_featured_section_options', $options );
}


/**
 * Returns an array of featured content options registered for NepalBuzz.
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_featured_content_layout_options() {
	$options = array(
		'layout-two'   => esc_html__( '2 columns', 'nepalbuzz' ),
		'layout-three' => esc_html__( '3 columns', 'nepalbuzz' ),
		'layout-four'  => esc_html__( '4 columns', 'nepalbuzz' ),
	);

	return apply_filters( 'nepalbuzz_featured_content_layout_options', $options );
}


/**
 * Returns an array of featured content show registered for NepalBuzz.
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_featured_content_show() {
	$options = array(
		'excerpt'      => esc_html__( 'Show Excerpt', 'nepalbuzz' ),
		'full-content' => esc_html__( 'Show Full Content', 'nepalbuzz' ),
		'hide-content' => esc_html__( 'Hide Content', 'nepalbuzz' ),
	);

	return apply_filters( 'nepalbuzz_featured_content_show', $options );
}


/**
 * Returns an array of feature slider transition effects
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_featured_slider_transition_effects() {
	$options = array(
		'fade'       => esc_html__( 'Fade', 'nepalbuzz' ),
		'fadeout'    => esc_html__( 'Fade Out', 'nepalbuzz' ),
		'none'       => esc_html__( 'None', 'nepalbuzz' ),
		'scrollHorz' => esc_html__( 'Scroll Horizontal', 'nepalbuzz' ),
		'scrollVert' => esc_html__( 'Scroll Vertical', 'nepalbuzz' ),
		'flipHorz'   => esc_html__( 'Flip Horizontal', 'nepalbuzz' ),
		'flipVert'   => esc_html__( 'Flip Vertical', 'nepalbuzz' ),
		'tileSlide'  => esc_html__( 'Tile Slide', 'nepalbuzz' ),
		'tileBlind'  => esc_html__( 'Tile Blind', 'nepalbuzz' ),
		'shuffle'    => esc_html__( 'Shuffle', 'nepalbuzz' ),
	);

	return apply_filters( 'nepalbuzz_featured_slider_transition_effects', $options );
}

/**
 * Returns an array of pagination types registered for NepalBuzz.
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_get_pagination_types() {
	$options = array(
		'default'                => esc_html__( 'Default(Older Posts/Newer Posts)', 'nepalbuzz' ),
		'numeric'                => esc_html__( 'Numeric', 'nepalbuzz' ),
		'infinite-scroll-click'  => esc_html__( 'Infinite Scroll (Click)', 'nepalbuzz' ),
		'infinite-scroll-scroll' => esc_html__( 'Infinite Scroll (Scroll)', 'nepalbuzz' ),
	);

	return apply_filters( 'nepalbuzz_get_pagination_types', $options );
}


/**
 * Returns an array of content featured image size.
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_image_sizes_options() {
	$all_sizes = nepalbuzz_get_additional_image_sizes();

	foreach ($all_sizes as $key => $value) {
		$options[$key] = esc_html( $key ).' ('.$value['width'].'x'.$value['height'].')';
	}

	$options['disabled'] = esc_html__( 'Disabled', 'nepalbuzz' );
	$options['full']     = esc_html__( 'Full size', 'nepalbuzz' );

	return apply_filters( 'nepalbuzz_image_sizes_options', $options );
}


/**
 * Returns an array of avaliable fonts registered for NepalBuzz.
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_avaliable_fonts() {
	$options = array(
		'arial-black' => array(
			'value' => 'arial-black',
			'label' => '"Arial Black", Gadget, sans-serif',
		),
		'allan' => array(
			'value' => 'allan',
			'label' => '"Allan", sans-serif',
		),
		'allerta' => array(
			'value' => 'allerta',
			'label' => '"Allerta", sans-serif',
		),
		'amaranth' => array(
			'value' => 'amaranth',
			'label' => '"Amaranth", sans-serif',
		),
		'arial' => array(
			'value' => 'arial',
			'label' => 'Arial, Helvetica, sans-serif',
		),
		'bitter' => array(
			'value' => 'bitter',
			'label' => '"Bitter", sans-serif',
		),
		'cabin' => array(
			'value' => 'cabin',
			'label' => '"Cabin", sans-serif',
		),
		'cantarell' => array(
			'value' => 'cantarell',
			'label' => '"Cantarell", sans-serif',
		),
		'century-gothic' => array(
			'value' => 'century-gothic',
			'label' => '"Century Gothic", sans-serif',
		),
		'courier-new' => array(
			'value' => 'courier-new',
			'label' => '"Courier New", Courier, monospace',
		),
		'crimson-text' => array(
			'value' => 'crimson-text',
			'label' => '"Crimson Text", sans-serif',
		),
		'cuprum' => array(
			'value' => 'cuprum',
			'label' => '"Cuprum", sans-serif',
		),
		'dancing-script' => array(
			'value' => 'dancing-script',
			'label' => '"Dancing Script", sans-serif',
		),
		'droid-sans' => array(
			'value' => 'droid-sans',
			'label' => '"Droid Sans", sans-serif',
		),
		'droid-serif' => array(
			'value' => 'droid-serif',
			'label' => '"Droid Serif", sans-serif',
		),
		'exo' => array(
			'value' => 'exo',
			'label' => '"Exo", sans-serif',
		),
		'exo-2' => array(
			'value' => 'exo-2',
			'label' => '"Exo 2", sans-serif',
		),
		'georgia' => array(
			'value' => 'georgia',
			'label' => 'Georgia, "Times New Roman", Times, serif',
		),
		'helvetica' => array(
			'value' => 'helvetica',
			'label' => 'Helvetica, "Helvetica Neue", Arial, sans-serif',
		),
		'helvetica-neue' => array(
			'value' => 'helvetica-neue',
			'label' => '"Helvetica Neue",Helvetica,Arial,sans-serif',
		),
		'istok-web' => array(
			'value' => 'istok-web',
			'label' => '"Istok Web", sans-serif',
		),
		'impact' => array(
			'value' => 'impact',
			'label' => 'Impact, Charcoal, sans-serif',
		),
		'josefin-sans' => array(
			'value' => 'josefin-sans',
			'label' => '"Josefin Sans", sans-serif',
		),
		'lato' => array(
			'value' => 'lato',
			'label' => '"Lato", sans-serif',
		),
		'libre-baskerville' => array(
			'value' => 'libre-baskerville',
			'label' => '"Libre Baskerville",serif'
		),
		'nepalbuzz-sans-unicode' => array(
			'value' => 'nepalbuzz-sans-unicode',
			'label' => '"NepalBuzz Sans Unicode", "NepalBuzz Grande", sans-serif',
		),
		'nepalbuzz-grande' => array(
			'value' => 'nepalbuzz-grande',
			'label' => '"NepalBuzz Grande", "NepalBuzz Sans Unicode", sans-serif',
		),
		'lobster' => array(
			'value' => 'lobster',
			'label' => '"Lobster", sans-serif',
		),
		'lora' => array(
			'value' => 'lora',
			'label' => '"Lora", serif',
		),
		'monaco' => array(
			'value' => 'monaco',
			'label' => 'Monaco, Consolas, "NepalBuzz Console", monospace, sans-serif',
		),
		'merriweather' => array(
			'value' => 'merriweather',
			'label' => '"Merriweather", sans-serif',
		),
		'montserrat' => array(
			'value' => 'montserrat',
			'label' => '"Montserrat", sans-serif',
		),
		'nobile' => array(
			'value' => 'nobile',
			'label' => '"Nobile", sans-serif',
		),
		'noto-serif' => array(
			'value' => 'noto-serif',
			'label' => '"Noto Serif", serif',
		),
		'neuton' => array(
			'value' => 'neuton',
			'label' => '"Neuton", serif',
		),
		'open-sans' => array(
			'value' => 'open-sans',
			'label' => '"Open Sans", sans-serif',
		),
		'oswald' => array(
			'value' => 'oswald',
			'label' => '"Oswald", sans-serif',
		),
		'palatino' => array(
			'value' => 'palatino',
			'label' => 'Palatino, "Palatino Linotype", "Book Antiqua", serif',
		),
		'patua-one' => array(
			'value' => 'patua-one',
			'label' => '"Patua One", sans-serif',
		),
		'playfair-display' => array(
			'value' => 'playfair-display',
			'label' => '"Playfair Display", sans-serif',
		),
		'pt-sans' => array(
			'value' => 'pt-sans',
			'label' => '"PT Sans", sans-serif',
		),
		'pt-serif' => array(
			'value' => 'pt-serif',
			'label' => '"PT Serif", serif',
		),
		'quattrocento' => array(
			'value' => 'quattrocento',
			'label' => '"Quattrocento", serif',
		),
		'quattrocento-sans' => array(
			'value' => 'quattrocento-sans',
			'label' => '"Quattrocento Sans", sans-serif',
		),
		'roboto' => array(
			'value' => 'roboto',
			'label' => '"Roboto", sans-serif',
		),
		'roboto-slab' => array(
			'value' => 'roboto-slab',
			'label' => '"Roboto Slab", serif',
		),
		'sans-serif' => array(
			'value' => 'sans-serif',
			'label' => 'Sans Serif, Arial',
		),
		'source-sans-pro' => array(
			'value' => 'source-sans-pro',
			'label' => '"Source Sans Pro", sans-serif',
		),
		'tahoma' => array(
			'value' => 'tahoma',
			'label' => 'Tahoma, Geneva, sans-serif',
		),
		'trebuchet-ms' => array(
			'value' => 'trebuchet-ms',
			'label' => '"Trebuchet MS", "Helvetica", sans-serif',
		),
		'times-new-roman' => array(
			'value' => 'times-new-roman',
			'label' => '"Times New Roman", Times, serif',
		),
		'ubuntu' => array(
			'value' => 'ubuntu',
			'label' => '"Ubuntu", sans-serif',
		),
		'varela' => array(
			'value' => 'varela',
			'label' => '"Varela", sans-serif',
		),
		'verdana' => array(
			'value' => 'verdana',
			'label' => 'Verdana, Geneva, sans-serif',
		),
		'yanone-kaffeesatz' => array(
			'value' => 'yanone-kaffeesatz',
			'label' => '"Yanone Kaffeesatz", sans-serif',
		),
	);

	return apply_filters( 'nepalbuzz_avaliable_fonts', $options );
}


/**
 * Returns list of social icons currently supported
 *
 * @since NepalBuzz 0.1
*/
function nepalbuzz_get_social_icons_list() {
	$options = array(
		'facebook_link'		=> array(
			'fa_class' 	=> 'facebook',
			'label' 			=> esc_html__( 'Facebook', 'nepalbuzz' )
		),
		'twitter_link'		=> array(
			'fa_class' 	=> 'twitter',
			'label' 			=> esc_html__( 'Twitter', 'nepalbuzz' )
		),
		'googleplus_link'	=> array(
			'fa_class' 	=> 'google-plus',
			'label' 			=> esc_html__( 'Googleplus', 'nepalbuzz' )
		),
		'email_link'		=> array(
			'fa_class' 	=> 'envelope',
			'label' 			=> esc_html__( 'Email', 'nepalbuzz' )
		),
		'feed_link'			=> array(
			'fa_class' 	=> 'feed',
			'label' 			=> esc_html__( 'Feed', 'nepalbuzz' )
		),
		'wordpress_link'	=> array(
			'fa_class' 	=> 'wordpress',
			'label' 			=> esc_html__( 'WordPress', 'nepalbuzz' )
		),
		'github_link'		=> array(
			'fa_class' 	=> 'github',
			'label' 			=> esc_html__( 'GitHub', 'nepalbuzz' )
		),
		'linkedin_link'		=> array(
			'fa_class' 	=> 'linkedin',
			'label' 			=> esc_html__( 'LinkedIn', 'nepalbuzz' )
		),
		'pinterest_link'	=> array(
			'fa_class' 	=> 'pinterest',
			'label' 			=> esc_html__( 'Pinterest', 'nepalbuzz' )
		),
		'flickr_link'		=> array(
			'fa_class' 	=> 'flickr',
			'label' 			=> esc_html__( 'Flickr', 'nepalbuzz' )
		),
		'vimeo_link'		=> array(
			'fa_class' 	=> 'vimeo',
			'label' 			=> esc_html__( 'Vimeo', 'nepalbuzz' )
		),
		'youtube_link'		=> array(
			'fa_class' 	=> 'youtube',
			'label' 			=> esc_html__( 'YouTube', 'nepalbuzz' )
		),
		'tumblr_link'		=> array(
			'fa_class' 	=> 'tumblr',
			'label' 			=> esc_html__( 'Tumblr', 'nepalbuzz' )
		),
		'instagram_link'	=> array(
			'fa_class' 	=> 'instagram',
			'label' 			=> esc_html__( 'Instagram', 'nepalbuzz' )
		),
		'vkontakte_link'	=> array(
			'fa_class' 	=> 'vk',
			'label' 			=> esc_html__( 'VKontakte', 'nepalbuzz' )
		),
		'codepen_link'		=> array(
			'fa_class' 	=> 'codepen',
			'label' 			=> esc_html__( 'CodePen', 'nepalbuzz' )
		),
		'xing_link'			=> array(
			'fa_class' 	=> 'xing',
			'label' 			=> esc_html__( 'Xing', 'nepalbuzz' )
		),
		'dribbble_link'		=> array(
			'fa_class' 	=> 'dribbble',
			'label' 			=> esc_html__( 'Dribbble', 'nepalbuzz' )
		),
		'skype_link'		=> array(
			'fa_class' 	=> 'skype',
			'label' 			=> esc_html__( 'Skype', 'nepalbuzz' )
		),
		'digg_link'			=> array(
			'fa_class' 	=> 'digg',
			'label' 			=> esc_html__( 'Digg', 'nepalbuzz' )
		),
		'reddit_link'		=> array(
			'fa_class' 	=> 'reddit',
			'label' 			=> esc_html__( 'Reddit', 'nepalbuzz' )
		),
		'stumbleupon_link'	=> array(
			'fa_class' 	=> 'stumbleupon',
			'label' 			=> esc_html__( 'Stumbleupon', 'nepalbuzz' )
		),
		'pocket_link'		=> array(
			'fa_class' 	=> 'get-pocket',
			'label' 			=> esc_html__( 'Pocket', 'nepalbuzz' ),
		),
		'dropbox_link'		=> array(
			'fa_class' 	=> 'dropbox',
			'label' 			=> esc_html__( 'DropBox', 'nepalbuzz' ),
		),
		'spotify_link'		=> array(
			'fa_class' 	=> 'spotify',
			'label' 			=> esc_html__( 'Spotify', 'nepalbuzz' ),
		),
		'foursquare_link'	=> array(
			'fa_class' 	=> 'foursquare',
			'label' 			=> esc_html__( 'Foursquare', 'nepalbuzz' ),
		),
		'twitch_link'		=> array(
			'fa_class' 	=> 'twitch',
			'label' 			=> esc_html__( 'Twitch', 'nepalbuzz' ),
		),
		'website_link'		=> array(
			'fa_class' 	=> 'globe',
			'label' 			=> esc_html__( 'Website', 'nepalbuzz' ),
		),
		'phone_link'		=> array(
			'fa_class' => 'mobile-phone',
			'label'    => esc_html__( 'Phone', 'nepalbuzz' ),
		),
		'handset_link'		=> array(
			'fa_class' => 'phone',
			'label'    => esc_html__( 'Handset', 'nepalbuzz' ),
		),
		'cart_link'			=> array(
			'fa_class' => 'shopping-cart',
			'label'    => esc_html__( 'Cart', 'nepalbuzz' ),
		),
		'cloud_link'		=> array(
			'fa_class' => 'cloud',
			'label'    => esc_html__( 'Cloud', 'nepalbuzz' ),
		),
		'link_link'		=> array(
			'fa_class' => 'link',
			'label'    => esc_html__( 'Link', 'nepalbuzz' ),
		),
	);

	return apply_filters( 'nepalbuzz_social_icons_list', $options );
}


/**
 * Returns an array of metabox layout options registered for NepalBuzz.
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_metabox_layouts() {
	$layout_options = array(
		'default' 	=> array(
			'id' 	=> 'nepalbuzz-layout-option',
			'value' => 'default',
			'label' => esc_html__( 'Default', 'nepalbuzz' ),
		),
		'three-columns-content-left'	=> array(
			'id' 	=> 'nepalbuzz-layout-option',
			'value' => 'three-columns-content-left',
			'label' => esc_html__( 'Three Columns ( Content, Secondary Sidebar, Primary Sidebar )', 'nepalbuzz' ),
		),
		'right-sidebar' => array(
			'id' 	=> 'nepalbuzz-layout-option',
			'value' => 'right-sidebar',
			'label' => esc_html__( 'Content, Primary Sidebar', 'nepalbuzz' ),
		),
		'no-sidebar'	=> array(
			'id' 	=> 'nepalbuzz-layout-option',
			'value' => 'no-sidebar',
			'label' => esc_html__( 'No Sidebar ( Content Width )', 'nepalbuzz' ),
		)
	);
	return apply_filters( 'nepalbuzz_layouts', $layout_options );
}

/**
 * Returns an array of metabox header featured image options registered for NepalBuzz.
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_metabox_header_featured_image_options() {
	$options = array(
		'default' => array(
			'id'		=> 'nepalbuzz-header-image',
			'value' 	=> 'default',
			'label' 	=> esc_html__( 'Default', 'nepalbuzz' ),
		),
		'enable' => array(
			'id'		=> 'nepalbuzz-header-image',
			'value' 	=> 'enable',
			'label' 	=> esc_html__( 'Enable', 'nepalbuzz' ),
		),
		'disable' => array(
			'id'		=> 'nepalbuzz-header-image',
			'value' 	=> 'disable',
			'label' 	=> esc_html__( 'Disable', 'nepalbuzz' )
		)
	);
	return apply_filters( 'header_featured_image_options', $options );
}


/**
 * Returns an array of metabox featured image options registered for NepalBuzz.
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_metabox_featured_image_options() {
	$options['default'] = array(
		'id'	=> 'nepalbuzz-featured-image',
		'value' => 'default',
		'label' => esc_html__( 'Default', 'nepalbuzz' ),
	);

	$all_sizes = nepalbuzz_get_additional_image_sizes();

	foreach ($all_sizes as $key => $value) {
		$options[$key] = array(
			'id'	=> 'nepalbuzz-featured-image',
			'value' => $key,
			'label' => esc_html( $key ).' ('.$value['width'].'x'.$value['height'].')'
		);

	}

	$options['full'] = array(
		'id'	=> 'nepalbuzz-featured-image',
		'value'	=> 'full',
		'label' => esc_html__( 'Full Image', 'nepalbuzz' ),
	);

	$options['disabled'] = array(
		'id' 	=> 'nepalbuzz-featured-image',
		'value' => 'disabled',
		'label' => esc_html__( 'Disable Image', 'nepalbuzz' )
	);

	return apply_filters( 'nepalbuzz_metabox_featured_image_options', $options );
}

/**
 * Returns footer content
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_get_content() {
	$theme_data = wp_get_theme();

	return sprintf( _x( 'Copyright &copy; %1$s %2$s. All Rights Reserved', '1: Year, 2: Site Title with home URL', 'nepalbuzz' ), date_i18n( __( 'Y', 'nepalbuzz' ) ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>' ) . ' &#124; ' . esc_html( $theme_data->get( 'Name') ) . '&nbsp;' . esc_html__( 'by', 'nepalbuzz' ). '&nbsp;<a target="_blank" href="'. $theme_data->get( 'AuthorURI' ) .'">'. esc_html( $theme_data->get( 'Author' ) ) .'</a>';
}
