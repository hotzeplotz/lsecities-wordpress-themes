<?php
$TRACE_ENABLED = is_user_logged_in();
$TRACE_PREFIX = 'nav.php -- ';
$current_post_id = $post->ID;
$ancestors = get_post_ancestors($current_post_id);
global $pods_toplevel_ancestor;

if($TRACE_ENABLED) { error_log($TRACE_PREFIX . 'ancestors: ' . var_export($ancestors, true)); }

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
elseif($current_post_id == 489): // /ua/award/
  get_template_part('nav', 'empty');
elseif(check_parent_conference(191) or check_parent_conference(229) or check_parent_conference(250) or check_parent_conference(268) or check_parent_conference(211) or check_parent_conference(284) or check_parent_conference(286) or check_parent_conference(106) or check_parent_conference(381) or check_parent_conference(391) or check_parent_conference(577) or check_parent_conference(1388)):
  get_template_part('nav', 'conferences');
else :
  if($current_post_id) {
    $children = wp_list_pages('title_li=&depth=1&child_of='.$parent_post_id.'&echo=0');
  }
  if ($children) : ?>
  <nav>
    <dl>
      <dt><?php echo get_the_title($parent_post_id); ?></dt>
      <dd>
        <ul>
        <?php echo $children; ?>
        </ul>
      </dd>
    </dl>
  </nav>
  <?php else : ?>
  &#160;
  <?php endif;
endif;
?>
</div>
