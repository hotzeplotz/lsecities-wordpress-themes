<?php
$TRACE_TEMPLATE_NAV = true;
$TRACE_PREFIX = 'nav.php -- ';
$current_post_id = $post->ID;
$ancestors = get_post_ancestors($current_post_id);
global $pods_toplevel_ancestor;
global $no_navbar;

if($TRACE_TEMPLATE_NAV) { error_log($TRACE_PREFIX . 'ancestors: ' . var_export($ancestors, true)); }

$parent_post_id = count($ancestors) > 1 ? array_shift($ancestors) : $current_post_id;

if($TRACE_TEMPLATE_NAV) { error_log($TRACE_PREFIX . 'post ID: ' . $current_post_id); }
if($TRACE_TEMPLATE_NAV) { error_log($TRACE_PREFIX . 'post ID: ' . $parent_post_id); }
if($TRACE_TEMPLATE_NAV) { error_log($TRACE_PREFIX . 'ancestors: ' . var_export($ancestors, true)); }
if($TRACE_TEMPLATE_NAV) { error_log($TRACE_PREFIX . 'pods_toplevel_ancestor: ' . var_export($pods_toplevel_ancestor, true)); }

if($TRACE_TEMPLATE_NAV) : ?>
<!--
pod:
<?php var_export($Pod); ?>
-->
<?php endif; ?>

<div class="threecol last" id="level3nav">
<?php
if($no_navbar == true) : ?>
  &#160;
<?php
elseif($current_post_id == 94) : // /ua/ (Urban Age frontpage)
  get_template_part('snippet-organizers');
elseif($current_post_id == 393) : // / (main frontpage)
  get_template_part('snippet-lsecities-frontpage');
elseif($current_post_id == 309 or in_array(309, get_post_ancestors($current_post_id)) or ($pods_toplevel_ancestor == 309)) : // /publications (the whole Publications section) or individual Article pod items
  get_template_part('nav-publications');
else :
  if($current_post_id) {
    $children = wp_list_pages('title_li=&depth=1&child_of='.$parent_post_id.'&echo=0');
  }
  if ($children) : ?>
  <h3><?php echo get_the_title($parent_post_id); ?></h3>
  <ul>
    <?php echo $children; ?>
  </ul>
  <?php else : ?>
  &#160;
  <?php endif;
endif;
?>
</div>
