<?php
/**
 * Adding Social Links in Customizer
 *
 * @package NepalBuzz
 */

$wp_customize->add_section( 'nepalbuzz_social_links', array(
	'priority' => 700,
	'title'    => esc_html__( 'Social Links', 'nepalbuzz' ),
) );

$social_icons = nepalbuzz_get_social_icons_list();

foreach ( $social_icons as $key => $value ) {
	$description       = '';
	$sanitize_callback = 'esc_url_raw';

	if ( 'skype_link' === $key || 'handset_link' === $key || 'phone_link' === $key ) {
		// Skype, headset and phone links take plain text as input
		$sanitize_callback = 'sanitize_text_field';

		if ( 'skype_link' === $key ) {
			// Add skype description for user doc.
			$description       = esc_html__( 'Skype link can be of formats: callto://+{number} or skype:{username}?{action}. More Information in readme.txt file', 'nepalbuzz' );
		}
	} elseif ( 'email_link' === $key ) {
		$sanitize_callback = 'sanitize_email';
	}

	$wp_customize->add_setting( 'nepalbuzz_theme_options[' . $key . ']', array(
		'sanitize_callback' => $sanitize_callback,
		'description'       => $description,
	) );

	$wp_customize->add_control( 'nepalbuzz_theme_options[' . $key . ']', array(

		'label'    		=> $value['label'],
		'section'  		=> 'nepalbuzz_social_links',
		'settings' 		=> 'nepalbuzz_theme_options[' . $key . ']',
	) );
}
