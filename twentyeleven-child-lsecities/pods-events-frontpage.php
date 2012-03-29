<?php
/**
 * Template Name: Pods - Event/Conference
 * Description: The template used for Event and for Conference Pods
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
$BASE_URI = '/media/objects/events/';
$TRACE_PODS_EVENTS_FRONTPAGE = true;

// check if we are getting called via Pods (pods_url_variable is set)
$pod_slug = pods_url_variable(3);

if($pod_slug) {
  $pod = new Pod('event', $pod_slug);
  $is_conference = false;
} else {
  $pod_slug = get_post_meta($post->ID, 'pod_slug', true);
  $pod = new Pod('conference', $pod_slug);
  $is_conference = true;
}

if($TRACE_PODS_EVENTS_FRONTPAGE) { error_log('pod_slug: ' . $pod_slug); }

$button_links = $pod->get_field('links');

if($TRACE_PODS_EVENTS_FRONTPAGE) { error_log('button_links: ' . var_export($button_links, true)); }

$event_speakers = $pod->get_field('speakers', 'family_name ASC');
$event_respondents = $pod->get_field('respondents', 'family_name ASC');
$event_chairs = $pod->get_field('chairs', 'family_name ASC');
$event_moderators = $pod->get_field('moderators', 'family_name ASC');
$event_hashtag = ltrim($pod->get_field('hashtag'), '#');

$event_blurb = do_shortcode($pod->get_field('blurb'));
$event_contact_info = do_shortcode($pod->get_field('contact_info'));

$event_media = $pod->get_field('media_attachments');

$slider = $pod->get_field('slider');
if(!$slider) {
  $featured_image_uri = get_the_post_thumbnail(get_the_ID(), array(960,367));
}

// if this is an event, grab the image URI from the Pod
if(!$is_conference) {
  $featured_image_uri = $pod->get_field('heading_image.guid');
}

$event_date_string = $pod->get_field('date_freeform');
$event_date = new DateTime($pod->get_field('date'));
$datetime_now = new DateTime('now');
$is_future_event = ($event_date > $datetime_now) ? true : false;

$event_location = preg_replace('/<p>(.*?)<\/p>/', "$1", $pod->get_field('location'));
$event_series = $pod->get_field('event_series');
          
$poster_pdf = $pod->get_field('poster_pdf');
$poster_pdf = $poster_pdf[0]['guid'];
?>

<?php get_header(); ?>

<div role="main">

<?php if ( have_posts() ) : the_post(); endif; ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

          <div class='ninecol' id='contentarea'>
            <div class='top-content'>
              <article class='wireframe eightcol'>
                <header>
                  <div class='photospread wireframe'>
                  <?php if($featured_image_uri) : ?>
                    <img src="<?php echo $featured_image_uri; ?>" alt="event photo" />
                  <?php endif; ?>
                  </div>
                  <h1><?php echo $pod->get_field('name'); ?></h1>
                  <div id='keyfacts-short'>
                    <dl>
                    <?php include 'pods-event+snippet-speaker-list.php'; ?>
                    </dl>
                  </div>
                </header>
                <?php if($event_blurb): ?>
                  <div class="blurb"><?php echo $event_blurb; ?></div>
                <?php endif; ?>
                <?php if($event_contact_info and $is_future_event): ?>
                  <aside class="booking-and-access"><?php echo $event_contact_info; ?></aside>
                <?php endif; ?>
              </article>
              <div class='wireframe fourcol last' id='keyfacts'>
                <dl>
                    <?php include 'pods-event+snippet-speaker-list.php'; ?>
                    
                    <?php if($event_date_string): ?>
                      <dt>When</dt>
                      <dd><?php echo $event_date_string; ?></dd>
                    <?php endif; ?>
              
                    <?php if($event_location): ?>
                      <dt>Where</dt>
                      <dd><?php echo $event_location; ?></dd>
                    <?php endif; ?>
              
                    <?php if($event_series): ?>
                      <dt>Event series</dt>
                      <dd><em><?php echo do_shortcode($pod->get_field('event_series')); ?></em></dd>
                    <?php endif; ?>
                    
                    <?php if($event_contact_info and $is_future_event): ?>
                      <dt>Access &amp; booking</dt>
                      <dd><?php echo $event_contact_info; ?></dd>
                    <?php endif; ?>

                    <?php if($poster_pdf || $freakin_site_map) : ?>
                      <dt>Downloads</dt>
                      <?php if($poster_pdf): ?>
                      <dd><a href="<?php echo $poster_pdf; ?>">Event poster</a> (PDF)</dd>
                      <?php endif; ?>
                      <?php if($freakin_site_map): ?>
                      <dd><a href="<?php echo $freakin_site_map; ?>">Site map</a> (PDF)</dd>
                      <?php endif; ?>  
                    <?php endif; ?>
                    
                    <?php if($event_hashtag): ?>
                    <dt></dt>
                    <dd>
                      <div class='twitterbox'></div>
                    </dd>
                    <?php endif; ?>
                </dl>
              </div><!-- #keyfacts -->
            </div>
            <div class='extra-content twelvecol'>
            <?php if(is_array($event_speakers)): ?>
              <section id='speaker-profiles'>
                <h1>Speaker profiles</h1>
                <ul class='people-list'>
                <?php foreach($event_speakers as $key => $event_speaker): ?>
                  <li id="person-profile-<?php echo $event_speaker['slug'] ?>" class="person fourcol<?php if((($key + 1) % 3) == 0) : ?> last<?php endif ; ?>">
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
                <?php endforeach; ?>
                </ul><!-- .people-list -->
              </section><!-- #speaker-profiles -->
            <?php endif; ?>
            </div>
          </div>

          <div id="navigationarea" class='wireframe threecol last'>    
          <?php if(!$is_conference) : // if we are dealing with an event, $pod_slug is set - display events sidebar ?>
            <?php get_template_part( 'nav', 'events' ); ?>
          <?php else : // otherwise we are dealing with a conference - display conferences sidebar ?>
            <?php get_template_part( 'nav', 'conferences' ); ?>
          <?php endif; ?>
          </div>

</div>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
