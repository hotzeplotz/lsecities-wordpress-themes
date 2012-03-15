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

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php echo $pod->get_field('name'); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
    <div class='row' id='core'>
      <article class='ninecol'>
        <div class='row'>
          <div class='slider spaceAfter eightcol'>
            <?php if($featured_image_uri): ?>
              <div id='slider' class='eightcol'>
                <?php echo $featured_image_uri; ?>
              </div>
            <?php endif; ?>
          </div>

            <aside class='extras fourcol last'>
            <dl>
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
              
              <?php if(is_array($event_speakers)): ?>
              <dt>Speakers</dt>
              <dd>
              <ul class="people-list">
                <?php foreach($event_speakers as $event_speaker): ?>
                <li><a href="#person-profile-<?php echo $event_speaker['slug'] ?>"><?php echo $event_speaker['name'] ?> <?php echo $event_speaker['family_name'] ?></a></li>
                <?php endforeach; ?>
              </ul>
              </dd>
              <?php endif; ?>
              
              <?php if(is_array($event_respondents)): ?>
              <dt>Respondents</dt>
              <dd>
              <ul class="people-list">
                <?php foreach($event_respondents as $event_respondent): ?>
                <li><?php echo $event_respondent['name'] ?> <?php echo $event_respondent['family_name'] ?></li>
                <?php endforeach; ?>
              </ul>
              </dd>
              <?php endif; ?>
              
              <?php if(is_array($event_chairs)): ?>
              <dt>Chairs</dt>
              <dd>
              <ul class="people-list">
                <?php foreach($event_chairs as $event_chair): ?>
                <li><?php echo $event_chair['name'] ?> <?php echo $event_chair['family_name'] ?></li>
                <?php endforeach; ?>
              </ul>
              </dd>
              <?php endif; ?>
              
              <?php if(is_array($event_moderators)): ?>
              <dt>Moderators</dt>
              <dd>
              <ul class="people-list">
                <?php foreach($event_moderators as $event_moderator): ?>
                <li><?php echo $event_moderator['name'] ?> <?php echo $event_moderator['family_name'] ?></li>
                <?php endforeach; ?>
              </ul>
              </dd>
              <?php endif; ?>

              <?php if($event_hashtag) : ?>
              <dt>Twitter hashtag</dt>
              <dd><a href="https://search.twitter.com/search?q=&tag=<?php echo $event_hashtag; ?>&lang=all">#<?php echo $event_hashtag; ?></a></dd>
              <?php endif; ?>
              
              <?php if($poster_pdf) : ?>
              <dt>Downloads</dt>
              <dd><a href="<?php echo $poster_pdf; ?>">Event's poster</a> (PDF)</dd>
              <?php endif; ?>
            </dl>
            </aside>
            
            <div class='introblurb'>
            <?php
              $tagline = $pod->get_field('tagline');
              if($tagline) : ?>
              <h2><?php echo $tagline; ?></h2>
            <?php endif; ?>
            <?php if($event_blurb): ?>
            <div class="event-blurb"><?php echo $event_blurb; ?></div>
            <?php endif; ?>
            <?php if($event_contact_info and $is_future_event): ?>
            <div class="event-contact-info"><?php echo $event_contact_info; ?></div>
            <?php endif; ?>
            </div>
            
        </div>
        <?php
        // sort by menu_order of linked items
        foreach($button_links as $sort_key => $sort_value) {
			$menu_order[$sort_key] = $sort_value['menu_order'];
		}
		array_multisort($menu_order, SORT_ASC, $button_links);
        ?>
        <?php foreach($button_links as $key => $link) : ?>
          <?php if(($key  % 3) == 0) : ?>
            <div class='featureboxes row'>
          <?php endif; ?>          
          <?php error_log('link key: ' . $key); ?>
          <div class='featurebox fourcol<?php if((($key + 1) % 3) == 0) : ?> last<?php endif ; ?>'>
            <a href="<?php echo $link['guid'] ; ?>" title="<?php echo $link['post_title'] ; ?>">
              <h3><?php echo $link['post_title'] ; ?></h3>
            </a>
          </div>
          <?php if((($key + 1) % 3) == 0 or $key == (count($button_links) - 1)) : ?>
            </div>
          <?php endif; ?>
        <?php endforeach ; ?>
        <?php if(!$is_conference): ?>
        <aside class="row">
			<section class="sixcol">
				<?php if(is_array($event_speakers)): ?>
				<h2>Speaker profiles</h2>
				<?php foreach($event_speakers as $event_speaker): ?>
					<section id="person-profile-<?php echo $event_speaker['slug'] ?>">
						<h3><?php echo $event_speaker['name'] ?> <?php echo $event_speaker['family_name'] ?></h3>
						<p><?php echo $event_speaker['profile_text'] ?></p>
					</section>
				<?php endforeach; ?>
				<?php endif; ?>
			</section>
			<div class="sixcol last">
				<?php if($event_media): ?>
				<h2>Event materials</h2>
				<?php foreach($event_media as $event_media_item): ?>
					<?php if($event_media_item['youtube_uri']): ?>
					<h3>Video</h3>
					<iframe
					 width="283"
					 height="191"
					 src="https://www.youtube.com/embed/<?php echo $event_media_item['youtube_uri']; ?>?rel=0"
					 frameborder="0"
					 allowfullscreen="allowfullscreen">
					 &#160;
					</iframe>
					<?php endif; ?>
					<?php if($event_media_item['audio_uri']): ?>
					<h3>Audio</h3>
					<p>Listen to <a class="link mp3" href="<?php echo $event_media_item['audio_uri']; ?>">podcast</a>.</p>
					<?php endif; ?>
					<?php if($event_media_item['presentation_uri']): ?>
					<h3>Presentation slides</h3>
					<p><a class="link pdf" href="<?php echo $event_media_item['presentation_uri']; ?>">Download</a> (PDF).</p>
					<?php endif; ?> 
				<?php endforeach; ?>
				<?php endif; ?>
			</div>
        </aside>
        <?php endif; ?>
        <div id="the_content">
        <?php the_content(); ?>
        </div>
      </article>
      <aside class='threecol last'>	
		<?php if(!$is_conference) : // if we are dealing with an event, $pod_slug is set - display events sidebar ?>
		<?php get_template_part( 'nav', 'events' ); ?>
		<?php else : // otherwise we are dealing with a conference - display conferences sidebar ?>
        <?php get_template_part( 'nav', 'conferences' ); ?>
        <?php endif; ?>
      </aside>
    </div>
    
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<div class="entry-meta">
    <div id="author-info">
      <?php if(is_array($article_authors)): ?>
        <h2>Authors</h2>
        <ul>
        <?php foreach($article_authors as $a): ?>
          <li><?php echo $a['name'] ?> <?php echo $a['family_name'] ?></li>
        <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
