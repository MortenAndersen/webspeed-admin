<?php 

/*
Plugin Name: Webspeed Admin
Version: 1.0
Plugin URI: https://www.web.dk
Description: Styling af ADMIN
Author: Morten Andersen
Text Domain: webspeeed-admin-domain
Author URI: https://www.web.dk.dk
*/


add_action( 'admin_enqueue_scripts', 'load_admin_style' );
function load_admin_style() {

    wp_register_style('webspeed-admin-styles', plugins_url('/css/webspeed-admin-styles.css',__FILE__));
    wp_enqueue_style('webspeed-admin-styles');
    
}



/**
 * Add User Role Class to Body
 * Referenced code from http://www.studiok40.com/
 */
function print_user_classes() {
    if ( is_user_logged_in() ) {
        add_filter('body_class','class_to_body');
        add_filter('admin_body_class', 'class_to_body_admin');
    }
}
add_action('init', 'print_user_classes');
 
/// Add user role class to front-end body tag
function class_to_body($classes) {
    global $current_user;
    $user_role = array_shift($current_user->roles);
    $classes[] = $user_role.' ';
    return $classes;
}
 
/// Add user role class and user id to front-end body tag
 
// add 'class-name' to the $classes array
function class_to_body_admin($classes) {
    global $current_user;
    $user_role = array_shift($current_user->roles);
    /* Adds the user id to the admin body class array */
    $user_ID = $current_user->ID;
    $classes = $user_role.' '.'user-id-'.$user_ID ;
    return $classes;
    return 'user-id-'.$user_ID;
}