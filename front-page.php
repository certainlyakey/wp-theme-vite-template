<?php
/**
 * Front page
 */

use Timber\Timber;

// front page set in WP settings
$context = Timber::context();

Timber::render( 'front-page.twig', $context );
