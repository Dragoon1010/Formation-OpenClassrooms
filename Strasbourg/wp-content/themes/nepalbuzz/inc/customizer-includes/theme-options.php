<?php
/**
* The template for adding additional theme options in Customizer
*
* @package NepalBuzz
*/

// Additional Color Scheme (added to Color Scheme section in Theme Customizer)

//Theme Options
$wp_customize->add_panel( 'nepalbuzz_theme_options', array(
    'description'    => esc_html__( 'Basic theme Options', 'nepalbuzz' ),
    'priority'       => 200,
    'title'    		 => esc_html__( 'Theme Options', 'nepalbuzz' ),
) );

// Breadcrumb Option
$wp_customize->add_section( 'nepalbuzz_breadcrumb_options', array(
	'description'	=> esc_html__( 'Breadcrumbs are a great way of letting your visitors find out where they are on your site with just a glance. You can enable/disable them on homepage and entire site.', 'nepalbuzz' ),
	'panel'			=> 'nepalbuzz_theme_options',
	'title'    		=> esc_html__( 'Breadcrumb Options', 'nepalbuzz' ),
	'priority' 		=> 201,
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[breadcrumb_option]', array(
	'default'			=> $defaults['breadcrumb_option'],
	'sanitize_callback' => 'nepalbuzz_sanitize_checkbox'
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[breadcrumb_option]', array(
	'label'    => esc_html__( 'Check to enable Breadcrumb', 'nepalbuzz' ),
	'section'  => 'nepalbuzz_breadcrumb_options',
	'settings' => 'nepalbuzz_theme_options[breadcrumb_option]',
	'type'     => 'checkbox',
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[breadcrumb_on_homepage]', array(
	'default'			=> $defaults['breadcrumb_on_homepage'],
	'sanitize_callback' => 'nepalbuzz_sanitize_checkbox'
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[breadcrumb_on_homepage]', array(
	'label'    => esc_html__( 'Check to enable Breadcrumb on Homepage', 'nepalbuzz' ),
	'section'  => 'nepalbuzz_breadcrumb_options',
	'settings' => 'nepalbuzz_theme_options[breadcrumb_on_homepage]',
	'type'     => 'checkbox',
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[breadcrumb_seperator]', array(
	'default'			=> $defaults['breadcrumb_seperator'],
	'sanitize_callback'	=> 'sanitize_text_field',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[breadcrumb_seperator]', array(
	'input_attrs' => array(
    		'style' => 'width: 40px;'
		),
	'label'    	=> esc_html__( 'Separator between Breadcrumbs', 'nepalbuzz' ),
	'section' 	=> 'nepalbuzz_breadcrumb_options',
	'settings' 	=> 'nepalbuzz_theme_options[breadcrumb_seperator]',
	'type'     	=> 'text'
	)
);
// Breadcrumb Option End

// Excerpt Options
$wp_customize->add_section( 'nepalbuzz_excerpt_options', array(
	'panel'  	=> 'nepalbuzz_theme_options',
	'priority' 	=> 204,
	'title'    	=> esc_html__( 'Excerpt Options', 'nepalbuzz' ),
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[excerpt_length]', array(
	'default'			=> $defaults['excerpt_length'],
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[excerpt_length]', array(
	'description' => __('Excerpt length. Default is 30 words', 'nepalbuzz'),
	'input_attrs' => array(
        'min'   => 10,
        'max'   => 200,
        'step'  => 5,
        'style' => 'width: 60px;'
        ),
    'label'    => esc_html__( 'Excerpt Length (words)', 'nepalbuzz' ),
	'section'  => 'nepalbuzz_excerpt_options',
	'settings' => 'nepalbuzz_theme_options[excerpt_length]',
	'type'	   => 'number',
	)
);

$wp_customize->add_setting( 'nepalbuzz_theme_options[excerpt_more_text]', array(
	'default'			=> $defaults['excerpt_more_text'],
	'sanitize_callback'	=> 'sanitize_text_field',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[excerpt_more_text]', array(
	'label'    => esc_html__( 'Continue reading Text', 'nepalbuzz' ),
	'section'  => 'nepalbuzz_excerpt_options',
	'settings' => 'nepalbuzz_theme_options[excerpt_more_text]',
	'type'	   => 'text',
) );
// Excerpt Options End

//Homepage / Frontpage Options
$wp_customize->add_section( 'nepalbuzz_homepage_options', array(
	'description'	=> esc_html__( 'Only posts that belong to the categories selected here will be displayed on the front page', 'nepalbuzz' ),
	'panel'			=> 'nepalbuzz_theme_options',
	'priority' 		=> 209,
	'title'   	 	=> esc_html__( 'Homepage / Frontpage Options', 'nepalbuzz' ),
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[front_page_category]', array(
	'default'			=> $defaults['front_page_category'],
	'sanitize_callback'	=> 'nepalbuzz_sanitize_category_list',
) );

