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

$events_pod = new Pod('event');
$datetime_now = new DateTime('now');
if($TRACE_TEMPLATE_NAV) { error_log($TRACE_PREFIX . 'datetime_now: ' . $datetime_now->format(DATE_ATOM)); }

// prepare array with list of upcoming events
$upcoming_events = Array();
$events_pod->findRecords(array(
  'where' => 't.date_start > NOW()',
  'orderby' => 't.date_start ASC',
  'limit' => 5
));
while($events_pod->fetchRecord()) {
  array_push($upcoming_events, array(
    'slug' => $events_pod->get_field('slug'),
    'name' => $events_pod->get_field('name'),
    'date' => date('d F', strtotime($events_pod->get_field('date_start')))
  ));
}

// prepare array with list of past events, split by year
$events = Array();
$current_year = date("Y");

for($year = 2005; $year <= $current_year; $year++) {
  $events[$year] = Array();
  $events_pod->findRecords(array(
    'where' => "YEAR(t.date_start) = $year AND t.date_start < NOW()",
    'orderby' => 'date_start DESC',
    'limit' => -1
  ));
  if($TRACE_TEMPLATE_NAV) { error_log($TRACE_PREFIX . 'events records found: ' . $events_pod->getTotalRows()); }
  while($events_pod->fetchRecord()) {
    // if event is past, add it to array
    if($events_pod->get_field['date_start'] < $datetime_now) {
      array_push($events[$year], Array(
	'slug' => $events_pod->get_field('slug'),
	'name' => $events_pod->get_field('name'),
	'date' => date('j F', strtotime($events_pod->get_field('date_start')))
      ));
    }
  }
  
  // if there are no events for this year, remove year's array altogether from full list
  if(!count($events[$year])) {
    $events = array_pop($events);
  }
}

if($TRACE_TEMPLATE_NAV) { echo "<!-- $TRACE_PREFIX events array: \n" . var_export($events, true) . " \n-->"; }

// sort by year, backwards from current year
krsort($events);
?>

<nav id="eventsmenu">
  <dl>
    <dt class="events upcoming">Upcoming events</dt>
    <dd>
    <?php if($upcoming_events): ?>
      <ul>
      <?php foreach($upcoming_events as $event): ?>
	<li><a href="<?php echo $BASE_URI . $event['slug']; ?>"><?php echo $event['date']; ?> | <?php echo $event['name']; ?></a></li>
      <?php endforeach; ?>
      </ul>
    <?php else: ?>
      Please check back for more information on our upcoming events.
    <?php endif; ?>
    </dd>
    <?php if($events): ?>
    <dt class="events past">Past events</dt>
    <dd>
      <dl class="accordion">
      <?php foreach($events as $year => $year_events): ?>
	<dt><?php echo $year; ?></dt>
	<dd>
	  <ul>
	  <?php foreach($year_events as $event): ?>
	    <li><a href="<?php echo $BASE_URI . $event['slug']; ?>"><?php echo $event['date']; ?> | <?php echo $event['name']; ?></a></li>
	  <?php endforeach; ?>
	  </ul>
	</dd>
      <?php endforeach; ?>
      </dl>
    </dd>
    <?php endif; ?>
  </dl>
</nav>
