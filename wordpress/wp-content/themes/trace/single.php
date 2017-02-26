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
		$averis_sharethis = __('Share This Post', 'averis');

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
		
		// Sidebar Options
		if(isset($pagecustoms["averis_activate_sidebar"])){
			$averis_activate_sidebar="on";
			$sidebar_orientation = $pagecustoms["averis_sidebar_orientation"];
			$sidebar = $pagecustoms["averis_sidebar"];
			$post_column_image = "six";
			$post_column_content = "five";
			$post_column_full = "eleven";
			$post_top_width = 440;
			$max_chars_related = 20;
			if($sidebar_orientation=="right"){
				$sidebar_class = "offset-by-one omega alpha sidebar";	
				$main_class = "left";
			}
			else {
				$sidebar_class = "leftfloat";
				$main_class = "rightfloat omega";
			}
		}
		else {
			$averis_activate_sidebar="off";
			$post_column_image = "eight";
			$post_column_content = "eight";
			$post_column_full = "sixteen";
			$post_top_width = 930;
			$max_chars_related = 28;
		}	
		$post_rel_width = 345;
		$post_rel_height = 180;	
		if(isset($pagecustoms["averis_video_width"]))
			$post_top_height = ($post_top_width/$pagecustoms["averis_video_width"])*$pagecustoms["averis_video_height"];
	// Blog Options
		if ( function_exists( 'get_option_tree') ) {
		
			if(get_option_tree( 'aversis_blog_date_sticker_active' )) $aversis_blog_date_sticker_active="on"; else $aversis_blog_date_sticker_active="off";
			
			//Post Info Line
			if(get_option_tree( 'aversis_blog_postinfo_active' )) $aversis_blog_postinfo_active="on"; else $aversis_blog_postinfo_active="off";
			if(get_option_tree( 'aversis_blog_postinfo_date_active' )) $aversis_blog_postinfo_date_active="on"; else $aversis_blog_postinfo_date_active="off";
			if(get_option_tree( 'aversis_blog_postinfo_author_active' )) $aversis_blog_postinfo_author_active="on"; else $aversis_blog_postinfo_author_active="off";
			if(get_option_tree( 'aversis_blog_postinfo_categories_active' )) $aversis_blog_postinfo_categories_active="on"; else $aversis_blog_postinfo_categories_active="off";
			if(get_option_tree( 'aversis_blog_tags_active' )) $aversis_blog_tags_active="on"; else $aversis_blog_tags_active="off";
			if(get_option_tree( 'aversis_blog_postinfo_comments_active' )) $aversis_blog_postinfo_comments_active="on"; else $aversis_blog_postinfo_comments_active="off";

			//Post Content
			if(get_option_tree( 'aversis_blog_overview_pictures_cut' )) $aversis_blog_overview_pictures_cut="on"; else $aversis_blog_overview_pictures_cut="off";
			if(get_option_tree( 'aversis_blog_related_posts_active' )) {
				$aversis_blog_related_posts_active="on"; 
				$aversis_blog_related_posts_number = get_option_tree( '$aversis_blog_related_posts_active');
			}
			else{
				$aversis_blog_related_posts_active="off";
				$aversis_blog_related_posts_number = 0;
			}

			//Socials
			if(get_option_tree( 'aversis_blog_overview_socials_active' )) $aversis_blog_overview_socials_active="on"; else $aversis_blog_overview_socials_active="off";
			if(get_option_tree( 'aversis_blog_overview_socials_twitter' )) {
				$aversis_blog_overview_socials_twitter="on"; 
				$aversis_blog_overview_socials_twitter_script = '<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>';
			}
			else {
				$aversis_blog_overview_socials_twitter="off";
				$aversis_blog_overview_socials_twitter_script = "";
			}
			if(get_option_tree( 'aversis_blog_overview_socials_google' )){
				$aversis_blog_overview_socials_google="on"; 
				$aversis_blog_overview_socials_google_script = '<script type="text/javascript" src="//apis.google.com/js/plusone.js"></script>';
			}	
			else {
				$aversis_blog_overview_socials_google="off";
				$aversis_blog_overview_socials_google_script = "";
			}
			if(get_option_tree( 'aversis_blog_overview_socials_facebook' )){
				$aversis_blog_overview_socials_facebook="on"; 
			}
			else $aversis_blog_overview_socials_facebook="off";
			if(get_option_tree( 'aversis_blog_overview_socials_pinterest' )){
				$aversis_blog_overview_socials_pinterest="on"; 
				$aversis_blog_overview_socials_pinterest_script = '<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>';
			}
			else{
				$aversis_blog_overview_socials_pinterest="off";
				$aversis_blog_overview_socials_pinterest_script = "";
			}
			
		}	

