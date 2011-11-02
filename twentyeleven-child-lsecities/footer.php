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

	<footer id="footer">
    <nav id="footerSitemap">
      <div class="row">
        <section class="fourcol">
          <h3>About</h3>
          <ul>
            <?php wp_list_pages('title_li=&depth=1&child_of=617&sort_column=menu_order&sort_order=ASC&echo=1'); ?>
          </ul>
        </section>
        <section class="fourcol">
          <h3>Who's who</h3>
          <ul>
            <?php wp_list_pages('title_li=&depth=1&child_of=421&sort_column=menu_order&sort_order=ASC&echo=1'); ?>
          </ul>
        </section>
        <section class="fourcol last">
          <h3>Research</h3>
          <ul>
            <?php wp_list_pages('title_li=&depth=2&child_of=306&sort_column=menu_order&sort_order=ASC&echo=1'); ?>
          </ul>
        </section>
      </div>
      <div class="row">
        <section class="fourcol">
          <h3>Publications</h3>
          <ul>
            <?php wp_list_pages('title_li=&depth=2&child_of=309&sort_column=menu_order&sort_order=ASC&echo=1'); ?>
          </ul>
        </section>
        <section class="fourcol">
          <h3>Conferences</h3>
          <ul>
            <?php wp_list_pages('title_li=&depth=1&child_of=96&sort_column=menu_order&sort_order=DESC&echo=1'); ?>
          </ul>
        </section>
        <section class="fourcol last">
          <h3>Events</h3>
          <ul>
            <?php wp_list_pages('title_li=&depth=1&child_of=311&sort_column=menu_order&sort_order=ASC&echo=1'); ?>
          </ul>
        </section>
      </div>
      <div class="row">
        <section class="fourcol">
          <h3>Deutsche Bank Urban Age Award</h3>
          <ul>
            <?php wp_list_pages('title_li=&depth=1&child_of=489&sort_column=menu_order&sort_order=ASC&echo=1'); ?>
          </ul>
        </section>
        <section class="fourcol">
          <h3></h3>
          <ul>
            <?php // wp_list_pages('title_li=&depth=1&child_of=489&sort_column=menu_order&sort_order=ASC&echo=1'); ?>
          </ul>
        </section>
        <section class="fourcol last">
          <?php get_template_part('snippet-organizers'); ?>
        </section>
      </div>
    </nav>
  </footer><!-- #footer -->
</div><!-- #page -->
</div><!-- ## grid # container -->

<?php wp_footer(); ?>
<script type="text/javascript" src="https://use.typekit.com/loj6mke.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/javascripts/rails.js?1315255380" type="text/javascript"></script> 
<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/javascripts/plugins.js?1315255380" type="text/javascript"></script> 
<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/javascripts/application.js?1315255380" type="text/javascript"></script> 
<script src='<?php bloginfo( 'stylesheet_directory' ); ?>/javascripts/jquery.flickrbomb.min.js'></script> 

</body>
</html>