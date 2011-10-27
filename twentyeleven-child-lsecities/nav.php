<?php
$TRACE_TEMPLATE_NAV = true;
$TRACE_PREFIX = 'nav.php';
if($TRACE_TEMPLATE_NAV) { error_log($TRACE_PREFIX . 'post ID: ' . $post->ID); }
$children = wp_list_pages('title_li=&child_of='.$post->ID.'&echo=0');
if ($children) : ?>
<ul>
<?php echo $children; ?>
</ul>
<?php endif; ?>