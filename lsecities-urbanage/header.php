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
    <link href="<?php echo $ua_base_uri; ?>/stylesheets/ua908/ua908_patch.css" rel="stylesheet" type="text/css" />
    <![endif]-->

 <!-- jQuery stuff BEGIN -->
 <script type="text/javascript" src="<?php echo $ua_base_uri; ?>/scripts/jquery/jquery-1.5.1.min.js"></script>
 <script type="text/javascript" src="<?php echo $ua_base_uri; ?>/scripts/jquery/ui/1.8.10-ua0/js/jquery-ui-1.8.10.custom.min.js"></script>
 <script type="text/javascript" src="<?php echo $ua_base_uri; ?>/scripts/jquery/plugins/datatables/jquery.dataTables.min.js"></script>
<!-- <script type="text/javascript" src="<?php echo $ua_base_uri; ?>/scripts/jquery/zrssfeed/jquery.zrssfeed.min.js"></script> -->
 <script type="text/javascript" src="<?php echo $ua_base_uri; ?>/scripts/jquery/plugins/zrssfeed/1.1.1+lsecities/jquery.zrssfeed.min.js"></script>
 <script type="text/javascript" src="<?php echo $ua_base_uri; ?>/scripts/jquery/plugins/validate/jquery.validate.min.js"></script>
 <script type="text/javascript" src="<?php echo $ua_base_uri; ?>/scripts/jquery/plugins/vticker/jquery.vticker.js"></script>
 <script type="text/javascript" src="<?php echo $ua_base_uri; ?>/scripts/jquery/plugins/nivoslider/2.4/jquery.nivo.slider.pack.js"></script>
 <script type="text/javascript" src="<?php echo $ua_base_uri; ?>/scripts/jquery/plugins/hoverintent/r6/jquery.hoverintent.min.js"></script>
 <script type="text/javascript" src="<?php echo $ua_base_uri; ?>/scripts/jquery/plugins/superfish/1.4.8/superfish.js"></script>
 <script type="text/javascript" src="<?php echo $ua_base_uri; ?>/scripts/jquery/plugins/tweet/e9dbe84d61d6a5a035c9/jquery.tweet.js"></script>
 <!-- slimbox BEGIN -->
 <script type="text/javascript" src="<?php echo $ua_base_uri; ?>/scripts/jquery/plugins/slimbox/2.04/js/slimbox2.js"></script>
 <!-- slimbox END -->

 <script type="text/javascript">
  $(document).ready(function(){
   $("#accordion").accordion({ autoHeight: false, animated: false });
   $("#collapsibleList > li > h3").click(function() {
    $(this).toggleClass("expanded").toggleClass("collapsed").find("+ div").slideToggle("medium");
   });
   $(".dataTable").dataTable({ "aaSorting": [[ 0, "desc" ]], "bPaginate": false });
   $('#lseCitiesSubscriptionForm').validate({ rules: { email2: { equalTo: '#email1', } } });
   $('#slider, .sliderhalf').nivoSlider({ effect: 'fade', pauseTime: 8000, directionNavHide: false  });
   $('ul.menu').superfish();
   $('.imagegallery.loop > a').slimbox({loop: true});
   $('#feedControl').rssfeed('http://lsecities.net/archives/category/urban-age/feed', {
    limit: 5,
    time: false,
    header: false,
    snippet: false,
    key: "ABQIAAAAZGyLcr2w2IwIanQOT_23-xQ9VN5nDw6eyrxocscc-xeihEkAnhT4bxUhovQw_0oWUEj85K_qGfCTkg"
   }).ajaxStop(function() { $('#feedControl div.rssBody').vTicker({ showItems: 10, animation: 'fade', height: 800, pause: 7000 }); });
  });
  </script>
 <!-- jQuery stuff END -->

 <!-- webtype.com BEGIN -->
 <link href="http://cloud.webtype.com/css/9044dce3-7052-4e0e-9dbb-377978412ca7.css" rel="stylesheet" type="text/css" />
 <!-- webtype.com END -->


    <!--[if lt IE 9]>
    <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
    <![endif]-->

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
