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
    <div class="border-center border--thin border--gray-dark margin-bottom-medium margin-bottom-medium head-3">
      <div class="padding-right-medium bg-white inline-block">
        {!! the_field('footer_title', 'option') !!}
      </div>
    </div>
    <div class="footer_text">
      {!! the_field('footer_content', 'option') !!}
    </div>
  </div>
</footer>
