<?php
/**
 * Template Name: Pods - Articles
 * Description: The template used for Article Pods
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
$TRACE_PODS_ARTICLES = false;
?>

<?php
global $pods;
/* URI: /media/objects/articles/<article-slug>/<language> */
$pod = new Pod('article', pods_url_variable(3));
$lang = strtolower(pods_url_variable('lang', 'get'));
$article_lang2 = $pod->get_field('language.slug');

if($TRACE_PODS_ARTICLES) { error_log('request_language: ' . $lang); }
if($TRACE_PODS_ARTICLES) { error_log('article_lang2: ' . $article_lang2); }

if(!empty($lang) && $lang == $article_lang2) {
  $article_title = $pod->get_field('title_lang2');
  $article_abstract = do_shortcode($pod->get_field('abstract_lang2'));
  $article_text = do_shortcode($pod->get_field('text_lang2'));
  $article_extra_content = do_shortcode($pod->get_field('extra_content_lang2'));
  $pdf_uri = $pod->get_field('article_pdf_uri_lang2');
} else {
  $article_title = $pod->get_field('name');
  $article_abstract = do_shortcode($pod->get_field('abstract'));
  $article_text = do_shortcode($pod->get_field('text'));
  $article_extra_content = do_shortcode($pod->get_field('extra_content'));
  $pdf_uri = $pod->get_field('article_pdf_uri');
}

// prepend base URI
// ToDo: add exceptions (e.g. Istanbul newspaper)
if($pdf_uri) {
  $pdf_uri = "http://urban-age.net/0_downloads/" . $pdf_uri;
}

$article_publication_date = $pod->get_field('publication_date');
$article_tags = $pod->get_field('tags');
$article_authors = $pod->get_field('authors');
?>

<?php get_header(); ?>

	<header class="entry-header twelvecol row last">
		<h1 class="entry-title article-title twelvecol"><?php echo $article_title; ?></h1>
    <div class="entry-meta article-abstract ninecol"><?php echo $article_abstract; ?></div>
    <div class="threecol last">&#160;</div>
	</header><!-- .entry-header -->

  
  <div class="sixcol">


<div role="main">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">    
    <?php if(!empty($pod->data)): ?>
      <div class="article">
        <div class="entry-content article-text"><?php echo $article_text; ?></div>
        <div class="extra-content"><?php echo $article_extra_content; ?></div>
      </div>
    <?php endif; ?>
        
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->

</div>
</div>

<aside class="threecol">
<div class="entry-meta">
    <div id="author-info">
      <dl>
      <?php if(is_array($article_authors)): ?>
        <dt>Authors</dt>
        <dd>
          <ul>
          <?php foreach($article_authors as $a): ?>
            <li><?php echo $a['name'] ?> <?php echo $a['family_name'] ?></li>
          <?php endforeach; ?>
          </ul>
        </dd>
      <?php endif; ?>
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
  
<?php if($pdf_uri) : ?>
<a href="<?php echo $pdf_uri; ?>">Download this article as PDF</a>
<?php endif; ?>
</aside>

<nav class="threecol last" id="level3nav>
  <?php get_template_part( 'nav'); ?>
</nav>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
