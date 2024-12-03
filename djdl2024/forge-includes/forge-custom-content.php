<?php
/**
 * The custom content that are used in the theme with ACF Pro Options pages
 *
 * These functions generate content that is displayed on the screen.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Forge: An Origins Story 
 */

 /* *
 Forge: Class Names
   
- Displays needed classes for HTML output. Returns empty if none are found.
- Data Source - Theme files.
   
- IMPLEMENTATION:
_class( $classes )
 
* */
function _class( $classes ) {
   
    return ( $classes ) ? ' class="' . $classes . '"' : '';

}

 /* *
 Forge: Icon Class Names

- Displays needed icon classes for HTML output. Returns empty if none are found.
- Data Source - Theme files.
   
- IMPLEMENTATION:
i_class( $classes )

* */
function i_class( $classes ) {
   
    return ( $classes ) ? ' ' . $classes : '';

}

/* *
forge: Info
   
- Gets gathers contact and business info to be used piecemeal throughout the theme.
- Data Source - Forge: Custom Content -> Contact Info options page (using ACF Pro).
  
- IMPLEMENTATION:

To display info in HTML:
<?php _contact( 'name', 'attributer' ); ?>
 
* */
function forge_info() {
   
    // Initialize the contact information array that will be returned
    $contact_information = array();
    $contact_info_from_ACF = get_field( 'contact_info', 'option' );
   
    if( $contact_info_from_ACF ) :
                  
        foreach ( $contact_info_from_ACF as $info ) :                  
  
            $icon = ( $info[ 'icon' ] ) ? $info[ 'icon' ] : '';
            $label = ( $info[ 'label' ] ) ? $info[ 'label' ] : '';
            $url = ( $info[ 'url' ] ) ? esc_url( $info[ 'url' ] ) : '';
            $text = ( $info[ 'text' ] ) ? $info[ 'text' ] : '';
            
            // Add contact information to array
            $contact_information += [
                $label => array(
                    'icon'   => $icon,
                    'label'  => $label,
                    'url'    => $url,
                    'text'   => $text
                    )
                ];      
      
        endforeach;   
      
        return $contact_information;

    endif;

}

function _contact( $type, $subtype ){

    $_contact = forge_info();

    $forged_html = '';

    if ( $_contact ) :
 
        $forged_html = ( $subtype == 'url' ) ? esc_url( $_contact[ $type ][ $subtype ] ) : $_contact[ $type ][ $subtype ];

    else :

        $forged_html = $type.'->'.$subtype.' not found';
        
    endif;

    print $forged_html;

}

/* *
Forge: Logo
 
- Gets custom logo URL and displays it from ACF
- Data Source - Forge: Custom Content -> Header options page (using ACF Pro).

- IMPLEMENTATION:

<!-- Website Logo -->
<a href="<?php print esc_url( home_url( '/' ) ); ?>">
    <img src="<?php forge_logo() ?>">
</a>

* */
function forge_logo() {
    
    print esc_url( get_field( 'custom_logo', 'option' ) );

}

/* *
Forge: Nav

- Gets the nav menu information and outputs it in HTML along with Tailwind CSS classes. 
- Data Source - wp_get_nav_menu_items().
              - Submitted function arguments.

- IMPLEMENTATION:

<div>
<?php forge_nav( array(
    'menu_name'          => 'menu name',
    'div_classes'        => '',
    'anchor_classes'     => '',
    'sub_menu_classes'   => '' 
)); ?>
</div>

* */
function forge_nav( $nav_info ) {   

    // Get the menu Items
    $nav_menu = wp_get_nav_menu_items( $nav_info[ 'menu_name' ], array() );
   
    $forged_html = '';
    $within_sub_menu = false;
    $menu_line_count = 1;
    $sub_menu_beginning = '';
    $line_tabs = "";
    $sub_menu_tabs = "";
   
    if( $nav_menu ) :
   
        foreach ( $nav_menu as $menu ) :       

            // Check if the menu item is a parent item
            if( $menu->menu_item_parent === '0' ) :                   
            
                // Add tabs to indent for menu item if line count is not 1
                $line_tabs = ( $menu_line_count != 1 ) ? "\t\t\t\t\t\t" : "\t";
                
                // Close sub-menu if within one
                $forged_html .= ( $within_sub_menu ) ? "\t\t\t\t\t\t".'</div>'."\n" : '';
                $sub_menu_beginning = "";
                $within_sub_menu = false;       
         
            endif;    
         
            // Check if the menu item is a child item
            if ( $menu->menu_item_parent !== '0' ) :                   
                    
                // Add tabs to indent for sub menu if line count is 2
                $sub_menu_tabs = ( $menu_line_count == 2 ) ? "\t\t\t\t\t" : "";

                // Open sub-menu if not already within one
                $sub_menu_beginning = ( !$within_sub_menu ) ? $sub_menu_tabs.'<div'._class( $nav_info[ 'sub_menu_classes' ] ).'>'."\n\t\t\t\t\t\t\t" : "";           
                $within_sub_menu = true;       
                
            endif;
                        
            // Build Menu Item
            $forged_html .= $line_tabs.$sub_menu_beginning;
            $forged_html .= '<div'._class( $nav_info[ 'div_classes' ] );
            $forged_html .= '><a href="'.$menu->url.'"'._class( $nav_info[ 'anchor_classes' ] ).'>';
            $forged_html .= $menu->title;
            $forged_html .= '</a></div>'."\n";
            
            $menu_line_count ++;

        endforeach;

        // After the last menu item, close sub-menu if within one
        $forged_html .= ( $within_sub_menu ) ? "\t\t\t\t".'</div>'."\n" : '';

    else:
        
        $forged_html = "THE MENU '".$nav_info[ 'menu_name' ]."' WAS NOT FOUND";   

    endif;
  
    print $forged_html;
}

