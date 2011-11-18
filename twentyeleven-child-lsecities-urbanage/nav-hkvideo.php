<?php
// ad-hoc template for the Hong Kong conference live streaming page
?>

<h3>Day two | 17 November 2011</h3>
<p>
<ul class="choosesession" data-title="Day one | 16 November 2011">
<li><a data-session="1116001" data-title="Welcome">Welcome</a></li>
<li><a data-session="1116002" data-title="The politics of urban health">The politics of urban health
</a></li>
<li><a data-session="1116003" data-title="Understanding health in cities">Understanding health in cities</a></li>
<li><a data-session="1116004" data-title="Measuring quality of life">Measuring quality of life</a></li>
<li><a data-session="1116005" data-title="Space and design">Space and design</a></li>
<li><a data-session="1116006" data-title="Designing for density
">Designing for density
</a></li>
<li>Evening keynote: <a data-session="1116007" data-title="Beyond inequality: emerging logics of expulsion">Beyond inequality: emerging logics of expulsion</a></li>
</ul>
</p>

<h3>Day two | 17 November 2011</h3>
<p>
<ul class="choosesession" data-title="Day two | 17 November 2011">
<li><a data-session="1117001" data-title="Planning for city change">Planning for city change</a></li>
<li><a data-session="1117002" data-title="Mobility and urban well-being">Mobility and urban well-being</a></li>
<li><a data-session="1117003" data-title="Urban density and health">Urban density and health</a></li>
<li><a data-session="1117004" data-title="Urban density and health (continued)">Urban density and health (continued)
</a></li>
<li><a data-session="1117005" data-title="Mapping inequalities">Mapping inequalities</a></li>
<li>Evening keynote: <a data-session="1117006" data-title="Evening keynote: Governing the healthy city">Governing the healthy city
</a></li>
</ul>
</p>

<p><em>Webcast partner: <a href="http://smart-streaming.com/">Smart Streaming Limited</a></em></p>

<script type='text/javascript' src='http://demo.smart-streaming.com/fms/jwplayer.js'></script>
	<script type='text/javascript'>
jQuery(document).ready(function(){
  jwplayer('videosession').setup({
    'flashplayer': 'http://demo.smart-streaming.com/fms/player.swf',
    'file': '/urbanage/1116001.mp4',
    'provider': 'rtmp',
    'streamer': 'rtmp://media.smart-streaming.com/client/_definst_/',
		'rtmp.subscribe': 'true',
    'autostart': '0',
    'controlbar': 'bottom',
    'width': '480',
    'height': '390'
  });
  jQuery(".choosesession > li > a").click(function() {
    session = $(this).data('session');
    title = $(this).data('title');
    conferencedate = $(this).parent().parent().data('title');
    // alert(session);
    jwplayer('videosession').setup({
      'flashplayer': 'http://demo.smart-streaming.com/fms/player.swf',
      'file': '/urbanage/' + session + '.mp4',
      'provider': 'rtmp',
      'streamer': 'rtmp://media.smart-streaming.com/client/_definst_/',
			'rtmp.subscribe': 'true',
			'autostart': '1',
      'controlbar': 'bottom',
      'width': '480',
      'height': '390'
    });
    jQuery('#videotitle').text(title);
    jQuery('#conferencedate').text(conferencedate);
  });
});
</script>
