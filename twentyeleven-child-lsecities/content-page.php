<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

$wide_layout = strtolower(get_post_meta(get_the_ID(), "layout", true)) == 'wide' ? 1 : 0;
$main_area_class = $wide_layout ? 'ninecol' : 'sixcol';
?>

<div>

<article id="post-<?php the_ID(); ?>" <?php post_class($main_area_class); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
<?php if($wide_layout == false) : ?>
<aside class="threecol">
  <?php
    echo get_post_meta(get_the_ID(), "aside", true);
  ?>
</aside>
<?php endif; ?>

<?php get_template_part('nav'); ?>

</div><!-- .row -->
