@php
  if(!isset($frontPage)){
  $frontPage = false;
  }
  if(!isset($contextBar)){
  $contextBar = false;
  }
  if(!isset($article)){
  $article = false;
  }
@endphp
@if(!$contextBar)
  <div
      class="spaceHolder invisible padding-top-medium padding-bottom-medium margin-top-xxsmall xlarge-up-hidden @if(!$frontPage)large-up-hidden @endif"></div>
@endif
<div
    class="@if(!$contextBar)navbar-mobile xlarge-up-hidden z-low @elseif($contextBar && $article) navbar-mobileArticleContext animate-fade-hidden xlarge-up-hidden z-high @else navbar-mobileContext animate-fade-hidden xxlarge-up-hidden z-low @endif @if(!$frontPage && !$contextBar)large-up-hidden @endif fixed left right top padding-horz-medium padding-top-small padding-bottom-xxsmall bg-white border-bottom border--gray-dark border--thin border-box"
    data-toggle-container @if($contextBar)data-contextBar @endif>
  @include("partials.logo")
  @if($article && $contextBar)
    <div
        class="contextBar_title head-4 truncate truncate--large inline-block flush-left margin-left-medium margin-top-xsmall text-left xsmall-only-width-1-2 width-4-7">
      {{ get_the_title() }}
    </div>
    <i class="icon-menu-charcoal icon--medium invisible inline"></i>
  @else
    <span class="menuToggle flush-right cursor-pointer" data-toggle-link>
    <i class="icon-menu-charcoal icon--medium" data-toggle-icon-open></i>
    <i class="icon-x-charcoal icon--xsmall invisible absolute right top margin-right-large margin-top-medium padding-top-xxsmall" data-toggle-icon-close></i>
  </span>
    <div
        class="navbar_content animate-fade-hidden border-top margin-top-xxlarge absolute left right padding-horz-xlarge padding-vert-large z-high bg-white row border-all"
        data-toggle-item>
      <div class="menu_left col width-100 small-up-width-1-3 head-5">
        <div class="block padding-right-small padding-bottom-xsmall">
          <span class="inline-block text--bold">{{ __('Categories', 'ccblog') }}</span>
        </div>
        <div
            class="category width-1-2 small-up-width-100 padding-bottom-xsmall"
            data-responsive='{"xsmallOnly": "border-bottom  border--gray-dark border--thin"}'
        >
          @if (has_nav_menu('mobileNav'))
            @php $menu_obj = get_menu_by_location('mobileNav'); @endphp
            {!! wp_nav_menu([
            'theme_location' => 'mobileNav',
            ]) !!}
          @endif
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
  @endif
</div>