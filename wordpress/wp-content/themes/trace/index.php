<?php
/* 
Template Name: Content
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
		if(isset($pagecustoms["averis_headline_active"])){
			if(isset($pagecustoms["averis_breadcrumbs_active"])){
				$averis_breadcrumbs_active="on";
				}else {$averis_breadcrumbs_active="off";
				}
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
<!-- TRACETEMPLATE INDEX -->
<?php // Camera Slideshow
if (function_exists('camera_meta_slideshow')) {
    $meta_camera = get_post_custom( $post->ID );
    if( (isset($meta_camera['camera_meta_slideshow'])) && ( $meta_camera['camera_meta_slideshow'][0]!=='none' ) ){
        echo '</div>';
        echo camera_meta_slideshow($meta_camera['camera_meta_slideshow'][0]);
        echo '<div class="container2 content_container">';
    }
}
?>
<?php /* Featured Image */
	if ( has_post_thumbnail() ) {
		echo '</div>';
		$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
		echo '<div class="page-banner shadow"><img src="' . $featured_image[0] . '" alt="' . the_title_attribute('echo=0') . '" class="wide100" /></div>';
		echo '<div class="container2 content_container">';
	}
?>
<div class="content">
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
					?>

				</div>
				<div class="clear"></div>								
			</div>
			<div class="clear"></div>								
		</div>
	</div>
<?php } ?>


	<div class="clear"></div>
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
							
					<?php the_content();
						echo do_shortcode('[ShowSiblings]');
							?>
					<div class="clear"></div>
			</div>
		</div>
	<?php  endwhile; endif; //have_posts ?>
<!-- END OF CONTENT CONTAINER -->
<?php get_footer(); ?>