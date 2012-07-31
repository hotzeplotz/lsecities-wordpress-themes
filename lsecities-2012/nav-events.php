<?php
$TRACE_ENABLED = is_user_logged_in();
$TRACE_PREFIX = 'nav-events';
$current_post_id = $post->ID;

global $IN_CONTENT_AREA;
global $HIDE_UPCOMING_EVENTS, $HIDE_PAST_EVENTS;
global $pod_slug;
$BASE_URI = PODS_BASEURI_EVENTS;

echo var_trace('HIDE_UPCOMING_EVENTS: '. $HIDE_UPCOMING_EVENTS, $TRACE_PREFIX, $TRACE_ENABLED);
echo var_trace('HIDE_PAST_EVENTS: '. $HIDE_PAST_EVENTS, $TRACE_PREFIX, $TRACE_ENABLED);

echo var_trace('post ID: ' . $current_post_id, $TRACE_PREFIX, $TRACE_ENABLED);
echo var_trace(var_export($pod, true), $TRACE_PREFIX, $TRACE_ENABLED);

$events_pod = new Pod('event');
$datetime_now = new DateTime('now');
echo var_trace('datetime_now: ' . $datetime_now->format(DATE_ATOM), $TRACE_PREFIX, $TRACE_ENABLED);

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
$active_year = $current_year; // used to set initial active section for jQuery UI accordion

for($year = 2005; $year <= $current_year; $year++) {
  $events[$year] = Array();
  $events_pod->findRecords(array(
    'where' => "YEAR(t.date_start) = $year AND t.date_start < NOW()",
    'orderby' => 'date_start DESC',
    'limit' => -1
  ));
  echo var_trace('events records found: ' . $events_pod->getTotalRows(), $TRACE_PREFIX, $TRACE_ENABLED);
  while($events_pod->fetchRecord()) {
    // if event is past, add it to array
    if($events_pod->get_field['date_start'] < $datetime_now) {
      if($pod_slug == $events_pod->get_field('slug')) {
	$active_year = $year;
      }
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

echo var_trace('events array: ' . var_export($events, true), $TRACE_PREFIX, $TRACE_ENABLED);

// sort by year, backwards from current year
krsort($events);
?>

<nav id="eventsmenu">
  <dl>
    <?php if($HIDE_UPCOMING_EVENTS): ?>
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
    <?php endif; ?>
    <?php if($events and $HIDE_PAST_EVENTS): ?>
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
    <?php endif; ?>
  </dl>
</nav>
