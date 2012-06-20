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
$pod_cover = honor_ssl_for_attachments($pod->get_field('snapshot.guid'));
$pod_abstract = do_shortcode($pod->get_field('abstract'));

// get tiles for heading slider
$heading_slides = array();
echo var_trace($pod->get_field('heading_slides.slug'), $TRACE_PREFIX, $TRACE_ENABLED);
$slider_pod = new Pod('slide', $pod->get_field('heading_slides.slug'));
foreach($slider_pod->get_field('tiles.slug') as $tile_slug) {
  echo var_trace($tile_slug, $TRACE_PREFIX, $TRACE_ENABLED);
  $tile = new Pod('tile', $tile_slug);
  array_push($heading_slides, honor_ssl_for_attachments($tile->get_field('image.guid')));
}

$pod_pdf = $pod->get_field('publication_pdf.guid') ? honor_ssl_for_attachments($pod->get_field('publication_pdf.guid')) : $pod->get_field('publication_pdf_uri');
$pod_alt_pdf = $pod->get_field('publication_alt_pdf.guid') ? honor_ssl_for_attachments($pod->get_field('publication_alt_pdf.guid')) : $pod->get_field('publication_alt_pdf_uri');
$pod_pdf_lang2 = $pod->get_field('publication_pdf_lang2.guid') ? honor_ssl_for_attachments($pod->get_field('publication_pdf_lang2.guid')) : $pod->get_field('publication_pdf_lang2_uri');
$pod_alt_pdf_lang2 = $pod->get_field('publication_alt_pdf_lang2.guid') ? honor_ssl_for_attachments($pod->get_field('publication_alt_pdf_lang2.guid')) : $pod->get_field('publication_alt_pdf_lang2_uri');

$extra_publication_metadata = $pod->get_field('extra_publication_metadata');

