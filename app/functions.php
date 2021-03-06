<?php

add_filter( 'nav_menu_link_attributes', 'alter_link_class', 10, 3 );
function alter_link_class( $atts, $item, $args ) {
  if( $args->theme_location == 'mainNav' ) {
    // add the desired attributes:
    if($item->current) {
      $class = 'inline-block text--blue border-bottom border--thin border--blue head-5';
    } else {
      $class = 'inline-block text--charcoal head-5';
    }
  } else if($args->theme_location == 'contextBarNav' || $args->theme_location == 'standardNav' || $args->theme_location == 'standardNavCollapsed' || $args->theme_location == 'mobileNav') {
    if($item->current) {
      $class = 'text--blue border-bottom border--thin border--blue';
    } else {
      $class = 'inline-block text--charcoal';
    }
  } else {
    $class = 'text--blue';
  }

  $atts['class'] = $class;
  return $atts;
}

add_filter( 'nav_menu_submenu_css_class', 'submenu_classes', 10, 4 );
function submenu_classes( $classes, $args ) {
  if($args->theme_location === 'standardNavCollapsed' || $args->theme_location === 'mobileNav'){
    $classes[] = 'width-100 relative';
  } else {
    $classes[] = 'width-100 absolute margin-left-xxlarge margin-top-xsmall bg-white border-all border--gray-dark border--thin shadow radius arrow--medium arrow-top-middle z-low padding-vert-medium animate-fade-hidden';
  }
  return $classes;
}

add_filter('nav_menu_css_class','alter_item_classes',1,3);
function alter_item_classes($classes, $item, $args) {
  if( $args->theme_location == 'mainNav' ) {
    $classes[] = 'block medium-up-inline-block padding-small';
  } else if($args->theme_location == 'contextBarNav' || $args->theme_location == 'standardNav') {
    $classes[] = 'inline-block padding-vert-xsmall padding-horz-small';
  } else if($args->theme_location == 'standardNavCollapsed') {
    $classes[] = 'block padding-vert-xsmall padding-horz-xlarge';
  } else if($args->theme_location == 'mobileNav') {
    $classes[] = 'block padding-vert-xsmall padding-right-small';
  } else {
    $classes[] = 'margin-bottom-xsmall';
  }
  /*if(in_array('menu-item-has-children', $classes)){
    $classes[] = 'icon--right icon-chevron-down icon--xsmall padding-right-xlarge';
  }*/

  return $classes;
}

function get_menu_by_location( $location ) {
  if( empty($location) ) return false;

  $locations = get_nav_menu_locations();
  if( ! isset( $locations[$location] ) ) return false;

  $menu_obj = get_term( $locations[$location], 'nav_menu' );

  return $menu_obj;
}

function cc_get_reading_time() {
  $wps       = 200;
  $content   = apply_filters('the_content', get_post_field('post_content', get_queried_object_id()));
  $num_words = str_word_count(strip_tags($content));
  $time      = round($num_words / $wps);
  if ($time < 1) {
    $estimated_time = "Less than a minute";
  } else {
    $estimated_time = $time . " minute";
  }
  return $estimated_time;
}


/**
 * Function to display date using a short code
 * @param $attr
 * @return string
 */

add_shortcode('course_date', function ( $attr ) {
  $defaultDate = 'TBA';
  if(empty($attr) || empty($attr['id']) )
  {
    return $defaultDate;
  }

  $cacheId = 'cc_course_'. $attr['id'];
  $date = get_transient($cacheId);
  if($date) return $date;

  // Query the api
  $date = 'TBA';
  $apiResponse = wp_remote_get('https://www.class-central.com/maestro/course/'. $attr['id']);
  if( !$apiResponse|| $apiResponse['response']['code'] != 200 ) {
    $date = 'TBA';
  }
  else
  {
    // Check if the response is valid
    $response = json_decode($apiResponse['body'],true);
    if( empty($response['success'])) {
      $date = $defaultDate;
    } else
    {
      $date = $response['message']['displayDate'];
    }
  }
  set_transient( $cacheId, $date, DAY_IN_SECONDS);
  return $date;
});

add_shortcode('btn_go_to_class', function ($attr) {
  if( !isset($attr['url']))
  {
    return '';
  }
  $url = $attr['url'];
  return "<div class='course-register-button'><a class='register-button btn--large btn-blue head-3 text--bold line--medium'  style='margin: 0 auto' target='_blank' href='{$url}'>Go to Class</a></div>";
});

add_shortcode('btn_go_to', function ($attr) {
  if( !isset($attr['url']) && !isset($attr['text']) )
  {
    return '';
  }
  $url = $attr['url'];
  $text = $attr['text'];
  return "<div class='course-register-button'><a class='register-button btn--large btn-blue head-3 text--bold line--medium'  style='margin: 0 auto' target='_blank' href='{$url}'>$text</a></div>";
});


add_action( 'wp_print_styles', 'tj_deregister_yarpp_header_styles' );
function tj_deregister_yarpp_header_styles() {
  wp_dequeue_style('yarppWidgetCss');
  // Next line is required if the related.css is loaded in header when disabled in footer.
  wp_deregister_style('yarppRelatedCss');
}

add_action( 'wp_footer', 'tj_deregister_yarpp_footer_styles' );
function tj_deregister_yarpp_footer_styles() {
  wp_dequeue_style('yarppRelatedCss');
}

/* Remove tags from section headers */
function my_theme_archive_title( $title ) {
  if ( is_category() ) {
    $title = single_cat_title( '', false );
  } elseif ( is_tag() ) {
    $title = single_tag_title( '', false );
  } elseif ( is_author() ) {
    $title = get_the_author();
  } elseif ( is_post_type_archive() ) {
    $title = post_type_archive_title( '', false );
  } elseif ( is_tax() ) {
    $title = single_term_title( '', false );
  }

  return $title;
}

add_filter( 'get_the_archive_title', 'my_theme_archive_title' );

/* Add class to pagination links */
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
  return 'class="text--blue head-5 text--bold"';
}