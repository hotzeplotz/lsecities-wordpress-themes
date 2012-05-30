<?php
/**
 * Template Name: Pods - Conference
 * Description: The template used for Conference Pods
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
<?php
/**
 * Pods initialization
 * URI: /media/objects/events/
 */
global $pods;
$BASE_URI = '/media/objects/conferences/';
$TRACE_ENABLED = is_user_logged_in();
$TRACE_PREFIX = 'pods-conference';

$pod_slug = get_post_meta($post->ID, 'pod_slug', true);
$pod = new Pod('conference', $pod_slug);
$is_conference = true;

echo var_trace('pod_slug: ' . $pod_slug, $TRACE_PREFIX, $TRACE_ENABLED);

echo var_trace('button_links: ' . var_export($button_links, true), $TRACE_PREFIX, $TRACE_ENABLED);

$event_hashtag = ltrim($pod->get_field('hashtag'), '#');

$event_blurb = do_shortcode($pod->get_field('abstract'));

$slider = $pod->get_field('slider');
if(!$slider) {
  $featured_image_uri = get_the_post_thumbnail(get_the_ID(), array(960,367));
}

$conference_publication_blurb = $pod->get_field('conference_newspaper.blurb');
$conference_publication_cover = $pod->get_field('conference_newspaper.snapshot.guid');
$conference_publication_wp_page = $pod->get_field('conference_newspaper.publication_web_page.guid');
$conference_publication_pdf = $pod->get_field('conference_newspaper.publication_pdf_uri');
$conference_publication_issuu = $pod->get_field('conference_newspaper.issuu_uri');

$research_summary_title = $pod->get_field('research_summary.name');
$research_summary_blurb = $pod->get_field('research_summary.blurb');
// tiles is a multi-select pick field so in theory we could have more
// than one tile to display here, however initially we only process the
// first one and ignore the rest - later on we should deal with more
// complex cases (e.g. as a slider or so)
echo var_trace('tiles: ' . var_export($pod->get_field('research_summary.visualization_tiles'), true), $TRACE_PREFIX, $TRACE_ENABLED);
$visualization_tiles = $pod->get_field('research_summary.visualization_tiles');
$tile_pod = new Pod('tile', $visualization_tiles[0]['slug']);
echo var_trace('tile_image: ' . var_export($tile_pod->get_field('image'), true), $TRACE_PREFIX, $TRACE_ENABLED);
$research_summary_tile_image = $tile_pod->get_field('image.guid');
$research_summary_pdf_uri = $pod->get_field('research_summary.data_section_pdf_uri');
?>

<?php get_header(); ?>

<div role="main">

<?php if ( have_posts() ) : the_post(); endif; ?>

<div id="post-<?php the_ID(); ?>" <?php post_class('lc-article lc-conference-frontpage'); ?>>


          <div class='ninecol' id='contentarea'>
            <div class='top-content clearfix'>
              <article class="wireframe">
              <?php if($featured_image_uri) : ?>
              <header class='heading-image'>
                <div class='photospread wireframe'>
                  <?php echo $featured_image_uri; ?>
                </div>
              </header>
              <?php endif; ?>
              <div class='wireframe eightcol'>
                <header>
                  <h1><?php echo $pod->get_field('name'); ?></h1>
                  <?php if($pod->get_field('tagline')): ?><h2><?php echo $pod->get_field('tagline'); ?></h2><?php endif; ?>
                </header>
                <?php if($event_blurb): ?>
                  <div class="blurb"><?php echo $event_blurb; ?></div>
                <?php endif; ?>
                <?php if($event_contact_info and $is_future_event): ?>
                  <aside class="booking-and-access"><?php echo $event_contact_info; ?></aside>
                <?php endif; ?>
              </div>
              <aside class='wireframe fourcol last' id='keyfacts'>
                <?php echo $pod->get_field('info'); ?>
                <?php if($event_hashtag): ?>
                <div class='twitterbox'>
                  <a href="https://twitter.com/#!/search/#<?php echo $event_hashtag; ?>">#<?php echo $event_hashtag; ?></a>
                </div>
                <?php endif; ?>
              </aside><!-- #keyfacts -->
              </article><!-- .wireframe -->
            </div><!-- .top-content -->
            <div class="extra-content">
              <?php if($research_summary_title and $research_summary_blurb and $research_summary_tile_image): ?>
              <section id="research-summary">
                <header><h1>Research</h1></header>
                <div>
                  <aside id="research-blurb" class="fourcol">
                    <h3><?php echo $research_summary_title; ?></h3>
                    <p><?php echo $research_summary_blurb; ?></p>
                    <?php if($research_summary_pdf_uri): ?>
                    <p><a class="downloadthis pdf button" href="<?php echo $research_summary_pdf_uri; ?>">Download research summary</a></p>
                    <?php endif; ?>
                  </aside>
                  <aside id="research-visualizations" class="eightcol last">
                    <img src="<?php echo $research_summary_tile_image; ?>" />
                  </aside>
                </div>
              </section><!-- #research-summary -->
              <?php endif; ?>
              <aside id="photoarea" class="eightcol">
                <?php if($pod->get_field('photo_gallery')): ?>
                <div id="galleria" style="height: 290px;"></div>
                <script type="text/javascript">
                  jQuery(document).ready(function() {
                    jQuery('#galleria').galleria({
                      carousel: true,
                      picasa: 'useralbum:<?php echo $pod->get_field('photo_gallery'); ?>',
                      picasaOptions: {
                        sort: 'date-posted-asc'
                      }
                    });
                  });
                </script>
                <?php endif; ?>
              </aside>
              <aside id="publicationsarea" class="fourcol last">
                <?php if($conference_publication_cover and $conference_publication_blurb): ?>
                <div>
                  <ul class="sixcol">
                    <?php if($conference_publication_wp_page): ?><li><a class="readthis online" href="<?php echo $conference_publication_wp_page; ?>">Read online</a></li><?php endif; ?>
                    <?php if($conference_publication_pdf): ?><li><a class="downloadthis pdf" href="<?php echo $conference_publication_pdf; ?>">Download (PDF)</a></li><?php endif; ?>
                    <?php if($conference_publication_issuu): ?><li><a class="readthis online" href="<?php echo $conference_publication_issuu; ?>">Online reader</a></li><?php endif; ?>
                  </ul>
                  <img src="<?php echo $conference_publication_cover; ?>" class="sixcol last">
                </div>
                <?php echo $conference_publication_blurb; ?>
                <?php endif; ?>
              </aside>
            </div><!-- .extra-content -->
          </div><!-- #contentarea -->

          <div id="navigationarea" class='wireframe threecol last'>
          <?php get_template_part('nav', 'conferences'); ?>
          </div><!-- #navigationarea -->

</div><!-- #post-<?php the_ID(); ?> -->
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
