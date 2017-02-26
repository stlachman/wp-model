<?php
/* 
Template Name: Bug Report
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
<!-- TRACETEMPLATE CONTENT -->
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
	<div class="divide20"></div>
<!-- MAIN CONTENT CONTAINER	-->

	<div class="sixteen columns">
		
		<h1>Report a Bug</h1>
	
		<p>Noticed a bug or error on our website? Help us out by reporting it below! If you'd like to be notified when we have resolved your issue, please include your contact information below.</p>
		
		<p>If you've got a question or comment about our products or services, please use our <a href="/contact-an-expert">Contact Page</a> so that your request will be automatically routed to the correct department.</p>
		
		<?php $referer = $_SERVER['HTTP_REFERER']; ?>
		<div class="marb0" style="color:#777;"><strong>Referring Page:</strong> <?php echo $referer; ?></div>
	</div>
	
	<div class="twelve columns noborder marb20 padt0">
		<form id="bugReport" name="frm" class="contact_form addinfo widelabel" method="post" action="/Process-Bug-Report">
			<div id="contactus" style="width:100%">
				<input type="text" name="FirstName" id="ContactFirstName" placeholder="First Name..." class="InputBox requiredfield" />
				<input type="text" name="LastName" id="ContactLastName" placeholder="Last Name..." class="InputBox requiredfield" />
				<input type="email" name="Email" id="ContactEmail" placeholder="Email..." class="InputBox requiredfield" />
				<input type="text" name="Website" id= "WebSite" placeholder="Website/Social Media..." class="InputBox last requiredfield"/>
				<input type="hidden" name="ReferringPage" value="<?php echo $referer; ?>" />
				<textarea id="BugDescription" name="BugDescription" placeholder="Please describe the problem or error encountered." class="TextBox requiredfield last" required></textarea>
				<div id="yesorno" class="align-left">
			    <label for="yesorno">Have you reported a bug before?</label>
				<label for="yesbox">
				<input type="checkbox" id="yesbox" name="YesNoBox" value="Yes"/>
				Yes
				</label>
				<label for="nobox">
				<input type="checkbox" id="nobox" name="YesNoBox" value="No"/>
				No 
				</label>
				</div>
				<h4 class="error errMsg1" style="display:none;">Please correct any highlighted fields above.</h4>
				<div class="clearfix"></div>
				<noscript><h4 class="error errMsg2">Please enable JavaScript to continue</h4></noscript>
				<div class="clear"></div>
					<div class="align-right">
						<input type="submit" class="blue button" value="Submit Bug Report" />
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