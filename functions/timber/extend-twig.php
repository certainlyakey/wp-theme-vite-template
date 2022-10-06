<?php
/**
* Add custom Twig filters and functions here
*/

add_filter(
  'timber/twig/filters',
  function( $filters ) {
    $filters['slugify'] = [
      'callable' => 'themeprefix_string_slugify',
    ];

    return $filters;
  }
);



function themeprefix_string_slugify( $str ) {
  if ( gettype( $str ) === 'string' ) {
    $result = strtolower( str_replace( ' ', '-', $str ) );
  } else {
    throw new Exception( sprintf( 'The slugify filter only works with strings, got "%s" as first argument.', gettype( $str ) ) );
  }
  return $result;
}
