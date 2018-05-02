<div class="navbar-mobile large-up-hidden">
  @include("partials.logo")
    <a href="#" class="menuToggle flush-right xlarge-up-hidden">
    <i class="icon-menu-charcoal icon--medium"></i>
  </a>
  <div
      class="menu hidden border-top margin-top-xxlarge absolute left right padding-horz-xlarge padding-vert-large z-high bg-white row xlarge-up-hidden">
    <div class="menu_left col width-100 small-up-width-1-3">
      <div class="block padding-top-small padding-right-small padding-bottom-small">
        <span class="inline-block text-1 text--bold">{{ __('Categories', 'ccblog') }}</span>
      </div>
      <div
          class="category width-1-2 small-up-width-100 padding-vert-xxsmall"
          data-responsive='{"xsmallOnly": "border-bottom"}'
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
          "smallUp": "border-left"
    }'>
      <a href="#" class="moocwatchToggle hidden xlarge-up-inline-block padding-vert-xxsmall padding-left-xsmall">
        <span class="inline-block text--charcoal text-1"><i class="symbol-moocwatch-charcoal symbol--small"></i> <i
              class="hidden medium-up-inline-block icon--xsmall icon-chevron-down"></i></span>
      </a>
      <div class="MoocWatch width-1-2 small-up-width-100 padding-vert-large border-bottom">
        <div class="xlarge-up-hidden padding-vert-xxsmall">
          <span class="inline-block text-1"><i class="symbol-moocwatch-charcoal symbol--small"></i></span>
        </div>
        <div class="test">testcotnent</div>
        <div class="test">testcotnent</div>
        <div class="test">testcotnent</div>
      </div>
      <div class="need3Linki-mobiilimenüüs padding-vert-large">
        <div class="test">testcotnent</div>
        <div class="test">testcotnent</div>
        <div class="test">testcotnent</div>
      </div>
    </div>
  </div>
</div>