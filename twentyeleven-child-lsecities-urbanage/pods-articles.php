<?php
/**
 * Template Name: Pods - Articles
 * Description: The template used for Article Pods - Urban Age ua908 variant
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
$TRACE_PODS_ARTICLES = true;
$PODS_BASEURI_ARTICLES = '/media/objects/articles/';
?>

<?php
global $pods;
/* URI: /media/objects/articles/<article-slug>[?lang=<language>] */

// set toplevel ancestor explicitly as we are outside of WP's hierarchy
global $pods_toplevel_ancestor;

$pods_toplevel_ancestor = 309;

$pod = new Pod('article', pods_url_variable(3));
$lang = strtolower(pods_url_variable('lang', 'get'));
$article_lang2 = $pod->get_field('language.slug');
$article_layout = $pod->get_field('layout');

$publication_pod = new Pod('publication_wrappers', $pod->get_field('in_publication.id'));


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
if($pdf_uri) {
  // Istanbul newspaper follows different URI template
  if($pod->get_field('in_publication.slug') == 'istanbul-city-of-intersections') {
    $pdf_uri = 'http://v0.urban-age.net/publications/newspapers/' . $pdf_uri;
  } else {
    $pdf_uri = "http://urban-age.net/0_downloads/" . $pdf_uri;
  }
}

$article_publication_date = $pod->get_field('publication_date');
$article_tags = $pod->get_field('tags');
$article_authors = $pod->get_field('authors');
?>

<?php get_header(); ?>

<div class="row">
  
<div role="main" class="ninecol">
	<header class="entry-header">
		<h1 class="entry-title article-title"><?php echo $article_title; ?></h1>
    <div class="entry-meta article-abstract"><?php echo $article_abstract; ?></div>
	</header><!-- .entry-header -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">    
    <?php if(!empty($pod->data)): ?>
      <div class="article">
        <div class="entry-content article-text<?php if($article_layout) { echo ' ' . $article_layout; } ?>"><?php echo $article_text; ?></div>
        <div class="extra-content"><?php echo $article_extra_content; ?></div>
      </div>
    <?php endif; ?>
        
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->

</div><!-- role:main -->

<aside class="threecol last">
<div class="entry-meta">
    <div id="author-info">
      <dl>
      <?php if(is_array($article_authors)): ?>
        <dt>Authors</dt>
        <dd>
          <ul>
          <?php foreach($article_authors as $author): ?>
            <li><?php echo $author['name'] ?> <?php echo $author['family_name'] ?></li>
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
            <?php foreach($article_tags as $tag): ?>
              <li><?php echo $tag['name'] ; ?></li>
            <?php endforeach; ?>
          </ul>
          <?php else: ?>
          <em>no tags defined</em>
          <?php endif; ?>
        </dd>
      </dl>
    </div><!-- #author-info -->
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-meta -->
  
<?php if($pdf_uri) : ?>
<a href="<?php echo $pdf_uri; ?>">Download this article as PDF</a>
<?php endif; ?>

<?php if($publication_pod->get_field('articles')) : ?>
  <div>
    <h3><?php echo $publication_pod->get_field('name'); ?></h3>
    <ul class="publication-side-toc">
    <?php
    $sections = preg_grep("/^(\d+)?\s(.*)$/", preg_split("/\n/", $publication_pod->get_field('sections')));
    if($TRACE_PODS_ARTICLES) { error_log('sections: ' . var_export($sections, true)); }
    
    if(!count($sections)) {
      $sections = array("010" => "");
    }
    foreach($sections as $section_id => $section_title) : ?>
      <?php if($section_title) { ?><h4><?php echo $section_title; ?></h4><?php }
      foreach($publication_pod->get_field('articles') as $article) :
        if(preg_match("/^$section_id/", $article['order'])) : ?>
          <!-- <?php echo 'article Pod object: ' . var_export($article, true); ?> -->
          <li>
            <a href="<?php echo $PODS_BASEURI_ARTICLES . '/' . $article['slug']; ?>"><?php echo $article['name']; ?></a>
            <?php if(!empty($article['language']['name'])) : ?>
              (English) - <a href="<?php echo $PODS_BASEURI_ARTICLES . '/' . $article['slug'] . '/?lang=' . $article['language']['language_code']; ?>">(<?php echo $article['language']['name']; ?>)</a>
            <?php endif; ?>
          </li>
      <?php
        endif;
      endforeach; 
    endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

</aside>
</div>
<?php // get_template_part('nav'); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
