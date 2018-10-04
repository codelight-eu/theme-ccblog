@php
  $page = '';
  $chevron = "<i class='icon-chevron-right-gray icon--xxsmall'></i>";
  if(is_author()):
    $page .= __('Authors', 'ccblog') . $chevron . \App\App::title();
  elseif(is_tag()):
    $page .= __('Tags', 'ccblog') . $chevron . \App\App::title();
  elseif(is_category()):
    $page .= \App\App::title();
  else:
    $page .= \App\App::title();
  endif;

@endphp

<div class="breadcrumbs text-3 text--gray padding-horz-medium medium-up-padding-horz-small margin-top-large">
  {{ __('MOOC Report', 'ccblog') }} {!! $chevron . $page !!}
</div>