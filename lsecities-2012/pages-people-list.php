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

$people_list = get_post_meta($post->ID, 'people_list', true);

// save here all the people whose profile has already been added to output
$people_in_output_full = array();
$people_in_output_summary = array();

$lists = array(
  'lsecities-staff' =>
    array('lsecities-staff-mgmt'),
    array('lsecities-staff')
);

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
