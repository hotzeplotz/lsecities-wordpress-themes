<?php
$current_post_id = $post->ID;
if($current_post_id == 577 or in_array(577, get_post_ancestors($current_post_id))) : // /ua/conferences/2011-hongkong
  get_template_part('nav', 'hk2011');
elseif($current_post_id == 1388 or in_array(1388, get_post_ancestors($current_post_id))) : // /ua/conferences/2011-london
  get_template_part('nav', 'london2012');
else :
?>
<nav id='conferencesmenu'>
<?php if($post->ID == 94) : // /ua/ ?>
  <div>
    <h1>Organisers</h1>
    <span>
      <a href="http://www.lse.ac.uk/collections/cities" target="_blank">
        <img alt="LSE" src="http://v0.urban-age.net/0_images/organizer_lse_bigger.gif" height="49" width="128">
      </a>
    </span>
    <br />
    <span class="indent">
      <a href="http://www.alfred-herrhausen-gesellschaft.de" target="_blank">
        <img alt="Alfred Herrhausen Stiftung" src="http://v0.urban-age.net/0_images/organizer_ahg_big.gif" align="top" height="30" width="153">
      </a>
    </span>
  </div>   
<?php endif; ?>
</nav>
<?php endif; ?>
