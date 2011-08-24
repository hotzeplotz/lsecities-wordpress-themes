<?php
/* Template Name: Article Pods - index */
/**
 * The template used for lists of Article Pods
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<?php get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
    
    
    
    <?php
      $pod = new Pod('article');
      $pod->findRecords('name ASC');
      $total_objects = $pod->getTotalRows();
        ?>

        <?php if( $total_objects > 0 ) : ?>
          <ul>
            <?php while ( $pod->fetchRecord() ) : ?>
              <li>
                <a href="<?php echo get_permalink(); ?><?php echo $pod->get_field('permalink'); ?>/">
                  <?php echo $pod->get_field('name'); ?>
                </a>
              </li>

            <?php endwhile ?>
          </ul>
        <?php endif ?>
        
        
        
        
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
