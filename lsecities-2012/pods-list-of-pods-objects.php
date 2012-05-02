<?php
/**
 * Template Name: Pods - List of Pods objects
 * Description: The template used to list Pods objects
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
<?php
/**
 * TODO: For now, list types are hardcoded - make this flexible ASAP
 */
$BASE_URI = '/media/objects/events/';
$TRACE_ENABLED = is_user_logged_in();
$TRACE_PREFIX = 'pods-list-of-pods-objects';
$pod_type = get_post_meta(get_the_ID(), 'list_pods', true);
// set toplevel ancestor explicitly as we are outside of WP's hierarchy
global $pods_toplevel_ancestor;
switch($pod_type) {
  case 'upcoming_events':
  case 'past_events':
    $pods_toplevel_ancestor = 311;
    break;
  case 'research_projects':
  case 'past_research_projects':
    $pods_toplevel_ancestor = 306;
    break;
}
?>
<?php get_header(); ?>
<div role="main">
<?php if ( have_posts() ) : the_post(); endif; ?>
<div id="post-<?php the_ID(); ?>" <?php post_class('lc-article lc-list-of-pods-objects'); ?>>
<?php echo var_trace($pod_type, $TRACE_PREFIX, $TRACE_ENABLED); ?>
          <div class='ninecol' id='contentarea'>
            <div class='top-content'>
              <article class='wireframe row'>
                <header>
                  <h1><?php the_title(); ?></h1>
                </header>
                <?php switch($pod_type):
                  case 'upcoming_events':
                    $HIDE_PAST_EVENTS = true;
                    $BASE_URI = '/media/objects/events/';
                    $IN_CONTENT_AREA = true;
                ?>
                <div id='navigationarea'>
                <?php get_template_part( 'nav', 'events' ); ?>
                </div>
                <?php break;
                  case 'past_events':
                    $HIDE_UPCOMING_EVENTS = true;
                    $BASE_URI = '/media/objects/events/';
                    $IN_CONTENT_AREA = true;
                ?>
                <div id='navigationarea'>
                <?php get_template_part( 'nav', 'events' ); ?>
                </div>                
                <?php break;
                  case 'research_projects':
                    $HIDE_PAST_PROJECTS = true;
                    $IN_CONTENT_AREA = true;
                    $BASE_URI = '/objects/research-projects/';
                ?>
                <div id='navigationarea'>
                <?php get_template_part( 'nav', 'research' ); ?>
                </div>                
                <?php break;
                  case 'past_research_projects':
                    $HIDE_CURRENT_PROJECTS = true;
                    $IN_CONTENT_AREA = true;
                    $BASE_URI = '/objects/research-projects/';
                ?>
                <div id='navigationarea'>
                <?php get_template_part( 'nav', 'research' ); ?>
                </div>                
                <?php break; ?>
                <?php endswitch; ?>
              </article>
            </div><!-- .top-content -->
          </div>

          <div id="navigationarea" class='wireframe threecol last'>
            <?php switch(get_post_meta(get_the_ID(), 'list_pods', true)):
              case 'research_projects':
                $HIDE_CURRENT_PROJECTS = true;
                $HIDE_PAST_PROJECTS = false;
                $BASE_URI = '/objects/research-projects/';
                $IN_CONTENT_AREA = false;
            ?>
            <?php get_template_part( 'nav', 'research' ); ?>                
            <?php break;
              case 'past_research_projects':
                $HIDE_PAST_PROJECTS = true;
                $HIDE_CURRENT_PROJECTS = false;
                $IN_CONTENT_AREA = false;
                $BASE_URI = '/objects/research-projects/';
            ?>
            <?php get_template_part( 'nav', 'research' ); ?>              
            <?php break; ?>
            <?php endswitch; ?>
          </div>
</div><!-- #contentarea -->
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
