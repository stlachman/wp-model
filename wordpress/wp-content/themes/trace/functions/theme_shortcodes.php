<?php

/* ------------------------------------- */
/* SHORTCODES */
/* ------------------------------------- */

// Language Options
		$averis_readmore = __('READ MORE &raquo;', 'averis');
		$averis_in = __('in', 'averis');

/* COLUMN 1/2 */

$template_uri_shortcodes = get_template_directory_uri();

/* JAS TRACE SHORTCODES */
/* AirCheck */
function aircheck( $atts, $content = null ) {
	   return '<span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span>&trade; '. do_shortcode($content) .'</span>';
	}
	add_shortcode('aircheck', 'aircheck');
	

 //DisplayPDF
 //[DisplayPDF PDF="/path/to/pdf" Description="Description of PDF"]
 
    function Media_func( $atts ) {
	 extract(shortcode_atts(array(
		'media' => '',
		'description' => ''
	), $atts));
	
    $mediaCode = '<p class="marb0"><a href="' . $media . '?iframe=true&amp;width=100%25&amp;height=100%25&amp;start=120" data-rel="prettyPhoto" ' . $description . ' | &lt;a href=' . $media . '&quot; title=&quot;' . $description . '&quot;&gt;Download PDF&lt;/a&gt;">View Fullscreen</a> | <a href="' . $media . '" title="' . $description . '">Download</a></p><div class="marb20"><object class="LetterPDF" data="' . $media . '"><br />alt : <a href="' . $media . '" title="' . $description . '">' . $description . '</a><br /></object><a href="#navholder">Back to Top</a></div>';
	return $mediaCode;
	}
	add_shortcode( 'DisplayMedia', 'Media_func' );


	
	   
	function Display_Doc( $atts ) {
	  extract(shortcode_atts(array(
		   'gdoc_id' => ''
		   ), $atts));
		  return '<div id="googledoc"><iframe class="doc" style="border-style: none;width: 100%; height: 800px;" src="' . $gdoc_id . '"></iframe></div>';
		  }
	  add_shortcode('DisplayDoc', 'Display_Doc');
	
	
function ShowSiblings_func(){
	global $post;
	$current_page_parent = ( $post->post_parent ? $post->post_parent : $post->ID );
	$parent_title = ( get_the_title($current_page_parent) );

	$pages = wp_list_pages( array('title_li' => '','child_of' => $current_page_parent,'depth' => '1', 'echo' => '0', 'exclude' => '184,317,319,322,324') );
	$pageList = '<h2 class="marb0">Other Pages in '.$parent_title.'</h2><ul class="square children">'.$pages.'</ul>';
	return $pageList;
	}
	add_shortcode('ShowSiblings', 'ShowSiblings_func');

function ShowAllSiblings_func($atts){
	extract(shortcode_atts(array(
		'title' => ''
	), $atts));
	global $post;
	$current_page_parent = ( $post->post_parent ? $post->post_parent : $post->ID );

	$pages = wp_list_pages( array('title_li' => '','child_of' => $current_page_parent,'depth' => '0', 'echo' => '0', 'exclude' => '184,317,319,322,324') );
	$pageList = '<h2 class="marb0">'.$title.'</h2><ul class="square children">'.$pages.'</ul>';
	return $pageList;
	}
	add_shortcode('ShowAllSiblings', 'ShowAllSiblings_func');

function ShowChildPages_func( $atts ){
	extract(shortcode_atts(array(
		'page' => '',
		'title' => ''
	), $atts));
	if ($page=='' || $page=='PageID') { $page = get_the_ID(); }
	$pages = wp_list_pages( array('title_li' => '','child_of' => $page,'depth' => '1', 'echo' => '0', 'exclude' => '184,317,319,322,324') );
	$pageList = '<h2 class="marb0">'.$title.'</h2><ul class="square children">'.$pages.'</ul>';
	return $pageList;
	}
	add_shortcode('ShowChildPages', 'ShowChildPages_func');

function ShowAllChildPages_func( $atts ){
	extract(shortcode_atts(array(
		'page' => '',
		'title' => ''
	), $atts));
	if ($page=='' || $page=='PageID') { $page = get_the_ID(); }
	$pages = wp_list_pages( array('title_li' => '','child_of' => $page,'depth' => '0', 'echo' => '0', 'exclude' => '184,317,319,322,324') );
	$pageList = '<h2 class="marb0">'.$title.'</h2><ul class="square cLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.hildren">'.$pages.'</ul>';
	return $pageList;
	}
	add_shortcode('ShowAllChildPages', 'ShowAllChildPages_func');
	
  
function NextPage_func(){
	global $post;
	
	$pagelist = get_pages('sort_column=menu_order&amp;sort_order=asc');
	$pages = array();
	foreach ($pagelist as $page) {
		$pages[] += $page->ID;
	}

	//print_r($pages);

	$current = array_search($post->ID, $pages);
	$prevID = $pages[$current-1];
	$nextID = $pages[$current+1];
	
	$NextPage = get_permalink($nextID);
	$NextPageTitle = get_the_title($nextID);
	$NextPageLink = '<div class="center"><a class="blue button center" href='.$NextPage.'><i class="icon-arrow-right"></i> Next: <em>'.$NextPageTitle.'</em></a></div>';

	return $NextPageLink;

	}
	add_shortcode('NextPage', 'NextPage_func'); 

  
    
function IncludeSpec_func($atts) {
	extract(shortcode_atts(array(
		'spec' => ''
	), $atts));
	$airchecklabroot = '/Volumes/WebFiles/sites/airchecklab-new-dev';
	$specTable = file_get_contents($airchecklabroot.'/inc/airspecs-'.$spec.'.php');
	return $specTable;
	}
	add_shortcode('IncludeSpec', 'IncludeSpec_func');

function get_post_page_content( $atts ) {
	extract( shortcode_atts( array(
		'id' => null,
		'title' => false,
	), $atts ) );

	$the_query = new WP_Query( 'page_id='.$id );
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
	        if($title == true){
	        the_title();
	        }
	        the_content();
		}
	wp_reset_postdata();
	}
	add_shortcode( 'my_content', 'get_post_page_content' );

/* COLUMN 1/2 */


