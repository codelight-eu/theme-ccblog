@php
  $data = ['size' => 126];
@endphp
<div class="author text-2 relative row">
  <div class="author_imageCont flush-left margin-right-xsmall radius--50 overflow-hidden size--{{ $size }}">
    <img src="{{ get_avatar_url(get_the_author_meta('ID'), $data) }}" class="author_image width-100 block">
  </div>
  <div class="author_text padding-top-xsmall">
    {{ __('By', 'sage') }} <a href="{{ get_author_posts_url(get_the_author_meta('ID')) }}"
                              rel="author"
                              class="author_link text--charcoal text--bold">
      {{ get_the_author() }}
    </a>
  </div>
</div>