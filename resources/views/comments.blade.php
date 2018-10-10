@php
  use App\Roots_Walker_Comment;
@endphp

@if(have_comments())
  <section id="comments">
    <div class="comments_header margin-bottom-large">
      <h3 class="head-1 text--bold">
        @php printf(_n('One comment for', '%1$s comments for', get_comments_number(), 'roots'), number_format_i18n(get_comments_number())); @endphp
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
            <li class="previous">@php previous_comments_link(__('&larr; Older comments', 'roots')); @endphp</li>
          @endif
          @if (get_next_comments_link())
            <li class="next">@php next_comments_link(__('Newer comments &rarr;', 'roots')); @endphp</li>
          @endif
        </ul>
      </nav>
    @endif

    @if(!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments'))
      <div class="alert alert-warning">
        @php _e('Comments are closed.', 'roots'); @endphp
      </div>
    @endif
  </section><!-- /#comments -->
@endif

@if(!have_comments() && !comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments'))
  <section id="comments">
    <div class="alert alert-warning">
      @php _e('Comments are closed.', 'roots'); @endphp
    </div>
  </section><!-- /#comments -->
@endif

@if(comments_open())
  <section id="respond">
    <h3>@php comment_form_title(__('Leave a Reply', 'roots'), __('Leave a Reply to %s', 'roots')); @endphp</h3>
    <p class="cancel-comment-reply">@php cancel_comment_reply_link(); @endphp</p>
    @if (get_option('comment_registration') && !is_user_logged_in())
      <p>@php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'roots'), wp_login_url(get_permalink())); @endphp</p>
    @else
      <form action="{!! get_option('siteurl') !!}/wp-comments-post.php" method="post" id="commentform">
        @if (is_user_logged_in())
          <p>
            @php printf(__('Logged in as <a href="%s/wp-admin/profile.php">%s</a>.', 'roots'), get_option('siteurl'), $user_identity); @endphp
            <a href="{{ wp_logout_url(get_permalink()) }}"
               title="{{ _e('Log out of this account', 'roots') }}">{{ _e('Log out &raquo;', 'roots') }}</a>
          </p>
        @else
          <div class="form-group">
            <label for="author">{{ _e('Name', 'roots') }} @if($req){{ _e('(required)', 'roots') }}@endif</label>
            <input type="text" class="form-control" name="author" id="author" value="{{ esc_attr($comment_author) }}"
                   size="22" @if($req) aria-required="true" @endif>
          </div>
          <div class="form-group">
            <label
                for="email">{{ _e('Email (will not be published)', 'roots') }} @if($req){{ _e('(required)', 'roots') }}@endif</label>
            <input type="email" class="form-control" name="email" id="email"
                   value="{{ esc_attr($comment_author_email) }}"
                   size="22" @if($req) aria-required="true" @endif>
          </div>
          <div class="form-group">
            <label for="url">{{ _e('Website', 'roots') }}</label>
            <input type="url" class="form-control" name="url" id="url" value="{{ esc_attr($comment_author_url) }}"
                   size="22">
          </div>
        @endif
        <div class="form-group">
          <label for="comment">{{ _e('Comment', 'roots') }}</label>
          <textarea name="comment" id="comment" class="form-control" rows="5" aria-required="true"></textarea>
        </div>
        <p><input name="submit" class="btn btn-primary" type="submit" id="submit"
                  value="{{ _e('Submit Comment', 'roots') }}"></p>
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