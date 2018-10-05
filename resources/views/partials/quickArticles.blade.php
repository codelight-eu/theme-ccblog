@php
  $args = array('posts_per_page'=>3, 'category_name' => 'MOOCWatch');
  $posts = new WP_Query( $args );
@endphp
  <ul class="quickArticles head-5">
    @if ( $posts->have_posts() )
      @while ($posts->have_posts()) @php($posts->the_post())
      <li class="quickArcicles_item row margin-top-medium">
        @if(get_the_post_thumbnail() || get_field('set_cropped_illustration'))
          <div class="quickArcicles_image width-1-3 flush-left margin-right-small hidden medium-up-block">
            <a class="text--charcoal" href="{{ get_permalink() }}">
              @if(get_field('set_cropped_illustration'))
                <img class='width-100 height-100 block border-all' src="{{ get_field('set_cropped_illustration')['sizes']['thumbnail'] }}" alt="">
              @elseif(get_the_post_thumbnail())
                {!! the_post_thumbnail('small', ['class' => 'width-100 height-100 block border-all']) !!}
              @endif
            </a>
          </div>
        @endif
        <div class="quickArticle_content overflow-hidden margin-top-xxsmall">
          <a class="block text--charcoal" href="{{ get_permalink() }}">{{ the_date('F Y') }}
            @if(get_field('sidebar_settings')['set_section_title'] == 'title_moocwatch')
              @if(get_field('sidebar_settings')['moocwatch_no'])<i class="dot margin-bottom-xxsmall"></i> {{ __('No.', 'ccblog') }} {{ get_field('sidebar_settings')['moocwatch_no'] }}@endif
            @endif
          </a>
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