@php
  if(!isset($frontPage)){
  $frontPage = false;
  }
  if(!isset($article)){
  $article = false;
  }
@endphp
<div class="navbar-largeScrn hidden @if(!$frontPage)large-up-block @endif xlarge-up-block text-right"
     data-responsive='{"fullMenuBreakpointUp": "xxlarge-up-text-center"}'>
  @include("partials.logo")
  <ul class="flush-left margin-left-large text-left">
    <li  data-toggle-container>
      <span class="externalLinks_toggle cursor-pointer" data-toggle-link>
        <i class="icon-menu"></i>
      </span>
      <div class="absolute animate-fade-hidden margin-top-xsmall width-centered padding-medium bg-white margin-left-medium border-all border--gray-dark border--thin shadow radius arrow--medium arrow-top-middle z-low" data-toggle-item data-toggle-setCenter>
        @include('partials.externalLinks')
      </div>
    </li>
  </ul>
  <div
      class="category head-5 hidden large-up-flush-right @if(!$frontPage)medium-up-inline-block @endif"
      data-toggle-container>
    <div class="category-toggle margin-top-xsmall cursor-pointer" data-responsive='{"fullMenuBreakpointUp": "hidden"}' data-toggle-link>
      {{ __('Categories', 'ccblog') }}
      <i class="medium-up-inline-block icon--xsmall icon-chevron-down"></i>
    </div>
    <div
        class="margin-top-small margin-left-xlarge padding-vert-medium absolute text-left animate-fade-hidden bg-white radius shadow arrow arrow-top-middle arrow--medium border-all border--gray-dark border--thin z-low"
        data-responsive='{"fullMenuBreakpointUp": "hidden"}'
        data-toggle-item
        data-toggle-setCenter>
      @php
        $categories = get_categories();
        $currentCatID = (is_category() ? get_category(get_query_var( 'cat' ))->cat_ID : false);
        $itemClass = 'block padding-vert-xsmall padding-horz-xlarge';
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
    <div
        class="hidden relative text-left"
        data-responsive='{"fullMenuBreakpointUp": "xxlarge-up-inline"}'>
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
  </div>
  <div class="flush-right margin-top-xxsmall">
    <div class="pull margin-right-xsmall head-5 margin-top-xxsmall">{{ __('Stay up to date', 'ccblog') }}</div>
    @include('partials.follow')
  </div>
  <div
      class="inline-block text-left flush-right margin-top-xxsmall margin-right-xsmall @if($frontPage)hidden @endif">
    @include('partials.quickArticles-opener')
  </div>
</div>
@include('partials.navbar.contextBar', array('article' => $article))