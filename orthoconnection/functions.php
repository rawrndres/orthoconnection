<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

session_start();

// We have to call framework functions after the theme is initilized otherwie they're not available to the child theme.
add_action( 'after_setup_theme', function () {

  // Use our data injection method to add stuff to every page (that uses our templating system).
  modify( 'page', function ( $self ) {
    global $post;

    $self['page_title'] = wp_title( '-', false );
    $self['body_class'] = get_body_class();
    $self['active_nav'] = null;
    $self['nav_class'] = null;
    $self['body_attrs'] = [ "id" => "top" ];
    $self['banner_url'] = null;

    // Get the page ID (not the post ID)
    $page_id =  is_home() || is_single() || is_archive() || is_search() || is_404() ?
      get_option( 'page_for_posts' ) :
      $post->ID;

    $acf_options = [];
    $acf = [];

    if ( function_exists('get_fields') ) {

      // Get all the acf(s) from the theme options.
      $acf_options = get_fields( 'option' ) ?: [];

      if (!empty($acf_options['social_media_links'])):
        begin_section('social_links');
          foreach ( $acf_options['social_media_links'] as $sm ):
            ?><a href="<?= $sm['url'] ?>" class="icon-<?= $sm['icon'] ?>" target="_blank"></a><?php
          endforeach;
        end_section();
      endif;

      if ( $page_id ) {
        // Get all the acf(s) for this page
        $acf = get_fields( $page_id ) ?: [];
      }
    }

    if ( $page_id ) {
      // add the banner url if a featured image is set.
      $self['banner_url'] = has_post_thumbnail( $page_id ) ?
        get_the_post_thumbnail_url( $page_id, 'banner' ) :
        null;
    }

    // return self merged over the acf data, we do it in this order to prevent acf from over writing important page data.
    return array_merge( $acf_options, $acf, $self );
  });

  # =====================================
  # Nav definition and customization
  # ---------------------------

  modify('nav', function () {
    $nav = [
      'Home' => '/',
      'Our Story' => '/our-story/',
      'Invest' => '/invest/',
      'News' => '/news/',
      'Contact' => '/contact/'
    ];
    return $nav;
  });

  modify('nav_element', function( $attrs ) {
    if ( $attrs['id'] === 'home' ) {
      $attrs['class'] .= " mobile";
    }
    return $attrs;
  });

  modify('footer_nav', function () {
    $nav = [
      'About' => '/our-story/',
      'The Team' => '/our-story/#team',
      'Invest' => '/invest/',
      'Financials' => '/invest/#financials',
      'Events' => '/events/',
      'News Releases' => '/news/',
      'In The Press' => '/news/#press',
      'Careers' => '/contact/#careers',
      'Faq' => '/invest/#faq',
      'Contact' => '/contact/'
    ];
    return $nav;
  });

  # =====================================
  # Form submission customizations
  # ---------------------------

  modify('form_translate', function ( $translations ) {
    return [
      'contactForm' => [
        'fname' => 'Name',
        'email' => 'Email Address',
        'phone' => 'Phone',
        'message' => 'Message'
      ]
    ];
  });

  # ===================================
  # Other customized site sections
  # -------------------------

});

add_action('init', function () {

  // Enable Featured Images
  add_theme_support( 'post-thumbnails', ['post', 'page', 'team_members'] );

  // Create some custom image sizes.
  add_image_size( 'post_thumb', 412, 258, true );
  add_image_size( 'banner', 1920 );
});

add_action( 'admin_menu', function () {

  // Hide "posts" in admin because we have no blog.
  remove_menu_page( 'edit.php' );

  // Hide "author" and "slug" meta boxes for page edit
  remove_meta_box( 'slugdiv', 'page', 'none' );
  remove_meta_box( 'authordiv', 'page', 'none' );
});

add_action('admin_init', function () {

  // Disable the content editor for pages becase we're using ACF to define the content here.
  // remove_post_type_support( 'page', 'editor' );

  // Disable media buttons on WYSIWYG editor
  // remove_all_actions('media_buttons');
  remove_menu_page( 'edit-comments.php' );
});

// Customize the WYSIWYG editor:
add_filter('tiny_mce_before_init', function($args) {
  $args['toolbar1'] = "formatselect,bold,italic,bullist,numlist,blockquote,alignleft,aligncenter,alignright,link";
  $args['toolbar2'] = "";
  return $args;
});

add_filter( 'the_content', function ( $content ) {
  $content = str_replace('<p>&nbsp;</p>', '', $content );
  $content = str_replace('&nbsp;', '', $content );
  $content = preg_replace('/\>\s+\</', '><', $content );
  return $content;
});

