@php
if(!isset($frontPage)){
$frontPage = false;
}
@endphp
<div class="navbar-largeScrn hidden large-up-block text-right xxlarge-up-text-center">
  @include("partials.logo")
  <div class="externalLinks flush-left margin-left-large relative">
    <a href="#" class="externalLinks_toggle">
      <i class="icon-menu"></i>
    </a>
    <div
        class="externalLinks_container absolute top left right hidden width-centered padding-medium bg-white margin-top-xlarge">
      <a href="#" class="block padding-left-xsmall">class-central.com</a>
      <a href="#" class="block text--blue"><i class="icon-course icon--small"></i>Browse Courses</a>
      <a href="#" class="block text--charcoal"><i class="icon-search icon--small"></i>Search</a>
      <a href="#" class="block text--charcoal"><i class="icon-star icon--small"></i>Write a Review</a>
    </div>
  </div>
  <div
      class="category head-4 hidden relative large-up-flush-right @if(!$frontPage)xlarge-up-inline-block @endif">
    <div class="category-toggle xxlarge-up-hidden">
      {{ __('Categories', 'ccblog') }}
      <i class="medium-up-inline-block icon--xsmall icon-chevron-down"></i>
    </div>
    <div
      class="xxlarge-up-inline absolute xxlarge-up-relative text-left"
      data-responsive='{
        "mediumOnly": "bg-white radius shadow arrow arrow-top-middle arrow--medium border-all z-high",
        "largeOnly": "bg-white radius shadow arrow arrow-top-middle arrow--medium border-all z-high",
        "xlargeOnly": "bg-white radius shadow arrow arrow-top-middle arrow--medium border-all z-high"}'>
    @php
      $categories = get_categories();
      $currentCatID = (is_category() ? get_category(get_query_var( 'cat' ))->cat_ID : false);
      $itemClass = 'block xxlarge-up-inline-block padding-vert-xsmall padding-horz-small';
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
  <div class="flush-right">
    @include('partials.follow')
  </div>
  <div class="inline-block flush-right margin-right-xsmall @if($frontPage)hidden @endif">@include('partials.quickArticles')</div>
</div>