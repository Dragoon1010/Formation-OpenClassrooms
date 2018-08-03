<?php
add_filter('login_errors', create_function('$a', "return null;"));
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
remove_action('wp_head', 'wp_generator');

function  theme_enqueue_styles()  
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_uri(), array('parent-style'));
}
