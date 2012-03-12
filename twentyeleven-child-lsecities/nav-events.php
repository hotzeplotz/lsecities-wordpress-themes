<?php
$TRACE_TEMPLATE_NAV = true;
$TRACE_PREFIX = 'nav.php -- ';
$current_post_id = $post->ID;
if($TRACE_TEMPLATE_NAV) { error_log($TRACE_PREFIX . 'post ID: ' . $current_post_id); }
if($TRACE_TEMPLATE_NAV) : ?>
<!--
pod:
<?php var_export($pod); ?>
-->
<?php endif; ?>

<nav id="eventsmenu">
	<?php
	$events_list = new Pod('event');
	$events_list->findRecords('date_start DESC');
	
	if($events->getTotalRows()> 0):
	?>
		<ul>
			<?php while($events_list->fetchRecord): ?>
	
      <?php
       $event_title = $events_list->get_field('name');
       $event_date = date('d F Y', $events_list->get_field('date_start'));
       $event_uri = $BASE_URI . $events_list->get_field('slug');
      ?>
      
      <li><a href="<?php echo $event_uri; ?>"><?php echo $event_date; ?> | <?php echo $event_title; ?></a></li>
			<?php endwhile; ?>
		</ul>
	<?php endif; ?>
</nav>
