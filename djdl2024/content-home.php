<?php
/**
 * The content template for the home page
 *
 * This is the template that displays all of the website code from <main> up until </main>
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Forge: An Origins Story
 */
?>

        <main>

            <!-- BELOW HERO -->
            <section class="f-roboto text-sm md:text-base p-4 md:p-16">

                <h1 class="f-caudex text-xl md:text-3xl mb-4 lg:mb-4"><?php the_field( 'below_hero_headline' ); ?></h1>
                <img src="<?php the_field( 'below_hero_image' ); ?>" class="w-full rounded-lg mb-6 md:w-1/3 md:ml-8 md:mb-2 md:float-right">                
                <?php print str_replace( array("\n", "\r"), '', get_field( 'below_hero_text' ) ); ?>           

            </section>

            <!-- FEATURES -->
            <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 px-4">                
            <?php $features = get_field( 'features' ); 
            
            if( $features ):
                
                $f_count = 1;
                    
                foreach ( $features as $feature ) : ?>
                
                <!-- FEATURE #<?=$f_count?>-->
                <div class="bg-gray-200 mb-4 p-4">

                    <div class="text-center"><i class="<?php print $feature[ 'feature_icon' ]; ?> text-4xl mb-1"></i></div>                            
                    <div class="text-center">                                
                        <h3 class="text-center font-bold text-3xl mb-1"><?php print $feature[ 'feature_name' ]; ?></h3>           
                        <p class="text-left mb-4"><?php print $feature[ 'feature_text' ]; ?></p>
                        <button type="button" class="bg-black text-white hover:bg-white hover:text-black p-2 rounded-lg" onclick="window.location.href='<?php print esc_url( $feature[ 'feature_button_link' ] ); ?>'" >
                            <i class="<?php print $feature[ 'feature_button_icon' ]; ?>"></i>
                            <span><?php print $feature[ 'feature_button_text' ]; ?></span>
                        </button>
                    </div>

                </div><?php $f_count++;   
                
                endforeach;
            
            endif; ?>


            </section><!-- end: FEATURES -->

            <!-- MAIN CONTENT -->
            <article class="px-4">

                <img src="<?php print esc_url( get_field( 'article_image' ) ); ?>" class="w-full rounded-lg m-6 p-4 md:w-1/3 md:ml-8 md:mb-2 md:float-right "> 
                <h1 class="f-caudex text-xl md:text-3xl mb-4 lg:mb-4"><?php the_field( 'article_title' ); ?></h1>
                <div class="article sub header f-judson text-lg mb-4 font-bold m-6"><?php print str_replace( array("\n", "\r"), '', get_field( 'article_sub_header' ) ); ?></div>                 
                <?php print str_replace( array("\n", "\r"), '', get_field( 'article_text' ) ); ?>


            </article>

            <!-- TESTIMONIALS -->
            <section class="pt-6">

                <h3 class="f-caudex text-xl md:text-3xl mb-4 lg:mb-4 pl-4"><?php the_field( 'testimonials_title' ); ?></h3>
                    
                <!-- TESTIMONIALS CONTAINER -->
                <div class="grid grid-cols-1 gap-4 p-4 md:grid-cols-2 lg:grid-cols-3 lg:gap-6">                       
                <?php $testimonials = get_field( 'testimonials' ); 
                    
                if( $testimonials ): $t_count = 1;
                        
                foreach ( $testimonials as $testimonial ) : 
                            
                    $five_star = $testimonial[ 'graphic_image' ]; 
                    $testimonial_text = $testimonial[ 'testimonial' ];

                    //Remove first and last <p> tags
                    $testimonial_text = preg_replace( '/<p>/i', '', $testimonial_text );
                    $testimonial_text = preg_replace( '/<\/p>/i', '', $testimonial_text );

                    //Remove the newline character at the end
                    $testimonial_text = substr( $testimonial_text, 0, -1 ); ?>
                                
                    <!-- TESTIMONIAL #<?=$t_count?> -->
                    <div class="bg-gray-200 p-4 xl:p-6">
                        <h3 ><?php print $testimonial[ 'client_name' ]; ?></h3>
                        <p class="mb-6">
                            <i class="<?=$five_star?>"></i>
                            <i class="<?=$five_star?>"></i>
                            <i class="<?=$five_star?>"></i>
                            <i class="<?=$five_star?>"></i>
                            <i class="<?=$five_star?>"></i>
                        </p>
                        <div class="mb-2"><?=$testimonial_text?></div>                           
                    </div><?php 

                    $t_count++;
                            
                endforeach;

                endif; ?>

                
                </div><!-- end: TESTIMONIALS CONTAINER -->

            </section><!-- end: TESTIMONIALS -->

        </main>
