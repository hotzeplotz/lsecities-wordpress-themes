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
  $publication_slug = get_post_meta($post->ID, 'pod_slug', true);
  error_log('pod_slug: ' . $publication_slug);
  $pod = new Pod('event_programme', $programme_slug);
  $pod_title = $pod->get_field('name');
  $pod_subtitle = $pod->get_field('programme_subtitle');
  $subsections = $pod->get_field('sessions.name');
  if($TRACE_PODS_EVENT_PROGRAMME) { error_log(var_export($subsections, true)); }
  
function process_section($section_slug) {
  $pod = new Pod('event_section', $section_slug);
  $section_title = $pod->get_field('name');
  $section_subtitle = $pod->get_field('section_subtitle');
  $section_type = $pod->get_field('section_type.name');
  echo "<div class='$section_type'>";
  if($section_title) { echo "<h1>$section_title</h1>"; }
  if($section_subtitle) { echo "<h2>$section_subtitle</h2>"; }
  foreach($section_subsections as $subsection) {
    process_section($subsection['slug']);
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
          foreach($subsections as $subsection) {
            process_section($section_slug);
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
