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
include_once('inc/pods/event/pods-event.php');
?>

<?php get_header(); ?>

<div role="main">

<?php if ( have_posts() ) : the_post(); endif; ?>

<div id="post-<?php the_ID(); ?>" <?php post_class('lc-article lc-event h-event vevent'); ?>>

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
                  <h1 class="hentry-title p-name summary"><?php echo $pod->get_field('name'); ?></h1>
                  <p class="event-info"><?php echo $event_info; ?></p>
                </header>
                <?php if($is_future_event): ?>
                  <?php if($event_blurb): ?>
                  <div class="blurb description"><?php echo $event_blurb; ?></div>
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
                      <dd class="date"><?php echo $event_date_string; ?></dd>
                    <?php endif; ?>
              
                    <?php if($event_location): ?>
                      <dt>Where</dt>
                      <dd class="h-card vcard"><span class="p-location location"><?php echo $event_location; ?></span></dd>
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
            </div><!-- .extra-content -->
<?php include_once('inc/snippets/page-meta.php'); ?>
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
