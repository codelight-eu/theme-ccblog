@php
  $categories = get_the_category();
@endphp

<div class="relatedPost_item large-up-width-1-3 margin-left-xsmall margin-right-xsmall relative radius border-all border--thin border--gray-dark padding-left-large padding-right-large padding-top-medium padding-bottom-large bg-white margin-bottom-small large-up-margin-bottom-reset">
  <div class="relatedPost_categories head-5 margin-bottom-xxsmall">
    @if($categories)
      @foreach($categories as $category)
        <a href="{{ get_category_link($category->term_id) }}" class="text--blue">{{ $category->name }}</a>
      @endforeach
    @endif
  </div>
  <h3 class="head-3 margin-bottom-xsmall"><a class="text--charcoal text--bold" href="{{ get_permalink() }}"
                                             rel="bookmark">{{ get_the_title() }}</a><!-- ({{ get_the_score() }})-->
  </h3>
  <div class="relatedPost_description margin-bottom-medium">
    {!! get_the_excerpt() !!}
  </div>
  <div class="relatedPost_author head-6">
    <a class="text--charcoal text--bold"
       href="{{ get_author_posts_url(get_the_author_meta('ID')) }}">{{ __('By', 'ccblog') }} {{ get_the_author() }}</a>
  </div>
</div>
