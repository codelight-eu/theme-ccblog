@php
  $args = array (
  'status' => 'approve',
  'number' => '2'
  );
  $comments = get_comments( $args );
@endphp
<section id="comments" class="comments margin-bottom-xxlarge padding-horz-xsmall">
  <div class="comments_titleCont border-center border--thin border--gray-dark margin-bottom-medium">
    <div class="head-4 bg-white inline-block padding-right-medium"><strong class="text--bold">{{ __('Join the conversation', 'ccblog') }}</strong></div>
  </div>
  @if( !empty( $comments ) )
    <ul>
      @foreach($comments as $comment)
        @php
          $permalink = get_permalink( $comment->comment_post_ID );
          $id = $comment->comment_ID;
          $commentLink = "${permalink}#comment-${id}";
          $commentTitle = wp_trim_words( get_the_title( $comment->comment_post_ID ), $num_words = 20, '' );
          $commentContent = wp_trim_words( $comment->comment_content, $num_words = 28 );
          $commentDate = date('U', strtotime($comment->comment_date));
        @endphp
        <li class="margin-bottom-xlarge">
          <div class="comment_head row margin-bottom-medium">
            <div class="comment_icon flush-left margin-right-medium margin-top-xsmall"><i class="icon-comment size--large bgSize--xxlarge"></i></div>
            <div class="comment_title">
              <div class="margin-bottom-xsmall head-6"><strong class="text--bold">{{ __('Comment from', 'ccblog') }}</strong></div>
              <h2 class="overflow-hidden">
                <a href="{{ $commentLink }}" class="text--charcoal head-3 text--bold">{{ $commentTitle }}</a>
              </h2>
            </div>
          </div>
          <div class="comment_body">
            <span class="margin-right-xsmall">"{!! $commentContent !!}"</span>
            <a href="{{ $commentLink }}" class="comment_link inline-block text--blue-bright head-6"><strong class="text--bold">{{ __('Show more...', 'ccblog') }}</strong></a>
          </div>
          <div class="comment_footer head-6 margin-top-xsmall">
            <div class="comment_author text--bold inline-block margin-right-xsmall">{{ $comment->comment_author }}</div>
            <div class="comment_time inline-block">{{ human_time_diff( $commentDate, current_time('timestamp') ) }} ago</div>
          </div>
        </li>
      @endforeach
    </ul>
  @endif
</section>