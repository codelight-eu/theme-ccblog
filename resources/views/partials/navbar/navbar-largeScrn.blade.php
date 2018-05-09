@php
  if(!isset($frontPage)){
  $frontPage = false;
  }
@endphp
<div class="navbar-largeScrn hidden @if(!$frontPage)large-up-block @endif xlarge-up-block text-right xxlarge-up-text-center">
  @include("partials.logo")
  <ul class="flush-left margin-left-large text-left">
    <li data-toggle-link>
      <span class="externalLinks_toggle cursor-pointer">
        <i class="icon-menu"></i>
      </span>
      <div class="absolute animate-fade-hidden margin-top-xsmall width-centered padding-medium bg-white margin-left-medium border-all border--gray-dark border--thin shadow radius arrow--medium arrow-top-middle z-high" data-toggle-item data-toggle-setCenter>
        @include('partials.externalLinks')
      </div>
    </li>
  </ul>
  <div
      class="category head-5 hidden large-up-flush-right @if(!$frontPage)medium-up-inline-block @endif"
      data-toggle-link>
    <div class="category-toggle margin-top-xsmall xxlarge-up-hidden cursor-pointer">
      {{ __('Categories', 'ccblog') }}
      <i class="medium-up-inline-block icon--xsmall icon-chevron-down"></i>
    </div>
    <div
        class="xxlarge-up-hidden margin-top-small margin-left-xlarge padding-vert-medium absolute text-left animate-fade-hidden bg-white radius shadow arrow arrow-top-middle arrow--medium border-all border--gray-dark border--thin z-high"
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
        class="xxlarge-up-inline hidden relative text-left">
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
    @include('partials.follow')
  </div>
  <div
      class="inline-block text-left flush-right margin-top-xxsmall margin-right-xsmall @if($frontPage)hidden @endif">
    @include('partials.quickArticles-opener')
  </div>
</div>