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
      $lang = strtolower(pods_url_variable('lang', 'get'));
      $article_lang2 = $pod->get_field('language');
      $article_lang2 = $article_lang2[0]['slug'];

      error_log('<code class="debug">req_lang: ' . $lang . '</code>');
      error_log('<code class="debug">lang2: ' . $article_lang2 . '</code>');
      
      if(!empty($lang) && $lang == $article_lang2) {
        $article_title = $pod->get_field('title_lang2');
        $article_abstract = $pod->get_field('abstract_lang2');
        $article_text = $pod->get_field('text_lang2');
      } else {
        $article_title = $pod->get_field('name');
        $article_abstract = $pod->get_field('abstract');
        $article_text = $pod->get_field('text');
      }
      
      $article_authors = $pod->get_field('authors');
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
    <div id="author-info">
      <?php if(is_array($article_authors)) : ?>
        <h2>About the authors</h2>
        <dl>
        <?php foreach($article_authors as $a) : ?>
          <dt><?php echo $a['name'] ?> <?php echo $a['family_name'] ?></dt>
          <dd><?php echo $a['profile_text'] ?></dd>
        <?php endforeach; ?>
        </dl>
      <?php endif ; ?>
    </div>
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