$wp_customize->add_control( new nepalbuzz_Customize_Dropdown_Categories_Control( $wp_customize, 'nepalbuzz_theme_options[front_page_category]', array(
    'label'   	=> esc_html__( 'Select Categories', 'nepalbuzz' ),
    'name'	 	=> 'nepalbuzz_theme_options[front_page_category]',
	'priority'	=> '6',
    'section'  	=> 'nepalbuzz_homepage_options',
    'settings' 	=> 'nepalbuzz_theme_options[front_page_category]',
    'type'     	=> 'dropdown-categories',
) ) );
//Homepage / Frontpage Settings End

// Layout Options
$wp_customize->add_section( 'nepalbuzz_layout', array(
	'panel'		=> 'nepalbuzz_theme_options',
	'priority'	=> 211,
	'title'		=> esc_html__( 'Layout Options', 'nepalbuzz' ),
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[theme_layout]', array(
	'default'			=> $defaults['theme_layout'],
	'sanitize_callback' => 'nepalbuzz_sanitize_select',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[theme_layout]', array(
	'choices'  => nepalbuzz_layouts(),
	'label'    => esc_html__( 'Default Layout', 'nepalbuzz' ),
	'section'  => 'nepalbuzz_layout',
	'settings' => 'nepalbuzz_theme_options[theme_layout]',
	'type'     => 'select',
	'priority' => 1,
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[single_layout]', array(
	'capability'        => 'edit_theme_options',
	'default'           => $defaults['single_layout'],
	'sanitize_callback' => 'nepalbuzz_sanitize_select',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[single_layout]', array(
	'choices'  => nepalbuzz_layouts(),
	'label'    => esc_html__( 'Single Page/Post Layout', 'nepalbuzz' ),
	'section'  => 'nepalbuzz_layout',
	'settings' => 'nepalbuzz_theme_options[single_layout]',
	'type'     => 'select',
	'priority' => 2,
) );


$wp_customize->add_setting( 'nepalbuzz_theme_options[content_layout]', array(
	'default'			=> $defaults['content_layout'],
	'sanitize_callback' => 'nepalbuzz_sanitize_select',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[content_layout]', array(
	'choices'  => nepalbuzz_get_archive_content_layout(),
	'label'    => esc_html__( 'Archive Content Layout', 'nepalbuzz' ),
	'section'  => 'nepalbuzz_layout',
	'settings' => 'nepalbuzz_theme_options[content_layout]',
	'type'     => 'select',
	'priority' => 4,
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[single_post_image_layout]', array(
	'default'			=> $defaults['single_post_image_layout'],
	'sanitize_callback' => 'nepalbuzz_sanitize_select',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[single_post_image_layout]', array(
	'label'    => esc_html__( 'Single Page/Post Image Layout ', 'nepalbuzz' ),
	'section'  => 'nepalbuzz_layout',
	'settings' => 'nepalbuzz_theme_options[single_post_image_layout]',
	'type'     => 'select',
	'choices'  => nepalbuzz_image_sizes_options(),
	'priority' => 5,
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[hide_archive_footer_meta]', array(
	'default'			=> $defaults['hide_archive_footer_meta'],
	'sanitize_callback' => 'nepalbuzz_sanitize_checkbox'
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[hide_archive_footer_meta]', array(
	'label'    => esc_html__( 'Check to hide Archive Post\'s Footer Meta', 'nepalbuzz' ),
	'section'  => 'nepalbuzz_layout',
	'settings' => 'nepalbuzz_theme_options[hide_archive_footer_meta]',
	'type'     => 'checkbox',
	'priority' => 6,
) );
// Layout Options End

// Pagination Options
$nav_desc = sprintf(
	wp_kses(
		__( 'Infinite Scroll Options requires %1$sJetPack Plugin%2$s with Infinite Scroll module Enabled.', 'nepalbuzz' ),
		array(
			'a' => array(
				'href' => array(),
				'target' => array(),
			),
			'br'=> array()
		)
	),
	'<a target="_blank" href=" ' . esc_url( 'https://wordpress.org/plugins/jetpack/' ) . ' ">',
	'</a>'
);

$wp_customize->add_section( 'nepalbuzz_pagination_options', array(
	'description'	=> $nav_desc,
	'panel'  		=> 'nepalbuzz_theme_options',
	'priority'		=> 212,
	'title'    		=> esc_html__( 'Pagination Options', 'nepalbuzz' ),
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[pagination_type]', array(
	'default'			=> $defaults['pagination_type'],
	'sanitize_callback' => 'sanitize_key',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[pagination_type]', array(
	'choices'  => nepalbuzz_get_pagination_types(),
	'label'    => esc_html__( 'Pagination type', 'nepalbuzz' ),
	'section'  => 'nepalbuzz_pagination_options',
	'settings' => 'nepalbuzz_theme_options[pagination_type]',
	'type'	   => 'select',
) );
// Pagination Options End

