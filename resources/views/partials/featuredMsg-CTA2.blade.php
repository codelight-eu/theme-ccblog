<div class="CTA bg-gradient text--charcoal padding-vert-xxlarge hidden xlarge-up-block padding-horz-medium">
  <div class="max-width-xl width-centered padding-mediumpadding-vert-small flex-horz-middle">
    <div class="head-2 col width-4-16"><i class="symbol-classcentral-blue symbol--large"></i></div>
    <div class="CTA_text col width-9-16 head-2 padding-right-medium padding-left-xlarge margin-vert-xlarge">
      {!! get_field('call_to_action', 'option')['CTA_2_text'] !!}
    </div>
    <div class="CTA_links text-right col width-3-16 inline-block row">
      <a
        href="{{ get_field('call_to_action', 'option')['CTA_2_sign-up_link']['url'] }}"
        target="{{ get_field('call_to_action', 'option')['CTA_2_sign-up_link']['target'] }}"
        class="CTA_link head-3 text--bold line--medium"
      >
        {{ get_field('call_to_action', 'option')['CTA_2_sign-up_link']['title'] }}
      </a>
    </div>
  </div>
</div>