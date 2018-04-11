<div class="CTA bg-gradient text--charcoal padding-vert-xxlarge hidden large-up-block">
  <div class="max-width-xl width-centered padding-medium text-center padding-vert-small">
    <div class="head-2 margin-bottom-medium"><i class="symbol-classcentral-blue symbol--large"></i></div>
    <div class="CTA_text head-2 margin-bottom-medium">
      {!! get_field('CTA_1_text', 'option') !!}
    </div>
    <div class="CTA_links inline-block row">
      @if(get_field('CTA_1_facebook_link', 'option'))
      <a
        href="{{ get_field('CTA_1_facebook_link', 'option')['url'] }}"
        title="{{ get_field('CTA_1_facebook_link', 'option')['title'] }}"
        target="{{ get_field('CTA_1_facebook_link', 'option')['target'] }}"
        class="CTA_link inline-block radius--50 col bg-white border-all border--thin border--gray-dark overflow-hidden @if(get_field('CTA_1_twitter_link', 'option'))margin-right-small @endif"
      >
        <i class="icon-facebook"></i>
      </a>
      @endif
      @if(get_field('CTA_1_twitter_link', 'option'))
      <a
        href="{{ get_field('CTA_1_twitter_link', 'option')['url'] }}"
        title="{{ get_field('CTA_1_twitter_link', 'option')['title'] }}"
        target="{{ get_field('CTA_1_twitter_link', 'option')['target'] }}"
        class="CTA_link inline-block radius--50 col bg-white border-all border--thin border--gray-dark overflow-hidden"
      >
        <i class="icon-twitter"></i>
      </a>
      @endif
    </div>
  </div>
</div>