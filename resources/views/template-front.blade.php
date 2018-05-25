{{--
  Template Name: Front Page
--}}
@extends('layouts.app')

@section('content')

  @include('partials.follow-mobile', array('frontPage' => 'true'))
  <header
      class="row z-high xlarge-up-absolute padding-horz-medium padding-top-medium width-100 border-box">
    @include('partials.navbar.navbar-largeScrn', ['frontPage' => true])
    @include('partials.navbar.navbar-mobile', ['frontPage' => true])
  </header>
  <div
      class="max-width-xl width-centered padding-top-medium row text--charcoal"
      data-responsive='{
      "mediumUp": "padding-horz-medium",
      "largeUp": "padding-horz-large"
    }'>

    <div
        class="frontIntro padding-horz-small hidden text-center margin-top-xxsmall xlarge-up-block large-up-margin-top-medium">
      <div class="frontIntro_logo inline-block">
        <i class="symbol-moocreport-blue symbol--large block margin-bottom-xxsmall"></i>
        <div class="block margin-right-large head-6 flush-right text--gray"><span class="flush-left">by</span><i
              class="symbol-classcentral-gray symbol--small margin-top-xxsmall margin-left-xxsmall"></i></div>
      </div>
      <div class="frontIntro_text text-1 text--italic">
        @if (have_posts())
          @while (have_posts())  @php(the_post())
          @if(get_the_content())
            <div class="frontIntro_text wysiwyg text-1 text--italic margin-top-medium">
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
          $linkClass = 'inline-block text--charcoal head-5';
          $activeLinkClass = 'inline-block text--blue border-bottom border--thin border--blue head-5';
        @endphp
        @foreach($categories as $category)
          @php
            $linkURL = get_category_link($category->term_id);
          @endphp

          <div class='{{ $itemClass }}'><a
                class='{{ ($category->cat_ID == $currentCatID ? $activeLinkClass : $linkClass) }}'
                href='{{ $linkURL }}'>{{$category->name}}</a></div>
        @endforeach
        <div class="inline-block text-left">
          @include('partials.quickArticles-opener')
        </div>
      </div>
    </div>
    @php
      $args = array(
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
      );
      $counter = 0;
      $featuredID = '';
      $query = new WP_Query($args);
    @endphp
    @if($query->have_posts())
      @while($query->have_posts()) @php($query->the_post())
      @if(get_field('set_featured_position') == 'position_top' && $counter < 1)
        @include('partials.featuredPost')
        @php
          $counter++;
          $featuredID = get_the_ID();
          @endphp
      @endif
      @endwhile
    @endif
    @php wp_reset_query(); @endphp
    <div class="main row large-up-margin-top-large">
      <div
          class="col xlarge-up-width-2-3 width-100 padding-horz-medium medium-up-padding-horz-small xlarge-up-margin-bottom-xxlarge">
        <div class="sectionSubtitle border-center border--thin border--gray-dark margin-bottom-large">
          <h4 class="head-4 inline-block bg-white padding-right-medium"><strong class="text--bold">{{ __('Recent articles', 'ccblog') }}</strong></h4>
        </div>

        @if (!have_posts())
          <div class="alert alert-warning">
            {{ __('Sorry, no results were found.', 'sage') }}
          </div>
          {!! get_search_form(false) !!}
        @endif
        @php
          $args = [];
          if($featuredID == ''){
            $args['posts_per_page'] = 10;
          } else {
            $args['posts_per_page'] = 9;
            $args['post__not_in'] = [$featuredID];
          }
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
            class="sidebar col width-100 xlarge-up-width-1-3 margin-top-large large-up-margin-top-reset padding-horz-medium medium-up-padding-horz-small padding-top-xsmall relative">
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
            @if(get_field('set_featured') == 'true' && get_field('set_featured_position') == 'position_sidebar' && $counter < 1)
              <div
                  class="featurePost-sidebar border-all border--thin border--gray-dark radius padding-horz-large large-up-padding-bottom-xxlarge padding-bottom-xlarge margin-bottom-xlarge medium-up-margin-bottom-xxlarge">
                <div class="text-center">
                  <div class="text--charcoal relative nudge-top-half padding-horz-small bg-white inline-block">
                    @if(get_field('sidebar_settings')['set_section_title'] == 'title_custom')
                      <span class="head-3 wysiwyg">{!! get_field('sidebar_settings')['section_title'] !!}</span>
                    @elseif(get_field('sidebar_settings')['set_section_title'] == 'title_moocwatch')
                      @if(get_field('sidebar_settings')['moocwatch_no'])<i class="symbol-moocwatch-charcoal"></i><span class="head-4 padding-left-xsmall">{{ __('No.', 'ccblog') }} {{ get_field('sidebar_settings')['moocwatch_no'] }}</span>@endif
                    @endif
                  </div>
                </div>
                <time
                    class="featurePost_date block head-5 text-center text--italic"
                    datetime="{{ get_post_time('c', true) }}">{{ get_the_date('F jS, Y') }}</time>
                @if (has_post_thumbnail( get_the_ID() ) || get_field('set_cropped_illustration') )
                  @php
                    if(get_field('set_cropped_illustration')) $image = wp_get_attachment_image_src( get_field('set_cropped_illustration')['id'], 'medium_large' );
                    else if(has_post_thumbnail( get_the_ID() )) $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium_large' );
                  @endphp
                  <div class="featurePost_imageCont margin-top-xsmall">
                    <a href="{{ get_permalink() }}" class="text--charcoal">
                      <img class="width-100" src="{{ $image[0] }}">
                    </a>
                  </div>
                @endif
                <h2 class="text-center margin-top-xsmall">
                  <a href="{{ get_permalink() }}" class="text--charcoal head-3 text--bold">
                    {!! get_field('sidebar_settings')['short_title'] ? get_field('sidebar_settings')['short_title'] : the_title() !!}
                  </a></h2>
                <div
                    class="featurePost_description text-3 margin-top-medium margin-bottom-small large-up-margin-bottom-medium">{!! get_the_excerpt() !!}</div>
                <div class="featurePost_authorCont flex-vert-middle">
                  @include('partials.author', array('author_imageContClass' => 'size--xsmall medium-up-size--small'))
                </div>
                <div
                    class="mailChimp row bg-blue-light padding-medium border--blue-light border--thin border-all text-center margin-top-medium">
                  <div class="head-5">{{ __('Get', 'ccblog') }} <i
                        class="symbol-moocwatch-charcoal symbol--charcoal symbol--small"></i> <span class="xlarge-up-block">{{ __('in your inbox.', 'ccblog') }}</span>
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
