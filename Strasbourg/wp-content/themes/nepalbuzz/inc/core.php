<?php
/**
 * Core functions and definitions
 *
 * Sets up the theme
 *
 * The first function, nepalbuzz_initial_setup(), sets up the theme by registering support
 * for various features in WordPress, such as theme support, post thumbnails, navigation menu, and the like.
 *
 * NepalBuzz functions and definitions
 *
 * @package NepalBuzz
 */


if ( ! function_exists( 'nepalbuzz_content_width' ) ) :
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function nepalbuzz_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'nepalbuzz_content_width', 860 );
	}
endif;
add_action( 'after_setup_theme', 'nepalbuzz_content_width', 0 );


if ( ! function_exists( 'nepalbuzz_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 */
	function nepalbuzz_setup() {
		/**
		 * Get Theme Options Values
		 */
		$options 	= nepalbuzz_get_options();
		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * If you're building a theme based on NepalBuzz, use a find and replace
		 * to change 'nepalbuzz' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'nepalbuzz', trailingslashit( get_template_directory() ) . 'languages' );

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for Post Thumbnails on posts and pages
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add excerpt box in pages
		 */
		add_post_type_support( 'page', 'excerpt' );

		// Thumbnail Image, used in Three Columns (Featured archive pages). Ratio 16:9
		set_post_thumbnail_size( 940, 529, true );

		// Featured Image, used in Slider
		add_image_size( 'nepalbuzz-slider', 1920, 880, true ); // Used for Featured slider

		// Thumbnail Image, used in Two Columns/One Column (Featured archive pages)
		add_image_size( 'nepalbuzz-featured', 355, 266, true);

		add_image_size( 'nepalbuzz-small', 90, 68, true ); // used in Widgets

		/**
		 * This theme uses wp_nav_menu() in one location.
		 */
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'nepalbuzz' ),
			'footer'  => esc_html__( 'Footer Menu', 'nepalbuzz' ),
		) );

		/**
		 * Enable support for Post Formats
		 */
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

		/**
		 * Setup the WordPress core custom background feature.
		 */
		add_theme_support( 'custom-background', apply_filters( 'nepalbuzz_custom_background_args', array(
			'default-color' => '#f6f6f6',
		) ) );


		/**
		 * Setup Editor style
		 */
		add_editor_style( 'css/editor-style.css' );

		/**
		 * Setup title support for theme
		 * Supported from WordPress version 4.1 onwards
		 * More Info: https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Setup Custom Logo Support for theme
		 * Supported from WordPress version 4.5 onwards
		 * More Info: https://make.wordpress.org/core/2016/03/10/custom-logo/
		 */
		add_theme_support( 'custom-logo' );

		/**
		 * Setup Infinite Scroll using JetPack if navigation type is set
		 */
		$pagination_type	= $options['pagination_type'];

		if( 'infinite-scroll-click' == $pagination_type ) {
			add_theme_support( 'infinite-scroll', array(
				'type'		=> 'click',
				'container' => 'main',
				'footer'    => 'page'
			) );
		}
		else if ( 'infinite-scroll-scroll' == $pagination_type ) {
			//Override infinite scroll disable scroll option
        	update_option('infinite_scroll', true);

			add_theme_support( 'infinite-scroll', array(
				'type'		=> 'scroll',
				'container' => 'main',
				'footer'    => 'page'
			) );
		}
	}
endif; // nepalbuzz_setup
add_action( 'after_setup_theme', 'nepalbuzz_setup' );


/**
 * Register Google fonts.
 */
