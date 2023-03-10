<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$vnum = "20191116";

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php print( wp_title() ); ?></title>
    <meta name="description" content="">

    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#2C5253">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#2C5253"><?php

    wp_head();

    ?><link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>?v=<?= $vnum ?>" /><?php

    render_section('head');

  ?></head>
  <body <?php body_class(); ?>>
    <input id="toggle-menu" type="checkbox" hidden>

    <div class="top-bar">
      <div class="message">
        <span><?= $top_bar_message ?></span>
      </div>
      <div class="toolbar"><?php
      get_search_form()
        ?><div class="toolbar-cart"><form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
          <input type="hidden" name="cmd" value="_s-xclick">
          <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----MIIG1QYJKoZIhvcNAQcEoIIGxjCCBsICAQExggEwMIIBLAIBADCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwDQYJKoZIhvcNAQEBBQAEgYCmizOQNavTj1KemGmsiKg7IjYtkkFVVnWLCKwVGboHgCAQ0ADo52+JDVduqJl2VxNySkVbFrKAQ01aWyHwWwjy607syYfnTqD0E08w48SFszdU8TRok5VEblkoBFjLx1VzAv5ywj2GrV9kt2gZrsuGgI/Sdo9kqrbiZiNzyxTXkjELMAkGBSsOAwIaBQAwUwYJKoZIhvcNAQcBMBQGCCqGSIb3DQMHBAhEcGHvYTrLSYAwweywV4GvxT9hK0ezYp9kxL0mjuS7R8OmN3ZzWnOT7NZoPKqTcGrxVKDsfFvtwzeroIIDhzCCA4MwggLsoAMCAQICAQAwDQYJKoZIhvcNAQEFBQAwgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tMB4XDTA0MDIxMzEwMTMxNVoXDTM1MDIxMzEwMTMxNVowgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDBR07d/ETMS1ycjtkpkvjXZe9k+6CieLuLsPumsJ7QC1odNz3sJiCbs2wC0nLE0uLGaEtXynIgRqIddYCHx88pb5HTXv4SZeuv0Rqq4+axW9PLAAATU8w04qqjaSXgbGLP3NmohqM6bV9kZZwZLR/klDaQGo1u9uDb9lr4Yn+rBQIDAQABo4HuMIHrMB0GA1UdDgQWBBSWn3y7xm8XvVk/UtcKG+wQ1mSUazCBuwYDVR0jBIGzMIGwgBSWn3y7xm8XvVk/UtcKG+wQ1mSUa6GBlKSBkTCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb22CAQAwDAYDVR0TBAUwAwEB/zANBgkqhkiG9w0BAQUFAAOBgQCBXzpWmoBa5e9fo6ujionW1hUhPkOBakTr3YCDjbYfvJEiv/2P+IobhOGJr85+XHhN0v4gUkEDI8r2/rNk1m0GA8HKddvTjyGw/XqXa+LSTlDYkqI8OwR8GEYj4efEtcRpRYBxV8KxAW93YDWzFGvruKnnLbDAF6VR5w/cCMn5hzGCAZowggGWAgEBMIGUMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbQIBADAJBgUrDgMCGgUAoF0wGAYJKoZIhvcNAQkDMQsGCSqGSIb3DQEHATAcBgkqhkiG9w0BCQUxDxcNMjAwMjEyMTgwMzI5WjAjBgkqhkiG9w0BCQQxFgQUmgpb/lKliPyxiPci3F/6uQ3lzbYwDQYJKoZIhvcNAQEBBQAEgYAMXztc8S8esRWh9pF/KIKYQvWKefZsGIY7XHGsRO3HaBRdCU48+B1A61YtcLVSnIlMJcPdP2EgljcOtR3fQlMPmnR5oXQx2p8bQVaEWymKf7z0048ncXk0MOeRDbiUhYxo5br/HICgt/gxbUomWAL200jekLZNNz3W8olak8vuzQ==-----END PKCS7-----">
          <input type="image" src="https://orthoconnection.net/wp-content/themes/orthoconnection/assets/cart-btn.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
          <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
          </form>
        </div>
      </div>
    </div>

    <div class="nav-bar <?= $nav_theme ? "dark" : "light" ?>">
      <div class="mobile-bar">
        <a href="/" class="logo"><img src="<?php asset('logo-web.png'); ?>"/ alt="Orthoconnection Logo"></a>
        <label for="toggle-menu" class="open"><span></span><span></span><span></span></label>
      </div>

      <nav data-js-nav_controller>
        <a href="/market/healthcare-professionals">Healthcare Professionals</a>
        <a href="/market/retailers">Retailers</a>
        <a href="/market/consumers">Consumers</a>
        <a href="/faq">FAQ</a>
        <a href="/contact">Contact</a>
      </nav>
    </div>

    <div class="page-content" id="page"><?php
      render_section('content');
    ?></div>

    <div class="page-footer">
      <div class="container flex cols">

        <div class="col large-4">
          <div class="footer-contact">
            <a href="/" class="inline-logo">
              <img class="inline-logo" src="<?php print( get_stylesheet_directory_uri() ); ?>/assets/orthoconnection-logo-light.png"/ alt="Orthoconnection">
            </a>
            <div class="contact-row">
              <i class="icon-email"></i>
              <div class="contact-info"><span class="contact-tag">Got a question?</span> <a class="contact-link" href="mailto:<?= $general_inquiries_email ?>"></a></div>
            </div>
            <div class="contact-row">
              <i class="icon-fax"></i>
              <div class="contact-info"><span class="contact-tag">Fax</span> <a class="contact-link" href="tel:+1<?= preg_replace('/[^0-9.]+/', '', $fax) ?>"><?= $fax ?></a></div>
            </div>
            <div class="contact-row">
              <i class="icon-phone"></i>
              <div class="contact-info"><span class="contact-tag">Call us</span> <a  class="contact-link" href="tel:+1<?= preg_replace('/[^0-9.]+/', '', $phone) ?>"><?= $phone ?></a></div>
            </div>
          </div>
        </div>

        <div class="col large-8 menu-copyright-column">
          <ul class="footer-menu">
            <li><a href="/market/healthcare-professionals">Healthcare Professionals</a></li>
            <li><a href="/market/retailers">Retailers</a></li>
            <li><a href="/market/consumers">Consumers</a></li>
            <li><a href="/faq">FAQ</a></li>
            <li><a href="/contact">Contact</a></li>
          </ul>
          
          <div class="footer-copyright">
            <div class="lunastudios">
              webcraft by <a href="https://lunastudios.ca" target="_blank">☾LunaStudios</a>
            </div>
          OrthoConnection &copy; <?php echo date("Y"); ?> All rights reserved.
          </div><?php

          if ( !empty($social_media_links) ) :
            ?><ul class="footer-social"><?php
              foreach ( $social_media_links as $sm ):
                ?><li><a href="<?= $sm['url'] ?>" class="icon-<?= $sm['icon'] ?>" target="_blank"></a></li><?php
              endforeach;
            ?></ul><?php
          endif;

        ?></div>

      </div>
    </div><?php

    render_section('modals');

    ?><script src="<?= get_stylesheet_directory_uri()."/app.js?v=$vnum" ?>"></script>
    <!-- <hs:googleanalytics> -->
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function()
    { (i[r].q=i[r].q||[]).push(arguments)}
    ,i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://ssl.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-104776409-1', 'auto');
    ga('send', 'pageview');
    </script>
    <!-- </hs:googleanalytics> -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-43806207-11"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-43806207-11');
    </script>
    <script type="text/javascript">
      $(function () {<?php
        render_section('dom_ready');
      ?>});
    </script><?php

    render_section('scripts');

    wp_footer();

  ?></body>
</html>
