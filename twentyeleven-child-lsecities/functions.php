<?php

/* LSE Cities Twenty Eleven functions and variable definitions */

$PODS_BASEURI_ARTICLES = '/media/objects/articles';

function var_trace($var, $prefix = 'pods', $enabled = true, $destination = 'page') {
  if($enabled) {
    $output_string = "tracing $prefix : " . var_export($var, true) . "\n\n";
    
    if($destination == 'page') {
      return "<!-- $output_string -->";
    } elseif($destination == 'syslog') {
      error_log($output_string);
    }
  }
}

function check_parent_conference($post_id) {
  global $post;
  $current_post_id = $post->ID;
  echo var_trace('current_post_id: ' . $current_post_id, $TRACE_PREFIX, $TRACE_ENABLED);
  if($current_post_id == $post_id or in_array($post_id, get_post_ancestors($current_post_id))) {
    return true;
  } else {
    return false;
  }
}