//Promotion Headline Options
$wp_customize->add_section( 'nepalbuzz_promotion_headline_options', array(
	'description'	=> esc_html__( 'To disable the fields, simply leave them empty.', 'nepalbuzz' ),
	'panel'			=> 'nepalbuzz_theme_options',
	'priority' 		=> 213,
	'title'   	 	=> esc_html__( 'Promotion Headline Options', 'nepalbuzz' ),
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[promotion_headline_option]', array(
	'default'			=> $defaults['promotion_headline_option'],
	'sanitize_callback' => 'nepalbuzz_sanitize_select',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[promotion_headline_option]', array(
	'choices'  	=> nepalbuzz_featured_section_options(),
	'label'    	=> esc_html__( 'Enable Promotion Headline on', 'nepalbuzz' ),
	'priority'	=> '1',
	'section'  	=> 'nepalbuzz_promotion_headline_options',
	'settings' 	=> 'nepalbuzz_theme_options[promotion_headline_option]',
	'type'	  	=> 'select',
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[promotion_headline]', array(
	'default' 			=> $defaults['promotion_headline'],
	'sanitize_callback'	=> 'wp_kses_post'
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[promotion_headline]', array(
	'description'	=> esc_html__( 'Appropriate Words: 10', 'nepalbuzz' ),
	'label'    	=> esc_html__( 'Promotion Headline Text', 'nepalbuzz' ),
	'priority'	=> '3',
	'section' 	=> 'nepalbuzz_promotion_headline_options',
	'settings'	=> 'nepalbuzz_theme_options[promotion_headline]',
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[promotion_subheadline]', array(
	'default' 			=> $defaults['promotion_subheadline'],
	'sanitize_callback'	=> 'wp_kses_post'
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[promotion_subheadline]', array(
	'description'	=> esc_html__( 'Appropriate Words: 15', 'nepalbuzz' ),
	'label'    	=> esc_html__( 'Promotion Subheadline Text', 'nepalbuzz' ),
	'priority'	=> '4',
	'section' 	=> 'nepalbuzz_promotion_headline_options',
	'settings'	=> 'nepalbuzz_theme_options[promotion_subheadline]',
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[promotion_headline_button]', array(
	'default' 			=> $defaults['promotion_headline_button'],
	'sanitize_callback'	=> 'sanitize_text_field'
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[promotion_headline_button]', array(
	'description'	=> esc_html__( 'Appropriate Words: 3', 'nepalbuzz' ),
	'label'    	=> esc_html__( 'Promotion Headline Button Text ', 'nepalbuzz' ),
	'priority'	=> '5',
	'section' 	=> 'nepalbuzz_promotion_headline_options',
	'settings'	=> 'nepalbuzz_theme_options[promotion_headline_button]',
	'type'		=> 'text',
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[promotion_headline_url]', array(
	'default' 			=> $defaults['promotion_headline_url'],
	'sanitize_callback'	=> 'esc_url_raw'
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[promotion_headline_url]', array(
	'label'    	=> esc_html__( 'Promotion Headline Link', 'nepalbuzz' ),
	'priority'	=> '6',
	'section' 	=> 'nepalbuzz_promotion_headline_options',
	'settings'	=> 'nepalbuzz_theme_options[promotion_headline_url]',
	'type'		=> 'text',
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[promotion_headline_target]', array(
	'default' 			=> $defaults['promotion_headline_target'],
	'sanitize_callback' => 'nepalbuzz_sanitize_checkbox',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[promotion_headline_target]', array(
	'label'    	=> esc_html__( 'Check to Open Link in New Window/Tab', 'nepalbuzz' ),
	'priority'	=> '7',
	'section'  	=> 'nepalbuzz_promotion_headline_options',
	'settings' 	=> 'nepalbuzz_theme_options[promotion_headline_target]',
	'type'     	=> 'checkbox',
) );
// Promotion Headline Options End

// Scrollup
$wp_customize->add_section( 'nepalbuzz_scrollup', array(
	'panel'    => 'nepalbuzz_theme_options',
	'priority' => 215,
	'title'    => esc_html__( 'Scrollup Options', 'nepalbuzz' ),
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[disable_scrollup]', array(
	'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['disable_scrollup'],
	'sanitize_callback' => 'nepalbuzz_sanitize_checkbox',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[disable_scrollup]', array(
	'label'		=> esc_html__( 'Check to disable Scroll Up', 'nepalbuzz' ),
	'section'   => 'nepalbuzz_scrollup',
    'settings'  => 'nepalbuzz_theme_options[disable_scrollup]',
	'type'		=> 'checkbox',
) );
// Scrollup End

// Search Options
$wp_customize->add_section( 'nepalbuzz_search_options', array(
	'description'=> esc_html__( 'Change default placeholder text in Search.', 'nepalbuzz'),
	'panel'  => 'nepalbuzz_theme_options',
	'priority' => 216,
	'title'    => esc_html__( 'Search Options', 'nepalbuzz' ),
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[search_text]', array(
	'default'			=> $defaults['search_text'],
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[search_text]', array(
	'label'		=> esc_html__( 'Default Display Text in Search', 'nepalbuzz' ),
	'section'   => 'nepalbuzz_search_options',
    'settings'  => 'nepalbuzz_theme_options[search_text]',
	'type'		=> 'text',
) );
// Search Options End
