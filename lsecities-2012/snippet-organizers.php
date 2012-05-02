<?php 
$TRACE_ENABLED = is_user_logged_in();
$TRACE_PREFIX = 'footer';
$ancestors = get_ancestors($post->ID, 'page');
echo var_trace(var_export($ancestors, true), $TRACE_PREFIX, $TRACE_ENABLED);
array_unshift($ancestors, $post->ID);
echo var_trace(var_export($ancestors, true), $TRACE_PREFIX, $TRACE_ENABLED);
$toplevel_ancestor = array_pop($ancestors);
echo var_trace($toplevel_ancestor, $TRACE_PREFIX, $TRACE_ENABLED);
$urban_age_section = ($toplevel_ancestor == 94 or $post->ID == 94) ?  true : false;
echo var_trace($post->ID), $TRACE_PREFIX, $TRACE_ENABLED);
?>
<ul id="organizer-logos">
  <li>
    <a href="http://www.lse.ac.uk/" target="_blank">
      <img alt="LSE" src="<?php bloginfo('stylesheet_directory'); ?>/images/lse_logo_white.gif" />
    </a>
  </li>
  <?php if($urban_age_section): ?>
  <li>
    <a href="http://www.alfred-herrhausen-gesellschaft.de/en/" target="_blank">
      <img alt="Alfred Herrhausen Gesellschaft" src="<?php bloginfo('stylesheet_directory'); ?>/images/ahs_logo_white.gif" />
    </a>
  </li>
  <?php endif; ?>
</ul>
