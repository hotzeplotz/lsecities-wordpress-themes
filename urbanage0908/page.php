<?php get_header() ?>

	<div id="container" class="page ua908">
<!-- Urban Age BEGIN -->
     <div id="header">
      <?php include (TEMPLATEPATH . '/ua_logo.php'); ?>
      <div id="topnav">
       <!-- start: skip link navigation -->
       <a class="skip" title="skip link" href="#navigation">Skip to the navigation</a><span class="hideme">.</span>
       <a class="skip" title="skip link" href="#content">Skip to the content</a><span class="hideme">.</span>
       <!-- end: skip link navigation -->
       <?php include (TEMPLATEPATH . '/ua_toolslinks.php'); ?>
      </div>
     </div>
	 <div id="nav">
      <!-- skiplink anchor: navigation -->
      <a id="navigation" name="navigation"></a>
      <div class="hlist">
       <!-- main navigation: horizontal list -->
       <?php include (TEMPLATEPATH . '/ua_mainmenu.php'); ?>
      </div>
     </div>
<!-- Urban Age END -->
     
<!-- Urban Age BEGIN -->
     <div id="main" class="clearfix">
     
      <div id="col1">
       <div id="col1_content" class="clearfix">
        <div class="yb_content yb_hover">
         <?php include (TEMPLATEPATH . '/ua_vertnav.php'); ?>
        </div>
       </div>
      </div>
      
      <div id="col2">
       <div id="col2_content" class="clearfix">
        <?php get_sidebar() ?>
       </div>
      </div>
  
  <div id="col3">
   <div id="col3_content">
<!-- Urban Age END -->

		<div id="content">

<?php the_post() ?>

			<div id="post-<?php the_ID() ?>" class="<?php sandbox_post_class() ?>">
				<h2 class="entry-title"><?php the_title() ?></h2>
				<div class="entry-content">
<?php the_content() ?>

<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'sandbox' ) . '&after=</div>') ?>

<?php edit_post_link( __( 'Edit', 'sandbox' ), '<span class="edit-link">', '</span>' ) ?>

				</div>
			</div><!-- .post -->

<?php if ( get_post_custom_values('comments') ) comments_template() // Add a key+value of "comments" to enable comments on this page ?>

		</div><!-- #content -->
	</div><!-- #container -->

<?php get_sidebar() ?>
<?php get_footer() ?>