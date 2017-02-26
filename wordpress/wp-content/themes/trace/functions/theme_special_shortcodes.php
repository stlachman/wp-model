<?php

/* ------------------------------------- */
/* SHORTCODES */
/* ------------------------------------- */

// Language Options
		$done_readmore = __('READ MORE &raquo;', 'averis');
		$done_in = __('in', 'averis');

// LATEST POSTS
	function latest_posts_build( $atts ) {
		extract(shortcode_atts(array(
			'title' => '',
			'type' => '',
			'order' => '',
			'number' => '',
			'rownumber' => '',
			'category' => '',
			'date' => '',
			'cat' => '',
			'excerpt_words'=> ''
		), $atts));

		global $done_readmore;
		global $done_in;

		$ptype = 'post';
		$style = "";

		switch ($rownumber) {
			case '2':
				$rownumber = "two_per_page";
				break;
			case '3':
				$rownumber = "three_per_page";
				break;
			case '4':
				$rownumber = "four_per_page";
				break;
			default:
				$rownumber = "four_per_page";
				break;
		}

		$category = get_category_by_slug($ptype);
		if($category) $catid = $category->term_id;
		else $catid="";

		if($order=='latest'){
			$popargs = array( 'numberposts' => $number, 'orderby' => 'post_date', 'cat' => $catid );
		}else{
			$popargs = array( 'numberposts' => $number, 'orderby' => 'comment_count', 'cat' => $catid );
		}
		$unique = uniqid();
		$poplist = get_posts( $popargs );
		$element_count=1;
		$return_list = '<div class="tp_teaser '.$rownumber.'">
							<div class="titledivider">'.$title.'</div>

							<div class="tp_teaser_navigation rightfloat">
								<div class="tp_teaser_left notinuse"></div>
								<div class="tp_teaser_right"></div>
								<div class="clear"></div>
							</div><div class="tp_teaser_rotator"><div class="clear"></div>
								<div class="divide20"></div>								
								<ul><div class="clear"></div>';
		foreach ($poplist as $poppost) :  
				setup_postdata($poppost);
           	    $category = get_the_category($poppost->ID);
           	    if(isset($category[0]))
					$first_category = $category[0]->cat_name;
				else
					$first_category = "uncatagorized";
				$repl = strtolower((preg_replace('/\s+/', '-', $first_category)));
				$base = home_url();

				$entrycategory = "";
				foreach((get_the_category($poppost->ID)) as $dcategory) { 
					$entrycategory .= ', <a href="'.get_category_link($dcategory->term_id ).'">'.$dcategory->cat_name.'</a>';
				} 
				$entrycategory = substr($entrycategory, 2);

				if(strlen($poppost->post_title)>18)
					$posttitle = substr($poppost->post_title, 0, 18)."...";
				else
					$posttitle = $poppost->post_title;

                $blogimageurl = wp_get_attachment_url( get_post_thumbnail_id($poppost->ID) ); 
	            if($type=="text"){
	                if ($blogimageurl != "") {
	                	$return_list .= '<li>
										<div class=" tp_teaser_imgholder"><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'"><img src="'.$blogimageurl.'"  alt="'.$poppost->post_title.'"></a></div>
										<div class="tp_teaser_contentholder"><div class="teaser_topline"><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'">'.$poppost->post_title.'</a></div>';
						if($date=="yes" || $cat=="yes"){ 				
								$return_list .=	'<div class="blog_subinfos">';
								$postinfo = "";
								if($date=="yes") $postinfo .= "<span>".date_i18n(get_option('date_format'), strtotime($poppost->post_date_gmt))."</span>§";
								if($cat=="yes") $postinfo .= "in ".$entrycategory."§";

								$return_list .= str_replace("§", '<span class="blog_subinfos_divider">|</span>', substr($postinfo,0,-2));
								$return_list .= "</div>";	
						}
						$return_list .='<p>'.excerpt($excerpt_words).'</p><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'" class="more">'.$done_readmore.'</a></div></li>';
					}
					else{	
						$return_list .= '<li>
										<div class="teaser_topline"><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'">'.$poppost->post_title.'</a></div>';
						if($date=="yes" || $cat=="yes"){ 				
								$return_list .=	'<div class="blog_subinfos">';
								$postinfo = "";
								if($date=="yes") $postinfo .= "<span>".date_i18n(get_option('date_format'), strtotime($poppost->post_date_gmt))."</span>§";
								if($cat=="yes") $postinfo .= "in ".$entrycategory."§";

								$return_list .= str_replace("§", '<span class="blog_subinfos_divider">|</span>', substr($postinfo,0,-2));
								$return_list .= "</div>";	
						}
						$return_list .='<p>'.excerpt($excerpt_words).'</p><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'" class="more">'.$done_readmore.'</a></li>';
					}
					$element_count++;
				}
				elseif ($type=="image") {
					if($blogimageurl != ""){
						$return_list .= '<li>
										<div class="tp_teaser_imgholder"><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'"><img src="'.$blogimageurl.'" alt="'.$poppost->post_title.'"></a></div>
										<div class="portfolio">
											<div class="topline"><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'">'.$poppost->post_title.'</a></div>';
						if($date=="yes" || $cat=="yes"){ 				
								$return_list .=	'<div class="subline">';
								$postinfo = "";
								if($date=="yes") $postinfo .= "<span>".date_i18n(get_option('date_format'), strtotime($poppost->post_date_gmt))."</span>§";
								if($cat=="yes") $postinfo .= "in ".$entrycategory."§";

								$return_list .= str_replace("§", '<span class="blog_subinfos_divider">|</span>', substr($postinfo,0,-2));
								$return_list .= "</div>";	
						}
						$return_list .='</div>
									</li>';
						
						$element_count++;
					}
				}
				
      endforeach;
      $return_list .= '</ul>
							</div>							
						</div>	<!--	END OF TEASER	-->
					<div class="clear"></div>';
      $wp_query = null; 
	  //$wp_query = $temp;
	  wp_reset_query();
      return $return_list;
	}
	add_shortcode('post_teaser', 'latest_posts_build');

