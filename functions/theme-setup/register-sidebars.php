<?php
/**
* Sidebar registration
*/

function themeprefix_register_sidebars() {
  // register_sidebar( [] );
}

add_action( 'widgets_init', 'themeprefix_register_sidebars' );
