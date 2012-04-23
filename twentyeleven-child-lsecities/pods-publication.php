<?php
/**
 * Template Name: Pods - Publications - index
 * Description: The template used for Publications, showing publication info, listing available articles, etc.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?><?php
/* URI: TBD */
$PODS_BASEURI_ARTICLES = '/media/objects/articles';
$TRACE_ENABLED = is_user_logged_in();
$TRACE_PREFIX = 'pods-publications';

$publication_slug = get_post_meta($post->ID, 'pod_slug', true);
echo var_trace('pod_slug: ' . $publication_slug, $TRACE_PREFIX, $TRACE_ENABLED);
$pod = new Pod('publication_wrappers', $publication_slug);
$publication_pod = $pod; // TODO refactor code and move generation of list of articles to sub used both in pods-articles and pods-publication
$pod_title = $pod->get_field('name');
$pod_subtitle = $pod->get_field('publication_subtitle');
$pod_issuu_uri = $pod->get_field('issuu_uri');
$pod_cover = $pod->get_field('snapshot.guid');
$pod_abstract = do_shortcode($pod->get_field('abstract'));

// get tiles for heading slider
$heading_slides = array();
echo var_trace($pod->get_field('heading_slides.slug'), $TRACE_PREFIX, $TRACE_ENABLED);
$slider_pod = new Pod('slide', $pod->get_field('heading_slides.slug'));
foreach($slider_pod->get_field('tiles.slug') as $tile_slug) {
  echo var_trace($tile_slug, $TRACE_PREFIX, $TRACE_ENABLED);
  $tile = new Pod('tile', $tile_slug);
  array_push($heading_slides, $tile->get_field('image.guid'));
}

$pod_pdf = $pod->get_field('publication_pdf.guid') ? $pod->get_field('publication_pdf.guid') : $pod->get_field('publication_pdf_uri');
$pod_alt_pdf = $pod->get_field('publication_alt_pdf.guid') ? $pod->get_field('publication_alt_pdf.guid') : $pod->get_field('publication_alt_pdf_uri');
$pod_pdf_lang2 = $pod->get_field('publication_pdf_lang2.guid') ? $pod->get_field('publication_pdf_lang2.guid') : $pod->get_field('publication_pdf_lang2_uri');
$pod_alt_pdf_lang2 = $pod->get_field('publication_alt_pdf_lang2.guid') ? $pod->get_field('publication_alt_pdf_lang2.guid') : $pod->get_field('publication_alt_pdf_lang2_uri');

$articles_pods = new Pod('article');
$search_params = array();
$search_params['where'] = 'in_publication.id = ' .$pod->get_field('id');
$search_params['orderby'] = 'sequence';
$search_params['limit'] = -1;
$articles_pods->findRecords($search_params);

// get list of publication sections
$publication_sections = array();
foreach(preg_split("/\n/", $publication_pod->get_field('sections')) as $section_line) {
  preg_match("/^(\d+)?\s?(.*)$/", $section_line, $matches);
  array_push($publication_sections, array( 'id' => $matches[1], 'title' => $matches[2]));
}
echo var_trace('sections: ' . var_export($publication_sections, true), $TRACE_PREFIX, $TRACE_ENABLED);
              

?><?php get_header(); ?>

