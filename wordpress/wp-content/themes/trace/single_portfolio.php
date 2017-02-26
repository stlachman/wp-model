<?php
	global $wp_query;
    if(isset($wp_query))
    	$content_array = $wp_query->get_queried_object();
	if(isset($content_array->ID)){
    	$post_id = $content_array->ID;
	}	
	
	$post_top = "";

	$template_uri = get_template_directory_uri();
	
	// Language Options
		$averis_readmore = __('READ MORE', 'averis');
		$averis_by = __('by', 'averis');
		$averis_in = __('in', 'averis');
		$averis_on = __('on', 'averis');
		$averis_nocomments = __('No Comments', 'averis');
		$averis_onecomment = __('1 Comment', 'averis');
		$averis_comments = __('Comments', 'averis');
		$averis_sharethis_project = __('Share This Project', 'averis');

	// Page Options
		$pagecustoms = getOptions();


		// Headline Block On or Off (breadcrumbs too)
		if(isset($pagecustoms["averis_headline_active"])){
			if(isset($pagecustoms["averis_breadcrumbs_active"])){$averis_breadcrumbs_active="on";}else {$averis_breadcrumbs_active="off";}
			$averis_headline_active="on";
			if(isset($pagecustoms["averis_header_title"]))
				$averis_headline = $pagecustoms["averis_header_title"];
			else
				$averis_headline = get_the_title($post_id);
		}
		else {
			$averis_headline_active="off";
		}	

		if(isset($pagecustoms["averis_detail_view_style"])) $averis_detail_view_style = $pagecustoms["averis_detail_view_style"];
		else $averis_detail_view_style="full";
		// Sidebar Options
		if($averis_detail_view_style=="full"){
			if(isset($pagecustoms["averis_activate_sidebar"])){
				$averis_activate_sidebar="on";
				$sidebar_orientation = $pagecustoms["averis_sidebar_orientation"];
				$sidebar = $pagecustoms["averis_sidebar"];
				$post_column_image = "eleven";
				$post_column_content = "eleven";
				$post_column_full = "eleven";
				$post_top_width = 440;
				if($sidebar_orientation=="right"){
					$sidebar_class = "offset-by-one omega alpha sidebar";	
					$main_class = "alpha left";
				}
				else {
					$sidebar_class = "leftfloat";
					$main_class = "rightfloat omega";
				}
			}
			else {
				$averis_activate_sidebar="off";
				$post_column_image = "sixteen";
				$post_column_content = "sixteen";
				$post_column_full = "sixteen";
				$post_top_width = 930;
				$main_class = "alpha omega ";
			}	
		}else { //Column View
			$averis_activate_sidebar="off";
			$post_column_image = "eight alpha";
			$post_column_content = "eight omega";
			$post_column_full = "sixteen alpha";
			$post_top_width = 440;
			$main_class = "";
		}
		$post_rel_width = 345;
		$post_rel_height = 180;	
		if(isset($pagecustoms["averis_video_width"]))
			$post_top_height = ($post_top_width/$pagecustoms["averis_video_width"])*$pagecustoms["averis_video_height"];
	// Blog Options
		if ( function_exists( 'get_option_tree') ) {
			
			//Highlight Color
			$highlight_color = get_option_tree("aversis_main_color");

			//Post Info Line
			if(get_option_tree( 'aversis_portfolio_postinfo_active' )) $averis_blog_postinfo_active="on"; else $averis_blog_postinfo_active="off";
			if(get_option_tree( 'aversis_portfolio_postinfo_date_active' )) $averis_blog_postinfo_date_active="on"; else $averis_blog_postinfo_date_active="off";
			if(get_option_tree( 'aversis_portfolio_postinfo_author_active' )) $averis_blog_postinfo_author_active="on"; else $averis_blog_postinfo_author_active="off";
			if(get_option_tree( 'aversis_portfolio_postinfo_categories_active' )) $averis_blog_postinfo_categories_active="on"; else $averis_blog_postinfo_categories_active="off";
			if(get_option_tree( 'aversis_portfolio_postinfo_tags_active' )) $averis_blog_postinfo_tags_active="on"; else $averis_blog_postinfo_tags_active="off";
			if(get_option_tree( 'aversis_portfolio_postinfo_comments_active' )) $averis_blog_postinfo_comments_active="on"; else $averis_blog_postinfo_comments_active="off";

			$detail_view = get_option_tree('aversis_portfolio_detail_view');
			if(get_option_tree( 'aversis_portfolio_category_filter' )) $aversis_portfolio_category_filter="on"; else $aversis_portfolio_category_filter="off";
			if(get_option_tree( 'aversis_portfolio_sorting' )) $aversis_portfolio_sorting="on"; else $aversis_portfolio_sorting="off";

			//Post Content
			$excerpt_length = get_option_tree( 'aversis_portfolio_overview_excerpt' );
			if(get_option_tree( 'aversis_portfolio_overview_pictures_cut' )) $averis_blog_overview_pictures_cut="on"; else $averis_blog_overview_pictures_cut="off";

			//Socials
			if(get_option_tree( 'aversis_portfolio_overview_socials_active' )) $averis_blog_overview_socials_active="on"; else $averis_blog_overview_socials_active="off";
			if(get_option_tree( 'aversis_portfolio_overview_socials_twitter' )) {
				$averis_blog_overview_socials_twitter="on"; 
				$averis_blog_overview_socials_twitter_script = '<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>';
			}
			else {
				$averis_blog_overview_socials_twitter="off";
				$averis_blog_overview_socials_twitter_script = "";
			}
			if(get_option_tree( 'aversis_portfolio_overview_socials_google' )){
				$averis_blog_overview_socials_google="on"; 
				$averis_blog_overview_socials_google_script = '<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>';
			}	
			else {
				$averis_blog_overview_socials_google="off";
				$averis_blog_overview_socials_google_script = "";
			}
			if(get_option_tree( 'aversis_portfolio_overview_socials_facebook' )){
				$averis_blog_overview_socials_facebook="on"; 
			}
			else $averis_blog_overview_socials_facebook="off";
			if(get_option_tree( 'aversis_portfolio_overview_socials_pinterest' )){
				$averis_blog_overview_socials_pinterest="on"; 
				$averis_blog_overview_socials_pinterest_script = '<script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script>';
			}
			else{
				$averis_blog_overview_socials_pinterest="off";
				$averis_blog_overview_socials_pinterest_script = "";
			}
		}	

