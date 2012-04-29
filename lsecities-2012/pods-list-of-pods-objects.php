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
?>


<?php get_header(); ?>

<div role="main">

<?php if ( have_posts() ) : the_post(); endif; ?>

<div id="post-<?php the_ID(); ?>" <?php post_class('lc-article lc-list-of-pods-objects'); ?>>

          <div class='ninecol' id='contentarea'>
            <div class='top-content'>
              <article class='wireframe row'>
                <header>
                  <h1><?php the_title(); ?></h1>
                </header>
                <?php switch(get_post_meta($post->ID, 'list_pods')):
                  case 'upcoming_events':
                    $HIDE_PAST_EVENTS = true;
                ?>
                <div id='navigationarea'>
                <?php get_template_part( 'nav', 'events' ); ?>
                </div>
                <?php break;
                  case 'past_events':
                    $HIDE_UPCOMING_EVENTS = true
                ?>
                <div id='navigationarea'>
                <?php get_template_part( 'nav', 'events' ); ?>
                </div>                
                <?php endswitch; ?>
              </article>
            </div><!-- .top-content -->
          </div>

          <div class='wireframe threecol last'>    
          </div>

</div><!-- #contentarea -->
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
