<?php
/**
 * Template Name: Pods - Publications - index
 * Description: The template used for lists of publications
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<?php
  /* URI: TBD */
  $pod_slug = get_post_meta($post->ID, 'pod_slug', true);
  error_log('fetching publications_list Pod with slug: ' . $pod_slug);
  $pod = new Pod('publications_list', $pod_slug);
  $pod_title = $pod->get_field('name');
  $pod_featured_publication = $pod->get_field('featured_publication');
  $pod_publications = $pod->get_field('publications');
?>

<?php get_header(); ?>

<!--

featured_publication:

<?php
var_export($pod_featured_publication);
?>

publications:

<?php
var_export($pod_publications);
?>
-->

<div role="main row">
<header class="entry-header twelvecol last">
		<h1 class="entry-title"><?php echo $pod_title; ?></h1>
</header><!-- .entry-header -->
  
<article id="post-<?php the_ID(); ?>" <?php post_class('ninecol'); ?>>
	<div class="entry-content">
		<?php the_content(); ?>

    <?php if(!empty($pod_featured_publication)) : ?>
      <div class="featured-publication">
        <a href="<?php echo $PODS_BASEURI_ARTICLES . '/' . $pod_featured_publication[0]['slug']; ?>">
          <h3><?php echo $pod_featured_publication[0]['name']; ?></h3>
          <img src="<?php echo $pod_featured_publication[0]['cover'][0]['guid'] ; ?>" />
        </a>
      </div>
    <?php endif ; ?>
    
    <?php if(!empty($pod_publications)) : ?>
      <div>
          <ul>
            <?php foreach($pod_publications as $key => $p) : ?>
              <li class='fourcol<?php if((($key + 1) % 3) == 0) : ?> last<?php endif ; ?>'>
                <a href="<?php echo $PODS_BASEURI_ARTICLES . '/' . $p['slug']; ?>">
                  <?php echo $p['name']; ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    <?php endif ?>    
        
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
<aside class='threecol last'>
&#160;
</aside>
</div><!-- .main.row -->


<?php get_sidebar(); ?>

<?php get_footer(); ?>
