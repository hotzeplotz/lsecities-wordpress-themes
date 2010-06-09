<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<!-- Urban Age 9.08 Template, built on YAML (http://www.yaml.de/) and based on legacy Urban Age html 4.01 Template -->
<!-- Deployed as a Wordpress theme based on Sandbox (http://www.plaintxt.org/themes/sandbox/) -->
<head profile="http://gmpg.org/xfn/11">
	<title><?php wp_title( '-', true, 'right' ); echo wp_specialchars( get_bloginfo('name'), 1 ) ?></title>
	<meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url') ?>" />
<?php wp_head() // For plugins ?>
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url') ?>" title="<?php printf( __( '%s latest posts', 'sandbox' ), wp_specialchars( get_bloginfo('name'), 1 ) ) ?>" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'sandbox' ), wp_specialchars( get_bloginfo('name'), 1 ) ) ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />

<!-- urban-age BEGIN -->
    <meta name="keywords" content="Urban Age, conference, Alfred Herrhausen, LSE, New York, Shanghai, London, Mexico City, Johannesburg, Berlin, Ricky Burdett" />
    <meta name="x-layout" content="Layout based on YAML (http://www.yaml.de/)" />
    
    <!--[if lte IE 7]>
    <link href="http://urban-age.net/stylesheets/ua908/ua908_patch.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    
	
	
    <!-- jQuery stuff BEGIN -->
    <link type="text/css" href="http://urban-age.net/scripts/jqueryui/development-bundle/themes/base/ui.all.css" rel="stylesheet" />

    <script type="text/javascript" src="http://urban-age.net/scripts/jquery/jquery-1.4.1.min.js"></script>
    <script type="text/javascript" src="http://urban-age.net/scripts/jqueryui/development-bundle/ui/ui.core.js"></script>
    <script type="text/javascript" src="http://urban-age.net/scripts/jqueryui/development-bundle/ui/ui.accordion.js"></script>
    <script type="text/javascript" src="http://urban-age.net/scripts/jquery/datatables/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
     $(document).ready(function(){
      $("#accordion").accordion({ autoHeight: false, animated: false });    
      // collapsible lists: expand only the active menu, which is determined by the class name
      //$("#collapsibleList > li > h3[@class='expanded'] ").find("+ div").slideToggle("medium");
      // Toggle the selected menu's class and expand or collapse the menu
      $("#collapsibleList > li > h3").click(function() {
       $(this).toggleClass("expanded").toggleClass("collapsed").find("+ div").slideToggle("medium");
      });
    
      // tablesorter
      $(".dataTable").dataTable({
       "aaSorting": [[ 0, "desc" ]],
       "bPaginate": false
      });
     });
    </script>
    <!-- jQuery stuff END -->

    <!-- slimbox BEGIN -->
    <script type="text/javascript" src="http://urban-age.net/scripts/slimbox2/js/slimbox2.js"></script>
    <!-- slimbox END -->

    <!--[if lt IE 8]>
    <script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE8.js" type="text/javascript"></script>
    <![endif]-->

    <script type="text/javascript" src="http://urban-age.net/0_scripts/menu.js"></script>
    <script type="text/javascript" src="http://urban-age.net/0_scripts/qoute.js"></script>

    <script type="text/javascript">
    <!--
    window.onload = function() {
     initializeMenu("introMenu", "introActuator");
     initializeMenu("netMenu", "netActuator");
     initializeMenu("confMenu", "confActuator");
     initializeMenu("pubMenu", "pubActuator");
     initializeMenu("orgMenu", "orgActuator");
     initializeMenu("contMenu", "contActuator");
     initializeMenu("pressMenu", "pressActuator");
    }
 
    function MM_jumpMenu(targ,selObj,restore){ //v3.0
     eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
     if (restore) selObj.selectedIndex=0;
    }
    //-->
    </script>

    <script src="http://urban-age.net/scripts/cufon-yui.js" type="text/javascript"></script>
    <script src="http://urban-age.net/scripts/BureauGrotesque_400-BureauGrotesque_400.font.js" type="text/javascript"></script>
    <script src="http://urban-age.net/scripts/BureauGrotesque-ThreeSeven.font.js" type="text/javascript"></script>
    <script src="http://urban-age.net/scripts/GothamMedium_500.font.js" type="text/javascript"></script>
    
    <script type="text/javascript">
     Cufon.replace('.cityName', {fontFamily: 'BureauGrotesque-ThreeSeven'});
     Cufon.replace('.zoneName', {fontFamily: 'BureauGrotesque-ThreeSeven'});
     Cufon.replace('.bureauGrotesque', {fontFamily: 'BureauGrotesque'});
     Cufon.replace('.bureauGrotesqueUppercase', {fontFamily: 'BureauGrotesque'});
     Cufon.replace('#ebulletinTitle .h1', {fontFamily: 'BureauGrotesque'});
     Cufon.replace('.ebulletinTitle .h1', {fontFamily: 'BureauGrotesque'});
     Cufon.replace('#ebulletinTitle .h2', {fontFamily: 'BureauGrotesque'});
     Cufon.replace('.ebulletinTitle .h2', {fontFamily: 'BureauGrotesque'});
     Cufon.replace('.ebulletinTocItem h3', {fontFamily: 'BureauGrotesque'});
     Cufon.replace('#ebulletin h2', {fontFamily: 'BureauGrotesque'});
     Cufon.replace('.urbanAgeToolbox .title', {fontFamily: 'BureauGrotesque'});
     Cufon.replace('.conferenceTitle', {fontFamily: 'BureauGrotesque'});
     Cufon.replace('.homepageMainHeadlines', {fontFamily: 'BureauGrotesque'});
     Cufon.replace('.reportDownloads .downloadBox span', {fontFamily: 'BureauGrotesque'});
    </script>
<!-- urban-age END -->

</head>

<body class="<?php sandbox_body_class() ?>">
<!-- urban-age BEGIN -->
<a id="pageTopAnchor" name="pageTop">&#160;</a>
<!-- urban-age END -->
<div id="wrapper" class="page_margins hfeed">

<!--
	<div id="header">
		<h1 id="blog-title"><span><a href="<?php bloginfo('home') ?>/" title="<?php echo wp_specialchars( get_bloginfo('name'), 1 ) ?>" rel="home"><?php bloginfo('name') ?></a></span></h1>
		<div id="blog-description"><?php bloginfo('description') ?></div>
	</div>--><!--  #header -->

<!--
	<div id="access">
		<div class="skip-link"><a href="#content" title="<?php _e( 'Skip to content', 'sandbox' ) ?>"><?php _e( 'Skip to content', 'sandbox' ) ?></a></div>
		<?php sandbox_globalnav() ?>
	</div>--><!-- #access -->
