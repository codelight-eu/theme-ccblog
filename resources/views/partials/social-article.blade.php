@php
$link = rawurlencode(get_permalink());
$title = rawurlencode(get_the_title());
$imageUrl = rawurlencode(get_the_post_thumbnail_url('large'));
$fbShareLink = "http://www.facebook.com/sharer.php?u=${link}&t=${title}&s=100&p[url]=${link}&p[images][0]=${imageUrl}&p[title]=${title}";
$twitterShareLink = "https://twitter.com/intent/tweet?url=${link}&text=${title}";
@endphp
<ul class="social-article inline-block">
  <li class="article_socialItem inline-block">
    <a href="{{ $fbShareLink }}" target="_blank" class="article_socialLink">
      <i class="icon-facebook icon--small border radius--50 border-all border--gray-dark border--thin"></i>
    </a>
  </li>
  <li class="article_socialItem inline-block margin-left-xsmall">
    <a href="{{ $twitterShareLink }}" target="_blank" class="article_socialLink">
      <i class="icon-twitter icon--small border radius--50 border-all border--gray-dark border--thin"></i>
    </a>
  </li>
</ul>