<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use_template( function( &$template ) {?>

  <section class="container x-narrow pad-small-top txt-center"><?php
    echo '<h2 class="heading">';
    printf( __( 'You searched for: "%s"', 'shape' ), '<span>' . get_search_query() . '</span>' ) ;
    echo '</h2>';
  ?></section>

  <section class="container pad-small"><?php

    if ( have_posts() ):
      ?><div class="category-products grid-4"><?php
      while ( have_posts() ):
            the_post();                   
            $images = get_field('image_gallery');
              echo '<a class="product-block" href="' . get_permalink() . '">';
              if( $images ):
                echo '<div class="product-image" style="background-image:url(' . $images[0]['url'] .')" alt="' . get_the_title() . '"> </div>';
          endif;
          if (explode(' ',trim(get_the_title()))[0]=='POWERSTEP') {
            echo '<h4 class="heading-small product-title">'. str_replace("POWERSTEP", "POWERSTEP<br>", get_the_title()) . '</h4>';
          } else {
            echo '<h4 class="heading-small product-title">'. get_the_title() . '</h4>';
          };
          if (get_field('pro_only')):
              echo '<div class="ribbon"><span>PROFESSIONALS ONLY</span></div>';
            endif;
          echo '</a>';

      endwhile;
      wp_reset_postdata(); ?>
      </div><?php
    endif;
  ?></section><?php
});
