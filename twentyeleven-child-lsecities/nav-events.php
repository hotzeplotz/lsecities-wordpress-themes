//For the Publications Conference Newspapers Page

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
	$events = new Pod('event');
	$events->findRecords('date_start DESC');
	
	if($events->getTotalRows()> 0):
	?>
		<ul>
			<?php while($events->fetchRecord): ?>
	
      <?php
       $event_title = $events->get_field('name');
       $event_date = date('d F Y', $events->get_field('date_start'));
       $event_uri = $BASE_URI . $events->get_field('slug');
      ?>
      
      <li><a href="<?php echo $event_uri; ?>"><?php echo $event_date; ?> | <?php echo $event_title; ?></a></li>
			<?php endwhile; ?>
		</ul>
	<?php endif; ?>
</nav>
