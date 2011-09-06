<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

	</div><!-- #main -->

	<footer id="colophon" role="contentinfo">

			<?php
				/* A sidebar in the footer? Yep. You can can customize
				 * your footer with three columns of widgets.
				 */
				get_sidebar( 'footer' );
			?>

			<div id="site-generator">
				<?php do_action( 'twentyeleven_credits' ); ?>
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentyeleven' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentyeleven' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'twentyeleven' ), 'WordPress' ); ?></a>
			</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script> 
<script> 
  //<![CDATA[
    window.jQuery || document.write("<script src='<?php bloginfo( 'stylesheet_directory' ); ?>/javascripts/jquery.min.js'>\x3C/script>")
  //]]>
</script> 
<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/javascripts/rails.js?1315255380" type="text/javascript"></script> 
<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/javascripts/plugins.js?1315255380" type="text/javascript"></script> 
<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/javascripts/application.js?1315255380" type="text/javascript"></script> 
 
<script src='<?php bloginfo( 'stylesheet_directory' ); ?>/javascripts/jquery.flickrbomb.min.js'></script> 

</body>
</html>