do_action('clean_nav');

add_action('clean_nav', function () {
  remove_menu_page('sb-instagram-feed');
});

add_filter('reorder_admin_menu', function () {
  return array(
    'acf-options', // Options
    'index.php', // Dashboard
    'edit.php?post_type=page', // Pages
    'edit.php?post_type=accommodations', // Accomidations
    'edit.php', // Posts
    'upload.php', // Media
    'users.php', // Users

    'separator1', // --Space--
    'themes.php', // Appearance
    'edit-comments.php', // Comments
    'options-general.php', // Settings
    'plugins.php', // Plugins
    'tools.php', // Tools
    'separator2', // --Space--
  );
});

function get_all_active_team_members() {
  $query = new WP_Query([
    'post_type' => 'team_members',
    'post_status' => 'publish',
    'nopaging' => true,
    'posts_per_page' => -1
  ]);
  return ( $query->have_posts() ? $query->posts : []);
}

function get_all_reviews() {
  $query = new WP_Query([
    'post_type' => 'testimonials',
    'post_status' => 'publish',
    'nopaging' => true,
    'posts_per_page' => -1
  ]);
  return ( $query->have_posts() ? $query->posts : []);
}

function get_all_active_posts($type = "post", $count = -1, $with_meta = false) {
  return cache_query("get".($count < 1 ? "all" : $count)."_active_".$type,
    function($post_type, $count, $with_meta) {
      $posts = [];

      $query = new WP_Query([
        'post_type' => $post_type,
        'post_status' => 'publish',
        'nopaging' => ($count < 1),
        'posts_per_page' => $count
      ]);

      if ( $query->have_posts() ) {
        if ( $with_meta ) {
          foreach ( $query->posts as $index => $post ) {
            $post = (array)$post;
            $post['meta'] = get_fields($post['ID']);
            $posts[] = (object)$post;
          }
        } else {
          $posts = $query->posts;
        }
      }

      return $posts;
    },
    $type, $count, $with_meta
  );
}

function features($tax) {
  return cache_query($tax['slug']."_features", function ($tax) {
    $array = [];
    $icons = [];
    $slugs = [];
    $names = [];
    $descriptions = [];

    foreach ($tax['features'] as $feature) {
      $feature_icon = get_field('icon', 'term_'.$feature->term_id);
      $array[$feature->slug] = $feature->name;
      $slugs[] = $feature->slug;
      $names[] = $feature->name;
      $icons[] = $feature_icon !== "none"?
        $feature_icon:
        "";
      $descriptions[] = empty(!$feature->description)?
        $feature->description:
        $feature->name;
    }

    if (count($tax['features']) > 1) {
      $last_name = array_pop($names);
      $names[count($names) - 1] .= " and ".$last_name;

      $last_description = array_pop($descriptions);
      $descriptions[count($descriptions) - 1] .= " and ".$last_description;
    }

    return [
      'array' => $array,
      'slugs' => implode(",", $slugs),
      'names' => implode(", ", $names),
      'descriptions' => implode(", ", $descriptions),
      'icons' => array_filter($icons)
    ];
  }, $tax);
}

function brands_posts($query)
{
    if ($query->is_tax())
    {
        $query->set( 'orderby', 'menu_order' );
        $query->set( 'order', 'ASC' );
    }
}
add_action('pre_get_posts', 'brands_posts');

function mkrel($url) {
  return preg_replace('/^http[s]?:\/\/[^\/]*\//', '/', $url);
}

add_filter('wpcf7_autop_or_not', '__return_false');

function customize_add_button_atts( $attributes ) {
  return array_merge( $attributes, array(
    'text' => 'Add another product',
  ) );
}

function customize_remove_button_atts( $attributes ) {
  return array_merge( $attributes, array(
    'text' => 'Remove this product',
  ) );
}

add_filter( 'wpcf7_field_group_add_button_atts', 'customize_add_button_atts' );
add_filter( 'wpcf7_field_group_remove_button_atts', 'customize_remove_button_atts' );


add_filter( 'manage_products_posts_columns', 'add_columns' );
function add_columns( $columns ) {
    $columns['paypal_price'] = 'Price';
    $columns['paypal_codes'] = 'Code';
    return $columns;
}

