<?php
/**
 * Template Name: Pods - Event
 * Description: The template used for Event Pods
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
$TRACE_ENABLED = is_user_logged_in();
$TRACE_PREFIX = 'pods-events-frontpage';
global $pods_toplevel_ancestor, $pod_slug;
$pods_toplevel_ancestor = 311;

function people_list($people, $heading_singular, $heading_plural) {
  $output = '';
  $people_count = 0;
  $people_with_blurb_count = 0;
  
  if(is_array($people)) {
    if(count($people) > 1) {
      $output .= "<dt>$heading_plural</dt>\n";
    } else {
      $output .= "<dt>$heading_singular</dt>\n";
    }
    $output .= "<dd>\n";
    
    foreach($people as $person) {
      echo var_trace($person, 'people_list:$person', $TRACE_ENABLED);
      $people_count++;
      if($person['profile_text']) {
        $output .= '<a href="#person-profile-' . $person['slug'] . '">' . $person['name'] . ' ' . $person['family_name'] . "</a>, \n";
        $people_with_blurb_count++;
      } else {
        $output .= $person['name'] . '  ' . $person['family_name'] . ", \n";
      }
    }
    $output = substr($output, 0, -3);
    $output .= "</dd>\n";
  }
  
  return array('count' => $people_count, 'with_blurb' => $people_with_blurb_count, 'output' => $output, 'trace' => var_export($people, true));
}

function orgs_list($organizations) {
  $output = '';
  $org_count = count($organizations);
  
  end($organizations);
  $last_item = each($organizations);
  reset($organizations);
  
  foreach($organizations as $key => $org) {
    if($key == $last_item['key'] and $org_count > 1) {
      $output = substr($output, 0, -3);
      $output .= " and \n";
    }
    if($org['web_uri']) {
      $output .= '<a href=' . $org['web_uri'] . '>';
    }
    $output .= $org['name'];
    if($org['web_uri']) {
      $output .= '</a>';
    }
    $output .= ", \n";
  }
  $output = substr($output, 0, -3);
  
  return $output;
}

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

echo var_trace('pod_slug: ' . $pod_slug, $TRACE_PREFIX, $TRACE_ENABLED);

$button_links = $pod->get_field('links');

echo var_trace('button_links: ' . var_export($button_links, true), $TRACE_PREFIX, $TRACE_ENABLED);

$event_speakers = $pod->get_field('speakers', 'family_name ASC');
$event_respondents = $pod->get_field('respondents', 'family_name ASC');
$event_chairs = $pod->get_field('chairs', 'family_name ASC');
$event_moderators = $pod->get_field('moderators', 'family_name ASC');
$event_all_the_people = array_merge((array)$event_speakers, (array)$event_respondents, (array)$event_chairs, (array)$event_moderators);
echo var_trace($event_all_the_people, $TRACE_PREFIX, $TRACE_ENABLED);
$event_hashtag = ltrim($pod->get_field('hashtag'), '#');
$event_story_id = $pod->get_field('storify_id');

$speakers_output = people_list($event_speakers, "Speaker", "Speakers");
$respondents_output = people_list($event_respondents, "Respondent", "Respondents");
$chairs_output = people_list($event_chairs, "Chair", "Chairs");
$moderators_output = people_list($event_moderators, "Moderator", "Moderators");

$people_with_blurb = $speakers_output['with_blurb'] + $respondents_output['with_blurb'] + $chairs_output['with_blurb'] + $moderators_output['with_blurb'];

$event_blurb = honor_ssl_for_attachments(do_shortcode($pod->get_field('blurb')));
$event_blurb_after_event = honor_ssl_for_attachments(do_shortcode($pod->get_field('blurb_after_event')));
echo var_trace('blurb_after_event', $event_blurb_after_event, $TRACE_PREFIX, $TRACE_ENABLED);
$event_contact_info = do_shortcode($pod->get_field('contact_info'));

$event_media = $pod->get_field('media_attachments');

$slider = $pod->get_field('slider');
if(!$slider) {
  $featured_image_uri = get_the_post_thumbnail(get_the_ID(), array(960,367));
}

// if this is an event, grab the image URI from the Pod
if(!$is_conference) {
  $featured_image_uri = honor_ssl_for_attachments($pod->get_field('heading_image.guid'));
}

$event_date_start = new DateTime($pod->get_field('date_start'));
$event_date_end = new DateTime($pod->get_field('date_end'));
// $event_date_string = $pod->get_field('date_freeform');
$event_date_string = $event_date_start->format("l j F Y | H:i");
$event_date_string = $event_date_string . '-' . $event_date_end->format("H:i");
$datetime_now = new DateTime('now');
$is_future_event = ($event_date_start > $datetime_now) ? true : false;

$event_location = $pod->get_field('venue.name');
$eventseries = $pod->get_field('eventseries');

$event_type = $pod->get_field('event_type.name');
$event_series = $pod->get_field('event_series.name');
$event_host_organizations = orgs_list((array) $pod->get_field('hosted_by'));
$event_partner_organizations = orgs_list((array) $pod->get_field('partners'));

$event_info = '';
if($event_type) {
  $event_info .= '<em>' . ucfirst($event_type) . '</em> ';
} else {
  $event_info .= 'An event ';
}
if($event_series) {
  $event_info .= 'of the <em>' . $event_series . '</em> ';
}
if($event_host_organizations) {
  $event_info .= 'hosted by ' . $event_host_organizations . ' ';
} else {
  $event_info .= 'hosted by LSE Cities ';
}
if($event_partner_organizations) {
  $event_info . 'in partnership with ' . $event_partner_organizations;
}

$poster_pdf = $pod->get_field('poster_pdf');
$poster_pdf = honor_ssl_for_attachments($poster_pdf[0]['guid']);
?>

<?php get_header(); ?>

<div role="main">

<?php if ( have_posts() ) : the_post(); endif; ?>

<div id="post-<?php the_ID(); ?>" <?php post_class('lc-article lc-event'); ?>>

<?php echo var_trace($speakers_output, $TRACE_PREFIX, $TRACE_ENABLED);
      echo var_trace($respondents_output, $TRACE_PREFIX, $TRACE_ENABLED);
      echo var_trace($chairs_output, $TRACE_PREFIX, $TRACE_ENABLED);
      echo var_trace($moderators_output, $TRACE_PREFIX, $TRACE_ENABLED);
?>

          <div class='ninecol' id='contentarea'>
            <div class='top-content'>
              <?php if($featured_image_uri) : ?>
              <header class='heading-image'>
                <div class='photospread wireframe'>
                  <?php if(false): ?>
                  <a href="https://www.youtube.com/watch?v=<?php echo $event_media[0]['youtube_uri'] ?>"><img src="<?php echo get_stylesheet_directory_uri() . '/stylesheets/mediaelement/bigplay.png'; ?>" style="background: url('<?php echo $featured_image_uri; ?>'); center center black" alt="event photo" /></a>
                  <?php else: ?>
                  <img src="<?php echo $featured_image_uri; ?>" alt="event photo" />
                  <?php endif; ?>
                </div>
              </header>
              <?php endif; ?>
              <article class='wireframe eightcol'>
                <header>
                  <h1><?php echo $pod->get_field('name'); ?></h1>
                </header>
                <?php if($is_future_event): ?>
                  <?php if($event_blurb): ?>
                  <div class="blurb"><?php echo $event_blurb; ?></div>
                  <?php endif; ?>
                <?php else: ?>
                  <?php if($event_blurb_after_event): ?>
                  <div class="blurb after-event"><?php echo $event_blurb_after_event; ?></div>
                  <?php elseif($event_blurb): ?>
                  <div class="blurb"><?php echo $event_blurb; ?></div>
                  <?php endif; ?>
                <?php endif; // $is_future_event ?>
                <?php if($event_contact_info and $is_future_event): ?>
                  <aside class="booking-and-access"><?php echo $event_contact_info; ?></aside>
                <?php endif; ?>
              </article>
              <aside class='wireframe fourcol last' id='keyfacts'>
                <dl>
                    <?php echo $speakers_output['output'];
                          echo $respondents_output['output'];
                          echo $chairs_output['output'];
                          echo $moderators_output['output'];
                    ?>
                    
                    <?php if($event_date_string): ?>
                      <dt>When</dt>
                      <dd><?php echo $event_date_string; ?></dd>
                    <?php endif; ?>
              
                    <?php if($event_location): ?>
                      <dt>Where</dt>
                      <dd><?php echo $event_location; ?></dd>
                    <?php endif; ?>
              
                    <?php if($eventseries): ?>
                      <dt>Event series</dt>
                      <dd><em><?php echo do_shortcode($eventseries); ?></em></dd>
                    <?php endif; ?>

<!--
                    <?php if(false and $event_contact_info and $is_future_event): ?>
                      <dt>Access &amp; booking</dt>
                      <dd><?php echo $event_contact_info; ?></dd>
                    <?php endif; ?>
-->
                    <?php if($poster_pdf || $freakin_site_map) : ?>
                      <dt>Downloads</dt>
                      <?php if($poster_pdf): ?>
                      <dd><a href="<?php echo $poster_pdf; ?>">Event poster</a> (PDF)</dd>
                      <?php endif; ?>
                      <?php if($freakin_site_map): ?>
                      <dd><a href="<?php echo $freakin_site_map; ?>">Site map</a> (PDF)</dd>
                      <?php endif; ?>  
                    <?php endif; ?>
                    
                    <?php if(!$is_future_event and $event_story_id): ?>
                      <dt>Twitter archive</dt>
                      <dd><a href="https://storify.com/<?php echo $event_story_id; ?>">Read on Storify</a></dd>
                    <?php endif; ?>
                    
                    <?php // only show linked data to logged in users for debugging for now
                      if($TRACE_ENABLED): ?>
                      <?php if($event_type): ?>
                      <dt></dt>
                      <dd><?php echo $event_info; ?></dd>
                      <?php endif; ?>
                    <?php
                      endif;
                    ?>
                </dl>
                <?php if(($is_future_event and $event_hashtag) or (!$event_story_id and $event_hashtag)): ?>
                <div class='twitterbox'>
                  <a href="https://twitter.com/#!/search/<?php echo $event_hashtag; ?>">#<?php echo $event_hashtag; ?></a>
                </div>
                <?php endif; ?>
              </aside><!-- #keyfacts -->
            </div><!-- .top-content -->

            <div class='extra-content twelvecol'>
              
              <?php if($event_media): ?>
              <section class="event-materials clearfix">
                <header>
                  <h1>Event materials</h1>
                </header>
                <dl>
                <?php foreach($event_media as $event_media_item): ?>
                  <?php if($event_media_item['youtube_uri']): ?>
                  <div class="fourcol">
                    <dt>Video</dt>
                    <dd>
                      <?php if(true) : ?>
                      <iframe
                       width="100%"
                       src="https://www.youtube.com/embed/<?php echo $event_media_item['youtube_uri']; ?>?rel=0"
                       frameborder="0"
                       allowfullscreen="allowfullscreen">
                       &#160;
                      </iframe>
                      <?php else : ?>
                      <video width="100%" id="youtube-<?php echo $event_media_item['youtube_uri']; ?>" preload="none">
                        <source type="video/youtube" src="http://www.youtube.com/watch?v=<?php echo $event_media_item['youtube_uri']; ?>" />
                      </video>
                      <?php endif; ?>
                    </dd>
                  </div>
                  <?php endif; ?>
                  <?php if($event_media_item['audio_uri']): ?>
                  <div class="fourcol">
                    <dt>Audio</dt>
                    <dd>
                      <p>Listen to <a class="link mp3" href="<?php echo $event_media_item['audio_uri']; ?>">podcast</a>.</p>
                      <?php if(false) : ?><audio class='mediaelement' src='<?php echo $event_media_item['audio_uri']; ?>' preload='auto'></audio><?php endif; ?>
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
              <?php echo var_trace($event_all_the_people, $TRACE_PREFIX, $TRACE_ENABLED); ?>
              <section id='speaker-profiles' class='clearfix'>
                <header>
                  <h1>Profiles</h1>
                </header>
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
                      <?php echo $event_speaker['profile_text'] ?>
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

          <?php get_template_part('nav'); ?>

<script type="text/javascript">
jQuery(function($) {
  $('.event-materials audio, .event-materials video').mediaelementplayer({
    audiowidth: '100%',
    defaultVideoWidth: '100%'
  });
});
</script>
</div><!-- #contentarea -->
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
