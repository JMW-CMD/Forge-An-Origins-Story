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
   
// Define constants for paths if needed
define( "SITE_PATH",     get_template_directory_uri() );
//define( "SCRIPT_PATH",   SITE_PATH."/scripts/" );
//define( "STYLE_PATH",    SITE_PATH."styles/" );
//define( "REQUIRE_PATH",  SITE_PATH."require/" );
//define( "AUTOLOAD_PATH", SITE_PATH."classes/class." );

// Define some page IDs if needed
//define( "PAGE1", 999 ); //  PAGE1
//define( "PAGE2", 999 ); //  PAGE2
//define( "PAGE3", 999 ); //  PAGE3
//define( "PAGE4", 999 ); //  PAGE4
//define( "PAGE5", 999 ); //  PAGE5

// Get the ID, slug and post type of the current post
$post_ID   = get_the_ID();
$post_slug = get_post( get_the_ID() )->post_name;
$post_type = get_post_type ( $post_ID );


// Define which pages use unique templates
$unique_pages     = array( 'PAGE1', 'PAGE2', 'PAGE3', 'PAGE4', 'PAGE5', );

$unique_nav       = array( 'PAGE1', 'PAGE2', 'PAGE3', 'PAGE4', 'PAGE5', );

$unique_hero      = array( 'PAGE1', 'PAGE2', 'PAGE3', 'PAGE4', 'PAGE5', );

$unique_content   = array( 'PAGE1', 'PAGE2', 'PAGE3', 'PAGE4', 'PAGE5', );

$unique_footer    = array( 'PAGE1', 'PAGE2', 'PAGE3', 'PAGE4', 'PAGE5', );




?>
<!doctype html>
<!--

**  Forge: An Origins Story
**  Author: Jeremy Weaver
**  Description: WordPress theme telling origins stories with websites.
**  Version: 0.1
**  Website: undefined   

AN ORIGINS________________________________________________
 _______   ______   .______        _______  _______       
|   ____| /  __  \  |   _  \      /  _____||   ____|    _ 
|  |__   |  |  |  | |  |_)  |    |  |  __  |  |__      (_)
|   __|  |  |  |  | |      /     |  | |_ | |   __|        
|  |     |  `--'  | |  |\  \----.|  |__| | |  |____     _ 
|__|      \______/  | _| `._____| \______| |_______|   (_)
_____________________________________________________STORY


-->
<html <?php language_attributes(); ?>>
<head>

<title><?php bloginfo('name'); echo' | '; bloginfo('description'); ?></title>

<!-- Meta tags -->
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- User-defined meta tags -->
<?php forge_meta_tags(); ?>

<!-- WP-added scripts and tags -->
<?php wp_head(); ?>

</head>


   


</div><!-- #container -->
<!-- WP-added scripts -->
<?php wp_footer(); ?>
</body>
</html>