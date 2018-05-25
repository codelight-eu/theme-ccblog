@php
  $categories = get_the_category();
  $tags = get_the_tags();
  $pageForPosts = get_option( 'page_for_posts' );
@endphp
@include('partials.follow-mobile', array('article' => 'true'))
<header
    class="row padding-top-small padding-bottom-xxsmall padding-horz-medium border--thin border--gray-dark"
    data-responsive='{"largeUp": "border-bottom padding-top-medium padding-bottom-small"}'>
  @include('partials.navbar.navbar-largeScrn', array('article' => 'true'))
  @include('partials.navbar.navbar-mobile')
</header>
<article @php(post_class('article-single border-box width-centered text--charcoal padding-left-large padding-right-large large-up-padding-horz-xxlarge padding-top-medium padding-bottom-xsmall medium-up-padding-bottom-xxlarge'))>
  <header class="text-center margin-bottom-medium">
    <div class="disclosure wysiwyg text-2 text--blue margin-bottom-xlarge medium-up-margin-bottom-large margin-top-xsmall medium-up-margin-top-medium">
      {!! get_post_field('edit_disclosure') ? get_post_field('disclosure_text') : __('<strong class="text--bold">Disclosure:</strong> To support our site, Class Central may be compensated by some course providers.','ccblog') !!}
    </div>
    <div
        class="article_date head-4 text--italic hidden medium-up-block medium-up-margin-bottom-xsmall">{{ get_the_date('F j, Y') }}</div>
    <h1 class="article_title head-1 margin-bottom-small width-centered">{{ get_the_title() }}</h1>
    <div class="inline-block medium-up-text-1 overflow-hidden">
      @include('partials.author', array(
        'author_imageContClass' => 'size--xxsmall medium-up-size--small',
        'author_textClass' => 'head-5 large-up-head-4',
        'byText' => 'Written by'))
    </div>
    <div class="dot margin-bottom-small margin-horz-xsmall medium-up-margin-bottom-medium"></div>
    <div
        class="article_readTime medium-up-head-4 inline-block overflow-hidden medium-up-margin-bottom-xsmall margin-bottom-xxsmall">
      <i class="icon-clock icon--xsmall"></i> {{ cc_get_reading_time() }} {{ __('read', 'ccblog') }}
    </div>
  </header>
  <div class="border-bottom margin-horz-xsmall border--gray-dark border--thin margin-bottom-medium medium-up-hidden"></div>
  <div class="articleContent wysiwyg entry-content text-2 medium-up-text-1 margin-bottom-small large-up-margin-bottom-xxlarge">
    @php(the_content())
  </div>
  <footer>
    <div
        class="labels row border-bottom border--thin border--gray-dark padding-bottom-medium margin-bottom-medium medium-up-padding-bottom-large medium-up-margin-bottom-large">
      <div class="margin-bottom-medium col large-up-width-1-2">
        <div class="flush-left margin-right-small text-2 margin-top-xxsmall">
          {{ __('Category', 'ccblog') }}
        </div>
        <div class="overflow-hidden">
          @if($categories)
          @foreach($categories as $category)
            <div class="margin-right-xsmall margin-bottom-xsmall inline-block">
              <a class="btn-navy btn--small" href="{{ get_category_link($category->term_id) }}">{{ $category->name }}</a>
            </div>
          @endforeach
          @endif
        </div>
      </div>
      <div class="col large-up-width-1-2">
        <div class="flush-left margin-right-small text-2 margin-top-xxsmall">
          {{ __('Tags', 'ccblog') }}
        </div>
        <div class="overflow-hidden">
          @if($tags)
          @foreach($tags as $tag)
            <div class="margin-right-xsmall margin-bottom-xsmall inline-block">
              <a class="btn-gray btn--small" href="{{ get_tag_link($tag->term_id) }}">{{ $tag->name }}</a>
            </div>
          @endforeach
          @endif
        </div>
      </div>
    </div>
    <div class="outro row">
      <div class="outro_image flush-left radius--50 overflow-hidden margin-right-medium">
        <img src="{{ get_avatar_url(get_the_author_meta('ID'), ['size' => 126]) }}"
             class="author_image width-100 block size--medium">
      </div>
      <div class="outro_content overflow-hidden">
        <div class="col width-100 large-up-width-2-3">
          <h3 class="head-3 margin-bottom-xsmall">
            <a
                href="{{ get_author_posts_url(get_the_author_meta('ID')) }}"
                class="text--charcoal text--bold">
              {{ get_the_author() }}
            </a>
          </h3>
          <div class="outro_text text-2 margin-bottom-xsmall">
            {{ the_author_meta('description') }}
          </div>
        </div>
        <div class="col width-100 large-up-width-1-3 large-up-margin-top-large text-right">
          <a href="{{ get_author_posts_url(get_the_author_meta('ID')) }}"
             class="outro_link text--blue text-2">
            {{ __('More articles from', 'ccblog') }} {{ get_the_author() }}
          </a>
        </div>
      </div>
    </div>
  </footer>
</article>
<div class="bg-gray padding-top-large padding-bottom-xxlarge large-up-padding-bottom-large border-top border--gray-dark border--thin border-bottom">
  <div class="max-width-l border-box width-centered padding-horz-medium">
    @php(related_posts(['template' => 'yarpp-template-ccblog.php']))
  </div>
</div>
<div class="comments max-width-l border-box width-centered padding-horz-medium large-up-padding-horz-xxlarge margin-bottom-xxlarge">
  <div class="comments_icon text-center margin-top-medium margin-bottom-xsmall">
    <i class="icon-comment icon--xlarge"></i>
  </div>
  @include('partials/comments')
</div>
@if(get_field('set_footer_CTA', $pageForPosts) && get_field('set_footer_CTA', $pageForPosts) != 'none')
  @php
    $msgType = 'partials.featuredMsg-' . get_field('set_footer_CTA', $pageForPosts);
  @endphp
  @include($msgType)
@endif