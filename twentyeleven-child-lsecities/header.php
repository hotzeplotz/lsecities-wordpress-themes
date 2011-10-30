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
if($toplevel_ancestor == 393) { $toplevel_ancestor = ''; }
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
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory') ?>/stylesheets/cssgrid.net/1140.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory') ?>/stylesheets/flickrbomb.css" />
<link href='http://fonts.googleapis.com/css?family=Gentium+Book+Basic:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<?php wp_enqueue_style('fonts_ubuntu', get_stylesheet_directory_uri() . '/stylesheets/fonts/ubuntu/stylesheet.css'); ?>
<?php wp_enqueue_style('fonts_linux_libertine', get_stylesheet_directory_uri() . '/stylesheets/fonts/linux-libertine/stylesheet.css'); ?>
<?php wp_enqueue_script('jquery.quickflip', get_stylesheet_directory_uri() . '/javascripts/jquery.quickflip.min.js', 'jquery', false, true); ?>
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

	<div class='container' id='container'> <!-- ## grid -->
		<header id='header'>
			<div class='row'>
				<a href="/<?php if($urban_age_section) { echo 'ua/'; }?>">
					<div class='full fivecol' id='<?php echo $logo_element_id ; ?>'>
						&nbsp;
					</div>
				</a>
				<div class='sevencol last' id='toolbox'>
					<div id='searchbox'>
						<form action='http://www.google.com/u/urbanAge' id='search-box' method='get'>
							<div class='hiddenFields'>
								<input name='domains' type='hidden' value='www.urban-age.net' />
								<input name='sitesearch' type='hidden' value='www.urban-age.net' />
								<input id='queryfield' name='q' placeholder='Search LSE Cities' size='40' type='text' />
							</div>
						</form>
						<div class='clearfix' id='persistentLogo'>
						<?php if($urban_age_section) : ?>
								<a href="/"><img id='lsecitiesSmallLogo' src='<?php echo get_stylesheet_directory_uri() ?>/images/logo_lsecities_nostrapline_small.gif'></a>
						<?php endif ; ?>
						</div>
					</div>
				</div><!-- #toolbox -->
				<nav id='level1nav' class="row">
					<ul>
					<?php wp_list_pages('depth=1&sort_column=menu_order&title_li=&exclude=393,395,562'); ?>
					</ul>
				</nav><!-- #level1nav -->
			</div><!-- row -->
			<div class='row' id='mainmenus'>
				<nav class='twelvecol section-ancestor-<?php echo $toplevel_ancestor ; ?>' id='level2nav'>
				<?php if($toplevel_ancestor) : ?>
					<ul>
					<?php echo $level2nav ; ?>
					</ul>
				<?php endif ; ?>
				</nav>
			</div><!-- #mainmenus -->

			<?php
				// Check to see if the header image has been removed
				$header_image = get_header_image();
				if ( ! empty( $header_image ) ) :
			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php
					// The header image
					// Check if this is a post or page, if it has a thumbnail, and if it's a big one
					if ( is_singular() &&
							has_post_thumbnail( $post->ID ) &&
							( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( HEADER_IMAGE_WIDTH, HEADER_IMAGE_WIDTH ) ) ) &&
							$image[1] >= HEADER_IMAGE_WIDTH ) :
						// Houston, we have a new header image!
						echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
					else : ?>
					<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
				<?php endif; // end check for featured image or standard header ?>
			</a>
			<?php endif; // end check for removed header image ?>

<!--
			<nav id="access" role="navigation">
				<h3 class="assistive-text"><?php _e( 'Main menu', 'twentyeleven' ); ?></h3>
				<?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff. */ ?>
				<div class="skip-link"><a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to primary content', 'twentyeleven' ); ?>"><?php _e( 'Skip to primary content', 'twentyeleven' ); ?></a></div>
				<div class="skip-link"><a class="assistive-text" href="#secondary" title="<?php esc_attr_e( 'Skip to secondary content', 'twentyeleven' ); ?>"><?php _e( 'Skip to secondary content', 'twentyeleven' ); ?></a></div>
				<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assiged to the primary position is the one used. If none is assigned, the menu with the lowest ID is used. */ ?>
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav> --> <!-- #access -->
		</div><!-- .row -->
	</header><!-- #branding -->

	<div id="main" class="row">
