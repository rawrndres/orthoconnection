<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use_template( function( &$template ) {

  $acf_options = get_fields( 'option' ) ?: [];

  ?><section id="faq-section">

    <div id="healthcare-faq" class="cols container pad">
      <div class="col large-5">
        <h2 class="heading">Healthcare Professionals and&nbsp;Retailers FAQ</h2>
      </div><?php

    iterate( get_field('health_and_retailers_faqs'), function ( $faq ) {

      if ($this->isFirst):
        ?><div class="col large-7 flex-wrap offset-left">
          <div class="faq-list"><?php
      endif;

      ?><div class="faq-block">
        <a href="#" class="question"><?= $faq['question'] ?></a>
        <div class="answer"><?= $faq['answer'] ?></div>
      </div><?php

      if ($this->isLast):
        ?></div>
        </div><?php
      endif;
    });

    ?></div>

    <div id="consumer-faq" class="cols container pad-small">
      <div class="col large-5">
        <h2 class="heading">Consumer FAQ</h2>
      </div><?php

    iterate( get_field('faqs'), function ( $faq ) {

      if ($this->isFirst):
        ?><div class="col large-7 flex-wrap offset-left">
          <div class="faq-list"><?php
      endif;

      ?><div class="faq-block">
        <a href="#" class="question"><?= $faq['question'] ?></a>
        <div class="answer"><?= $faq['answer'] ?></div>
      </div><?php

      if ($this->isLast):
        ?></div>
        </div><?php
      endif;
    });

    ?></div>

  </section>
  <section class="pad green-bg">
    <h4 class="container x-narrow heading txt-center">More questions? Get in touch <a href="/contact">here.</a></h4>
  </section><?php

});