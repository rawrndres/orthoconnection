<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use_template( function( &$template ) {?>

	<section class="container x-narrow pad-small-top txt-center"><?php
		$product_category = get_queried_object();
		echo '<h2 class="heading">'. $product_category->name . '</h2>';
		if (get_field('long_description', $product_category)):
			echo '<div class="category-description">' . get_field( 'long_description', $product_category ) . '</div>';
		elseif (get_term_field( 'description', $product_category )):
			echo '<div class="category-description">' . get_term_field( 'description', $product_category ) . '</div>';
		endif;
	?></section>

	<section class="container pad-small"><?php
		//if statement to check for hierarchy in taxonomy-brands.php (could update to order by BRAND children)
		if ($product_category->count == 5) {
			?><div class="category-products grid-5"><?php
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
    	} else {
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
		};
	?></section><?php
});
