@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.sectionTitle')
    @include('partials.content-page')
  @endwhile
@endsection
