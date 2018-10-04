@php
  if(!isset($frontPage)){
    $frontPage = false;
  }
  if(!isset($article)){
    $article = false;
  }
@endphp
<div class="follow-mobile fixed bottom right xlarge-up-hidden @if(!$frontPage) large-up-hidden @endif margin-bottom-medium margin-right-medium z-low text-right" data-toggle-container>
  <div class="text-left shadow padding-top-xxsmall padding-bottom-xsmall padding-horz-medium bg-white animate-fade-hidden right bottom margin-bottom-small border-all border--gray-dark border-thin shadow radius width-centered" data-toggle-item>
    <div class="head-5 margin-bottom-xxsmall margin-top-xxsmall">{{ $article ? __('Share article', 'ccblog') : __('Share', 'ccblog') }}</div>
    @if($article)
      @include('partials.social-article')
    @else
      @include('partials.follow')
    @endif
  </div>
  <div class="follow_toggle btn-white" data-toggle-clickable>
    <div class="follow_content-state1 text--blue">
      <i class="icon-share-blue icon--small"></i>
      {{ __('Share', 'ccblog') }}
    </div>
    <div class="follow_content-state2 text--charcoal">
      <i class="icon-x-charcoal icon--xsmall"></i>
      {{ __('Close', 'ccblog') }}
    </div>
  </div>
</div>