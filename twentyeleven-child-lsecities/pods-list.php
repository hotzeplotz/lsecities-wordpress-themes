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
  $TRACE_PODS_LIST = true;
  $pod_slug = get_post_meta($post->ID, 'pod_slug', true);
  $pod = new Pod('list', $pod_slug);
  $pod_type = $pod->get_field('pod_type.slug');
  if($TRACE_PODS_LIST) { error_log('fetching list Pod with slug: ' . $pod_slug . " and pod_type: " . $pod_type); }
  $pod_title = $pod->get_field('name');
  $page_id = $pod->get_field('featured_item.ID');
  if($TRACE_PODS_LIST) { error_log('slug for featured item: ' . get_post_meta($page_id, 'pod_slug', true)); }
  $pod_featured_item_permalink = get_permalink($page_id);
  $pod_featured_item_pod = new Pod($pod_type, get_post_meta($pod->get_field('featured_item.ID'), 'pod_slug', true));
  $pod_list = $pod->get_field('list');
?>

<?php get_header(); ?>

<!--

featured_item_permalink:

<?php
if($TRACE_PODS_LIST) { var_export($pod_featured_item_permalink); )
?>

list:

<?php
if($TRACE_PODS_LIST) { var_export($pod_list); }
?>
-->

<div role="main row">
<header class="entry-header twelvecol last">
		<h1 class="entry-title"><?php echo $pod_title; ?></h1>
</header><!-- .entry-header -->
  
<article id="post-<?php the_ID(); ?>" <?php post_class('ninecol'); ?>>
	<div class="entry-content">
		<?php the_content(); ?>

    <?php if(!empty($pod_featured_item_pod)) : ?>
      <div class="featured-item">
        <a href="<?php echo $pod_featured_item_permalink; ?>">
          <h3><?php echo $pod_featured_item_pod->get_field('name'); ?></h3>
          <img src="<?php echo $pod_featured_item_pod->get_field('cover.guid') ; ?>" />
        </a>
      </div>
    <?php endif ; ?>
    
    <?php if(!empty($pod_list)) : ?>
      <div>
          <ul>
            <?php foreach($pod_list as $key => $item) : 
              $item_pod = new Pod($pod_type, get_post_meta($item['ID'], 'pod_slug', true);
            ?>
              <li class='fourcol<?php if((($key + 1) % 3) == 0) : ?> last<?php endif ; ?>'>
                <p>
                  <a href="<?php echo get_permalink($item['ID']); ?>">
                    <?php echo $item_pod->get_field('name'); ?>
                  </a>
                </p>
                <p>
                  <a href="<?php echo get_permalink($item['ID']); ?>">
                    <?php echo $item_pod->get_field('cover.guid'); ?>
                  </a>
                </p>
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