add_action( 'manage_products_posts_custom_column', 'product_column', 10, 2);
function product_column( $column, $post_id ) {
  if ( 'paypal_price' === $column ) {
    $price = get_post_meta( $post_id, 'paypal_price', true );

    if ( ! $price ) {
      _e( 'n/a' );  
    } else {
      echo '$' . $price;
    }
  }

  if ( 'paypal_codes' === $column ) {
    $code = get_post_meta( $post_id, 'paypal_codes', true );

    if ( ! $code ) {
      _e( 'n/a' );  
    } else {
      echo $code;
    }
  }
}

function generatewp_quickedit_fields( $column_name, $post_type ) {
  if ( 'paypal_price' === $column_name ){
    $product_price = get_post_meta( $post_id, 'paypal_price', true );
    ?>
    <fieldset class="inline-edit-col-right">
        <div class="inline-edit-col">
            <label>
                <span class="title"><?php esc_html_e( 'Price', 'generatewp' ); ?></span>
                <span class="input-text-wrap">
                    <input type="text" name="paypal_price" class="generatepaypal_price" value="">
                </span>
            </label>
        </div>
    </fieldset>
    <?php
  }

  if ( 'paypal_codes' === $column_name ){
    $product_code = get_post_meta( $post_id, 'paypal_codes', true );
    ?>
    <fieldset class="inline-edit-col-right">
        <div class="inline-edit-col">
            <label>
                <span class="title"><?php esc_html_e( 'Code', 'generatewp' ); ?></span>
                <span class="input-text-wrap">
                    <textarea name="paypal_codes" class="generatepaypal_codes" value=""></textarea>
                </span>
            </label>
        </div>
    </fieldset>
    <?php
  }
}
add_action( 'quick_edit_custom_box', 'generatewp_quickedit_fields', 10, 2 );


function generatewp_quickedit_save_post( $post_id, $post ) {
    // if called by autosave, then bail here
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;

    // if this "post" post type?
    if ( $post->post_type != 'products' )
        return;

    // does this user have permissions?
     if ( ! current_user_can( 'edit_post', $post_id ) )
         return;

    // update!
    if ( isset( $_POST['paypal_price'] ) ) {
      update_post_meta( $post_id, 'paypal_price', $_POST['paypal_price'] );
    }
    if ( isset( $_POST['paypal_codes'] ) ) {
      update_post_meta( $post_id, 'paypal_codes', $_POST['paypal_codes'] );
    }
}
add_action( 'save_post', 'generatewp_quickedit_save_post', 10, 2 );


function admin_footer_js(){
    //you should check to make sure this is the page your want to alter first, check if this your custom post edtit page
    // for example .wp-admin/edit.php?post_type=my-cpt would be your custom post table list page.
    if(!isset($_GET['post_type']) || false === strpos($_GET['post_type'],'products') ){
        return false;
    }
    //get_current_screen() can result in fatal error on some admin pages, hence I use it after a basic check above
        $screen = get_current_screen();  
        if ( 'edit' != $screen->base && '' != $screen->action ){
        return;
    }?>
        //now we can sure this is our page.
        <script type="text/javascript">
        jQuery( function( $ ) {
            $( '#the-list' ).on( 'click', '.editinline', function( e ) {
                //e.preventDefault();
                var editPrice = $(this).data( 'product-price' );
                var editCode = $(this).data( 'product-code' );
                //inlineEditPost.revert();
                $( '.generatepaypal_price' ).val( editPrice ? editPrice : '' );
                $( '.generatepaypal_codes' ).val( editCode ? editCode : '' );
            });
        });
        </script><?php
}
add_action( 'admin_print_footer_scripts', 'admin_footer_js' );


function generatewp_quickedit_set_data( $actions, $post ) {
    $found_price = get_post_meta( $post->ID, 'paypal_price', true );
    $found_code = get_post_meta( $post->ID, 'paypal_codes', true );

    if ( $found_price ) {
        if ( isset( $actions['inline hide-if-no-js'] ) ) {
            $new_attribute = sprintf( 'data-product-price="%s"', esc_attr( $found_price ) );
            $actions['inline hide-if-no-js'] = str_replace( 'class=', "$new_attribute class=", $actions['inline hide-if-no-js'] );
        }
    }

    if ( $found_code ) {
        if ( isset( $actions['inline hide-if-no-js'] ) ) {
            $new_attribute = sprintf( 'data-product-code="%s"', esc_attr( $found_code ) );
            $actions['inline hide-if-no-js'] = str_replace( 'class=', "$new_attribute class=", $actions['inline hide-if-no-js'] );
        }
    }

    return $actions;
}
add_filter('post_row_actions', 'generatewp_quickedit_set_data', 10, 2);