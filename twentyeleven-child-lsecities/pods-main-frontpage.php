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
$slide1_image_uri = $pod->get_field('slide1_image.guid');

$slide2_page_permalink = get_permalink($pod->get_field('slide2_page.ID'));
$slide2_href = $slide2_page_permalink ? $slide2_page_permalink : $pod->get_field('slide2_uri');
$slide2_image_uri = $pod->get_field('slide2_image.guid');

$slide3_page_permalink = get_permalink($pod->get_field('slide3_page.ID'));
$slide3_href = $slide3_page_permalink ? $slide3_page_permalink : $pod->get_field('slide3_uri');
$slide3_image_uri = $pod->get_field('slide3_image.guid');

$slide4_page_permalink = get_permalink($pod->get_field('slide4_page.ID'));
$slide4_href = $slide4_page_permalink ? $slide4_page_permalink : $pod->get_field('slide4_uri');
$slide4_image_uri = $pod->get_field('slide4_image.guid');

$slide5_page_permalink = get_permalink($pod->get_field('slide5_page.ID'));
$slide5_href = $slide5_page_permalink ? $slide5_page_permalink : $pod->get_field('slide5_uri');
$slide5_image_uri = $pod->get_field('slide5_image.guid');

$slide6_page_permalink = get_permalink($pod->get_field('slide6_page.ID'));
$slide6_href = $slide6_page_permalink ? $slide6_page_permalink : $pod->get_field('slide6_uri');
$slide6_image_uri = $pod->get_field('slide6_image.guid');

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
      <article class='twelvecol'>
<div class="flexslider">
              <ul class="slides">
                <li>
                  <div class="slide-inner row">
                    <div class="col2">
                      <div class="gridbox" id="s909843">
                  <a href="<?php echo $slide1_href; ?>">
                    <?php if($slide1_image_uri) : ?>
                    <img src="<?php echo $slide1_image_uri; ?>" />
                    <?php else : ?>
                    <img src="/files/2011/11/grid_placeholder_goldenratio.png" />
                    <?php endif; ?>
                    <div class="feature_info<?php if(empty($slide1_image_uri)) : ?> textonly<?php endif; ?>">
                      <div class="feature_title"><?php echo $pod->get_field('slide1_title'); ?></div>
                      <div class="feature_caption"><?php echo $pod->get_field('slide1_caption'); ?></div>
                      <div class="feature_blurb"><?php echo $pod->get_field('slide1_blurb'); ?></div>
                    </div>
                  </a>
                      </div>
                      <div class="gridbox mono" id="s535465">
                  <a href="<?php echo $slide2_href; ?>">
                    <?php if($slide2_image_uri) : ?>
                    <img src="<?php echo $slide2_image_uri; ?>" />
                    <?php else : ?>
                    <img src="/files/2011/11/grid_placeholder_goldenratio.png" />
                    <?php endif; ?>
                    <div class="feature_info<?php if(empty($slide2_image_uri)) : ?> textonly<?php endif; ?>">
                      <div class="feature_title"><?php echo $pod->get_field('slide2_title'); ?></div>
                      <div class="feature_caption"><?php echo $pod->get_field('slide2_caption'); ?></div>
                      <div class="feature_blurb"><?php echo $pod->get_field('slide2_blurb'); ?></div>
                    </div>
                  </a>
                      </div>
                      <div class="gridbox mono" id="s358452">
                  <a href="<?php echo $slide3_href; ?>">
                    <?php if($slide3_image_uri) : ?>
                    <img src="<?php echo $slide3_image_uri; ?>" />
                    <?php else : ?>
                    <img src="/files/2011/11/grid_placeholder_goldenratio.png" />
                    <?php endif; ?>
                    <div class="feature_info<?php if(empty($slide3_image_uri)) : ?> textonly<?php endif; ?>">
                      <div class="feature_title"><?php echo $pod->get_field('slide3_title'); ?></div>
                      <div class="feature_caption"><?php echo $pod->get_field('slide3_caption'); ?></div>
                      <div class="feature_blurb"><?php echo $pod->get_field('slide3_blurb'); ?></div>
                    </div>
                  </a>
                      </div>
                    </div>
                    <div class="col2">
                      <div class="gridbox mono" id="s9234363">
                  <a href="<?php echo $slide4_href; ?>">
                    <?php if($slide4_image_uri) : ?>
                    <img src="<?php echo $slide4_image_uri; ?>" />
                    <?php else : ?>
                    <img src="/files/2011/11/grid_placeholder_goldenratio.png" />
                    <?php endif; ?>
                    <div class="feature_info<?php if(empty($slide4_image_uri)) : ?> textonly<?php endif; ?>">
                      <div class="feature_title"><?php echo $pod->get_field('slide4_title'); ?></div>
                      <div class="feature_caption"><?php echo $pod->get_field('slide4_caption'); ?></div>
                      <div class="feature_blurb"><?php echo $pod->get_field('slide4_blurb'); ?></div>
                    </div>
                  </a>
                      </div>
                      <div class="gridbox mono" id="s1275434">
                  <a href="<?php echo $slide5_href; ?>">
                    <?php if($slide5_image_uri) : ?>
                    <img src="<?php echo $slide5_image_uri; ?>" />
                    <?php else : ?>
                    <img src="/files/2011/11/grid_placeholder_goldenratio.png" />
                    <?php endif; ?>
                    <div class="feature_info<?php if(empty($slide5_image_uri)) : ?> textonly<?php endif; ?>">
                      <div class="feature_title"><?php echo $pod->get_field('slide5_title'); ?></div>
                      <div class="feature_caption"><?php echo $pod->get_field('slide5_caption'); ?></div>
                      <div class="feature_blurb"><?php echo $pod->get_field('slide5_blurb'); ?></div>
                    </div>
                  </a>
                      </div>
                      <div class="gridbox" id="s498754">
                        <ul class="citieslist">
                          <li>
                            <a href="#">New York</a>
                          </li>
                          <li>
                            <a href="#">Shanghai</a>
                          </li>
                          <li>
                            <a href="#">London</a>
                          </li>
                          <li>
                            <a href="#">Mexico City</a>
                          </li>
                          <li>
                            <a href="#">Johannesburg</a>
                          </li>
                          <li>
                            <a href="#">Berlin</a>
                          </li>
                          <li>
                            <a href="#">Mumbai</a>
                          </li>
                          <li>
                            <a href="#">São Paulo</a>
                          </li>
                          <li>
                            <a href="#">Istanbul</a>
                          </li>
                          <li>
                            <a href="#">Chicago</a>
                          </li>
                          <li>
                            <a href="#">Hong Kong</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="col1">
                      <div class="gridbox introbox" id="s990547">
                        <div class="inner-box">
                          <h2>Urban Age</h2>
                          <p>LSE Cities is an international centre at the London School of Economics and Political Science that carries out research, education and outreach activities in London and abroad. Its mission is to study how people and cities interact in a rapidly urbanising world, focussing on how the design of cities impacts on society, culture and the environment. Through research, conferences, teaching and projects, the centre aims to shape new thinking and practice on how to make cities fairer and more sustainable for the next generation of urban dwellers, who will make up some 70 per cent of the global population by 2050.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            
        <?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
      </article>

      <?php get_template_part('nav'); ?>
      
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
