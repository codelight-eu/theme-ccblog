<div id="comment-<?php comment_ID(); ?>" class="border--gray-dark border--thin border-all padding-medium radius margin-bottom-large ">
  <div class="comment_header overflow-hidden margin-bottom-xsmall">
    <div class="comment_avatar flush-left margin-right-xsmall radius--50 overflow-hidden size--xxsmall">
      <?php echo get_avatar($comment, $size = '35', '', '', ['class' => 'width-100 block']); ?>
    </div>

    <h4 class="comment_title"><span
          class=" text--bold"><?php echo get_comment_author(); ?></span> <?php echo __('says', 'ccblog'); ?></h4>
    <time class="comment_time text--italic text-3" datetime="<?php echo comment_date('c'); ?>">
      <?php /*<a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>"> */ ?>
      <?php printf(__('%1$s at %2$s', 'roots'), get_comment_date('n/j/Y'), get_comment_time('g:ia')); ?>
      <?php /*</a> */ ?>
    </time>
    <?php edit_comment_link(__('(Edit)', 'roots'), '', ''); ?>

    <?php if ($comment->comment_approved == '0') : ?>
    <div class="alert alert-info padding-xxsmall bg-gray radius margin-vert-small">
      <i class="icon-alert-blue icon--small"></i>
      <?= _e('Your comment is awaiting moderation.', 'roots'); ?>
    </div>
    <?php endif; ?>
  </div>
  <div class="comment_body margin-bottom-small">
    <?php comment_text(); ?>
  </div>
  <?php $myclass = 'btn-white';
  echo preg_replace( '/comment-reply-link/', 'comment-reply-link ' . $myclass, get_comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))), 1); ?>
</div>