<?php
/**
 * Template Name: Pods - Event programme
 * Description: The template used for event programmes
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<?php
  /* URI: TBD */
  $TRACE_PODS_EVENT_PROGRAMME = true;
  $TRACE_PREFIX = 'pods-event-programme.php -- ';
  $pod_slug = get_post_meta($post->ID, 'pod_slug', true);
  if($TRACE_PODS_EVENT_PROGRAMME) { error_log($TRACE_PREFIX . 'pod_slug: ' . var_export($publication_slug, true)); }
  $pod = new Pod('event_programme', $pod_slug);
  $pod_title = $pod->get_field('name');
  if($TRACE_PODS_EVENT_PROGRAMME) { error_log($TRACE_PREFIX . 'title: ' . var_export($pod_title, true)); }
  $pod_subtitle = $pod->get_field('programme_subtitle');
  if($TRACE_PODS_EVENT_PROGRAMME) { error_log($TRACE_PREFIX . 'subtitle: ' . var_export($subtitle, true)); }
  $subsessions = $pod->get_field('sessions.slug');
  if(count($subsessions) == 1) { $subsessions = array(0 => $subsessions); }
  if($TRACE_PODS_EVENT_PROGRAMME) { error_log($TRACE_PREFIX . 'sessions: ' . var_export($subsessions, true)); }
  
function process_session($session_slug) {
  $pod = new Pod('event_session', $session_slug);
  $session_title = $pod->get_field('name');
  $session_subtitle = $pod->get_field('session_subtitle');
  $hide_title = $pod->get_field('hide_title');
  $session_type = $pod->get_field('session_type.name');
  $subsessions = $pod->get_field('sessions.slug');
  // if(count($subsessions) == 1) { $subsessions = array(0 => $subsessions); }
  if($TRACE_PODS_EVENT_PROGRAMME) { error_log($TRACE_PREFIX . 'sessions: ' . var_export($subsessions, true)); }
  echo "<div class='$session_type'>";
  if($session_title and !$hide_title) { echo "<h1>$session_title</h1>"; }
  if($session_subtitle and !$hide_title) { echo "<h2>$session_subtitle</h2>"; }
  foreach($subsessions as $session) {
    process_session($session);
  }
  echo "</div>";
}
?>

<?php get_header(); ?>

<div role="main" class="row">

<header class="entry-header ninecol">
  <h1 class="entry-title"><?php echo $pod_title; ?></h1>
  <?php if($pod_subtitle) : ?>
  <h2><?php echo $pod_subtitle; ?></h2>
  <?php endif ; ?>
</header><!-- .entry-header -->

<article id="post-<?php the_ID(); ?>" <?php post_class('ninecol'); ?>>
	<div class="entry-content">
		<?php the_content(); ?>

    <?php if(!empty($pod->data)) : ?>
      <div class="article row">
        <div class="ninecol">
          <?php
          foreach($subsessions as $session) {
            process_session($session);
          }
          ?>
        </div>
        <div class="threecol last">
          <div class="publication-cover">
          </div>
        </div>
      </div>
    <?php endif ?>    
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->

<?php get_template_part('nav'); ?>

</div><!-- role='main'.row -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
