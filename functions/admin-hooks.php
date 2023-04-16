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


add_action(
  'admin_init',
  function() {
    // Redirect any user trying to access comments page
    global $pagenow;

    if ( 'edit-comments.php' === $pagenow ) {
      wp_safe_redirect( admin_url() );
      exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );

    // Disable support for comments and trackbacks in post types
    foreach ( get_post_types() as $post_type ) {
      if ( post_type_supports( $post_type, 'comments' ) ) {
        remove_post_type_support( $post_type, 'comments' );
        remove_post_type_support( $post_type, 'trackbacks' );
      }
    }
  }
);

// Close comments on the front-end
add_filter( 'comments_open', '__return_false', 20, 2 );
add_filter( 'pings_open', '__return_false', 20, 2 );

// Hide existing comments
add_filter( 'comments_array', '__return_empty_array', 10, 2 );

// Remove comments page in menu
add_action(
  'admin_menu',
  function() {
    remove_menu_page( 'edit-comments.php' );
  }
);

// Remove comments links from admin bar
add_action(
  'init',
  function() {
    if ( is_admin_bar_showing() ) {
      remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
    }
  }
);
