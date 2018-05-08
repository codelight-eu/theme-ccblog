@php
  $args=array('posts_per_page'=>3, 'tag' => 'MOOCWatch');
  $posts = new WP_Query( $args );
  $tag = get_term_by('name', 'MOOCWatch', 'post_tag');
@endphp
<ul class="quickArcicles text-left">
  <li data-toggle-link>
    <a href="#"
       class="quickArticles_Toggle hidden medium-up-inline-block xlarge-hidden padding-vert-xxsmall padding-left-xsmall">
      <span class="inline-block text--charcoal text-1">
        <i class="symbol-moocwatch-charcoal symbol--small"></i> <i
            class="hidden medium-up-inline-block icon--xsmall icon-chevron-down"></i>
      </span>
    </a>
    <ul class="quickArticles_content animate-fade-hidden width-100 absolute margin-left-xxlarge margin-top-xsmall bg-white border-all border--gray-dark border--thin shadow radius arrow--medium arrow-top-middle z-high"
        data-toggle-item>
      @if ( $posts->have_posts() )
        @while ($posts->have_posts()) @php($posts->the_post())
        <li class="quickArcicles_item row margin-top-medium padding-horz-large">
          @if(get_the_post_thumbnail())
            <div class="quickArcicles_image width-1-3 flush-left margin-right-small">
              <a class="text--charcoal" href="{{ get_permalink() }}">
                {!! the_post_thumbnail('small', ['class' => 'width-100 height-100 block border-all']) !!}
              </a>
            </div>
          @endif
          <div class="quickArticle_content overflow-hidden margin-top-xxsmall">
            <p>{{ the_date('F Y') }}</p>
            <div class="text--bold head-5">
            @if(get_field('short_title'))
              {!! get_field('short_title') !!}
            @else
              {{ the_title() }}
            @endif
            </div>
          </div>
        </li>
        @endwhile
      @endif
      <li class="border-top border--gray-dark border--thin margin-top-medium padding-vert-small padding-horz-medium row">
        <a href="{{ get_tag_link($tag->term_id) }}" class="btn-white head-5 text--bold text--blue flush-right">{{ __('More', 'ccblog') }}<i class="icon-arrow-right-blue icon--small"></i></a>
      </li>
    </ul>
  </li>
</ul>
@php
  $posts = null;
  wp_reset_postdata();
@endphp