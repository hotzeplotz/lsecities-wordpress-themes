<?php
$TRACE_ENABLED = is_user_logged_in();
$TRACE_PREFIX = 'nav.php -- ';
$current_post_id = $post->ID;
$publication_pod = $GLOBALS['publication_pod'];
?>

<nav id="publication-side-toc">
<?php if(count($publication_pod->get_field('articles'))) : ?>
  <div>
    <h1><?php echo $publication_pod->get_field('name'); ?></h1>
    <ul>
    <?php
    $sections = array();
    foreach(preg_split("/\n/", $publication_pod->get_field('sections')) as $section_line) {
      preg_match("/^(\d+)?\s?(.*)$/", $section_line, $matches);
      array_push($sections, array( 'id' => $matches[1], 'title' => $matches[2]));
    }
    var_trace(var_export($sections, true), 'sections', $TRACE_ENABLED);
    
    if(!count($sections)) {
      $sections = array("010" => "");
    }
    foreach($sections as $section) : ?>
      <?php if($section['title']) { ?><h2><?php echo $section['title']; ?></h2><?php }
      foreach($publication_pod->get_field('articles') as $article) :
        if(preg_match("/^" . $section['id'] . "/", $article['sequence'])) : ?>
          <?php var_trace(var_export($article, true), 'article-pod-object', $TRACE_ENABLED); ?>
          <li>
            <a href="<?php echo PODS_BASEURI_ARTICLES . '/' . $article['slug']; ?>"><?php echo $article['name']; ?></a>
            <?php if(!empty($article['language']['name'])) : ?>
              (English) - <a href="<?php echo PODS_BASEURI_ARTICLES . '/' . $article['slug'] . '/?lang=' . $article['language']['language_code']; ?>">(<?php echo $article['language']['name']; ?>)</a>
            <?php endif; ?>
          </li>
      <?php
        endif;
      endforeach; 
    endforeach; ?>
    </ul>
  </div>
<?php endif; ?></nav>
