<?php

use Timber\Timber;

$context = Timber::context();
$context['posts'] = Timber::get_posts( false );

Timber::render( 'base.twig', $context );
