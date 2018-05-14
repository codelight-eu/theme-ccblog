@php
$link = get_permalink();
$title = get_the_title();
$imageUrl = get_the_post_thumbnail_url('large');
@endphp
<article @php(post_class('article border-all border--thin border--gray-dark relative radius medium-up-padding-horz-xxlarge padding-left-large padding-top-large padding-right-large padding-bottom-medium medium-up-padding-vert-large margin-bottom-medium'))>
  <header>
    <time
      class="article_date head-5 margin-bottom-xxsmall inline-block text--italic"
      datetime="{{ get_post_time('c', true) }}">{{ get_the_date('F jS, Y') }}</time>
    <h2 class="article_title text--bold head-3 medium-up-head-2">
      <a class="text--charcoal text--bold" href="{{ $link }}">{{ get_the_title() }}</a>
    </h2>
  </header>
  <div class="article_summary text-1 margin-top-xxsmall margin-bottom-small medium-up-margin-bottom-medium">
    {!! the_excerpt() !!}
  </div>
  @if(get_the_post_thumbnail())
  <div class="article_image radius overflow-hidden margin-bottom-small medium-up-margin-bottom-medium">
    <a class="text--charcoal" href="{{ $link }}">
    {!! the_post_thumbnail('large', ['class' => 'width-100 height-100 block']) !!}
    </a>
  </div>
  @endif
  @include('partials.author', array('author_imageContClass' => 'size--xsmall medium-up-size--small'))
  @include('partials.social', array(
  'class' => 'article_social absolute bottom right margin-right-large medium-up-margin-right-xxlarge margin-bottom-medium medium-up-margin-bottom-xlarge',
  'link' => $link,
  'title' => $title,
  'image' => $imageUrl))
</article>
