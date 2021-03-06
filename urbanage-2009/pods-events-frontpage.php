<?php
/**
 * Template Name: Pods - Event/Conference
 * Description: The template used for Event and for Conference Pods
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<?php
/**
 * Pods initialization
 * URI: /media/objects/events/
 */
global $pods;
$TRACE_PODS_EVENTS_FRONTPAGE = true;

// check if we are getting called via Pods (pods_url_variable is set)
$pod_slug = pods_url_variable(3);

if($pod_slug) {
  $pod = new Pod('event', $pod_slug);
} else {
  $pod_slug = get_post_meta($post->ID, 'pod_slug', true);
  $pod = new Pod('conference', $pod_slug);
}

if($TRACE_PODS_EVENTS_FRONTPAGE) { error_log('pod_slug: ' . $pod_slug); }

$button_links = $pod->get_field('links');

$slider = $pod->get_field('slider');
if(!$slider) {
  $featured_image_uri = get_the_post_thumbnail($post->ID, array(960,367));
}
?>

<?php get_header(); ?>

<div role="main">

<?php if ( have_posts() ) : the_post(); endif; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('ninecol'); ?>>
	<?php if(false) : ?>
	<header class="entry-header">
		<h1 class="entry-title"><?php echo $pod->get_field('name'); ?></h1>
	</header><!-- .entry-header -->
	<?php endif; ?>
	
	<div class="entry-content">
    <div id='core'>
      <article>
        <div class='slider spaceAfter' id='slider'>
            <?php echo $featured_image_uri; ?>
        </div>
        <div class='introblurb'>
        <?php
          $tagline = $pod->get_field('tagline');
          $conference_title = $pod->get_field('conference_title');
          if($tagline) : ?>
            <h1><?php echo $tagline; ?></h1>
        <?php endif;
		  if($conference_title): ?>
		    <h2><?php echo $conference_title; ?></h2>
        <?php endif; ?>
          <?php echo do_shortcode($pod->get_field('blurb')); ?>
        </div>
        <?php
        // sort by menu_order of linked items
        foreach($button_links as $sort_key => $sort_value) {
			$menu_order[$sort_key] = $sort_value['menu_order'];
		}
		array_multisort($menu_order, SORT_ASC, $button_links);
        ?>
        <?php if($TRACE_PODS_EVENTS_FRONTPAGE) { echo '<!-- button_links: ' . var_export($button_links, true) . '-->'; } ?>
        <?php foreach($button_links as $key => $link) : ?>
          <?php if($TRACE_PODS_EVENTS_FRONTPAGE) { echo '<!-- link: ' . var_export($link, true) . '-->'; } ?>
          <?php if(($key  % 3) == 0) : ?>
            <div class='featureboxes clearfix'>
          <?php endif; ?>          
          <?php error_log('link key: ' . $key); ?>
          <div class='featurebox fourcol<?php if((($key + 1) % 3) == 0) : ?> last<?php endif ; ?>'>
            <h3>
			  <a href="<?php echo preg_replace('/^http:\/\/.*?\//', 'http://urban-age.net/', get_permalink($link['ID'])); ?>" title="<?php echo $link['post_title'] ; ?>">
              <?php echo $link['post_title'] ; ?></a>
            </h3>
          </div>
          <?php if((($key + 1) % 3) == 0 or $key == (count($button_links) - 1)) : ?>
            </div>
          <?php endif; ?>
        <?php endforeach ; ?>
        <div id="the_content">
        <?php the_content(); ?>
        </div>
      </article>
    </div>
    
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<div class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
<aside id="level3nav" class='threecol last'>
  <?php get_template_part( 'nav', 'conferences' ); ?>
</aside>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
