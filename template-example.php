<?php
/**
* Template name: Example custom template
*/

use Timber\Timber;

$context = Timber::context();

Timber::render( 'custom-templates/example.twig', $context );