// LATEST PROJECTS
	function latest_projects_build( $atts ) {
		extract(shortcode_atts(array(
			'portfolio' => '',
			'title' => '',
			'type' => '',
			'order' => '',
			'number' => '',
			'rownumber' => '',
			'cat' => '',
			'excerpt_words'=> '20'
		), $atts));

		global $done_readmore;
		global $done_in;
		

		switch ($rownumber) {
			case '2':
				$rownumber = "two_per_page";
				break;
			case '3':
				$rownumber = "three_per_page";
				break;
			case '4':
				$rownumber = "four_per_page";
				break;
			default:
				$rownumber = "four_per_page";
				break;
		}

		$pcat = "category_".$portfolio;
		$args=array(
			'post_type' => $portfolio,
			'posts_per_page' => $number
		);
		global $wp_query;
		$temp = $wp_query; 
		$wp_query = null;
		$wp_query = new WP_Query();
		$wp_query->query($args);
		$terms = get_terms($pcat);

		$unique = uniqid();
		$poplist = get_posts( $args );
		$element_count=1;
		$return_list = '<div class="tp_teaser '.$rownumber.'">
							<div class="titledivider">'.$title.'</div>

							<div class="tp_teaser_navigation rightfloat">
								<div class="tp_teaser_left notinuse"></div>
								<div class="tp_teaser_right"></div>
								<div class="clear"></div>
							</div><div class="tp_teaser_rotator">
								<div class="divide20"></div>								
								<ul>';
		foreach ($poplist as $poppost) :  
				setup_postdata($poppost);
           	    $category = get_the_category($poppost->ID);
           	    if(isset($category[0]))
					$first_category = $category[0]->cat_name;
				else
					$first_category = "uncatagorized";
				$repl = strtolower((preg_replace('/\s+/', '-', $first_category)));
				$base = home_url();

				if(strlen($poppost->post_title)>18)
					$posttitle = substr($poppost->post_title, 0, 18)."...";
				else
					$posttitle = $poppost->post_title;

                $blogimageurl = wp_get_attachment_url( get_post_thumbnail_id($poppost->ID) ); 
	            if($type=="text"){
	                if ($blogimageurl != "") {
	                	$return_list .= '<li>
										<div class="tp_teaser_imgholder hovering"><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'"><img  alt="'.$poppost->post_title.'" src="'.$blogimageurl.'"></a><div class="hovering_link notalone"><a href="#"><div class="plink"></div></a></div><div class="hovering_more notalone"><a href="#"><div class="pmore"></div></a></div></div>
										<div class="teaser_topline"><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'">'.$poppost->post_title.'</a></div>';
										if($cat=="yes"){
											$tax_cats = "";
											foreach ($terms as $tax_term) {
												$tax_cats.= ', <a href="'.esc_attr(get_term_link($tax_term, $pcat)).'">'.$tax_term->name.'</a>';
											}
											$return_list .='<div class="blog_subinfos">'.$done_in.' '.substr($tax_cats, 2).'	</div>';
										}
										$return_list .= '<p>'.excerpt($excerpt_words).'</p><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'" class="more">'.$done_readmore.'</a></li>';
					}
					else{	
						$return_list .= '<li>
										<div class="teaser_topline"><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'">'.$poppost->post_title.'</a></div>';
										if($cat=="yes"){
											$tax_cats = "";
											foreach ($terms as $tax_term) {
												$tax_cats.= ', <a href="'.esc_attr(get_term_link($tax_term, $pcat)).'">'.$tax_term->name.'</a>';
											}
											$return_list .='<div class="blog_subinfos">'.$done_in.' '.substr($tax_cats, 2).'	</div>';
										}	
						$return_list .= '<p>'.excerpt($excerpt_words).'</p><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'" class="more">'.$done_readmore.'</a></li>';
					}
					$element_count++;
				}
				elseif ($type=="image") {
					if($blogimageurl != ""){
						$return_list .= '<li>
										<div class="tp_teaser_imgholder"><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'"><img src="'.$blogimageurl.'"  alt="'.$poppost->post_title.'"></a><div class="hovering_link notalone"><a href="#"><div class="plink"></div></a></div><div class="hovering_more notalone"><a href="#"><div class="pmore"></div></a></div></div>
										<div class="portfolio">
											<div class="topline"><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'">'.$poppost->post_title.'</a></div>';
						if($cat=="yes"){
							$tax_cats = "";
						
							foreach ($terms as $tax_term) {
								$tax_cats.= ', <a href="'.esc_attr(get_term_link($tax_term, $pcat)).'">'.$tax_term->name.'</a>';
							}
							$return_list .='<div class="subline">'.$done_in.' '.substr($tax_cats, 2).'	</div>';
						}	
						$return_list .= '			</div>
								</li>';

						$element_count++;
					}
				}
				
      endforeach;
      $return_list .= '</ul>
							</div>							
						</div>	<!--	END OF TEASER	-->
					<div class="clear"></div>';
      $wp_query = null; 
	  $wp_query = $temp;
	  wp_reset_query();
      return $return_list;
	}
	add_shortcode('projects_teaser', 'latest_projects_build');

