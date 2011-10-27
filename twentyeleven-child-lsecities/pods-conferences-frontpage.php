<?php
/**
 * Template Name: Pods - Conference homepage
 * Description: The template used for Conferences Pods
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
if($TRACE_PODS_CONFERENCES_FRONTPAGE) { error_log('pod_slug: ' . $pod_slug); }
$pod = new Pod('conference', $pod_slug);
$button_links = $pod->get_field('links');
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
          <article class='ninecol'>
            <div class='row'>
              <div class='slider spaceAfter eightcol' id='slider'>
                <a href='http://urban-age.net/publications/living-in-the-endless-city/' title='item'>
                  <img alt='Living in the endless city - book cover' src='http://urban-age.net/media/homepage/sliders/201106_living-in-the-endless-city-book.jpg' title='New Publication: Living in the Endless City'>
                </a>
              </div>
              <aside class='extras fourcol last'>
              <?php echo do_shortcode($pod->get_field('info')); ?>
              </aside>
            </div>
            <div class='introblurb'>
              <?php echo do_shortcode($pod->get_field('abstract')); ?>
            </div>
            <div class='featureboxes clearfix row'>
              <?php foreach($button_links as $key => $link) : ?>
              <?php error_log('link key: ' . $key); ?>
              <div class='featurebox fourcol<?php if((($key + 1) % 3) == 0) : ?> last<?php endif ; ?>'>
                <a href="<?php echo $link['guid'] ; ?>" title="<?php echo $link['post_title'] ; ?>">
                  <h3><?php echo $link['post_title'] ; ?></h3>
                </a>
              </div>
              <?php endforeach ; ?>
            </div>
            <div id="the_content">
            <?php the_content(); ?>
            </div>
          </article>
          <aside class='threecol last'>
            <?php get_template_part( 'nav', 'conferences' ); ?>
          </aside>
        </div>

        
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
    </div>
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
