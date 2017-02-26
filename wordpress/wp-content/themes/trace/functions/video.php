<?php 

	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];
	require_once( $path_to_wp.'/wp-load.php' );
	require_once( $path_to_wp.'/wp-includes/functions.php');
	
	$template_uri = get_template_directory_uri();
	
	
?>
<html  style="background-color:transparent;margin:0;padding:0;overflow:hidden;">
<head>
<!-- LOAD THE MEDIAPLAYER	-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>	

	<script src="<?php echo $template_uri;?>/js/mediaelement-and-player.min.js"></script>
	<link rel="stylesheet" href="<?php echo $template_uri;?>/css/mediaelementplayer.min.css" />
	
	
<?php
	$pagecustoms = getOptions($_GET["post_id"]);
?>
        
</head>



<!--
#######################################
	- THE BODY PART -
######################################
-->
<body style="background-color:transparent;margin:0;padding:0">		
		<video width="100%" height="100%" id="player2" poster="<?php echo $template_uri."/functions/thumb.php?w=930&h=523&src=".wp_get_attachment_url( get_post_thumbnail_id($_GET["post_id"]));?>" controls="controls" preload="none">
			<!-- MP4 source -->
			<source type="video/mp4" src="<?php echo $pagecustoms["averis_mp4_link"];?>" />
			<!-- Fallback flash player for no-HTML5 browsers with JavaScript turned off -->
			<object width="100%" height="100%" type="application/x-shockwave-flash" data="<?php echo $template_uri;?>/js/flashmediaelement.swf"> 		
				<param name="movie" value="<?php echo $template_uri;?>/js/flashmediaelement.swf" /> 
				<param name="flashvars" value="controls=true&amp;file=<?php echo $pagecustoms["averis_mp4_link"];?>" /> 		
				<!-- Image fall back for non-HTML5 browser with JavaScript turned off and no Flash player installed -->
				<img src="media/echo-hereweare.jpg" width="100%" height="100%" alt="Here we are" 
					title="No video playback capabilities" />
			</object> 	
		</video>
		<script> 
			jQuery('audio,video').mediaelementplayer({
						pluginPath: '<?php echo $template_uri;?>/js/',
						// name of flash file
						flashName: 'flashmediaelement.swf',
						// name of silverlight file
						silverlightName: 'silverlightmediaelement.xap',
						success: function(player, node) {
							jQuery('#' + node.id + '-mode').html('mode: ' + player.pluginType);
						}
					});
		</script>		


	</body>
</html>