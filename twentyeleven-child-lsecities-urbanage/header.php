<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?><?php
if($TRACE_HEADER) { error_log('header.php starting for post with ID ' . $post->ID); }
$ancestors = get_ancestors($post->ID, 'page');
array_unshift($ancestors, $post->ID);
$toplevel_ancestor = array_pop($ancestors);

// If we are on the root frontpage ('/', page ID 393), set ancestor to nil
if($toplevel_ancestor == 393) { $toplevel_ancestor = ''; }

// If we are processing a Pods page for the Article pod, manually set our current position
if($pods_toplevel_ancestor) { $toplevel_ancestor = $pods_toplevel_ancestor; }

if($TRACE_HEADER) { error_log('ancestors (array): ' . var_export($ancestors, true)); }
if($TRACE_HEADER) { error_log('ancestor[0]: ' . $ancestors[0]); }
if($TRACE_HEADER) { error_log('toplevel_ancestor: ' . $toplevel_ancestor); }
$level2nav = wp_list_pages('child_of=' . $toplevel_ancestor . '&depth=1&sort_column=menu_order&title_li=&echo=0');

// check if we are in the Urban Age section
$urban_age_section = ($toplevel_ancestor == 94) ? true : false;
$logo_element_id = $urban_age_section ? 'ualogo' : 'logo';

