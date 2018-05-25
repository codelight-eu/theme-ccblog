<footer
    class="footer padding-horz-medium max-width-xl row width-centered padding-top-xxlarge text--charcoal margin-bottom-xlarge large-up-block">
  <div class="col width-100 large-up-width-1-2 text-center large-up-text-left xsmall-only-padding-bottom-xxlarge small-only-padding-bottom-xxlarge medium-only-padding-bottom-xxlarge">
    <div class="col width-100 small-up-width-1-3 margin-bottom-large">
      @if (has_nav_menu('footer1'))
        @php $menu_obj = get_menu_by_location('footer1'); @endphp
        {!! wp_nav_menu([
        'theme_location' => 'footer1',
        'items_wrap'=> '<div class="head-3 margin-bottom-medium">'.$menu_obj->name.'</div><ul>%3$s</ul>'
        ]) !!}
      @endif
    </div>
    <div class="col width-100 small-up-width-1-3 margin-bottom-large">
      @if (has_nav_menu('footer2'))
        @php $menu_obj = get_menu_by_location('footer2'); @endphp
        {!! wp_nav_menu([
        'theme_location' => 'footer2',
        'items_wrap'=> '<div class="head-3 margin-bottom-medium">'.$menu_obj->name.'</div><ul>%3$s</ul>'
        ]) !!}
      @endif
    </div>
    <div class="col width-100 small-up-width-1-3 margin-bottom-large">
      @if (has_nav_menu('footer3'))
        @php $menu_obj = get_menu_by_location('footer3'); @endphp
        {!! wp_nav_menu([
        'theme_location' => 'footer3',
        'items_wrap'=> '<div class="head-3 margin-bottom-medium">'.$menu_obj->name.'</div><ul>%3$s</ul>'
        ]) !!}
      @endif
    </div>
  </div>
  <div class="col width-100 large-up-width-1-2 text-center large-up-text-left">
    <div class="border-center border--thin border--gray-dark margin-bottom-medium margin-bottom-medium head-3">
      <div class="xsmall-only-padding-left-medium small-only-padding-left-medium medium-only-padding-left-medium padding-right-medium bg-white inline-block">
        {{ __('About', 'ccblog') }} <i class="symbol-moocreport-charcoal symbol--small"></i>
      </div>
    </div>
    <div class="footer_text wysiwyg--text-2">
      {!! get_field('footer_content', 'option') !!}
    </div>
  </div>
</footer>