/* *
Forge: Address Info

- Generates HTML for address info.
- Data Source - Forge: Custom Content -> Address Info options page (using ACF Pro).
              - Submitted function arguments.

- IMPLEMENTATION:

<div class="wrapper classes">
<?php forge_address (array(
    'header_classes'    => '',
    'address_classes'   => ''
)); ?>
</div>
         
* */
function forge_address( $address_classes ){

    $forged_html = '';
   
    $address_list = get_field( 'desired_address_fields', 'option' ); if( $address_list ) :
      
        $address_header = get_field( 'address_header', 'option' );      
        
        if( !empty( $address_header ) ) :

            $forged_html .= '<div'._class( $address_classes[ 'header_classes' ] ).'>'.$address_header.'</div>'."\n";

        endif;      
        
        foreach ( $address_list as $address ) :

            switch ( $address ) :
                
                case'address_city':
                    $forged_html .= "\t\t\t\t\t\t".'<div'._class( $address_classes[ 'address_classes' ] ).'>'.get_field( $address, 'option' );
                break;
                case'address_state':
                    $forged_html .= ', '.get_field( $address, 'option' ).' ';
                break;
                case'address_zip':
                    $forged_html .= get_field( $address, 'option' ).'</div>';
                break;
                default:
                    $forged_html .= "\t\t\t\t\t\t".'<div'._class( $address_classes[ 'address_classes' ] ).'>';
                    $forged_html .= get_field( $address, 'option' ).'</div>'."\n";         
            
            endswitch;

        endforeach;
        
        endif;

    print $forged_html."\n";
}

/* *
Forge: Contact Info

- Generates HTML for contact info.
- Data Source - Forge: Custom Content -> Contact Info options page (using ACF Pro).
              - Submitted function arguments.

- IMPLEMENTATION:

<div>
<?php forge_contact_list (array(
    'header_classes'    => '',
    'icon_classes'      => '',
    'label_classes'     => '',
    'info_classes'      => ''    
)); ?>
</div>
         
* */
function forge_contact_list( $contact_classes ) {
    
    $forged_html = '';   
    $anchor_tag_1 = '';
    $anchor_tag_2 = '';
    $has_icon = false;
    $row_count = 1; 

    $contact_list = get_field( 'contact_info', 'option' );
    $header = get_field( 'contact_info_header', 'option' );

    $forged_html .= ( $header ) ? '<div'._class( $contact_classes[ 'header_classes' ] ).'>'.ucwords( $header ).'</div>'."\n" : '';
    $contact_info = get_field( 'contact_info', 'option' ); if( $contact_info ) :            

    foreach ( $contact_info as $info ) :            

        $indents = ( $row_count > 1 ) ? "\t\t\t\t\t\t" : "\t\t\t\t\t\t";
        
        // Start a new contact info line
        $forged_html .= $indents.'<div'._class( $contact_classes[ 'info_classes' ] ).'>';      

        // Get and add icon if it exists
        $icon = $info[ 'icon' ];  
        $forged_html .= ( $icon ) ? '<i class="'.$icon.i_class( $contact_classes[ 'icon_classes' ] ).'"></i>' : '';
        $has_icon = ( $icon ) ? true : false;

        // Get and add label if it exists and no icon exists
        if( !$has_icon ) :
                    
            $label = $info[ 'label' ];
            $forged_html .= ( $label ) ? '<span'._class( $contact_classes[ 'label_classes' ] ).'>'.ucwords( $label ).': </span>' : '';
                    
        endif;

        // Get and add url if it exists
        $url = $info[ 'url' ];

        // Add anchor tags if URL exists
        $anchor_tag_1 = ( $url ) ? '<a href="'.esc_url( $url ).'">' : '';
        $anchor_tag_2 = ( $url ) ? '</a>' : '';

        // Add the text field to the contact info line
        $forged_html .= $anchor_tag_1 . $info[ 'text' ] . $anchor_tag_2 . '</div>'."\n";
        $row_count++;           

    endforeach;

    endif;
        
    print $forged_html;
}

