@php
  $catIcon = false;
  if(get_field('category_icon', get_queried_object())){
    $catIcon = get_field('category_icon', get_queried_object());
  }
@endphp
@if($catIcon)
<div class="sectionTitle_image size--xlarge large-up-size--xxlarge flush-left margin-right-small">
  <img src="{{ $catIcon['sizes']['medium'] }}" class="width-100">
</div>
@endif
<div class="overflow-hidden">
  <h1 class="head-2 medium-up-head-1 text--bold inline-block bg-white padding-right-medium margin-top-xsmall margin-bottom-xsmall large-up-margin-bottom-small">{!! \App\App::title() !!}</h1>
  <div class="text-1">
    {!! category_description() !!}
  </div>
</div>