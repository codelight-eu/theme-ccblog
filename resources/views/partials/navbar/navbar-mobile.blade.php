@php
  if(!isset($frontPage)){
  $frontPage = false;
  }
@endphp
<div class="navbar-mobile xlarge-up-hidden @if($frontPage)large-up-hidden @endif" data-toggle-link>
  @include("partials.logo")
    <span class="menuToggle flush-right xlarge-up-hidden cursor-pointer">
    <i class="icon-menu-charcoal icon--medium"></i>
  </span>
  <div
      class="menu animate-fade-hidden border-top margin-top-xxlarge absolute left right padding-horz-xlarge padding-vert-large z-high bg-white row xlarge-up-hidden border-all"
      data-toggle-item>
    <div class="menu_left col width-100 small-up-width-1-3">
      <div class="block padding-right-small padding-bottom-small">
        <span class="inline-block text-1 text--bold">{{ __('Categories', 'ccblog') }}</span>
      </div>
      <div
          class="category width-1-2 small-up-width-100 padding-bottom-xsmall"
          data-responsive='{"xsmallOnly": "border-bottom  border--gray-dark border--thin"}'
      >
        @php
          $categories = get_categories();
          $currentCatID = (is_category() ? get_category(get_query_var( 'cat' ))->cat_ID : false);
          $itemClass = 'block padding-vert-small padding-right-small';
          $linkClass = 'inline-block text--charcoal text-1';
          $activeLinkClass = 'inline-block text--blue border-bottom border--blue text-1';
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
    <div
        class="menu_right col width-100 small-up-width-2-3 small-up-padding-left-large"
        data-responsive='{
          "smallUp": "border-left border--gray-dark border--thin"
        }'>
      <div class="width-2-3 small-up-width-100 padding-bottom-large"
           data-responsive='{"xsmallOnly": "padding-top-large"}'>
        <div class="xlarge-up-hidden">
          <span class="inline-block head-6"><i class="symbol-moocwatch-charcoal symbol--small"></i></span>
        </div>
        @include('partials.quickArticles')
      </div>
      <div class="padding-vert-large border-top border--gray-dark border--thin width-1-2 small-up-width-2-3">
        @include('partials.externalLinks')
      </div>
    </div>
  </div>
</div>