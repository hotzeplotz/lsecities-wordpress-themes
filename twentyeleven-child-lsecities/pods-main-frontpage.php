<?php
/**
 * Template Name: Pods - Main frontpages
 * Description: The template used for LSE Cities main frontpage and Urban Age sub-site frontpage
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<?php
/**
 * Pods initialization
 * URI: TBD
 */
$pod_slug = get_post_meta($post->ID, 'pod_slug', true);
error_log('pod_slug: ' . $pod_slug);
$pod = new Pod('frontpage', $pd_slug);
$button_links = $pod->get_field('features');
?>

<?php get_header(); ?>

<div role="main">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php echo $pod->get_field('name'); ?></h1>
    <?php
      $tagline = $pod->get_field('tagline');
      if($tagline) : ?>
      <h2><?php echo $tagline; ?></h2>
    <?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">

    <div class='row' id='core'>
      <article class='tencol'>
        <div class='row' id='headfeatures'>
          <div class='features sixcol'>
            <div class='flipbox twelvecol last boxbig'>
              <div class='box recto'>
                <img class='quickFlipCta' src='http://placehold.it/500x310'>
              </div>
              <div class='box verso'>
                <img class='quickFlipCta' src='http://placehold.it/1000x620/ffcc00/000000'>
              </div>
            </div>
            <div class='flipbox sixcol'>
              <div class='box recto'>
                <img class='quickFlipCta' src='http://placehold.it/500x310'>
              </div>
              <div class='box verso'>
                <img class='quickFlipCta' src='http://placehold.it/1000x620/ffcc00/000000'>
              </div>
            </div>
            <div class='flipbox sixcol last'>
              <div class='box recto'>
                <img class='quickFlipCta' src='http://placehold.it/500x310'>
              </div>
              <div class='box verso'>
                <img class='quickFlipCta' src='http://placehold.it/1000x620/ffcc00/000000'>
              </div>
            </div>
          </div>
          <div class='features sixcol last'>
            <div class='flipbox sixcol boxsmall'>
              <div class='box recto'>
                <img class='quickFlipCta' src='http://placehold.it/500x310'>
              </div>
              <div class='box verso'>
                <img class='quickFlipCta' src='http://placehold.it/500x310'>
              </div>
            </div>
            <div class='flipbox sixcol boxsmall last'>
              <div class='box recto'>
                <img class='quickFlipCta' src='http://placehold.it/500x310'>
              </div>
              <div class='box verso'>
                <img class='quickFlipCta' src='http://placehold.it/500x310'>
              </div>
            </div>
            <div class='flipbox twelvecol last boxbig'>
              <div class='box recto'>
                <img class='quickFlipCta' class='quickFlipCta' src='http://placehold.it/500x310'>
              </div>
              <div class='box verso'>
                <img class='quickFlipCta' class='quickFlipCta' src='http://placehold.it/1000x620/ffcc00/000000'>
              </div>
            </div>
          </div>
        </div>
        <div class='row' id='topnews'>
          <div class='featureboxes clearfix row'>
            <h2>News</h2>
            
            <?php $latest_news = new WP_Query('posts_per_page=3');
              while ($latest_news->have_posts()) : $latest_news->the_post();
              $do_not_duplicate = $post->ID; ?>
            <!-- Do stuff... -->
            <div class='featurebox fourcol'>
              <h3><?php the_title(); ?></h3>
              <p><?php the_excerpt(); ?></p>
            </div>
            <?php endwhile; ?>
          </div>
        </div>
      </article>
    </div>
<!--
          <aside class='twocol last'>
            <nav id='conferencesmenu'>
              <h2>Urban Age conferences</h2>
              <ul>
                <li class='cityName conferencesAsia'>
                  <a href='/ua/conferences/2011-hongkong/'>Hong Kong</a>
                </li>
                <li class='cityName conferencesNorthAmerica'>
                  <a href='/ua/conferences/2010-chicago/'>Chicago</a>
                </li>
                <li class='cityName conferencesEurope'>
                  <a href='/ua/conferences/2009-istanbul/'>Istanbul</a>
                </li>
                <li class='cityName conferencesSouthAmerica'>
                  <a href='/ua/conferences/2008-sao-paulo/'>São Paulo</a>
                </li>
                <li class='cityName conferencesAsia'>
                  <a href='/ua/conferences/2007-mumbai/'>Mumbai</a>
                </li>
                <li class='cityName conferencesEurope'>
                  <a href='/ua/conferences/2006-berlin/'>Berlin</a>
                </li>
                <li class='cityName conferencesAfrica'>
                  <a href='/ua/conferences/2006-johannesburg/'>Johannesburg</a>
                </li>
                <li class='cityName conferencesSouthAmerica'>
                  <a href='/ua/conferences/2006-mexico-city/'>Mexico City</a>
                </li>
                <li class='cityName conferencesEurope'>
                  <a href='/ua/conferences/2005-london/'>London</a>
                </li>
                <li class='cityName conferencesAsia'>
                  <a href='/ua/conferences/2005-shanghai/'>Shanghai</a>
                </li>
                <li class='cityName conferencesNorthAmerica'>
                  <a href='/ua/conferences/2005-new-york/'>New York</a>
                </li>
              </ul>
            </nav>
          </aside>
-->

        
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

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

</div>

<script>
jQuery(function() {
  jQuery('.flipbox').quickFlip();
});
</script>
<?php get_sidebar(); ?>

<?php get_footer(); ?>
