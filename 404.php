<?php
/**
 * The template for displaying 404 pages (Not Found)
 */

use Timber\Timber;

$context = Timber::context();
$context['title'] = __( 'Error', 'theme_domain' ) . ' 404 (' . __( 'page not found', 'theme_domain' ) . ')';
$context['subtitle'] = sprintf( __( 'Sorry, we couldn\'t find what you\'re looking for', 'theme_domain' ), '<a href="' . get_bloginfo( 'url' ) . '">', '</a>' );

Timber::render( 'message.twig', $context );
