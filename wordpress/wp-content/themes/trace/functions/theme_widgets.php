<?php


/* ------------------------------------- */
/* averis LATEST PROJECTS WIDGET */
/* ------------------------------------- */



class averisLatestProjects extends WP_Widget {

	function averisLatestProjects() {
		$widget_ops = array('classname' => 'averisLatestProjects', 'description' => 'A widget to display links to the latest projects.');
    	$this->WP_Widget('averisLatestProjects', 'averis Latest Projects', $widget_ops);
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance ); 
		$portfolio_category = "";
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id( 'projectcount' ); ?>">Number of Projects to show:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'projectcount' ); ?>" name="<?php echo $this->get_field_name( 'projectcount' ); ?>" value="<?php if( isset($instance['projectcount']) ) echo $instance['projectcount']; ?>" /></p> 

        <?php if ( !isset($instance['projectdisplay'])) $instance['projectdisplay']="image";

        ?>

		<p><label for="<?php echo $this->get_field_id( 'projectdisplay' ); ?>">Display Type:</label><br />
			<div style="white-space:nowrap"><input  type="radio" id="<?php echo $this->get_field_id( 'projectdisplay' ); ?>" name="<?php echo $this->get_field_name( 'projectdisplay' ); ?>" value="text" <?php if( isset($instance['projectdisplay']) &&  $instance['projectdisplay'] == "text") echo "checked"; ?> > Text</div>
			<div style="white-space:nowrap"><input  type="radio" id="<?php echo $this->get_field_id( 'projectdisplay' ); ?>" name="<?php echo $this->get_field_name( 'projectdisplay' ); ?>" value="image" <?php if( isset($instance['projectdisplay']) &&  $instance['projectdisplay'] == "image") echo "checked"; ?> > Image</div></p> 
        <p>
		<?php 
                $portfolio_slugs = get_option("averis_portfolio_slug");
                $portfolio_counter = 0;
                $portfolio_name = get_option("averis_portfolio_name");
                $portfolio_list = "";
                foreach ( $portfolio_slugs as $slug ){
                    $checked="";
                    if(isset($instance['portfolio_category']) && $slug==$instance['portfolio_category']) $checked="selected";
                    $portfolio_list .= "<option value='$slug' $checked >".$portfolio_name[$portfolio_counter++]."</option>";
                }
        
        echo '<select name="'.$this->get_field_name( 'portfolio_category' ).'" class="widefat" >'.$portfolio_list.'
        </select></p>';
    }

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		if ( isset($instance['id']) ) $id = $instance['id'];
		$projectcount = $instance['projectcount'];
		$portfolio_category = $instance['portfolio_category'];
		$type = $instance['projectdisplay'];
		echo $before_widget;
		
		$averis_teaser_readmore = __('Read More', 'averis');

	   	if ( $title ) echo $before_title . $title . $after_title;
		
		$columndiv = "";

		$pcat = "category_".$portfolio_category;
		$args=array(
			'post_type' => $portfolio_category,
			'posts_per_page' => $projectcount
		);

		$rownumber = 2;
		global $wp_query;
		$temp = $wp_query; 
		$wp_query = null;
		$wp_query = new WP_Query();
		$wp_query->query($args);
		$terms = get_terms($pcat);

		$unique = uniqid();
		$poplist = get_posts( $args );
		$element_count=1;
		$return_list = "<div>";
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

				if($element_count % $rownumber == 0){$lastelement = " ";}
				else $lastelement = "";
                
				
                $blogimageurl = wp_get_attachment_url( get_post_thumbnail_id($poppost->ID) ); 
	            if($type=="text"){
	            	if ($blogimageurl != "") {
	                	$return_list .= '<div class="blogposts listfade-img" style="margin-bottom:10px;">
							<div class="leftfloat covered blog_miniimagewrap"><div class=" tp_imgholder bordered hovering" style="overflow:hidden"><img class="" style="margin-bottom: -5px;" src="'.aq_resize($blogimageurl,40,40,true).'"><div class="hovering_link"><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'"><div class="plink"></div></a></div></div></div>
							<div class="leftfloat blogdetail"><p><a class="widget_post_link" href="'.$base.'/'.$repl.'/'.$poppost->post_name.'">'.$posttitle.'</a></p><p class="blogdate">'.date_i18n(get_option('date_format'), strtotime($poppost->post_date_gmt)).'</p></div>
							<div class="clear"></div>
						</div>';
						if($element_count % $rownumber == 0){
								$return_list .= '<div class="clear"></div>';
							if($element_count<sizeof($poplist)-$rownumber) $return_list .='	<div class="space20"></div>';
						}
					}
					else{	
						$return_list .= '<div class="blogposts">
							<div class=" blogdetail"><p><a class="widget_post_link" href="'.$base.'/'.$repl.'/'.$poppost->post_name.'">'.$posttitle.'</a></p><p class="blogdate">'.date_i18n(get_option('date_format'), strtotime($poppost->post_date_gmt)).'</p><p><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'">'.$averis_teaser_readmore.'</a></p></div>
							<div class="clear"></div>
						</div>';
					}
				}
				elseif ($type=="image") {
					$columndiv = "one_half ";
					$return_list .= '<div class="listfade-img"><div class="covered tp_imgholder bordered hovering" style="overflow:hidden;width:50px;"><img class="" style="margin-bottom: -5px;" src="'.aq_resize($blogimageurl,50,50,true).'"><div class="hovering_link"><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'"><div class="plink"></div></a></div></div></div>';
					if($element_count % $rownumber == 0){
								$return_list .= '';
							if($element_count < sizeof($poplist)-1) $return_list .='	';
							else {$return_list .='	<div class="space5"></div>'; }
						}
				}
				
				$element_count++;
      endforeach;
      $return_list .= "</div>";
      $wp_query = null; 
	  $wp_query = $temp;
	  wp_reset_query();
	  echo $return_list;
	echo $after_widget;




	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['projectcount'] = $new_instance['projectcount'];
		$instance['portfolio_category'] = $new_instance['portfolio_category'];
		$instance['projectdisplay'] = $new_instance['projectdisplay'];
		return $instance;
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("averisLatestProjects");') );



