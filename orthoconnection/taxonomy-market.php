<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use_template( function( &$template ) {?>

	<section class="green-bg pad-small">
		<div class="container txt-center"><?php
		$product_category = get_queried_object();
		echo '<h2 class="heading">'. $product_category->name . '</h2>';
		if (get_field('intro_text', $product_category)):
			echo '<div class="market-intro">' . get_field( 'intro_text', $product_category ) . '</div>';
		endif;
			?><div class="cols market-icons">
				<div class="col large-4"><?php
					if (get_field('col_1_icon', $product_category)):
						echo '<i class="icon-' . get_field( 'col_1_icon', $product_category ) . '"></i>';
						echo get_field( 'col_1_content', $product_category );
					endif;
				?></div>	
				<div class="col large-4"><?php
					if (get_field('col_2_icon', $product_category)):
						echo '<i class="icon-' . get_field( 'col_2_icon', $product_category ) . '"></i>';
						echo get_field( 'col_2_content', $product_category );
					endif;
				?></div>	
				<div class="col large-4"><?php
					if (get_field('col_3_icon', $product_category)):
						echo '<i class="icon-' . get_field( 'col_3_icon', $product_category ) . '"></i>';
						echo get_field( 'col_3_content', $product_category );
					endif;
				?></div>		
			</div>
		</div>
	</section>

	<section class="container pad-small"><?php

		if (get_field( 'professional_market', $product_category )):
			$args = array(
				'numberposts'	=> -1,
				'post_type'		=> 'products',
				'meta_key'		=> 'pro_only',
				'meta_value'	=> '1'
			);
			$query = new WP_Query( $args );

			if ( $query->have_posts() ) {
				echo '<div class="product-category heading">Exclusive Products</div>';
		    	$term = $query->queried_object;
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
					if (get_field('pro_only')):
    					echo '<div class="ribbon"><span>PROFESSIONALS ONLY</span></div>';
  					endif;
					echo '</a>';							
			    endwhile;
	    		?></div><?php
				wp_reset_query();
			};
		endif;

		$product_cats = get_terms( 'product_categories', array(
		    'hide_empty' => 0
		) );
		
		foreach ($product_cats as $product_cat) {
			$args = array(
			    'tax_query' => array(
			        array(
			            'taxonomy' => 'product_categories',
			            'field' => 'name',
			            'terms' => $product_cat,
			        ),
			    ),
			    'post_type' => 'products',
			    'meta_key'		=> 'pro_only',
				'meta_value'	=> '0'
			);
			$query = new WP_Query( $args );

			if ( $query->have_posts() ) {
				echo '<div class="product-category heading">' . $product_cat->name . '</div>';
		    	$term = $query->queried_object;
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
				wp_reset_query();
			};
		};
	?></section><?php
});
