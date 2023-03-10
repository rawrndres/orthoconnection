<?php

/*$thumb = has_post_thumbnail() ?
  get_the_post_thumbnail_url( get_the_ID(), 'post_thumb' ):
  null;*/

?><div class="post">
  <p class="post-title"><?php the_title() ?></p>
  <p class="post-excerpt" data-line-clamp><?= get_the_excerpt() ?></p>
  <a href="<?php the_permalink() ?>" class="link">Read More</a>
</div>
