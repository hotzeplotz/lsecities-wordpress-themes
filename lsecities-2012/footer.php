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
        <div class="onecol">&nbsp;</div>
        <div class="twocol">
          <h1>About</h1>
          <ul>
            <?php wp_list_pages('title_li=&depth=1&child_of=617&sort_column=menu_order&sort_order=ASC&echo=1'); ?>
          </ul>
          <h1>Who's who</h1>
          <ul>
            <?php wp_list_pages('title_li=&depth=1&child_of=421&sort_column=menu_order&sort_order=ASC&echo=1'); ?>
          </ul>
        </div>
        <div class="twocol">
          <h1>Research</h1>
          <ul>
            <?php wp_list_pages('title_li=&depth=2&child_of=306&sort_column=menu_order&sort_order=ASC&echo=1'); ?>
          </ul>
        </div>
        <div class="twocol">
          <h1>Publications</h1>
          <ul>
            <?php wp_list_pages('title_li=&depth=1&child_of=309&sort_column=menu_order&sort_order=ASC&echo=1'); ?>
          </ul>
          <h1>Events</h1>
          <ul>
            <?php wp_list_pages('title_li=&depth=1&child_of=311&sort_column=menu_order&sort_order=ASC&echo=1'); ?>
          </ul>
        </div>
        <div class="twocol">
          <h1>Urban Age</h1>
          <ul>
            <?php wp_list_pages('title_li=&depth=1&child_of=94&sort_column=menu_order&sort_order=ASC&echo=1'); ?>
          </ul>
        </div>
  <!--  <section class="fourcol">
          <h1></h1>
          <ul>
            <?php get_template_part('snippet-colophon'); ?>
          </ul>
        </section> -->
        <div class="twocol">
          <?php get_template_part('snippet-organizers'); ?>
        </div>
        <div class="onecol last">&nbsp;</div>
      </div>
    </nav>
  </footer><!-- #footer -->
</div><!-- ## grid # container -->

<?php wp_footer(); ?>

<script src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
<script src="http://lsecities.net/wp-content/plugins/cookie-control/js/cookieControl-4.1.min.js?ver=3.3.2" type="text/javascript"></script>
<script type="text/javascript">//<![CDATA[
  cookieControl({
      introText:'<p>This site uses some unobtrusive cookies to store information on your computer.</p>',
      fullText:'<p>Some cookies on this site are essential, and the site won\'t work as expected without them. These cookies are set when you submit a form, login or interact with the site by doing something that goes beyond clicking on simple links.</p><p>We also use some non-essential cookies to anonymously track visitors or enhance your experience of the site. If you\'re not happy with this, we won\'t set these cookies but some nice features of the site may be unavailable.</p><p>By using our site you accept the terms of our <a href="http://lsecities.net/info/privacy-policy/">Privacy Policy</a>.</p>',
      position:'right', // left or right
      shape:'triangle', // triangle or diamond
      theme:'light', // light or dark
      startOpen:false,
      autoHide:6000,
      subdomains:false,
      onAccept:function(){ccAddAnalytics()},
      onReady:function(){ccAddAnalytics()},
      onCookiesAllowed:function(){ccAddAnalytics()},
      onCookiesNotAllowed:function(){},
      countries:'United Kingdom' // Or supply a list ['United Kingdom', 'Greece']
      });

      function ccAddAnalytics() {
        jQuery.getScript("http://www.google-analytics.com/ga.js", function() {
          var GATracker = _gat._createTracker('UA-5245143-1');
          GATracker._trackPageview();
        });
      }
   //]]>
</script>  

<script>
      //<![CDATA[
        // add jQuery regex filter (http://james.padolsey.com/javascript/regex-selector-for-jquery/)
        jQuery.expr[':'].regex = function(elem, index, match) {
          var matchParams = match[3].split(','),
          validLabels = /^(data|css):/,
          attr = {
            method: matchParams[0].match(validLabels) ? 
                        matchParams[0].split(':')[0] : 'attr',
            property: matchParams.shift().replace(validLabels,'')
          },
          regexFlags = 'ig',
          regex = new RegExp(matchParams.join('').replace(/^\s+|\s+$/g,''), regexFlags);
          return regex.test(jQuery(elem)[attr.method](attr.property));
        };
        jQuery(document).ready(function($) {
          $('.flexslider').flexslider(({
            animation: "slide",
            slideshow: false,
            mousewheel: false,
<?php global $jquery_options; if($jquery_options) { echo $jquery_options; } ?>

          }));
          $('.runon li:nth-child(odd)').addClass('alternate');
          $('.accordion').accordion({autoHeight: false});
          if($('input:radio[name=group[8245]]').length) {
            $('input:radio[name=group[8245]]')[0].checked = true;
          };
          $(':regex(href,(http:\/\/lsecities\.net\/)?\/files\/.*.pdf)').click(function() {
            var href = $(this).attr('href').replace('^http:\/\/lsecities\.net', '');
            console.log("logging PDF download for URI %s", fullhref, href);
            _gaq.push(['_trackPageview', href]);
          });
        });
      //]]>
</script>
</body>
</html>
