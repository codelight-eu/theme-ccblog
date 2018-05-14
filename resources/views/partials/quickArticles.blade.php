@php
  $args=array('posts_per_page'=>3, 'tag' => 'MOOCWatch');
  $posts = new WP_Query( $args );
@endphp
  <ul class="quickArticles head-5">
    @if ( $posts->have_posts() )
      @while ($posts->have_posts()) @php($posts->the_post())
      <li class="quickArcicles_item row margin-top-medium">
        @if(get_the_post_thumbnail())
          <div class="quickArcicles_image width-1-3 flush-left margin-right-small hidden medium-up-block">
            <a class="text--charcoal" href="{{ get_permalink() }}">
              {!! the_post_thumbnail('small', ['class' => 'width-100 height-100 block border-all']) !!}
            </a>
          </div>
        @endif
        <div class="quickArticle_content overflow-hidden margin-top-xxsmall">
          <a class="block text--charcoal" href="{{ get_permalink() }}">{{ the_date('F Y') }}</a>
          <a class="text--bold head-5 text--charcoal" href="{{ get_permalink() }}">
            @if(get_field('sidebar_settings')['short_title'])
              {!! get_field('sidebar_settings')['short_title'] !!}
            @else
              {{ the_title() }}
            @endif
          </a>
        </div>
      </li>
      @endwhile
    @endif
  </ul>
@php
  $posts = null;
  wp_reset_postdata();
@endphp