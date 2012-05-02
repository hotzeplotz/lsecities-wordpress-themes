<?php 
$ancestors = get_ancestors($post->ID, 'page');
array_unshift($ancestors, $post->ID);
$toplevel_ancestor = array_pop($ancestors);
$urban_age_section = ($toplevel_ancestor) == 94) ?  true : false;;
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
