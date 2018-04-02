@php
/*
  http://www.facebook.com/sharer.php?
    u=http%3A%2F%2Fccblog.local
    &t=These%2017%20Online%20Classes%20Can%20Help%20You%20Become%20A%20Better%20Parent
    &s=100
    &p[url]=http%3A%2F%2Fccblog.local
    &p[images][0]=http%3A%2F%2Fccblog.local%2Fapp%2Fuploads%2F2018%2F03%2FParenting-Article-Social-Image.png
    &p[title]=These%2017%20Online%20Classes%20Can%20Help%20You%20Become%20A%20Better%20Parent

https://www.facebook.com/sharer/sharer.php
?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fsharing%2Fweb%2F
&display=popup
&ref=plugin
&src=like
&kid_directed_site=0
&app_id=113869198637480

    https://twitter.com/intent/tweet?
    url=http%3A%2F%2Fccblog.local
    &text=Hey%20check%20this%20out

    mailto:?
    subject=These%2017%20Online%20Classes%20Can%20Help%20You%20Become%20A%20Better%20Parent
    &body=Hey%20check%20this%20out:%20http%3A%2F%2Fccblog.local

  */
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
