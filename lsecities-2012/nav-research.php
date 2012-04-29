<?php
$TRACE_ENABLED = is_user_logged_in();
$TRACE_PREFIX = 'nav-research';
$current_post_id = $post->ID;

global $IN_CONTENT_AREA;
global $HIDE_CURRENT_PROJECTS, $HIDE_PAST_PROJECTS;
echo var_trace('HIDE_CURRENT_PROJECTS: '. $HIDE_CURRENT_PROJECTS, $TRACE_PREFIX, $TRACE_ENABLED);
echo var_trace('HIDE_PAST_PROJECTS: '. $HIDE_PAST_PROJECTS, $TRACE_PREFIX, $TRACE_ENABLED);

echo var_trace('post ID: ' . $current_post_id, $TRACE_PREFIX, $TRACE_ENABLED);
echo var_trace(var_export($pod, true), $TRACE_PREFIX, $TRACE_ENABLED);

$projects_pod = new Pod('research_project');

$current_projects = array();
$projects_pod->findRecords(array(
  'where' => 'status.name = "active"'
));
$projects = array();
while($projects_pod->fetchRecord()) {
  array_push($current_projects, array(
    'slug' => $projects_pod->get_field('slug'),
    'name' => $projects_pod->get_field('name'),
    'stream' => $projects_pod->get_field('research_stream.name')
  ));
  $projects[$projects_pod->get_field('research_stream.name')] = array();
}

echo var_trace('projects: ' . var_export($current_projects, true), $TRACE_PREFIX, $TRACE_ENABLED);

$projects = array();
foreach($current_projects as $project) {
  $key = $project['stream'];
  array_push($projects[$key], $project);
}

echo var_trace('projects (by stream): ' . var_export($projects, true), $TRACE_PREFIX, $TRACE_ENABLED);

?>

<nav id="projectsmenu">
  <dl>
    <?php foreach($projects['stream'] as $stream_name => $stream_projects): ?>
    <dt><?php echo $stream_name; ?></dt>
    <?php foreach($stream_projects as $stream_project): ?>
    <dd><a href="<?php echo $stream_project['slug']; ?>"><?php echo $stream_project['name']; ?></a></dd>
    <?php endforeach; ?>
    <?php endforeach; ?>
  </dl>
</nav>
