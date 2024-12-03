<?php
/**
 * The Navigation for our theme
 *
 * This is the template that displays all of the website code from <nav> up until </nav>
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Forge: An Origins Story
 */
?>

            <!-- HEADER NAV WRAPPER -->
            <nav  id="nav-wrapper" class="f-roboto">

                <!-- HEADER CONTACT STRIP -->
                <div class="B2 T1 flex justify-center">               
                    <div class="content-center flex space-x-8">                  
                        <div class="font-semibold text-lg">Contact Us: </div>
                        <div>
                            <a href="<?php _contact( 'phone', 'url' ); ?>" >
                            <i class="<?php _contact( 'phone', 'icon' ); ?>"></i>
                            </a>
                        </div>
                        <div>
                            <a href="<?php _contact( 'email', 'url' ); ?>" >
                            <i class="<?php _contact( 'email', 'icon' ); ?>"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- HEADER NAV -->            
                <div class="B1 T2 R2 flex h-24 justify-between items-center p-4 border-b">
                                
                    <!-- LOGO -->            
                    <a href="<?php print esc_url( home_url( '/' ) ); ?>" >
                    <img src="<?php forge_logo() ?>" class="h-20">
                    </a>
                                    
                    <!-- PAGE NAV -->
                    <div class="flex space-x-6 font-semibold text-xl max-md:hidden">
                    <?php forge_nav( array(
                        'menu_name'          => 'Page Navigation',
                        'div_classes'        => '',
                        'anchor_classes'     => '',
                        'sub_menu_classes'   => '' 
                    )); ?>
                    </div>
                                    
                    <!-- SOCIAL NAV -->
                    <div class="flex space-x-6 max-lg:hidden">
                    <?php forge_social_sites( array( 
                        'header_classes' => '', 
                        'anchor_classes' => '', 
                        'icon_classes'   => 'text-2xl' 
                    )); ?>
                    </div>
                                    
                    <!-- HAMBURGER ICON-->
                    <button id="mobile-menu-icon" class="md:hidden text-2xl" >
                        <i class="fa fa-bars"></i>
                    </button>

                </div><!-- end: HEADER NAV -->

            </nav><!-- end: HEADER NAV WRAPPER -->

            <!-- MOBILE NAV -->
            <nav id="mobile-menu" class="B1 T2 R2 hidden border-b">

                <!-- MOBILE PAGE NAV -->                       
                <div class="mb-4">
                    <?php forge_nav( array(
                        'menu_name'          => 'Page Navigation',
                        'div_classes'        => 'p-1 flex justify-center',
                        'anchor_classes'     => '',
                        'sub_menu_classes'   => '' 
                    )); ?>
                </div>

                <!-- MOBILE SOCIAL NAV -->
                <div class="flex justify-center space-x-6 mb-4">
                <?php forge_social_sites( array(
                    'header_classes' => '',
                    'anchor_classes' => '',
                    'icon_classes'   => ''
                )); ?>
                </div>

                <!-- MOBILE CONTACT NAV -->
                <div class="flex justify-center space-x-8 pb-4">
                    <div>
                        <a href="<?php _contact( 'phone', 'url' ); ?>" >
                        <i class="<?php _contact( 'phone', 'icon' ); ?>"></i>
                        </a>
                    </div>
                    <div>
                        <a href="<?php _contact( 'email', 'url' ); ?>" >
                        <i class="<?php _contact( 'email', 'icon' ); ?>"></i>
                        </a>
                    </div>
                </div>

            </nav><!-- end: MOBILE NAV -->