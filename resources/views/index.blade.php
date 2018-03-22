@extends('layouts.app')

@section('content')
  <div class="max-width-xl width-centered medium-up-padding-horz-large margin-top-medium row">
    <div class="col width-2-3 padding-horz-small">
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

  {!! get_the_posts_navigation() !!}</div>
    <div class="col width-1-3 padding-horz-small">
      <div class="border-all radius">
        test
      </div>
    </div>
  </div>
@endsection
