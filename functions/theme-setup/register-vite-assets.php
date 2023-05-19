<?php
/*
* Vite development
* Inspired by https://github.com/andrefelipe/vite-php-setup
*
*/

add_action(
  'wp_enqueue_scripts',
  function() {

    // dist subfolder - defined in vite.config.json
    $dist_folder = 'dist';

    $dist_uri = get_template_directory_uri() . '/' . $dist_folder;
    $dist_path = get_template_directory() . '/' . $dist_folder;

    $js_deps = [];

    $force_native_assets_build = false;
    if ( property_exists( themeprefix_get_common_config(), 'force_native_assets_build' ) ) {
      $force_native_assets_build = themeprefix_get_common_config()->force_native_assets_build === true;
    }

    if (
      array_key_exists( 'GENERATE_ASSETS_FOR_DEV', $_ENV ) &&
      'true' === $_ENV['GENERATE_ASSETS_FOR_DEV'] &&
      array_key_exists( 'LANDO_MOUNT', $_ENV ) &&
      file_exists( $_ENV['LANDO_MOUNT'] . '/.vite-hmr' )
    ) {
      $vite_host = 'http://localhost';
      if ( array_key_exists( 'LANDO_INFO', $_ENV ) && !$force_native_assets_build ) {
        $lando_info = json_decode( $_ENV['LANDO_INFO'], true );
        if ( $lando_info ) {
          $vite_host = $lando_info['node']['urls'][0];
          $vite_host = trim( $vite_host, '/' );
        }
      }

      // inserting HMR into <head> for live reload

      add_action(
        'wp_head',
        function() use ( $vite_host, $force_native_assets_build ) {
          if ( array_key_exists( 'LANDO_INFO', $_ENV ) ) {
            // default server address, port and entry point can be customized in vite.config.json
            $vite_port = $_ENV['LANDO_INFO'] && !$force_native_assets_build ? themeprefix_get_common_config()->lando_vite_port : 3000;
            $vite_entry_point = '/main.js';
            $vite_url = $vite_host . ':' . $vite_port . $vite_entry_point;
            echo '<script type="module" crossorigin src="' . esc_url( $vite_url ) . '"></script>';
          }
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

          foreach ( @$manifest[ $manifest_key[0] ]['css'] as $css_file ) {
            wp_enqueue_style( 'main', $dist_uri . '/' . $css_file );
          }

          $js_file = @$manifest[ $manifest_key[0] ]['file'];
          if ( !empty( $js_file ) ) {
            wp_enqueue_script( 'main', $dist_uri . '/' . $js_file, $js_deps, '', true );
          }
        }
      }
    }
  }
);
