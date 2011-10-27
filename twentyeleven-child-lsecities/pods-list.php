<?php
/**
 * Template Name: Pods - List - index
 * Description: The template used for lists of items
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<?php
  /* URI: TBD */
  $pod_slug = get_post_meta($post->ID, 'pod_slug', true);
  error_log('fetching list Pod with slug: ' . $pod_slug);
  $pod = new Pod('list', $pod_slug);
  $pod_type = $pod->get_field('pod_type');
  $pod_title = $pod->get_field('name');
  $pod_featured_item = new Pod($pod_type, get_post_meta($pod->get_field('featured_item.ID'), 'pod_slug'));
  $pod_list = $pod->get_field('list');
?>

<?php get_header(); ?>

<!--

featured_item:

<?php
var_export($pod_featured_item);
?>

list:

<?php
var_export($pod_list);
?>
-->

<div role="main row">
<header class="entry-header twelvecol last">
		<h1 class="entry-title"><?php echo $pod_title; ?></h1>
</header><!-- .entry-header -->
  
<article id="post-<?php the_ID(); ?>" <?php post_class('ninecol'); ?>>
	<div class="entry-content">
		<?php the_content(); ?>

    <?php if(!empty($pod_featured_item)) : ?>
      <div class="featured-item">
        <a href="<?php echo $PODS_BASEURI_ARTICLES . '/' . $pod_featured_item[0]['slug']; ?>">
          <h3><?php echo $pod_featured_item[0]['name']; ?></h3>
          <img src="<?php echo $pod_featured_item[0]['cover'][0]['guid'] ; ?>" />
        </a>
      </div>
    <?php endif ; ?>
    
    <?php if(!empty($pod_list)) : ?>
      <div>
          <ul>
            <?php foreach($pod_list as $key => $item) : ?>
              <li class='fourcol<?php if((($key + 1) % 3) == 0) : ?> last<?php endif ; ?>'>
                <a href="<?php echo $PODS_BASEURI_ARTICLES . '/' . $item['slug']; ?>">
                  <?php echo $item['name']; ?>
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
