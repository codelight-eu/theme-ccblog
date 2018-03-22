<article @php(post_class('article border-all relative radius padding-horz-xxlarge padding-vert-large margin-bottom-medium'))>
  <header>
    <time
      class="article_date text-2 text--gray text--italic"
      datetime="{{ get_post_time('c', true) }}">{{ get_the_date('F jS, Y') }}</time>
    <h2 class="article_title head-2">
      <a class="text--charcoal" href="{{ get_permalink() }}">{{ get_the_title() }}</a>
    </h2>
  </header>
  <div class="article_summary text-1 margin-top-xxsmall margin-bottom-medium">
    @php(the_excerpt())
  </div>
  <div class="article_image radius overflow-hidden margin-bottom-medium">
    <a class="text--charcoal" href="{{ get_permalink() }}">
    {!! the_post_thumbnail('large', ['class' => 'width-100 height-100 block']) !!}
    </a>
  </div>
  @include('partials.author', array('size' => 'small'))
  <ul class="article_social absolute bottom right margin-right-xxlarge margin-bottom-large">
    <li class="article_socialItem inline-block">
      <a href="#" class="article_socialLink"><i class="icon-facebook-outline-charcoal icon--small"></i></a>
    </li>
    <li class="article_socialItem inline-block">
      <a href="#" class="article_socialLink"><i class="icon-twitter-outline-charcoal"></i></a>
    </li>
    <li class="article_socialItem inline-block">
      <a href="#" class="article_socialLink"><i class="icon-envelope-charcoal icon--small"></i></a>
    </li>
  </ul>
</article>
