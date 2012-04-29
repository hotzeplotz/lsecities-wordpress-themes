<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

	<div id="primary">
		<div id="content" role="main">

			<article id="post-0" class="post error404 not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Sorry, we could not find the content you are looking for.', 'lsecities-2012' ); ?></h1>
				</header>

				<div class="entry-content">
					<div class="widget">
          <p><?php _e( 'We have just moved all our legacy content to this new website; all the old web addresses should be redirected to their new location, but we might have missed the odd page: we are monitoring all the "page not found" errors visitors might get and aim to rectify any glitches - in the meanwhile, you might want to use the search form below to locate the content you are looking for.', 'lsecities-2012' ); ?></p>

					<?php get_search_form(); ?>
          </div>
          
					<?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ), array( 'widget_id' => '404' ) ); ?>

					<div class="widget">
						<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'twentyeleven' ); ?></h2>
						<ul>
						<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
						</ul>
					</div>

					<?php
					$archive_content = '<p>' . _e( 'Try looking in the monthly archives.', 'lsecities-2012' ) . '</p>';
					the_widget( 'WP_Widget_Archives', array('count' => 0 , 'dropdown' => 1 ), array( 'after_title' => '</h2>'.$archive_content ) );
					?>

					<?php // the_widget( 'WP_Widget_Tag_Cloud' ); ?>

				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
