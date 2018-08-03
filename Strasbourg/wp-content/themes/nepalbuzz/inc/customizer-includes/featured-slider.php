<?php
/**
* The template for adding Featured Slider Options in Customizer
*
* @package NepalBuzz
*/
// Featured Slider
$wp_customize->add_section( 'nepalbuzz_featured_slider', array(
	'priority' => 500,
	'title'    => esc_html__( 'Featured Slider', 'nepalbuzz' ),
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[featured_slider_option]', array(
	'default'			=> $defaults['featured_slider_option'],
	'sanitize_callback' => 'nepalbuzz_sanitize_select',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[featured_slider_option]', array(
	'choices'   => nepalbuzz_featured_section_options(),
	'label'    	=> esc_html__( 'Enable Slider on', 'nepalbuzz' ),
	'priority'	=> '2',
	'section'  	=> 'nepalbuzz_featured_slider',
	'settings' 	=> 'nepalbuzz_theme_options[featured_slider_option]',
	'type'    	=> 'select',
) );

$wp_customize->add_setting( 'nepalbuzz_theme_options[featured_slider_transition_effect]', array(
	'default'			=> $defaults['featured_slider_transition_effect'],
	'sanitize_callback'	=> 'nepalbuzz_sanitize_select',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[featured_slider_transition_effect]' , array(
	'active_callback' => 'nepalbuzz_is_slider_active',
	'choices'         => nepalbuzz_featured_slider_transition_effects(),
	'label'           => esc_html__( 'Transition Effect', 'nepalbuzz' ),
	'priority'        => '3',
	'section'         => 'nepalbuzz_featured_slider',
	'settings'        => 'nepalbuzz_theme_options[featured_slider_transition_effect]',
	'type'            => 'select',
	)
);

$wp_customize->add_setting( 'nepalbuzz_theme_options[featured_slider_transition_delay]', array(
	'default'			=> $defaults['featured_slider_transition_delay'],
	'sanitize_callback'	=> 'absint',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[featured_slider_transition_delay]' , array(
	'active_callback'	=> 'nepalbuzz_is_slider_active',
	'description'	=> esc_html__( 'seconds(s)', 'nepalbuzz' ),
	'input_attrs' => array(
    	'style' => 'width: 40px;'
	),
	'label'    		=> esc_html__( 'Transition Delay', 'nepalbuzz' ),
	'priority'		=> '4',
	'section'  		=> 'nepalbuzz_featured_slider',
	'settings' 		=> 'nepalbuzz_theme_options[featured_slider_transition_delay]',
	)
);

$wp_customize->add_setting( 'nepalbuzz_theme_options[featured_slider_transition_length]', array(
	'default'			=> $defaults['featured_slider_transition_length'],
	'sanitize_callback'	=> 'absint',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[featured_slider_transition_length]' , array(
	'active_callback'	=> 'nepalbuzz_is_slider_active',
	'description'	=> esc_html__( 'seconds(s)', 'nepalbuzz' ),
	'input_attrs' => array(
    	'style' => 'width: 40px;'
	),
	'label'    		=> esc_html__( 'Transition Length', 'nepalbuzz' ),
	'priority'		=> '5',
	'section'  		=> 'nepalbuzz_featured_slider',
	'settings' 		=> 'nepalbuzz_theme_options[featured_slider_transition_length]',
	)
);

$wp_customize->add_setting( 'nepalbuzz_theme_options[featured_slider_number]', array(
	'default'			=> $defaults['featured_slider_number'],
	'sanitize_callback'	=> 'nepalbuzz_sanitize_number_range',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[featured_slider_number]' , array(
		'active_callback'	=> 'nepalbuzz_is_slider_active',
		'description'	=> esc_html__( 'Save and refresh the page if No. of Slides is changed (Max no of slides is 20)', 'nepalbuzz' ),
		'input_attrs' 	=> array(
            'style' => 'width: 45px;',
            'min'   => 0,
            'max'   => 20,
            'step'  => 1,
        	),
		'label'    		=> esc_html__( 'No of Slides', 'nepalbuzz' ),
		'priority'		=> '8',
		'section'  		=> 'nepalbuzz_featured_slider',
		'settings' 		=> 'nepalbuzz_theme_options[featured_slider_number]',
		'type'	   		=> 'number',
		'transport'		=> 'postMessage'
	)
);

$wp_customize->add_setting( 'nepalbuzz_theme_options[featured_slider_content_show]', array(
	'default'			=> $defaults['featured_slider_content_show'],
	'sanitize_callback'	=> 'nepalbuzz_sanitize_select',
) );

$wp_customize->add_control( 'nepalbuzz_theme_options[featured_slider_content_show]', array(
	'active_callback' => 'nepalbuzz_is_slider_active',
	'choices'         => nepalbuzz_featured_content_show(),
	'label'           => esc_html__( 'Display Content', 'nepalbuzz' ),
	'section'         => 'nepalbuzz_featured_slider',
	'settings'        => 'nepalbuzz_theme_options[featured_slider_content_show]',
	'type'            => 'select',
) );

//loop for featured page sliders
for ( $i=1; $i <= $options['featured_slider_number'] ; $i++ ) {
	$wp_customize->add_setting( 'nepalbuzz_theme_options[featured_slider_page_'. $i .']', array(
		'sanitize_callback'	=> 'nepalbuzz_sanitize_page',
	) );

	$wp_customize->add_control( 'nepalbuzz_theme_options[featured_slider_page_'. $i .']', array(
		'active_callback'	=> 'nepalbuzz_is_slider_active',
		'label'    	=> esc_html__( 'Featured Page', 'nepalbuzz' ) . ' # ' . $i ,
		'priority'	=> '11' . $i,
		'section'  	=> 'nepalbuzz_featured_slider',
		'settings' 	=> 'nepalbuzz_theme_options[featured_slider_page_'. $i .']',
		'type'	   	=> 'dropdown-pages',
	) );
}
// Featured Slider End
