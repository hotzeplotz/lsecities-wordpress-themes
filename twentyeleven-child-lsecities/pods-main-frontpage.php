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
$pod = new Pod('slider', $pod_slug);

$slide1_page_permalink = get_permalink($pod->get_field('slide1_page.ID'));
$slide1_href = $slide1_page_permalink ? $slide1_page_permalink : $pod->get_field('slide1_uri');
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
        <div id="featuresgrid" class="row">
              <div class="featurescolumn">
                <div class="featureboxbig">
                  <a href="<?php echo $slide1_href; ?>">
                    <img src="<?php echo $pod->get_field('slide1_image.guid'); ?>">
                    <div class="feature_info">
                      <div class="feature_title"><?php echo $pod->get_field('slide1_title'); ?></div>
                      <div class="feature_caption"><?php echo $pod->get_field('slide1_caption'); ?></div>
                      <div class="feature_blurb"><?php echo $pod->get_field('slide1_blurb'); ?></div>
                    </div>
                  </a>
                </div>
                <div class="featureboxsmall">
                  <a href="<?php echo $slide2_href; ?>">
                    <img src="<?php echo $pod->get_field('slide2_image.guid'); ?>">
                    <div class="feature_info">
                      <div class="feature_title"><?php echo $pod->get_field('slide2_title'); ?></div>
                      <div class="feature_caption"><?php echo $pod->get_field('slide2_caption'); ?></div>
                      <div class="feature_blurb"><?php echo $pod->get_field('slide2_blurb'); ?></div>
                    </div>
                  </a>
                </div>
                <div class="featureboxsmall last">
                  <a href="<?php echo $slide3_href; ?>">
                    <img src="<?php echo $pod->get_field('slide3_image.guid'); ?>">
                    <div class="feature_info">
                      <div class="feature_title"><?php echo $pod->get_field('slide3_title'); ?></div>
                      <div class="feature_caption"><?php echo $pod->get_field('slide3_caption'); ?></div>
                      <div class="feature_blurb"><?php echo $pod->get_field('slide3_blurb'); ?></div>
                    </div>
                  </a>
                </div>
              </div>
              <div class="featurescolumn last">
                <div class="featureboxsmall">
                  <a href="<?php echo $slide4_href; ?>">
                    <img src="<?php echo $pod->get_field('slide4_image.guid'); ?>">
                    <div class="feature_info">
                      <div class="feature_title"><?php echo $pod->get_field('slide4_title'); ?></div>
                      <div class="feature_caption"><?php echo $pod->get_field('slide4_caption'); ?></div>
                      <div class="feature_blurb"><?php echo $pod->get_field('slide4_blurb'); ?></div>
                    </div>
                  </a>
               </div>
                <div class="featureboxsmall last">
                  <a href="<?php echo $slide5_href; ?>">
                    <img src="<?php echo $pod->get_field('slide5_image.guid'); ?>">
                    <div class="feature_info">
                      <div class="feature_title"><?php echo $pod->get_field('slide5_title'); ?></div>
                      <div class="feature_caption"><?php echo $pod->get_field('slide5_caption'); ?></div>
                      <div class="feature_blurb"><?php echo $pod->get_field('slide5_blurb'); ?></div>
                    </div>
                  </a>
                </div>
                <div class="featureboxbig">
                  <a href="<?php echo $slide6_href; ?>">
                    <img src="<?php echo $pod->get_field('slide6_image.guid'); ?>">
                    <div class="feature_info">
                      <div class="feature_title"><?php echo $pod->get_field('slide6_title'); ?></div>
                      <div class="feature_caption"><?php echo $pod->get_field('slide6_caption'); ?></div>
                      <div class="feature_blurb"><?php echo $pod->get_field('slide6_blurb'); ?></div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
        <?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
      </article>
      <aside class="threecol last">
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

<?php get_sidebar(); ?>

<?php get_footer(); ?>
