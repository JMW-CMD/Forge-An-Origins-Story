<?php
/**
 * Forge: An Origins Story functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Forge: An Origins Story
 */

/*  PHP that constructs all of the ACF Pro Options pages and field groups that store that data for all:
    Forge: Custom Settings
    Forge: Custom Content

    Is located in "acf-json" folder.

*/

//  Forge: Custom Settings -> generates custom information in behind-the-scenes code.
include 'forge-includes/forge-custom-settings.php';

//  Forge: Custom Content -> generates custom content displayed (usually) on the screen.
include 'forge-includes/forge-custom-content.php';

//  Register and deregister scripts and stylesheets. //
function forge_scripts() {
	 
    //CSS:
    
        // Add Custom CSS //
        wp_enqueue_style( 'forge-custom-style', get_stylesheet_directory_uri() . '/style.css',  array(), null  );
        
        // Remove Classic Theme Styles //
        wp_dequeue_style( 'classic-theme-styles' );

        // Remove Global Styles //
        wp_dequeue_style( 'global-styles' );

        // Remove Gutenberg Stylesheets //
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );

	//JS:
    
        // Remove default jQuery //
        wp_deregister_script( 'jquery' );

        // Add local jQuery //
        wp_enqueue_script( 'local-jquery', get_template_directory_uri() . '/js/jquery.js', array(), null, true );

        // Add Custom JS with dependance on local Jquery //   
        wp_enqueue_script( 'forge-custom', get_template_directory_uri() . '/js/custom.js', array( 'local-jquery' ), null, true );

        // Google Maps Scripts //
        //wp_enqueue_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAn19E61ZEDmWxtF8IyjPycFrTw0zYqXLo&callback=Function.prototype"',array(), null );

}
add_action( 'wp_enqueue_scripts', 'forge_scripts' );

// ACF Pro Google Maps Support
/*
function my_acf_init() {

    acf_update_setting('google_api_key', 'AIzaSyAn19E61ZEDmWxtF8IyjPycFrTw0zYqXLo');

}
add_action('acf/init', 'my_acf_init');
*/

// 'https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=Function.prototype"'

// START REMOVING STUFF //

// Clean head & Remove admin bar //
if( !is_admin() ) :
	 
    // clean head
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'index_rel_link' );
    remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
    remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'feed_links_extra', 3 ); 
    remove_action( 'wp_head', 'feed_links', 2 );
    remove_action( 'wp_head', 'wp_print_auto_sizes_contain_css_fix', 1 );
    
    // Remove Head API //
    remove_action( 'wp_head', 'rest_output_link_wp_head');
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links');
		 
    //Remove admin bar if not in admin
    add_filter( 'show_admin_bar', '__return_false' );

endif;

function disable_emoji_support(){
	 
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
	 
    add_filter( 'emoji_svg_url', '__return_false' );

}
add_action( 'init', 'disable_emoji_support' );

// Remove Admin Menus //
function forge_remove_menus() {

    remove_menu_page( 'index.php' );                   //Dashboard
    remove_menu_page( 'edit-comments.php' );           //Comments
    remove_menu_page( 'users.php' );                   //Users
    //remove_menu_page( 'edit.php' );                  //Posts
    //remove_menu_page( 'upload.php' );                //Media
    //remove_menu_page( 'edit.php?post_type=page' );   //Pages
    //remove_menu_page( 'themes.php' );                //Appearance          
    //remove_menu_page( 'plugins.php' );               //Plugins
    //remove_menu_page( 'tools.php' );                 //Tools
    //remove_menu_page( 'options-general.php' );       //Settings

}
add_action( 'admin_menu', 'forge_remove_menus' );

//Remove recent comments style // 
function forge_remove_recent_comments_style() {
    
    global $wp_widget_factory;
    remove_action( 'wp_head', array( $wp_widget_factory->widgets[ 'WP_Widget_Recent_Comments' ], 'recent_comments_style' ) );

}
add_action( 'widgets_init', 'forge_remove_recent_comments_style' );




// Remove footer admin bar //
remove_action( 'wp_footer', 'wp_admin_bar_render', 1000 );

// Remove admin login header //
function remove_admin_login_header() {
    
    remove_action( 'wp_head', '_admin_bar_bump_cb' );

}
add_action( 'get_header', 'remove_admin_login_header' );

?>