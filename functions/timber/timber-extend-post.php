<?php
/**
* Redefine or setup variables that should be available via $context['post'] in all the templates.
* If you want to do something with global post.thumbnail property before it reaches templates — here's is the place
*/
use Timber\Post;

class CommonPost extends Post {

  // when rewriting default functions we need to readd their original functionality as well
  // public function thumbnail() {
  //   return $thumbnail_id ? new TimberImage( $thumbnail_id ) : null;
  // }
  public function slug() {
    return $this->post_name;
  }
}

add_filter(
  'timber/post/classmap',
  function ( $classmap ) {
    $custom_classmap = [
      'post' => CommonPost::class,
      'page' => CommonPost::class,
    ];

    return array_merge( $classmap, $custom_classmap );
  }
);
