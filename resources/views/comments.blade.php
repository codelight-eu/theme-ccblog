@php
  use App\Roots_Walker_Comment;
@endphp

@if(have_comments())
  <section id="comments" class="padding-bottom-medium border-bottom border--gray-dark border--thin">
    <div class="comments_header margin-bottom-large">
      <h3 class="head-1 text--bold margin-bottom-xxsmall">
        @php printf(_n('One comment for', '%1$s comments for', get_comments_number(), 'ccblog'), number_format_i18n(get_comments_number())); @endphp
      </h3>
      <p class="head-3">{{ get_the_title() }}</p>
    </div>
    <ol class="comments_list">
      @php wp_list_comments(array('walker' => new Roots_Walker_Comment)); @endphp
    </ol>

    @if(get_comment_pages_count() > 1 && get_option('page_comments'))
      <nav>
        <ul class="pager">
          @if (get_previous_comments_link())
            <li class="previous">@php previous_comments_link(__('&larr; Older comments', 'ccblog')); @endphp</li>
          @endif
          @if (get_next_comments_link())
            <li class="next">@php next_comments_link(__('Newer comments &rarr;', 'ccblog')); @endphp</li>
          @endif
        </ul>
      </nav>
    @endif

    @if(!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments'))
      <div class="alert alert-warning">
        @php _e('Comments are closed.', 'ccblog'); @endphp
      </div>
    @endif
  </section><!-- /#comments -->
@endif

@if(!have_comments() && !comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments'))
  <section id="comments">
    <div class="alert alert-warning">
      @php _e('Comments are closed.', 'ccblog'); @endphp
    </div>
  </section><!-- /#comments -->
@endif

@if(comments_open())
  <section id="respond" class="margin-bottom-xxlarge padding-top-xlarge">
    <h3 class="margin-bottom-small head-1 text--bold">@php comment_form_title(__('Leave a reply', 'ccblog'), __('Leave a reply', 'ccblog')); @endphp</h3>
    @if (get_option('comment_registration') && !is_user_logged_in())
      <p>@php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'ccblog'), wp_login_url(get_permalink())); @endphp</p>
    @else
      <form action="{!! get_option('siteurl') !!}/wp-comments-post.php" method="post" id="commentform" class="width-100 medium-up-width-3-4">
        @if (is_user_logged_in())

          <div class="padding-xxsmall bg-gray radius margin-bottom-large">
            <i class="icon-alert-blue icon--small"></i>
            @php printf(__('Logged in as <a href="%s/wp-admin/profile.php">%s</a>.', 'ccblog'), get_option('siteurl'), $user_identity); @endphp
            <a href="{{ wp_logout_url(get_permalink()) }}"
               title="{{ _e('Log out of this account', 'ccblog') }}"
               class="margin-left-small">{{ _e('Log out &raquo;', 'ccblog') }}</a>
          </div>
          <div class="form-group margin-top-large">
            <label for="comment" class="text-1 margin-bottom-small block">{{ _e('Comment', 'ccblog') }}</label>
            <textarea name="comment" id="comment" class="form-control border-box padding-small border--gray-dark border--thin border-all radius width-100" rows="14" aria-required="true"></textarea>
          </div>
        @else
          <div class="padding-xxsmall bg-gray radius margin-bottom-large">
            <i class="icon-alert-blue icon--small"></i>
            {{ _e('Your email address will not be published.', 'ccblog') }}
          </div>
          <div class="form-group margin-top-large">
            <label for="comment" class="text-1 margin-bottom-small block">{{ _e('Comment', 'ccblog') }}</label>
            <textarea name="comment" id="comment" class="form-control border-box padding-small border--gray-dark border--thin border-all radius width-100" rows="14" aria-required="true"></textarea>
          </div>
          <div class="form-group margin-top-large">
            <label for="author" class="text-1 margin-bottom-small block">{{ _e('Name', 'ccblog') }} @if($req)<span class="text--italic">{{ _e('(Required)', 'ccblog') }}</span>@endif</label>
            <input type="text" class="form-control border-box padding-small border--gray-dark border--thin border-all radius width-100" name="author" id="author" value="{{ esc_attr($comment_author) }}"
                   size="22" @if($req) aria-required="true" @endif>
          </div>
          <div class="form-group margin-top-large">
            <label
                for="email" class="text-1 margin-bottom-small block">{{ _e('Email', 'ccblog') }} @if($req)<span class="text--italic">{{ _e('(Required)', 'ccblog') }}</span>@endif</label>
            <input type="email" class="form-control border-box padding-small border--gray-dark border--thin border-all radius width-100" name="email" id="email"
                   value="{{ esc_attr($comment_author_email) }}"
                   size="22" @if($req) aria-required="true" @endif>
          </div>
        @endif
        <p class="margin-top-large"><input name="submit" class=" head-3 text--bold btn--borderless btn-blue btn--large" type="submit" id="submit"
                  value="{{ _e('Post Comment', 'ccblog') }}"><span class="cancel-comment-reply margin-left-xlarge text-2">{!! get_cancel_comment_reply_link('Cancel') !!}</span></p>
        @php comment_id_fields(); @endphp
        @php do_action('comment_form', $post->ID); @endphp
      </form>
    @endif
  </section><!-- /#respond -->
@endif
{{--
@if (comments_open())
<div id="disqus_thread"></div>
<script>
  /**
   *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
   *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
   */
/*
  var disqus_config = function () {
      this.page.url = {{ get_permalink() }};  // Replace PAGE_URL with your page's canonical URL variable
      this.page.identifier = ***; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
  };*/

  (function() {  // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');

    s.src = '//ccblog-local.disqus.com/embed.js';

    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
  })();
</script>
<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
@endif

--}}