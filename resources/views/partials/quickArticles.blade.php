@php
  $args=array('posts_per_page'=>3, 'tag' => 'MOOCWatch');
  $posts = new WP_Query( $args );
@endphp
<div class="quickArcicles text-left">
  <a href="#"
     class="quickArticles_Toggle hidden medium-up-inline-block xlarge-hidden padding-vert-xxsmall padding-left-xsmall">
    <span class="inline-block text--charcoal text-1">
      <i class="symbol-moocwatch-charcoal symbol--small"></i> <i
          class="hidden medium-up-inline-block icon--xsmall icon-chevron-down"></i>
    </span>
  </a>
  <div class="quickArticles_content hidden absolute margin-top-large bg-white padding-vert-medium padding-horz-large shadow radius">
    @if ( $posts->have_posts() )
    @while ($posts->have_posts()) @php($posts->the_post())
    <div class="quickArcicles_item row">
      @if(get_the_post_thumbnail())
        <div class="quickArcicles_image width-1-3 flush-left margin-right-xxsmall">
          <a class="text--charcoal" href="{{ get_permalink() }}">
            {!! the_post_thumbnail('small', ['class' => 'width-100 height-100 block border-all']) !!}
          </a>
        </div>
      @endif
      {{ the_title() }}
    </div>
    @endwhile
    @endif
  </div>
</div>
@php
  $posts = null;
  wp_reset_postdata();
@endphp