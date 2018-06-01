<!doctype html>
<html @php(language_attributes())>
@include('partials.head')
<body @php(body_class('classcentral-style classcentral-style-custom'))>
<div class="content height-100">
  @php(do_action('get_header'))
  @yield('content')
</div>
@php(do_action('get_footer'))
@include('partials.footer')
@php(wp_footer())
</body>
</html>
