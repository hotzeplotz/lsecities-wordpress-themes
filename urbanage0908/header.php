<?xml version="1.0"?>
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
    <link href="[% base_uri %]/stylesheets/ua908/ua908_patch.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    
    <script type="text/javascript" src="[% base_uri %]/0_scripts/menu.js"></script>
    <script type="text/javascript" src="[% base_uri %]/0_scripts/qoute.js"></script>

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
