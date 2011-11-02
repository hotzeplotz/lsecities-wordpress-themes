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
  $featured_image_uri = get_the_post_thumbnail(get_the_ID(), array(960,367));
}
?>

<?php get_header(); ?>

<div role="main">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php echo $pod->get_field('name'); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
    <div class='row' id='core'>
      <article class='ninecol'>
        <div class='row'>
          <div class='slider spaceAfter eightcol' id='slider'>
            <?php echo $featured_image_uri; ?>
          </div>
          <aside class='extras fourcol last'>
          <?php echo do_shortcode($pod->get_field('info')); ?>
          </aside>
        </div>
        <div class='introblurb'>
        <?php
          $tagline = $pod->get_field('tagline');
          if($tagline) : ?>
            <h2><?php echo $tagline; ?></h2>
        <?php endif; ?>
          <?php echo do_shortcode($pod->get_field('abstract')); ?>
        </div>
        <?php foreach($button_links as $key => $link) : ?>
          <?php if(($key  % 3) == 0) : ?>
            <div class='featureboxes row'>
          <?php endif; ?>          
          <?php error_log('link key: ' . $key); ?>
          <div class='featurebox fourcol<?php if((($key + 1) % 3) == 0) : ?> last<?php endif ; ?>'>
            <a href="<?php echo $link['guid'] ; ?>" title="<?php echo $link['post_title'] ; ?>">
              <h3><?php echo $link['post_title'] ; ?></h3>
            </a>
          </div>
          <?php if((($key + 1) % 3) == 0 or $key == (count($button_links) - 1)) : ?>
            </div>
          <?php endif; ?>
        <?php endforeach ; ?>
        <div id="the_content">
        <?php the_content(); ?>
        </div>
      </article>
      <aside class='threecol last'>
        <?php get_template_part( 'nav', 'conferences' ); ?>
      </aside>
    </div>
    
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<div class="entry-meta">
    <div id="author-info">
      <?php if(is_array($article_authors)): ?>
        <h2>Authors</h2>
        <ul>
        <?php foreach($article_authors as $a): ?>
          <li><?php echo $a['name'] ?> <?php echo $a['family_name'] ?></li>
        <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