function onehalf_colum( $atts, $content = null ) {
	extract(shortcode_atts(array(
			'css' => ''
		), $atts));
		
   return '<div class="one_half" style="'.$css.'">' . do_shortcode($content) . '<div class="clear"></div></div>';
}
add_shortcode('one_half', 'onehalf_colum');

function onehalf_colum_last( $atts, $content = null ) {
	
   return '<div class="one_half lastcolumn">' . do_shortcode($content) . '<div class="clear"></div></div><div class="clear"></div>';
}
add_shortcode('one_half_last', 'onehalf_colum_last');

/* COLUMN 1/3 */

function onethird_colum( $atts, $content = null ) {
	
   return '<div class="one_third">' . do_shortcode($content) . '<div class="clear"></div></div>';
}
add_shortcode('one_third', 'onethird_colum');

function onethird_colum_last( $atts, $content = null ) {
	
   return '<div class="one_third lastcolumn">' . do_shortcode($content) . '<div class="clear"></div></div><div class="clear"></div>';
}
add_shortcode('one_third_last', 'onethird_colum_last');

/* COLUMN 2/3 */

function twothird_colum( $atts, $content = null ) {
	
   return '<div class="two_third">' . do_shortcode($content) . '<div class="clear"></div></div>';
}
add_shortcode('two_third', 'twothird_colum');

function twothird_colum_last( $atts, $content = null ) {
	
   return '<div class="two_third lastcolumn">' . do_shortcode($content) . '<div class="clear"></div></div><div class="clear"></div>';
}
add_shortcode('two_third_last', 'twothird_colum_last');

/* COLUMN 1/4 */

function onefourth_colum( $atts, $content = null ) {
	
   return '<div class="one_fourth">' . do_shortcode($content) . '<div class="clear"></div></div>';
}
add_shortcode('one_fourth', 'onefourth_colum');

function onefourth_colum_last( $atts, $content = null ) {
	
   return '<div class="one_fourth lastcolumn">' . do_shortcode($content) . '<div class="clear"></div></div><div class="clear"></div>';
}
add_shortcode('one_fourth_last', 'onefourth_colum_last');

/* COLUMN 1/5 */

function onefifth_colum( $atts, $content = null ) {
	
   return '<div class="one_fifth">' . do_shortcode($content) . '<div class="clear"></div></div>';
}
add_shortcode('one_fifth', 'onefifth_colum');

function onefifth_colum_last( $atts, $content = null ) {
	
   return '<div class="one_fifth lastcolumn">' . do_shortcode($content) . '<div class="clear"></div></div><div class="clear"></div>';
}
add_shortcode('one_fifth_last', 'onefifth_colum_last');

/* COLUMN 1/6 */

function onesixth_colum( $atts, $content = null ) {
	
   return '<div class="one_sixth">' . do_shortcode($content) . '<div class="clear"></div></div>';
}
add_shortcode('one_sixth', 'onesixth_colum');

function onesixth_colum_last( $atts, $content = null ) {
	
   return '<div class="one_sixth lastcolumn">' . do_shortcode($content) . '<div class="clear"></div></div><div class="clear"></div>';
}
add_shortcode('one_sixth_last', 'onesixth_colum_last');


/* BUTTONS */
function button_fatlink( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'target' => '',
		'link' => ''
	), $atts));
   return '<a href="'.$link.'" target="'.$target.'" class="more">' . do_shortcode($content) . '</a><div class="clear"></div>';
}
add_shortcode('btn_fatlink', 'button_fatlink');

function flvvideo( $atts, $content = null ) {
	global $template_uri_shortcodes;
	extract(shortcode_atts(array(
		'src' => '',
		'width' => '',
		'height' => ''
	), $atts));
	$uniq = uniqid("flv_");
	return'<a class="bordered" href="'.$src.'" style="display:block;width:'.$width.'px;height:'.$height.'px"   id="'.$uniq.'"> </a><script>flowplayer("'.$uniq.'", "'.$template_uri_shortcodes.'/js/flowplayer_plugins/flowplayer-3.2.7.swf", {clip: {autoPlay:false, autoBuffering: true}});</script>';
}
add_shortcode('video_flv', 'flvvideo');

/* YOUTUBE VIDEO */

function vid_youtube( $atts ) {
	extract(shortcode_atts(array(
		'video_id' => '',
		'height' => '',
		'width' => '',
		'noyoutube' => '',
		'title' => ''
	), $atts));
	$youtube = '<div class="rounded bordered scalevid"><iframe src="https://www.youtube.com/embed/'.$video_id.'?hd=1&amp;wmode=opaque&amp;controls=1&amp;showinfo=0&amp;autohide=1&amp;rel=0" width="'.$width.'" height="'.$height.'"></iframe></div>';
	if ($noyoutube!=='') { $streaming = '<p class="streamingLink center"><em>Youtube blocked? <a data-rel="prettyPhoto[folio]" class="zoom" title="'.$title.'" href="'.$noyoutube.'?width=640&amp;height=360">Click here to watch</a></em></p>';} else { $streaming = ''; }
	return $youtube.$streaming;
}
add_shortcode('video_youtube', 'vid_youtube');

/* VIMEO VIDEO */

function vid_vimeo( $atts ) {
	extract(shortcode_atts(array(
		'video_id' => '',
		'height' => '',
		'width' => ''
	), $atts));
   return '<div class="rounded bordered scalevid"><iframe src="//player.vimeo.com/video/'.$video_id.'?title=0&amp;byline=0&amp;portrait=0&amp;autohide=1&amp;color='.str_replace("#", "", get_option_tree("aversis_main_color")).'" width="'.$width.'" height="'.$height.'"></iframe></div>';
}
add_shortcode('video_vimeo', 'vid_vimeo');

/* VIMEO PRIVATE VIDEO */

function private_vid_vimeo( $atts ) {
	extract(shortcode_atts(array(
		'video_id' => ''
	), $atts));
/* 	return '<!-- <h1 class="marb0">'.$title.'</h1><h2 class="marb0">by '.$author_name.'</h2> --><div class="rounded shadow mart10 blueborder">'.$html.'</div>'; */
	return '<div class="rounded bordered scalevid"><iframe src="//player.vimeo.com/video/'.$video_id.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen ></iframe></div>';
}
add_shortcode('private_video_vimeo', 'private_vid_vimeo');




