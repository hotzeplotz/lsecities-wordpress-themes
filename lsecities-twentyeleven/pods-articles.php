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

<div id="primary" class="ninecol">
<div id="content" role="main">

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
        $article_abstract = do_shortcode($pod->get_field('abstract_lang2'));
        $article_text = do_shortcode($pod->get_field('text_lang2'));
        $article_extra_content = do_shortcode($pod->get_field('extra_content_lang2'));
      } else {
        $article_title = $pod->get_field('name');
        $article_abstract = do_shortcode($pod->get_field('abstract'));
        $article_text = do_shortcode($pod->get_field('text'));
        $article_extra_content = do_shortcode($pod->get_field('extra_content'));
      }
      
      $article_publication_date = $pod->get_field('publication_date');
      $article_tags = $pod->get_field('tags');
      $article_authors = $pod->get_field('authors');
    ?>
    
    <?php if(!empty($pod->data)): ?>
      <div class="article">
        <h1 class="entry-title article-title"><?php echo $article_title; ?></h1>
        <div class="entry-meta article-abstract"><?php echo $article_abstract; ?></div>
        <div class="entry-content article-text"><?php echo $article_text; ?></div>
        <div class="extra-content"><?php echo $article_extra_content; ?></div>
      </div>
    <?php endif; ?>
        
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
      <h2>Article metadata</h2>
      <dl>
        <dt>Publication date</dt>
        <dd><?php echo $article_publication_date ?></dd>
        <dt>Tags</dt>
        <dd>
          <?php if(is_array($article_tags)): ?>
          <ul>
            <?php foreach($article_tags as $t): ?>
              <li><?php echo $t['name'] ; ?></li>
            <?php endforeach; ?>
          </ul>
          <?php else: ?>
          <em>no tags defined</em>
          <?php endif; ?>
        </dd>
      </dl>
    </div>
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->

</div>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
