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

	<footer id="footer" class="row">
<nav id="footerSitemap">
<section class="threecol">
<h3>Who's who</h3>
<ul>
<li><a href="/about/whos-who/governing-board/">Governing board</a></li>
<li><a href="/about/whos-who/advisory-board/">Advisory board</a></li>
<li><a href="/about/whos-who/executive-group/">Executive Group</a></li>
<li><a href="/about/whos-who/staff/">Staff</a></li>
<li><a href="/ua/whos-who/board/">Urban Age board</a></li>
<li><a href="/ua/whos-who/contributors/">Urban Age contributors</a></li>
<li><a href="/about/whos-who/institutional-partners/">Institutional partners</a></li>
</ul>
</section>
<section class="threecol">
<h3>Conferences</h3>
<ul>
 <?php wp_list_pages('title_li=&depth=1&child_of=96&sort_column=menu_order&sort_order=DESC&echo=1'); ?>
</ul>
</section>
<section class="threecol">
<h3>Publications</h3>
<ul>
<li><a href="/publications/the-endless-city/">The Endless City</a></li>
<li><a href="/publications/living-in-the-endless-city/">Living in the Endless City</a></li>
<li><a href="/publications/conference-newspapers/">Conference newspapers</a></li>
<li><a href="/publications/research-reports/">Research reports</a></li>
</ul>
</section>
<section class="threecol last">
<h3>Deutsche Bank Urban Age Award</h3>
<ul>
<li><a target="_blank" href="http://www.alfred-herrhausen-society.org/en/1605.html">2010 | Mexico City</a></li>
<li><a target="_blank" href="http://www.alfred-herrhausen-society.org/en/uaa_istanbul.html">2009 | Istanbul</a></li>
<li><a target="_blank" href="http://www.alfred-herrhausen-society.org/en/50.html">2008 | São Paulo</a></li>
<li><a target="_blank" href="http://www.alfred-herrhausen-society.org/en/52.html">2007 | Mumbai</a></li>
</ul>
</section>
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