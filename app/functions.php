<?php

add_filter( 'nav_menu_link_attributes', 'alter_link_class', 10, 3 );
function alter_link_class( $atts, $item, $args ) {
  $class = 'text--blue'; // or something based on $item
  $atts['class'] = $class;
  return $atts;
}

add_filter('nav_menu_css_class','alter_item_classes',1,3);

function alter_item_classes($classes, $item, $args) {
  $classes[] = 'margin-bottom-xsmall';
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