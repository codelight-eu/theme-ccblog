<header class="header">
  <a class="brand head-2" href="{{ home_url('/') }}">MOOC Report</a>
  <div class="block text-5 text--gray">by <i class="symbol-classcentral-gray symbol--small"></i></div>
  <nav class="nav-primary">
    @if (has_nav_menu('primary_navigation'))
      {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
    @endif
  </nav>

  <div class="category max-width-xl width-centered text-center border-bottom padding-xxsmall">
    @php
      $categories = get_categories();
      $currentCatID = (is_category() ? get_category(get_query_var( 'cat' ))->cat_ID : false);
      $itemClass = 'inline-block padding-small ';
      $linkClass = 'inline-block text--charcoal text-1';
      $activeLinkClass = 'inline-block text--blue border-bottom border--blue text-1';
    @endphp
    @foreach($categories as $category)
      @php
        $linkURL = get_category_link($category->term_id);
      @endphp

       <div class='{{ $itemClass }}'><a class='{{ ($category->cat_ID == $currentCatID ? $activeLinkClass : $linkClass) }}' href='{{ $linkURL }}'>{{$category->name}}</a></div>
    @endforeach
  </div>
</header>
