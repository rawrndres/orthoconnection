<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use_template( function( &$template ) {
  
  global $post;

?><div class="container pad-small product-details"><?php
    if ( have_posts() ) :
      while( have_posts() ) :
        the_post();
        $terms = get_the_terms( $post->ID, 'brands' );
        if ($terms) {
            foreach($terms as $term) {
              if ( $term->parent == 0) {
                if (strcasecmp(explode(' ',$term->name)[0],explode(' ',trim(get_the_title()))[0]) != 0 ) {
                  $product_name = $term->name . " " . get_the_title();
                }
                else {
                  $product_name = get_the_title();
                }
              }
            }
        }
        else{
          $product_name = get_the_title();
        };
        ?><div class="cols flex">

          <div class="col large-4"><?php 
            $images = get_field('image_gallery');
            if( $images ): ?>
                <div class="sp-wrap">
                    <?php foreach( $images as $image ): ?>                          
                      <a href="<?php echo esc_url($image['url']); ?>">
                        <img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                      </a>
                    <?php endforeach; ?>
                </div>
            <?php endif;?>
          </div>

          <div class="col large-8">
            <h2 class="heading"><?php the_title(); ?></h2><?php
            if (get_field('pro_only')):
              echo '<span class="heading-small pros-only">ONLY AVAILABLE TO HEALTHCARE PROFESSIONALS</span>';
            endif;
            the_content(); 
            if (get_field('pro_only') == 0 && get_field('paypal_price')):
              ?><h5 class="heading-small product-price">$<?= get_field('paypal_price') ?></h5>
              <form target="paypal" class="paypal-form" action="https://www.paypal.com/cgi-bin/webscr" method="post"><?php

                if (get_field('paypal_codes')) {
                  echo '<input type="hidden" name="on0" value="Code">';
                  $codes = explode("\r\n", get_field('paypal_codes'));
                  if (count($codes) > 1) {?>
                    <strong>Size:</strong>
                    <select name="os0"><?php

                    foreach ($codes as $code) {
                      if (strcasecmp('size',explode("#", explode(" ",$code)[0])[1]) == 0 ) {
                        echo '<option value="' . explode("#", $code)[0] . " / " . explode("#", $code)[1] . '">' . explode("#", $code)[1] . '</option>';
                      } else {
                        echo '<option value="' . explode("#", $code)[0] . " / Size: " . explode("#", $code)[1] . '">' . explode("#", $code)[1] . '</option>';
                      }
                    }
                    ?></select><?php
                  } else { ?>
                    <input type="hidden" name="os0" value="<?= get_field('paypal_codes') ?>">
                  <?php }
                }?>

                <input type="submit" name="submit" value="Buy Now" alt="Buy and checkout with paypal">

                <input type="hidden" name="add" value="1">
                <input type="hidden" name="cmd" value="_cart">
                <input type="hidden" name="business" value="orthoconnection@shaw.ca">
                <input type="hidden" name="item_name" value="<?php echo $product_name; ?>"> <!-- Change product name here! -->
                <input type="hidden" name="amount" value="<?php echo get_field('paypal_price'); ?>"> <!-- Change price here! -->
                <input type="hidden" name="buyer_credit_promo_code" value="">
                <input type="hidden" name="buyer_credit_product_category" value="">
                <input type="hidden" name="buyer_credit_shipping_method" value="">
                <input type="hidden" name="buyer_credit_user_address_change" value="">
                <input type="hidden" name="no_shipping" value="0">
                <input type="hidden" name="no_note" value="1">
                <input type="hidden" name="currency_code" value="CAD">
                <input type="hidden" name="lc" value="CA">
                <input type="hidden" name="bn" value="PP-ShopCartBF">

              </form><?php
            endif;?>
          </div>
        </div><?php
      endwhile;
    endif;
  ?></div>
  <div class="wholesale-order green-bg pad-small">
    <div class="container txt-center">
      <h4 class="heading">Healthcare professionals and retailers: <a class="wholesale-btn" href="/order-form">Place Order Here</a></h4>
    </div>
  </div><?php
});
