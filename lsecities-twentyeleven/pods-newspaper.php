<?php
/**
 * Template Name: Pods - Newspapers - index
 * Description: The template used for Newspapers, listing articles
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<?php
  /* URI: TBD */
  $publication_slug = get_post_meta($post->ID, 'publication_slug', true);
  error_log('publication_slug: ' . $publication_slug);
  $pod = new Pod('publication_wrappers', $publication_slug);
  $pod_title = $pod->get_field('name');
  $pod_subtitle = $pod->get_field('subtitle');
  $pod_cover = $pod->get_field('cover');
?>

<?php get_header(); ?>

<div class="row">
<div role="main">

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php echo $pod_title; ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>

    <?php if(!empty($pod->data)) : ?>
      <div class="article row">
        <?php if($pod_subtitle) : ?>
        <h2><?php echo $pod_subtitle; ?></h2>
        <?php endif ; ?>
        <div class="ninecol">
          <ul>
            <?php foreach($pod->get_field('articles') as $a) : ?>
            <?php error_log(var_export($a['language']['name'], true)); ?>
              <li>
                <a href="<?php echo $PODS_BASEURI_ARTICLES . '/' . $a['slug']; ?>"><?php echo $a['name']; ?></a>
                <?php if(!empty($a['language']['name'])) : ?>
                  (English) - <a href="<?php echo $PODS_BASEURI_ARTICLES . '/' . $a['slug'] . '/?lang=' . $a['language']['language_code']; ?>">(<?php echo $a['language']['name']; ?>)</a>
                <?php endif; ?>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="threecol">
          <img src="<?php echo $pod_cover[0]['guid'] ; ?>" />
        </div>
      </div>
    <?php endif ?>    
        
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
</div>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
