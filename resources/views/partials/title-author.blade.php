<div class="sectionTitle_image size--xlarge large-up-size--xxlarge radius--50 overflow-hidden flush-left margin-right-small">
  <img src="{{ get_avatar_url(get_the_author_meta('ID'), ['size' => 126]) }}" class="author_image width-100 block">
</div>
<div class="overflow-hidden">
  <h1 class="head-2 medium-up-head-1 text--bold inline-block bg-white padding-right-medium margin-top-xsmall margin-bottom-xsmall large-up-margin-bottom-small">{!! \App\App::title() !!}</h1>
  @if(get_the_author_meta('short_description'))
  <div class="text-1">
    {!! get_the_author_meta('short_description') !!}
  </div>
  @endif
</div>