?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Anton'>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory') ?>/stylesheets/cssgrid.net/1140.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>

    <div class='container' id='container'>
      <header id='header'>
        <div class='row'>

          <div class='full ninecol' id='ualogo'>
            <img alt='Urban Age' src='<?php bloginfo('stylesheet_directory') ?>/images/logo_urbanage_strapline.gif'>
          </div>
          <div class='threecol last' id='toolbox'>
            <div id='searchbox'>
              <form action='http://www.google.com/u/urbanAge' id='search-box' method='get'>
                <div class='hiddenFields'>
                  <input name='domains' type='hidden' value='www.urban-age.net'>
                  <input name='sitesearch' type='hidden' value='www.urban-age.net'>

                  <input id='queryfield' name='q' placeholder='Search Urban Age' size='40' type='text'>
                </div>
              </form>
              <div id='socialbuttons'>
                <h4>Follow us:</h4>
                <ul>
                  <li>
                    <a href='https://facebook.com/lsecities' title='Facebook'>

                      <img alt='Follow us on Facebook' src='http://preview.urban-age.net/images/art/icons/thegforce-hand-drawn/Facebook/24x24.png'>
                    </a>
                  </li>
                  <li>
                    <a href='https://twitter.com/#!/LSECities' title='Twitter'></a>
                    <img alt='Follow us on Twitter' src='http://preview.urban-age.net/images/art/icons/thegforce-hand-drawn/Twitter/24x24.png'>
                  </li>
                  <li>
                    <a href='https://youtube.com/user/UrbanAge' title='YouTube channel'></a>

                    <img alt='Follow us on YouTube' src='http://preview.urban-age.net/images/art/icons/thegforce-hand-drawn/Youtube/24x24.png'>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class='row top15'>
          <div class='twelvecol last' id='mainMenu'>

            <ul class='menu sf-js-enabled sf-shadow'>
              <li class='leaf'>
                <a href='/'>Home</a>
              </li>
              <li class='leaf'>
                <a href='/introduction/idea/'>About</a>
              </li>
              <li class='tree'>

                <span class='leaf'>
                  <a href='/network/'>Who's who</a>
                </span>
                <ul class='tree' style='display: none; visibility: hidden; '>
                  <!--
                    <li class="leaf"><a href="/network/board/">Board</a></li>
                    <li class="leaf"><a href="/network/staff/">Staff</a></li>
                    <li class="leaf"><a href="/network/advisors/">Advisors and Contributors</a></li>
                    <li class="leaf"><a href="/network/institutions/">Institutional Partners</a></li>
                  -->
                  <li class='leaf'>
                    <a href='/02_network/network_Board.html'>Board</a>
                  </li>

                  <li class='leaf'>
                    <a href='/02_network/network_Staff.html'>Staff</a>
                  </li>
                  <li class='leaf'>
                    <a href='/02_network/network_Advisors.html'>Advisors and Contributors</a>
                  </li>
                  <li class='leaf'>
                    <a href='/02_network/network_Institutions.html'>Institutional Partners</a>

                  </li>
                </ul>
              </li>
              <li class='tree'>
                <span class='leaf'>
                  <a href='/conferences/'>Conferences</a>
                </span>
                <ul class='tree' style='display: none; visibility: hidden; '>

                  <li class='leaf'>
                    <a href='/03_conferences/conf_newYork.html'>New York</a>
                  </li>
                  <li class='leaf'>
                    <a href='/03_conferences/conf_shanghai.html'>Shanghai</a>
                  </li>
                  <li class='leaf'>
                    <a href='/03_conferences/conf_london.html'>London</a>

                  </li>
                  <li class='leaf'>
                    <a href='/03_conferences/conf_mexicoCity.html'>Mexico City</a>
                  </li>
                  <li class='leaf'>
                    <a href='/03_conferences/conf_johannesburg.html'>Johannesburg</a>
                  </li>
                  <li class='leaf'>

                    <a href='/03_conferences/conf_berlin.html'>Berlin</a>
                  </li>
                  <li class='leaf'>
                    <a href='/03_conferences/conf_halle.html'>German Cities, Halle</a>
                  </li>
                  <li class='leaf'>
                    <a href='/03_conferences/conf_mumbai.html'>Mumbai</a>

                  </li>
                  <li class='leaf'>
                    <a href='/03_conferences/conf_saoPaulo.html'>São Paulo</a>
                  </li>
                  <li class='leaf'>
                    <a href='/conferences/istanbul/'>Istanbul</a>
                  </li>
                  <li class='leaf'>

                    <a href='/conferences/chicago/'>Chicago</a>
                  </li>
                  <li class='leaf'>
                    <a href='/conferences/hongkong/'>Hong Kong</a>
                  </li>
                </ul>
              </li>
              <li class='leaf'>

                <a href='/events/publicLectures/'>Events</a>
              </li>
              <li class='leaf'>
                <a href='/introduction/investigation/'>Research</a>
              </li>
              <li class='tree'>
                <span class='leaf'>
                  <a href='/publications/'>Publications</a>

                </span>
                <ul class='tree' style='display: none; visibility: hidden; '>
                  <li class='leaf'>
                    <a href='/publications/newsletter/current/'>Newsletter</a>
                  </li>
                  <li class='leaf'>
                    <a href='/publications/theEndlessCity/'>The Endless City</a>
                  </li>

                  <li class='leaf'>
                    <a href='/publications/living-in-the-endless-city/'>Living in the Endless City</a>
                  </li>
                  <li class='leaf'>
                    <a href='/publications/newspapers/'>Conference newspapers</a>
                  </li>
                  <li class='leaf'>
                    <a href='/publications/reports/'>Research reports</a>

                  </li>
                  <li class='leaf'>
                    <a href='/publications/archive/'>Archive</a>
                  </li>
                </ul>
              </li>
              <li class='tree'>
                <span class='leaf'>

                  <a href='/dbua-award/'>Award</a>
                </span>
                <ul class='tree' style='display: none; visibility: hidden; '>
                  <li class='leaf'>
                    <a href='http://www.alfred-herrhausen-society.org/en/1605.html' target='_blank'>2010 Mexico City</a>
                  </li>
                  <li class='leaf'>
                    <a href='http://www.alfred-herrhausen-society.org/en/uaa_istanbul.html' target='_blank'>2009 Istanbul</a>

                  </li>
                  <li class='leaf'>
                    <a href='http://www.alfred-herrhausen-society.org/en/50.html' target='_blank'>2008 São Paulo</a>
                  </li>
                  <li class='leaf'>
                    <a href='http://www.alfred-herrhausen-society.org/en/52.html' target='_blank'>2007 Mumbai</a>
                  </li>
                </ul>

              </li>
              <li class='leaf'>
                <a href='http://lsecities.net/category/urban-age'>News</a>
              </li>
              <li class='leaf'>
                <a href='/press/information/'>Press</a>
              </li>
              <li class='leaf'>

                <a href='http://www2.lse.ac.uk/LSECities/' target='_blank'>LSE Cities</a>
              </li>
            </ul>
          </div>
        </div>
      </header>
    
<div class='row' id='main' role='main'>
        <div id='flash'>

        </div>
        <nav class='twocol' id='conferencesmenu'>
          <ul>
            <li>
              <a href='#'>New York</a>
            </li>
            <li>
              <a href='#'>Shanghai</a>

            </li>
            <li>
              <a href='#'>London</a>
            </li>
            <li>
              <a href='#'>Mexico City</a>
            </li>
            <li>

              <a href='#'>Johannesburg</a>
            </li>
            <li>
              <a href='#'>Berlin</a>
            </li>
            <li>
              <a href='#'>Mumbai</a>

            </li>
            <li>
              <a href='#'>São Paulo</a>
            </li>
            <li>
              <a href='#'>Istanbul</a>
            </li>
            <li>

              <a href='#'>Chicago</a>
            </li>
            <li>
              <a href='#'>Hong Kong</a>
            </li>
          </ul>
        </nav>
        <div class='tencol last' id='core'>

