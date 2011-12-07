<?php
$current_post_id = $post->ID;
if($current_post_id == 577 or in_array(577, get_post_ancestors($current_post_id))) : // /ua/conferences/2011-hongkong
  get_template_part('nav', 'hk2011');
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
              <h2>Urban Age conferences</h2>
              <p>The Urban Age Programme is an international investigation of the spatial and social dynamics of cities centred on an annual conference, research initiative and publication.</p>

              <ul>
                <?php wp_list_pages('title_li=&depth=1&child_of=96&sort_column=menu_order&sort_order=DESC&echo=1'); ?>
              </ul>
              <!--
              <ul>
                <li class='cityName conferencesAsia'>
                  <a href='/ua/conferences/2011-hongkong/'>2011 | Hong Kong</a>
                </li>
                <li class='cityName conferencesNorthAmerica'>
                  <a href='/ua/conferences/2010-chicago/'>2010 | Chicago</a>
                </li>
                <li class='cityName conferencesEurope'>
                  <a href='/ua/conferences/2009-istanbul/'>2009 | Istanbul</a>
                </li>
                <li class='cityName conferencesSouthAmerica'>
                  <a href='/ua/conferences/2008-sao-paulo/'>2008 | São Paulo</a>
                </li>
                <li class='cityName conferencesAsia'>
                  <a href='/ua/conferences/2007-mumbai/'>2007 | Mumbai</a>
                </li>
                <li class='cityName conferencesEurope'>
                  <a href='/ua/conferences/2006-berlin/'>2006 | Berlin</a>
                </li>
                <li class='cityName conferencesAfrica'>
                  <a href='/ua/conferences/2006-johannesburg/'>2006 | Johannesburg</a>
                </li>
                <li class='cityName conferencesSouthAmerica'>
                  <a href='/ua/conferences/2006-mexico-city/'>2006 | Mexico City</a>
                </li>
                <li class='cityName conferencesEurope'>
                  <a href='/ua/conferences/2005-london/'>2005 | London</a>
                </li>
                <li class='cityName conferencesAsia'>
                  <a href='/ua/conferences/2005-shanghai/'>2005 | Shanghai</a>
                </li>
                <li class='cityName conferencesNorthAmerica'>
                  <a href='/ua/conferences/2005-new-york/'>2005 | New York</a>
                </li>
              </ul>
-->
            </nav>
<?php endif; ?>
