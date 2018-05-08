<ul class="follow">
  <li class="pull margin-right-xsmall head-5 margin-top-xxsmall">{{ __('Stay up to date', 'ccblog') }}</li>
  @if(get_field('rss', 'option'))
  <li class="pull margin-right-xsmall">
    <a href="{{ get_field('rss', 'option')['url'] }}" target="{{ get_field('rss', 'option')['target'] }}" title="{{ get_field('rss', 'option')['title'] }}">
    <i class="icon-rss icon--small border radius--50 border-all border--gray-dark border--thin"></i>
    </a>
  </li>
  @endif
  @if(get_field('facebook', 'option'))

  <li class="pull margin-right-xsmall">
    <a href="{{ get_field('facebook', 'option')['url'] }}" target="{{ get_field('facebook', 'option')['target'] }}" title="{{ get_field('facebook', 'option')['title'] }}">
      <i class="icon-facebook icon--small border radius--50 border-all border--gray-dark border--thin"></i>
    </a>
  </li>
  @endif
  @if(get_field('twitter', 'option'))
  <li class="pull">
    <a href="{{ get_field('twitter', 'option')['url'] }}" target="{{ get_field('twitter', 'option')['target'] }}" title="{{ get_field('twitter', 'option')['title'] }}">
      <i class="icon-twitter icon--small border radius--50 border-all border--gray-dark border--thin"></i>
    </a>
  </li>
  @endif
</ul>