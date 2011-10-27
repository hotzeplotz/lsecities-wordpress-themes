<?php
$TRACE_TEMPLATE_NAV = true;
$TRACE_PREFIX = 'nav.php -- ';
$current_post_id = $post->ID;
if($TRACE_TEMPLATE_NAV) { error_log($TRACE_PREFIX . 'post ID: ' . $current_post_id); }
if($TRACE_TEMPLATE_NAV) : ?>
<!--
pod:
<?php var_export($pod); ?>
-->
<?php endif; ?>

<nav class="threecol last" id="level3nav>
<?php
if($current_post_id) {
  $children = wp_list_pages('title_li=&child_of='.$current_post_id.'&echo=0');
}
if ($children) : ?>
<ul>
<?php echo $children; ?>
</ul>
<?php else : ?>
&#160;
<?php endif; ?>
</nav>