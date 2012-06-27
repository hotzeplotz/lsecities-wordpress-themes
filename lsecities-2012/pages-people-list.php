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
define('MODE_FULL_LIST', 'full_list');
define('MODE_SUMMARY',  'summary');
$people_list = get_post_meta($post->ID, 'people_list', true);

$lists = array(
  'lsecities-staff' =>
    array('lsecities-staff-mgmt'),
    array('lsecities-staff')
);
  
function generate_list($list_id, $mode = MODE_FULL_LIST) {
  if($list_id == 'lsecities-staff') {
    $output .= generate_section('lsecities-staff-mgmt', $mode);
    $output .= generate_section('lsecities-staff', $mode);
  }
  
  return $output;
}

function generate_section($section_slug, $mode = MODE_FULL_LIST) {
  $pod = new Pod('people_group', $section_slug);
  $people = (array)$pod->get_field('members', 'family_name ASC');
  echo var_trace('group_members: ' . var_export($people, true), $TRACE_PREFIX, $TRACE_ENABLED);
  $output .= "<ul class='$section_slug'>";
  foreach($people as $person) {
    if($mode == MODE_FULL_LIST) {
      $output .= generate_person_profile($person['slug'], false, MODE_FULL_LIST);
    } elseif ($mode == MODE_SUMMARY) {
      $output .= generate_person_profile($person['slug'], false, MODE_SUMMARY);
    }
  }
  $output .= "</ul>";
  return $output;
}

function generate_person_profile($slug, $extra_title, $mode = MODE_FULL_LIST) {
  $LEGACY_PHOTO_URI_PREFIX = 'http://v0.urban-age.net';
  $pod = new Pod('authors', $slug);
  $fullname = $pod->get_field('name') . ' ' . $pod->get_field('family_name');
  $fullname = trim($fullname);
  $fullname_for_heading = $fullname;
  if($extra_title) {
    $fullname_for_heading .= ' ' . $extra_title;
  }
  $qualifications_list = array_map(function($string) { return trim($string); }, explode("\n", $pod->get_field('qualifications')));
  $profile_photo_uri = $pod->get_field('photo.guid');
  $email_address = preg_replace('/\@/', ' [AT] ', $pod->get_field('email_address'));
  
  if(!$profile_photo_uri and $pod->get_field('photo_legacy')) {
    $profile_photo_uri = $LEGACY_PHOTO_URI_PREFIX . $pod->get_field('photo_legacy');
  }
  $blurb = $pod->get_field('staff_pages_blurb');
  $organization = $pod->get_field('organization');
  $role = $pod->get_field('role');
  if($role and $organization) {
    $affiliation = "<strong>$role</strong>" . ', ' . $organization;
  } elseif (!$role and $organization) {
    $affiliation = $organization;
  }
  
  if($mode == MODE_FULL_LIST) {
    $output = "<li class='person row' id='p-$slug'>";
    $output .= "  <div class='fourcol profile-photo'>";
    if($profile_photo_uri) {
      $output .= "    <img src='$profile_photo_uri' alt='$fullname - photo'/>";
    } else {
      $output .= "&nbsp;";
    }
    $output .= "  </div>";
    $output .= "  <div class='eightcol last'>";
    $output .= "    <h2>$fullname_for_heading</h2>";
    if($qualifications_list) {
      $output .= "<div class='qualifications'>";
      foreach($qualifications_list as $qualification) {
        $output .= "<span>$qualification</span> ";
      }
      $output = rtrim($output, ' ');
      $output .= "</div>";
    }  
    if($affiliation) {
      $output .= "  <p>$affiliation</p>";
    }
    if($email_address) {
      $output .= "  <p>$email_address</p>";
    }
    if($blurb) {
      $output .= "  $blurb";
    }
    $output .= "  </div>";
    $output .= "</li>";
  } elseif($mode == MODE_SUMMARY) {
    $output = "<li class='person row' id='p-$slug-link'>";
    $output .= "<a href='#p-$slug'>$fullname</a>";
    $output .= "</li>";
  }
  
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
            <?php echo generate_list($people_list, MODE_FULL_LIST); ?>
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
