<?php
/**
 * Template Name: Pods - Main frontpages
 * Description: The template used for LSE Cities main frontpage and Urban Age sub-site frontpage
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?><?php
/**
 * Pods initialization
 * URI: TBD
 */
$pod_slug = get_post_meta($post->ID, 'pod_slug', true);
$TRACE_PODS_MAIN_FRONTPAGE = true;

// for column classes
$SLIDE_COLUMN_COL1 = 'col1';
$SLIDE_COLUMN_COL2 = 'col2';
$SLIDE_COLUMN_COL4 = 'col4';

function get_tile_classes($tile_layout) {
  $element_classes = '';
  
  $xcount = substr($tile_layout, 0, 1);
  $ycount = substr($tile_layout, -1);
  
  switch($xcount) {
    case '1':
      $element_classes .= 'onetile';
      break;
    case '2':
      $element_classes .= 'twotiles';
      break;
    case '3':
      $element_classes .= 'threetiles';
      break;
    case '4':
      $element_classes .= 'fourtiles';
      break;
    case '5':
      $element_classes .= 'fivetiles';
      break;
  }
  
  switch($ycount) {
    case '2':
      $element_classes .= ' tall';
      break;
  }
  
  return $element_classes;
}

if($TRACE_PODS_MAIN_FRONTPAGE) { error_log('pod_slug: ' . $pod_slug); }
$pod = new Pod('slider', $pod_slug);

$slides = $pod->get_field('slides');
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
  <?php if($TRACE_PODS_MAIN_FRONTPAGE): ?>
  <!--
  <?php var_export($slides, false); ?>
  -->
  <?php endif; ?>
              <ul class="slides">
                <?php foreach($slides as $current_slide): ?>
                <?php
                  $current_slide_pod = new Pod('slide', $current_slide['slug']);
                  $slide_layout = $current_slide_pod->get_field('slide_layout.slug');
                  $tiles = $current_slide_pod->get_field('tiles', 'displayorder ASC');
                ?>
