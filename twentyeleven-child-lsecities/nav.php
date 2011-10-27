<?php $children = wp_list_pages('title_li=&child_of='.$post->ID.'&echo=0');
  if ($children) : ?>
  <ul>
  <?php echo $children; ?>
  </ul>
  <?php endif; ?>