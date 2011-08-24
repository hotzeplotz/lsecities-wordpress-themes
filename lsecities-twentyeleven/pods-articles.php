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
      $lang = strtolower(pods_url_variable(4));
      $article_lang2 = $pod->get_field('language')[0]['slug'];

      echo '<code class="debug">req_lang: ' . $lang . '</code>';
      echo '<code class="debug">lang2: ' . $article_lang2 . '</code>';
      
      if(!empty($lang) && $lang == $article_lang2)) {
        $article_title = $pod->get_field('title_lang2');
        $article_abstract = $pod->get_field('abstract_lang2');
        $article_text = $pod->get_field('text_lang2');
      } else {
        $article_title = $pod->get_field('name');
        $article_abstract = $pod->get_field('abstract');
        $article_text = $pod->get_field('text');
      }
    ?>
    
    <?php if(!empty($pod->data)) : ?>
      <div id="primary">
        <div id="content" role="main">
          <div class="article">
            <h1 class="entry-title article-title"><?php echo $article_title; ?></h1>
            <div class="entry-meta article-abstract"><?php echo $article_abstract; ?></div>
            <div class="entry-content article-text"><?php echo $article_text; ?></div>
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
