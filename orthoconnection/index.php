<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use_template( function( &$template ) {

  if ( have_posts() ):
    while ( have_posts() ):
      the_post();

      ?><section>
        <div class="index container wysiwyg"><?php
          the_content();
        ?></div>
      </section><?php

    endwhile;
  endif;
});
