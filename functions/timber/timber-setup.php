<?php
/**
* Setup Timber environment
*/

require_once get_template_directory() . '/vendor/autoload.php';

// Initialize Timber.
Timber\Timber::init();

if ( !class_exists( 'Timber' ) ) {
  add_action(
    'admin_notices',
    function() {
      echo '
        <div class="error">
          <p>
            Timber not installed. Have you run <code>composer install</code> in the theme folder?
          </p>
        </div>
      ';
    }
  );

  return;
}

// Only relevant for paths inside Twig files
$svg_sprite_dir = 'assets';
Timber\Timber::$dirname = [ 'templates', $svg_sprite_dir ];
