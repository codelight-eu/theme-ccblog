@php
  add_filter( 'nav_menu_link_attributes', 'alter_link_class', 10, 3 );
  function alter_link_class( $atts, $item, $args ) {
      $class = 'text--blue'; // or something based on $item
      $atts['class'] = $class;
      return $atts;
  }

  add_filter('nav_menu_css_class','alter_item_classes',1,3);

  function alter_item_classes($classes, $item, $args) {
    $classes[] = 'margin-bottom-xsmall';
    return $classes;
  }

  function get_menu_by_location( $location ) {
      if( empty($location) ) return false;

      $locations = get_nav_menu_locations();
      if( ! isset( $locations[$location] ) ) return false;

      $menu_obj = get_term( $locations[$location], 'nav_menu' );

      return $menu_obj;
  }
@endphp

<footer
    class="footer padding-horz-medium max-width-xl row width-centered padding-top-xxlarge text--charcoal margin-bottom-xlarge hidden large-up-block">
  <div class="col width-1-2">
    <div class="col width-1-3">
      @if (has_nav_menu('footer1'))
        @php $menu_obj = get_menu_by_location('footer1'); @endphp
        {!! wp_nav_menu([
        'theme_location' => 'footer1',
        'items_wrap'=> '<div class="head-3 margin-bottom-medium">'.$menu_obj->name.'</div><ul>%3$s</ul>'
        ]) !!}
      @endif
    </div>
    <div class="col width-1-3">
      @if (has_nav_menu('footer2'))
        @php $menu_obj = get_menu_by_location('footer2'); @endphp
        {!! wp_nav_menu([
        'theme_location' => 'footer2',
        'items_wrap'=> '<div class="head-3 margin-bottom-medium">'.$menu_obj->name.'</div><ul>%3$s</ul>'
        ]) !!}
      @endif
    </div>
    <div class="col width-1-3">
      @if (has_nav_menu('footer3'))
        @php $menu_obj = get_menu_by_location('footer3'); @endphp
        {!! wp_nav_menu([
        'theme_location' => 'footer3',
        'items_wrap'=> '<div class="head-3 margin-bottom-medium">'.$menu_obj->name.'</div><ul>%3$s</ul>'
        ]) !!}
      @endif
    </div>
  </div>
  <div class="col width-1-2">
    <div class="border-center margin-bottom-medium  margin-bottom-medium">
      <div class="head-3 padding-right-medium bg-white inline-block">About <span class="text--bold">MOOC</span><span
            class="text--thin">REPORT</span></div>
    </div>
    <div class="footer_text">
      Insert dynamic text here!
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus deserunt earum facilis, fuga modi nesciunt
        optio placeat reiciendis repellendus sed voluptas voluptatum! Asperiores minus perspiciatis quisquam? Dicta
        similique veniam voluptatibus!</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus deserunt earum facilis, fuga modi nesciunt
        optio placeat reiciendis repellendus sed voluptas voluptatum! Asperiores minus perspiciatis quisquam? Dicta
        similique veniam voluptatibus!</p>
    </div>
  </div>
</footer>
