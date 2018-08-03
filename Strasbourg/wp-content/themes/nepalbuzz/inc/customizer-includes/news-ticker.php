<?php
/**
* The template for adding News Ticker Settings in Customizer
*
* @package NepalBuzz
*/
// News Ticker Options

$wp_customize->add_section( 'nepalbuzz_news_ticker_settings', array(
	'priority' => 400,
	'title'    => esc_html__( 'News Ticker', 'nepalbuzz' ),
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[news_ticker_option]', array(
	'default'			=> $defaults['news_ticker_option'],
	'sanitize_callback' => 'nepalbuzz_sanitize_select',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[news_ticker_option]', array(
	'choices'  	=> nepalbuzz_featured_section_options(),
	'label'    	=> esc_html__( 'Enable News Ticker on', 'nepalbuzz' ),
	'priority'	=> '1',
	'section'  	=> 'nepalbuzz_news_ticker_settings',
	'settings' 	=> 'nepalbuzz_theme_options[news_ticker_option]',
	'type'	  	=> 'select',
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[news_ticker_transition_effect]', array(
	'default'			=> $defaults['news_ticker_transition_effect'],
	'sanitize_callback'	=> 'nepalbuzz_sanitize_select',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[news_ticker_transition_effect]' , array(
	'active_callback' => 'nepalbuzz_is_news_ticker_active',
	'choices'         => nepalbuzz_featured_slider_transition_effects(),
	'label'           => esc_html__( 'Transition Effect', 'nepalbuzz' ),
	'priority'        => '4',
	'section'         => 'nepalbuzz_news_ticker_settings',
	'settings'        => 'nepalbuzz_theme_options[news_ticker_transition_effect]',
	'type'            => 'select',
	)
);

$wp_customize->add_setting( 'nepalbuzz_theme_options[news_ticker_label]', array(
	'default'			=> $defaults['news_ticker_label'],
	'sanitize_callback'	=> 'wp_kses_post',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[news_ticker_label]' , array(
	'active_callback'	=> 'nepalbuzz_is_news_ticker_active',
	'description'	=> esc_html__( 'Leave field empty if you want to remove Headline', 'nepalbuzz' ),
	'label'    		=> esc_html__( 'News Ticker Label', 'nepalbuzz' ),
	'priority'		=> '4',
	'section'  		=> 'nepalbuzz_news_ticker_settings',
	'settings' 		=> 'nepalbuzz_theme_options[news_ticker_label]',
	'type'	   		=> 'text',
	)
);

$wp_customize->add_setting( 'nepalbuzz_theme_options[news_ticker_number]', array(
	'default'			=> $defaults['news_ticker_number'],
	'sanitize_callback'	=> 'nepalbuzz_sanitize_number_range',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[news_ticker_number]' , array(
	'active_callback'	=> 'nepalbuzz_is_news_ticker_active',
	'description'	=> esc_html__( 'Save and refresh the page if No. of News Ticker is changed (Max no of News Ticker is 20)', 'nepalbuzz' ),
	'input_attrs' 	=> array(
        'style' => 'width: 45px;',
        'min'   => 0,
        'max'   => 20,
        'step'  => 1,
    	),
	'label'    		=> esc_html__( 'No of News Ticker', 'nepalbuzz' ),
	'priority'		=> '6',
	'section'  		=> 'nepalbuzz_news_ticker_settings',
	'settings' 		=> 'nepalbuzz_theme_options[news_ticker_number]',
	'type'	   		=> 'number',
	'transport'		=> 'postMessage'
	)
);

for ( $i=1; $i <=  $options['news_ticker_number'] ; $i++ ) {
	$wp_customize->add_setting( 'nepalbuzz_theme_options[news_ticker_page_'. $i .']', array(
		'sanitize_callback'	=> 'nepalbuzz_sanitize_page',
	) );

	$wp_customize->add_control( 'nepalbuzz_news_ticker_page_'. $i .'', array(
		'active_callback' => 'nepalbuzz_is_news_ticker_active',
		'label'           => esc_html__( 'Page', 'nepalbuzz' ) . ' ' . $i ,
		'section'         => 'nepalbuzz_news_ticker_settings',
		'settings'        => 'nepalbuzz_theme_options[news_ticker_page_'. $i .']',
		'type'            => 'dropdown-pages',
	) );
}
// News Ticker Setting End
