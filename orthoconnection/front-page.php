<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use_template( function( &$template ) {

  $slides = get_field('banner_carousel');

  ?><div class="header frontpage">

    <div class="slider" data-slick='{
      "dots": false,
      "arrows": true,
      "infinite": true,
      "speed": 500,
      "autoplay": false,
      "fade": true,
      "pauseOnFocus": false,
      "pauseOnHover": false,
      "autoplaySpeed": 5000
    }'><?php
      foreach ( $slides as $index => $slide ) :
          $link = ( !empty( $slide['link'] ) ? $slide['link'] : null );
          $image = ( !empty( $slide['image'] ) ?
              ' style="background-image:url('.$slide['image'].');"' :
              ''
          );

          ?><div <?php print( $image ); ?>>
            <a href="<?php print( $link ); ?>" class="slide-link"></a>
          </div><?php

      endforeach;
    ?></div>

  </div>

  <section class="pad-small green-bg">

    <div class="container">
      <div class="cols flex">
        <div class="col large-6">
          <img class="inline-logo" src="<?php print( get_stylesheet_directory_uri() ); ?>/assets/orthoconnection-logo-light.png"/ alt="OrthoConnection">
          <p class="preCTA">is a nationwide Canadian distributor of orthopedic soft goods with a focus on footcare. We stock and sell products from manufacturers such as Powerstep, Darco, Showereez, and Dr.&nbsp;Jill’s Foot Pads.</p>
        </div>
        <div class="col large-6">
          <p>Our mission since our beginnings in 2001 has always been to provide top quality proven products, professional prompt service and reliable delivery times.</p>

          <p>Our clinical customers range from podiatry to physiotherapy to chiropractic. We also supply to pharmacies, home healthcare shops and medical supply stores.</p>
        </div>
      </div>
    </div>

  </section>

  <section class="pad-small brands-section grid-3">

    <div class="container txt-center">

      <h3 class="heading">Shop Our Partner Brands</h3>

      <div class="product-brands grid-container"><?php

      if( $brand_terms = get_terms( array(
        'taxonomy' => 'brands',
        'parent' => 0,
        'orderby' => 'menu_order'
      ) ) ) : 
        foreach ( $brand_terms as $term ) :
          if ($term->count == 1):
            $single_product_query = new WP_Query( array( 
              "posts_per_page" => 1,
              "orderby" => 'date',
              "order" => 'DESC',
              "tax_query" => array(
                array (
                  'taxonomy' => 'brands',
                  'field' => 'term_id',
                  'terms' => $term->term_id,
                ),
              ),
            ) );
            echo '<a class="product-brand gridee" href="' . get_the_permalink($single_product_query->posts[0]) . '">';
          else:
            echo '<a class="product-brand gridee" href="' . get_term_link($term) . '">';
          endif;
          if ($brand_logo = get_field('logo', $term)):
            echo '<img class="brand-logo" src="' . $brand_logo .'"alt="' . $term->name . '" />';
          else:
            echo '<h4>'. $term->name . '</h4>';
          endif;
          echo  get_term_field( 'description', $term );
          if (get_field('pros_only', $term)):
            echo '<div class="ribbon"><span>PROFESSIONALS ONLY</span></div>';
          endif;
          echo '</a>';
        endforeach;
      endif;
      ?></div>

    </div>


  </section>

  <section class="pad-small categories-section grid-3">

    <div class="container txt-center">

      <h3 class="heading">Product Categories</h3>

      <div class="product-categories grid-container"><?php

      if( $category_terms = get_terms( array(
        'taxonomy' => 'product_categories',
        'orderby' => 'menu_order'
      ) ) ) : 
        foreach ( $category_terms as $term ) :
          if ($term->count == 1):
            $single_product_query = new WP_Query( array( 
              "posts_per_page" => 1,
              "orderby" => 'date',
              "order" => 'DESC',
              "tax_query" => array(
                array (
                  'taxonomy' => 'product_categories',
                  'field' => 'term_id',
                  'terms' => $term->term_id,
                ),
              ),
            ) );
            echo '<a class="product-category gridee" href="' . get_the_permalink($single_product_query->posts[0]) . '">';
          else:
            echo '<a class="product-category gridee" href="' . get_term_link($term) . '">';
          endif;
          echo '<h4>'. $term->name . '</h4>';
          if ($category_image = get_field('category_image', $term)):
            echo '<img class="category-image" src="' . $category_image .'"alt="' . $term->name . '" />';
          endif;
          echo  get_term_field( 'description', $term );
          echo '</a>';
        endforeach;
      endif;
      ?></div>

    </div>


  </section><?php
});
