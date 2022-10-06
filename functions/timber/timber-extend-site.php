<?php
/**
* Setup variables that should be available via $context in all the templates
*/

use Timber\Timber;

add_filter(
  'timber/context',
  function( $context ) {
    $context['common_config'] = themeprefix_get_common_config();

    $context['mainmenu'] = Timber::get_menu( 'mainmenu' );

    return $context;
  }
);
