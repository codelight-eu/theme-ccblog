@extends('layouts.app')

@section('content')

  @include('partials.header-full')
  <div
    class="max-width-xl width-centered margin-top-medium row"
    data-responsive='{
      "mediumUp": "padding-horz-medium",
      "largeUp": "padding-horz-large"
    }'>

    <div class="frontIntro  padding-horz-small hidden xlarge-up-block">
      <div class="category text-center border-bottom padding-vert-xxsmall">
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

    <div class="col large-up-width-2-3 padding-horz-xlarge medium-up-padding-horz-small">
      @include('partials.sectionTitle')

      @if (!have_posts())
        <div class="alert alert-warning">
          {{ __('Sorry, no results were found.', 'sage') }}
        </div>
        {!! get_search_form(false) !!}
      @endif

      @while (have_posts()) @php(the_post())
      @include('partials.content-'.get_post_type())
      @endwhile

      {!! get_the_posts_navigation() !!}
    </div>
    <div class="col large-up-width-1-3 padding-horz-small">
      <div class="border-all radius">
        test
      </div>
    </div>
  </div>
@endsection
