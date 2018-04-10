<div class="sectionTitle_image size--xlarge large-up-size--xxlarge bg-navy radius--50 overflow-hidden flush-left margin-right-small">
  <img src="{{ get_avatar_url(get_the_author_meta('ID'), ['size' => 126]) }}" class="author_image width-100 block">
</div>
<div class="overflow-hidden">
  <h1 class="head-1 text--bold inline-block bg-white padding-right-medium margin-top-xsmall margin-bottom-xsmall large-up-margin-bottom-small">{!! App::title() !!}</h1>
  <div class="text-1">
    {!! category_description()  !!}
  </div>
</div>