@php
  if(!isset($article)){
    $article = false;
  }
@endphp
<div
    class="contextBar hidden @if($article) xlarge-up-block @endif xxlarge-up-block border-box bg-white z-high animate-fade-hidden border-bottom border--gray-dark border--thin left right top fixed text-center padding-horz-medium padding-top-xsmall padding-bottom-small"
    data-contextBar>
  @include("partials.logo", array('isContext' => 'true'))
  @if($article)
    <div class="contextBar_title head-3 text--bold inline-block flush-left margin-left-medium margin-top-xsmall text-left width-3-5">
      {{ get_the_title() }}
    </div>
    @php
      $link = rawurlencode(get_permalink());
      $title = rawurlencode(get_the_title());
      $imageUrl = rawurlencode(get_the_post_thumbnail_url('large'));
      $fbShareLink = "http://www.facebook.com/sharer.php?u=${link}&t=${title}&s=100&p[url]=${link}&p[images][0]=${imageUrl}&p[title]=${title}";
      $twitterShareLink = "https://twitter.com/intent/tweet?url=${link}&text=${title}";
    @endphp
    <ul class="flush-right">
      <li class="inline-block head-4">{{ __('Share this article', 'ccblog') }}</li>
      <li class="article_socialItem inline-block margin-left-xsmall">
        <a href="{{ $fbShareLink }}" target="_blank" class="article_socialLink">
          <i class="icon-facebook icon--small border radius--50 border-all border--gray-dark border--thin"></i>
        </a>
      </li>
      <li class="article_socialItem inline-block margin-left-xsmall">
        <a href="{{ $twitterShareLink }}" target="_blank" class="article_socialLink">
          <i class="icon-twitter icon--small border radius--50 border-all border--gray-dark border--thin"></i>
        </a>
      </li>
    </ul>

  @else
  <div class="category head-5 inline-block">
    @php
      $categories = get_categories();
      $currentCatID = (is_category() ? get_category(get_query_var( 'cat' ))->cat_ID : false);
      $itemClass = 'inline-block padding-vert-xsmall padding-horz-small';
      $linkClass = 'inline-block text--charcoal';
      $activeLinkClass = 'inline-block text--blue border-bottom border--blue';
    @endphp
    @foreach($categories as $category)
      @php
        $linkURL = get_category_link($category->term_id);
      @endphp

      <div class='{{ $itemClass }}'><a
            class='{{ ($category->cat_ID == $currentCatID ? $activeLinkClass : $linkClass) }}'
            href='{{ $linkURL }}'>{{$category->name}}</a></div>
    @endforeach
  </div>
  <div class="flush-right margin-top-xxsmall">
    @include('partials.follow')
  </div>
  @endif
</div>
@include('partials.navbar.navbar-mobile', array('contextBar' => 'true', 'article' => $article))