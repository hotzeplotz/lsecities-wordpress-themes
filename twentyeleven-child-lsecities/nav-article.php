<?php
$TRACE_TEMPLATE_NAV = true;
$TRACE_PREFIX = 'nav.php -- ';
$current_post_id = $post->ID;
global $publication_pod;
?>

<nav>
<?php if(count($publication_pod->get_field('articles'))) : ?>
  <div>
    <h3><?php echo $publication_pod->get_field('name'); ?></h3>
    <ul class="publication-side-toc">
    <?php
    $sections = array();
    foreach(preg_split("/\n/", $publication_pod->get_field('sections')) as $section_line) {
      preg_match("/^(\d+)?\s?(.*)$/", $section_line, $matches);
      array_push($sections, array( 'id' => $matches[1], 'title' => $matches[2]));
    }
    if($TRACE_PODS_ARTICLES) { error_log('sections: ' . var_export($sections, true)); }
    
    if(!count($sections)) {
      $sections = array("010" => "");
    }
    foreach($sections as $section) : ?>
      <?php if($section['title']) { ?><h4><?php echo $section['title']; ?></h4><?php }
      foreach($publication_pod->get_field('articles') as $article) :
        if(preg_match("/^" . $section['id'] . "/", $article['sequence'])) : ?>
          <?php if($TRACE_PODS_ARTICLES) : ?>
          <!-- <?php echo 'article Pod object: ' . var_export($article, true); ?> -->
          <?php endif; ?>
          <li>
            <a href="<?php echo $PODS_BASEURI_ARTICLES . '/' . $article['slug']; ?>"><?php echo $article['name']; ?></a>
            <?php if(!empty($article['language']['name'])) : ?>
              (English) - <a href="<?php echo $PODS_BASEURI_ARTICLES . '/' . $article['slug'] . '/?lang=' . $article['language']['language_code']; ?>">(<?php echo $article['language']['name']; ?>)</a>
            <?php endif; ?>
          </li>
      <?php
        endif;
      endforeach; 
    endforeach; ?>
    </ul>
  </div>
<?php endif; ?></nav>