/* ------------------------------------- */
/* averis CUSTOM CATEGORIES WIDGET */
/* ------------------------------------- */
$template_uri_widgets = get_template_directory_uri();

class averisCategories extends WP_Widget
{
  function averisCategories()
  {
    $widget_ops = array('classname' => 'averisCategories', 'description' => 'Displays a list of Blog Categories' );
    $this->WP_Widget('averisCategories', 'averis Categories', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
 
	echo '<div class="widget_link_list"><ul class="averis_archive">';
	$cats = get_categories();
	foreach ($cats as $cat) {
		$my_query = new WP_Query('category_name='.$cat->name.'&posts_per_page=1'); 
 		while ($my_query->have_posts()) : $my_query->the_post();
      		 $blogimageurl = wp_get_attachment_url( get_post_thumbnail_id() ); 
        endwhile; 
		echo '<li ><a href="'.get_category_link( $cat->term_id ).'">'.$cat->name.' <span>('.$cat->count.')</span></a></li>';
	}
    echo '</ul></div>';
 
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("averisCategories");') );


/* ------------------------------------- */
/* averis CUSTOM ARCHIVES WIDGET */
/* ------------------------------------- */


class averisArchives extends WP_Widget
{
  function averisArchives()
  {
    $widget_ops = array('classname' => 'averisArchives', 'description' => 'Displays the Blog Archives' );
    $this->WP_Widget('averisArchives', 'averis Archives', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
    echo $before_title . $title . $after_title;

	echo '<div class="blogcategories"><ul class="averis_archive">';
	wp_get_archives(apply_filters('widget_archives_dropdown_args', array('type' => 'monthly', 'format' => 'html', 'before' => '<span></span>')));
    echo '</ul></div><div style="clear:both;"></div>';
 
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("averisArchives");') );


/* ------------------------------------- */
/* averis MINI GALLERY SIDEBAR WIDGET */
/* ------------------------------------- */


class averisMinigallery extends WP_Widget {

	function averisMinigallery() {
		$widget_ops = array('classname' => 'averisMinigallery', 'description' => 'A sidebar mini gallery. Please enter the links to the large images. Thumbs are generated automatically.');
    	$this->WP_Widget('averisMinigallery', 'averis Mini Gallery', $widget_ops);
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance ); ?>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></p>
		
        <p><label for="<?php echo $this->get_field_id( 'images' ); ?>">Image Url's (Separate with line breaks)</label><br /><textarea class="widefat" style="height:150px;" id="<?php echo $this->get_field_id( 'images' ); ?>" name="<?php echo $this->get_field_name( 'images' ); ?>"><?php if( isset($instance['images']) ) echo $instance['images']; ?></textarea></p> 
        
        <p><label for="<?php echo $this->get_field_id( 'titles' ); ?>">Image titles(Separate with line breaks)</label><br /><textarea class="widefat" style="height:150px;" id="<?php echo $this->get_field_id( 'titles' ); ?>" name="<?php echo $this->get_field_name( 'titles' ); ?>"><?php if( isset($instance['titles']) ) echo $instance['titles']; ?></textarea></p> 
        
        <p><label for="<?php echo $this->get_field_id( 'descriptions' ); ?>">Image description texts (Separate with line breaks)</label><br /><textarea class="widefat" style="height:150px;" id="<?php echo $this->get_field_id( 'descriptions' ); ?>" name="<?php echo $this->get_field_name( 'descriptions' ); ?>"><?php if( isset($instance['descriptions']) ) echo $instance['descriptions']; ?></textarea></p> 
        
	<?php
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		if ( isset($instance['id']) ) $id = $instance['id'];
		$imagearr = $instance['images'];
		$descriptionarr = $instance['descriptions'];
		$titlearr = $instance['titles'];

		echo $before_widget;
		
	   	if ( $title ) echo $before_title . $title . $after_title;
		$imagelinks = explode("\n", $imagearr);
		$descs = explode("\n", $descriptionarr);
		$titles = explode("\n", $titlearr);
		$ivar = 0;
		$unique = uniqid();
		echo '<div style="position:relative;"><div class="minigallery  listfade-img">';
			$element_count = 1;
			$lastelement="";
			
						
			foreach($imagelinks as $imagelink):
				if(isset($descs[$ivar])){
					$currentdesc = $descs[$ivar];
				}else{
					$currentdesc = "";
				}
				
				if(isset($titles[$ivar])){
					$currenttitle = $titles[$ivar];
				}else{
					$currenttitle = "";
				}
				
				if($element_count % 2 == 0){$lastelement = " lastcolumn";}
				else $lastelement = "";
				
				$columndiv = "one_half ";
					echo '<div class="covered tp_imgholder '.$columndiv.$lastelement.' hovering" style="overflow:hidden;" ><img class="" style="margin-bottom: -5px;width:93px;" src="'.$imagelink.'"><div class="hovering_more"><a href="'.$imagelink.'" data-rel="prettyPhoto['.$unique.']" title="'.$currenttitle.$currentdesc.'"><div class="pmore"></div></a></div></div>';
					if($element_count % 2 == 0){echo '<div class="clear"></div>';}
				$element_count++;
				$ivar++;
			endforeach;
		echo '</div></div>';
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['images'] = $new_instance['images'];
		$instance['descriptions'] = $new_instance['descriptions'];
		$instance['titles'] = $new_instance['titles'];
		return $instance;
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("averisMinigallery");') );


/* ------------------------------------- */
/* averis SIDEBAR VIMEO WIDGET */
/* ------------------------------------- */


class averisSidebarvimeo extends WP_Widget {

	function averisSidebarvimeo() {
		$widget_ops = array('classname' => 'averisSidebarvimeo', 'description' => 'Display a vimeo video in the sidebar.');
    	$this->WP_Widget('averisSidebarvimeo', 'averis Video Sidebar Vimeo', $widget_ops);
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance ); ?>
        
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id( 'videoid' ); ?>">Vimeo Video ID:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'videoid' ); ?>" name="<?php echo $this->get_field_name( 'videoid' ); ?>" value="<?php if( isset($instance['videoid']) ) echo $instance['videoid']; ?>" /></p> 
        
	<?php
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		if ( isset($instance['id']) ) $id = $instance['id'];
		$vimeoid = $instance['videoid'];

		echo $before_widget;
		
	   	if ( $title ) echo $before_title . $title . $after_title;

		echo '<div class="video_top"></div><div class="bordered video-container_master" style="max-width:100%;height:auto;">
								<div class="video-wrapper">
									<div class="video-container"><iframe src="http://player.vimeo.com/video/'.$vimeoid.'?title=0&amp;byline=0&amp;portrait=0&amp;autohide=1" width="202" height="115"></iframe>
			</div></div></div>';
	
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['videoid'] = $new_instance['videoid'];
		return $instance;
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("averisSidebarvimeo");') );


/* ------------------------------------- */
/* averis SIDEBAR youtube WIDGET */
/* ------------------------------------- */


class averisSidebaryoutube extends WP_Widget {

	function averisSidebaryoutube() {
		$widget_ops = array('classname' => 'averisSidebaryoutube', 'description' => 'Display a youtube video in the sidebar.');
    	$this->WP_Widget('averisSidebaryoutube', 'averis Video Sidebar Youtube', $widget_ops);
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance ); ?>
        
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id( 'videoid' ); ?>">Youtube Video ID:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'videoid' ); ?>" name="<?php echo $this->get_field_name( 'videoid' ); ?>" value="<?php if( isset($instance['videoid']) ) echo $instance['videoid']; ?>" /></p> 
        
	<?php
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		if ( isset($instance['id']) ) $id = $instance['id'];
		$youtubeid = $instance['videoid'];

		echo $before_widget;
		
	   	if ( $title ) echo $before_title . $title . $after_title;

	   	echo '<div class="video_top"></div><div class="bordered video-container_master" style="max-width:100%;height:auto;">
								<div class="video-wrapper">
									<div class="video-container"><iframe src="http://www.youtube.com/embed/'.$youtubeid.'?hd=1&amp;wmode=opaque&amp;controls=1&amp;showinfo=0&amp;autohide=1" width="202" height="115"></iframe>
			</div></div></div>';
	
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['videoid'] = $new_instance['videoid'];
		return $instance;
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("averisSidebaryoutube");') );

/* ------------------------------------- */
/* averis SIDEBAR flv WIDGET */
/* ------------------------------------- */


class averisSidebarflv extends WP_Widget {

	function averisSidebarflv() {
		$widget_ops = array('classname' => 'averisSidebarflv', 'description' => 'Display a flv video in the sidebar.');
    	$this->WP_Widget('averisSidebarflv', 'averis Video Sidebar FLV', $widget_ops);
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance ); ?>
        
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id( 'videoid' ); ?>">flv Video URL:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'videoid' ); ?>" name="<?php echo $this->get_field_name( 'videoid' ); ?>" value="<?php if( isset($instance['videoid']) ) echo $instance['videoid']; ?>" /></p> 
        
	<?php
	}

	function widget( $args, $instance ) {
		extract( $args );
		global $template_uri_widgets;
		$title = apply_filters('widget_title', $instance['title'] );
		if ( isset($instance['id']) ) $id = $instance['id'];
		$flvid = $instance['videoid'];
		$uniq = uniqid("flv_sid_");
		echo $before_widget;
		
	   	if ( $title ) echo $before_title . $title . $after_title;

   		echo '<div class="video_top"></div><div class="bordered video-container_master" style="max-width:100%;height:auto;">
							<div class="video-wrapper">
								<div class="video-container"><a class="bordered" href="'.$flvid.'" style="display:block;width=202px;height:115px;"   id="'.$uniq.'"> </a> 
		</div></div></div>
			<!-- this will install flowplayer inside previous A- tag. -->
			<script>
				flowplayer("'.$uniq.'", "'.$template_uri_widgets.'/js/flowplayer_plugins/flowplayer-3.2.7.swf",{clip : {			autoPlay: false,
				       autoBuffering: true
				   },plugins: {
					controls: null
				}});
			</script>';
	
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['videoid'] = $new_instance['videoid'];
		return $instance;
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("averisSidebarflv");') );

/* ------------------------------------- */
/* averis SIDEBAR html5 WIDGET */
/* ------------------------------------- */


class averisSidebarhtml5 extends WP_Widget {

	function averisSidebarhtml5() {
		$widget_ops = array('classname' => 'averisSidebarhtml5', 'description' => 'Display a HTML5 video in the sidebar (see www.mediaelementjs.com for Browser and Device Support)');
    	$this->WP_Widget('averisSidebarhtml5', 'averis Video Sidebar HTML5', $widget_ops);
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance ); ?>
        
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id( 'videomp4' ); ?>">MP4/M4V File URL:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'videomp4' ); ?>" name="<?php echo $this->get_field_name( 'videomp4' ); ?>" value="<?php if( isset($instance['videomp4']) ) echo $instance['videomp4']; ?>" /></p> 
        <p><label for="<?php echo $this->get_field_id( 'preview' ); ?>">Preview Image URL:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'preview' ); ?>" name="<?php echo $this->get_field_name( 'preview' ); ?>" value="<?php if( isset($instance['preview']) ) echo $instance['preview']; ?>" /></p>
        
        
	<?php
	}

	function widget( $args, $instance ) {
		extract( $args );
		global $template_uri_widgets;
		$title = apply_filters('widget_title', $instance['title'] );
		if ( isset($instance['id']) ) $id = $instance['id'];
		$videomp4 = $instance['videomp4'];
		$videowebm = $instance['videowebm'];
		$preview = $instance['preview'];
		echo $before_widget;
		
	   	if ( $title ) echo $before_title . $title . $after_title;

	   	echo '';
   		echo '<div class="bordered" style="overflow:hidden;padding:4px;height:128px;"><div class=" video-container_master" style="max-width:100%;height:auto;overflow:hidden;">
							<div class="video-wrapper" style="overflow:hidden;">
								<div class="video-container" style="overflow:hidden;">
								 <div class="html5video" style="overflow:hidden; ">
														<iframe frameborder="4" width="100%" height="100%"  src="'.$template_uri_widgets.'/functions/video_shortcodes.php?mp4='.$videomp4.'&preview='.$preview.'" style="overflow:hidden !important;" bgcolor="#C9D3DE"></iframe>
													
													</div>
	
		</div></div></div></div>
			';
	
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['videomp4'] = $new_instance['videomp4'];
		$instance['videowebm'] = $new_instance['videowebm'];
		$instance['preview'] = $new_instance['preview'];
		return $instance;
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("averisSidebarhtml5");') );


/* ------------------------------------- */
/* averis NEWSLETTER SIGNUP WIDGET */
/* ------------------------------------- */

/*

class averisNewsletter extends WP_Widget {

	function averisNewsletter() {
		$widget_ops = array('classname' => 'averisNewsletter', 'description' => 'Newsletter Widget. Please configure the target E-Mail under Theme Options!');
    	$this->WP_Widget('averisNewsletter', 'averis Newsletter Signup', $widget_ops);
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance ); ?>
        
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id( 'namelabel' ); ?>">Name Field Label:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'namelabel' ); ?>" name="<?php echo $this->get_field_name( 'namelabel' ); ?>" value="<?php if( isset($instance['namelabel']) ) echo $instance['namelabel']; ?>" /></p> 
        
        <p><label for="<?php echo $this->get_field_id( 'emaillabel' ); ?>">Email Field Label:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'emaillabel' ); ?>" name="<?php echo $this->get_field_name( 'emaillabel' ); ?>" value="<?php if( isset($instance['emaillabel']) ) echo $instance['emaillabel']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id( 'submit' ); ?>">Submit Button Text:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'submit' ); ?>" name="<?php echo $this->get_field_name( 'submit' ); ?>" value="<?php if( isset($instance['submit']) ) echo $instance['submit']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id( 'error' ); ?>">Error Message:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'error' ); ?>" name="<?php echo $this->get_field_name( 'error' ); ?>" value="<?php if( isset($instance['error']) ) echo $instance['error']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id( 'success' ); ?>">Success Message:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'success' ); ?>" name="<?php echo $this->get_field_name( 'success' ); ?>" value="<?php if( isset($instance['success']) ) echo $instance['success']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id( 'sending' ); ?>">Sending Message:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'sending' ); ?>" name="<?php echo $this->get_field_name( 'sending' ); ?>" value="<?php if( isset($instance['sending']) ) echo $instance['sending']; ?>" /></p>
        

        
	<?php
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		if ( isset($instance['id']) ) $id = $instance['id'];
		$labelname = $instance['namelabel'];
		$labelemail = $instance['emaillabel'];
		$buttonsubmit = $instance['submit'];
		$messageerror = $instance['error'];
		$messagesuccess = $instance['success'];
		$messagesending = $instance['sending'];

		echo $before_widget;
		
	   	if ( $title ) echo $before_title . $title . $after_title;
		echo '<div id="newsletter">
                <form id="newsletterform" method="post" action="#">
	                <div class="formpart last">
	                    <span class="errormessage">'.$messageerror.'</span>
	                    <span class="successmessage">'.$messagesuccess.'</span>
	                    <span class="sendingmessage">'.$messagesending.'</span>
	                </div>
                    <div class="formpart">
                        <label for="newsletter_name">'.$labelname.'</label>

                        <p><input type="text" name="name" id="newsletter_name" value="" class="requiredfield rounded"/></p>
                    </div>		
                    <div class="formpart">
                        <label for="newsletter_email">'.$labelemail.'</label>
                        <p><input type="text" name="email" id="newsletter_email" value="" class="requiredfield rounded"/></p>
                    </div>				
                    <div class="formpart paddingright100" sty>
                        <!--button type="submit" name="send" class="buttonlight rounded"></button-->
						<a href="#" type="submit" name="send" class="buttonlight rounded">'.$buttonsubmit.'</a>
                    </div>
                    
                </form>  
            </div>
		';
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['namelabel'] = $new_instance['namelabel'];
		$instance['emaillabel'] = $new_instance['emaillabel'];
		$instance['submit'] = $new_instance['submit'];
		$instance['error'] = $new_instance['error'];
		$instance['success'] = $new_instance['success'];
		$instance['sending'] = $new_instance['sending'];
		return $instance;
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("averisNewsletter");') );
*/


/* ------------------------------------- */
/* averis POSTS WIDGET */
/* ------------------------------------- */


class averisPosts extends WP_Widget {

	function averisPosts() {
		$widget_ops = array('classname' => 'averisPosts', 'description' => 'A popular/latest posts widget.');
    	$this->WP_Widget('averisPosts', 'averis Popular/Latest Posts', $widget_ops);
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance ); ?>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'postcount' ); ?>">Post Count:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php if( isset($instance['postcount']) ) echo $instance['postcount']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id( 'poplatest' ); ?>">Latest or Popular:</label><br />
        <select class="widefat" id="<?php echo $this->get_field_id( 'poplatest' ); ?>" name="<?php echo $this->get_field_name( 'poplatest' ); ?>">
        	<option value="1" <?php 
        		if( isset($instance['poplatest']) && $instance['poplatest']== 1 ) {
        			echo "selected"; 
        		}
        	?>>Latest Posts</option>
        	<option value="2" <?php 
        		if( isset($instance['poplatest']) && $instance['poplatest']== 2 ) {
        			echo "selected"; 
        		}
        	?>>Popular Posts</option>
        </select>
        </p>
        
        <p><label for="<?php echo $this->get_field_id( 'posttype' ); ?>">Show this Category Slug:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'posttype' ); ?>" name="<?php echo $this->get_field_name( 'posttype' ); ?>" value="<?php if( isset($instance['posttype']) ) echo $instance['posttype']; ?>" /></p>
        <!--
        <p><label for="<?php echo $this->get_field_id( 'timeformat' ); ?>">Time Format (see <a href="http://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">here</a>):</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'timeformat' ); ?>" name="<?php echo $this->get_field_name( 'timeformat' ); ?>" value="<?php if( isset($instance['timeformat']) ) echo $instance['timeformat']; ?>" /></p>
        -->
        
	<?php
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		if ( isset($instance['id']) ) $id = $instance['id'];
		$pcount = $instance['postcount'];
		$platest = $instance['poplatest'];
		$ptype = $instance['posttype'];
		$tformat = $instance['timeformat'];
		$rmore = $instance['readmore'];
		
		$averis_teaser_readmore = __('Read More', 'averis');

		echo $before_widget;
		
	   	if ( $title ) echo $before_title . $title . $after_title;
		
		if($ptype==""){
			$ptype = 'post';
		}

		$category = get_category_by_slug($ptype);
		if($category)$catid = $category->term_id;
		else $catid="";

		if($platest==1){
			$popargs = array( 'numberposts' => $pcount, 'orderby' => 'post_date', 'cat' => $catid );
		}else{
			$popargs = array( 'numberposts' => $pcount, 'orderby' => 'comment_count', 'cat' => $catid );
		}
		$unique = uniqid();
		$poplist = get_posts( $popargs );
		$popcount=1;
		foreach ($poplist as $poppost) :  setup_postdata($poppost);
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
                
                if($popcount == sizeof($poplist)) $last=" style='margin-bottom:7px;'";
                else $last='style="margin-bottom:10px;"';

				$blogimageurl = wp_get_attachment_url( get_post_thumbnail_id($poppost->ID) ); 
                if ($blogimageurl != "") {
                	echo '<div class=" listfade-img blogposts" '.$last.'>
						<div class="leftfloat  blog_miniimagewrap covered"><div class=" tp_imgholder bordered hovering " style="overflow:hidden"><img class="" style="margin-bottom: -5px;" src="'.aq_resize($blogimageurl,40,40,true).'"><div class="hovering_link"><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'"><div class="plink"></div></a></div></div></div>
						<div class=" leftfloat blogdetail"><p><a class="widget_post_link" href="'.$base.'/'.$repl.'/'.$poppost->post_name.'">'.$posttitle.'</a></p><p class="blogdate">'.date_i18n(get_option('date_format'), strtotime($poppost->post_date_gmt)).'</p></div>											
						<div class="clear"></div>
					</div>';
				}
				else{	
					echo '<div class="listfade-img blogposts" '.$last.'>
						<div class=" blogdetail"><p><a class="widget_post_link" href="'.$base.'/'.$repl.'/'.$poppost->post_name.'">'.$posttitle.'</a></p><p class="blogdate">'.date_i18n(get_option('date_format'), strtotime($poppost->post_date_gmt)).'</p><p><a href="'.$base.'/'.$repl.'/'.$poppost->post_name.'">'.$averis_teaser_readmore.'</a></p></div>											
						<div class="clear"></div>
					</div>';
				}
				$popcount++;
      endforeach;


		echo $after_widget;
	}


	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['postcount'] = $new_instance['postcount'];
		$instance['poplatest'] = $new_instance['poplatest'];
		$instance['posttype'] = $new_instance['posttype'];
		$instance['timeformat'] = $new_instance['timeformat'];
		$instance['readmore'] = $new_instance['readmore'];
		return $instance;
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("averisPosts");') );


/* ------------------------------------- */
/* averis TWITTER FEED WIDGET */
/* ------------------------------------- */


class averisTwitterfeed extends WP_Widget {

	function averisTwitterfeed() {
		$widget_ops = array('classname' => 'averisTwitterfeed', 'description' => 'Twitter Feed Widget');
    	$this->WP_Widget('averisTwitterfeed', 'averis Twitter Feed', $widget_ops);
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance ); ?>
        
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id( 'username' ); ?>">Twitter User Name:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php if( isset($instance['username']) ) echo $instance['username']; ?>" /></p> 
        
        <p><label for="<?php echo $this->get_field_id( 'feedcount' ); ?>">Feed Count:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'feedcount' ); ?>" name="<?php echo $this->get_field_name( 'feedcount' ); ?>" value="<?php if( isset($instance['feedcount']) ) echo $instance['feedcount']; ?>" /></p> 
        
	<?php
	}

	function widget( $args, $instance ) {
			extract( $args );
	
			$title = apply_filters('widget_title', $instance['title'] );
			if ( isset($instance['id']) ) $id = $instance['id'];
			$user = $instance['username'];
			$feeds = $instance['feedcount'];
			$uniqid = uniqid("tw_");
			echo $before_widget;
			
		   	if ( $title ) echo $before_title . $title . $after_title;
			echo '<div id="twitter_feed_'.$uniqid.'"></div>';
			echo '<script>
				jQuery("document").ready(function(){
					//////////////////
					// INIT TWITTER //
					//////////////////
						jQuery("#twitter_feed_'.$uniqid.'").twitterReader({
							user:"'.$user.'",
							count:'.$feeds.'
						});	 
				});
			</script>';
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['username'] = $new_instance['username'];
		$instance['feedcount'] = $new_instance['feedcount'];
		return $instance;
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("averisTwitterfeed");') );

/* ------------------------------------- */
/* averis FLICKR FEED WIDGET */
/* ------------------------------------- */


class averisFlickrfeed extends WP_Widget {

	function averisFlickrfeed() {
		$widget_ops = array('classname' => 'averisFlickrfeed', 'description' => 'Flickr Feed Widget');
    	$this->WP_Widget('averisFlickrfeed', 'averis Flickr Feed', $widget_ops);
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance ); ?>
        
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id( 'feedurl' ); ?>">Flickr Feed URL:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'feedurl' ); ?>" name="<?php echo $this->get_field_name( 'feedurl' ); ?>" value="<?php if( isset($instance['feedurl']) ) echo $instance['feedurl']; ?>" /></p> 
        
        <p><label for="<?php echo $this->get_field_id( 'feedcount' ); ?>">Image Count:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'feedcount' ); ?>" name="<?php echo $this->get_field_name( 'feedcount' ); ?>" value="<?php if( isset($instance['feedcount']) ) echo $instance['feedcount']; ?>" /></p> 
        
	<?php
	}

	function widget( $args, $instance ) {
			extract( $args );
	
			$title = apply_filters('widget_title', $instance['title'] );
			if ( isset($instance['id']) ) $id = $instance['id'];
			$feedurl = $instance['feedurl'];
			$feed_count = $instance['feedcount'];
	
			echo $before_widget;
			$uniqe = uniqid();
			
		   	if ( $title ) echo $before_title . $title . $after_title;
			echo '<div style="position:relative"><div id="flickr_feed_'.$uniqe.'"></div></div>';
	
			echo '
			<script type="text/javascript">
			jQuery("#flickr_feed_'.$uniqe.'").flickrPreview({
				feed:"'.$feedurl.'",
				sized:"m",
				count:'.$feed_count.',
				uniq:"'.$uniqe.'"
			});
			</script>';
		
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['feedurl'] = $new_instance['feedurl'];
		$instance['feedcount'] = $new_instance['feedcount'];
		return $instance;
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("averisFlickrfeed");') );

/* ------------------------------------- */
/* averis Quickcontact WIDGET */
/* ------------------------------------- */



class averisQuickcontact extends WP_Widget {

	function averisQuickcontact() {
		$widget_ops = array('classname' => 'averisQuickcontact', 'description' => 'Quickcontact Widget');
    	$this->WP_Widget('averisQuickcontact', 'averis Quickcontact Form', $widget_ops);
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance ); ?>
        
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></p>
  		<p><label for="<?php echo $this->get_field_id( 'sendto' ); ?>">Send To:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'sendto' ); ?>" name="<?php echo $this->get_field_name( 'sendto' ); ?>" value="<?php if( isset($instance['sendto']) ) echo $instance['sendto']; ?>" /></p>
	<?php
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		if ( isset($instance['id']) ) $id = $instance['id'];
		$labelname = __('Name *', 'averis');
		$labelemail = __('Email *', 'averis');
		$labelmessage = __('Message *', 'averis');
		$buttonsubmit = __('Send', 'averis');
		$messageerror = __('Error! Please correct marked fields.', 'averis');
		$messagesuccess = __('Message send successfully!', 'averis');
		$messagesending = __('Sending...', 'averis');

		echo $before_widget;
		
	   	if ( $title ) echo $before_title . $title . $after_title;
		echo '<div class="reply-form four columns alpha"><form id="quickcontact" method="post" action="#"><input type="hidden" name="sendto" id="sendto" value=\''.$instance['sendto'].'\'/>
				<input type="text" name="name" id="quickcontact_name" class="inputbox requiredfield" value=\''.$labelname.'\'/>
				<input type="text" name="email" id="quickcontact_email" class="inputbox requiredfield" value=\''.$labelemail.'\'/>
				<textarea rows="8" name="message" id="quickcontact_message" class="inputbox requiredfield">'.$labelmessage.'</textarea>
				<div class="clear"></div>
				<input type="submit" id="signup_go" value="'.$buttonsubmit.'" class="submitbutton" />
				<span class="errormessage">'.$messageerror.'</span>
				<span class="successmessage">'.$messagesuccess.'</span>
				<span class="sendingmessage">'.$messagesending.'</span>      
			</form></div>';
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['sendto'] = $new_instance['sendto'];
		return $instance;
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("averisQuickcontact");') );

/* ------------------------------------- */
/* averis SITEMAP WIDGET */
/* ------------------------------------- */


class averisSitemap extends WP_Widget {

	function averisSitemap() {
		$widget_ops = array('classname' => 'averisSitemap', 'description' => 'Sitemap Generator Widget');
    	$this->WP_Widget('averisSitemap', 'averis Sitemap', $widget_ops);
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance ); ?>
        
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></p>
        
        
	<?php
	}

	function widget( $args, $instance ) {
			extract( $args );
	
			$title = apply_filters('widget_title', $instance['title'] );
			if ( isset($instance['id']) ) $id = $instance['id'];
			echo $before_widget;
			
		   	if ( $title ) echo $before_title . $title . $after_title;
			echo '<ul class="sitemap accordion">
									
								</ul>';
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		return $instance;
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("averisSitemap");') );


/* ------------------------------------- */
/* averis Quote Rotate WIDGET */
/* ------------------------------------- */


class averisQuotes extends WP_Widget {

	function averisQuotes() {
		$widget_ops = array('classname' => 'averisQuotes', 'description' => 'Quote Rotator Widget');
    	$this->WP_Widget('averisQuotes', 'averis Quotes', $widget_ops);
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance ); 
		if(isset($instance["uniqid"])){
			$uniq = $instance["uniqid"];
			$quotes = get_option($uniq."_quote_body");
			$authors = get_option($uniq."_quote_author");
			$quote_count=0;
		}
		else{
			$uniq = uniqid("qb_");
			$quotes="";
		}



		?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /><input type="hidden"  id="uniqid" name="uniqid" value="<?php echo $uniq; ?>" /></p>
       <?php echo '<a class="repeatable-add button" href="#">Add another Quote</a>
								<ul id="quote-repeatable" class="custom_repeatable">';
						$i = 0;
						if (is_array($quotes)) {
							foreach($quotes as $row) {
								echo '<li class="widget ui-draggable" style="width:90%"><div class="widget-top sort hndle" style="cursor:move; height:30px;margin-bottom:2px;"><span style="line-height:30px;margin-left:10px;">|||</span><a class="repeatable-remove button" style="float:right;margin-top:3px;margin-right:10px;" href="#">Remove</a></div>
											<div style="padding:10px;">
												Quote
												<textarea name="'.$uniq.'_quote_body[]." id="quote_body" rows=8 style="width: 98%;">'.stripslashes($row).'</textarea><br>
												Author
												<input class="widefat" style="width: 95%;" name="'.$uniq.'_quote_author[]." id="quote_author" value="'.$authors[$quote_count].'">
											</div>
										</li>';
								$quote_count++;
							}
						} else {
							echo '<li class="widget ui-draggable" style="width:90%"><div class="widget-top sort hndle" style="cursor:move; height:30px;margin-bottom:2px;"><span style="line-height:30px;margin-left:10px;">|||</span><a class="repeatable-remove button" style="float:right;margin-top:3px;margin-right:10px;" href="#">Remove</a></div>
											<div style="padding:10px;">
												Quote
												<textarea name="'.$uniq.'_quote_body[]" rows=8 id="quote_body" style="width: 98%;">Quote</textarea><br>
												Author
												<input class="widefat" style="width: 95%;" name="'.$uniq.'_quote_author[]." id="quote_author" value="Quote Author">
											</div>
								  </li>';
						}
						echo "</ul>";
					
	}

	function widget( $args, $instance ) {
			extract( $args );
	
			$title = apply_filters('widget_title', $instance['title'] );
			if ( isset($instance['id']) ) $id = $instance['id'];
			echo $before_widget;
			
			if(isset($instance["uniqid"])){
				$uniq = $instance["uniqid"];
				$quotes = get_option($uniq."_quote_body");
				$authors = get_option($uniq."_quote_author");
				$quote_count=0;
			}
			else{
				$quotes="";
			}


		   	if ( $title ) echo $before_title . $title . $after_title;

		   	if (is_array($quotes)) {
		   		echo '<div class="tp_testimonials"><ul>';
				foreach($quotes as $row) {

					echo '<li class="four columns alpha">
							<p>'.stripslashes($row).'</p>';
					if($authors[$quote_count]!=""){		
						echo '<div class="author">'.stripslashes($authors[$quote_count]).'</div>';
					}
					else {
						echo '<div class="author">&nbsp;</div>';
					}
					echo '</li>';
					$quote_count++;
				}
				echo '</ul><div class="tp_testimonials_navigation rightfloat">
									<div class="tp_testimonials_left"></div>
									<div class="tp_testimonials_right"></div>
									<div class="clear"></div>
							</div></div>';
			}
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['uniqid']=$_REQUEST['uniqid'];
		update_option($_REQUEST['uniqid']."_quote_body",$_REQUEST[$_REQUEST['uniqid'].'_quote_body']);
		update_option($_REQUEST['uniqid']."_quote_author",$_REQUEST[$_REQUEST['uniqid'].'_quote_author']);
		add_action('widgets_init','load_quotes_scripts');

		return $instance;
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("averisQuotes");') );

//Loading scripts for Quotes Admin
function load_quotes_scripts() {
    if( is_admin() ) {
        wp_enqueue_script('jquery');
        // Media Upload
	   	wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		// jQuery UI
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-sortable');
        wp_enqueue_script('custom-js-widgets', get_template_directory_uri() . '/functions/widgets_custom.js');
    }
}
add_action('widgets_init','load_quotes_scripts');


/* ------------------------------------- */
/* averis MINI GALLERY SIDEBAR WIDGET */
/* ------------------------------------- */


class averisDownload extends WP_Widget {

	function averisDownload() {
		$widget_ops = array('classname' => 'averisDownload', 'description' => 'A sidebar icon & description for one download link.');
    	$this->WP_Widget('averisDownload', 'averis Download Icon', $widget_ops);
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance ); ?>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></p>
		
        <p><label for="<?php echo $this->get_field_id( 'images' ); ?>">Image Url:</label><br /><input class="widefat"  id="<?php echo $this->get_field_id( 'images' ); ?>" name="<?php echo $this->get_field_name( 'images' ); ?>" value="<?php if( isset($instance['images']) ) echo $instance['images']; ?>"></p> 
                
        <p><label for="<?php echo $this->get_field_id( 'descriptions' ); ?>">Download Description</label><br /><textarea class="widefat" style="height:150px;" id="<?php echo $this->get_field_id( 'descriptions' ); ?>" name="<?php echo $this->get_field_name( 'descriptions' ); ?>"><?php if( isset($instance['descriptions']) ) echo $instance['descriptions']; ?></textarea></p> 
        
        <p><label for="<?php echo $this->get_field_id( 'link' ); ?>">Link Url:</label><br /><input class="widefat"  id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php if( isset($instance['link']) ) echo $instance['link']; ?>"></p>
        
        
	<?php
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		if ( isset($instance['id']) ) $id = $instance['id'];
		$image = $instance['images'];
		$description = $instance['descriptions'];
		$link = $instance['link'];
		echo $before_widget;
		
	   	if ( $title ) echo $before_title . $title . $after_title;
		$unique = uniqid();
		echo '<div class="download_link"><p>
			<a href="'.$link.'"><img src="'.$image.'" class="alignleft" style="margin-right:10px;"> '.$description.'</a></p>
		</div>';
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['images'] = $new_instance['images'];
		$instance['descriptions'] = $new_instance['descriptions'];
		$instance['link'] = $new_instance['link'];
		return $instance;
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("averisDownload");') );


?>