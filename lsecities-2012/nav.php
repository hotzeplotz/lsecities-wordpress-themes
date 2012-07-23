<?php
$TRACE_ENABLED = is_user_logged_in();
$TRACE_PREFIX = 'nav.php -- ';
global $current_post_id;
global $BASE_URI;
global $IN_CONTENT_AREA;
$current_post_id = $post->ID;
$IN_CONTENT_AREA = false;
$ancestors = get_post_ancestors($current_post_id);
global $pods_toplevel_ancestor;

if($TRACE_ENABLED) { error_log($TRACE_PREFIX . 'ancestors: ' . var_export($ancestors, true)); }

global $parent_post_id;
$parent_post_id = count($ancestors) > 1 ? array_shift($ancestors) : $current_post_id;

if($TRACE_ENABLED) { error_log($TRACE_PREFIX . 'post ID: ' . $current_post_id); }
if($TRACE_ENABLED) { error_log($TRACE_PREFIX . 'post ID: ' . $parent_post_id); }
if($TRACE_ENABLED) { error_log($TRACE_PREFIX . 'ancestors: ' . var_export($ancestors, true)); }
if($TRACE_ENABLED) { error_log($TRACE_PREFIX . 'pods_toplevel_ancestor: ' . var_export($pods_toplevel_ancestor, true)); }
// var_trace('pod: ' . var_export($Pod), $TRACE_PREFIX, $TRACE_ENABLED);
?>

<div class="wireframe threecol last" id="navigationarea">

<?php
$nav_generated = false;

// / (main frontpage)
if($current_post_id == 393) {
  get_template_part('snippet-lsecities-frontpage');
  $nav_generated = true;
}

// /ua/ (Urban Age frontpage)
if($current_post_id == 94) {
  get_template_part('snippet-organizers');
  $nav_generated = true;
}

// /research (the whole Research section) or individual Research project pod items
if($current_post_id == 306 or in_array(306, get_post_ancestors($current_post_id)) or ($pods_toplevel_ancestor == 306)) {
  get_template_part('nav', 'research');
  $nav_generated = true;
}

// /publications (the whole Publications section) or individual Article pod items
if($current_post_id == 309 or in_array(309, get_post_ancestors($current_post_id)) or ($pods_toplevel_ancestor == 309)) {
  get_template_part('nav', 'publications');
  $nav_generated = true;
}

// /events (the whole Events section) or individual Event pod items
if($current_post_id == 311 or in_array(311, get_post_ancestors($current_post_id)) or ($pods_toplevel_ancestor == 311)) {
  get_template_part('nav', 'events');
  $nav_generated = true;
}

// /ua/award/ or /about/collaboration-opportunities/
if($current_post_id == 489 or in_array(1890, get_post_ancestors($current_post_id))) {
  get_template_part('nav', 'empty');
  $nav_generated = true;
}

// /ua/conferences/
if($nav_show_conferences or check_parent_conference(191) or check_parent_conference(229) or check_parent_conference(250) or check_parent_conference(268) or check_parent_conference(211) or check_parent_conference(284) or check_parent_conference(286) or check_parent_conference(106) or check_parent_conference(381) or check_parent_conference(391) or check_parent_conference(577) or check_parent_conference(1388)) {
  get_template_part('nav', 'conferences');
  $nav_generated = true;
}

// /about/whos-who/
if($current_post_id = 421 or in_array(421, get_post_ancestors($current_post_id))) {
  get_template_part('nav', 'generic');
  get_template_part('nav', 'whoswho');
  $nav_generated = true;
}

if($nav_generated == false) {
  get_template_part('nav', 'generic');
}
?>
            
  <div id="mailing-list-subscription">
    <h1>Click here to subscribe to LSE Cities updates</h1>
    <form method="post" action="http://urban-age.us4.list-manage1.com/subscribe/post" id="mailchimp-form">
      <input type="hidden" value="6a19b1b794ce991fff919b68d" name="u" />
      <input type="hidden" value="1f3b65491d" name="id" />
      <label for="MERGE0">email address <em>*</em></label>
      <input type="email" value="" name="MERGE0" id="MERGE0" />
      <label for="MERGE1">first name <em>*</em></label>
      <input type="text" value="" name="MERGE1" id="MERGE1" />
      <label for="MERGE2">last name <em>*</em></label>
      <input type="text" value="" name="MERGE2" id="MERGE2" />
      <p><input type="submit" /></p>
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
