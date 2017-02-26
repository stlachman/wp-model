<?php
/* 
Template Name: Portfolio
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
		$averis_sort_all = __('All', 'averis');
		$averis_sort_by = __('Sort by', 'averis');
		$averis_sort_date_added = __('Date Added', 'averis');
		$averis_sort_entry_title = __('Entry Title', 'averis');
		$averis_sort_ascending = __('Ascending', 'averis');
		$averis_sort_descending = __('Descending', 'averis');
		$averis_sort_select_option = __('Select Option', 'averis');
		$averis_sort_select_direction = __('Select Direction', 'averis');

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

			$post_top_heigth = 210;
			$rownumber = 2;

			
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
			$main_class="";
			$post_top_width = 450;
			$post_top_heigth = 236;
			$rownumber = 4;
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
		$scalevid="scalevid";
?>    

<?php get_header(); ?>
<!-- TRACETEMPLATE PORTFOLIO -->
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
<div class="sixteen columns alpha">	
	<div class="divide50"></div>
	<div class="<?php echo $post_column_full." ".$main_class; ?> columns alpha omega">
		
		<div class="<?php echo $post_column_full; ?> columns portfolio_filter">						
								<?php 
									$tax_terms = get_terms($pcat);
									if(sizeof($tax_terms)<2 || $aversis_portfolio_category_filter!="on"){$display="style='display:none'";}
									else {$display="";} 
								?>
								<!--	THE PORTFOLIO FILTER	-->
								<ul class="leftfloat" <?php echo $display; ?>>
									<li><a class="portfolio_selector " data-group="all-group" href="#"><?php echo $averis_sort_all; ?></a><span class="portfolio_category_divider"></span></li>
									<?php 
										foreach ($tax_terms as $tax_term) {
											echo '<li><a class="portfolio_selector " data-group="'.$tax_term->slug.'" href="#">'.$tax_term->name.'</a><span class="portfolio_category_divider"></span></li>';
										}
									?>
								</ul>
								<?php if($aversis_portfolio_sorting!="off"){?>
								<!--	THE PORTFOLIO SORTER	-->
								<?php if($averis_activate_sidebar=="on") echo "<div class=clear></div>" ?>
								<div class="portfolio_sort_wrap" <?php if($averis_activate_sidebar=="on") echo "style='float:left;'"; ?>>
									<span class="leftfloat"><strong><?php echo $averis_sort_by; ?></strong></span>
									<!-- SORTING -->
									<form id="sortoption" class="portfolio_sotrer_form" action="#" method="post">
										<div class="portfolio_sorter_fake"></div>
										<select>								
											<option selected="selected" value="null" style="display:none"><?php echo $averis_sort_select_option;?></option>
											<option value="date"><?php echo $averis_sort_date_added;?></option>											
											<option value="title"><?php echo $averis_sort_entry_title;?></option>																						
										</select>
									</form>
									<!-- ORDERING -->
									<form id="sortdir" class="portfolio_sotrer_form" action="#" method="post">
										<div class="portfolio_sorter_fake"></div>
										<select>																						
											<option selected="selected" value="null" style="display:none"><?php echo $averis_sort_select_direction;?></option>
											<option value="asc"><?php echo $averis_sort_ascending;?></option>				
											<option value="des"><?php echo $averis_sort_descending;?></option>											
										</select>
									</form>
								</div>
								<div class="clear"></div>
								<?php } ?>
								<div class="clear"></div>
							</div>	
							<div class="divide50"></div>
							
							
							<div class="<?php echo $post_column_full; ?> columns alpha" id="portfolio_details_mask">
									<!--	PORTFOLIO DETAILS -->
									<div class="<?php echo $post_column_full; ?> columns" id="portfolio_details">
										
										<!-- LEFT HOLDER IMG / VIDEO ETC -->
										<div class="<?php echo $post_column_image; ?> columns alpha tochange  listfade-img">
											<div class="portfolio_detail_imgholder <?php echo $scalevid;?>"><img src="<?php echo $template_uri; ?>/images/logo.png"></div>
										</div>
										
										<!-- RIGHT HOLDER TEXT, TOPLINE, SUBLINE, HTML AND MORE -->
										<div class="<?php echo $post_column_content; ?> columns omega">
											<div class="portfolio_detail_info_holder tochange">
												<div class="topline"></div>
												<div class="subline"></div>
												<div id="detail_innerhtml"></div>										
											</div>
											<div class="portfolio_navigation">
												<div class="portfolio_close"></div>
												<div class="portfolio_left"></div>
												<div class="portfolio_right"></div>
												<div class="clear"></div>
											</div>
										</div>
										<div class="clear"></div>										
										<div class="pagedivider"></div>											
									</div>
							</div>
							
							
							<!--	THE PORTFOLIO ENTRIES	-->
							<div class="<?php echo $post_column_full; ?> columns portfolio">										
									<ul>
									<?php 
										// Query for Portfolio
											$paged =
												( get_query_var('paged') && get_query_var('paged') > 1 )
												? get_query_var('paged')
												: 1;			
											$args=array(
						    					'post_type' => $ptype,
						    					'posts_per_page' => 9999,
						    					'paged' => $paged
							    			);
							    			
							    			$temp = $wp_query; 
							    			$wp_query = null;
							    			$wp_query = new WP_Query();
							    			$wp_query->query($args);

							    			$item_counter=1;

							    		?>

										<?php if(have_posts()) : while(have_posts()) : the_post();
												if($item_counter>0 && $item_counter % $rownumber == 0)
													$rowend = " omega";
												else{
													$rowend = " ";	
													if(($item_counter-1) % $rownumber == 0){
														$rowend = " alpha";
													}
												}
												$post_time_day = get_post_time('j', true);
												$post_time_month = get_post_time('M', true);
												$post_time_daymonthyear = date_i18n(get_option('date_format'), strtotime($post->post_date_gmt));
												$post_time_sort = get_post_time('d.m.Y', true);
												$posttags = get_the_tags();
								        		$postcustoms = getOptions($post->ID);

								        		$perma = get_permalink();

								        		if(strpos($perma, "?")){
				    								$divider="&";
				    							}
				    							else {
				    								$divider="?";
				    							}

				    							$permalink=$perma.$divider."tp=".$post_id;


								        		$item_counter++;

								        		if($averis_cut!="off"){
													$blogimageurl_cut = aq_resize(wp_get_attachment_url( get_post_thumbnail_id($post->ID)),$post_top_width,$averis_height*2,true);
												}
												else{	
													$blogimageurl_cut = aq_resize(wp_get_attachment_url( get_post_thumbnail_id($post->ID)),$post_top_width);
												}
													
												$blogimageurl="";
												$blogimageurl = aq_resize(wp_get_attachment_url( get_post_thumbnail_id($post->ID)),$post_top_width);
																		

								        		$entrycategory = "";
												$entrycategory = get_the_term_list( '', $pcat, '', ', ', '' );

												$categories = get_the_terms($post->ID,$pcat);
					    						$categorylist="";
					    						
					    						if(is_array($categories)){
						    						foreach ($categories as $category) {
						    							$categorylist.=" ".$category->slug; 
						    						}
					    						}

					    						if(isset($postcustoms["averis_post_type"]))
													switch ($postcustoms["averis_post_type"]) {
														case 'image': 
															if($blogimageurl!=""){
																$post_top = '<div class="hovering"><img class="blog_image" src="'.$blogimageurl_cut.'"><div class="hovering_link"><a href="'.$permalink.'"><div class="plink"></div></a></div><!--div class="hovering_more notalone"><a href="http://www.themepunch.com/aversis/wp-content/uploads/2012/05/company21.png" rel="prettyPhoto[folio]" title="ENTRY DESCRIPTION TEXT GOES HERE" ><div class="pmore"></div></a></div--></div>';
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
																$post_top = '<iframe src="http://www.youtube.com/embed/'.$postcustoms["averis_youtube_id"].'?hd=1&amp;wmode=opaque&amp;autohide=1&amp;showinfo=0" width="'.$video_width.'" height="'.$video_height.'" style="margin-bottom: -6px;" frameborder="0"></iframe>';

															}
															elseif ($postcustoms["averis_video_type"]=="vimeo") {
																$scalevid = "scalevid";
																$post_top = '<iframe src="http://player.vimeo.com/video/'.$postcustoms["averis_vimeo_id"].'?title=0&amp;byline=0&amp;portrait=0&amp;color='.str_replace("#", "", get_option_tree("aversis_main_color")).'" width="'.$video_width.'" height="'.$video_height.'" style="margin-bottom: -6px;" frameborder="0"></iframe>';
															}
															elseif ($postcustoms["averis_video_type"]=="flv") {
																$blogimageurl="";
																$scalevid = "";
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

										?>
										<!--	PORTFOLIO ENTRY	-->
										<li class="four columns all-group <?php echo $categorylist.$rowend; ?>" data-date="<?php echo $post_time_sort;?>" data-title="<?php the_title(); ?>"
																					 data-html='<?php if(isset($post_top)) echo $post_top;?>'																		
																					 data-detail_subline='<?php if ($averis_blog_postinfo_active!="off"){ ?>
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
																								<?php if ( comments_open() ) : ?><?php comments_popup_link($averis_nocomments, $averis_onecomment, '% '.$averis_comments); ?><?php endif; ?><span class="blog_subinfos_divider"></span>
																							</div>
																							<?php } ?>
																						<?php } ?>' 
																					 data-detail_innerhtml='<p><?php echo excerpt($excerpt_length);?></p><a href="<?php echo $permalink; ?>" class="more"><?php echo $averis_readmore; ?> &raquo;</a>'>
											 
											
												<div class="portfolio_imgholder">
														<img src="<?php echo $blogimageurl_cut; ?>" alt="" class="scale-with-grid portfolio_image" />														
														<div class="portfolio_link notalone"><a href="<?php echo $permalink;?>"><div class="plink"></div></a></div>
														<div class="portfolio_more notalone"><a href="#"><div class="pmore"></div></a></div>
														
												</div>
												<div class="topline"><?php the_title(); ?></div>
												<div class="subline">in <?php echo $entrycategory; ?></div>												
											
										</li>	
									<?php endwhile; endif; //have_posts ?>
									</ul>
							</div>
					</div>
					<?php if($averis_activate_sidebar!="off") {?>
						<div class="four columns sidebar <?php echo $sidebar_class;?>">
									 <div class="clear"></div>
										<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar) ) : ?>
											
						                       
						                        <div style="margin-bottom:20px"><span class="widget_title">Sidebar Widget  </span></div>
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
					<div class="clear"></div>
					
					<script> 
						//////////////////////////////////////////
						//	-	CALL THE PORTFOLIO PLUGIN	-	//
						//////////////////////////////////////////
						jQuery('body').tpportfolio({
							speed:500,
							row:<?php echo $rownumber;?>,
							nonSelectedAlpha:0,
							portfolioContainer:'.portfolio'
							});
					</script>
<?php get_footer(); ?>