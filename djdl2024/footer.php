<?php
/**
 * The Footer for our theme
 *
 * This is the template that displays all of the website code below the main content area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Forge: An Origins Story
 */
?>
        
        <!-- ABOVE FOOTER CTA -->
        <section class="p-6 bg-gray-300">           
            <?php $above_footer_text = get_field( 'above_footer_cta_text' );
            $above_footer_text = preg_replace( '/<p>/i', '', $above_footer_text ); //remove p tags
            $above_footer_text = preg_replace( '/<\/p>/i', '', $above_footer_text ); //remove p tags ?>        
            <h2 class="f-roboto mb-6 text-2xl"><?php the_field('above_footer_cta_title' ); ?></h2>
            <p class="f-open-sans mb-6"><?php print str_replace( array("\n", "\r"), '', $above_footer_text ); ?></p>
            <button type="button" class="bg-black text-white hover:bg-white hover:text-black p-2 pr-3 space-x-2 rounded" onclick="window.location.href='<?php print esc_url( get_field( 'above_footer_cta_button_url' ) );?>'">
                <i class="<?php the_field( 'above_footer_cta_button_icon' ); ?> mr-2"></i><?php the_field( 'above_footer_cta_button_text' ); ?>

            </button>

        </section>

        <footer class="f-roboto">

            <!-- FOOTER COLUMN CONTAINER -->
            <div class="flex flex-wrap pt-2 bg-gray-600">

                <!-- FOOTER ADDRESS -->                            
                <div class="footer-column max-md:w-1/2 w-1/4 p-4">                   
                    <div>
                        <?php forge_address (array(
                            'header_classes'    => 'font-semibold mb-2 text-lg',
                            'address_classes'   => ''
                        )); ?>
                    </div>
                </div>

                <!-- FOOTER NAV -->
                <nav class="footer-column max-md:w-1/2 w-1/4 p-4">
                    <a href="<?php print esc_url( home_url( '/' ) ); ?>"><p class="font-semibold mb-2 text-lg"><?php bloginfo( 'name' ); print ':' ?></p></a>                   
                    <div>
                    <?php forge_nav( array(
                        'menu_name'          => 'Page Navigation',
                        'div_classes'        => '',
                        'anchor_classes'     => '',
                        'sub_menu_classes'   => '' 
                    )); ?>
                    </div>
                </nav>

                <!-- FOOTER CONTACT -->
                <div class="footer-column max-md:w-1/2 w-1/4 p-4">                
                    <div>
                        <?php forge_contact_list (array(
                            'header_classes'    => 'font-semibold mb-2 text-lg',
                            'icon_classes'      => 'pr-4',
                            'label_classes'     => '',
                            'info_classes'      => ''    
                        )); ?>
                    </div>
                </div>

                <!-- FOOTER SOCIAL -->
                <div class="footer-column max-md:w-1/2 w-1/4 p-4">

                    <!-- LOGO -->
                    <a href="<?php print esc_url( home_url( '/' ) ); ?>">
                    <img src="<?php forge_logo(); ?>" class="mx-auto">
                    </a>

                    <!-- SOCIAL NAV -->
                    <div class="mt-4 space-x-2 text-center">
                    <?php forge_social_sites( array( 
                        'header_classes' => '', 
                        'anchor_classes' => '', 
                        'icon_classes'   => 'text-2xl pr-2 hover:text-gray-600' 
                    )); ?>
                    </div>

                </div>

            </div><!-- end: FOOTER COLUMN CONTAINER -->

            <!-- FOOTER CREDIT -->
            <div class="bg-gray-400 text-center max-md:text-sm"><?php forge_footer_credit(); ?></div>
            <div class="bg-gray-400 text-center max-md:text-sm">Copyright &#169; <?php print date('Y').' '.get_bloginfo(); ?></div>

        </footer>
        