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
if($current_post_id == 94) : // /ua/ ?>
<h3>Organisers</h3>
<span class="indent">
<a href="http://www.lse.ac.uk/collections/cities" target="_blank">
<img alt="LSE" src="http://v0.urban-age.net/0_images/organizer_lse_bigger.gif" height="49" width="128"></a>
</span>
<br>
<span class="indent">
<a href="http://www.alfred-herrhausen-gesellschaft.de" target="_blank">
<img alt="Alfred Herrhausen Gesellschaft" src="http://v0.urban-age.net/0_images/organizer_ahg_big.gif" height="30" align="top" width="153"></a>
</span>
<?
else :
  if($current_post_id) {
    $children = wp_list_pages('title_li=&depth=1&child_of='.$parent_post_id.'&echo=0');
  }
  if ($children) : ?>
  <ul>
    <?php echo $children; ?>
  </ul>
  <?php else : ?>
  &#160;
  <?php endif;
endif;
?>
</div>
