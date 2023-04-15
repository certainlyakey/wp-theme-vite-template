<?php
/**
* ACF fields registration
*/

// Fields registration
function themeprefix_acf_add_php_fields() {
  $fields_path = themeprefix_get_functions_path() . 'plugins/fields/';

  // if ( function_exists( 'acf_add_local_field_group' ) ) {
    // Add your field group registration code in a separate file, one group per file
    // require_once( $fields_path . 'fields-group.php' );

    // File naming convention:
    // fields per site — fields-global-* (example: fields-global-analytics.php)
    // fields for a post of a specific post type — fields-posttype-{posttype-name} (example: fields-posttype-pages.php)
    // fields for all posts of a specific post type  — fields-posttype-common-{posttype-name} (example: fields-posttype-common-posts.php)
    // fields of a specific page template or home/front page — fields-page-{page-template-name} (example: fields-page-front-page.php)
    // fields for a term of specific taxonomy — fields_taxonomy-{taxonomy-name} (example: fields-taxonomy-category.php)
  // }
}

add_action( 'acf/init', 'themeprefix_acf_add_php_fields' );
