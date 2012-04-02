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
