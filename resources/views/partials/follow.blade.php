<ul class="follow inline-block">
  @if(get_field('rss', 'option'))
  <li class="pull margin-right-xsmall">
    <a class="btn-white btn-circle btn--small icon-rss icon--center" href="{{ get_field('rss', 'option')['url'] }}" target="{{ get_field('rss', 'option')['target'] }}" title="{{ get_field('rss', 'option')['title'] }}"></a>
  </li>
  @endif
  @if(get_field('facebook', 'option'))

  <li class="pull margin-right-xsmall">
    <a class="btn-white btn-circle btn--small icon-facebook icon--center" href="{{ get_field('facebook', 'option')['url'] }}" target="{{ get_field('facebook', 'option')['target'] }}" title="{{ get_field('facebook', 'option')['title'] }}"></a>
  </li>
  @endif
  @if(get_field('twitter', 'option'))
  <li class="pull">
    <a class="btn-white btn-circle btn--small icon-twitter icon--center" href="{{ get_field('twitter', 'option')['url'] }}" target="{{ get_field('twitter', 'option')['target'] }}" title="{{ get_field('twitter', 'option')['title'] }}"></a>
  </li>
  @endif
</ul>