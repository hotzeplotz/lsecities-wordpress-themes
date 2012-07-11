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
$TRACE_PREFIX = 'pages-people-list';
define('MODE_FULL_LIST', 'full_list');
define('MODE_SUMMARY',  'summary');
$people_list = get_post_meta($post->ID, 'people_list', true);

// save here all the people whose profile has already been added to output
$people_in_output_full = array();
$people_in_output_summary = array();

$lists = array(
  'lsecities-staff' =>
    array('lsecities-staff-mgmt'),
    array('lsecities-staff')
);
  
function generate_list($list_id, $mode = MODE_FULL_LIST) {
  if($list_id == 'lsecities-staff') {
    $output .= generate_section('lsecities-staff-mgmt', 'Executive', $mode);
    $output .= generate_section('lsecities-staff', 'Centre staff', $mode);
  }
  if($list_id == 'lsecities-advisory-board') {
    $output .= generate_section('lsecities-advisory-board-chair', 'Chair', $mode);
    $output .= generate_section('lsecities-advisory-board', 'Advisors', $mode);
  }
  
  return $output;
}

function generate_section($section_slug, $section_heading = false, $mode = MODE_FULL_LIST) {
  $pod = new Pod('people_group', $section_slug);
  $people = (array)$pod->get_field('members', 'family_name ASC');
  global $people_in_output_full, $people_in_output_summary;
  echo var_trace('group_members: ' . var_export($people, true), $TRACE_PREFIX, true);
  $output = "<section class='people-list $section_slug'>";
  $output .= "<h1>$section_heading</h1>";
  $output .= "<ul>";
  foreach($people as $person) {
    $display_after = new DateTime($person['display_after']);
    $display_until = new DateTime($person['display_until']);
    $datetime_now = new DateTime('now');
    echo var_trace('display_after: ' . var_export($display_after, true), $TRACE_PREFIX, true);
    echo var_trace('display_until: ' . var_export($display_until, true), $TRACE_PREFIX, true);
    echo var_trace('datetime_now: ' . var_export($datetime_now, true), $TRACE_PREFIX, true);
    if($display_after <= $datetime_now and $datetime_now <= $display_until) {
      if($mode == MODE_FULL_LIST) {
        if(!in_array($person['slug'], $people_in_output_full)) {
          array_push($people_in_output_full, $person['slug']);
          $output .= generate_person_profile($person['slug'], false, MODE_FULL_LIST);
        }
      } elseif ($mode == MODE_SUMMARY) {
        if(!in_array($person['slug'], $people_in_output_summary)) {
          array_push($people_in_output_summary, $person['slug']);
          $output .= generate_person_profile($person['slug'], false, MODE_SUMMARY);
        }
      }
    }
  }
  echo var_trace('people_in_output_full: ' . var_export($people_in_output_full, true), $TRACE_PREFIX, true);
  echo var_trace('people_in_output_summary: ' . var_export($people_in_output_summary, true), $TRACE_PREFIX, true);
  $output .= " </ul>";
  $output .= "</section>";
  return $output;
}

function generate_person_profile($slug, $extra_title, $mode = MODE_FULL_LIST) {
  $LEGACY_PHOTO_URI_PREFIX = 'http://v0.urban-age.net';
  $pod = new Pod('authors', $slug);
  $fullname = $pod->get_field('name') . ' ' . $pod->get_field('family_name');
  $fullname = trim($fullname);
  $title = $pod->get_field('title');
  
  $fullname_for_heading = $fullname;
  if($title) {
    $fullname_for_heading .= " ($title)";
  }
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
  } elseif(!$role and $organization) {
    $affiliation = $organization;
  } elseif($role and !$organization) {
    $affiliation = $role;
  }
  
  $additional_affiliations = $pod->get_field('additional_affiliations');
  if($additional_affiliations) {
    $additional_affiliations = explode('\n', $additional_affiliations);
    foreach($additional_affiliations as $additional_affiliation) {
      $affiliation .= "<br />\n" . $additional_affiliation;
    }
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
    $output .= "    <h1>$fullname_for_heading</h1>";
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
            <h1><?php the_title(); ?></h1>
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
