<?php
/**
 * Template Name: People list
 * Description: The template used for lists of people (staff, advisors, etc.)
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?><?php
$TRACE_ENABLED = is_user_logged_in();
$TRACE_PREFIX = 'pods-publications';
$people_list = get_post_meta($post->ID, 'people_list', true);

$lists = array(
  'lsecities-staff' =>
    array('lsecities-staff-management'),
    array('lsecities-staff')
);
  
function generate_list($list_id, $mode = 'full_list') {
  if($list_id == 'lsecities-staff') {
    $output .= generate_section('lsecities-staff-management');
    $output .= generate_section('lsecities-staff');
  }
  
  return $output;
}

function generate_section($section_slug, $mode = 'full_list') {
  $pod = Pod('people_group', $section_slug);
  $people = (array)$pod->get_field('members', 'family_name ASC');
  echo var_trace('group_members: ' . var_export($people, true), $TRACE_PREFIX, $TRACE_ENABLED);
  for($people as $person) {
    $output .= generate_person_profile($person['slug']);
  }
  return $output;
}

function generate_person_profile($slug, $extra_title) {
  $LEGACY_PHOTO_URI_PREFIX = 'http://v0.urban-age.net';
  $pod = new Pod('authors', $slug);
  $fullname = $pod->get_field('name') . ' ' . $pod->get_field('family name');
  $fullname = trim($fullname);
  if($extra_title) {
    $fullname_for_heading = $fullname . ' ' . $extra_title;
  }
  $profile_photo_uri = $pod->get_field('photo.guid') ? $pod->get_field('photo.guid') : $LEGACY_PHOTO_URI_PREFIX . $pod->get_field('photo_legacy');
  $blurb = $pod->get_field('staff_pages_blurb');
  $organization = $pod->get_field('organization');
  $role = $pod->get_field('role');
  if($role and $organization) {
    $affiliation = $role . ', ' . $organization;
  } elseif (!$role and $organization) {
    $affiliation = $organization;
  }
  $output .= "<li class='person'>";
  $output .= " <div class='fourcol'><img src='$profile_photo_uri' alt='$fullname - photo'/></div>";
  $output .= " <div class='eightcol'>";
  $output .= "  <h2>$fullname_for_heading</h2>";
  if($affiliation) {
    $output .= "  <p>$affiliation</p>";
  }
  if($blurb) {
    $output .= "  $blurb";
  }
  $output .= " </div>";
  $output .= "</li>";
  
  return $output;
}
?><?php get_header(); ?>

<div role="main">
  <?php if ( have_posts() ) : the_post(); endif; ?>
  <div id="post-<?php the_ID(); ?>" <?php post_class('lc-article lc-people-list'); ?>>
    <div class='ninecol' id='contentarea'>
      <div class='top-content'>
        <article class='wireframe row'>
          <header class='entry-header'>
            <h1><?php echo $pod_title; ?></h1>
          </header>
          <div class='entry-content article-text'>
            <?php echo generate_list($people_list); ?>
          </div>
          <?php get_template_part('snippet-socialmedia-share'); ?>
        </article>
      </div><!-- .top-content -->
    </div><!-- #contentarea -->
  </div><!-- #post-<?php the_ID(); ?> -->
<?php get_template_part('nav'); ?>

</div><!-- role='main'.row -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
