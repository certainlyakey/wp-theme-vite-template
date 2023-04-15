<?php
/**
* Hooks related to content structure and everything displayed on admin side
*/

// Enable background updates even if there is a git in the root (and there is!)
add_filter( 'automatic_updates_is_vcs_checkout', '__return_false', 1 );



// Remove unnecessary sections from the theme customizer
function themeprefix_edit_customizer( $wp_customize ) {
  $wp_customize->remove_section( 'colors' );
  $wp_customize->remove_section( 'custom_css' );
  // $wp_customize->remove_section( 'static_front_page' );
}

add_action( 'customize_register', 'themeprefix_edit_customizer' );



function themeprefix_add_block_categories( $categories ) {
  $custom_block_category = [
    'slug' => 'themeprefix-block-category',
    'title' => __( 'Custom theme blocks', 'theme_domain' ),
    'icon'  => 'text',
  ];

  array_unshift( $categories, $custom_block_category );
  return $categories;
}

add_filter( 'block_categories_all', 'themeprefix_add_block_categories', 10, 2 );



add_filter( 'xmlrpc_enabled', '__return_false' );
