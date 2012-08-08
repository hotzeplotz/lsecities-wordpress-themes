<?php if(is_user_logged_in()):
  global $META_media_attr; ?>
<div id="hiddenmeta" style="display: none;">
  <?php if($META_last_modified): ?>
  <span class="updated" title="<?php echo $META_last_modified; ?>">Last modified: <?php echo $META_last_modified; ?></span>
  <?php endif; ?>
  <?php
  // if(count($GLOBALS['META_media_attributions'])): 
    if(count($META_media_attr)): ?>
    <h4>Media sources</h4>
    <ul>
  <?php
    // foreach($GLOBALS['META_media_attributions'] as $key => $item): 
    foreach($META_media_attr as $key => $item):
      if($item['attribution_uri'] and $item['author']): ?>
    <li><a href="<?php echo $item['attribution_uri']; ?>"><?php echo $item['title']; ?></a> by <?php echo $item['author']; ?></li>
  <?php
      endif;
    endforeach; ?>
    </ul>
  <?php
  endif;
  ?>
</div>
<?php endif; ?>
