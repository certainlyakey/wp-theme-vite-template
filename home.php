<?php
/**
* Blog posts page
*/

use Timber\Timber;

$context = Timber::context();

// 'posts' and 'post' context variables will be automatically defined on this page by Timber

Timber::render( 'blog.twig', $context );
