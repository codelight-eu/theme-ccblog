@php
  if(!isset($article)){
    $article = false;
  }
@endphp
<div
    class="contextBar hidden @if($article) xlarge-up-block @endif xxlarge-up-block border-box bg-white z-high animate-fade-hidden border-bottom border--gray-dark border--thin left right top fixed text-center padding-horz-medium padding-top-xsmall padding-bottom-xsmall"
    data-contextBar>
  @include("partials.logo", array('isContext' => 'true'))
  @if($article)
    <div class="contextBar_title head-3 text--bold inline-block flush-left margin-left-medium margin-top-xsmall text-left width-3-5">
      {{ get_the_title() }}
    </div>
  <div class="flush-right">
    <div class="inline-block head-4 margin-right-xsmall">{{ __('Share this article', 'ccblog') }}</div>
    @include('partials.social-article')
  </div>
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
    <div class="pull margin-right-xsmall head-5 margin-top-xxsmall">{{ __('Stay up to date', 'ccblog') }}</div>
    @include('partials.follow')
  </div>
  @endif
</div>
@include('partials.navbar.navbar-mobile', array('contextBar' => 'true', 'article' => $article))