@php
  $link = rawurlencode($link);
  $title = rawurlencode($title);
  $imageUrl = rawurlencode($imageUrl);
  $fbShareLink = "http://www.facebook.com/sharer.php?u=${link}&t=${title}&s=100&p[url]=${link}&p[images][0]=${imageUrl}&p[title]=${title}";
  $twitterShareLink = "https://twitter.com/intent/tweet?url=${link}&text=${title}";
  $emailShareLink = "mailto:?subject=${title}&body=Hey%20check%20this%20out:%20${link}";
@endphp

<ul class="{{ $class }}">
  <li class="article_socialItem inline-block">
    <a href="{{ $fbShareLink }}" target="_blank" class="article_socialLink"><i class="icon-facebook-outline-charcoal icon--xsmall"></i></a>
  </li>
  <li class="article_socialItem inline-block">
    <a href="{{ $twitterShareLink }}" target="_blank" class="article_socialLink"><i class="icon-twitter-outline-charcoal icon--small"></i></a>
  </li>
  <li class="article_socialItem inline-block">
    <a href="{{ $emailShareLink }}" class="article_socialLink"><i class="icon-envelope-charcoal icon--xsmall"></i></a>
  </li>
</ul>
