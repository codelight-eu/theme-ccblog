@php
$link = get_permalink();
$title = get_the_title();
$imageUrl = get_the_post_thumbnail_url('large');
@endphp
<article @php(post_class('article row padding-left-xlarge padding-right-xlarge margin-top-small medium-up-padding-horz-small large-up-margin-vert-xxlarge margin-bottom-large'))>
  <div class="col large-up-width-1-2 large-up-padding-right-medium relative">
  <header>
    <time
      class="article_date head-5 margin-bottom-xxsmall inline-block text--italic"
      datetime="{{ get_post_time('c', true) }}">{{ get_the_date('F jS, Y') }}</time>
    <h1 class="article_title">
      <a class="text--charcoal head-2 medium-up-head-1 text--bold" href="{{ $link }}">{{ get_the_title() }}</a>
    </h1>
  </header>
  <div class="article_summary text-1 margin-top-xxsmall margin-bottom-small medium-up-margin-bottom-medium">
    {!! the_excerpt() !!}
  </div>
  @if(get_the_post_thumbnail())
    <div class="article_image radius overflow-hidden large-up-hidden margin-bottom-small medium-up-margin-bottom-medium">
      <a class="text--charcoal" href="{{ $link }}">
      {!! the_post_thumbnail('large', ['class' => 'width-100 height-100 block']) !!}
      </a>
    </div>
  @endif
  @include('partials.author', array('author_imageContClass' => 'size--xsmall medium-up-size--small'))
  @include('partials.social', array(
  'class' => 'article_social absolute bottom right large-up-margin-right-medium',
  'link' => $link,
  'title' => $title,
  'image' => $imageUrl))
  </div>
  @if(get_the_post_thumbnail())
    <div class="article_image col large-up-padding-left-medium hidden large-up-block width-1-2">
      <a class="text--charcoal radius overflow-hidden block" href="{{ $link }}">
        {!! the_post_thumbnail('large', ['class' => 'width-100 height-100 block']) !!}
      </a>
    </div>
  @endif
</article>
