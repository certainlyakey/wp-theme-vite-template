<?php

// Registering ACF field group for the block
function themeprefix_register_field_group_example() {
  acf_add_local_field_group(
    [
      'key' => 'group_63a63c5e341ff',
      'title' => __( 'Block settings', 'theme_domain' ),
      'fields' => [
        [
          'key' => 'field_63a63c5eb94c5',
          'label' => __( 'Title', 'theme_domain' ),
          'name' => 'title',
          'type' => 'text',
          'instructions' => '',
          'required' => 1,
          'default_value' => '',
          'maxlength' => '',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
        ],
        [
          'key' => 'field_63a63d19b94c6',
          'label' => __( 'Summary', 'theme_domain' ),
          'name' => 'summary',
          'type' => 'textarea',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'default_value' => '',
          'maxlength' => '',
          'rows' => '',
          'placeholder' => '',
          'new_lines' => '',
        ],
      ],
      'location' => [
        [
          [
            'param' => 'block',
            'operator' => '==',
            'value' => 'acf/example',
          ],
        ],
      ],
      'menu_order' => 0,
      'position' => 'normal',
      'style' => 'default',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => '',
      'active' => true,
      'description' => '',
      'show_in_rest' => 0,
    ]
  );

}

add_action( 'acf/init', 'themeprefix_register_field_group_example' );



// Registering the block
function themeprefix_register_block_example() {
  register_block_type( __DIR__ );
}

add_action( 'init', 'themeprefix_register_block_example', 5 );



// Preprocessing block data before serving to a Twig template
function themeprefix_acf_blocks_preprocess_example( $context, $fields ) {
  $context = array_merge( $context, $fields );

  return $context;
}
