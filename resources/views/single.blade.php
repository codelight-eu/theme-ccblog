@extends('layouts.app')

@section('content')
  <header
      class="row padding-top-small padding-bottom-xxsmall padding-horz-medium border-bottom border--thin border--gray-dark"
      data-responsive='{"mediumUp": "padding-top-medium padding-bottom-small"}'>
  @include('partials.navbar.navbar-largeScrn')
  </header>
  @while(have_posts()) @php(the_post())
    @include('partials.content-single-'.get_post_type())
  @endwhile
@endsection
