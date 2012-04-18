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

if($TRACE_PODS_CONFERENCE_FRONTPAGE) { error_log('pod_slug: ' . $pod_slug); }

$button_links = $pod->get_field('links');

if($TRACE_PODS_CONFERENCE_FRONTPAGE) { error_log('button_links: ' . var_export($button_links, true)); }

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

            <div class='extra-content twelvecol'>
              
              <?php if($event_media): ?>
              <section class="event-materials">
                <h1>Event materials</h1>
                <dl>
                <?php foreach($event_media as $event_media_item): ?>
                  <?php if($event_media_item['youtube_uri']): ?>
                  <div class="fourcol">
                    <dt>Video</dt>
                    <dd>
                      <iframe
                       width="100%"
                       src="https://www.youtube.com/embed/<?php echo $event_media_item['youtube_uri']; ?>?rel=0"
                       frameborder="0"
                       allowfullscreen="allowfullscreen">
                       &#160;
                      </iframe>
                    </dd>
                  </div>
                  <?php endif; ?>
                  <?php if($event_media_item['audio_uri']): ?>
                  <div class="fourcol">
                    <dt>Audio</dt>
                    <dd>
                      <p>Listen to <a class="link mp3" href="<?php echo $event_media_item['audio_uri']; ?>">podcast</a>.</p>
                    </dd>
                  </div>
                  <?php endif; ?>
                  <?php if($event_media_item['presentation_uri']): ?>
                  <div class="fourcol last">
                    <dt>Presentation slides</dt>
                    <dd>
                      <p><a class="link pdf" href="<?php echo $event_media_item['presentation_uri']; ?>">Download</a> (PDF).</p>
                    </dd>
                  </div>
                  <?php endif; ?> 
                <?php endforeach; ?>
                </dl>
              </section>
              <?php endif; ?> 
            
              
              <?php if($people_with_blurb): ?>
              <?php echo var_trace($event_all_the_people, false, $TRACE_PODS_CONFERENCE_FRONTPAGE); ?>
              <section id='speaker-profiles'>
                <h1>Profiles</h1>
                <ul class='people-list'>
                <?php $index = 0;
                      foreach($event_all_the_people as $key => $event_speaker):
                        echo "<!-- event_speaker : " . var_export($event_speaker, true) . "-->";
                        if($event_speaker['profile_text']):
                ?>
                <?php if($index % 3 == 0 || $index == 0): ?>
                  <div class="twelvecol">
                <?php endif; ?>
                    <li id="person-profile-<?php echo $event_speaker['slug'] ?>" class="person fourcol<?php if((($index + 1) % 3) == 0) : ?> last<?php endif ; ?>">
                      <h1><?php echo $event_speaker['name'] ?> <?php echo $event_speaker['family_name'] ?></h1>
                      <p><?php echo $event_speaker['profile_text'] ?></p>
                      <?php if($event_speaker['homepage'] || $event_speaker['twitterhandle']): ?>
                      <ul class="personal-links">
                      <?php if($event_speaker['homepage']): ?>
                          <li><a href="<?php echo $event_speaker['homepage']; ?>"><?php echo $event_speaker['homepage']; ?></a></li>
                      <?php endif; ?>
                      <?php if($event_speaker['twitterhandle']): ?>
                          <li><a href="<?php echo $event_speaker['twitterhandle']; ?>"><?php echo $event_speaker['twitterhandle']; ?></a></li>
                      <?php endif; ?>
                      </ul>
                      <?php endif; ?>
                    </li>
                <?php if(($index + 1) % 3 == 0): ?>
                  </div>
                <?php endif;
                    $index++;
                  endif;
                endforeach; ?>
                </ul><!-- .people-list -->
              </section><!-- #speaker-profiles -->
              <?php endif; ?>
            </div>
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
