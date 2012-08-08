<?php

function people_list($people, $heading_singular, $heading_plural) {
  $output = '';
  $people_count = 0;
  $people_with_blurb_count = 0;
  
  if(is_array($people)) {
    if(count($people) > 1) {
      $output .= "<dt>$heading_plural</dt>\n";
    } else {
      $output .= "<dt>$heading_singular</dt>\n";
    }
    $output .= "<dd>\n";
    
    foreach($people as $person) {
      echo var_trace($person, 'people_list:$person', $TRACE_ENABLED);
      $people_count++;
      if($person['profile_text']) {
        $output .= '<a href="#person-profile-' . $person['slug'] . '">' . $person['name'] . ' ' . $person['family_name'] . "</a>, \n";
        $people_with_blurb_count++;
      } else {
        $output .= $person['name'] . '  ' . $person['family_name'] . ", \n";
      }
    }
    $output = substr($output, 0, -3);
    $output .= "</dd>\n";
  }
  
  return array('count' => $people_count, 'with_blurb' => $people_with_blurb_count, 'output' => $output, 'trace' => var_export($people, true));
}

function orgs_list($organizations) {
  $output = '';
  $org_count = count($organizations);
  
  end($organizations);
  $last_item = each($organizations);
  reset($organizations);
  
  foreach($organizations as $key => $org) {
    if($key == $last_item['key'] and $org_count > 1) {
      $output = substr($output, 0, -3);
      $output .= " and \n";
    }
    if($org['web_uri']) {
      $output .= '<a href=' . $org['web_uri'] . '>';
    }
    $output .= $org['name'];
    if($org['web_uri']) {
      $output .= '</a>';
    }
    $output .= ", \n";
  }
  $output = substr($output, 0, -3);
  
  return $output;
}


// check if we are getting called via Pods (pods_url_variable is set)
$pod_slug = pods_url_variable(3);

if($pod_slug) {
  $pod = new Pod('event', $pod_slug);
  $is_conference = false;
} else {
  $pod_slug = get_post_meta($post->ID, 'pod_slug', true);
  $pod = new Pod('conference', $pod_slug);
  $is_conference = true;
}

$META_last_modified = $pod->get_field('modified');

echo var_trace('pod_slug: ' . $pod_slug, $TRACE_PREFIX, $TRACE_ENABLED);

$button_links = $pod->get_field('links');

echo var_trace('button_links: ' . var_export($button_links, true), $TRACE_PREFIX, $TRACE_ENABLED);

$event_speakers = $pod->get_field('speakers', 'family_name ASC');
$event_respondents = $pod->get_field('respondents', 'family_name ASC');
$event_chairs = $pod->get_field('chairs', 'family_name ASC');
$event_moderators = $pod->get_field('moderators', 'family_name ASC');
$event_all_the_people = array_merge((array)$event_speakers, (array)$event_respondents, (array)$event_chairs, (array)$event_moderators);
echo var_trace($event_all_the_people, $TRACE_PREFIX, $TRACE_ENABLED);
$event_hashtag = ltrim($pod->get_field('hashtag'), '#');
$event_story_id = $pod->get_field('storify_id');

$speakers_output = people_list($event_speakers, "Speaker", "Speakers");
$respondents_output = people_list($event_respondents, "Respondent", "Respondents");
$chairs_output = people_list($event_chairs, "Chair", "Chairs");
$moderators_output = people_list($event_moderators, "Moderator", "Moderators");

$people_with_blurb = $speakers_output['with_blurb'] + $respondents_output['with_blurb'] + $chairs_output['with_blurb'] + $moderators_output['with_blurb'];

$event_blurb = honor_ssl_for_attachments(do_shortcode($pod->get_field('blurb')));
$event_blurb_after_event = honor_ssl_for_attachments(do_shortcode($pod->get_field('blurb_after_event')));
echo var_trace($event_blurb_after_event, $TRACE_PREFIX . 'blurb_after_event', $TRACE_ENABLED);
$event_contact_info = do_shortcode($pod->get_field('contact_info'));

$event_media = $pod->get_field('media_attachments');

$slider = $pod->get_field('slider');
if(!$slider) {
  $featured_image_uri = get_the_post_thumbnail(get_the_ID(), array(960,367));
}

// if this is an event, grab the image URI from the Pod
if(!$is_conference) {
  $featured_image_uri = honor_ssl_for_attachments($pod->get_field('heading_image.guid'));
  $attachment_ID = $pod->get_field('heading_image.ID');
  push_media_attribution($attachment_ID);
}

$event_date_start = new DateTime($pod->get_field('date_start'));
$event_date_end = new DateTime($pod->get_field('date_end'));
$event_dtstart = $event_date_start->format(DATE_ISO8601);
$event_dtend = $event_date_end->format(DATE_ISO8601);
// $event_date_string = $pod->get_field('date_freeform');
$event_date_string = $event_date_start->format("l j F Y | ");
$event_date_string .= '<time class="dt-start dtstart" itemprop="startDate" datetime="' . $event_dtstart . '">' . $event_date_start->format("H:i") . '</time>';
$event_date_string .=  '-' . '<time class="dt-end dtend" itemprop="endDate" datetime="' . $event_dtend . '">' . $event_date_end->format("H:i") . '</time>';
$datetime_now = new DateTime('now');
$is_future_event = ($event_date_start > $datetime_now) ? true : false;

$event_location = $pod->get_field('venue.name');
$eventseries = $pod->get_field('eventseries');

$event_type = $pod->get_field('event_type.name');
$event_series = $pod->get_field('event_series.name');
$event_host_organizations = orgs_list((array) $pod->get_field('hosted_by'));
$event_partner_organizations = orgs_list((array) $pod->get_field('partners'));

$event_info = '';
if($event_type) {
  $event_info .= '<em>' . ucfirst($event_type) . '</em> ';
} else {
  $event_info .= 'An event ';
}
if($event_series) {
  $event_info .= 'of the <em>' . $event_series . '</em> event series ';
}
if($event_host_organizations) {
  $event_info .= 'hosted by ' . $event_host_organizations . ' ';
} else {
  $event_info .= 'hosted by LSE Cities ';
}
if($event_partner_organizations) {
  $event_info .= 'in partnership with ' . $event_partner_organizations;
}

$poster_pdf = $pod->get_field('poster_pdf');
$poster_pdf = honor_ssl_for_attachments($poster_pdf[0]['guid']);
