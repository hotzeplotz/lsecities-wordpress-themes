    <?php if(!$IN_CONTENT_AREA): ?><dt class="events upcoming">Upcoming events</dt><?php endif; ?>
    <dd>
    <?php if($upcoming_events): ?>
      <ul>
      <?php foreach($upcoming_events as $event): ?>
        <li><a href="<?php echo $BASE_URI . '/' . $event['slug']; ?>"><?php echo $event['date']; ?> | <?php echo $event['name']; ?></a></li>
      <?php endforeach; ?>
      </ul>
    <?php else: ?>
      Please check back for more information on our upcoming events.
    <?php endif; ?>
    </dd>
