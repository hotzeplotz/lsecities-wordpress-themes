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
        </div><!-- #core -->
      </div><!-- #main -->
    </div>
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.js" type="text/javascript"></script>

    <script>
      //<![CDATA[
        window.jQuery || document.write("<script src='/javascripts/jquery.min.js'>\x3C/script>")
      //]]>
    </script>
    
    <?php wp_footer(); ?>
    
    <script type="text/javascript" src="https://use.typekit.com/loj6mke.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
    <script src="<?php bloginfo( 'stylesheet_directory' ); ?>/javascripts/rails.js?1315255380" type="text/javascript"></script> 
    <script src="<?php bloginfo( 'stylesheet_directory' ); ?>/javascripts/plugins.js?1315255380" type="text/javascript"></script> 
    <script src="<?php bloginfo( 'stylesheet_directory' ); ?>/javascripts/application.js?1315255380" type="text/javascript"></script> 
    <script type="text/javascript" src="http://v0.urban-age.net/scripts/jquery/plugins/superfish/1.4.8/superfish.js"></script>

    <script type="text/javascript">
  jQuery(document).ready(function(){
   // next function is ported to jQuery from legacy Urban Age JavaScript code embedded on each page
   jQuery("#ebulletinArchive .DDMenu").change(function() {
    var location = $('select option:selected').attr('value');
    top.location.href = location;
   });
   jQuery('ul.menu').superfish();
});
    </script><!-- jQuery functions -->

  </body>
</html>
