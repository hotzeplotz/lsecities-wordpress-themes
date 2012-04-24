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
</div><!-- #page -->
	<footer id="footer">
    <nav id="footerSitemap">
      <div class="row">
        <section class="fourcol">
          <h1>About</h1>
          <ul>
            <?php wp_list_pages('title_li=&depth=1&child_of=617&sort_column=menu_order&sort_order=ASC&echo=1'); ?>
          </ul>
        </section>
        <section class="fourcol">
          <h1>Who's who</h1>
          <ul>
            <?php wp_list_pages('title_li=&depth=1&child_of=421&sort_column=menu_order&sort_order=ASC&echo=1'); ?>
          </ul>
        </section>
        <section class="fourcol last">
          <h1>Research</h1>
          <ul>
            <?php wp_list_pages('title_li=&depth=2&child_of=306&sort_column=menu_order&sort_order=ASC&echo=1'); ?>
          </ul>
        </section>
      </div>
      <div class="row">
        <section class="fourcol">
          <h1>Publications</h1>
          <ul>
            <?php wp_list_pages('title_li=&depth=2&child_of=309&sort_column=menu_order&sort_order=ASC&echo=1'); ?>
          </ul>
        </section>
        <section class="fourcol">
          <h1>Conferences</h1>
          <ul>
            <?php wp_list_pages('title_li=&depth=1&child_of=96&sort_column=menu_order&sort_order=DESC&echo=1'); ?>
          </ul>
        </section>
        <section class="fourcol last">
          <h1>Deutsche Bank Urban Age Award</h1>
          <ul>
            <?php wp_list_pages('title_li=&depth=1&child_of=489&sort_column=menu_order&sort_order=ASC&echo=1'); ?>
          </ul>
        </section>
      </div>
      <div class="row">
        <section class="fourcol">
          <h1>Events</h1>
          <ul>
            <?php wp_list_pages('title_li=&depth=1&child_of=311&sort_column=menu_order&sort_order=ASC&echo=1'); ?>
          </ul>
        </section>
        <section class="fourcol">
          <h1></h1>
          <ul>
            <?php get_template_part('snippet-colophon'); ?>
          </ul>
        </section>
        <section class="fourcol last">
          <?php get_template_part('snippet-organizers'); ?>
        </section>
      </div>
    </nav>
  </footer><!-- #footer -->
</div><!-- ## grid # container -->

<?php wp_footer(); ?>
<script type="text/javascript" src="https://use.typekit.com/ftd3lpp.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<script>
      //<![CDATA[
        jQuery(document).ready(function($) {
          $('.flexslider').flexslider(({
            animation: "slide",
            slideshow: false,
            mousewheel: false
          }));
          $('.citieslist li:nth-child(odd)').addClass('alternate');
          $('.accordion').accordion({autoHeight: false});
        });
      //]]>
</script>
</body>
</html>