/* *
Forge: Social Info

- Generates HTML for social sites menu.
- Data Source - Forge: Custom Content -> Social Sites options page (using ACF Pro).
              - Submitted function arguments.

- IMPLEMENTATION:

<div>
<?php forge_social_sites( array(
    'header_classes' => '',
    'anchor_classes' => '',
    'icon_classes'   => ''
)); ?>
</div>
         
* */
function forge_social_sites( $social_data ) {     
   
    $forged_html = '';
    $row_count = 1;
    $indents = '';
    
    if( get_field( 'social_header', 'option' ) ) :
        
        $forged_html .= "\t".'<div'._class( $social_data[ 'header_classes' ] ).'>'.get_field( 'social_header', 'option' ).'</div>'."\n";
        
    endif;
    
    $add_social_site = get_field( 'add_social_site', 'option' ); if( $add_social_site ) :      
        
    foreach ( $add_social_site as $social_site ) :   
            
        $indents = ( $row_count > 1 ) ? "\t\t\t\t\t\t" : "\t";                
        $forged_html .= $indents.'<a href="'.esc_url( $social_site[ 'social_site_url' ] ).'"'._class( $social_data[ 'anchor_classes' ] ).'>';                              
        $icon = $social_site[ 'social_site_icon' ];   
                
        if( $icon ) :        
                    
            $forged_html .= '<i class="'.$icon.i_class( $social_data[ 'icon_classes' ] ).'">';        
        
        endif;                    
                
        $forged_html .= '</i></a>'."\n";         
        $row_count++;   
        
    endforeach;
    
    endif;
    
    print $forged_html;
}

/* *
Forge: Footer Credit Text

- Displays the footer credit text
- Data Source - Forge: Custom Content -> Footer options page (using ACF Pro).

- IMPLEMENTATION:

forge_footer_credit()
         
* */
function forge_footer_credit() {
    
    print get_field( 'footer_credit_text', 'option' ).'<a target="_blank" href="'
    .get_field( 'footer_credit_url', 'option' ).'">'
    .get_field( 'footer_credit_url_text', 'option' ).'</a>';

}

/* *
Forge: Youtube Embed

- Embeds a youtube video in an iframe
- Data Source - current template page (using ACF Pro).

- IMPLEMENTATION:

forge_youtube_embed( $youtube_link_field );

* */
function function_forge_youtube_embed( $yt ){

    print'<div class="yt-embed-container"><iframe src="https://www.youtube-nocookie.com/embed/'.$yt.'?modestbranding=1&showinfo=0&rel=0&iv_load_policy=3&controls=0&disablekb=1" frameborder="0"></iframe></div>';

}

/* *
Forge: Hero Background

- Generates the HTML for the hero section call to action background image
- Data Source - Forge: Custom Content -> Header options page (using ACF Pro).

- IMPLEMENTATION:

forge_hero_bg()

* */
function forge_hero_bg() {

    $hero_bg = get_field( 'hero_background_image', 'option' );
    print 'style="background-image: url(\''.esc_url( $hero_bg ).'\');"';

}

/* *
Forge: Hero Text

- Generates the HTML for the hero section call to action text
- Data Source - Forge: Custom Content -> Header options page (using ACF Pro).

- IMPLEMENTATION:

forge_hero_text()

* */
function forge_hero_text() {

    $hero_text = get_field( 'hero_text', 'option' );
    
    //Remove first and last <p> tags
    $hero_text = preg_replace( '/<p>/i', '', $hero_text );
    $hero_text = preg_replace( '/<\/p>/i', '', $hero_text );   
    
    //Remove the newline character at the end
    $hero_text = substr( $hero_text, 0, -1 );
    print $hero_text;

}

/* *
Forge: Call To Action

- Generates the HTML for call to action buttons
- Data Source - Forge: Custom Content -> Header options page (using ACF Pro).

- IMPLEMENTATION:

forge_cta( $classes )

**/
function forge_cta( $classes ) {

    $forged_html = '';
    $row_count = 1;
    $hero_buttons = get_field( 'hero_buttons', 'option' ); if( $hero_buttons ) :            

    foreach ( $hero_buttons as $button ) :

        //If the row count is greater than 1, add indents
        $indents = ( $row_count > 1 ) ? "\t\t\t\t\t" : '';

        //Assemble the HTML for the button
        $forged_html    .= $indents.'<button type="button"'._class( $classes ).' onclick="window.location.href=\''.$button[ 'hero_button_link' ].'\'">'
                        .  "\n\t\t\t\t\t\t".'<i class="'.$button[ 'hero_button_icon' ].'"></i> '.$button[ 'hero_button_text' ]."\n\t\t\t\t\t".'</button>'."\n";           
      
        $row_count++;                     

    endforeach;

    endif;

    print $forged_html;

}

?>