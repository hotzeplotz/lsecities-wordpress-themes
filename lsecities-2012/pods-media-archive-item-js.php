<?php
/**
 * Template Name: Media Archive item (JSON)
 * Description: The template used to return a JSON view of a Media Archive object's metadata
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?><?php
/**
 * Pods initialization
 * URI: /media/search/?search=<search_string>
 */
$search = get_post_meta($post->ID, 'pod_slug', true) || pods_url_variable('search', 'get');
$TRACE_ENABLED = is_user_logged_in();
$PODS_BASEURI_MEDIA_ARCHIVE_SEARCH = '/media/search/';

if($TRACE_ENABLED) { error_log('pod_slug: ' . $pod_slug); }
$pod = new Pod('media_item');
$params = Array();
$params['where'] = 't.name LIKE "%' . $search . '%"';
$pod->findRecords($params);

$media_item = Array();

$media_item['id'] = $pod->get_field('slug');
$media_item['title'] = $pod->get_field('name');
$media_item['date'] = $pod->get_field('date');
$media_item['youtube_uri'] = $pod->get_field('youtube_uri');
$media_item['video_uri'] = $pod->get_field('video_uri');
$media_item['audio_uri'] = $pod->get_field('audio_uri');
$media_item['presentation_uri'] = $pod->get_field('presentation_uri');
$media_item['tags'] = $pod->get_field('tag.name');
$media_item['geotags'] = $pod->get_field('geotags.name');

echo json_encode($media_item);
?>
