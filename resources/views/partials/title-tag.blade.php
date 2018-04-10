<p class="text-1">{{ __('Tagged in', 'ccblog') }}</p>
<h1 class="head-1 text--bold inline-block bg-white padding-right-medium">{!! App::title() !!}</h1>
@if(get_field('set_related_tags', get_queried_object('term_id')))
  @php
    $tags = get_field('set_related_tags', get_queried_object('term_id'));
  @endphp
  <div class="row margin-top-medium">
    <div class="flush-left margin-right-small text-2 margin-top-xxsmall">
      {{ __('Related tags', 'ccblog') }}
    </div>
    <div class="overflow-hidden">
      @foreach($tags as $tag)
        @php
          $theTag = get_tag($tag);
        @endphp
        <div class="margin-right-xsmall margin-bottom-xsmall inline-block">
          <a class="btn-gray btn--small text--normal" href="{{ get_tag_link($tag) }}">{{ $theTag->name }}</a>
        </div>
      @endforeach
    </div>
  </div>
@endif