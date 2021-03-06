@php
  $currentID = get_queried_object_id();
  $pageForPosts = get_option( 'page_for_posts' );
@endphp

@extends('layouts.app')

@section('content')
  @include('partials.follow-mobile')
  <header
      class="row z-high padding-top-small padding-horz-medium padding-top-medium border--thin border--gray-dark"
      data-responsive='{"largeUp": "border-bottom padding-bottom-small"}'>
    @include('partials.navbar.navbar-largeScrn')
    @include('partials.navbar.navbar-mobile')
  </header>
  <div class="max-width-xl width-centered"
       data-responsive='{
      "mediumUp": "padding-horz-medium",
      "largeUp": "padding-horz-large"
    }'>
    @include('partials.breadcrumbs')
    @include('partials.sectionTitle')
  </div>
  <div
      class="max-width-xl width-centered margin-top-medium text--charcoal row"
      data-responsive='{
      "mediumUp": "padding-horz-medium",
      "largeUp": "padding-horz-large"
    }'>
    <div class="col width-100 xlarge-up-width-2-3 padding-horz-medium medium-up-padding-horz-small">
      <div
          class="sectionSubtitle border-center border--thin border--gray-dark margin-bottom-medium large-up-margin-bottom-large">
        <h4 class="head-4 inline-block bg-white padding-right-medium"><strong
              class="text--bold">{{ __('Most Recent', 'ccblog') }}</strong></h4>
      </div>

      @if (!have_posts())
        <div class="alert alert-warning">
          {{ __('Sorry, no results were found.', 'sage') }}
        </div>
      @endif

      @while (have_posts()) @php(the_post())
      @include('partials.content-'.get_post_type())
      @endwhile
      <div class="pagination text-center margin-top-large margin-bottom-xxlarge">
        <div class="inline-block text--gray margin-right-small">
          <i class="{{ get_previous_posts_link( 'Previous Page' ) ? 'icon-chevron-left-blue' : 'icon-chevron-left-gray' }} icon--xsmall"></i>
          {!! get_previous_posts_link( 'Previous Page' ) ? previous_posts_link( 'Previous Page' ) : __('Previous Page') !!}
        </div>
        <div class="inline-block text--gray margin-left-small">
          {!! get_next_posts_link( 'Next Page' ) ? next_posts_link( 'Next Page' ) : __('Next Page') !!}
          <i class="{{ get_next_posts_link( 'Next Page' ) ? 'icon-chevron-right-blue' : 'icon-chevron-right-gray' }} icon--xsmall"></i>
        </div>
      </div>
    </div>
    <div
        class="sidebar col width-100 xlarge-up-width-1-3 padding-horz-medium medium-up-padding-horz-small margin-bottom-xxlarge">
      <div class="sidebar_title border-center margin-bottom-medium">
        <div
            class="head-4 inline-block border--gray-dark bg-white padding-right-xsmall"><strong
              class="text--bold">{{ __('About', 'ccblog') }}</strong></div>
      </div>
      <div class="sidebar_content wysiwyg--text-2">
        {!! get_field('footer_content', 'option') !!}
      </div>
      <div
          class="mailChimp mailChimp-layout2 col width-100 bg-blue-light padding-large border--blue-light border--thin border-all margin-top-medium">
        <div class="head-5">
          <span class="margin-right-xsmall">{{ __('Get', 'ccblog') }} <i
                class="symbol-moocwatch-charcoal symbol--small"></i> {{ __('in your inbox.', 'ccblog') }}</span>
          @if(get_field('sidebar_link', 'option'))
            <a href="{{ get_field('sidebar_link', 'option')['url'] }}"
               target="{{ get_field('sidebar_link', 'option')['target'] }}"
               class="inline-block text--blue head-6 text--bold">
              {{ get_field('sidebar_link', 'option')['title'] }} <i class="icon-chevron-right-blue icon--xxsmall"></i>
            </a>
          @endif
        </div>
        @php
          mc4wp_show_form('63147');
        @endphp
      </div>
    </div>
  </div>
  @if(get_field('set_footer_CTA', $pageForPosts) && get_field('set_footer_CTA', $pageForPosts) != 'none')
    @php
      $msgType = 'partials.featuredMsg-' . get_field('set_footer_CTA', $pageForPosts);
    @endphp
    @include($msgType)
  @endif
@endsection
