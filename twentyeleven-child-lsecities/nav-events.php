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
<?php endif; 

// prepare array with list of events, split by year
$events = Array();
$current_year = date("Y");
$events_pod = new Pod('event');

for($year = 2005; $year <= $current_year; $year++) {
  $events_pod->findRecords(array(
    'where' => "YEAR(t.date_start) = $year",
    'orderby' => 'date_start DESC',
    'limit' => -1
  ));
  if($TRACE_TEMPLATE_NAV) { error_log($TRACE_PREFIX . 'events records found: ' . $events_pod->getTotalRows()); }
  while($events_pod->fetchRecord()) {
    array_push($events[$year], Array(
      'slug' => $events_pod->get_field('slug'),
      'name' => $events_pod->get_field('name'),
      'date' => date('d F', strtotime($events_pod->get_field('date_start')))
    ));
  }
  if($TRACE_TEMPLATE_NAV) { error_log($TRACE_PREFIX . 'events array: ' . $events); }
}

?>

<nav id="eventsmenu">
  <?php
    if($events_list->getTotalRows()> 0):
  ?>
		<ul>
			<?php while($events_list->fetchRecord()): ?>
	
      <?php
       $event_title = $events_list->get_field('name');
       $event_date = date('d F Y', strtotime($events_list->get_field('date_start')));
       $event_uri = $BASE_URI . $events_list->get_field('slug');
      ?>
      
      <li><a href="<?php echo $event_uri; ?>"><?php echo $event_date; ?> | <?php echo $event_title; ?></a></li>
			<?php endwhile; ?>
		</ul>
	<?php endif; ?>
</nav>
