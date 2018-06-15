@php
  if(!isset($article)){
    $article = false;
  }
@endphp
<div
    class="contextBar hidden @if($article) xlarge-up-block @endif xxlarge-up-block border-box bg-white z-high animate-fade-hidden border-bottom border--gray-dark border--thin left right top fixed text-center padding-horz-medium padding-top-xsmall padding-bottom-xsmall"
    data-contextBar>
  @include("partials.logo", array('isContext' => 'true'))
  @if($article)
    <div class="contextBar_title truncate truncate--xlarge head-3 inline-block flush-left margin-left-medium margin-top-xsmall text-left width-3-5">
      {{ get_the_title() }}
    </div>
  <div class="flush-right">
    <div class="inline-block head-5 margin-right-xsmall flush-left margin-top-xxsmall">{{ __('Share this article', 'ccblog') }}</div>
    @include('partials.social-article')
  </div>
  @else
  <div class="category head-5 inline-block">
    @if (has_nav_menu('mainNav'))
      @php $menu_obj = get_menu_by_location('mainNav'); @endphp
      {!! wp_nav_menu([
      'theme_location' => 'contextBarNav',
      'container_class' => 'inline-block',
      'link_after' => '<i class="menu_more-icon icon--xsmall icon-chevron-down"></i>',
      ]) !!}
    @endif
  </div>
  <div class="flush-right margin-top-xxsmall">
    <div class="pull margin-right-xsmall head-5 margin-top-xxsmall">{{ __('Stay up to date', 'ccblog') }}</div>
    @include('partials.follow')
  </div>
  @endif
</div>
@include('partials.navbar.navbar-mobile', array('contextBar' => 'true', 'article' => $article))