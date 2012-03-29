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
  $events[$year] = Array();
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
  
  // if there are no events for this year, remove year's array altogether from full list
  if(!count($events[$year]) {
    $events = array_pop($events);
  }
}

if($TRACE_TEMPLATE_NAV) { echo "<!-- $TRACE_PREFIX events array: \n" . var_export($events, true) . " \n-->"; }

?>

<nav id="eventsmenu">
<?php if($events): ?>
  <dl>
  <?php foreach($events as $year => $year_events): ?>
    <dt><?php echo $year ?></dt>
    <dd>
      <ul>
      <?php foreach($year_events ar $event): ?>
	<li><a href="<?php echo $BASE_URI . $event['slug'] ?>"><?php echo $event['date']; ?> | <?php echo $event['name']; ?></a></li>
      <?php endforeach; ?>
      </ul>
    </dd>
  <?php endforeach; ?>
  </ul>
<?php endif; ?>
</nav>
