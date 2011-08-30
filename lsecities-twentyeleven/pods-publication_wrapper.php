<?php
/**
 * Template Name: Pods - Publication wrapper - index
 * Description: The template used for Publications, listing articles
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<?php get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>

    <?php
      /* URI: TBD */
      $publication_wrapper_slug = get_post_meta($post->ID, 'publication_slug', true);
      error_log('publication_slug: ' . $publication_wrapper_slug);
      $pod = new Pod('publication_wrappers', $publication_wrapper_slug);
    ?>

    <?php if(!empty($pod->data)) : ?>
      <div id="primary">
        <div id="content" role="main">
          <div class="article">
            <h2><?php echo $pod->get_field('name'); ?></h2>
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
        </div>
      </div>
    <?php endif ?>    
        
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
