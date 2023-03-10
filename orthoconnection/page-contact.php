<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use_template( function( &$template ) {

  $acf_options = get_fields( 'option' ) ?: [];

  ?><section id="contact" class="pad-small">

    <div class="container">

      <div class="cols flex">

        <div class="col large-6 contact-details flex">
          <h1 class="heading">Contact</h1>
          <div class="contact-row">
            <i class="icon-email"></i>
            <div class="contact-info"><span class="contact-tag">Email:</span> <a class="contact-link" href="mailto:<?= $acf_options['general_inquiries_email'] ?>"></a></div>
          </div>
          <div class="contact-row">
            <i class="icon-fax"></i>
            <div class="contact-info"><span class="contact-tag">Fax:</span> <a class="contact-link" href="tel:+1<?= preg_replace('/[^0-9.]+/', '', $acf_options['fax']) ?>"><?= $acf_options['fax'] ?></a></div>
          </div>
          <div class="contact-row">
            <i class="icon-phone"></i>
            <div class="contact-info"><span class="contact-tag">Phone:</span> <a  class="contact-link" href="tel:+1<?= preg_replace('/[^0-9.]+/', '', $acf_options['phone']) ?>"><?= $acf_options['phone'] ?></a></div>
          </div>
          <a href="/faq" class="faq-link">Read our <span>FAQ page</span> for common product, shipping & payment questions.</a>
        </div>

        <div class="col large-6" >
          <h2 class="heading">Send us a message</h2><?php
          while ( have_posts() ) : the_post();
            the_content();
          endwhile; 
          wp_reset_query();
        ?></div>

      </div>

    </div>

  </section><?php

});