function nepalbuzz_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	* supported by Open Sans, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$merriweather = _x( 'on', 'Merriweather Font: on or off', 'nepalbuzz' );

	/* Translators: If there are characters in your language that are not
	* supported by Playfair Display, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$oswald = _x( 'on', 'Oswald Font: on or off', 'nepalbuzz' );

	if ( 'off' !== $merriweather || 'off' !== $oswald ) {
		$font_families = array();

		if ( 'off' !== $merriweather ) {
		$font_families[] = 'Merriweather';
		}

		if ( 'off' !== $oswald ) {
		$font_families[] = 'Oswald';
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}



/**
 * Enqueue scripts and styles
 *
 * @uses  wp_register_script, wp_enqueue_script, wp_register_style, wp_enqueue_style, wp_localize_script
 * @action wp_enqueue_scripts
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_scripts() {
	$options = nepalbuzz_get_options();

	wp_register_style( 'nepalbuzz-web-font', nepalbuzz_fonts_url(), false, null );

	$deps = array( 'nepalbuzz-web-font' );

	wp_enqueue_style( 'nepalbuzz-style', get_stylesheet_uri(), $deps, NEPALBUZZ_THEME_VERSION );

	wp_enqueue_script( 'nepalbuzz-navigation', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/navigation.min.js', array(), NEPALBUZZ_THEME_VERSION, true );

	wp_enqueue_script( 'nepalbuzz-skip-link-focus-fix', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/skip-link-focus-fix.min.js', array(), NEPALBUZZ_THEME_VERSION, true );

	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//For fontawesome
	wp_enqueue_style( 'font-awesome', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'css/fontawesome/css/font-awesome.min.css', array(), '4.2.0', 'all' );

	/**
	 * Loads up fit vids
	 */
	wp_enqueue_script( 'jquery-fitvids', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/fitvids.min.js', array( 'jquery' ), '1.1', true );

	/**
	 * Loads up Cycle JS
	 */
	if( $options['featured_slider_option'] != 'disabled' || $options['news_ticker_option'] != 'disabled' ) {
		wp_enqueue_script( 'jquery-cycle2', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/jquery.cycle/jquery.cycle2.min.js', array( 'jquery' ), '2.1.5', true );

		$transition_effects = array(
			$options['featured_slider_transition_effect'],
			$options['news_ticker_transition_effect']
		);

		/**
		 * Condition checks for additional slider transition plugins
		 */
		// Scroll Vertical transition plugin addition
		if ( in_array( 'scrollVert', $transition_effects ) ){
			wp_enqueue_script( 'jquery-cycle2-scrollVert', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/jquery.cycle/jquery.cycle2.scrollVert.min.js', array( 'jquery-cycle2' ), NEPALBUZZ_THEME_VERSION, true );
		}

		// Flip transition plugin addition
		if ( in_array( 'flipHorz', $transition_effects ) || in_array( 'flipVert', $transition_effects ) ){
			wp_enqueue_script( 'jquery-cycle2-flip', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/jquery.cycle/jquery.cycle2.flip.min.js', array( 'jquery-cycle2' ), NEPALBUZZ_THEME_VERSION, true );
		}

		// Shuffle transition plugin addition
		if ( in_array( 'tileSlide', $transition_effects ) || in_array( 'tileBlind', $transition_effects ) ){
			wp_enqueue_script( 'jquery-cycle2-tile', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/jquery.cycle/jquery.cycle2.tile.min.js', array( 'jquery-cycle2' ), NEPALBUZZ_THEME_VERSION, true );
		}

		// Shuffle transition plugin addition
		if ( in_array( 'shuffle', $transition_effects ) ){
			wp_enqueue_script( 'jquery-cycle2-shuffle', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/jquery.cycle/jquery.cycle2.shuffle.min.js', array( 'jquery-cycle2' ), NEPALBUZZ_THEME_VERSION, true );
		}
	}

	/**
	 * Loads up Scroll Up script
	 */
	if ( ! $options['disable_scrollup'] ) {
		wp_enqueue_script( 'nepalbuzz-scrollup', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/scrollup.min.js', array( 'jquery' ), '20072014', true  );
	}

	/**
	 * Enqueue custom script for NepalBuzz.
	 */
	wp_enqueue_script( 'nepalbuzz-custom-scripts', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/custom-scripts.min.js', array( 'jquery' ), null );

	wp_localize_script( 'nepalbuzz-custom-scripts', 'nepalbuzzScreenReaderText', array(
		'expand'   => esc_html__( 'expand child menu', 'nepalbuzz' ),
		'collapse' => esc_html__( 'collapse child menu', 'nepalbuzz' ),
	) );

	// Load the html5 shiv.
	wp_enqueue_script( 'nepalbuzz-html5', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/html5.min.js', array(), '3.7.0' );
	wp_script_add_data( 'nepalbuzz-html5', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'nepalbuzz_scripts' );


/**
 * Enqueue scripts and styles for Metaboxes
 * @uses wp_register_script, wp_enqueue_script, and  wp_enqueue_style
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_enqueue_metabox_scripts( $hook ) {
    $allowed_pages = array( 'post-new.php', 'post.php' );

	// Bail if not on required page
	if ( ! in_array( $hook, $allowed_pages ) ) {
		return;
	}

    //Scripts
    wp_enqueue_script( 'nepalbuzz-ui-tabs', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/ui-tabs.min.js', array( 'jquery', 'jquery-ui-tabs' ), NEPALBUZZ_THEME_VERSION );

	//CSS Styles
	wp_enqueue_style( 'nepalbuzz-ui-tabs', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'css/ui-tabs.css' );
}
add_action( 'admin_enqueue_scripts', 'nepalbuzz_enqueue_metabox_scripts' );


/**
 * Default Options.
 */
require trailingslashit( get_template_directory() ) . 'inc/default-options.php';

/**
 * Custom Header.
 */
require trailingslashit( get_template_directory() ) . 'inc/custom-header.php';


/**
 * Structure for NepalBuzz
 */
require trailingslashit( get_template_directory() ) . 'inc/structure.php';


/**
 * Customizer additions.
 */
require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/customizer.php';


/**
 * Custom Menus
 */
require trailingslashit( get_template_directory() ) . 'inc/menus.php';


/**
 * Load Custom CSS
 */
require trailingslashit( get_template_directory() ) . 'inc/custom-css.php';


/**
 * Load Slider file.
 */
require trailingslashit( get_template_directory() ) . 'inc/featured-slider.php';


/**
 * Load Featured Content.
 */
require trailingslashit( get_template_directory() ) . 'inc/featured-content.php';


/**
 * Load News Ticker
 */
require trailingslashit( get_template_directory() ) . 'inc/news-ticker.php';


/**
 * Load Breadcrumb file.
 */
require trailingslashit( get_template_directory() ) . 'inc/breadcrumb.php';


/**
 * Load Widgets and Sidebars
 */
require trailingslashit( get_template_directory() ) . 'inc/widgets/widgets.php';


/**
 * Load Social Icons
 */
require trailingslashit( get_template_directory() ) . 'inc/social-icons.php';


/**
 * Load Metaboxes
 */
require trailingslashit( get_template_directory() ) . 'inc/metabox.php';


/**
 * Returns the options array for NepalBuzz.
 * @uses  get_theme_mod
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_get_options() {
	$default_options = nepalbuzz_default_options();

	return array_merge( $default_options , get_theme_mod( 'nepalbuzz_theme_options', $default_options ) ) ;
}


/**
 * Flush out all transients
 *
 * @uses delete_transient
 *
 * @action customize_save, nepalbuzz_customize_preview (see nepalbuzz_customizer function: nepalbuzz_customize_preview)
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_flush_transients(){
	delete_transient( 'nepalbuzz_featured_content' );

	delete_transient( 'nepalbuzz_news_ticker' );

	delete_transient( 'nepalbuzz_featured_slider' );

	delete_transient( 'nepalbuzz_social_icons' );

	delete_transient( 'all_the_cool_cats' );
}
add_action( 'customize_save', 'nepalbuzz_flush_transients' );

/**
 * Flush out category transients
 *
 * @uses delete_transient
 *
 * @action edit_category
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_flush_category_transients(){
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'nepalbuzz_flush_category_transients' );


/**
 * Flush out post related transients
 *
 * @uses delete_transient
 *
 * @action save_post
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_flush_post_transients(){
	delete_transient( 'nepalbuzz_featured_content' );

	delete_transient( 'nepalbuzz_news_ticker' );

	delete_transient( 'nepalbuzz_featured_slider' );

	delete_transient( 'all_the_cool_cats' );
}
add_action( 'save_post', 'nepalbuzz_flush_post_transients' );


/**
 * Alter the query for the main loop in homepage
 *
 * @action pre_get_posts
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_alter_home( $query ){
	if( $query->is_main_query() && $query->is_home() ) {
		$options 	= nepalbuzz_get_options();

	    if ( is_array( $options['front_page_category'] ) && ! in_array( '0', $options['front_page_category'] ) ) {
	    	$cats = (array) $options['front_page_category'];
	    } else{
	    	$cats = '0';
	    }

	    $quantity	= $options['featured_slider_number'];

		$post_list	= array();	// list of valid post ids

		for( $i = 1; $i <= $quantity; $i++ ){
			if( isset ( $options['featured_slider_post_' . $i] ) && $options['featured_slider_post_' . $i] > 0 ){
				$post_list	=	wp_parse_args( $post_list, array( $options['featured_slider_post_' . $i] ) );
			}
		}

	    if ( is_array( $cats ) && !in_array( '0', $cats ) ) {
			$query->query_vars['category__in'] =  $cats;
		}
	}
}
add_action( 'pre_get_posts','nepalbuzz_alter_home' );


if ( ! function_exists( 'nepalbuzz_content_nav' ) ) :
	/**
	 * Display navigation to next/previous pages when applicable
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_content_nav( $nav_id ) {
		global $wp_query, $post;

		// Don't print empty markup on single pages if there's nowhere to navigate.
		if ( is_single() ) {
			$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous )
				return;
		}

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

		$options         = nepalbuzz_get_options();
		$pagination_type = $options['pagination_type'];

		/**
		 * Check if navigation type is Jetpack Infinite Scroll and if it is enabled, else goto default pagination
		 * if it's active then disable pagination
		 */
		if ( ( 'infinite-scroll-click' == $pagination_type || 'infinite-scroll-scroll' == $pagination_type ) && class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) {
			return false;
		}

		?>

		<div class="main-pagination clear">
			<?php
			/**
			 * Check if navigation type is numeric and if Wp-PageNavi Plugin is enabled
			 */
			if ( 'numeric' == $pagination_type && function_exists( 'the_posts_pagination' ) ) {
				// Previous/next page navigation.
				the_posts_pagination( array(
					'prev_text'          => esc_html__( 'Previous', 'nepalbuzz' ),
					'next_text'          => esc_html__( 'Next', 'nepalbuzz' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'nepalbuzz' ) . ' </span>',
				) );
			}
			else {
				the_posts_navigation();
            } ?>
		</div><!-- .main-pagination -->

		<?php
	}
endif; // nepalbuzz_content_nav


if ( ! function_exists( 'nepalbuzz_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_comment( $comment, $args, $depth ) {
		if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<div class="comment-body">
				<?php esc_html_e( 'Pingback:', 'nepalbuzz' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'nepalbuzz' ), '<span class="edit-link">', '</span>' ); ?>
			</div>

		<?php else : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
				<footer class="comment-meta">
					<div class="comment-author vcard">
						<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
						<?php printf( __( '%s <span class="says">says:</span>', 'nepalbuzz' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					</div><!-- .comment-author -->

					<div class="comment-metadata">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'nepalbuzz' ), get_comment_date(), get_comment_time() ); ?>
							</time>
						</a>
						<?php edit_comment_link( esc_html__( 'Edit', 'nepalbuzz' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .comment-metadata -->

					<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'nepalbuzz' ); ?></p>
					<?php endif; ?>
				</footer><!-- .comment-meta -->

				<div class="comment-content">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->

				<?php
					comment_reply_link( wp_parse_args( $args, array(
						'add_below' => 'div-comment',
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'before'    => '<div class="reply">',
						'after'     => '</div>',
					) ) );
				?>
			</article><!-- .comment-body -->

		<?php
		endif;
	}
endif; // nepalbuzz_comment()


if ( ! function_exists( 'nepalbuzz_the_attached_image' ) ) :
	/**
	 * Prints the attached image with a link to the next attached image.
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_the_attached_image() {
		$post                = get_post();
		$attachment_size     = apply_filters( 'nepalbuzz_attachment_size', array( 1200, 1200 ) );
		$next_attachment_url = wp_get_attachment_url();

		/**
		 * Grab the IDs of all the image attachments in a gallery so we can get the
		 * URL of the next adjacent image in a gallery, or the first image (if
		 * we're looking at the last image in a gallery), or, in a gallery of one,
		 * just the link to that image file.
		 */
		$attachment_ids = get_posts( array(
			'post_parent'    => $post->post_parent,
			'fields'         => 'ids',
			'numberposts'    => 1,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => 'ASC',
			'orderby'        => 'menu_order ID',
		) );

		// If there is more than 1 attachment in a gallery...
		if ( count( $attachment_ids ) > 1 ) {
			foreach ( $attachment_ids as $attachment_id ) {
				if ( $attachment_id == $post->ID ) {
					$next_id = current( $attachment_ids );
					break;
				}
			}

			// get the URL of the next image attachment...
			if ( $next_id )
				$next_attachment_url = get_attachment_link( $next_id );

			// or get the URL of the first image attachment.
			else
				$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}

		printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
			esc_url( $next_attachment_url ),
			the_title_attribute( 'echo=0' ),
			wp_get_attachment_image( $post->ID, $attachment_size )
		);
	}
endif; //nepalbuzz_the_attached_image


if ( ! function_exists( 'nepalbuzz_entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_entry_meta() {
		echo '<p class="entry-meta">';

		echo nepalbuzz_default_category();

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		printf( '<span class="posted-on">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
			sprintf( _x( '<span class="screen-reader-text">Posted on</span>', 'Used before publish date.', 'nepalbuzz' ) ),
			esc_url( get_permalink() ),
			$time_string
		);

		if ( is_singular() || is_multi_author() ) {
			printf( '<span class="byline"><span class="author vcard">%1$s<a class="url fn n" href="%2$s">%3$s</a></span></span>',
				sprintf( _x( '<span class="screen-reader-text">Author</span>', 'Used before post author name.', 'nepalbuzz' ) ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			);
		}

		if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'nepalbuzz' ), esc_html__( '1 Comment', 'nepalbuzz' ), esc_html__( '% Comments', 'nepalbuzz' ) );
			echo '</span>';
		}

		echo '</p><!-- .entry-meta -->';
	}
endif; //nepalbuzz_entry_meta


if ( ! function_exists( 'nepalbuzz_tag_category' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags.
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_tag_category() {
		echo '<p class="entry-meta">';

		$options = nepalbuzz_get_options();

		if ( 'post' == get_post_type() ) {
			if ( $options['hide_archive_footer_meta'] ) {
				echo '<span class="screen-reader-text">';
			}

			$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'nepalbuzz' ) );
			if ( $categories_list && nepalbuzz_categorized_blog() ) {
				printf( '<span class="cat-links">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Categories</span>', 'Used before category names.', 'nepalbuzz' ) ),
					$categories_list
				);
			}

			$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'nepalbuzz' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Tags</span>', 'Used before tag names.', 'nepalbuzz' ) ),
					$tags_list
				);
			}

			if ( $options['hide_archive_footer_meta'] ) {
				echo '</span> <!-- .screen-reader-text -->';
			}
		}

		edit_post_link( esc_html__( 'Edit', 'nepalbuzz' ), '<span class="edit-link">', '</span>' );

		echo '</p><!-- .entry-meta -->';
	}
endif; //nepalbuzz_tag_category


if ( ! function_exists( 'nepalbuzz_get_highlight_meta' ) ) :
	/**
	 * Returns HTML with meta information for the categories, tags, date and author.
	 *
	 * @param boolean $hide_category Adds screen-reader-text class to category meta if true.
	 * @param boolean $hide_tags Adds screen-reader-text class to tag meta if true.
	 * @param boolean $hide_posted_by Adds screen-reader-text class to date meta if true.
	 * @param boolean $hide_author Adds screen-reader-text class to author meta if true.
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_get_highlight_meta( $hide_category = false, $hide_tags = false, $hide_posted_by = false, $hide_author = false ) {
		$output = '<p class="entry-meta">';

		if ( 'post' == get_post_type() ) {

			$class = $hide_category ? 'screen-reader-text' : '';

			$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'nepalbuzz' ) );
			if ( $categories_list && nepalbuzz_categorized_blog() ) {
				$output .= sprintf( '<span class="cat-links ' . $class . '">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Categories</span>', 'Used before category names.', 'nepalbuzz' ) ),
					$categories_list
				);
			}

			$class = $hide_tags ? 'screen-reader-text' : '';

			$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'nepalbuzz' ) );
			if ( $tags_list ) {
				$output .= sprintf( '<span class="tags-links ' . $class . '">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Tags</span>', 'Used before tag names.', 'nepalbuzz' ) ),
					$tags_list
				);
			}

			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
			}

			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() ),
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);

			$class = $hide_posted_by ? 'screen-reader-text' : '';

			$output .= sprintf( '<span class="posted-on ' . $class . '">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
				sprintf( _x( '<span class="screen-reader-text">Posted on</span>', 'Used before publish date.', 'nepalbuzz' ) ),
				esc_url( get_permalink() ),
				$time_string
			);

			if ( is_singular() || is_multi_author() ) {
				$class = $hide_author ? 'screen-reader-text' : '';

				$output .= sprintf( '<span class="byline ' . $class . '"><span class="author vcard">%1$s<a class="url fn n" href="%2$s">%3$s</a></span></span>',
					sprintf( _x( '<span class="screen-reader-text">Author</span>', 'Used before post author name.', 'nepalbuzz' ) ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_html( get_the_author() )
				);
			}
		}

		$output .= '</p><!-- .entry-meta -->';

		return $output;
	}
endif; //nepalbuzz_get_highlight_meta


/**
 * Returns true if a blog has more than 1 category
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so nepalbuzz_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so nepalbuzz_categorized_blog should return false
		return false;
	}
}


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'nepalbuzz_page_menu_args' );


/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'nepalbuzz_enhanced_image_navigation', 10, 2 );


/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'footer-1' ) )
		$count++;

	if ( is_active_sidebar( 'footer-2' ) )
		$count++;

	if ( is_active_sidebar( 'footer-3' ) )
		$count++;

	if ( is_active_sidebar( 'footer-4' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'footer-widget-area one';
			break;
		case '2':
			$class = 'footer-widget-area two';
			break;
		case '3':
			$class = 'footer-widget-area three';
			break;
		case '4':
			$class = 'footer-widget-area four';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}


if ( ! function_exists( 'nepalbuzz_excerpt_length' ) ) :
	/**
	 * Sets the post excerpt length to n words.
	 *
	 * function tied to the excerpt_length filter hook.
	 * @uses filter excerpt_length
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}

		// Getting data from Customizer Options
		$options = nepalbuzz_get_options();

		return absint( $options['excerpt_length'] );
	}
endif; //nepalbuzz_excerpt_length
add_filter( 'excerpt_length', 'nepalbuzz_excerpt_length' );


if ( ! function_exists( 'nepalbuzz_continue_reading' ) ) :
	/**
	 * Returns a "Custom Continue Reading" link for excerpts
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_continue_reading() {
		// Getting data from Customizer Options
		$options = nepalbuzz_get_options();

		return ' <span class="more-button"><a class="more-link" href="' . esc_url( get_permalink() ) . '">' . wp_kses_data( $options['excerpt_more_text'] ) . '</a></span>';
	}
endif; //nepalbuzz_continue_reading


if ( ! function_exists( 'nepalbuzz_excerpt_more' ) ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with nepalbuzz_continue_reading().
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		return nepalbuzz_continue_reading();
	}
endif; //nepalbuzz_excerpt_more
add_filter( 'excerpt_more', 'nepalbuzz_excerpt_more' );


if ( ! function_exists( 'nepalbuzz_custom_excerpt' ) ) :
	/**
	 * Adds Continue Reading link to more tag excerpts.
	 *
	 * function tied to the get_the_excerpt filter hook.
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_custom_excerpt( $output ) {
		if ( has_excerpt() && ! is_attachment() ) {
			$output .= nepalbuzz_continue_reading();
		}
		return $output;
	}
endif; //nepalbuzz_custom_excerpt
add_filter( 'get_the_excerpt', 'nepalbuzz_custom_excerpt' );


if ( ! function_exists( 'nepalbuzz_more_link' ) ) :
	/**
	 * Replacing Continue Reading link to the_content more.
	 *
	 * function tied to the the_content_more_link filter hook.
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_more_link( $more_link, $more_link_text ) {
		$options       = nepalbuzz_get_options();
		$more_tag_text = $options['excerpt_more_text'];

		return str_replace( $more_link_text, wp_kses_data( $more_tag_text ), $more_link );
	}
endif; //nepalbuzz_more_link
add_filter( 'the_content_more_link', 'nepalbuzz_more_link', 10, 2 );


if ( ! function_exists( 'nepalbuzz_body_classes' ) ) :
	/**
	 * Adds NepalBuzz layout classes to the array of body classes.
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_body_classes( $classes ) {
		$options = nepalbuzz_get_options();

		// Adds a class of group-blog to blogs with more than 1 published author
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		// Add a class if there is a custom header.
		if ( has_header_image() ) {
			$classes[] = 'has-header-image';
		}

		$layout = nepalbuzz_get_theme_layout();

		switch ( $layout ) {
			case 'three-columns-content-left':
				$classes[] = 'layout-three-columns content-left';
			break;

			case 'right-sidebar':
				$classes[] = 'layout-two-columns content-left';
			break;

			case 'no-sidebar':
				$classes[] = 'layout-one-column no-sidebar content-width';
			break;
		}

		$content_layout = $options['content_layout'];
		if( "" != $content_layout ) {
			$classes[] = $content_layout;
		}

		$classes[] = 'mobile-menu-one';

		$enable_slider       = $options['featured_slider_option'];
		$header_image_status = nepalbuzz_header_media_status();

		if ( ! nepalbuzz_check_section( $enable_slider ) && !$header_image_status ) {
			//Add class if slider and header image is  disabled
			$classes[] = 'header-bg';
		}

		$classes  = apply_filters( 'nepalbuzz_body_classes', $classes );

		return $classes;
	}
endif; //nepalbuzz_body_classes
add_filter( 'body_class', 'nepalbuzz_body_classes' );


if ( ! function_exists( 'nepalbuzz_post_classes' ) ) :
	/**
	 * Adds NepalBuzz post classes to the array of post classes.
	 * used for supporting different content layouts
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_post_classes( $classes ) {
		// Getting Ready to load data from Theme Options Panel.
		$options       = nepalbuzz_get_options();
		$contentlayout = $options['content_layout'];

		if ( is_archive() || is_home() ) {
			$classes[] = $contentlayout;
		}

		return $classes;
	}
endif; //nepalbuzz_post_classes
add_filter( 'post_class', 'nepalbuzz_post_classes' );

if ( ! function_exists( 'nepalbuzz_get_theme_layout' ) ) :
	/**
	 * Returns Theme Layout prioritizing the meta box layouts
	 *
	 * @uses  get_theme_mod
	 *
	 * @action wp_head
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_get_theme_layout() {
		$id = '';

		global $post, $wp_query;

	    // Front page displays in Reading Settings
		$page_on_front  = get_option('page_on_front') ;
		$page_for_posts = get_option('page_for_posts');

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		// Blog Page or Front Page setting in Reading Settings
		if ( $page_id == $page_for_posts || $page_id == $page_on_front ) {
	        $id = $page_id;
	    }
	    else if ( is_singular() ) {
	 		if ( is_attachment() ) {
				$id = $post->post_parent;
			}
			else {
				$id = $post->ID;
			}
		}

		//Get appropriate metabox value of layout
		if ( '' != $id ) {
			$layout = get_post_meta( $id, 'nepalbuzz-layout-option', true );
		}
		else {
			$layout = 'default';
		}

		//Load options data
		$options = nepalbuzz_get_options();

		//check empty and load default
		if ( empty( $layout ) || 'default' == $layout ) {
			$layout = $options['theme_layout'];

			if ( is_singular() ) {
				$layout = $options['single_layout'];
			}
		}

		return $layout;
	}
endif; //nepalbuzz_get_theme_layout


if ( ! function_exists( 'nepalbuzz_archive_content_image' ) ) :
	/**
	 * Template for Featured Image in Archive Content
	 *
	 * To override this in a child theme
	 * simply create your own nepalbuzz_archive_content_image(), and that function will be used instead.
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_archive_content_image() {
		$options        = nepalbuzz_get_options();
		$featured_image = $options['content_layout'];
		$layout         = nepalbuzz_get_theme_layout();

		if ( has_post_thumbnail() && 'excerpt-image-top' == $featured_image ) { ?>
			<figure class="featured-image">
	            <a rel="bookmark" href="<?php the_permalink(); ?>">
	            	<?php the_post_thumbnail(); ?>
				</a>
	        </figure>
	   	<?php
		}
	}
endif; //nepalbuzz_archive_content_image
add_action( 'nepalbuzz_before_entry_container', 'nepalbuzz_archive_content_image', 10 );


if ( ! function_exists( 'nepalbuzz_single_content_image' ) ) :
	/**
	 * Template for Featured Image in Single Post
	 *
	 * To override this in a child theme
	 * simply create your own nepalbuzz_single_content_image(), and that function will be used instead.
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_single_content_image() {
		global $post, $wp_query;

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();
		if( $post) {
	 		if ( is_attachment() ) {
				$parent = $post->post_parent;
				$individual_ft_image = get_post_meta( $parent,'nepalbuzz-featured-image', true );
			} else {
				$individual_ft_image = get_post_meta( $page_id,'nepalbuzz-featured-image', true );
			}
		}

		if( empty( $individual_ft_image ) || ( !is_page() && !is_single() ) ) {
			$individual_ft_image = 'default';
		}

		// Getting data from Theme Options
		$options        = nepalbuzz_get_options();
		$featured_image = $options['single_post_image_layout'];

		if ( ( 'disable' == $individual_ft_image  || '' == get_the_post_thumbnail() || ( $individual_ft_image=='default' && 'disabled' == $featured_image ) ) ) {
			echo '<!-- Page/Post Single Image Disabled or No Image set in Post Thumbnail -->';
			return false;
		}
		else {
			$class = '';

			if ( 'default' == $individual_ft_image ) {
				$class = $featured_image;
			}
			else {
				$class = 'from-metabox ' . $individual_ft_image;
			}

			?>
			<figure class="featured-image <?php echo $class; ?>">
                <?php the_post_thumbnail( $featured_image ); ?>
	        </figure>
	   	<?php
		}
	}
endif; //nepalbuzz_single_content_image
add_action( 'nepalbuzz_before_post_container', 'nepalbuzz_single_content_image', 10 );
add_action( 'nepalbuzz_before_page_container', 'nepalbuzz_single_content_image', 10 );


if ( ! function_exists( 'nepalbuzz_get_comment_section' ) ) :
	/**
	 * Comment Section
	 *
	 * @get comment setting from theme options and display comments sections accordingly
	 * @display comments_template
	 * @action nepalbuzz_comment_section
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_get_comment_section() {
		if ( comments_open() || '0' != get_comments_number() ){
				comments_template();
		}
}
endif;
add_action( 'nepalbuzz_comment_section', 'nepalbuzz_get_comment_section', 10 );


if ( ! function_exists( 'nepalbuzz_promotion_headline' ) ) :
	/**
	 * Template for Promotion Headline
	 *
	 * To override this in a child theme
	 * simply create your own nepalbuzz_promotion_headline(), and that function will be used instead.
	 *
	 * @uses nepalbuzz_before_main action to add it in the header
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_promotion_headline() {
		global $wp_query;
		$options          = nepalbuzz_get_options();
		$enable_promotion = $options['promotion_headline_option'];


		// Front page displays in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		 if ( nepalbuzz_check_section( $enable_promotion ) ) {
			echo '
				<aside id="promotion-message" role="complementary">
					<div class="wrapper">';
			$promotion_headline 		= $options['promotion_headline'];
			$promotion_subheadline 		= $options['promotion_subheadline'];

			echo '
			<section class="promotion-headline-section left widget widget_customizer_text">';

			if ( "" != $promotion_headline ) {
				echo '<h2>' . $promotion_headline . '</h2>';
			}

			if ( "" != $promotion_subheadline ) {
				echo '<p>' . $promotion_subheadline . '</p>';
			}

			echo '
			</section><!-- .section.left -->';

			$promotion_headline_button 	= $options['promotion_headline_button'];
			$promotion_headline_target 	= $options['promotion_headline_target'];

    		$promotion_headline_url = $options[ 'promotion_headline_url' ];

			if ( "" != $promotion_headline_url ) {
				if ( $promotion_headline_target ) {
					$headlinetarget = '_blank';
				}
				else {
					$headlinetarget = '_self';
				}

				echo '
				<section class="promotion-headline-section right widget widget_customizer_text">
					<a class="promotion-button" href="' . esc_url( $promotion_headline_url ) . '" target="' . $headlinetarget . '">' . esc_html( $promotion_headline_button ) . '
					</a>
				</section><!-- .section.right -->';
			}

			echo '
				</div><!-- .wrapper -->
			</aside><!-- #promotion-message -->';
		}
	}
endif; // nepalbuzz_promotion_featured_content
add_action( 'nepalbuzz_before_content', 'nepalbuzz_promotion_headline', 50 );


if ( ! function_exists( 'nepalbuzz_site_generator_start' ) ) :
	/**
	 * Start Header id #masthead and class .wrapper
	 *
	 * @since NepalBuzz 0.1
	 *
	 */
	function nepalbuzz_site_generator_start() {
		?>
		<div id="site-generator">
    		<div class="wrapper">
		<?php
	}
endif;
add_action( 'nepalbuzz_footer', 'nepalbuzz_site_generator_start', 30 );


/**
 * Footer Text
 *
 * @get footer text from theme options and display them accordingly
 * @display footer_text
 * @action nepalbuzz_footer
 *
 * @since NepalBuzz 0.1
 */
function nepalbuzz_footer_content() {
	//nepalbuzz_flush_transients();
	if ( !$output = get_transient( 'nepalbuzz_footer_content' ) ) {
		$output =  '<div id="footer-content" class="copyright">' . nepalbuzz_get_content() . '</div>';

	    set_transient( 'nepalbuzz_footer_content', $output, 86940 );
    }

    echo $output;
}
add_action( 'nepalbuzz_footer', 'nepalbuzz_footer_content', 50 );


if ( ! function_exists( 'nepalbuzz_site_generator_end' ) ) :
	/**
	 * Start Header id #masthead and class .wrapper
	 *
	 * @since NepalBuzz 0.1
	 *
	 */
	function nepalbuzz_site_generator_end() {
		?>
			</div><!-- .wrapper -->
		</div><!-- #site-generator -->
		<?php
	}
endif;
add_action( 'nepalbuzz_footer', 'nepalbuzz_site_generator_end', 60 );


/**
 * Return the first image in a post. Works inside a loop.
 * @param [integer] $post_id [Post or page id]
 * @param [string/array] $size Image size. Either a string keyword (thumbnail, medium, large or full) or a 2-item array representing width and height in pixels, e.g. array(32,32).
 * @param [string/array] $attr Query string or array of attributes.
 * @return [string] image html
 *
 * @since NepalBuzz 0.1
 */

function nepalbuzz_get_first_image( $postID, $size, $attr, $src = false ) {
	ob_start();

	ob_end_clean();

	$image 	= '';

	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_post_field('post_content', $postID ) , $matches);

	if( isset( $matches[1][0] ) ) {
		//Get first image
		$first_img = $matches[1][0];

		if ( $src ) {
			//Return url of src is true
			return $first_img;
		}

		return '<img class="pngfix wp-post-image" src="'. esc_url( $first_img ) .'">';
	}

	return false;
}


if ( ! function_exists( 'nepalbuzz_scrollup' ) ) {
	/**
	 * This function loads Scroll Up Navigation
	 *
	 * @action nepalbuzz_footer action
	 * @uses set_transient and delete_transient
	 */
	function nepalbuzz_scrollup() {
		// get the data value from theme options
		$options = nepalbuzz_get_options();

		if ( ! $options['disable_scrollup'] ) {
			echo  '<a href="#masthead" id="scrollup"><span class="screen-reader-text">' . esc_html__( 'Scroll Up', 'nepalbuzz' ) . '</span></a>' ;
		}
	}
}
add_action( 'nepalbuzz_after', 'nepalbuzz_scrollup', 20 );


if ( ! function_exists( 'nepalbuzz_default_category' ) ) :
	/**
	 * Post get default category
	 */
	function nepalbuzz_default_category() {
		$meta = '';

		$categories = get_the_category();

		if ( ! empty( $categories ) && nepalbuzz_categorized_blog() ) {
			$meta .= sprintf( '<span class="cat-links">%1$s%2$s%3$s%4$s</span>',
				sprintf( _x( '<span class="screen-reader-text">Category</span>', 'Used before category name.', 'nepalbuzz' ) ),
				'<a href="' . get_category_link( $categories[0]->cat_ID ) . ' ">',
				esc_html( $categories[0]->name ),
				'</a>'
			);
		}

		return $meta;
	}
endif; //nepalbuzz_default_category


if ( ! function_exists( 'nepalbuzz_truncate_phrase' ) ) :
	/**
	 * Return a phrase shortened in length to a maximum number of characters.
	 *
	 * Result will be truncated at the last white space in the original string. In this function the word separator is a
	 * single space. Other white space characters (like newlines and tabs) are ignored.
	 *
	 * If the first `$max_characters` of the string does not contain a space character, an empty string will be returned.
	 *
	 * @since NepalBuzz 0.1
	 *
	 * @param string $text            A string to be shortened.
	 * @param integer $max_characters The maximum number of characters to return.
	 *
	 * @return string Truncated string
	 */
	function nepalbuzz_truncate_phrase( $text, $max_characters ) {

		$text = trim( $text );

		if ( mb_strlen( $text ) > $max_characters ) {
			//* Truncate $text to $max_characters + 1
			$text = mb_substr( $text, 0, $max_characters + 1 );

			//* Truncate to the last space in the truncated string
			$text = trim( mb_substr( $text, 0, mb_strrpos( $text, ' ' ) ) );
		}

		return $text;
	}
endif; //nepalbuzz_truncate_phrase


if ( ! function_exists( 'nepalbuzz_get_the_content_limit' ) ) :
	/**
	 * Return content stripped down and limited content.
	 *
	 * Strips out tags and shortcodes, limits the output to `$max_char` characters, and appends an ellipsis and more link to the end.
	 *
	 * @since NepalBuzz 0.1
	 *
	 * @param integer $max_characters The maximum number of characters to return.
	 * @param string  $more_link_text Optional. Text of the more link. Default is "(more...)".
	 * @param bool    $stripteaser    Optional. Strip teaser content before the more text. Default is false.
	 *
	 * @return string Limited content.
	 */
	function nepalbuzz_get_the_content_limit( $max_characters, $more_link_text = '(more...)', $stripteaser = false ) {

		$content = get_the_content( '', $stripteaser );

		//* Strip tags and shortcodes so the content truncation count is done correctly
		$content = strip_tags( strip_shortcodes( $content ), apply_filters( 'get_the_content_limit_allowedtags', '<script>,<style>' ) );

		//* Remove inline styles / scripts
		$content = trim( preg_replace( '#<(s(cript|tyle)).*?</\1>#si', '', $content ) );

		//* Truncate $content to $max_char
		$content = nepalbuzz_truncate_phrase( $content, $max_characters );

		//* More link?
		if ( $more_link_text ) {
			$link   = apply_filters( 'get_the_content_more_link', sprintf( '<span class="more-button"><a href="%s" class="more-link">%s</a></span>', esc_url( get_permalink() ), $more_link_text ), $more_link_text );
			$output = sprintf( '<p>%s %s</p>', $content, $link );
		} else {
			$output = sprintf( '<p>%s</p>', $content );
			$link = '';
		}

		return apply_filters( 'nepalbuzz_get_the_content_limit', $output, $content, $link, $max_characters );

	}
endif; //nepalbuzz_get_the_content_limit


if ( ! function_exists( 'nepalbuzz_post_navigation' ) ) :
	/**
	 * Displays Single post Navigation
	 *
	 * @uses  the_post_navigation
	 *
	 * @action nepalbuzz_after_post
	 *
	 * @since NepalBuzz 0.1
	 */
	function nepalbuzz_post_navigation() {
		// Previous/next post navigation.
		the_post_navigation( array(
			'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next &rarr;', 'nepalbuzz' ) . '</span> ' .
				'<span class="screen-reader-text">' . esc_html__( 'Next post:', 'nepalbuzz' ) . '</span> ' .
				'<span class="post-title">%title</span>',
			'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( '&larr; Previous', 'nepalbuzz' ) . '</span> ' .
				'<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'nepalbuzz' ) . '</span> ' .
				'<span class="post-title">%title</span>',
		) );
	}
