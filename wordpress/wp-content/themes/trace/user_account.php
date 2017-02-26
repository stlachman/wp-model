<?php
/* 
Template Name: User Account
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
<!-- TRACETEMPLATE USER ACCOUNT -->
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
					<?php // the_content(); ?>
					<h1>AirCheck<span class="tracecheck">&#x2713;</span> Academy&trade; Account Information</h1>

<?php
	// Get info if the user is logged in

	if(isset($_SESSION['pg_user_id'])) {
		// get user data
		$userData = pg_user_logged();

		$user_id = $userData->id;
		$user_firstname = $userData->name;
		$user_lastname = $userData->surname;
		$user_username = $userData->username;
		$user_email = $userData->email;
		$user_company = $userData->tel;
		$user_page_id = $userData->page_id;
		$user_disable_pvt_page = $userData->disable_pvt_page;
		$user_psw = base64_decode($userData->psw);

		/*
echo "You are logged in as $user_firstname $user_lastname. <br />";
		echo pg_logout_btn();
		echo "<div class='clearfix marb15'></div>";
*/
		
		echo "<div class='eight columns alpha widget-1 first widget' id='privatecontentlogin-2'><div><span class='widget_title'><span class='tracecheck'>&#x2713;</span> Account Information</span></div>
				<div class='pad10'>
					<table class='smallPad'>
						<tr><td><strong>First Name: </strong></td><td>$user_firstname</td></tr>
						<tr><td><strong>Last Name: </strong></td><td>$user_lastname</td></tr>
						<tr><td><strong>Email Address: </strong></td><td>$user_username</td></tr>
						<tr><td><strong>Company Name: </strong></td><td>$user_company</td></tr>
						<tr><td colspan='2' class='padt15'><em>If any of the above information is incorrect, please <a href='/contact-an-expert'>Contact Us</a>.</em></td></tr>
					</table>
				</div>
			</div>";

		echo '<div class="eight columns alpha" id="ChangePassword">'.pcud_form_display('11', 'Change Password').'</div>';
		}
	else {
		echo 'You must be logged in to view this page.<div class="clearfix marb15"></div>';
		echo pg_login_form();
		}



?>
					
					<div class="clear"></div>
					<div class="small right mart20">Is there a problem with this page? Help us fix it - <a href="/report-a-bug">Report a Bug</a></div>
					<div class="clear"></div>
			</div>
		</div>
	<?php  endwhile; endif; //have_posts ?>
<!-- END OF CONTENT CONTAINER -->
<?php get_footer(); ?>