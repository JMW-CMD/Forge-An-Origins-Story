<?php
/**
* The Index page for our theme
*
* This is the page that initializes variables and assembles the template parts that form the website 
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package Forge: An Origins Story
*/

//session_start();

//  AIzaSyAn19E61ZEDmWxtF8IyjPycFrTw0zYqXLo Google API Key

// Define constants for paths if needed
define( "SITE_PATH",     get_template_directory_uri() );
define( "SCRIPT_PATH",   SITE_PATH."/scripts/" );
define( "STYLE_PATH",    SITE_PATH."styles/" );
define( "INCLUDE_PATH",  SITE_PATH."includes/" );

// Get the ID, slug and post type of the current post and store in an array
$post_ID   =   get_the_ID();
$post_type =   ( is_front_page() ) ? 'home' : get_post_type ( $post_ID );
$post_slug =   ( is_front_page() ) ? 'home' : get_post( $post_ID )->post_name;
$post_info =   [  'post_id'   => $post_ID, 
                  'post_slug' => $post_slug, 
                  'post_type' => $post_type
               ];

//  Check if page name is registered in ACF "Assign Post Templates" options page and return the page name and template list
$page_template_parts = forge_page_templates( $post_info );

//  If the page name is unregistered, redirect to the homepage
if ( $page_template_parts && $page_template_parts[ 'page_name' ] === 'unregistered' && !is_front_page() ) :
    
    header( 'Location:'.get_home_url() );
    die();

endif;

// Disable Contact Form 7 scripts if not needed on the current page
function toggle_contact_form_7_scripts(){ 

    if( str_contains( get_field( 'contact_form_7' ), 'wpcf7' ) ) : //All CF7 forms contain the string 'wpcf7'

        function reorder_contact_form_7_js(){

            // Add Contact Form 7's JavaScript with dependency on local jQuery
            wp_deregister_script( 'contact-form-7' );
            wp_enqueue_script( 'contact-form-7', plugins_url( 'includes/js/scripts.js', WPCF7_PLUGIN ), array( 'local-jquery' ), WPCF7_VERSION, true );

        }
        add_action ( 'wp_enqueue_scripts', 'reorder_contact_form_7_js' );
    
    else:
        
        add_filter( 'wpcf7_load_js', '__return_false' );
        add_filter( 'wpcf7_load_css', '__return_false' );

    endif;

}
toggle_contact_form_7_scripts();
                                                                   
?>
<!doctype HTML>

<html <?php language_attributes(); ?>>

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php print get_bloginfo( 'name' ).' | '.get_bloginfo( 'description' ); ?></title>

<!--

**  This website built with
**  Forge: An Origins Story
**  Author: Jeremy Weaver
**  Description: A WordPress starter theme. Forge YOUR online origins story.
**  Version: 0.1.0
**  Website: https://x.com/cheez_czar

AN ORIGINS__________________________________________________________________
      ___           ___           ___           ___           ___                       
     /\__\         /\  \         /\  \         /\__\         /\__\                      
    /:/ _/_       /::\  \       /::\  \       /:/ _/_       /:/ _/_      __               
   /:/ /\__\     /:/\:\  \     /:/\:\__\     /:/ /\  \     /:/ /\__\    /\_\                
  /:/ /:/  /    /:/  \:\  \   /:/ /:/  /    /:/ /::\  \   /:/ /:/ _/_   \/_/                
 /:/_/:/  /    /:/__/ \:\__\ /:/_/:/__/___ /:/__\/\:\__\ /:/_/:/ /\__\                  
 \:\/:/  /     \:\  \ /:/  / \:\/:::::/  / \:\  \ /:/  / \:\/:/ /:/  /   __                
  \::/__/       \:\  /:/  /   \::/~~/~~~~   \:\  /:/  /   \::/_/:/  /   /\_\                
   \:\  \        \:\/:/  /     \:\~~\        \:\/:/  /     \:\/:/  /    \/_/                
    \:\__\        \::/  /       \:\__\        \::/  /       \::/  /                     
     \/__/         \/__/         \/__/         \/__/         \/__/   
_______________________________________________________________________STORY

-->

<!-- USER-DEFINED META TAGS -->
<?php forge_meta_tags(); ?>

<!-- WORDPRESS-DEFINED SCRIPTS AND TAGS -->
<?php wp_head(); ?>

<!--

PRESENTING:

 /$$$$$$$     /$$$$$       /$$$$$$$  /$$$$$$  /$$$$$$  /$$      /$$  /$$$$$$  /$$   /$$ /$$$$$$$        /$$       /$$$$$$$$ /$$$$$$$$
| $$__  $$   |__  $$      | $$__  $$|_  $$_/ /$$__  $$| $$$    /$$$ /$$__  $$| $$$ | $$| $$__  $$      | $$      | $$_____/| $$_____/
| $$  \ $$      | $$      | $$  \ $$  | $$  | $$  \ $$| $$$$  /$$$$| $$  \ $$| $$$$| $$| $$  \ $$      | $$      | $$      | $$      
| $$  | $$      | $$      | $$  | $$  | $$  | $$$$$$$$| $$ $$/$$ $$| $$  | $$| $$ $$ $$| $$  | $$      | $$      | $$$$$   | $$$$$   
| $$  | $$ /$$  | $$      | $$  | $$  | $$  | $$__  $$| $$  $$$| $$| $$  | $$| $$  $$$$| $$  | $$      | $$      | $$__/   | $$__/   
| $$  | $$| $$  | $$      | $$  | $$  | $$  | $$  | $$| $$\  $ | $$| $$  | $$| $$\  $$$| $$  | $$      | $$      | $$      | $$      
| $$$$$$$/|  $$$$$$/      | $$$$$$$/ /$$$$$$| $$  | $$| $$ \/  | $$|  $$$$$$/| $$ \  $$| $$$$$$$/      | $$$$$$$$| $$$$$$$$| $$$$$$$$
|_______/  \______/       |_______/ |______/|__/  |__/|__/     |__/ \______/ |__/  \__/|_______/       |________/|________/|________/
                                                                                                                                     
-->

</head>


<body class="width-auto">
    
    <!-- CONTAINER -->
    <div>
        
        <header>        
        <?php
            
        // Load the template parts for this page
        //  Check if current page is registered on ACF Options page "Register Page Templates"
        if ( $page_template_parts && !str_contains( 'unregistereduninstantiated', $page_template_parts[ 'page_name' ] ) ) :
            
            // Include the template parts for this page
            foreach ( $page_template_parts[ 'templates' ] as $parts ) :

                $required_file = $parts.".php";

                if ( file_exists( stream_resolve_include_path( $required_file ) ) ) :

                    require( $required_file );

                endif;

            endforeach;

        else:

            print'No templates were found for this page. Check Forge: Custom Settings->Register Page Templates.';
        
        endif;
        
        ?>

    </div><!-- end: CONTAINER -->
        
<!-- FOOTER SCRIPTS  -->
<?php wp_footer(); ?>
</body>
</html>