// SLIDER
	function slider_build( $atts ) {
		extract(shortcode_atts(array(
			'name' => ''
		), $atts));
		global $banner_font;
		if($name=="") die;
		$banner_array = get_option("done_sliders_slugs");
		$banner_counter=0;
	    if(is_array($banner_array)){
	    	foreach ($banner_array as $banner) {
	    		if($banner==$name){
	    			break;
	    		}
	    		$banner_counter++;
	    	}
	    	$banner_slug_array = get_option("done_sliders");
	    	$banner_id = $name;
	    	// Banner HTML
	    		$banner_html = html_entity_decode(stripslashes(get_option($banner_id."banner_list",ENT_QUOTES)));
		    // Banner Options	
				// Basic Slider
					$banner_width = get_option($banner_id."banner_width");
					$banner_height = get_option($banner_id."banner_height");
					$slide_timer = get_option($banner_id."slide_timer");
					$banner_font = get_option($banner_id."banner_font");
				// Bullets/Thumbs
					$slide_thumb_visible = get_option($banner_id."slide_thumb_visible");
					$slide_thumb_type = get_option($banner_id."slide_thumb_type");
					$slide_thumb_width = get_option($banner_id."slide_thumb_width");
					$slide_thumb_height = get_option($banner_id."slide_thumb_height");
					$slide_thumb_width = get_option($banner_id."slide_thumb_width");
					if($slide_thumb_width=="") $slide_thumb_width=100;
					$slide_thumb_height = get_option($banner_id."slide_thumb_height");
					if($slide_thumb_height=="") $slide_thumb_height=100;
					
					
			$return_list ='<div class="bannercontainer"><div class="bannerdecor"><div class="banner tp-simpleresponsive">'.$banner_html.'<div class="bannertimer"></div></div></div><div id="bullets"></div></div><script>jQuery(document).ready(function() {jQuery(".banner").simple({delay:'.$slide_timer.',startwidth:'.$banner_width.',startheight:'.$banner_height.',bulletTyp:"'.$slide_thumb_type.'",bulletThumbs:"'.$slide_thumb_visible.'",bulletContainer:"#bullets",bulletThumbsWidth:'.$slide_thumb_width.',bulletThumbsHeight:'.$slide_thumb_height.',hideThumbs:0}); });</script>';

			$return_list = str_replace(array("\r", "\r\n", "\n"), '', $return_list);
			$return_list = str_replace("&#039;", "'", $return_list);
			return $return_list;
		}
	}
	add_shortcode('done_slider', 'slider_build');
	
	function font_enqueue() {
		global $post;
		if (!is_admin()) {
			// Enqueue the Theme Styles
			wp_enqueue_style( 'AVERIS_banner_google_font',$banner_font);
		}
	}
	add_action('font_enqueue', 'enqueue_scripts');

?>