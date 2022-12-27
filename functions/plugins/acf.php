<?php
/**
* Functions related to ACF
*/

// Add options pages

function themeprefix_add_options_pages() {
  if ( function_exists( 'acf_add_options_page' ) ) {

    acf_add_options_page(
      [
        'page_title'  => __( 'Site Settings', 'theme_domain' ),
        'menu_slug'   => 'site-settings',
        'capability'  => 'edit_posts',
        'redirect'    => false,
      ]
    );

  }
}

add_action( 'acf/init', 'themeprefix_add_options_pages' );



function themeprefix_acf_global_settings_context( $context ) {

  // make ACF options page fields available in every Twig file
  $context['options'] = get_fields( 'option' );

  return $context;
}

add_filter( 'timber/context', 'themeprefix_acf_global_settings_context' );



// Wraps field definitions in __() function when exporting to PHP via ACF admin UI
function themeprefix_acf_localize_fields_when_exporting() {
  acf_update_setting( 'l10n_textdomain', 'theme_domain' );
}

add_action( 'acf/init', 'themeprefix_acf_localize_fields_when_exporting' );



// Disable "Custom fields" menu in admin
// You need to load environment to WP in order for this to work
// Eg. by adding autoload.php from a site' vendor folder to wp-config.php
add_filter(
  'acf/settings/show_admin',
  function() {
    return !isset( $_ENV['GENERATE_ASSETS_FOR_DEV'] ) || true == $_ENV['GENERATE_ASSETS_FOR_DEV'];
  }
);



function themeprefix_acf_blocks_render( $block, $content = '', $is_preview = false, $post_id = 0 ) {
  $context = Timber\Timber::context();

  $context['block'] = $block;

  $fields = get_fields();

  $slug = str_replace( 'acf/', '', $block['name'] );

  $fields_keys = array_map(
    function( $key ) use ( $slug ) {
      return str_replace( 'block_' . $slug . '_', '', $key );
    },
    array_keys( $fields )
  );
  $fields = array_combine( $fields_keys, array_values( $fields ) );

  $preprocess_function_name = 'themeprefix_acf_blocks_preprocess_' . themeprefix_replace_dashes_with_underscores( $slug );

  if ( function_exists( $preprocess_function_name ) ) {
    $context = call_user_func( $preprocess_function_name, $context, $fields, $post_id );
  }

  $context['fields'] = $fields;
  $context['is_preview'] = $is_preview;

  $block_supports_nesting = array_key_exists( 'supports', $block ) && array_key_exists( 'jsx', $block['supports'] ) && true === $block['supports']['jsx'];

  // Nested blocks can only be inserted in the preview mode
  if ( $is_preview && !$block_supports_nesting ) {
    Timber\Timber::render_string(
      sprintf(
        // translators: <em><a>
        esc_html__( '%1$sPreview is not available for this block, please visit %2$sthe page%3$s to see it%4$s', 'theme_domain' ),
        '<em style="color:#666">',
        '<a href="' . get_permalink( $post_id ) . '" target="_blank">',
        '</a>',
        '</em>'
      )
    );
  } else {
    if ( array_key_exists( 'GENERATE_ASSETS_FOR_DEV', $_ENV ) && true == $_ENV['GENERATE_ASSETS_FOR_DEV'] ) {
      Timber\Timber::render_string( '<!-- ACF block: ' . $block['title'] . ' (' . $block['name'] . ') -->' );
    }
    Timber\Timber::render( 'functions/blocks/' . $slug . '/block-' . $slug . '.twig', $context );
  }
}
