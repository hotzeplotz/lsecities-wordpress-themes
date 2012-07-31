    <?php if(!$IN_CONTENT_AREA): ?><dt class="events past">Past events</dt><?php endif; ?>
    <dd>
      <dl<?php if(!$IN_CONTENT_AREA): ?> class="accordion"<?php endif; ?>>
      <?php foreach($events as $year => $year_events): ?>
        <dt<?php if($year == $active_year): ?> class="active"<?php endif; ?>><?php echo $year; ?></dt>
        <dd>
          <ul>
          <?php foreach($year_events as $event): ?>
            <li><a href="<?php echo $BASE_URI . '/' . $event['slug']; ?>"><?php echo $event['date']; ?> | <?php echo $event['name']; ?></a></li>
          <?php endforeach; ?>
          </ul>
        </dd>
      <?php endforeach; ?>
      </dl>
    </dd>