?>    

<?php get_header(); ?>
<!-- TRACETEMPLATE SINGLE -->
<div class="content">
<?php 
	echo $aversis_blog_overview_socials_google_script;
	echo $aversis_blog_overview_socials_twitter_script;
	echo $aversis_blog_overview_socials_pinterest_script;
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

	
	<!--
	##############################
		- CONTENT -
	##############################
	-->		
	<?php if(have_posts()) : while(have_posts()) : the_post();
		$post_time_daymonthyear = date_i18n(get_option('date_format'), strtotime($post->post_date_gmt));
		$posttags = get_the_tags();
		$postcustoms = getOptions($post->ID);

		$blogimageurl="";
		$blogimageurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
		$scalevid="";
		if(isset($postcustoms["averis_post_type"]))
			switch ($postcustoms["averis_post_type"]) {
				case 'image': 
					
					if($blogimageurl!=""){
						$post_top = '<img class="blog_image" src="'.$blogimageurl.'">';
					}
				break;
				
				case 'audio':
					$post_top = '<audio id="player3"  width="100%" src="'.$postcustoms["averis_audio_link"].'" type="audio/mp3" controls="controls"></audio>';
				break;
				
				case 'video':
					$video_width = $postcustoms["averis_video_width"];
					$video_height = $postcustoms["averis_video_height"];
					if($postcustoms["averis_video_type"]=="youtube"){
						$scalevid = "scalevid";
						$post_top = '<iframe src="http://www.youtube.com/embed/'.$postcustoms["averis_youtube_id"].'?hd=1&amp;wmode=opaque&amp;autohide=1&amp;showinfo=0" width="'.$video_width.'" height="'.$video_height.'" style="margin-bottom: -6px;border:0"></iframe>';
					}
					elseif ($postcustoms["averis_video_type"]=="vimeo") {
						$scalevid = "scalevid";
						$post_top = '<iframe src="http://player.vimeo.com/video/'.$postcustoms["averis_vimeo_id"].'?title=0&amp;byline=0&amp;portrait=0&amp;color='.str_replace("#", "", get_option_tree("aversis_main_color")).'" width="'.$video_width.'" height="'.$video_height.'" style="margin-bottom: -6px;border:0"></iframe>';
					}
					elseif ($postcustoms["averis_video_type"]=="flv") {
						$uniq = uniqid("flv_");
						$blogimageurl="";
						$blogimageurl = aq_resize(wp_get_attachment_url( get_post_thumbnail_id($post->ID)),$post_top_width);
						$blogimageurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
						$post_top = '<div class="video-wrapper">
														<div class="video-container"><a class="bordered" href="'.$postcustoms["averis_flv_link"].'" style="display:block;width:100%;height:100%;"   id="'.$uniq.'"> 

									</a> </div></div>

									<!-- this will install flowplayer inside previous A- tag. -->
									<script>
									flowplayer("'.$uniq.'", "'.$template_uri.'/js/flowplayer_plugins/flowplayer-3.2.7.swf", {
									    clip: {autoPlay: false, autoBuffering: false}, canvas: {background:"#000000 url('.$blogimageurl.') no-repeat center center"}
									});
									</script>';
					}
					elseif ($postcustoms["averis_video_type"]=="webm") {
						$post_top = '
								<div class="html5video"><iframe frameborder="0" width="100%" height="100%" style="margin-bottom: -6px;" src="'.$template_uri.'/functions/video.php?post_id='.$post->ID.'" style="overflow:hidden" bgcolor="#C9D3DE"></iframe><div class="clear"></div></div><div class="clear"></div>
							
							
						';
					}
				break;
				case 'slider':
					$averis_slider = $postcustoms["averis_slider"];
					$post_top = do_shortcode('[rev_slider '.$averis_slider.']');	
				break;
				default:
					$post_top = "";
				break;
				
				
			}




		$entrycategory = "";
		if(is_tax()){
			$entrycategory = get_the_term_list( '', "category_".$tax_slug, '', ', ', '' );
		}
		else {
			foreach((get_the_category()) as $category) { 
				$entrycategory .= ', <a href="'.get_category_link($category->term_id ).'">'.$category->cat_name.'</a>';
			} 
			$entrycategory = substr($entrycategory, 2);
		}

		if(isset($postcustoms["averis_header_title"]))
			$post_headline = $postcustoms["averis_header_title"];
		else
			$post_headline = get_the_title($post->ID);
	?>				

	<div class="sixteen columns alpha">
				<div class="divide50"></div><!--div id="post-<?php the_ID(); ?>" <?php post_class(); ?>-->
				<div class="<?php echo $post_column_full." ".$main_class;?> columns" style="overflow:visible">						
										<!--	BLOGPOST	-->
										<?php if(isset($post_top) && $post_top !=""){ ?>
											<div class="tp_blog_imgholder <?php echo $scalevid;?> full"><?php echo $post_top;?></div>
										<?php } ?>
										
										<div class="blog_topline"><?php the_title(); ?></div>
										<?php if ($aversis_blog_postinfo_active!="off"){ ?>
											<div class="blog_subinfos">
											<?php if($aversis_blog_postinfo_date_active!="off") {?>	
												<span><?php echo $averis_on;?> <?php echo $post_time_daymonthyear; ?></span><span class="blog_subinfos_divider"></span>
											<?php } ?>
											<?php if($aversis_blog_postinfo_author_active!="off") {?>	
												<span><?php echo $averis_by;?> <?php the_author_posts_link(); ?></span><span class="blog_subinfos_divider"></span>
											<?php } ?>
											<?php if($aversis_blog_postinfo_categories_active!="off"){ ?>	
												<?php echo $averis_in;?> <?php echo $entrycategory; ?><span class="blog_subinfos_divider"></span>
											<?php } ?>
											<?php if($aversis_blog_postinfo_comments_active!="off"){ ?>	
												<?php if ( comments_open() ) : ?><?php comments_popup_link($averis_nocomments, $averis_onecomment, '% '.$averis_comments); ?><?php endif; ?><span class="blog_subinfos_divider"></span>
											<?php } ?>
											</div>
										<?php } ?>
										<?php the_content(); ?>
										<?php if ($aversis_blog_postinfo_active!="off" && $aversis_blog_tags_active!="off"){ ?>
											<div class="divide50"></div>
											<div class="tag_holder">
												<ul class="listfade">
												<?php 
													if ($posttags) {
														the_tags( '<li><span class="tag">', '</span></li><li><span class="tag">', '</span></li>' );
													}
												?>
												</ul>
												<div class="clear"></div>
											</div>
										<?php } ?>
										<div class="clear"></div>
										
										<!-- SHARE THE BLOG // SOCIAL SHARES -->
										<?php if($aversis_blog_overview_socials_active=="on"){ ?>
											<div class="divide50"></div>
											<div class="titledivider"><?php echo $averis_sharethis;?></div>
											<div class="sharings_wrap">
												<?php if($aversis_blog_overview_socials_twitter!="off"){ ?>
													<div class="sharings first shtwitter">
														<a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-count="horizontal">Tweet</a> 
													</div> 				
												<?php } ?>
												<?php if($aversis_blog_overview_socials_google!="off"){ ?>										
													<div class="sharings shgoogleplus">
														<div class="g-plusone" data-size="medium" data-count="true"></div>
													</div> 
												<?php } ?>
												<?php if($aversis_blog_overview_socials_pinterest!="off"){ ?>	
													<div class="sharings shpinterest">
														<a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&<mp;media=<?php echo urlencode($blogimageurl); ?>&amp;description=<?php echo urlencode(excerpt(25)); ?>" class="pin-it-button"><img src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
													</div>
												<?php } ?>
												<?php if($aversis_blog_overview_socials_facebook!="off"){ ?>	
													<div class="sharings first shfacebook">
														<div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="250" data-show-faces="false" data-font="arial"></div>
														<div id="fb-root"></div>
													</div> 								
												<?php } ?>						
												<div class="clear"></div>		
											</div>
											<?php } ?>
										
										
										
										<!-- RELATED POSTS -->		
										
							<?php 	if ($aversis_blog_related_posts_active!="off"){ ?>

							<?php		$tags = wp_get_post_tags($post->ID);
										if ($tags) {
											$tag_ids = array();
											foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

											$args=array(
												'tag__in' => $tag_ids,
												'post__not_in' => array($post->ID),
												'showposts'=>$aversis_blog_related_posts_number, 
												'ignore_sticky_posts'=>1
											);
											$temp = $wp_query; 
											$my_query = new wp_query($args);
											if( $my_query->have_posts() ) {
												?>
												<div class="tp_teaser two_per_page">
												<div class="divide50"></div>
												<div class="titledivider">Related Post</div>
												<?php if ($my_query->post_count>2){?>
													<div class="tp_teaser_navigation rightfloat">
														<div class="tp_teaser_left notinuse"></div>
														<div class="tp_teaser_right"></div>
														<div class="clear"></div>
													</div>		
												<?php } ?>
												<div class="tp_teaser_rotator">
													<div class="divide20"></div>								
													<ul>		
										<?php	while ($my_query->have_posts()) {
													$my_query->the_post();
													$blogimageurl="";
													$blogimageurl = aq_resize(wp_get_attachment_url( get_post_thumbnail_id($post->ID)),$post_rel_width,$post_rel_height,true);
													$title = get_the_title();
													//if(strlen($title)>$max_chars_related) $title = substr($title, 0, $max_chars_related)."...";
												?>
														<li>
															<div class="tp_teaser_imgholder hovering"><img src="<?php echo $blogimageurl; ?>"><div class="hovering_link"><a href="<?php echo get_permalink(); ?>"><div class="plink"></div></a></div></div>
															<div class="teaser_topline"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></div>
															<div class="blog_subinfos">
																<span><?php echo $averis_on;?> <?php echo $post_time_daymonthyear; ?></span>
																
																</div>															
															<a href="<?php the_permalink(); ?>" class="more"><?php echo $averis_readmore; ?> &raquo;</a>
														</li>
												<?php
												}
													$wp_query = null; 
													$wp_query = $temp;
													wp_reset_query();
												?>
												</ul>
												</div>	
										</div>	<!-- RELATED POST ENDS HERE -->
									<?php	}
										}
									}
?>												

				
										<!-- Post Comments -->
									            <?php if ( comments_open() )comments_template('', true); ?>
			        							<?php $commentsvar=0;if($commentsvar){ comment_form();wp_link_pages( $args ); }?>
									            <!-- Post Comments End -->
										</div>
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
										<?php } ?>
								<div class="clear"></div>
								<div class="small right mart20">Is there a problem with this page? Help us fix it - <a href="/report-a-bug">Report a Bug</a></div>
						</div>
		
					
	<?php endwhile; endif; //have_posts ?>									
<?php get_footer(); ?>