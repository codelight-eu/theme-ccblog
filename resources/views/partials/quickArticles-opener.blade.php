@php
  $tag = get_term_by('name', 'MOOCWatch', 'post_tag');
@endphp
<div data-toggle-container>
  <span
    class="quickArticles_toggle cursor-pointer hidden medium-up-inline-block xlarge-hidden padding-vert-xxsmall padding-left-xsmall">
    <span class="inline-block text--charcoal text-1" data-toggle-link>
      <i class="symbol-moocwatch-charcoal symbol--small"></i> <i
        class="hidden medium-up-inline-block icon--xsmall icon-chevron-down"></i>
    </span>
  </span>
  <div
    class="animate-fade-hidden width-100 absolute margin-left-xxlarge margin-top-xsmall bg-white border-all border--gray-dark border--thin shadow radius arrow--medium arrow-top-middle z-low"
    data-toggle-item data-toggle-setCenter>
    <div class="padding-horz-large">
      @include('partials.quickArticles')
    </div>
    <div class="border-top border--gray-dark border--thin margin-top-medium padding-vert-small padding-horz-medium row">
      <a href="{{ get_tag_link($tag->term_id) }}"
         class="btn-white head-5 text--bold text--blue flush-right">{{ __('More', 'ccblog') }}<i class="icon-arrow-right-blue icon--small"></i></a>
    </div>
  </div>
</div>