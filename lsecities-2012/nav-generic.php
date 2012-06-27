<?php
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
<?php endif; ?>
