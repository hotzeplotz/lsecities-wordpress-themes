<?php
$TRACE_TEMPLATE_NAV = true;
$TRACE_PREFIX = 'nav.php -- ';
$current_post_id = $post->ID;
$ancestors = get_post_ancestors($current_post_id);

if($TRACE_TEMPLATE_NAV) { error_log($TRACE_PREFIX . 'ancestors: ' . var_export($ancestors, true)); }

$parent_post_id = count($ancestors) > 1 ? array_shift($ancestors) : $current_post_id;

if($TRACE_TEMPLATE_NAV) { error_log($TRACE_PREFIX . 'post ID: ' . $current_post_id); }
if($TRACE_TEMPLATE_NAV) { error_log($TRACE_PREFIX . 'post ID: ' . $parent_post_id); }
if($TRACE_TEMPLATE_NAV) { error_log($TRACE_PREFIX . 'ancestors: ' . var_export($ancestors, true)); }

if($TRACE_TEMPLATE_NAV) : ?>
<!--
pod:
<?php var_export($Pod); ?>
-->
<?php endif; ?>

<div class="threecol last" id="level3nav">
<?php
if($current_post_id) {
  $children = wp_list_pages('title_li=&depth=1&child_of='.$parent_post_id.'&echo=0');
}
if ($children) : ?>
  <ul>
  <?php echo $children; ?>
  </ul>
<?php else : ?>
  &#160;
<?php endif; ?>
</div>