endif; //nepalbuzz_post_navigation
add_action( 'nepalbuzz_after_post', 'nepalbuzz_post_navigation', 10 );



/**
 * Display Multiple Select type for and array of categories
 *
 * @param  [string] $name  [field name]
 * @param  [string] $id    [field_id]
 * @param  [array] $selected    [selected values]
 * @param  string $label [label of the field]
 */
function nepalbuzz_dropdown_categories( $name, $id, $selected, $label = '' ) {
	$dropdown = wp_dropdown_categories(
		array(
			'name'             => $name,
			'echo'             => 0,
			'hide_empty'       => false,
			'show_option_none' => false,
			'hierarchical'       => 1,
		)
	);

	if ( '' != $label ) {
		echo '<label for="' . $id . '">
			'. $label .'
			</label>';
	}

	$dropdown = str_replace('<select', '<select multiple = "multiple" style = "height:120px; width: 100%" ', $dropdown );

	foreach( $selected as $selected ) {
		$dropdown = str_replace( 'value="'. $selected .'"', 'value="'. $selected .'" selected="selected"', $dropdown );
	}

	echo $dropdown;

	echo '<span class="description">'. esc_html__( 'Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.', 'nepalbuzz' ) . '</span>';
}


/**
 * Return registered image sizes.
 *
 * Return a two-dimensional array of just the additionally registered image sizes, with width, height and crop sub-keys.
 *
 * @since 0.1.7
 *
 * @global array $_wp_additional_image_sizes Additionally registered image sizes.
 *
 * @return array Two-dimensional, with width, height and crop sub-keys.
 */
function nepalbuzz_get_additional_image_sizes() {
	global $_wp_additional_image_sizes;

	if ( $_wp_additional_image_sizes )
		return $_wp_additional_image_sizes;

	return array();
}


/**
 * Check if a section is enabled or not based on the $value parameter
 * @param  string $value Value of the section that is to be checked
 * @return boolean return true if section is enabled otherwise false
 */
function nepalbuzz_check_section( $value ) {
	global $wp_query;

	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();

	// Front page displays in Reading Settings
	$page_for_posts = get_option('page_for_posts');

	return ( 'entire-site' == $value  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $value  ) );
}
