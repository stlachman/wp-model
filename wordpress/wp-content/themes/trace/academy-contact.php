<?php
/* 
Template Name: Academy Contact
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
<!-- TRACETEMPLATE ACADEMY CONTACT -->
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
					?></div>
				<div class="clear"></div>								
			</div>
			<div class="clear"></div>								
		</div>
	</div>
<?php } ?>

	<div class="clear"></div>
	<div class="divide20"></div>
<!-- MAIN CONTENT CONTAINER	-->

	<div class="sixteen columns">
		
		<h1><span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Academy&trade;</span> Help</h1>
	
		<p>Do you have a suggestion, question, or problem regarding the <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Academy&trade;</span>? Fill out the form below and one of our experts will get back to you right away! If you've got a question about our products or services, please use our <a href="/contact-an-expert">Contact Page</a> so that your request will be automatically routed to the correct department.</p>
		
		<?php
			$referer = $_SERVER['HTTP_REFERER'];

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
				}

		?>
		<div class="marb0" style="color:#777;"><strong>Referring Page:</strong> <?php echo $referer; ?></div>
	</div>
	
	<div class="eleven columns noborder marb20 padt0">
		<form id="bugReport" name="frm" class="contact_form addinfo widelabel" method="post" action="/aircheck-academy/process-academy-contact">
			<div id="contactus" style="width:100%">
				<input type="text" name="FirstName" id="ContactFirstName" placeholder="First Name..." class="InputBox requiredfield" <?php if(isset($_SESSION['pg_user_id'])) { echo "value='$user_firstname'"; } ?> />
				<input type="text" name="LastName" id="ContactLastName" placeholder="Last Name..." class="InputBox requiredfield" <?php if(isset($_SESSION['pg_user_id'])) { echo "value='$user_lastname'"; } ?> />
				<input type="email" name="Email" id="ContactEmail" placeholder="Email..." class="InputBox last requiredfield" <?php if(isset($_SESSION['pg_user_id'])) { echo "value='$user_username'"; } ?> />
				<input type="hidden" name="ReferringPage" value="<?php echo $referer; ?>" />
				<textarea id="BugDescription" name="BugDescription" placeholder="Please describe the question or problem." class="TextBox requiredfield last" required></textarea>
				<h4 class="error errMsg1" style="display:none;">Please correct any highlighted fields above.</h4>
				<div class="clearfix"></div>
				<noscript><h4 class="error errMsg2">Please enable JavaScript to continue</h4></noscript>
					<div class="align-right">
						<input type="submit" class="blue button" value="Submit" />
					</div>
			</div>
		</form>
	</div>

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
			</div>
		</div>
<!-- END OF CONTENT CONTAINER -->
<?php get_footer(); ?>