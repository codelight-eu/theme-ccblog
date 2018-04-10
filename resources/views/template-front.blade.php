{{--
  Template Name: Front Page
--}}

@extends('layouts.app')

@section('content')

  @include('partials.header-full')
  <div
      class="max-width-xl width-centered margin-top-medium row text--charcoal"
      data-responsive='{
      "mediumUp": "padding-horz-medium",
      "largeUp": "padding-horz-large"
    }'>

    <div class="frontIntro padding-horz-small hidden xlarge-up-block">
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
      </div>
    </div>
    @php
      $args = array(
        'posts_per_page' => -1,
      );
      $featurePostId = get_field('set_featured_post');
      $query = new WP_Query($args);
    @endphp
    @if($query->have_posts())
      @while($query->have_posts()) @php($query->the_post())
      @if(get_the_id() == $featurePostId)
        @include('partials.featuredPost')
      @endif
      @endwhile
    @endif
    @php wp_reset_query(); @endphp
    <div class="main row large-up-margin-top-large">
      <div class="col large-up-width-3-5 padding-horz-xlarge medium-up-padding-horz-small">
        <div class="sectionTitle border-center border--thin border--gray-dark margin-bottom-large">
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
            'tag' => 'MOOCWatch',
            'posts_per_page' => 1,
          );
          $query = new WP_Query($args);
        @endphp
        @if($query->have_posts())
          @while ($query->have_posts()) @php($query->the_post())
          <div
              class="featurePost-sidebar border-all border--thin border--gray-dark radius padding-horz-large large-up-padding-bottom-xxlarge padding-bottom-xlarge margin-bottom-xlarge medium-up-margin-bottom-xxlarge">
            <div class="text-center">
              <a href="{{ the_permalink() }}"
                 class="text--charcoal relative nudge-top-half head-3 padding-horz-small bg-white">
                HEADER HERE
              </a>
            </div>
            <time
                class="featurePost_date block head-5 text-center text--thin text--italic"
                datetime="{{ get_post_time('c', true) }}">{{ get_the_date('F jS, Y') }}</time>
            @if (has_post_thumbnail( get_the_ID() ) )
              @php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium_large' ); @endphp
              <div class="featurePost_imageCont margin-top-xsmall">
                <a href="{{ the_permalink() }}" class="text--charcoal">
                  <img class="width-100" src="{{ $image[0] }}">
                </a>
              </div>
            @endif
            <h2 class="head-2 text-center margin-top-xsmall">
              <a href="{{ the_permalink() }}" class="text--charcoal">
                {{ the_title() }}
              </a></h2>
            <div
                class="featurePost_description text-2 large-up-text-1 margin-top-medium margin-bottom-small large-up-margin-bottom-medium">{{ get_the_excerpt() }}</div>
            <div class="featurePost_authorCont flex-vert-middle">
              @include('partials.author', array('author_imageContClass' => 'size--xsmall medium-up-size--small'))
            </div>
            <div
                class="mailChimp row bg-blue-light padding-large border--blue-light border--thin border-all text-center margin-top-medium">
              <div class="head-5">Get <i
                    class="symbol-moocwatch-charcoal symbol--charcoal symbol--small"></i> in your inbox.
              </div>
              @php
                mc4wp_show_form('63147');
              @endphp
            </div>
          </div>
          @endwhile
          @php wp_reset_postdata(); @endphp
        @endif
        @include('partials.lastComments')
      </div>
    </div>
  </div>
  @include('partials.featuredMsg2')
@endsection
