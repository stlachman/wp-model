<!-- CATEGORY -->
<?php
	

	$post_id = idbyslug ('category');
	$template_uri = get_template_directory_uri();
	
	// Language Options
		$averis_readmore = __('READ MORE', 'averis');
		$averis_by = __('by', 'averis');
		$averis_in = __('in', 'averis');
		$averis_on = __('in', 'averis');
		$averis_nocomments = __('No Comments', 'averis');
		$averis_onecomment = __('1 Comment', 'averis');
		$averis_comments = __('Comments', 'averis');
		$averis_category = __('Category','averis');

	// Page Options
		$pagecustoms = getOptions(get_option('page_for_posts'));


		// Headline Block On or Off (breadcrumbs too)
		
		$averis_breadcrumbs_active="on";
		$averis_headline_active="on";
		//$averis_headline = $averis_category;
		
		if(have_posts()) $current_cat = get_the_category();
		if(is_category()){
/* 		JAS	$averis_headline = $averis_category.' "'.$current_cat[0]->cat_name.'"'; */
			$averis_headline = $current_cat[0]->cat_name;
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
				$sidebar_class = "offset-by-one omega sidebar";	
				$main_class = "left alpha";
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
			$post_top_width = 440;
			$main_class = "";
		}		

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
			$excerpt_length = get_option_tree( 'aversis_blog_overview_excerpt' );
			if(get_option_tree( 'aversis_blog_overview_pictures_cut' )) $aversis_blog_overview_pictures_cut="on"; else $aversis_blog_overview_pictures_cut="off";

			//Socials
			if(get_option_tree( 'aversis_blog_overview_socials_active' )) $aversis_blog_overview_socials_active="on"; else $aversis_blog_overview_socials_active="off";
			if(get_option_tree( 'aversis_blog_overview_socials_twitter' )) {
				$aversis_blog_overview_socials_twitter="on"; 
				$aversis_blog_overview_socials_twitter_script = '<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>';
			}
			else {
				$aversis_blog_overview_socials_twitter="off";
				$aversis_blog_overview_socials_twitter_script = "";
			}
			if(get_option_tree( 'aversis_blog_overview_socials_google' )){
				$aversis_blog_overview_socials_google="on"; 
				$aversis_blog_overview_socials_google_script = '<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>';
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
				$aversis_blog_overview_socials_pinterest_script = '<script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script>';
			}
			else{
				$aversis_blog_overview_socials_pinterest="off";
				$aversis_blog_overview_socials_pinterest_script = "";
			}
			
		}	

?>    

<?php get_header(); ?>
<!-- CATEGORY -->
<div class="content">
<?php 
	/*echo $aversis_blog_overview_socials_google_script;
	echo $aversis_blog_overview_socials_twitter_script;
	echo $aversis_blog_overview_socials_pinterest_script;*/
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

<div class="sixteen columns alpha">	
	<div class="<?php echo $post_column_full." ".$main_class;?> columns">
	<?php if(have_posts()) : while(have_posts()) : the_post();
		$post_time_daymonthyear = date_i18n(get_option('date_format'), strtotime($post->post_date_gmt));
		$posttags = get_the_tags();
		$postcustoms = getOptions($post->ID);
		$blogimageurl="";
		$blogimageurl = aq_resize(wp_get_attachment_url( get_post_thumbnail_id($post->ID)),$post_top_width);
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

					if($postcustoms["averis_video_type"]=="youtube"){
						$scalevid = "scalevid";
						$post_top = '<iframe src="http://www.youtube.com/embed/'.$postcustoms["averis_youtube_id"].'?hd=1&wmode=opaque&autohide=1&showinfo=0" width="'.$video_width.'" height="'.$video_height.'" style="margin-bottom: -6px;" frameborder="0"></iframe>';

					}
					elseif ($postcustoms["averis_video_type"]=="vimeo") {
						$scalevid = "scalevid";
						$post_top = '<iframe src="http://player.vimeo.com/video/'.$postcustoms["averis_vimeo_id"].'?title=0&byline=0&portrait=0&color='.str_replace("#", "", get_option_tree("aversis_main_color")).'" width="'.$video_width.'" height="'.$video_height.'" style="margin-bottom: -6px;" frameborder="0"></iframe>';
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
					$post_top = do_shortcode('[averis_slider name="'.$averis_slider.'"]'); 	
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
	<div class="<?php echo $post_column_full;?> columns">
	

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
					<?php if ($aversis_blog_postinfo_active!="off"){ ?>
						<div class="blog_subinfos">
						<?php if($aversis_blog_postinfo_date_active!="off"){ ?>
							<span><?php echo $averis_on;?> <?php echo $post_time_daymonthyear; ?></span><span class="blog_subinfos_divider"></span>
						<?php } ?>
						<?php if($aversis_blog_postinfo_author_active!="off") {?>	
							<span><?php echo $averis_by;?> <?php the_author_posts_link(); ?></span><span class="blog_subinfos_divider"></span>
						<?php } ?>
						<?php if($aversis_blog_postinfo_categories_active!="off"){ ?>	
							<?php echo $averis_in;?> <?php echo $entrycategory; ?><span class="blog_subinfos_divider"></span>
						<?php } ?>
						<?php if($aversis_blog_postinfo_comments_active!="off"){ ?>	
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
	        <div class="divide50"></div>
	    <!-- PAGES END -->		
	</div>
<?php if($averis_activate_sidebar!="off") {?>
	<div class="four columns sidebar <?php echo $sidebar_class;?>">
		<div class="smallsizedivider"></div>
				 <div class="clear"></div>
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar) ) : ?>
						
	                       
	                        <div style="margin-bottom:20px"><span class="widget_title">Sidebar Widget Slot </span></div>
	                        <p style="color:#ccc">
	                        	Please configure this Widget in the Admin Panel under Appearance -> Widgets
	                        </p>
	                        <div class="clear"></div>
	                    
	                <?php endif;?>
	</div>	
<?php }
	?>
									

	
</div>
<?php get_footer(); ?>