<?php
/**
 * The custom settings that are used in the theme with ACF Pro Options pages
 *
 * These functions generate content that are used in behind-the-scenes code.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Forge: An Origins Story
 */

/* * 
Forge: Meta Tags
 
- Adds user-define meta tags to the head of the page.
- Data Source - Forge: Custom Settings -> Meta Tags options page (using ACF Pro).

- IMPLEMENTATION:
<?php forge_meta_tags (); ?>

* */
function forge_meta_tags() {     
    
    $forged_html = '';
    $meta_tag_info = get_field( 'meta_tag_info', 'option' );

    if( $meta_tag_info ) :      
        
        foreach ( $meta_tag_info as $info ) :            
            
            $forged_html .= '<meta '.$info[ 'meta_tag_label' ].'="'.esc_attr( $info[ 'meta_tag_label_text' ] ).'" content="'.esc_attr( $info[ 'meta_tag_content' ] ).'">'."\n";                             
        
        endforeach;

    endif;

    print $forged_html;
}

/* *
Forge: Google Fonts

- Adds user-define Google Fonts to the head of the page.
- Data Source - Forge: Custom Settings -> Google Fonts options page (using ACF Pro).

- IMPLEMENTATION:
Automatically added to wp_head();

* */
function forge_google_fonts(){
    
    $google_fonts = get_field( 'google_fonts', 'option' );    
    
    if( $google_fonts ) :
 
        $font_list = array();
 
        foreach ( $google_fonts as $font ) :
            
            // Add each font to the font list array after capitalizing it
            $font_list[] = ucwords( $font[ 'google_font' ] );
        
        endforeach;
 
        // Convert the font names to a format suitable for the Google Fonts URL
        $fonts = implode( '%7c', $font_list); 
        $fonts = str_replace( ' ', '+', $fonts );

        // Inject the font list into the Google Fonts URL
        $fonts = sprintf( get_field( 'google_fonts_link', 'option' ), $fonts );
        wp_enqueue_style( 'wp-google-fonts', $fonts, array(), null );

    endif;      

}
add_action( 'wp_enqueue_scripts', 'forge_google_fonts' );

/* *
Forge: Icon Fonts

- Adds Fontawesome Icons via CDN to the head of thE page.
- Data Source - Forge: Custom Settings -> Icon Fonts options page (using ACF Pro).

- IMPLEMENTATION:
Automatically added to wp_head();

* */
function forge_icon_fonts() {
    
    wp_enqueue_style( get_field( 'icon_fonts_stylesheet_name', 'option' ) , get_field( 'icon_fonts_link', 'option' ), array(), null );

}
add_action( 'wp_enqueue_scripts', 'forge_icon_fonts' );

/* *
Forge: Tailwind CSS Source Toggle

- Selects between two sources for Tailwind CSS and enqueues it: Either the Tailwind CDN or the local one.
- Data Source - Forge: Custom Settings -> Tailwind Source Select options page (using ACF Pro).

- IMPLEMENTATION:
Automatically added to wp_head();

* */
function forge_tailwind_source() {
    
    // Check if the user wants to use Tailwind
    $use_tailwind = get_field( 'use_tailwind', 'option' );

    // If the user wants to use Tailwind, load the appropriate CSS
    if ( $use_tailwind ) :
        
        // Check if the user wants to use the CDN or the local one
        $tailwind_source = get_field( 'select_source', 'option' );
        
        // If the user wants to use the CDN, load the Tailwind Play CDN
        if( $tailwind_source == 'cdn' ) :            
            
            // Enqueue the Tailwind Play CDN
            wp_enqueue_script(  get_field( 'cdn_stylesheet_name', 'option' ),  
                                get_field( 'cdn_stylesheet_link', 'option' ), 
                                array( 'local-jquery' ), 
                                null, 
                                array( 'in_footer' => 'true' ) );                    
            
        endif;

        // If the user wants to use the local one, load the local stylesheet
        if( $tailwind_source == 'local' ) :            

            // Enqueue the local stylesheet
            wp_enqueue_style(   get_field( 'local_stylesheet_name', 'option' ), 
                                get_stylesheet_directory_uri() . '/' . get_field( 'local_stylesheet_link', 'option' ), 
                                array(), 
                                null );        

        endif;

    endif;

}
add_action( 'wp_enqueue_scripts', 'forge_tailwind_source' );

/* *
Forge: Post Templates

- Compares post information to unique template information stored in ACF options.
- Returns the matched page name along with it's associated template list.
- Data Source - Forge: Custom Settings -> Register Page Templates options page (using ACF Pro).

- IMPLEMENTATION:
<?php forge_page_templates( $post_info ); ?>

* */
function forge_page_templates( $post_info ) {

    $template_info_from_ACF = get_field( 'register_page_templates', 'option' );
       
    if( $template_info_from_ACF ) :    

        foreach ( $template_info_from_ACF as $info ) :
            
            // Check if the post slug matches the unique post template
            if( $post_info[ 'post_slug' ] == $info[ 'post_type' ] ) :

                // If so, return the matched page name along with it's associated template list
                return array(
                    'page_name' => $info[ 'post_type' ],
                    'templates' => explode( '/', $info[ 'unique_templates' ] )
                );                

            endif;            

        endforeach;
    
        // If the post slug does not match any unique post templates, 
        // return that the post is unregistered in ACF.
        return array(
            'page_name' => 'unregistered'
        );

    else:

        // No post template info registered
        return array(
            'page_name' => 'uninstantiated',
            'templates' => array()
        );       

    endif;

}

?>