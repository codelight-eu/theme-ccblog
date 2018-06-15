@php
  if(!isset($frontPage)){
  $frontPage = false;
  }
  if(!isset($article)){
  $article = false;
  }
@endphp
<div class="navbar-largeScrn hidden @if(!$frontPage)large-up-block @endif xlarge-up-block text-right"
     data-responsive='{"fullMenuBreakpointUp": "xxlarge-up-text-center"}'>
  @if(!$frontPage)
    @include("partials.logo")
  @endif
  <ul class="flush-left @if(!$frontPage)margin-left-large @endif text-left">
    <li data-toggle-container>
      <span class="externalLinks_toggle cursor-pointer" data-toggle-link>
        <i class="icon-menu-charcoal"></i>
      </span>
      <div
          class="absolute animate-fade-hidden margin-top-xsmall width-centered padding-medium bg-white @if(!$frontPage)margin-left-medium arrow-top-middle @else arrow-top-left @endif border-all border--gray-dark border--thin shadow radius arrow--medium z-low"
          data-toggle-item @if(!$frontPage) data-toggle-setCenter @endif>
        @include('partials.externalLinks')
      </div>
    </li>
  </ul>
  <div
      class="category head-5 hidden @if(!$frontPage)medium-up-inline-block @endif">
    <div class="js-toggle-noSubMenuHover inline-block hidden large-up-flush-right @if(!$frontPage)medium-up-inline-block @endif"
         data-toggle-container>
      <div class="category-toggle margin-top-xsmall cursor-pointer" data-responsive='{"fullMenuBreakpointUp": "hidden"}'
           data-toggle-link>
        {{ __('Categories', 'ccblog') }}
        <i class="medium-up-inline-block icon--xsmall icon-chevron-down"></i>
      </div>
      <div
          class="margin-top-small margin-left-xlarge padding-vert-medium absolute text-left animate-fade-hidden bg-white radius shadow arrow arrow-top-middle arrow--medium border-all border--gray-dark border--thin z-low"
          data-responsive='{"fullMenuBreakpointUp": "hidden"}'
          data-toggle-item
          data-toggle-setCenter>
        @if (has_nav_menu('standardNav'))
          @php $menu_obj = get_menu_by_location('standardNav'); @endphp
          {!! wp_nav_menu([
          'theme_location' => 'standardNavCollapsed',
          'link_after' => '<i class="menu_more-icon icon--xsmall icon-chevron-right"></i>',
          ]) !!}
        @endif
      </div>
    </div>
    <div class="inline-block"
         data-toggle-container>
      <div
          class="hidden relative text-left"
          data-responsive='{"fullMenuBreakpointUp": "xxlarge-up-inline"}'>
        @if (has_nav_menu('standardNav'))
          @php $menu_obj = get_menu_by_location('standardNav'); @endphp
          {!! wp_nav_menu([
          'theme_location' => 'standardNav',
          'container_class' => 'inline-block',
          'link_after' => '<i class="menu_more-icon icon--xsmall icon-chevron-down"></i>',
          ]) !!}
        @endif
      </div>
      <div
          class="inline-block text-left margin-top-xxsmall margin-right-medium @if($frontPage)hidden @endif">
        @include('partials.quickArticles-opener')
      </div>
    </div>
  </div>
  <div class="flush-right margin-top-xxsmall">
    <div class="pull margin-right-xsmall head-5 margin-top-xxsmall">{{ __('Stay up to date', 'ccblog') }}</div>
    @include('partials.follow')
  </div>
</div>
@include('partials.navbar.contextBar', array('article' => $article))