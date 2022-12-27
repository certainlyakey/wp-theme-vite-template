<?php
/**
* Functions (see frontend-hooks.php for hooks) related to everything displayed on frontend
*/

function themeprefix_replace_dashes_with_underscores( $str ) {
  return str_replace( '-', '_', $str );
}
