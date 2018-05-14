<?php
/*
YARPP Template: ccblog related posts
*/
?>
<h4 class="head-4 padding-horz-xsmall margin-bottom-small"><strong class="text--bold"><?php echo __('Related articles', 'ccblog') ?></strong></h4>
<div class="relatedPost flex-column large-up-flex-row">
  <?php if (have_posts()):
    while (have_posts()) : the_post();
      echo \App\template('partials.relatedPost');
    endwhile;
  else:?>
    <p class="head-5 padding-horz-xsmall">No related posts.</p>
  <?php endif; ?>
</div>