<!-- <?php if($TRACE_PODS_MAIN_FRONTPAGE) { echo 'tiles => ' . var_export($tiles, true) . "\n\n" . 'slide_layout => ' . var_export($slide_layout, true); }?> -->
				<?php
                  switch($slide_layout) {
                    case 'two-two-one':
                      $slide_content = array('columns' => array());
                      $tile_index = 0;
                      $total_tiles = count($tiles);
                      
                      // first column
                      $tile_count = 4;
                      $slide_column = array('layout' => $SLIDE_COLUMN_COL2, 'tiles' => array());
                      while($tile_count > 0 and $tile_index <= $total_tiles) {
                        if($TRACE_PODS_MAIN_FRONTPAGE) { echo '<!-- tile[slug]: ' . var_export($tiles[$tile_index]['slug'], true) . " -->\n"; }
                        $tile = new Pod('tile', $tiles[$tile_index++]['slug']);
                        $tile_layout = $tile->get_field('tile_layout.name');
                        if($TRACE_PODS_MAIN_FRONTPAGE) { echo '<!-- tile[layout]: ' . var_export($tile_layout, true) . " -->\n"; }
                        $this_tile_count = preg_replace('/x/', '*', $tile_layout);
                        if($TRACE_PODS_MAIN_FRONTPAGE) { echo '<!-- this_tile_count: ' . var_export($this_tile_count, true) . " -->\n"; }
                        eval('$this_tile_count = ' . $this_tile_count . ';');
                        $tile_count -= $this_tile_count;
                        if($TRACE_PODS_MAIN_FRONTPAGE) { echo '<!-- tile_countdown: ' . var_export($tile_count, true) . " -->\n"; }
                        array_push($slide_column['tiles'],
                          array(
                            'id' => $tile->get_field('slug'),
                            'element_class' => get_tile_classes($tile_layout),
                            'title' => $tile->get_field('name'),
                            'subtitle' => $tile->get_field('tagline'),
                            'blurb' => $tile->get_field('blurb'),
                            'target_uri' => $tile->get_field('target_uri'),
                            'image' => $tile->get_field('image.guid')
                          )
                        );
                      }
                      array_push($slide_content['columns'], $slide_column);
                      
                      // second column
                      $tile_count = 4;
                      $slide_column = array('layout' => $SLIDE_COLUMN_COL2, 'tiles' => array());
                      while($tile_count > 0 and $tile_index <= $total_tiles) {
                        if($TRACE_PODS_MAIN_FRONTPAGE) { echo '<!-- tile[slug]: ' . var_export($tiles[$tile_index++]['slug'], true) . " -->\n"; }
                        $tile = new Pod('tile', $tiles[$tile_index++]['slug']);
                        $tile_layout = $tile->get_field('tile_layout.name');
                        if($TRACE_PODS_MAIN_FRONTPAGE) { echo '<!-- tile[layout]: ' . var_export($tile_layout, true) . " -->\n"; }
                        $this_tile_count = preg_replace('/x/', '*', $tile_layout);
                        if($TRACE_PODS_MAIN_FRONTPAGE) { echo '<!-- this_tile_count: ' . var_export($this_tile_count, true) . " -->\n"; }
                        eval('$this_tile_count = ' . $this_tile_count . ';');
                        $tile_count -= $this_tile_count;
                        if($TRACE_PODS_MAIN_FRONTPAGE) { echo '<!-- tile_countdown: ' . var_export($tile_count, true) . " -->\n"; }
                        array_push($slide_column['tiles'],
                          array(
                            'id' => $tile->get_field('slug'),
                            'element_class' => get_tile_classes($tile_layout),
                            'title' => $tile->get_field('name'),
                            'subtitle' => $tile->get_field('tagline'),
                            'blurb' => $tile->get_field('blurb'),
                            'target_uri' => $tile->get_field('target_uri'),
                            'image' => $tile->get_field('image.guid')
                          )
                        );
                      }
                      array_push($slide_content['columns'], $slide_column);
                      
                      // third column
                      $tile_count = 2;
                      $slide_column = array('layout' => $SLIDE_COLUMN_COL1, 'tiles' => array());
                      while($tile_count > 0 and $tile_index <= $total_tiles) {
                        if($TRACE_PODS_MAIN_FRONTPAGE) { echo '<!-- tile[slug]: ' . var_export($tiles[$tile_index]['slug'], true) . " -->\n"; }
                        $tile = new Pod('tile', $tiles[$tile_index++]['slug']);
                        $tile_layout = $tile->get_field('tile_layout.name');
                        if($TRACE_PODS_MAIN_FRONTPAGE) { echo '<!-- tile[layout]: ' . var_export($tile_layout, true) . " -->\n"; }
                        $this_tile_count = preg_replace('/x/', '*', $tile_layout);
                        if($TRACE_PODS_MAIN_FRONTPAGE) { echo '<!-- this_tile_count: ' . var_export($this_tile_count, true) . " -->\n"; }
                        eval('$this_tile_count = ' . $this_tile_count . ';');
                        $tile_count -= $this_tile_count;
                        if($TRACE_PODS_MAIN_FRONTPAGE) { echo '<!-- tile_countdown: ' . var_export($tile_count, true) . " -->\n"; }
                        array_push($slide_column['tiles'],
                          array(
                            'id' => $tile->get_field('slug'),
                            'element_class' => get_tile_classes($tile_layout),
                            'title' => $tile->get_field('name'),
                            'subtitle' => $tile->get_field('tagline'),
                            'blurb' => $tile->get_field('blurb'),
                            'target_uri' => $tile->get_field('target_uri'),
                            'image' => $tile->get_field('image.guid')
                          )
                        );
                      }
                      array_push($slide_content['columns'], $slide_column);
                      
                      if($TRACE_PODS_MAIN_FRONTPAGE) { echo '<!-- slide_content_array: ' . var_export($slide_content, true) . " -->\n"; }
                      break;
                    default:
                      break;
                  }
                ?>
                <li>
                  <div class="slide-inner row">
                    <?php foreach($slide_content['columns'] as $slide_column): ?>
                      <div class="<?php echo $slide_column['layout']; ?>">
                        <?php foreach($slide_column['tiles'] as $tile): ?>
                          <div class="tile <?php echo $tile['element_class']; ?>" id="slidetile-<?php echo $tile['id']; ?>">
                            <?php if($tile['image']): ?>
                              <div class="crop">
                                <img src="<?php echo $slide_column['image']; ?>" alt="" />
                              </div>
                            <?php endif; ?>
                            <?php if($tile['title'] or $tile['subtitle'] or $tile['blurb']): ?>
                              <div class="feature_info">
                                <?php if($tile['title']): ?><div class='feature_title'><?php echo $tile['title']; ?></div><?php endif; ?>
                                <?php if($tile['subtitle']): ?><div class='feature_caption'><?php echo $tile['subtitle']; ?></div><?php endif; ?>
                                <?php if($tile['blurb']): ?><div class='feature_blurb'><?php echo $tile['blurb']; ?></div><?php endif; ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        <?php endforeach; ?>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </li>
                <?php endforeach; ?>
              </ul>
            </div>
      </article>      
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
