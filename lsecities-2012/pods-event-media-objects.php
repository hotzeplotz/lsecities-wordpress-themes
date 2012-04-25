<?php
/**
 * Template Name: Pods - Media Objects for Event (CVS)
 * Description: List all media objects associated with an event to sync to YouTube
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<?php
  /* URI: TBD */
  $TRACE_PODS_EVENT_MEDIA_OBJECTS = true;
  $TRACE_PREFIX = 'pods-event-media-objects.php -- ';
  $pod_slug = get_post_meta($post->ID, 'pod_slug', true);
  if($TRACE_PODS_EVENT_MEDIA_OBJECTS) { error_log($TRACE_PREFIX . 'pod_slug: ' . var_export($pod_slug, true)); }
  $pod = new Pod('event_programme', $pod_slug);
  $subsessions = $pod->get_field('sessions.slug');
  if(count($subsessions) == 1) { $subsessions = array(0 => $subsessions); }
  
  $for_conference = $pod->get_field('for_conference.slug');
  $for_event = $pod->get_field('for_event.slug');
   
  if($TRACE_PODS_EVENT_MEDIA_OBJECTS) { error_log($TRACE_PREFIX . 'sessions: ' . var_export($subsessions, true)); }
  
function process_session($session_slug) {
  global $TRACE_PODS_EVENT_MEDIA_OBJECTS;
   
  $pod = new Pod('event_session', $session_slug);

  $session_youtube_video = $pod->get_field('media_items.youtube_uri');
  $session_media_item_title = $pod->get_field('media_items.name');
  
  $subsessions = $pod->get_field('sessions.slug');
  if($subsessions and count($subsessions) == 1) { $subsessions = array(0 => $subsessions); }

  if($session_youtube_video and $session_media_item_title) {
    echo "$session_youtube_video|$session_media_item_title\n";
  }
  if($subsessions) {
    foreach($subsessions as $session) {
      process_session($session);
    }
  }
}

  if(!empty($pod->data)) {
    foreach($subsessions as $session) {
      process_session($session);
    }
  }
?>
