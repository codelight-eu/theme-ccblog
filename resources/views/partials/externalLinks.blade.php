<ul class="externalLinks head-5">
  @if(get_field('link_1', 'option'))<li><a href="{{ get_field('link_1', 'option')['url'] }}" target="{{ get_field('link_1', 'option')['target'] }}" class="block text--blue padding-left-xsmall margin-bottom-small">{{ get_field('link_1', 'option')['title'] }}</a></li>@endif
  @if(get_field('link_2', 'option'))<li><a href="{{ get_field('link_2', 'option')['url'] }}" target="{{ get_field('link_2', 'option')['target'] }}" class="block text--charcoal"><i class="icon-course icon--small"></i>{{ get_field('link_2', 'option')['title'] }}</a></li>@endif
  @if(get_field('link_3', 'option'))<li><a href="{{ get_field('link_3', 'option')['url'] }}" target="{{ get_field('link_3', 'option')['target'] }}" class="block text--charcoal"><i class="icon-search icon--small"></i>{{ get_field('link_3', 'option')['title'] }}</a></li>@endif
  @if(get_field('link_4', 'option'))<li><a href="{{ get_field('link_4', 'option')['url'] }}" target="{{ get_field('link_4', 'option')['target'] }}" class="block text--charcoal"><i class="icon-star icon--small"></i>{{ get_field('link_4', 'option')['title'] }}</a></li>@endif
</ul>
