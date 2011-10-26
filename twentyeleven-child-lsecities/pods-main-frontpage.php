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
                <img class='quickFlipCta' src='http://placehold.it/1000x620/ffcc00/000000'>
              </div>
            </div>
            <div class='flipbox sixcol boxsmall last'>
              <div class='box recto'>
                <img class='quickFlipCta' src='http://placehold.it/500x310'>
              </div>
              <div class='box verso'>
                <img class='quickFlipCta' src='http://placehold.it/1000x620/ffcc00/000000'>
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
        <?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
      </article>
      <aside class="twocol last">
      &#160;
      </aside>
    </div><!-- #core.row -->
    <div id='news_area'>
      <h2>News</h2>
      <div class='clearfix row'>
        <?php $latest_news = new WP_Query('posts_per_page=3');
          while ($latest_news->have_posts()) :
            $latest_news->the_post();
            $do_not_duplicate = $post->ID;
            if($latest_news->current_post == 2) { $class_extra = " last"; }
          ?>
        <div class='fourcol<?php echo $class_extra; ?>'>
          <h3><?php the_title(); ?></h3>
          <?php the_excerpt(); ?>
        </div>
        <?php endwhile;
          wp_reset_postdata();
        ?>
      </div><!--.clearfix.row -->
      <?php $more_news = new WP_Query('posts_per_page=10');
        if($more_news->found_posts > 3) :
      ?>
      <ul>
      <?php
          while ($more_news->have_posts()) :
            $more_news->the_post();
            if ($more_news->current_post > 2) :
      ?>
        <li><a href="<?php echo get_permalink(the_ID()); ?>"><?php the_title() ?></a></li>
      <?php endif;
          endwhile;
      ?>
      </ul>
      <?php
        endif;
      ?>
      </ul>
    </div><!-- #news_area -->
    </div>        
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

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
