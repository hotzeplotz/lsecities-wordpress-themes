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
$TRACE_PODS_CONFERENCE_FRONTPAGE = true;

$pod_slug = get_post_meta($post->ID, 'pod_slug', true);
$pod = new Pod('conference', $pod_slug);
$is_conference = true;

echo var_trace('pod_slug: ' . $pod_slug, , $TRACE_PODS_CONFERENCE_FRONTPAGE);

$button_links = $pod->get_field('links');

echo var_trace('button_links: ' . var_export($button_links, true), , $TRACE_PODS_CONFERENCE_FRONTPAGE);

$event_hashtag = ltrim($pod->get_field('hashtag'), '#');

$event_blurb = do_shortcode($pod->get_field('abstract'));

$slider = $pod->get_field('slider');
if(!$slider) {
  $featured_image_uri = get_the_post_thumbnail(get_the_ID(), array(960,367));
}
?>

<?php get_header(); ?>

<div role="main">

<?php if ( have_posts() ) : the_post(); endif; ?>

<div id="post-<?php the_ID(); ?>" <?php post_class('lc-article lc-conference-frontpage'); ?>>


          <div class='ninecol' id='contentarea'>
            <div class='top-content'>
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
              <aside id="photoarea" class="eightcol">
                <?php galleria_shortcode(array('width' => 552, 'picasa_album' => $pod->get_field('photo_gallery'))); ?>
              </aside>
              <aside id="publicationsarea" class="fourcol last">
                <p>Istanbul is a city as beautiful as Venice or San Francisco, and, once you are away from the water, as brutal and ugly as any metropolis undergoing the trauma of warp speed urbanisation.</p>
                <div>
                  <ul class="sixcol">
                    <li>Lorem</li>
                    <li>Ipsum</li>
                    <li>Sic</li>
                    <li>Amet</li>
                  </ul>
                  <img src="http://dev.v1.lsecities.net/files/2011/10/istanbul-newspaper_cover_en.jpg" class="sixcol last">
                </div>
              </aside>
            </div><!-- .extra-content -->
          </div>

          <div id="navigationarea" class='wireframe threecol last'>
          <?php
            // sort by menu_order of linked items
            foreach($button_links as $sort_key => $sort_value) {
              $menu_order[$sort_key] = $sort_value['menu_order'];
            }
            array_multisort($menu_order, SORT_ASC, $button_links);
          ?>
            <nav class="conferencemenu">
              <ul>
              <?php foreach($button_links as $key => $link) : ?>
                <li>
                  <a href="<?php echo $link['guid'] ; ?>" title="<?php echo $link['post_title'] ; ?>">
                    <?php echo $link['post_title'] ; ?>
                  </a>
                </li>
              <?php endforeach ; ?>
              </ul>
            </nav>
            
            <nav>
              <dl>
                <dt>Urban Age conferences</dt>
                <dd>
                  <ul class="citieslist">
                    <li>
                      <a href='/ua/conferences/2012-london/'>2012 | Electric City</a>
                    </li>
                    <li>
                      <a href='/ua/conferences/2011-hongkong/'>2011 | Hong Kong</a>
                    </li>
                    <li>
                      <a href='/ua/conferences/2010-chicago/'>2010 | Chicago</a>
                    </li>
                    <li>
                      <a href='/ua/conferences/2009-istanbul/'>2009 | Istanbul</a>
                    </li>
                    <li>
                      <a href='/ua/conferences/2008-sao-paulo/'>2008 | São Paulo</a>
                    </li>
                    <li>
                      <a href='/ua/conferences/2007-mumbai/'>2007 | Mumbai</a>
                    </li>
                    <li>
                      <a href='/ua/conferences/2006-berlin/'>2006 | Berlin</a>
                    </li>
                    <li>
                      <a href='/ua/conferences/2006-johannesburg/'>2006 | Johannesburg</a>
                    </li>
                    <li>
                      <a href='/ua/conferences/2006-mexico-city/'>2006 | Mexico City</a>
                    </li>
                    <li>
                      <a href='/ua/conferences/2005-london/'>2005 | London</a>
                    </li>
                    <li>
                      <a href='/ua/conferences/2005-shanghai/'>2005 | Shanghai</a>
                    </li>
                    <li>
                      <a href='/ua/conferences/2005-new-york/'>2005 | New York</a>
                    </li>
                  </ul>
                </dd>
              </dl>
            </nav>
          </div>

</div><!-- #contentarea -->
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
