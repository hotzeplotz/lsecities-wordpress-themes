<?php
/**
 * Template Name: Pods - Conference homepage
 * Description: The template used for Conferences Pods
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<?php get_header(); ?>

<div class="ninecol">
<div role="main">

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
<div class='row' id='core'>
          <article class='tencol'>
            <div class='row'>
              <div class='slider spaceAfter eightcol' id='slider'>
                <a href='http://urban-age.net/events/publicLectures/2011/09/01/the-tale-of-two-regions/' title='item'>
                  <img alt='The tale of two regions report - launch event' src='http://urban-age.net/media/homepage/sliders/201109_randstad-report.jpg' title='1 September 2011: The tale of two regions - launch event'>
                </a>
                <a href='http://urban-age.net/events/publicLectures/2011/06/06/living-in-the-endless-city/' title='item'>
                  <img alt='Living in the Endless City book launch' src='http://urban-age.net/media/homepage/sliders/201106_litec-launch-event.jpg' title='Living in the Endless City book launch: audio and video'>
                </a>
                <a href='http://urban-age.net/publications/living-in-the-endless-city/' title='item'>
                  <img alt='Living in the endless city - book cover' src='http://urban-age.net/media/homepage/sliders/201106_living-in-the-endless-city-book.jpg' title='New Publication: Living in the Endless City'>
                </a>
              </div>
              <aside class='extras fourcol last'>
                <dl>
                  <dt>Conference dates</dt>
                  <dd>Hong Kong, 16 and 17 November 2011</dd>
                  <dt>Venue</dt>
                  <dd>The Venue, Hong Kong</dd>
                  <dt>Press information</dt>
                  <dd>
                    <a href='#'>Download press pack</a>
                  </dd>
                </dl>
              </aside>
            </div>
            <div class='introblurb'>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus malesuada congue purus, sit amet porta augue tincidunt at.</p>
            </div>
            <div class='featureboxes clearfix row'>
              <div class='featurebox fourcol'>
                <h2>Programme</h2>
              </div>
              <div class='featurebox fourcol'>
                <h2>Publications</h2>
              </div>
              <div class='featurebox fourcol last'>
                <h2>Live streaming</h2>
              </div>
              <div class='featurebox fourcol'>
                <h2>Photo galleries</h2>
              </div>
              <div class='featurebox fourcol'>
                <h2>Press pack</h2>
              </div>
              <div class='featurebox fourcol last'>
                <h2>Deutsche Bank Urban Age Award</h2>
              </div>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus malesuada congue purus, sit amet porta augue tincidunt at. Aliquam vitae tellus sapien. Sed ullamcorper tortor lacus, ut pellentesque lorem. Donec lorem purus, feugiat lacinia tempor eu, convallis vitae nunc. Aliquam vulputate tristique quam, in iaculis erat blandit id. Cras mollis vestibulum odio quis adipiscing. Donec in mauris nec mauris aliquam suscipit sed a risus. Praesent non nisl mi. Suspendisse non elit metus. Pellentesque egestas pulvinar ipsum non suscipit. Sed quam turpis, commodo vitae aliquet id, consectetur ut urna. Sed turpis elit, mattis eget semper eget, iaculis eget mauris. Etiam dictum placerat est quis pretium. Aenean vel gravida lectus.</p>
          </article>
          <aside class='twocol last'>
            <nav id='conferencesmenu'>
              <h2>Urban Age conferences</h2>
              <ul>
                <li class='cityName conferencesAsia'>
                  <a href='#'>Hong Kong</a>
                </li>
                <li class='cityName conferencesNorthAmerica'>
                  <a href='#'>Chicago</a>
                </li>
                <li class='cityName conferencesEurope'>
                  <a href='#'>Istanbul</a>
                </li>
                <li class='cityName conferencesSouthAmerica'>
                  <a href='#'>São Paulo</a>
                </li>
                <li class='cityName conferencesAsia'>
                  <a href='#'>Mumbai</a>
                </li>
                <li class='cityName conferencesEurope'>
                  <a href='#'>Berlin</a>
                </li>
                <li class='cityName conferencesAfrica'>
                  <a href='#'>Johannesburg</a>
                </li>
                <li class='cityName conferencesSouthAmerica'>
                  <a href='#'>Mexico City</a>
                </li>
                <li class='cityName conferencesEurope'>
                  <a href='#'>London</a>
                </li>
                <li class='cityName conferencesAsia'>
                  <a href='#'>Shanghai</a>
                </li>
                <li class='cityName conferencesNorthAmerica'>
                  <a href='#'>New York</a>
                </li>
              </ul>
            </nav>
          </aside>
        </div>

        
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<div class="entry-meta">
    <div id="author-info">
      <?php if(is_array($article_authors)): ?>
        <h2>Authors</h2>
        <ul>
        <?php foreach($article_authors as $a): ?>
          <li><?php echo $a['name'] ?> <?php echo $a['family_name'] ?></li>
        <?php endforeach; ?>
        </ul>
      <?php endif; ?>
      <h2>Article metadata</h2>
      <dl>
        <dt>Publication date</dt>
        <dd><?php echo $article_publication_date ?></dd>
        <dt>Tags</dt>
        <dd>
          <?php if(is_array($article_tags)): ?>
          <ul>
            <?php foreach($article_tags as $t): ?>
              <li><?php echo $t['name'] ; ?></li>
            <?php endforeach; ?>
          </ul>
          <?php else: ?>
          <em>no tags defined</em>
          <?php endif; ?>
        </dd>
      </dl>
    </div>
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->

</div>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
