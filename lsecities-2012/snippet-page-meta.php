<?php if(is_user_logged_in()): ?>
<div id="hiddenmeta" style="display: none;">
  <?php if($META_last_modified): ?>
  <span class="updated" title="<?php echo $META_last_modified; ?>">Last modified: <?php echo $META_last_modified; ?></span>
  <?php endif; ?>
  <?php
  if(count($META_media_attributions)): ?>
    <h4>Media sources</h4>
    <ul>
  <?php
    foreach($META_media_attributions as $key => $item): ?>
    <li><a href="<?php echo $item['attribution_uri']; ?>"><?php echo $item['title']; ?></a> by <?php echo $item['author']; ?></li>
  <?php
    endforeach; ?>
    </ul>
  <?php
  endif;
  ?>
</div>
<?php endif; ?>