<?php

$current_post = $post;

$args = [
  'numberposts' => '4',
  'post_status' => 'publish'
];

if ( $post ) {
  $args['exclude'] = [ $post->ID ];
}

$recent_posts = new WP_Query( $args );

$recent_posts_count = 0;

if ( $recent_posts->have_posts() ):

  while ( $recent_posts->have_posts() && $recent_posts_count < 2 ):
    $recent_posts->the_post();

    if ( get_the_ID() !== $current_post->ID ):

      begin_section('recent_posts');
        get_template_part('includes/post');
      end_section();

      $recent_posts_count++;
    endif;

  endwhile;

  wp_reset_postdata();

endif;

if ( $recent_posts_count ):
  ?><div class="container"><?php
    render_section('latest-posts-heading');
    ?><div class="post-list"><?php
      render_section('recent_posts');
    ?></div>
  </div><?php
endif;