<div role="main">
  <?php if ( have_posts() ) : the_post(); endif; ?>
  <div id="post-<?php the_ID(); ?>" <?php post_class('lc-article lc-publication'); ?>>
    <div class='ninecol' id='contentarea'>
      <div class='top-content'>
        <?php if(count($heading_slides)) : ?>
        <header class='heading-image'>
          <div class='flexslider wireframe'>
            <ul class='slides'>
              <?php foreach($heading_slides as $slide): ?>
              <li><img src='<?php echo $slide; ?>' /></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </header>
        <?php endif; ?>
        
        <article class='wireframe eightcol row'>
          <header class='entry-header'>
            <h1><?php echo $pod_title; ?></h1>
            <?php if($pod_subtitle): ?><h2><?php echo $pod_subtitle; ?></h2><?php endif ; ?>
          </header>
          <div class='entry-content article-text'>
            <?php echo $pod->get_field('blurb'); ?>
          </div>
          <?php if(count($publication_sections)): ?>
          <div class='publication-sections'>
            <ul>
              <?php foreach($publication_sections as $section): ?>
              <li><?php echo $section['title']; ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
          <?php endif; ?>
        </article>
        <aside class='wireframe fourcol last entry-meta' id='keyfacts'>
          <div><img src="<?php echo $pod_cover; ?>" /></div>
          <ul>
            <?php if($pod_pdf) : ?>
            <li><a class="download button" href="<?php echo $pod_pdf; ?>">Download PDF</a></li>
            <?php endif ; ?>
            <?php if($pod_issuu_uri) : ?>
            <li><a class="issuu button" href="<?php echo $pod_issuu_uri; ?>">Online browser</a></li>
            <?php endif ; ?>
          </ul>
          
        </aside><!-- #keyfacts -->
      </div><!-- .top-content -->
      <div class='extra-content twelvecol'>
          <?php if($articles_pods->getTotalRows()) : ?>
          <section class="row">
            <header><h1>Articles</h1></header>
            <div class="eightcol">
              <?php if($articles_pods->getTotalRows()) : ?>
              <div class="publication-toc">
              <?php
              if(!count($publication_sections)) {
                $publication_sections = array("010" => "");
              }
              foreach($publication_sections as $section) : ?>
                <?php if($section['title']) { ?><h4><?php echo $section['title']; ?></h4><?php }
          
                mysql_data_seek($articles_pods->result,0);
                while($articles_pods->fetchRecord()) :
                  if(preg_match("/^" . $section['id'] . "/", $articles_pods->get_field('sequence'))) :
                    $article_authors = $articles_pods->get_field('authors');
                    $author_names = '';
                    foreach($article_authors as $author) {
                      $author_names = $author_names . $author['name'] . ' ' . $author['family_name'] . ', ';
                    }
                    
                    // remove trailing comma
                    $author_names = substr($author_names, 0, -2);
                    
                    $article_title = $articles_pods->get_field('name');
                    echo var_trace('article Pod object: ' . var_export($articles_pods, true), $TRACE_PREFIX, $TRACE_ENABLED);
                    ?>
                    <h3>
                      <a href="<?php echo $PODS_BASEURI_ARTICLES . '/' . $articles_pods->get_field('slug'); ?>"><?php echo $article_title; ?></a>
                      <?php if(!empty($article['language']['name'])) : ?>
                        (English) - <a href="<?php echo $PODS_BASEURI_ARTICLES . '/' . $article['slug'] . '/?lang=' . $article['language']['language_code']; ?>">(<?php echo $article['language']['name']; ?>)</a>
                      <?php endif; ?>
                    </h3>
                    <div class="authors">
                      <?php echo $author_names ; ?>
                    </div>
                    <?php if($articles_pods->get_field('text')): ?>
                    <div class="excerpt">
                      <?php echo shorten_string($articles_pods->get_field('text'), 30); ?><a href="<?php echo $PODS_BASEURI_ARTICLES . '/' . $articles_pods->get_field('slug'); ?>">...</a>
                    </div>
                    <?php endif; ?>
                <?php
                  endif;
                endwhile;
              endforeach; ?>
              </div>
              <?php endif; ?>
            </div><!-- .eightcol -->
            <div class="fourcol last">
            </div><!-- .fourcol.last -->
          </section><!-- .row -->
        <?php endif ?> 
      </div>
    </div><!-- #contentarea -->
  </div><!-- #post-<?php the_ID(); ?> -->
<?php get_template_part('nav'); ?>

</div><!-- role='main'.row -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
