<?php
/**
 * Template Name: Pods - Articles
 * Description: The template used for Article Pods
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
    <?php
      global $pods;
      /* URI: /media/objects/articles/<article-slug>/<language> */
      $pod = new Pod('article', pods_url_variable(3));
      $lang = pods_url_variable(4);
    ?>

    <code><?php var_dump($pod->get_field('language')); ?></code>
    
    <?php if( $pod->getTotalRows() > 0 ) : ?>
      <div id="primary">
        <div id="content" role="main">
          <div class="article">
            <h1 class="entry-title article-title"><?php $pod->get_field('name'); ?></h1>
            <div class="entry-meta article-abstract"><?php $pod->get_field('abstract'); ?></div>
            <div class="entry-content article-text"><?php $pod->get_field('text'); ?></div>
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