$publication_authors_list = $pod->get_field('authors', 'family_name ASC');
foreach($publication_authors_list as $publication_author) {
  $publication_authors .= $publication_author['name'] . ' ' . $publication_author['family_name'] . ', ';
}
$publication_authors = substr($publication_authors, 0, -2);
$publication_editors_list = $pod->get_field('editors', 'family_name ASC');
foreach($publication_editors_list as $publication_editor) {
  $publication_editors .= $publication_editor['name'] . ' ' . $publication_editor['family_name'] . ', ';
}
$publication_editors = substr($publication_editors, 0, -2);
$publication_contributors_list = $pod->get_field('contributors', 'family_name ASC');
foreach($publication_contributors_list as $publication_contributor) {
  $publication_contributors .= $publication_contributor['name'] . ' ' . $publication_contributor['family_name'] . ', ';
}
$publication_contributors = substr($publication_contributors, 0, -2);
$publication_catalogue_data = $pod->get_field('catalogue_data');
$publishing_date = $pod->get_field('publishing_date');

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
  if($matches[1]) {
    array_push($publication_sections, array( 'id' => $matches[1], 'title' => $matches[2]));
  }
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
          <?php if(count($publication_sections) > 1): ?>
          <section class='publication-sections'>
            <h1>Browse content</h1>
            <ul>
              <?php foreach($publication_sections as $section): ?>
              <li><a href="#publication-section-<?php echo $section['title']; ?>"><?php echo $section['title']; ?></a></li>
              <?php endforeach; ?>
            </ul>
          </section>
          <?php endif; ?>
          <?php get_template_part('snippet-socialmedia-share'); ?>
        </article>
        <aside class='wireframe fourcol last entry-meta' id='keyfacts'>
          <div>
            <div class='cover-thumbnail'><img src="<?php echo $pod_cover; ?>" /></div>
            <ul>
              <?php if($pod_pdf) : ?>
              <li><a class="downloadthis pdf button" href="<?php echo $pod_pdf; ?>">Download PDF</a></li>
              <?php endif ; ?>
              <?php if($pod_issuu_uri) : ?>
              <li><a class="readthis online issuu button" href="<?php echo $pod_issuu_uri; ?>">Online browser</a></li>
              <?php endif ; ?>
            </ul>
            <?php if($extra_publication_metadata): ?>
            <?php echo $extra_publication_metadata; ?>
            <?php endif; ?>
            <dl>
            <?php if($publication_authors): ?>
              <dt>Authors</dt>
              <dd><?php echo $publication_authors; ?></dd>
            <?php endif; ?>
            <?php if($publication_editors): ?>
              <dt>Editors</dt>
              <dd><?php echo $publication_editors; ?></dd>
            <?php endif; ?>
            <?php if($publication_contributors): ?>
              <dt>Contributors</dt>
              <dd><?php echo $publication_contributors; ?></dd>
            <?php endif; ?>
            <?php if($publishing_date): ?>
              <dt>Publication date</dt>
              <dd><?php echo $publishing_date; ?></dd>
            <?php endif; ?>
            <?php if($publication_catalogue_data): ?>
              <dt>Catalogue data</dt>
              <dd><?php echo $publication_catalogue_data; ?></dd>
            <?php endif; ?>         
            </dl>
          </div>
        </aside><!-- #keyfacts -->
      </div><!-- .top-content -->
      <div class='extra-content row'>
          <?php echo var_trace(var_export($pod->get_field('reviews_category.term_id'), true), $TRACE_PREFIX, $TRACE_ENABLED); ?>
          <?php if($pod->get_field('reviews_category.term_id')):
                  $wp_posts_reviews = get_posts(array('category' => $pod->get_field('reviews_category.term_id'), 'numberposts' => 10));
                  if(count($wp_posts_reviews)): ?>
          <section class="row" id="wp-posts-reviews">
            <header><h1>Reviews</h1></header>
              <dl class="posts">
              <?php
              foreach($wp_posts_reviews as $post):
                setup_postdata($post); ?>
                <dt><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dt>
                <dd><?php the_date(); ?></dd>
              <?php endforeach; ?>
              </dl><!-- .posts -->
          </section><!-- #wp-posts-reviews -->
            <?php endif; ?>
          <?php endif; ?>
          <?php if($articles_pods->getTotalRows()) : ?>
          <section class="row" id="tableofcontents">
            <header><h1>Articles</h1></header>
            <div class="eightcol">
              <?php if($articles_pods->getTotalRows()) : ?>
              <div class="articles">
              <?php
              if(!count($publication_sections)) {
                $publication_sections = array("010" => "");
              }
              foreach($publication_sections as $section) : ?>
                <section id="publication-section-<?php echo $section['title']; ?>">
                <?php if($section['title']) { ?><h1><?php echo $section['title']; ?></h1><?php }
          
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
                    <div class="article">
                      <h1>
                        <a href="<?php echo $PODS_BASEURI_ARTICLES . '/' . $articles_pods->get_field('slug'); ?>"><?php echo $article_title; ?></a>
                      </h1>
                      <?php if($author_names): ?>
                      <div class="authors">
                        <?php echo $author_names ; ?>
                      </div>
                      <?php endif; ?>
                      <?php if(false and $articles_pods->get_field('abstract')): //disable until we can generate plain text only ?>
                      <div class="excerpt">
                        <?php echo shorten_string($articles_pods->get_field('abstract'), 30); ?><a href="<?php echo $PODS_BASEURI_ARTICLES . '/' . $articles_pods->get_field('slug'); ?>">...</a>
                      </div>
                      <?php endif; ?>
                    </div><!-- .article -->
                <?php
                  endif;
                endwhile; ?>
                </section><!-- publication-section-<?php echo $section['title']; ?> -->
              <?php  
              endforeach; ?>
              </div><!-- .articles -->
              <?php endif; ?>
            </div><!-- .eightcol -->
            <div class="fourcol last">
            </div><!-- .fourcol.last -->
          </section><!-- .row -->
        <?php endif ?> 
      </div><!-- .extra-content -->
    </div><!-- #contentarea -->
  </div><!-- #post-<?php the_ID(); ?> -->
<?php get_template_part('nav'); ?>

</div><!-- role='main'.row -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
