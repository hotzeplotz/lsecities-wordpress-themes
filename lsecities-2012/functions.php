<?php

/* LSE Cities Twenty Twelve functions and constant definitions */
define(PODS_BASEURI_ARTICLES, '/media/objects/articles');
define(PODS_BASEURI_CONFERENCES, '/media/objects/conferences');
define(PODS_BASEURI_EVENTS, '/media/objects/events');
define(PODS_BASEURI_RESEARCH_PROJECTS, '/objects/research-projects');

/* deal with WP's insane URI (mis)management - example from
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/wp_get_attachment_url */
add_filter('wp_get_attachment_url', 'honor_ssl_for_attachments');
add_filter( 'the_content', 'honor_ssl_for_attachments' );
function honor_ssl_for_attachments($url) {
	$http = site_url(FALSE, 'http');
	$https = site_url(FALSE, 'https');
	if($_SERVER['HTTPS'] == 'on') {
    return str_ireplace($http, $https, $url);
  }
  else {
    return str_ireplace($https, $http, $url);
  }
}

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

/*  Returns the first $wordsreturned out of $string.  If string
contains fewer words than $wordsreturned, the entire string
is returned.
*/

function shorten_string($string, $wordsreturned) {
  $retval = $string;      //  Just in case of a problem
  $array = explode(" ", $string);
  if (count($array)<=$wordsreturned) { // Already short enough, return the whole thing
    $retval = $string;
  } else { //  Need to chop some words
    array_splice($array, $wordsreturned);
    $retval = implode(" ", $array);
  }
  return $retval;
}

// from http://webcheatsheet.com/php/get_current_page_url.php
function get_current_page_URI() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}


/* attribution and license metadata support for media library
 * thanks to jvelez (http://stackoverflow.com/questions/11475741/word-press-saving-custom-field-to-database)
 * 
 * To learn more: 
 * http://net.tutsplus.com/tutorials/wordpress/creating-custom-fields-for-attachments-in-wordpress/
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/attachment_fields_to_save
 * 
 * Weird Wordpress convention : Fields prefixed with an underscore 
 * (_RevisionDate) will not be listed in the drop down of available custom fields on the post/page screen;
 * We only need the custom fields in the media library page
 */
function get_media_library_item_custom_form_fields($form_fields, $post) {
  $form_fields['attribution_name'] = array(
    'label' => 'Author',
    'input' => 'text',
    'value' => get_post_meta($post->ID, '_attribution_name', true),
    'helps' => 'Media author (or rights holder)'
  );
  
  $form_fields['attribution_uri'] = array(
    'label' => 'URI of original work',
    'input' => 'text',
    'value' => get_post_meta($post->ID, '_attribution_uri', true),
    'helps' => 'Link to original work for attribution purposes'
  );
  
  return $form_fields;
}

add_filter('attachment_fields_to_edit', "get_media_library_item_custom_form_fields", null, 2);  

function save_media_library_item_custom_form_fields($post, $attachment) {
  if(isset($attachment['attribution_name'])) {
    update_post_meta($post['ID'], '_attribution_name', $attachment['attribution_name']);  
  }
  if(isset($attachment['attribution_uri'])) {
    update_post_meta($post['ID'], '_attribution_uri', $attachment['attribution_uri']);  
  }
}

add_filter('attachment_fields_to_save','save_media_library_item_custom_form_fields', null, 2);

function push_media_attribution($attachment_ID) {
  $attachment_metadata = wp_get_attachment_metadata($attachment_ID);
  echo var_trace($attachment_metadata, $TRACE_PREFIX . ': attachment_metadata', $TRACE_ENABLED);
  $attribution_uri = get_post_meta($attachment_ID, '_attribution_uri', true);
  $attribution_name = get_post_meta($attachment_ID, '_attribution_name', true);
  array_push($GLOBALS['META_media_attributions'], array(
    'title' => get_the_title($attachment_ID),
    'attribution_uri' => $attribution_uri,
    'author' => $attribution_name,
  ));
}
