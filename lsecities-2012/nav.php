<?php
$TRACE_ENABLED = is_user_logged_in();
$TRACE_PREFIX = 'nav.php -- ';
global $current_post_id;
$current_post_id = $post->ID;
$ancestors = get_post_ancestors($current_post_id);
global $pods_toplevel_ancestor;

if($TRACE_ENABLED) { error_log($TRACE_PREFIX . 'ancestors: ' . var_export($ancestors, true)); }

global $parent_post_id;
$parent_post_id = count($ancestors) > 1 ? array_shift($ancestors) : $current_post_id;

if($TRACE_ENABLED) { error_log($TRACE_PREFIX . 'post ID: ' . $current_post_id); }
if($TRACE_ENABLED) { error_log($TRACE_PREFIX . 'post ID: ' . $parent_post_id); }
if($TRACE_ENABLED) { error_log($TRACE_PREFIX . 'ancestors: ' . var_export($ancestors, true)); }
if($TRACE_ENABLED) { error_log($TRACE_PREFIX . 'pods_toplevel_ancestor: ' . var_export($pods_toplevel_ancestor, true)); }

if($TRACE_ENABLED) : ?>
<!--
pod:
<?php var_export($Pod); ?>
-->
<?php endif; ?>

<div class="wireframe threecol last" id="navigationarea">

<?php
if($current_post_id == 393) : // / (main frontpage)
  get_template_part('snippet-lsecities-frontpage');
elseif($current_post_id == 94) : // /ua/ (Urban Age frontpage)
  get_template_part('snippet-organizers');
elseif($current_post_id == 309 or in_array(309, get_post_ancestors($current_post_id)) or ($pods_toplevel_ancestor == 309)) : // /publications (the whole Publications section) or individual Article pod items
  get_template_part('nav', 'publications');
elseif($current_post_id == 489 or in_array(1890, get_post_ancestors($current_post_id))): // /ua/award/ or /about/collaboration-opportunities/
  get_template_part('nav', 'empty');
elseif(check_parent_conference(191) or check_parent_conference(229) or check_parent_conference(250) or check_parent_conference(268) or check_parent_conference(211) or check_parent_conference(284) or check_parent_conference(286) or check_parent_conference(106) or check_parent_conference(381) or check_parent_conference(391) or check_parent_conference(577) or check_parent_conference(1388)):
  get_template_part('nav', 'conferences');
elseif($current_post_id = 421 or in_array(421, get_post_ancestors($current_post_id))): // /about/whos-who/
  get_template_part('nav', 'generic');
  get_template_part('nav', 'whoswho');
else :
  get_template_part('nav', 'generic');
endif;
?>

  <div id="mailing-list-subscription">
    <h1>Subscribe to LSE Cities updates</h1>
    <form method="post" action="http://urban-age.us4.list-manage1.com/subscribe/post" id="mailchimp-form">
      <input type="hidden" value="6a19b1b794ce991fff919b68d" name="u" />
      <input type="hidden" value="1f3b65491d" name="id" />
      <label for="MERGE0">email address <em>*</em></label>
      <input type="email" value="" name="MERGE0" id="MERGE0" />
      <label for="MERGE1">first name <em>*</em></label>
      <input type="text" value="" name="MERGE1" id="MERGE1" />
      <label for="MERGE2">last name <em>*</em></label>
      <input type="text" value="" name="MERGE2" id="MERGE2" />
      <input type="submit" />
    </form>
  </div>
  <script>
    //<![CDATA[
    jQuery(document).ready(function($) {
      $('#mailing-list-subscription > h1').click(function() {$('#mailchimp-form').toggle('fast')});
    });
    //]]>
  </script>
</div>
