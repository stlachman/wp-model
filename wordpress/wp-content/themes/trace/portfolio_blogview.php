<?php
/* 
Template Name: Portfolio Blogview
*/
?>
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

	// Page Options
		$pagecustoms = getOptions($post_id);


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
			$post_top_width = 330;
			if($sidebar_orientation=="right"){
				$sidebar_class = "offset-by-one omega";	
				$main_class = "left alpha";
			}
			else {
				$sidebar_class = "alpha";
				$main_class = "rightfloat_leftfloat omega";
			}
		}
		else {
			$averis_activate_sidebar="off";
			$post_column_image = "eight";
			$post_column_content = "eight";
			$post_column_full = "sixteen";
			$post_top_width = 440;
			$main_class = "";
		}		

	//Portfolio
		if (isset($pagecustoms["averis_portfolio"])){
			$ptype = $pagecustoms['averis_portfolio'];
			$pcat = "category_".$ptype;
			$pcat_array = get_option('averis_portfolio_slug');
			$pcat_index = array_search($ptype, $pcat_array);
		}
		if(isset($pagecustoms["averis_portfolio_items_row"])) {$row_items = $pagecustoms["averis_portfolio_items_row"];}else {$row_items="";}
		if(isset($pagecustoms["averis_portfolio_items_per_page"])) {$page_items = $pagecustoms["averis_portfolio_items_per_page"];}else {$page_items="5";}
		$averis_portfolio_share_detail = get_option("averis_portfolio_share_detail");

		if(isset($pagecustoms["averis_portfolio_display"])) $view_type = $pagecustoms["averis_portfolio_display"];

	// Blog Options
		if ( function_exists( 'get_option_tree') ) {
		
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
			if(get_option_tree( 'aversis_portfolio_cuts' )){
				$averis_cut="on"; 
				$averis_height=get_option_tree( 'aversis_portfolio_cuts_height' );
			}
			else {
				$averis_cut="off";
			}

			$averis_posts_per_page = get_option_tree( 'aversis_portfolio_posts_per_page' );

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
<!-- TRACETEMPLATE PORTFOLIO BLOGVIEW -->
<div class="content">
<?php 
										// Query for Portfolio
											$paged =
												( get_query_var('paged') && get_query_var('paged') > 1 )
												? get_query_var('paged')
												: 1;			
											$args=array(
						    					'post_type' => $ptype,
						    					'posts_per_page' => $averis_posts_per_page,
						    					'paged' => $paged
							    			);
							    			
							    			$temp = $wp_query; 
							    			$wp_query = null;
							    			$wp_query = new WP_Query();
							    			$wp_query->query($args);

							    			$item_counter=1;

							    		
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
<div class="sixteen columns">	
	<div class="divide50"></div>
	<div class="<?php echo $post_column_full." ".$main_class;?> columns">
	<?php if(have_posts()) : while(have_posts()) : the_post();
		$post_time_daymonthyear = date_i18n(get_option('date_format'), strtotime($post->post_date_gmt));
		$posttags = get_the_tags();
		$postcustoms = getOptions($post->ID);
		$blogimageurl="";
		if($averis_cut!="off"){
			$blogimageurl = aq_resize(wp_get_attachment_url( get_post_thumbnail_id($post->ID)),$post_top_width,$averis_height*2,true);
		}
		else{	
			$blogimageurl = aq_resize(wp_get_attachment_url( get_post_thumbnail_id($post->ID)),$post_top_width);
		}
		$scalevid="";
		if(isset($postcustoms["averis_post_type"]))
			switch ($postcustoms["averis_post_type"]) {
				case 'image': 
					if($blogimageurl!=""){
						$post_top = '<div class="hovering"><img class="blog_image" src="'.$blogimageurl.'"><div class="hovering_link"><a href="'.get_permalink().'"><div class="plink"></div></a></div><!--div class="hovering_more notalone"><a href="http://www.themepunch.com/aversis/wp-content/uploads/2012/05/company21.png" rel="prettyPhoto[folio]" title="ENTRY DESCRIPTION TEXT GOES HERE" ><div class="pmore"></div></a></div--></div>';
					}
				break;
				
				case 'audio':
					$post_top = '<audio id="player3"  width="100%" src="'.$postcustoms["averis_audio_link"].'" type="audio/mp3" controls="controls"></audio>';
				break;
				
				case 'video':
					$video_width = $postcustoms["averis_video_width"];
					$video_height = $postcustoms["averis_video_height"];

					//$video_width_ratio = $video_width/$post_top_width;
					//$video_height = $video_height*$video_width_ratio;

					if($postcustoms["averis_video_type"]=="youtube"){
						$scalevid = "scalevid";
						$post_top = '<iframe src="http://www.youtube.com/embed/'.$postcustoms["averis_youtube_id"].'?hd=1&amp;wmode=opaque&amp;autohide=1&amp;showinfo=0" width="'.$video_width.'" height="'.$video_height.'" style="margin-bottom: -6px;border:0;"></iframe>';

					}
					elseif ($postcustoms["averis_video_type"]=="vimeo") {
						$scalevid = "scalevid";
						$post_top = '<iframe src="http://player.vimeo.com/video/'.$postcustoms["averis_vimeo_id"].'?title=0&amp;byline=0&amp;portrait=0&amp;color='.str_replace("#", "", get_option_tree("aversis_main_color")).'" width="'.$video_width.'" height="'.$video_height.'" style="margin-bottom: -6px;border:0;"></iframe>';
					}
					elseif ($postcustoms["averis_video_type"]=="flv") {
						$blogimageurl="";
						$blogimageurl = aq_resize(wp_get_attachment_url( get_post_thumbnail_id($post->ID)),$post_top_width);
						$uniq = uniqid("flv_");
						$post_top = '<div class="video-wrapper">
														<div class="video-container"><a class="bordered" href="'.$postcustoms["averis_flv_link"].'" style="display:block;width:100%;height:auto;"   id="'.$uniq.'"> 

									</a>

									<!-- this will install flowplayer inside previous A- tag. -->
									<script>
									flowplayer("'.$uniq.'", "'.$template_uri.'/js/flowplayer_plugins/flowplayer-3.2.7.swf", {
									    clip: {autoPlay: false, autoBuffering: false}, canvas: {background:"#000000 url('.$blogimageurl.') no-repeat"}
									});
									</script></div></div>';
					}
					elseif ($postcustoms["averis_video_type"]=="webm") {
						$post_top = '<div class="html5video">
								<iframe frameborder="0" width="100%" height="100%" style="margin-bottom: -6px;" src="'.$template_uri.'/functions/video.php?post_id='.$post->ID.'" style="overflow:hidden" bgcolor="#C9D3DE"></iframe>
							</div>
							
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
		$entrycategory = get_the_term_list( '', $pcat, '', ', ', '' );

		if(isset($postcustoms["averis_header_title"]))
			$post_headline = $postcustoms["averis_header_title"];
		else
			$post_headline = get_the_title($post->ID);
	?>				
	<div class="<?php echo $post_column_full;?> columns alpha">
	

	<!--	BLOGPOST	-->
		<?php if(($postcustoms["averis_post_type"]=="image" && $blogimageurl!="") || $postcustoms["averis_post_type"]!="image"){?>
		<div class="<?php echo $post_column_image;?> columns alpha" style="overflow:visible">
			<div class="tp_blog_imgholder <?php echo $scalevid;?>"> <?php echo $post_top; ?></div>
		</div>
		<div class="<?php echo $post_column_content;?> columns omega">
		<?php } 
		else { ?>
			<div class="<?php echo $post_column_full;?> columns">
			<?php } ?>
					<div class="blog_topline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
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
							<?php if ( comments_open() ) : ?><?php comments_popup_link($averis_nocomments, $averis_onecomment, '% '.$averis_comments); ?><?php endif; ?><span class="blog_subinfos_divider">|</span>
						<?php } ?>
						</div>
					<?php } ?>
					<p><?php echo excerpt($excerpt_length);?></p>
					<a href="<?php the_permalink(); ?>" class="more"><?php echo $averis_readmore; ?> &raquo;</a>
					<div class="clear"></div>
			</div>
		<div class="clear"></div>
		<div class="pagedivider"></div>	
	</div>							
		<?php endwhile; endif; //have_posts ?>	
		<!-- PAGES -->
	        <?php if(function_exists('pagination')){ pagination(); }else{ paginate_links(); } ?>
	        <div class="divide5"></div>
	    <!-- PAGES END -->		
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
<?php }
	?>
									

<div class="small right mart20">Is there a problem with this page? Help us fix it - <a href="/report-a-bug">Report a Bug</a></div>
</div>
<?php get_footer(); ?>