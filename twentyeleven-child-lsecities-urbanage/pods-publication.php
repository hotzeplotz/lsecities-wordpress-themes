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
  $TRACE_PODS_ARTICLES = true;
  $publication_slug = get_post_meta($post->ID, 'pod_slug', true);
  error_log('pod_slug: ' . $publication_slug);
  $pod = new Pod('publication_wrappers', $publication_slug);
  $publication_pod = $pod; // TODO refactor code and move generation of list of articles to sub used both in pods-articles and pods-publication
  $pod_title = $pod->get_field('name');
  $pod_subtitle = $pod->get_field('publication_subtitle');
  $pod_issuu = do_shortcode($pod->get_field('issuu'));
  $pod_cover = $pod->get_field('snapshot.guid');
  $pod_abstract = do_shortcode($pod->get_field('abstract'));
  
  $articles_pods = new Pod('article');
  $search_params = array();
  $search_params['where'] = 'in_publication.id = ' .$pod->get_field('id');
  $search_params['orderby'] = 'sequence';
  $search_params['limit'] = -1;
  $articles_pods->findRecords($search_params);
  
// TODO: remove hostname once we switch to WP for the whole urban-age.net
$PODS_BASEURI_ARTICLES = 'http://urban-age.net/media/objects/articles';

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
          <h2>Read the articles</h2>
          <p>
    <ul class="publication-side-toc">
    <?php
    $sections = array();
    foreach(preg_split("/\n/", $publication_pod->get_field('sections')) as $section_line) {
      preg_match("/^(\d+)?\s?(.*)$/", $section_line, $matches);
      array_push($sections, array( 'id' => $matches[1], 'title' => $matches[2]));
    }
    if($TRACE_PODS_ARTICLES) { error_log('sections: ' . var_export($sections, true)); }
    
    if(!count($sections)) {
      $sections = array("010" => "");
    }
    foreach($sections as $section) : ?>
      <?php if($section['title']) { ?><h4><?php echo $section['title']; ?></h4><?php }
      //$publication_articles = $publication_pod->get_field('articles');
      
      // sort articles by their 'sequence' field, then by id (this will be the default if no sequence is specified)
      /*
      foreach($publication_articles as $key => $row) {
        $sequence[$key] = $row['sequence'];
        $id[$key] = $row['id'];
      }
      array_multisort($sequence, SORT_ASC, $id, SORT_ASC, $publication_articles);
      */
      
      //foreach($publication_articles as $article) :
      mysql_data_seek($articles_pods->result,0);
      while($articles_pods->fetchRecord()) :
        //if(preg_match("/^" . $section['id'] . "/", $article['sequence'])) :
        if(preg_match("/^" . $section['id'] . "/", $articles_pods->get_field('sequence'))) :
          $article_authors = $articles_pods->get_field('authors');
          foreach($article_authors as $author) {
            $author_names =. $author['name'] . ' ' . $author['family_name'] . ', ';
          }
          $article_name = $articles_pods->get_field('name');
          echo '<!--' . $author_names . ' ' . $article_name '-->';
          if($TRACE_PODS_ARTICLES) : ?>
          <!-- <?php echo 'article Pod object: ' . var_export($articles_pods, true); ?> -->
          <?php endif; ?>
          <li>
            <?php echo '<!--' . $author_names . ' ' ; ?><a href="<?php echo $PODS_BASEURI_ARTICLES . '/' . $articles_pods->get_field('slug'); ?>"><?php echo $articles_title; ?></a>
            <?php if(!empty($article['language']['name'])) : ?>
              (English) - <a href="<?php echo $PODS_BASEURI_ARTICLES . '/' . $article['slug'] . '/?lang=' . $article['language']['language_code']; ?>">(<?php echo $article['language']['name']; ?>)</a>
            <?php endif; ?>
          </li>
      <?php
        endif;
      endwhile;
      //endforeach; 
    endforeach; ?>
    </ul>
          </p>
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

<?php // get_template_part('nav'); ?>

</div><!-- role='main'.row -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
