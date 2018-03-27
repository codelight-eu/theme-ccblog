<header
    class="header row padding-top-small padding-bottom-xxsmall padding-horz-medium border-bottom"
    data-responsive='{"mediumUp": "padding-top-medium padding-bottom-small"}'
>
  @include("partials.logo")

  <a href="#" class="categoryToggle hidden medium-up-inline-block xlarge-hidden padding-vert-xxsmall padding-left-large">
    <span class="inline-block text--charcoal text-1">
      {{ __('Categories', 'ccblog') }} <i class="hidden medium-up-inline-block icon--xsmall icon-chevron-down"></i>
    </span>
  </a>
  <a href="#" class="moocwatchToggle hidden medium-up-inline-block xlarge-hidden padding-vert-xxsmall padding-left-xsmall">
    <span class="inline-block text--charcoal text-1">
      <i class="symbol-moocwatch-charcoal symbol--small"></i> <i class="hidden medium-up-inline-block icon--xsmall icon-chevron-down"></i>
    </span>
  </a>
  <a href="#" class="menuToggle flush-right medium-up-hidden">
    <i class="icon-menu"></i>
  </a>
  <a href="#" class="socialToggle flush-right hidden medium-up-inline-block">
    <i class="icon-share icon--small"></i>
  </a>
  <div
      class="category absolute xlarge-up-text-center width-100 padding-vert-xxsmall"
      data-responsive='{"xsmallOnly": "border-bottom"}'
  >
    @php
      $categories = get_categories();
      $currentCatID = (is_category() ? get_category(get_query_var( 'cat' ))->cat_ID : false);
      $itemClass = 'block padding-top-small padding-right-small padding-bottom-small';
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

  <div class="MoocWatch absolute width-100 padding-vert-large border-bottom">
    <div class="test">testcotnent</div>
    <div class="test">testcotnent</div>
    <div class="test">testcotnent</div>
  </div>

  <div class="menuSocial"></div>
</header>