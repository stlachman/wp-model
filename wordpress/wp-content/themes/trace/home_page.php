<?php
/* 
Template Name: Home Page
*/

	global $wp_query;
    if(isset($wp_query))
    	$content_array = $wp_query->get_queried_object();
	if(isset($content_array->ID)){
    	$post_id = $content_array->ID;
	}	
	
	$template_uri = get_template_directory_uri();
	
	// Page Options
		$pagecustoms = getOptions();


		// Headline Block On or Off (breadcrumbs too)
/* 		if(isset($pagecustoms["averis_headline_active"])){ */
/* 			if(isset($pagecustoms["averis_breadcrumbs_active"])){ */
				$averis_breadcrumbs_active="on";
/* 				}else {$averis_breadcrumbs_active="off"; */
/* 				} */
			$averis_headline_active="on";
			if(isset($pagecustoms["averis_header_title"]))
				$averis_headline = $pagecustoms["averis_header_title"];
			else
				$averis_headline = get_the_title($post_id);
/* 		} */
/*
		else {
			$averis_headline_active="off";
		}	
*/

		// Sidebar Options
		if(isset($pagecustoms["averis_activate_sidebar"])){
			$averis_activate_sidebar="on";
			$sidebar_orientation = $pagecustoms["averis_sidebar_orientation"];
			$sidebar = $pagecustoms["averis_sidebar"];
			$post_column_full = "eleven";
			if($sidebar_orientation=="right"){
				$sidebar_class = "offset-by-one omega alpha sidebar";	
				$main_class = "left";
			}
			else {
				$sidebar_class = "leftfloat";
				$main_class = "rightfloatNOT omega"; //JAS
			}
		}
		else {
			$averis_activate_sidebar="off";
			$post_column_full = "sixteen";
			$main_class="";
		}		

	// Blog Options
		if ( function_exists( 'get_option_tree') ) {
		
		}	

?>    

<?php get_header(); ?>
<!-- TRACETEMPLATE HOME PAGE -->
<?php // Camera Slideshow
if (function_exists('camera_meta_slideshow')) {
    $meta_camera = get_post_custom( $post->ID );
    if(isset($meta_camera['camera_meta_slideshow'])){
        echo '</div>';
        echo camera_meta_slideshow($meta_camera['camera_meta_slideshow'][0]);
        echo '<div class="container2 content_container">';
    }
}
?>
<div class="content">

<?php if($averis_activate_sidebar=="off") {?>
	<div class="divide20"></div>
<?php } ?>
<!-- MAIN CONTENT CONTAINER	-->
	<?php if(have_posts()) : while(have_posts()) : the_post();
		//if(strlen(get_the_content())){
	?>
		<div class="sixteen columns alpha">
			<?php if($averis_activate_sidebar!="off") {?>
				<div class="four columns sidebar <?php echo $sidebar_class;?>">
					 <div class="clear"></div>
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar) ) : ?>
							
		                       
		                        <div style="margin-bottom:20px"><span class="widget_title">Sidebar Widget</span></div>
		                        <p style="color:#ccc">
		                        	Please configure this Widget in the Admin Panel under Appearance -> Widgets
		                        </p>
		                        <div class="clear"></div>
		                    
		                <?php endif;?>
       				<div class="mobileOnly"><hr class="marb0 mart20" /></div>
				</div>

			<?php } ?>
			<div class="<?php echo $post_column_full." ".$main_class;?> columns" style="overflow:visible;">
					<div class="clear"></div>
					<?php the_content(); ?>
					<div class="clear"></div>
					<div class="small right mart15 marb15">Is there a problem with this page? Help us fix it - <a href="/report-a-bug">Report a Bug</a></div>
					<div class="clear"></div>
			</div>
		</div>
	<?php  endwhile; endif; //have_posts ?>
<!-- END OF CONTENT CONTAINER -->
<?php get_footer(); ?>