// HEADLINES
	function headline1( $atts, $content = null ) {
	   return '<h1>' . do_shortcode($content) . '</h1>';
	}
	add_shortcode('h1', 'headline1');

	function headline2( $atts, $content = null ) {
	   return '<h2>' . do_shortcode($content) . '</h2>';
	}
	add_shortcode('h2', 'headline2');

	function headline3( $atts, $content = null ) {
	   return '<h3>' . do_shortcode($content) . '</h3>';
	}
	add_shortcode('h3', 'headline3');

	function headline4( $atts, $content = null ) {
	   return '<h4>' . do_shortcode($content) . '</h4>';
	}
	add_shortcode('h4', 'headline4');

	function headline5( $atts, $content = null ) {
	   return '<h5>' . do_shortcode($content) . '</h5>';
	}
	add_shortcode('h5', 'headline5');

	function headline6( $atts, $content = null ) {
	   return '<h6>' . do_shortcode($content) . '</h6>';
	}
	add_shortcode('h6', 'headline6');

	function blockquote_build( $atts, $content = null ) {
	   extract(shortcode_atts(array(
			'author' => '',
			'align' => ''
		), $atts));
	   if ($author=="")
	   	return '<blockquote class="'.$align.'">' . do_shortcode($content) . '</blockquote>';
	   else 
	   	return '<blockquote class="'.$align.'">' . do_shortcode($content) . '<br><span class="signature nspace0">'.$author.'</span></blockquote>';
	}
	add_shortcode('blockquote', 'blockquote_build');

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

		global $averis_readmore;
		global $averis_in;

		$ptype = 'post';
		$style = "";
		if ($type=="") $type="text";
		if($order="") $order = "latest";

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

		$category = get_category_by_slug($category);
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
										<div class="tp_teaser_imgholder hovering"><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'"><img src="'.$blogimageurl.'"  alt="'.$poppost->post_title.'"><div class="hovering_link"><a href="'.$href.'"><div class="plink"></div></a></div><!--div class="hovering_more notalone"><a href="#"><div class="pmore"></div></a></div--></div>
										<div class="tp_teaser_contentholder"><div class="teaser_topline"><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'">'.$poppost->post_title.'</a></div>';
						if($date=="yes" || $cat=="yes"){ 				
								$return_list .=	'<div class="blog_subinfos">';
								$postinfo = "";
								if($date=="yes") $postinfo .= "<span>".date_i18n(get_option('date_format'), strtotime($poppost->post_date_gmt))."</span>§";
								if($cat=="yes") $postinfo .= "in ".$entrycategory."§";

								$return_list .= str_replace("§", '<span class="blog_subinfos_divider">|</span>', substr($postinfo,0,-2));
								$return_list .= "</div>";	
						}
						$return_list .='<p>'.excerpt($excerpt_words).'</p><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'" class="more">'.$averis_readmore.'</a></div></li>';
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
						$return_list .='<p>'.excerpt($excerpt_words).'</p><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'" class="more">'.$averis_readmore.'</a></li>';
					}
					$element_count++;
				}
				elseif ($type=="image") {
					if($blogimageurl != ""){
						$return_list .= '<li>
										<div class="tp_teaser_imgholder hovering"><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'"><img src="'.$blogimageurl.'"  alt="'.$poppost->post_title.'"><div class="hovering_link"><a href="'.$href.'"><div class="plink"></div></a></div><!--div class="hovering_more notalone"><a href="#"><div class="pmore"></div></a></div--></div>
										<div class="tp_teaser_contentholder"><div class="teaser_topline" style="text-align: center;"><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'">'.$poppost->post_title.'</a></div></li>';
						
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
			'type' => 'text',
			'order' => '',
			'number' => '',
			'rownumber' => '',
			'cat' => '',
			'excerpt_words'=> '20'
		), $atts));

		global $averis_readmore;
		global $averis_in;
		

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
										<div class="tp_teaser_imgholder hovering"><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'"><img src="'.$blogimageurl.'"  alt="'.$poppost->post_title.'"></a><div class="hovering_link "><a href="#"><div class="plink"></div></a></div></div>
										<div class="teaser_topline"><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'">'.$poppost->post_title.'</a></div>';
										if($cat=="yes"){
											$tax_cats = "";
											foreach ($terms as $tax_term) {
												$tax_cats.= ', <a href="'.esc_attr(get_term_link($tax_term, $pcat)).'">'.$tax_term->name.'</a>';
											}
											$return_list .='<div class="blog_subinfos">'.$averis_in.' '.substr($tax_cats, 2).'	</div>';
										}
										$return_list .= '<p>'.excerpt($excerpt_words).'</p><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'" class="more">'.$averis_readmore.'</a></li>';
					}
					else{	
						$return_list .= '<li>
										<div class="teaser_topline"><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'">'.$poppost->post_title.'</a></div>';
										if($cat=="yes"){
											$tax_cats = "";
											foreach ($terms as $tax_term) {
												$tax_cats.= ', <a href="'.esc_attr(get_term_link($tax_term, $pcat)).'">'.$tax_term->name.'</a>';
											}
											$return_list .='<div class="blog_subinfos">'.$averis_in.' '.substr($tax_cats, 2).'	</div>';
										}	
						$return_list .= '<p>'.excerpt($excerpt_words).'</p><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'" class="more">'.$averis_readmore.'</a></li>';
					}
					$element_count++;
				}
				elseif ($type=="image") {
					if($blogimageurl != ""){
						$return_list .= '<li>
										<div class="tp_teaser_imgholder hovering"><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'"><img src="'.$blogimageurl.'"  alt="'.$poppost->post_title.'"></a><div class="hovering_link "><a href="#"><div class="plink"></div></a></div></div>
										<div class="teaser_topline" style="text-align: center;"><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'">'.$poppost->post_title.'</a></div></li>';

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

// TEASER CUSTOM
	function teaser_list_build($atts,$content = null){
		extract(shortcode_atts(array(
			'rownumber' => '',
			'title' => ''
		), $atts));

		$uniq = uniqid("teaser_");
		$elements = $rownumber;

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
		return '<div class="tp_teaser '.$rownumber.'"><div class="divide50"></div><div class="titledivider">'.$title.'</div><div class="tp_teaser_navigation rightfloat"><div class="tp_teaser_left notinuse"></div><div class="tp_teaser_right"></div><div class="clear"></div></div><div class="tp_teaser_rotator"><div class="divide20"></div><ul id="'.$uniq.'" class="teaser_ul" data-elements="'.$elements.'">'.do_shortcode($content).'</ul></div></div><div class="clear"></div>';
	}
	add_shortcode('teaser_list','teaser_list_build');

	function teaser_item_build($atts,$content = null){
		extract(shortcode_atts(array(
			'href' => '',
			'title' => '',
			'image' => ''
		), $atts));
		$return_list = '<li><div class="tp_teaser_imgholder hovering"><img src="'.$image.'"  alt="'.$title.'"><div class="hovering_link"><a href="'.$href.'"><div class="plink"></div></a></div><!--div class="hovering_more notalone"><a href="#"><div class="pmore"></div></a></div--></div><div class="teaser_topline teaser_without_subinfos"><a href="'.$href.'">'.$title.'</a></div><p>'.do_shortcode($content).'</p></li>';
		

		$return_list = str_replace(array("\r", "\r\n", "\n"), '', $return_list);
		return $return_list;
	}
	add_shortcode('teaser_item','teaser_item_build');
	
// SLIDER
	function slider_build( $atts ) {
		extract(shortcode_atts(array(
			'name' => ''
		), $atts));
		if($name=="") die;
		$banner_array = get_option("averis_sliders_slugs");
		$banner_counter=0;
		global $banner_font;
	    if(is_array($banner_array)){
	    	foreach ($banner_array as $banner) {
	    		if($banner==$name){
	    			break;
	    		}
	    		$banner_counter++;
	    	}
	    	$banner_slug_array = get_option("averis_sliders");
	    	$banner_id = $name;
	    	// Banner HTML
	    		$banner_html = html_entity_decode(stripslashes(get_option($banner_id."banner_list",ENT_QUOTES)));
		    // Banner Options	
				// Basic Slider
					$banner_width = get_option($banner_id."banner_width");
					$banner_height = get_option($banner_id."banner_height");
					$slide_timer = get_option($banner_id."slide_timer");
					$banner_font = get_option($banner_id."banner_font");
					if($banner_font != "") $return_list = '<link rel="stylesheet" id="AVERIS_banner_google_font-css"  href="'.$banner_font.'" type="text/css" media="all" />';
					else $return_list = '';
				// Bullets/Thumbs
					$slide_thumb_visible = get_option($banner_id."slide_thumb_visible");
					$slide_thumb_type = get_option($banner_id."slide_thumb_type");
					$slide_thumb_width = get_option($banner_id."slide_thumb_width");
					$slide_thumb_height = get_option($banner_id."slide_thumb_height");
					$slide_thumb_width = get_option($banner_id."slide_thumb_width");
					if($slide_thumb_width=="") $slide_thumb_width=100;
					$slide_thumb_height = get_option($banner_id."slide_thumb_height");
					if($slide_thumb_height=="") $slide_thumb_height=100;
			$return_list .= '<div class="bannercontainer"><div class="bannerdecor"><div class="banner tp-simpleresponsive" style="height:'.$banner_height.'px;">'.$banner_html.'<div class="bannertimer"></div></div></div><div id="bullets"></div></div><script>jQuery(document).ready(function() {jQuery(".banner").simple({delay:'.$slide_timer.',startwidth:'.$banner_width.',startheight:'.$banner_height.',bulletTyp:"'.$slide_thumb_type.'",bulletThumbs:"'.$slide_thumb_visible.'",bulletContainer:"#bullets",bulletThumbsWidth:'.$slide_thumb_width.',bulletThumbsHeight:'.$slide_thumb_height.',hideThumbs:0}); });</script>';

			$return_list = str_replace(array("\r", "\r\n", "\n"), '', $return_list);
			$return_list = str_replace("&#039;", "'", $return_list);
			return $return_list;
		}
	}
	add_shortcode('averis_slider', 'slider_build');


// QUOTE AREA
	function quote_builder($atts,$content = null){
		extract(shortcode_atts(array(
			'title' => '',
			'button_text' => '',
			'button_icon' => '',
			'button_link' => ''
		), $atts));
		if($button_link=="")$button_link="#";
		$return_list = '		<div class="clear"></div>
					<div class="sixteen columns">
						<div class="divide30"></div>
						<div class="quoteholder">
							<div class="sixteen columns">';
		if($button_text != "" || $button_icon != "")						
			$return_list .= '	<div class="twelve columns alpha bigdivider">';
		else
			$return_list .= '	<div class="bigdivider">';
			$return_list .= '	<h3 class="maincolor">'.$title.'</h3>
									<p>'.do_shortcode($content).'
								</div>';
		if($button_text != "" || $button_icon != "")	

			if ($button_icon != ""){
					$button_begin = '<span style="background-image:url('.$button_icon.');">';
					$button_end = "</span>";
			}
			else{
				$button_begin = "";
				$button_end = "";
			}						
			$return_list .= '	<div class="four columns omega">
									<div class="divide25"></div>
									<div class="rightfloat_leftfloat"><a href="'.$button_link.'" class="blue purchase">'.$button_begin.$button_text.$button_end.'</a></div>
								</div>';

			$return_list .='<div class="clear"></div></div><div class="clear"></div></div></div>';
		return $return_list;
	}
	add_shortcode('quote_area','quote_builder');

// Spacer
	function spacer_build( $atts ) {
	extract(shortcode_atts(array(
		'height' => ''
	), $atts));
   return '<div style="display:block;clear:both;height:'.$height.'"></div>';
}
add_shortcode('spacer', 'spacer_build');

// buttons
	function button_build( $atts ) {
	extract(shortcode_atts(array(
		'size' => '',
		'text' => '',
		'link' => '',
		'color' => '',
		'icon' => ''
	), $atts));

	$template_uri = get_template_directory_uri();

	$button = '<a href="'.$link.'" class="button '.$color.' r20 '.$size.'">'.$text.'</a>';
	if ($size=="big" && $icon!="") {
		$button = '<a href="'.$link.'" class="'.$color.' r20 purchase"><span style="background:url('.$icon.') no-repeat;padding-left:35px;">'.$text.'</span></a><div class="clear"></div>';
	}
   	return $button;
}
add_shortcode('button', 'button_build');

/* ------------------------------------- */
/* SHORTCODE EDITOR DROPDOWN LIST */
/* ------------------------------------- */

function add_sc_select(){
	echo '&nbsp;<select id="sc_select"><option value="0">Select Shortcode from List</option>';
	$shortcodes_list = "";
	
	// LAYOUTS
		$shortcodes_list .= "<option value='[aircheck]Lab[/aircheck]'>AirCheck</option>";
		$shortcodes_list .= "<option value='[DisplayMedia media=\"http://training.airchecklab.com/wp-content/uploads/2016/08/Get-Started-with-Dropbox.pdf\" Description=\"Description of Media\"]<!-- PDF or other type of media file MUST be uploaded to WordPress. Then copy the URL and place it within the quotes after the media variable as illustrated in the example above.\"-->'>Display Media</option>";
		$shortcodes_list .= "<option value='[DisplayDoc gdoc_id=\"url-of-published-doc\"]<!-- Replace url-of-published-doc with a URL such as -> https://docs.google.com/document/d/1sRp-xSe4EQw-GRoj2fSh9PZo3reRviyS7uxdy_-5ZTY/pub?embedded=true -->'>Display Doc</option>";
		$shortcodes_list .= "<option value='[NextPage]'>Next Page</option>";
		$shortcodes_list .= "<option value='[ShowSiblings]'>Show Siblings</option>";
		$shortcodes_list .= "<option value='[ShowAllSiblings Title=\"Title of List\"]'>Show All Siblings</option>";
		$shortcodes_list .= "<option value='[ShowChildPages Page=\"PageID\" Title=\"Title of List\"]<!-- Enter PageID. If blank, shows children of current page -->'>Show Child Pages</option>";
		$shortcodes_list .= "<option value='[ShowAllChildPages Page=\"PageID\" Title=\"Title of List\"]<!-- Enter PageID. If blank, shows children of current page -->'>Show All Child Pages</option>";
		$shortcodes_list .= "<option value='[IncludeSpec Spec=\"SpecName\"]<!-- Enter spec php pagename. (BCAS, etc) -->'>Include Spec</option>";
		$shortcodes_list .= "<option value='[my_content id=\"Enter your page id number\" title=\"Set this to true if you want to show title\" /]'>Insert Another Page Content</option>";
		$shortcodes_list .= "<option value='0' style='font-weight:bold;'>---- Layouts ----</option>";
		/* 1/2 Text */
		$shortcodes_list .= "<option value='[one_half]...Your text here...[/one_half][one_half_last]...Your text here...[/one_half_last]'>1/2 Text Column Layout</option>";
		/* 1/3 Text */
		$shortcodes_list .= "<option value='[one_third]...Your text here...[/one_third][one_third]...Your text here...[/one_third][one_third_last]...Your text here...[/one_third_last]'>1/3 Text Column Layout</option>";
		/* 1/3 2/3 Text */
		$shortcodes_list .= "<option value='[one_third]...Your text here...[/one_third][two_third_last]...Your text here...[/two_third_last]'>1/3 , 2/3 Text Column Layout</option>";
		
		/* 1/4 Text */
		$shortcodes_list .= "<option value='[one_fourth]...Your text here...[/one_fourth][one_fourth]...Your text here...[/one_fourth][one_fourth]...Your text here...[/one_fourth][one_fourth_last]...Your text here...[/one_fourth_last]'>1/4 Text Column Layout</option>";
		/* 1/5 Text */
		$shortcodes_list .= "<option value='[one_fifth]...Your text here...[/one_fifth][one_fifth]...Your text here...[/one_fifth][one_fifth]...Your text here...[/one_fifth][one_fifth]...Your text here...[/one_fifth][one_fifth_last]...Your text here...[/one_fifth_last]'>1/5 Text Column Layout</option>";
		/* 1/6 Text*/
		$shortcodes_list .= "<option value='[one_sixth]...Your text here...[/one_sixth][one_sixth]...Your text here...[/one_sixth][one_sixth]...Your text here...[/one_sixth][one_sixth]...Your text here...[/one_sixth][one_sixth]...Your text here...[/one_sixth][one_sixth_last]...Your text here...[/one_sixth_last]'>1/6 Text Column Layout</option>";
		
	// HEADLINES
		$shortcodes_list .= "<option value='0' style='font-weight:bold;'>---- Headlines ----</option>";
		/* H1 */
		$shortcodes_list .= "<option value='[h1]...Your text here...[/h1]'>Headline H1</option>";
		/* H2 */
		$shortcodes_list .= "<option value='[h2]...Your text here...[/h2]'>Headline H2</option>";
		/* H3 */
		$shortcodes_list .= "<option value='[h3]...Your text here...[/h3]'>Headline H3</option>";
		/* H4 */
		$shortcodes_list .= "<option value='[h4]...Your text here...[/h4]'>Headline H4</option>";
		/* H5 */
		$shortcodes_list .= "<option value='[h5]...Your text here...[/h5]'>Headline H5</option>";
		/* H6 */
		$shortcodes_list .= "<option value='[h6]...Your text here...[/h6]'>Headline H6</option>";

	// SPACES
		$shortcodes_list .= "<option value='0' style='font-weight:bold;'>---- Spaces ----</option>";
		$shortcodes_list .= "<option value='<div class=\"divide5\"></div><div class=\"clear\"></div>'>Space 5px</option>";
		$shortcodes_list .= "<option value='<div class=\"divide10\"></div><div class=\"clear\"></div>'>Space 10px</option>";
		$shortcodes_list .= "<option value='<div class=\"divide15\"></div><div class=\"clear\"></div>'>Space 15px</option>";
		$shortcodes_list .= "<option value='<div class=\"divide20\"></div><div class=\"clear\"></div>'>Space 20px</option>";
		$shortcodes_list .= "<option value='<div class=\"divide25\"></div><div class=\"clear\"></div>'>Space 25px</option>";
		$shortcodes_list .= "<option value='<div class=\"divide30\"></div><div class=\"clear\"></div>'>Space 30px</option>";
		$shortcodes_list .= "<option value='<div class=\"divide40\"></div><div class=\"clear\"></div>'>Space 40px</option>";
		$shortcodes_list .= "<option value='<div class=\"divide50\"></div><div class=\"clear\"></div>'>Space 50px</option>";
		$shortcodes_list .= "<option value='<div class=\"pagedivider\"></div><div class=\"clear\"></div>'>Page Divider Line</option>";
	// BUTTONS
		$shortcodes_list .= "<option value='0' style='font-weight:bold;'>---- Buttons ----</option>";
		/* Button Normal */
		$shortcodes_list .= "<option value='[button text=\"Your Text\" link=\"The Link\" color=\"red|lightgrey|darkgrey|orange|green|blue\"]'>Button</option>";
		$shortcodes_list .= "<option value='[button size=\"big\" text=\"Your Text\" link=\"The Link\" color=\"red|lightgrey|darkgrey|orange|green|blue\" icon=\"URL to the icon image\"]'>Big Button</option>";
		$shortcodes_list .= "<option value='<a href=\"YOUR LINK HERE\" class=\"more\"><span>YOUR TEXT HERE</span></a>'> Button Fatlink</option>";
	    
	// VIDEOS
		$shortcodes_list .= "<option value='0' style='font-weight:bold;'>---- Videos ----</option>";
		/* Youtube Video */
		$shortcodes_list .= "<option value='[video_youtube video_id=\"Your Video ID goes here\" width=\"460\" height=\"259\" noyoutube=\"\" title=\"\"]'>Youtube Video</option>";
		/* Vimeo Video */
		$shortcodes_list .= "<option value='[video_vimeo video_id=\"Your Video ID goes here\" width=\"460\" height=\"259\"] '>Vimeo Video</option>";
		
		$shortcodes_list .= "<option value='[private_video_vimeo video_id=\"Your Video ID goes here\"] '>Private Vimeo Video</option>";
		/* flv Video */
		//$shortcodes_list .= "<option value='[video_flv src=\"Your Video URL goes here\" width=\"460\" height=\"259\"] '>FLV Video</option>";
	
	// TEASER
		$shortcodes_list .= "<option value='0' style='font-weight:bold;'>---- Teaser ----</option>";
		/* Custom */
		$shortcodes_list .= "<option value='[teaser_list title=\"Headline of the Block\" rownumber=\"2,3 or 4 items visible\"][teaser_item href=\"Link to URL\" title=\"The Teaser Headline\" image=\"Thumb Image\"]...Your Content...[/teaser_item][teaser_item href=\"Link to URL\" title=\"The Teaser Headline\" image=\"Thumb Image\"]...Your Content...[/teaser_item][/teaser_list]'>Custom Teaser List</option>";
		$shortcodes_list .= "<option value='[post_teaser type=\"text or image\" title=\"THE TITLE\" number=8 rownumber=4 category=\"OPTIONAL CATEGORY\" excerpt_words=15]'>Latest Posts Teaser List</option>";
		$shortcodes_list .= "<option value='[projects_teaser type=\"text or image\" title=\"THE TITLE\" number=8 rownumber=4 portfolio=\"PORTFOLIO SLUG\" excerpt_words=15]'>Latest Portfolio Teaser List</option>";

	// LIGHTBOX
		$shortcodes_list .= "<option value='0' style='font-weight:bold;'>---- Lightboxes ----</option>";
		/* prettyPhoto Image */
		$shortcodes_list .= "<option value='<a href=\"LINK TO LARGE IMAGE GOES HERE\" data-rel=\"prettyPhoto[folio]\" title=\"ENTRY DESCRIPTION TEXT GOES HERE\"><img class=\"scale-with-grid lightbox alignleft\" src=\"LINK TO THUMB IMAGE GOES HERE\" alt=\"\" /></a>'>Lightbox Image with Gallery Style</option>";
		/* prettyPhoto Youtube */
		$shortcodes_list .= "<option value='<a href=\"//www.youtube.com/watch?v=YOUTUBE VIDEO ID GOES HERE&width=720&amp;height=435\" data-rel=\"prettyPhoto[folio]\" title=\"ENTRY DESCRIPTION TEXT GOES HERE\"><img class=\"scale-with-grid alignleft lightbox\" src=\"LINK TO THUMB IMAGE GOES HERE\" alt=\"\" /></a>'>Lightbox Youtube Video with Gallery Style</option>";
		/* prettyPhoto Vimeo */
		$shortcodes_list .= "<option value='<a href=\"//vimeo.com/VIMEO VIDEO ID GOES HERE&width=720&ampheight=405\" data-rel=\"prettyPhoto[folio]\" title=\"ENTRY DESCRIPTION TEXT GOES HERE\"><img class=\"scale-with-grid lightbox alignleft\" src=\"LINK TO THUMB IMAGE GOES HERE\" alt=\"\" /></a>'>Lightbox Vimeo Video with Gallery Style</option>";
	// Price Tables
		$shortcodes_list .= "<option value='0' style='font-weight:bold;'>---- Price Tables ----</option>";
		$shortcodes_list .= "<option value='<div class=\"pricing threecols\">
	<div class=\"pricecol orange\">
		<ul>
			<li class=\"thead\">PRODUCT ONE</li>
			<li class=\"price\">$ 19.99 <span>(per item)</span></li>
			<li class=\"item\">Attribute 1</li>
			<li class=\"item\">Attribute 2</li>
			<li class=\"item\">Attribute 3</li>
			<li class=\"item\">Attribute 4</li>
			<li class=\"buy\" ><a href=\"#\" class=\"orange button\"><span>PURCHASE NOW</span></a></li>
		</ul>
	</div>
	<div class=\"pricecol green highlight\">
		<ul>
			<li class=\"thead\">PRODUCT TWO</li>
			<li class=\"price\">$ 19.99 <span>(per item)</span></li>
			<li class=\"item\">Attribute 1</li>
			<li class=\"item\">Attribute 2</li>
			<li class=\"item\">Attribute 3</li>
			<li class=\"item\">Attribute 4</li>
			<li class=\"buy\" ><a href=\"#\" class=\"green button\"><span>PURCHASE NOW</span></a></li>
		</ul>
	</div>
	<div class=\"pricecol blue\">
		<ul>
			<li class=\"thead\">PRODUCT THREE</li>
			<li class=\"price\">$ 19.99 <span>(per item)</span></li>
			<li class=\"item\">Attribute 1</li>
			<li class=\"item\">Attribute 2</li>
			<li class=\"item\">Attribute 3</li>
			<li class=\"item\">Attribute 4</li>
			<li class=\"buy\" ><a href=\"#\" class=\"blue button\"><span>PURCHASE NOW</span></a></li>
		</ul>
	</div>							
</div><div class=\"clear\"></div>'>3 Column Example</option>";
	$shortcodes_list .= "<option value='<div class=\"pricing fourcols\">
	<div class=\"pricecol orange\">
		<ul>
			<li class=\"thead\">PRODUCT ONE</li>
			<li class=\"price\">$ 19.99 <span>(per item)</span></li>
			<li class=\"item\">Attribute 1</li>
			<li class=\"item\">Attribute 2</li>
			<li class=\"item\">Attribute 3</li>
			<li class=\"item\">Attribute 4</li>
			<li class=\"buy\" ><a href=\"#\" class=\"orange button\"><span>PURCHASE NOW</span></a></li>
		</ul>
	</div>
	<div class=\"pricecol green\">
		<ul>
			<li class=\"thead\">PRODUCT TWO</li>
			<li class=\"price\">$ 19.99 <span>(per item)</span></li>
			<li class=\"item\">Attribute 1</li>
			<li class=\"item\">Attribute 2</li>
			<li class=\"item\">Attribute 3</li>
			<li class=\"item\">Attribute 4</li>
			<li class=\"buy\" ><a href=\"#\" class=\"green button\"><span>PURCHASE NOW</span></a></li>
		</ul>
	</div>
	<div class=\"pricecol blue highlight\">
		<ul>
			<li class=\"thead\">PRODUCT THREE</li>
			<li class=\"price\">$ 19.99 <span>(per item)</span></li>
			<li class=\"item\">Attribute 1</li>
			<li class=\"item\">Attribute 2</li>
			<li class=\"item\">Attribute 3</li>
			<li class=\"item\">Attribute 4</li>
			<li class=\"buy\" ><a href=\"#\" class=\"blue button\"><span>PURCHASE NOW</span></a></li>
		</ul>
	</div>
	<div class=\"pricecol red\">
		<ul>
			<li class=\"thead\">PRODUCT FOUR</li>
			<li class=\"price\">$ 19.99 <span>(per item)</span></li>
			<li class=\"item\">Attribute 1</li>
			<li class=\"item\">Attribute 2</li>
			<li class=\"item\">Attribute 3</li>
			<li class=\"item\">Attribute 4</li>
			<li class=\"buy\" ><a href=\"#\" class=\"red button\"><span>PURCHASE NOW</span></a></li>
		</ul>
	</div>
</div><div class=\"clear\"></div>'>4 Column Example</option>";
	$shortcodes_list .= "<option value='<div class=\"pricing fivecols\">
	<div class=\"pricecol orange\">
		<ul>
			<li class=\"thead\">PRODUCT ONE</li>
			<li class=\"price\">$ 19.99 <span>(per item)</span></li>
			<li class=\"item\">Attribute 1</li>
			<li class=\"item\">Attribute 2</li>
			<li class=\"item\">Attribute 3</li>
			<li class=\"item\">Attribute 4</li>
			<li class=\"buy\" ><a href=\"#\" class=\"orange button\"><span>PURCHASE NOW</span></a></li>
		</ul>
	</div>
	<div class=\"pricecol green\">
		<ul>
			<li class=\"thead\">PRODUCT TWO</li>
			<li class=\"price\">$ 19.99 <span>(per item)</span></li>
			<li class=\"item\">Attribute 1</li>
			<li class=\"item\">Attribute 2</li>
			<li class=\"item\">Attribute 3</li>
			<li class=\"item\">Attribute 4</li>
			<li class=\"buy\" ><a href=\"#\" class=\"green button\"><span>PURCHASE NOW</span></a></li>
		</ul>
	</div>
	<div class=\"pricecol blue highlight\">
		<ul>
			<li class=\"thead\">PRODUCT THREE</li>
			<li class=\"price\">$ 19.99 <span>(per item)</span></li>
			<li class=\"item\">Attribute 1</li>
			<li class=\"item\">Attribute 2</li>
			<li class=\"item\">Attribute 3</li>
			<li class=\"item\">Attribute 4</li>
			<li class=\"buy\" ><a href=\"#\" class=\"blue button\"><span>PURCHASE NOW</span></a></li>
		</ul>
	</div>
	<div class=\"pricecol red\">
		<ul>
			<li class=\"thead\">PRODUCT FOUR</li>
			<li class=\"price\">$ 19.99 <span>(per item)</span></li>
			<li class=\"item\">Attribute 1</li>
			<li class=\"item\">Attribute 2</li>
			<li class=\"item\">Attribute 3</li>
			<li class=\"item\">Attribute 4</li>
			<li class=\"buy\" ><a href=\"#\" class=\"red button\"><span>PURCHASE NOW</span></a></li>
		</ul>
	</div>
	<div class=\"pricecol lightgrey\">
		<ul>
			<li class=\"thead\">PRODUCT FIVE</li>
			<li class=\"price\">$ 19.99 <span>(per item)</span></li>
			<li class=\"item\">Attribute 1</li>
			<li class=\"item\">Attribute 2</li>
			<li class=\"item\">Attribute 3</li>
			<li class=\"item\">Attribute 4</li>
			<li class=\"buy\" ><a href=\"#\" class=\"lightgrey button\"><span>PURCHASE NOW</span></a></li>
		</ul>
	</div>
</div><div class=\"clear\"></div>'>5 Column Example</option>";
// MISC
		$shortcodes_list .= "<option value='0' style='font-weight:bold;'>---- Misc ----</option>";
	// TABS
		$shortcodes_list .= "<option value='<ul class=\"tabs\">
                <li><a class=\"active\" href=\"#concept\">Concept</a></li>
                <li><a href=\"#design\">Design</a></li>
                <li><a href=\"#support\">Support</a></li>
            </ul>
            <ul class=\"tabs-content clearfix\">
                <li class=\"active clearfix\" id=\"concept\">
                    <div class=\"two_third\"><h6>2/3</h6><p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Lorem ipsum dolor sit amet, consetetur sadipscing elitr.</p></div>
                    <div class=\"one_third lastcolumn\"><h6>1/3</h6><p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.</p></div>
                </li>
                <li id=\"design\" class=\"clearfix\">
                    <div class=\"one_third\"><h6>1/3</h6><p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.</p></div>
                    <div class=\"two_third lastcolumn\"><h6>2/3</h6><p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Lorem ipsum dolor sit amet, consetetur sadipscing elitr.</p></div>
                </li>
                <li id=\"support\" class=\"clearfix\">
                    <div class=\"one_third\">
                        <h6>1/3</h6>
                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p> 
                    </div>
                    <div class=\"one_third\">
                        <h6>1/3</h6>
                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p> 
                    </div>
                    <div class=\"one_third lastcolumn\">
                        <h6>1/3</h6>
                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p> 
                    </div>
                </li>
            </ul>'>Tabs Example</option>";
    // ACCORDION
    	$shortcodes_list .= "<option value='<ul class=\"contents accordion\">
	<li class=\"accordion-item\">
		<div class=\"toggleswitch accordionopen\">
			<div class=\"tp-alert toggletitle\">Company Profile (3)</div>
		</div>									
		<div class=\"clear\"></div>
		<div class=\"togglecontent\">
			<p>Lorem ipsum dolor sit amet, <a href=\"#\">vestem rex</a> in lucem genero quod eam ad per. Tyrus pro ampullam virginitatem sunt amore meam. Accede meae sit audivit mihi Tyrum in rei finibus veteres hoc ait mea vero rex in rei exultant deo. Litus ostendam Apollonio vidit loco sed haec sed esse more filiam sunt amore assum.</p>
		</div>
	</li>								
	<li class=\"accordion-item\">
		<div class=\"toggleswitch accordionopen\">
			<div class=\"tp-support toggletitle\">Company Profile (3)</div>
		</div>									
		<div class=\"clear\"></div>
		<div class=\"togglecontent\">
				<p>Lorem ipsum dolor sit amet, <a href=\"#\">vestem rex</a> in lucem genero quod eam ad per. Tyrus pro ampullam virginitatem sunt amore meam. Accede meae sit audivit mihi Tyrum in rei finibus veteres hoc ait mea vero rex in rei exultant deo. Litus ostendam Apollonio vidit loco sed haec sed esse more filiam sunt amore assum.</p>
		</div>
	</li>		
	<li class=\"accordion-item\">
		<div class=\"toggleswitch accordionopen\">
			<div class=\"tp-global toggletitle\">Company Profile (3)</div>
		</div>														
		<div class=\"clear\"></div>
		<div class=\"togglecontent\">
				<p>Lorem ipsum dolor sit amet, <a href=\"#\">vestem rex</a> in lucem genero quod eam ad per. Tyrus pro ampullam virginitatem sunt amore meam. Accede meae sit audivit mihi Tyrum in rei finibus veteres hoc ait mea vero rex in rei exultant deo. Litus ostendam Apollonio vidit loco sed haec sed esse more filiam sunt amore assum.</p>
		</div>
	</li>
	<li class=\"accordion-item noicon\">
		<div class=\"toggleswitch accordionopen\">
			<div class=\"toggletitle\">Company Profile (3)</div>
		</div>														
		<div class=\"clear\"></div>
		<div class=\"togglecontent\">
				<p>Lorem ipsum dolor sit amet, <a href=\"#\">vestem rex</a> in lucem genero quod eam ad per. Tyrus pro ampullam virginitatem sunt amore meam. Accede meae sit audivit mihi Tyrum in rei finibus veteres hoc ait mea vero rex in rei exultant deo. Litus ostendam Apollonio vidit loco sed haec sed esse more filiam sunt amore assum.</p>
		</div>
	</li>
</ul>'>Accordion Example</option>"; 
	$shortcodes_list .= "<option value='<ul class=\"square\">
                            <li>Lorem ipsum dolor sit amet, consetetur sadipscing.</li>
                            <li>Lorem ipsum dolor sit amet, consetetur sadipscing.</li>
                            <li>Lorem ipsum dolor sit amet, consetetur sadipscing.</li>
                            <li>Lorem ipsum dolor sit amet, consetetur sadipscing.</li>
                        </ul>'>Square List Example</option>";
    $shortcodes_list .= "<option value='<ul class=\"checklist\">
                            <li>Lorem ipsum dolor sit amet, consetetur sadipscing.</li>
                            <li>Lorem ipsum dolor sit amet, consetetur sadipscing.</li>
                            <li>Lorem ipsum dolor sit amet, consetetur sadipscing.</li>
                            <li>Lorem ipsum dolor sit amet, consetetur sadipscing.</li>
                        </ul>'>Check List Example</option>";
	$shortcodes_list .= "<option value='<ol class=\"number\">
                            <li>Lorem ipsum dolor sit amet, consetetur sadipscing.</li>
                            <li>Lorem ipsum dolor sit amet, consetetur sadipscing.</li>
                            <li>Lorem ipsum dolor sit amet, consetetur sadipscing.</li>
                            <li>Lorem ipsum dolor sit amet, consetetur sadipscing.</li>
                        </ol>'>Numbered List Example</option>";
    $shortcodes_list .= "<option value='<ol class=\"letter\">
                            <li>Lorem ipsum dolor sit amet, consetetur sadipscing.</li>
                            <li>Lorem ipsum dolor sit amet, consetetur sadipscing.</li>
                            <li>Lorem ipsum dolor sit amet, consetetur sadipscing.</li>
                            <li>Lorem ipsum dolor sit amet, consetetur sadipscing.</li>
                        </ol>'>Lettered List Example</option>";
	echo $shortcodes_list;
	echo '</select>';
	echo '
	<style>
		.wp-admin select {
			margin-top: -7px;
		}
	</style>
	';
}

add_action('admin_head', 'shortcodeselector');

function shortcodeselector() {
	echo '<script type="text/javascript">
	jQuery(document).ready(function(){
	   jQuery("#sc_select").change(function() {
	   		var selectedval = jQuery("#sc_select :selected").val();
	   		if(selectedval != 0){
				send_to_editor(selectedval);
			}
			return false;
		});
	});
	</script>';
}

add_action('media_buttons','add_sc_select',11);



?>