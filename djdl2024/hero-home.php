<?php
/**
 * The hero section for the home page
 *
 * This is the template that displays all of the website code from <div id="hero"> up until </header>
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Forge: An Origins Story
 */
?>

            
            <!-- HERO -->
            <div id="hero" class="B2 hero-h text-white p-4" <?php forge_hero_bg(); ?>>

                <!-- HERO CONTENT -->
                <div class="md:w-3/4">
                    
                    <h1 class="f-caudex text-xl md:text-3xl mb-2 lg:mb-4"><?php the_field('hero_title_1', 'option' ); ?></h1>                    
                    <h2 class="f-judson text-lg md:text-2xl mb-2 lg:mb-4"><?php the_field('hero_title_2', 'option' ); ?></h2>                    
                    <p class="f-roboto text-sm md:text-base mb-2 lg:mb-4"><?php forge_hero_text(); ?></p>                    
                    <?php forge_cta( "bg-white text-black hover:bg-black hover:text-white p-1 pr-2 mr-2 space-x-1 rounded-md" ); ?>
                
                </div>

            </div><!-- end: HERO -->

        </header>
