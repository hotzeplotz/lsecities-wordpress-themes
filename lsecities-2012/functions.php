<?php

/* LSE Cities Twenty Eleven functions and variable definitions */

$PODS_BASEURI_ARTICLES = '/media/objects/articles';

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


/* People lists -- begin */
define('MODE_FULL_LIST', 'full_list');
define('MODE_SUMMARY',  'summary');

function generate_list($list_id, $mode = MODE_FULL_LIST) {
  if($list_id == 'lsecities-staff') {
    $output .= generate_section('lsecities-staff-mgmt', 'Executive', $mode);
    $output .= generate_section('lsecities-staff', 'Centre staff', $mode);
  }
  
  return $output;
}

function generate_section($section_slug, $section_heading = false, $mode = MODE_FULL_LIST) {
  $pod = new Pod('people_group', $section_slug);
  $people = (array)$pod->get_field('members', 'family_name ASC');
  global $people_in_output_full, $people_in_output_summary;
  echo var_trace('group_members: ' . var_export($people, true), $TRACE_PREFIX, true);
  $output = "<section class='people-list $section_slug'>";
  $output .= "<h1>$section_heading</h1>";
  $output .= "<ul>";
  foreach($people as $person) {
    $display_after = new DateTime($person['display_after']);
    $display_until = new DateTime($person['display_until']);
    $datetime_now = new DateTime('now');
    echo var_trace('display_after: ' . var_export($display_after, true), $TRACE_PREFIX, true);
    echo var_trace('display_until: ' . var_export($display_until, true), $TRACE_PREFIX, true);
    echo var_trace('datetime_now: ' . var_export($datetime_now, true), $TRACE_PREFIX, true);
    if($display_after <= $datetime_now and $datetime_now <= $display_until) {
      if($mode == MODE_FULL_LIST) {
        if(!in_array($person['slug'], $people_in_output_full)) {
          array_push($people_in_output_full, $person['slug']);
          $output .= generate_person_profile($person['slug'], false, MODE_FULL_LIST);
        }
      } elseif ($mode == MODE_SUMMARY) {
        if(!in_array($person['slug'], $people_in_output_summary)) {
          array_push($people_in_output_summary, $person['slug']);
          $output .= generate_person_profile($person['slug'], false, MODE_SUMMARY);
        }
      }
    }
  }
  echo var_trace('people_in_output_full: ' . var_export($people_in_output_full, true), $TRACE_PREFIX, true);
  echo var_trace('people_in_output_summary: ' . var_export($people_in_output_summary, true), $TRACE_PREFIX, true);
  $output .= " </ul>";
  $output .= "</section>";
  return $output;
}

function generate_person_profile($slug, $extra_title, $mode = MODE_FULL_LIST) {
  $LEGACY_PHOTO_URI_PREFIX = 'http://v0.urban-age.net';
  $pod = new Pod('authors', $slug);
  $fullname = $pod->get_field('name') . ' ' . $pod->get_field('family_name');
  $fullname = trim($fullname);
  $fullname_for_heading = $fullname;
  if($extra_title) {
    $fullname_for_heading .= ' ' . $extra_title;
  }
  $qualifications_list = array_map(function($string) { return trim($string); }, explode("\n", $pod->get_field('qualifications')));
  $profile_photo_uri = $pod->get_field('photo.guid');
  $email_address = preg_replace('/\@/', ' [AT] ', $pod->get_field('email_address'));
  
  if(!$profile_photo_uri and $pod->get_field('photo_legacy')) {
    $profile_photo_uri = $LEGACY_PHOTO_URI_PREFIX . $pod->get_field('photo_legacy');
  }
  $blurb = $pod->get_field('staff_pages_blurb');
  $organization = $pod->get_field('organization');
  $role = $pod->get_field('role');
  if($role and $organization) {
    $affiliation = "<strong>$role</strong>" . ', ' . $organization;
  } elseif (!$role and $organization) {
    $affiliation = $organization;
  }
  
  if($mode == MODE_FULL_LIST) {
    $output = "<li class='person row' id='p-$slug'>";
    $output .= "  <div class='fourcol profile-photo'>";
    if($profile_photo_uri) {
      $output .= "    <img src='$profile_photo_uri' alt='$fullname - photo'/>";
    } else {
      $output .= "&nbsp;";
    }
    $output .= "  </div>";
    $output .= "  <div class='eightcol last'>";
    $output .= "    <h1>$fullname_for_heading</h1>";
    if($qualifications_list) {
      $output .= "<div class='qualifications'>";
      foreach($qualifications_list as $qualification) {
        $output .= "<span>$qualification</span> ";
      }
      $output = rtrim($output, ' ');
      $output .= "</div>";
    }  
    if($affiliation) {
      $output .= "  <p>$affiliation</p>";
    }
    if($email_address) {
      $output .= "  <p>$email_address</p>";
    }
    if($blurb) {
      $output .= "  $blurb";
    }
    $output .= "  </div>";
    $output .= "</li>";
  } elseif($mode == MODE_SUMMARY) {
    $output = "<li class='person row' id='p-$slug-link'>";
    $output .= "<a href='#p-$slug'>$fullname</a>";
    $output .= "</li>";
  }
  
  return $output;
}
/* People lists -- end */
