<?php
/*
* VITE development
* Inspired by https://github.com/andrefelipe/vite-php-setup
*
*/

// enqueue hook
add_action(
  'wp_enqueue_scripts',
  function() {

    // dist subfolder - defined in vite.config.json
    $dist_folder = 'dist';

    // defining some base urls and paths
    $dist_uri = get_template_directory_uri() . '/' . $dist_folder;
    $dist_path = get_template_directory() . '/' . $dist_folder;

    // js enqueue settings
    $js_deps = [];

    if ( $_ENV['IS_VITE_DEVELOPMENT'] && true == $_ENV['IS_VITE_DEVELOPMENT'] ) {

      // insert hmr into head for live reload

      add_action(
        'wp_head',
        function() {
          // default server address, port and entry point can be customized in vite.config.json
          $vite_server = 'http://localhost:3000';
          $vite_entry_point = '/main.js';
          $vite_url = $vite_server . $vite_entry_point;
          echo '<script type="module" crossorigin src="' . esc_url( $vite_url ) . '"></script>';
        }
      );

    } else {

      // production version, 'npm run build' must be executed in order to generate assets

      // read manifest.json to figure out what to enqueue
      $manifest = json_decode( file_get_contents( $dist_path . '/manifest.json' ), true );

      if ( is_array( $manifest ) ) {

        // get first key, by default it is 'main.js' but it can change
        $manifest_key = array_keys( $manifest );
        if ( isset( $manifest_key[0] ) ) {

          // enqueue CSS files
          foreach ( @$manifest[ $manifest_key[0] ]['css'] as $css_file ) {
            wp_enqueue_style( 'main', $dist_uri . '/' . $css_file );
          }

          // enqueue main JS file
          $js_file = @$manifest[ $manifest_key[0] ]['file'];
          if ( !empty( $js_file ) ) {
            wp_enqueue_script( 'main', $dist_uri . '/' . $js_file, $js_deps, '', true );
          }
        }
      }
    }
  }
);
