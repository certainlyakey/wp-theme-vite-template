<?php
/**
* Hooks responsible for everything displayed on frontend
*/

// Remove WP emoji code
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );



// Remove Gutenberg default styles
function themeprefix_remove_wp_block_library_css() {
  wp_dequeue_style( 'wp-block-library' );
  wp_dequeue_style( 'wp-block-library-theme' );
}

add_action( 'wp_enqueue_scripts', 'themeprefix_remove_wp_block_library_css', 100 );
