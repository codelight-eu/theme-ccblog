<?php

/**
 * Use Bootstrap's media object for listing comments
 *
 * @link http://getbootstrap.com/components/#media
 */
namespace App;

class Roots_Walker_Comment extends \Walker_Comment {
  function start_lvl(&$output, $depth = 0, $args = array()) {
    $GLOBALS['comment_depth'] = $depth + 1; ?>
    <ul <?php comment_class('media list-unstyled comment-' . get_comment_ID()); ?>>
    <?php
  }

  function end_lvl(&$output, $depth = 0, $args = array()) {
    $GLOBALS['comment_depth'] = $depth + 1;
    echo '</ul>';
  }

   function start_el(&$output, $comment, $depth = 0, $args = array(), $id = 0) {
    $depth++;
    $GLOBALS['comment_depth'] = $depth;
    $GLOBALS['comment'] = $comment;

    $additional_classes = '';

    if($GLOBALS['comment_depth'] > 2) {
      $additional_classes = 'margin-left-small padding-left-xlarge border-left border--thin border--gray-dark ';
    } else if($GLOBALS['comment_depth'] > 1) {
      $additional_classes = 'margin-left-medium padding-left-large border-left border--thin border--gray-dark ';
    }

    if (!empty($args['callback'])) {
      call_user_func($args['callback'], $comment, $args, $depth);
      return;
    }

    extract($args, EXTR_SKIP); ?>

  <li id="comment-<?php comment_ID(); ?>" <?php comment_class($additional_classes . 'comment-' . get_comment_ID()); ?>>
    <?php include(locate_template('views/partials/comment.blade.php')); ?>
  <?php
  }

  function end_el(&$output, $comment, $depth = 0, $args = array()) {
    if (!empty($args['end-callback'])) {
      call_user_func($args['end-callback'], $comment, $args, $depth);
      return;
    }
    // Close ".media-body" <div> located in templates/comment.php, and then the comment's <li>
    echo "</li>\n";
  }
}
/*
function roots_get_avatar($avatar, $type) {
  if (!is_object($type)) { return $avatar; }

  $avatar = str_replace("class='avatar", "class='avatar pull-left media-object", $avatar);
  return $avatar;
}
add_filter('get_avatar', 'roots_get_avatar', 10, 2);*/
