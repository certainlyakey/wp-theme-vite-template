<?php
/**
* Registering scripts and styles
*/

function themeprefix_script_enqueuer() {
  $scriptdeps_site = [];

  // wp_register_script( 'localised-strings-in-scripts', '' );
  // wp_enqueue_script( 'localised-strings-in-scripts' );
  // wp_add_inline_script( 'localised-strings-in-scripts', 'const localisedStrings = ' . json_encode( themeprefix_localized_strings() ) . ';' );
  wp_register_script( 'misc-script-data', '' );
  wp_enqueue_script( 'misc-script-data' );
  wp_add_inline_script( 'misc-script-data', 'const scriptData = ' . json_encode( themeprefix_script_data() ) . ';' );
}

add_action( 'wp_enqueue_scripts', 'themeprefix_script_enqueuer', 10 );



function themeprefix_defer_scripts( $tag, $handle, $src ) {

  // The handles of the enqueued scripts we want to defer
  $defer_scripts = [];

  if ( in_array( $handle, $defer_scripts ) ) {
    return '<script src="' . $src . '" defer="defer" type="text/javascript"></script>\n';
  }

  return $tag;
}

add_filter( 'script_loader_tag', 'themeprefix_defer_scripts', 10, 3 );
