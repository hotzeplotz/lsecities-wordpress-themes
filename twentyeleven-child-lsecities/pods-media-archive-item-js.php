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
 * URI: /media/objects/mediaitem
 */
$pod_slug = get_post_meta($post->ID, 'pod_slug', true);
$TRACE_PODS_MEDIA_ARCHIVE_ITEM_JS = true;

if($TRACE_PODS_MEDIA_ARCHIVE_ITEM_JS) { error_log('pod_slug: ' . $pod_slug); }
$pod = new Pod('media_item', $pod_slug);

echo json_encode($pod);
?>
