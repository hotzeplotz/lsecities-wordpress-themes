<?php
$TRACE_ENABLED = true;
$TRACE_PREFIX = 'nav-conferences';

function check_parent_conference($post_id) {
  $current_post_id = $post->ID;
  var_trace('current_post_id: ' . $current_post_id, $TRACE_PREFIX, $TRACE_ENABLED);
  ($current_post_id == $post_id or in_array($post_id, get_post_ancestors($current_post_id))) ? return true : return false;
}

if(check_parent_conference(1388)) : // /ua/conferences/2012-london
  $pod_slug = '2012-london';
elseif(check_parent_conference(577)) : // /ua/conferences/2011-hongkong
  $pod_slug = '2011-hong-kong';
elseif(check_parent_conference(391)) : // /ua/conferences/2010-chicago
  $pod_slug = '2010-chicago';
elseif(check_parent_conference(381)) : // /ua/conferences/2009-istanbul
  $pod_slug = '2009-istanbul';
elseif(check_parent_conference(106)) : // /ua/conferences/2008-sao-paulo
  $pod_slug = '2008-spaulo';
elseif(check_parent_conference(286) : // /ua/conferences/2007-mumbai
  $pod_slug = '2007-mumbai';
elseif(check_parent_conference(284)) : // /ua/conferences/2006-berlin
  $pod_slug = '2006-berlin';
elseif(check_parent_conference(211)) : // /ua/conferences/2006-johannesburg
  $pod_slug = '2006-johannesburg';
elseif(check_parent_conference(268)) : // /ua/conferences/2006-mexico-city
  $pod_slug = '2006-mexico-city';
elseif(check_parent_conference(250)) : // /ua/conferences/2005-london
  $pod_slug = '2005-london';
elseif(check_parent_conference(229)) : // /ua/conferences/2005-shanghai
  $pod_slug = '2005-shanghai';
elseif(check_parent_conference(191)) : // /ua/conferences/2005-new-york
  $pod_slug = '2005-new-york';
endif;

$pod = new Pod('conference', $pod_slug);
$button_links = $pod->get_field('links');

// sort by menu_order of linked items
foreach($button_links as $sort_key => $sort_value) {
  $menu_order[$sort_key] = $sort_value['menu_order'];
}
array_multisort($menu_order, SORT_ASC, $button_links);
?>
<nav class="conferencemenu">
  <ul>
  <?php foreach($button_links as $key => $link) : ?>
    <li>
      <a href="<?php echo $link['guid'] ; ?>" title="<?php echo $link['post_title'] ; ?>">
        <?php echo $link['post_title'] ; ?>
      </a>
    </li>
  <?php endforeach ; ?>
  </ul>
</nav>
