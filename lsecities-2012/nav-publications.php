<?php if(false): //disable menu altogether for the moment ?>
<?php $PUBLICATIONS_TOP_PAGE = 309; ?>
<h3><?php echo get_the_title($PUBLICATIONS_TOP_PAGE); ?></h3>
<ul>
  <?php echo wp_list_pages("title_li=&depth=0&child_of=$PUBLICATIONS_TOP_PAGE&echo=0&sort_column=menu_order&sort_order=DESC"); ?>
</ul>
<?php endif; ?>
