@php
  if(!isset($frontPage)){
  $frontPage = false;
  }
@endphp
<div class="navbar-largeScrn hidden large-up-block text-right xxlarge-up-text-center">
  @include("partials.logo")
  <ul class="externalLinks flush-left margin-left-large text-left">
    <li data-toggle-link>
      <a href="#" class="externalLinks_toggle">
        <i class="icon-menu"></i>
      </a>
      <ul class="externalLinks_container absolute  head-5 margin-top-xsmall animate-fade-hidden width-centered padding-medium bg-white margin-left-medium border-all border--gray-dark border--thin shadow radius arrow--medium arrow-top-middle z-high"
      data-toggle-item>
        @if(get_field('link_1', 'option'))<li><a href="{{ get_field('link_1', 'option')['url'] }}" target="{{ get_field('link_1', 'option')['target'] }}" class="block text--blue padding-left-xsmall margin-bottom-small">{{ get_field('link_1', 'option')['title'] }}</a></li>@endif
        @if(get_field('link_2', 'option'))<li><a href="{{ get_field('link_2', 'option')['url'] }}" target="{{ get_field('link_2', 'option')['target'] }}" class="block text--charcoal"><i class="icon-course icon--small"></i>{{ get_field('link_2', 'option')['title'] }}</a></li>@endif
        @if(get_field('link_3', 'option'))<li><a href="{{ get_field('link_3', 'option')['url'] }}" target="{{ get_field('link_3', 'option')['target'] }}" class="block text--charcoal"><i class="icon-search icon--small"></i>{{ get_field('link_3', 'option')['title'] }}</a></li>@endif
        @if(get_field('link_4', 'option'))<li><a href="{{ get_field('link_4', 'option')['url'] }}" target="{{ get_field('link_4', 'option')['target'] }}" class="block text--charcoal"><i class="icon-star icon--small"></i>{{ get_field('link_4', 'option')['title'] }}</a></li>@endif
      </ul>
    </li>
  </ul>
  <div
      class="category head-4 hidden relative large-up-flush-right @if(!$frontPage)xlarge-up-inline-block @endif">
    <div class="category-toggle xxlarge-up-hidden">
      {{ __('Categories', 'ccblog') }}
      <i class="medium-up-inline-block icon--xsmall icon-chevron-down"></i>
    </div>
    <div
        class="xxlarge-up-inline absolute xxlarge-up-relative text-left"
        data-responsive='{"mediumOnly": "bg-white radius shadow arrow arrow-top-middle arrow--medium border-all z-high",
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
  <div
      class="inline-block flush-right margin-right-xsmall @if($frontPage)hidden @endif">@include('partials.quickArticles')</div>
</div>