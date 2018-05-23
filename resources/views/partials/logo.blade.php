@php
  if(!isset($isContext)){
    $isContext = false;
  }
@endphp
<div class="logo flush-left row @if($isContext) margin-top-xsmall @endif">
  <a
      class="logo_link head-4 block text--blue-bright"
      href="{{ home_url('/') }}"
      data-responsive='{"xxlargeUp": "head-2"}'>
    <i class="symbol-moocreport-blue symbol--small large-up-symbol--large"></i>
  </a>
  @if(!$isContext)
  <div class="logo_console block head-6 flush-right text--gray">by<i
        class="symbol-classcentral-gray symbol--xsmall medium-up-symbol--small"></i></div>
  @endif
</div>