?>    

<?php get_header(); ?>
<!-- TRACETEMPLATE SINGLE PORTFOLIO -->
<div class="content">
<?php 
	echo $averis_blog_overview_socials_google_script;
	echo $averis_blog_overview_socials_twitter_script;
	echo $averis_blog_overview_socials_pinterest_script;
?>
<?php if ($averis_headline_active!="off"){?>

	<!--
	####################################
		-	TITLE && BREADCRUMB	-
	####################################
	-->
	<div class="sixteen columns alpha">							
		<div class="pagetitleholder">								
			<div class="breadcrumb_holder">
				<div class="breadcrumb"><?php 
						if($averis_breadcrumbs_active!="off"){
							if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); 
						}
						else
							echo "<span class='marked'>&nbsp;</span></div>
									<div class='clear'></div>";
					?></div>
				<div class="clear"></div>								
			</div>
			<div class="clear"></div>								
		</div>
	</div>
<?php } ?>

	<div class="clear"></div>
	<div class="divide50"></div>
	<!--
	##############################
		- CONTENT -
	##############################
	-->		
<div class="sixteen columns">
				
	<?php if(have_posts()) : while(have_posts()) : the_post();
		global $post;
		$post_time_daymonthyear = date_i18n(get_option('date_format'), strtotime($post->post_date_gmt));
		$posttags = get_the_tags();
		//$pagecustoms = getOptions($post->ID);

		$blogimageurl="";
		$blogimageurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
		$scalevid="";				
		if(isset($pagecustoms["averis_post_type"]))
			switch ($pagecustoms["averis_post_type"]) {
				case 'image': 
					
					if($blogimageurl!=""){
						$post_top = '<img class="blog_image" src="'.$blogimageurl.'">';
					}
				break;
				
				case 'audio':
					$post_top = '<audio id="player3"  width="100%" src="'.$pagecustoms["averis_audio_link"].'" type="audio/mp3" controls="controls"></audio>';
				break;
				
				case 'video':
					$video_width = $postcustoms["averis_video_width"];
					$video_height = $postcustoms["averis_video_height"];
					if($pagecustoms["averis_video_type"]=="youtube"){
						$scalevid = "scalevid";
						$post_top = '<iframe src="http://www.youtube.com/embed/'.$pagecustoms["averis_youtube_id"].'?hd=1&amp;wmode=opaque&amp;autohide=1&amp;showinfo=0" width="'.$video_width.'" height="'.$video_height.'" style="margin-bottom: -6px;border:0"></iframe>';
					}
					elseif ($pagecustoms["averis_video_type"]=="vimeo") {
						$scalevid = "scalevid";
						$post_top = '<iframe src="http://player.vimeo.com/video/'.$pagecustoms["averis_vimeo_id"].'?title=0&amp;byline=0&amp;portrait=0&amp;color='.str_replace("#", "", $highlight_color).'" width="'.$video_width.'" height="'.$video_height.'" style="margin-bottom: -6px;border:0"></iframe>';
					}
					elseif ($pagecustoms["averis_video_type"]=="flv") {
						$uniq = uniqid("flv_");
						$blogimageurl="";
						$blogimageurl = aq_resize(wp_get_attachment_url( get_post_thumbnail_id($post->ID)),$post_top_width);
						$post_top = '<div class="video-wrapper">
														<div class="video-container"><a class="bordered" href="'.$pagecustoms["averis_flv_link"].'" style="display:block;width:100%;height:100%;"   id="'.$uniq.'"> 

									</a> </div></div>

									<!-- this will install flowplayer inside previous A- tag. -->
									<script>
									flowplayer("'.$uniq.'", "'.$template_uri.'/js/flowplayer_plugins/flowplayer-3.2.7.swf", {
									    clip: {autoPlay: false, autoBuffering: false}, canvas: {background:"#000000 url('.$blogimageurl.') no-repeat center center"}
									});
									</script>';
					}
					elseif ($pagecustoms["averis_video_type"]=="webm") {
						$post_top = '
								<div class="html5video"><iframe frameborder="0" width="100%" height="100%" style="margin-bottom: -6px;" src="'.$template_uri.'/functions/video.php?post_id='.$post->ID.'" style="overflow:hidden" bgcolor="#C9D3DE"></iframe><div class="clear"></div></div><div class="clear"></div>
							
							
						';
					}
				break;
			case 'slider':
					$averis_slider = $pagecustoms["averis_slider"];
					$post_top = do_shortcode('[rev_slider '.$averis_slider.']');
				break;
				default:
					$post_top = "";
				break;
				
				
			}

		$entrycategory = "";
		$entrycategory = get_the_term_list( '', $pcat, '', ', ', '' );

		if(isset($pagecustoms["averis_header_title"]))
			$post_headline = $pagecustoms["averis_header_title"];
		else
			$post_headline = get_the_title($post->ID);
	?>				
		<div class="sixteen columns alpha">
			<div class="<?php echo $post_column_full." ".$main_class;?> columns">
					<div class="<?php echo $post_column_image." ".$main_class;?> columns " style="overflow:visible">									
													<!--	BLOGPOST	-->
													
													<div class="tp_blog_imgholder <?php echo $scalevid;?> full"><?php echo $post_top;?></div>
													<div class="clear"></div>
					</div>
					<div class="<?php echo $post_column_content;?> columns" style="overflow:visible">																		
										<div class="blog_topline"><?php the_title(); ?></div>
										<?php if ($averis_blog_postinfo_active!="off"){ ?>
											<div class="blog_subinfos">
											<?php if($averis_blog_postinfo_date_active!="off"){ ?>
												<span><?php echo $averis_on;?> <?php echo $post_time_daymonthyear; ?></span><span class="blog_subinfos_divider"></span>
											<?php } ?>
											<?php if($averis_blog_postinfo_author_active!="off") {?>	
												<span><?php echo $averis_by;?> <?php the_author_posts_link(); ?></span><span class="blog_subinfos_divider"></span>
											<?php } ?>
											<?php if($averis_blog_postinfo_categories_active!="off"){ ?>	
												<?php echo $averis_in;?> <?php echo $entrycategory; ?><span class="blog_subinfos_divider"></span>
											<?php } ?>
											<?php if($averis_blog_postinfo_comments_active!="off"){ ?>	
												<?php if ( comments_open() ) : ?><?php comments_popup_link($averis_nocomments, $averis_onecomment, '% '.$averis_comments); ?><?php endif; ?>
											<?php } ?>
											</div>
										<?php } ?>
										<?php the_content(); ?>
										
										<div class="clear"></div>
										
										<!-- SHARE THE BLOG // SOCIAL SHARES -->
										<?php if($averis_blog_overview_socials_active=="on"){ ?>
											<!--div class="divide50"></div-->
											<div class="titledivider"><?php echo $averis_sharethis_project;?></div>
											<div class="sharings_wrap">
												<?php if($averis_blog_overview_socials_twitter!="off"){ ?>
													<div class="sharings first shtwitter">
														<a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-count="horizontal">Tweet</a> 
													</div> 				
												<?php } ?>
												<?php if($averis_blog_overview_socials_google!="off"){ ?>										
													<div class="sharings shgoogleplus">
														<div class="g-plusone" data-size="medium" data-count="true"></div>
													</div> 
												<?php } ?>
												<?php if($averis_blog_overview_socials_pinterest!="off"){ ?>	
													<div class="sharings shpinterest">
														<a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&amp;media=<?php echo urlencode($blogimageurl); ?>&amp;description=<?php echo urlencode(excerpt(25)); ?>" class="pin-it-button"><img src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
													</div>
												<?php } ?>
												<?php if($averis_blog_overview_socials_facebook!="off"){ ?>	
													<div class="sharings first shfacebook">
														<div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="250" data-show-faces="false" data-font="arial"></div>
														<div id="fb-root"></div>
													</div> 								
												<?php } ?>						
												<div class="clear"></div>		
											</div>
											<?php } ?>
										
										
										
									<?php if ($averis_detail_view_style == "full"){?>	
										<!-- Post Comments -->
								            <?php comments_template('', true); ?>
								        	<?php //if($commentsvar) comment_form(); ?>
									    <!-- Post Comments End -->
									<?php } ?>
							<div class="clear"></div>
							</div>
							<div class="clear"></div>
</div>
<?php if ($averis_detail_view_style != "full"){?>	
	<!-- Post Comments -->
	<div class="clear"></div>
	<div class="sixteen columns" style="clear:both"> 
		
        <?php comments_template('', true); ?>
    	<?php //if($commentsvar) comment_form(); ?>
    <!-- Post Comments End -->
</div>
<?php } ?>
								
							
														
						
			
	<?php endwhile; endif; //have_posts ?>	

	<?php if($averis_activate_sidebar!="off") {?>
		<div class="four columns sidebar <?php echo $sidebar_class;?>">
			<div class="smallsizedivider"></div>
					 <div class="clear"></div>
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar) ) : ?>
							
		                       
		                        <div style="margin-bottom:20px"><span class="widget_title">Sidebar Widget </span></div>
		                        <p style="color:#ccc">
		                        	Please configure this Widget in the Admin Panel under Appearance -> Widgets
		                        </p>
		                        <div class="clear"></div>
		                    
		                <?php endif;?>
		</div>	
	<?php }
	?>
	<div class="small right mart20">Is there a problem with this page? Help us fix it - <a href="/report-a-bug">Report a Bug</a></div>
	</div>
</div>


<?php get_footer(); ?>