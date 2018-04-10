<div class="sectionTitle text--charcoal margin-vert-large row">
  @if(is_author())
    @include('partials.title-author')
  @elseif(is_tag())
    @include('partials.title-tag')
  @elseif(is_category())
    @include('partials.title-category')
  @else
    <h1 class="head-1 text--bold inline-block bg-white padding-right-medium">{!! App::title() !!}</h1>
  @endif
</div>