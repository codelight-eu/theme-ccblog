@extends('layouts.app')

@section('content')

  @include('partials.follow-mobile')
  <header
      class="row z-high padding-top-small padding-horz-medium padding-top-medium border--thin border--gray-dark"
      data-responsive='{"largeUp": "border-bottom padding-bottom-small"}'>
    @include('partials.navbar.navbar-largeScrn')
    @include('partials.navbar.navbar-mobile')
  </header>
  <div
      class="max-width-xl width-centered padding-horz-small text-center margin-top-xxsmall large-up-margin-top-medium">
    <img class="width-3-5" src="@asset('images/404-desk.png')" alt="404">
  </div>
  <div class="max-width-xl width-centered text-center margin-bottom-large padding-horz-medium head-2 large-up-head-1 text--bold">
    {{ __('404. Not found.', 'ccblog') }}
  </div>
  <div class="max-width-xl width-centered margin-top-medium padding-horz-medium text--charcoal text-center row">
  @if (!have_posts())
    <div class="alert alert-warning">
      {{ __('Sorry, we can’t seem to find the page you are looking for.', 'ccblog') }}
    </div>
  @endif
  </div>
@endsection
