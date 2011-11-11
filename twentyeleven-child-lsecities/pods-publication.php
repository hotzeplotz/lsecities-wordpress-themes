<?php
/**
 * Template Name: Pods - Publications - index
 * Description: The template used for Publications, showing publication info, listing available articles, etc.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<?php
  /* URI: TBD */
  $publication_slug = get_post_meta($post->ID, 'pod_slug', true);
  error_log('pod_slug: ' . $publication_slug);
  $pod = new Pod('publication_wrappers', $publication_slug);
  $pod_title = $pod->get_field('name');
  $pod_subtitle = $pod->get_field('publication_subtitle');
  $pod_issuu = do_shortcode($pod->get_field('issuu'));
  $pod_cover = $pod->get_field('snapshot.guid');
  $pod_abstract = do_shortcode($pod->get_field('abstract'));
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
          <?php if(count($pod->get_field('articles'))) : ?>
          <h3>Read the articles</h3>
          <ul>
            <?php foreach($pod->get_field('articles') as $a) : ?>
            <?php error_log(var_export($a['language'][0], true)); ?>
              <li>
                <a href="<?php echo $PODS_BASEURI_ARTICLES . '/' . $a['slug']; ?>"><?php echo $a['name']; ?></a>
                <?php if(!empty($a['language']['name'])) : ?>
                  (English) - <a href="<?php echo $PODS_BASEURI_ARTICLES . '/' . $a['slug'] . '/?lang=' . $a['language']['language_code']; ?>">(<?php echo $a['language']['name']; ?>)</a>
                <?php endif; ?>
              </li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
          
          <?php if($pod_issuu) : ?>
          <h3>Browse the publication</h3>
          <?php echo $pod_issuu ; ?>
          <?php endif ; ?>
        </div>
        <div class="threecol last">
          <div class="publication-cover">
            <img src="<?php echo $pod_cover ; ?>" />
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