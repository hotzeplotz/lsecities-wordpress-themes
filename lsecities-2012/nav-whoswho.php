<?php
$TRACE_ENABLED = is_user_logged_in();
$TRACE_PREFIX = 'nav.php -- ';
$current_post_id = $post->ID;
?>

<nav id="whoswho-side-toc">
<?php echo generate_list('lsecities-staff', 'summary'); ?>
</nav>
