{{--
  Template Name: Front Page
--}}
@extends('layouts.app')

@section('content')

  <header
      class="row padding-top-small padding-bottom-xxsmall padding-horz-medium border--thin border--gray-dark xlarge-up-absolute width-100 border-box"
      data-responsive='{
      "mediumUp": "padding-top-medium padding-bottom-small",
      "xsmallOnly": "border-bottom",
      "smallOnly": "border-bottom",
      "mediumOnly": "border-bottom",
      "largeOnly": "border-bottom"
      }'>
    @include('partials.navbar.navbar-largeScrn', ['frontPage' => true])
    @include('partials.navbar.navbar-mobile')
  </header>
  <div
      class="max-width-xl width-centered margin-top-medium row text--charcoal"
      data-responsive='{
      "mediumUp": "padding-horz-medium",
      "largeUp": "padding-horz-large"
    }'>

    <div
        class="frontIntro padding-horz-small hidden text-center margin-top-xxsmall xlarge-up-block large-up-margin-top-medium">
      <div class="frontIntro_logo inline-block">
        <i class="symbol-moocreport-blue symbol--xlarge block margin-bottom-xxsmall"></i>
        <div class="block margin-right-large head-6 flush-right text--gray"><span class="flush-left">by</span> <i
              class="symbol-classcentral-gray symbol--small margin-top-xxsmall"></i></div>
      </div>
      <div class="frontIntro_text text-1 text--italic">
        @if (have_posts())
          @while (have_posts())  @php(the_post())
          @if(get_the_content())
            <div class="frontIntro_text text-1 text--italic margin-top-large">
              {!! get_the_content() !!}
            </div>
          @endif
          @endwhile
        @endif
      </div>
      <div class="category text-center border-bottom border--thin border--gray-dark padding-vert-xxsmall">
        @php
          $categories = get_categories();
          $currentCatID = (is_category() ? get_category(get_query_var( 'cat' ))->cat_ID : false);
          $itemClass = 'block medium-up-inline-block padding-small ';
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
        <div class="inline-block">@include('partials.quickArticles')</div>
      </div>
    </div>
    @php
      $args = array(
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
      );
      $counter = 0;
      $query = new WP_Query($args);
    @endphp
    @if($query->have_posts())
      @while($query->have_posts()) @php($query->the_post())
      @if(get_field('set_featured_position') == 'position_top' && $counter < 1)
        @include('partials.featuredPost')
        @php($counter++)
      @endif
      @endwhile
    @endif
    @php wp_reset_query(); @endphp
    <div class="main row large-up-margin-top-large">
      <div
          class="col large-up-width-3-5 padding-horz-xlarge medium-up-padding-horz-small xlarge-up-margin-bottom-xxlarge">
        <div class="sectionSubtitle border-center border--thin border--gray-dark margin-bottom-large">
          <h4 class="head-4 text--bold inline-block bg-white padding-right-medium">{{ __('Recent articles', 'ccblog') }}</h4>
        </div>

        @if (!have_posts())
          <div class="alert alert-warning">
            {{ __('Sorry, no results were found.', 'sage') }}
          </div>
          {!! get_search_form(false) !!}
        @endif
        @php
          $args = array(
            'posts_per_page' => 4,
          );
          $query = new WP_Query($args);
        @endphp
        @if($query->have_posts())
          @while ($query->have_posts()) @php($query->the_post())
          @include('partials.content')
          @endwhile
        @endif

        {!! get_the_posts_navigation() !!}
      </div>
      <div
          class="sidebar col large-up-width-2-5 margin-top-large large-up-margin-top-reset padding-horz-xlarge medium-up-padding-horz-small padding-top-xsmall relative">
        @php
          $args = array(
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => -1,
          );
          $counter = 0;
          $query = new WP_Query($args);
        @endphp
        @if($query->have_posts())
          @while ($query->have_posts()) @php($query->the_post())
          @if(get_field('set_featured_position') == 'position_sidebar' && $counter < 1)
            <div
                class="featurePost-sidebar border-all border--thin border--gray-dark radius padding-horz-large large-up-padding-bottom-xxlarge padding-bottom-xlarge margin-bottom-xlarge medium-up-margin-bottom-xxlarge">
              <div class="text-center">
                <div class="text--charcoal relative nudge-top-half head-3 padding-horz-small bg-white inline-block">
                  {!! get_field('section_title') !!}
                </div>
              </div>
              <time
                  class="featurePost_date block head-5 text-center text--thin text--italic"
                  datetime="{{ get_post_time('c', true) }}">{{ get_the_date('F jS, Y') }}</time>
              @if (has_post_thumbnail( get_the_ID() ) )
                @php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium_large' ); @endphp
                <div class="featurePost_imageCont margin-top-xsmall">
                  <a href="{{ get_permalink() }}" class="text--charcoal">
                    <img class="width-100" src="{{ $image[0] }}">
                  </a>
                </div>
              @endif
              <h2 class="head-2 text-center margin-top-xsmall">
                <a href="{{ get_permalink() }}" class="text--charcoal">
                  {!! get_field('short_title') ? get_field('short_title') : the_title() !!}
                </a></h2>
              <div
                  class="featurePost_description text-2 large-up-text-1 margin-top-medium margin-bottom-small large-up-margin-bottom-medium">{!! get_the_excerpt() !!}</div>
              <div class="featurePost_authorCont flex-vert-middle">
                @include('partials.author', array('author_imageContClass' => 'size--xsmall medium-up-size--small'))
              </div>
              <div
                  class="mailChimp row bg-blue-light padding-large border--blue-light border--thin border-all text-center margin-top-medium">
                <div class="head-5">{{ __('Get', 'ccblog') }} <i
                      class="symbol-moocwatch-charcoal symbol--charcoal symbol--small"></i> {{ __('in your inbox.', 'ccblog') }}
                </div>
                @php
                  mc4wp_show_form('63147');
                @endphp
              </div>
            </div>
            @php($counter++)
          @endif
          @endwhile
          @php wp_reset_postdata(); @endphp
        @endif
        @include('partials.lastComments')
      </div>
    </div>
  </div>
  @if(get_field('set_footer_CTA') && get_field('set_footer_CTA') != 'none')
    @php
      $msgType = 'partials.featuredMsg-' . get_field('set_footer_CTA');
    @endphp
    @include($msgType)
  @endif
@endsection
