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
$TRACE_PREFIX = 'pods-main-frontpage';
$TRACE_ENABLED = is_user_logged_in();

$TILES_PER_COLUMN = 2;

$META_media_attributions = array();

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

function compose_slide($column_spans, $tiles) {
  global $TRACE_ENABLED;
  global $TILES_PER_COLUMN;
  
  echo var_trace('compose_slide|tiles: ' . var_export($tiles, true), $TRACE_PREFIX, $TRACE_ENABLED);

  $slide_content = array('columns' => array());
  $tile_index = 0;
  $total_tiles = count($tiles); 
  
  echo var_trace('column_spans: ' . var_export($column_spans, true), $TRACE_PREFIX, $TRACE_ENABLED);
  
  foreach($column_spans as $column_span) {
    $tile_count = $column_span * $TILES_PER_COLUMN;
    $slide_column = array('layout' => 'col' . $column_span, 'tiles' => array());
    while($tile_count > 0 and $tile_index <= $total_tiles) {
      echo var_trace('tile[slug]: ' . var_export($tiles[$tile_index]['slug'], true), $TRACE_PREFIX, $TRACE_ENABLED);
      $tile = new Pod('tile', $tiles[$tile_index++]['slug']);
      $tile_layout = $tile->get_field('tile_layout.name');
      echo var_trace('tile[layout]: ' . var_export($tile_layout, true), $TRACE_PREFIX, $TRACE_ENABLED);
      $this_tile_count = preg_replace('/x/', '*', $tile_layout);
      echo var_trace('this_tile_count: ' . var_export($this_tile_count, true), $TRACE_PREFIX, $TRACE_ENABLED);
      eval('$this_tile_count = ' . $this_tile_count . ';');
      $tile_count -= $this_tile_count;
      echo var_trace('tile_countdown: ' . var_export($tile_count, true), $TRACE_PREFIX, $TRACE_ENABLED);

      unset($target_event_month, $target_event_day, $target_uri);
      
      if($tile->get_field('target_event.date_start')) {
        $target_event_date = new DateTime($tile->get_field('target_event.date_start'));
        var_trace('target_event_date: ' . var_export($target_event_date, true), $TRACE_PREFIX, $TRACE_ENABLED);
        $target_event_month = $target_event_date->format('M');
        $target_event_day = $target_event_date->format('j');
        $target_event_slug = $tile->get_field('target_event.slug');
      }
      
      if($tile->get_field('target_event.slug')) {
        $target_uri = PODS_BASEURI_EVENTS . '/' . $tile->get_field('target_event.slug');
      } elseif($tile->get_field('target_research_project')) {
        $target_uri = PODS_BASEURI_RESEARCH_PROJECTS . '/' . $tile->get_field('target_research_project.slug');
      } elseif($tile->get_field('target_uri')) {
        $target_uri = $tile->get_field('target_uri');
      } elseif($tile->get_field('target_page.guid')) {
        $target_uri = honor_ssl_for_attachments($tile->get_field('target_page.guid'));
      } elseif($tile->get_field('target_post.guid')) {
        $target_uri = honor_ssl_for_attachments($tile->get_field('target_post.guid'));
      }
      
      array_push($slide_column['tiles'],
        array(
          'id' => $tile->get_field('slug'),
          'element_class' => rtrim(get_tile_classes($tile_layout) . ' ' . $tile->get_field('class'), ' '),
          'title' => $tile->get_field('name'),
          'display_title' => $tile->get_field('display_title'),
          'subtitle' => $tile->get_field('tagline'),
          'blurb' => $tile->get_field('blurb'),
          'plain_content' => $tile->get_field('plain_content'),
          'posts_category' => $tile->get_field('posts_category.term_id'),
          'target_uri' => $target_uri,
          'image' => honor_ssl_for_attachments($tile->get_field('image.guid')),
          'target_event' => array(
            'month' => $target_event_month,
            'day' => $target_event_day
          )
        )
      );
      push_media_attribution($META_media_attributions, $tile->get_field('image.ID');
    }
    array_push($slide_content['columns'], $slide_column);
  }
  return $slide_content;
}

echo var_trace('pod_slug: ' . $pod_slug, $TRACE_PREFIX, $TRACE_ENABLED);
$pod = new Pod('slider', $pod_slug);

$news_category_ids = $pod->get_field('news_category');
echo var_trace('news_category_ids: ' . var_export($news_category_ids, true), $TRACE_PREFIX, $TRACE_ENABLED);
if($news_category_ids) {
  $news_categories = '';
  foreach($news_category_ids as $category) {
    $news_categories .= $category['term_id'] . ',';
  }
  $news_categories = '&cat='. rtrim($news_categories, ',');
  echo var_trace('news_categories: ' . $news_categories, $TRACE_PREFIX, $TRACE_ENABLED);
}
$jquery_options = $pod->get_field('jquery_options');

$slides = $pod->get_field('slides');
?><?php get_header(); ?>

<div role="main">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('lc-article lc-slider-page'); ?>>
	<div class="entry-content">

    <div class='row' id='core'>
      <div class='twelvecol' id="contentarea">
<div class="flexslider">
  <?php echo var_trace(var_export($slides, true), $TRACE_PREFIX, $TRACE_ENABLED); ?>
              <ul class="slides">
                <?php foreach($slides as $current_slide): ?>
                <?php
                  $current_slide_pod = new Pod('slide', $current_slide['slug']);
                  $slide_layout = $current_slide_pod->get_field('slide_layout.slug');
                  $tiles = $current_slide_pod->get_field('tiles', 'displayorder ASC');
                  
                  echo var_trace('tiles: ' . var_export($tiles, true), $TRACE_PREFIX, $TRACE_ENABLED);
                  echo var_trace('slide_layout: ' . var_export($slide_layout, true), $TRACE_PREFIX, $TRACE_ENABLED);
                  
                  switch($slide_layout) {
                    case 'two-two-one':
                      $slide_content = compose_slide(array(2, 2, 1), $tiles);
                      echo var_trace('slide_content_array: ' . var_export($slide_content, true), $TRACE_PREFIX, $TRACE_ENABLED);
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
                              <?php if($tile['target_uri']): ?><a href="<?php echo $tile['target_uri']; ?>"><?php endif; ?>
                                  <img src="<?php echo $tile['image']; ?>" alt="" />
                              <?php if($tile['target_uri']): ?></a><?php endif; ?>
                              </div>
                            <?php endif; ?>
                            <?php if($tile['plain_content']): ?>
                              <div class="<?php echo $tile['element_class']; ?>">
                                <div class="inner-box">
                                  <?php if($tile['display_title']): ?><h1><?php echo $tile['title']; ?></h1><?php endif; ?>
                                  <?php echo $tile['plain_content']; ?>
                                  <?php if($tile['target_uri']): ?></a><?php endif; ?>
                                </div>
                              </div>
                            <?php elseif($tile['posts_category']): ?>
                              <div class="<?php echo ltrim($tile['element_class'] . ' categoryarchive', ' '); ?>">
                                <!-- <em>Recent news go here</em> -->
                              </div>
                            <?php elseif($tile['title'] or $tile['subtitle'] or $tile['blurb']): ?>
                              <div class="feature_info<?php if(!$tile['blurb']): ?> noblurb<?php endif; ?>">
                                <?php if($tile['target_event']['month'] and $tile['target_event']['day']): ?>
                                <div class="feature_date">
                                  <div class="month"><?php if($tile['target_uri']): ?><a href="<?php echo $tile['target_uri']; ?>"><?php endif; ?><?php echo $tile['target_event']['month']; ?><?php if($tile['target_uri']): ?></a><?php endif; ?></div>
                                  <div class="day"><?php if($tile['target_uri']): ?><a href="<?php echo $tile['target_uri']; ?>"><?php endif; ?><?php echo $tile['target_event']['day']; ?><?php if($tile['target_uri']): ?></a><?php endif; ?></div>
                                </div>
                                <?php endif; ?>
                                <?php if($tile['title'] or $tile['subtitle']): ?>
                                <header>
                                  <?php if($tile['title']): ?><div class='feature_title'><?php if($tile['target_uri']): ?><a href="<?php echo $tile['target_uri']; ?>"><?php endif; ?><?php echo $tile['title']; ?><?php if($tile['target_uri']): ?></a><?php endif; ?></div><?php endif; ?>
                                  <?php if($tile['subtitle']): ?><div class='feature_caption'><?php if($tile['target_uri']): ?><a href="<?php echo $tile['target_uri']; ?>"><?php endif; ?><?php echo $tile['subtitle']; ?><?php if($tile['target_uri']): ?></a><?php endif; ?></div><?php endif; ?>
                                </header>
                                <?php endif; ?>
                                <?php if($tile['blurb']): ?><div class='feature_blurb'><?php if($tile['target_uri']): ?><a href="<?php echo $tile['target_uri']; ?>"><?php endif; ?><?php echo $tile['blurb']; ?><?php if($tile['target_uri']): ?></a><?php endif; ?></div><?php endif; ?>
                              </div><!-- .feature-info -->
                            <?php endif; ?>
                            <?php if($slide_column['target_uri']): ?>
                            <?php endif; ?>
                          </div><!-- .tile#slidetile-<?php echo $tile['id']; ?> -->
                        <?php endforeach; ?>
                      </div><!-- <?php echo $slide_column['layout']; ?> -->
                    <?php endforeach; ?>
                  </div><!-- .slide-inner.row -->
                </li>
                <?php endforeach; ?>
              </ul>
            </div>

            <div class="extra-content">
              <?php if($news_categories): ?>
              <section id='news_area'>
                <header>
                  <h1>News</h1>
                </header>
                <div class='clearfix row'>
                  <?php $latest_news = new WP_Query('posts_per_page=3' . $news_categories);
                    while ($latest_news->have_posts()) :
                      $latest_news->the_post();
                      $do_not_duplicate = $post->ID;
                      if($latest_news->current_post == 2) { $class_extra = " last"; }
                    ?>
                  <div class='fourcol<?php echo $class_extra; ?>'>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <?php the_excerpt(); ?>
                  </div>
                  <?php endwhile;
                    wp_reset_postdata();
                  ?>
                </div><!--.clearfix.row -->
                <?php $more_news = new WP_Query('posts_per_page=10' . $news_categories);
                  if($more_news->found_posts > 3) :
                ?>
                <ul>
                <?php
                    while ($more_news->have_posts()) :
                      $more_news->the_post();
                      if ($more_news->current_post > 2) :
                ?>
                  <li><a href="<?php the_permalink(); ?>"><?php the_time('j M'); ?> | <?php the_title() ?></a></li>
                <?php endif;
                    endwhile;
                ?>
                </ul>
                <?php
                  endif;
                ?>
                </ul>
              </section><!-- #news_area -->
              <?php endif; ?>
            </div><!-- .extra-content -->
<?php include 'snippet-page-meta.php'; ?>
      </div>      
    </div><!-- #core.row -->
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
