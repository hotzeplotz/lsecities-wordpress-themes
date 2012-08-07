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
function GetMediaLibraryItemCustomFormFields($form_fields, $post) {
  $form_fields['AttributionName'] = array(
    'label' => 'Author',
    'input' => 'text',
    'value' => get_post_meta($post->ID, '_AttributionName', true),
    'helps' => 'Media author (or rights holder)'
  );
  
  $form_fields['AttributionURI'] = array(
    'label' => 'URI of original work',
    'input' => 'text',
    'value' => get_post_meta($post->ID, '_AttributionURI', true),
    'helps' => 'Link to original work for attribution purposes'
  );
  
  return $form_fields;
}

add_filter('attachment_fields_to_edit', "GetMediaLibraryItemCustomFormFields", null, 2);  

function SaveMediaLibraryItemFormFields($post, $attachment) {
  if(isset($attachment['AttributionName'])) {
    update_post_meta($post['ID'], '_AttributionName', $attachment['AttributionName']);  
  }
  if(isset($attachment['AttributionURI'])) {
    update_post_meta($post['ID'], '_AttributionURI', $attachment['AttributionURI']);  
  }
}

add_filter('attachment_fields_to_save','SaveMediaLibraryItemFormFields', null, 2);
