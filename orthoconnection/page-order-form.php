<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use_template( function( &$template ) {

  $acf_options = get_fields( 'option' ) ?: [];

  ?><section id="order-form" class="pad-small">

    <div class="cols container pad-small">
      <div class="col large-4">
        <h2 class="heading">Order Form</h2>
        <p class="heading-small">For use of healthcare professionals and retailers only</p>

        <div class="legacy-forms">
          <p>Legacy print and fax forms:</p>
          <a href="<?php print( get_stylesheet_directory_uri() ); ?>/assets/OrthoConnection_Fall_2021_Prof_Order_Form.pdf" target="_blank">Healthcare Professionals - main order form</a>
          <a href="<?php print( get_stylesheet_directory_uri() ); ?>/assets/OrthoConnection_Fall_2021_Retail_Order_Form1-pages.pdf" target="_blank">Retailers - main order form</a>
        </div>
      </div>
      <div class="col large-8 flex-wrap"><?php
        while ( have_posts() ) : the_post();
          the_content();
        endwhile; 
        wp_reset_query();
      ?><p class="confirmation-notice">If we don't confirm your order within 24 hours please <a href="/contact">CONTACT US</a>.</p>
      </div>
    </div>

  </section><?php

});
