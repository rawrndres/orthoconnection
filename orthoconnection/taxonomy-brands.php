<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use_template( function( &$template ) {?>

	<section class="container x-narrow pad-small txt-center"><?php
		$brand = get_queried_object();
		if ($brand_logo = get_field('logo', $brand)):
			echo '<img class="brand-logo" src="' . $brand_logo .'"alt="' . $brand->name . '" />';
		else:
		    echo '<h4>'. $brand->name . '</h4>';
		endif;
		if (get_field('long_description', $brand)==''):
			echo '<div class="brand-description">' . get_term_field( 'description', $brand ) . '</div>';
		endif;
	?></section>

	<section class="container"><?php
		if ($brand->parent == 0 && get_term_children($brand->term_id,'brands')) {  

			$product_cats = get_terms( 'brands', array(
			    'hide_empty' => 0,
			    'parent' => $brand->term_id
			) );
			
			foreach ($product_cats as $product_cat) {
				$args = array(
				    'tax_query' => array(
				        array(
				            'taxonomy' => 'brands',
				            'field' => 'name',
				            'terms' => $product_cat,
				        ),
				    ),
				    'post_type' => 'products'
				);
				$query = new WP_Query( $args );

				if ( $query->have_posts() ) {
					echo '<div class="product-category heading">' . $product_cat->name . '</div>';
			    	$term = $query->queried_object;
			    	if ($query->found_posts == 5) {
						?><div class="brand-products grid-5"><?php
					
					    while ( $query->have_posts() ) : $query->the_post();
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
							echo '</a>';							
					    endwhile;
			    		?></div><?php
			    	} else {
						?><div class="brand-products grid-4"><?php
					
					    while ( $query->have_posts() ) : $query->the_post();
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
							echo '</a>';							
					    endwhile;
			    		?></div><?php
		    		}
					wp_reset_query();
				};
			}
		} else {
			?><div class="brand-products grid-4"><?php
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
	if (get_field('long_description', $brand)):
		echo '<section class="container x-narrow pad-small-bottom txt-center">
		<div class="brand-description">' . get_field( 'long_description', $brand ) . '</div>
		</section>';
	endif;
});
