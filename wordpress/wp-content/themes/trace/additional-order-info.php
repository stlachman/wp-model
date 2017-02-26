<?php
/* 
Template Name: Additional Order Info
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
<!-- TRACETEMPLATE INDEX -->
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
<?php
	$webroot = $_SERVER['DOCUMENT_ROOT'];
	define('INCLUDE_CHECK',true);
?>
<h1>Additional Order Info</h1>
<h3>To Complete Your Order, Please Provide the Information Below</h3>
<p>If you have not selected an AirCheck Kit from our <a href="/Products/AirCheck-Kits"><i class="aircheck">AirCheck<i class="tracecheck">&#x2713;</i> Kit&trade;</i> Products page</a>, please do so now. Your order will be complete when you have: 1) provided the additional information and 2) made payment through PayPal. You will receive an e-mail confirming that we have received your order and an estimated shipping date. If we have questions, we will contact you.</p>


<form id="signupForm2" name="frm" class="contact_form addinfo widelabel" method="post" action="/Process-Form">
	<input type="hidden" name="request" value="3" />
	
	<div class="eight columns form-div contact-wrap">
	
		<label for="ContactOrganization">Company<span>*</span></label>
		<input type="text" name="Organization" id="ContactOrganization" placeholder="Company Name..." required />
	</div>
	<div class="clearfix"></div>
	
	<div class="eight columns form-div contact-wrap right-border">
		<h2>Primary Contact</h2>
		
		<label for="ContactFirstName">First Name<span>*</span></label>
		<input type="text" name="FirstName" id="ContactFirstName" placeholder="First Name..." required />
		
		<label for="ContactLastName">Last Name<span>*</span></label>
		<input type="text" name="LastName" id="ContactLastName" placeholder="Last Name..." required />
		
		<label for="ContactEmail">Email<span>*</span></label>
		<input type="email" name="Email" id="ContactEmail" placeholder="Email..." required />
		
		<label for="ContactPhone">Phone<span>*</span></label>
		<input type="tel" name="Phone" id="ContactPhone" placeholder="Phone..." required />
		
		<label for="ContactMobile">Mobile</label>
		<input type="tel" name="Mobile" id="ContactMobile" placeholder="Mobile..." />
		
		<label for="ContactFax">Fax</label>
		<input type="tel" name="Fax" id="ContactFax" placeholder="Fax..."  />
	</div>
	<div class="eight columns form-div contact-wrap">
		<h2>Secondary Contact (optional)</h2>
		
		<label for="AltContactFirstName">First Name</label>
		<input type="text" name="AltFirstName" id="AltContactFirstName" placeholder="First Name..." />
		
		<label for="AltContactLastName">Last Name</label>
		<input type="text" name="AltLastName" id="AltContactLastName" placeholder="Last Name..." />
		
		<label for="AltContactEmail">Email</label>
		<input type="email" name="AltEmail" id="AltContactEmail" placeholder="Email..." />
		
		<label for="AltContactPhone">Phone</label>
		<input type="tel" name="AltPhone" id="AltContactPhone" placeholder="Phone..." />
		
		<label for="AltContactMobile">Mobile</label>
		<input type="tel" name="AltMobile" id="AltContactMobile" placeholder="Mobile..." />
		
		<label for="AltContactFax">Fax</label>
		<input type="tel" name="AltFax" id="AltContactFax" placeholder="Fax..."  />
		
	</div>

	<div class="eight columns form-div contact-wrap">
		<h2>Mailing Address</h2>
		<p>If your mailing address is different than the shipping address provided to PayPal, please enter it below:</p>
		
		<label for="MailingAddress">Address</label>
		<input type="text" name="MailingAddress" id="MailingAddress" placeholder="Address..." />
		
		<label for="MailingCity">City</label>
		<input type="text" name="MailingCity" id="MailingCity" placeholder="City..." />
		
		<label for="MailingState">State</label>
		<select name="MailingState" id="MailingState">
<?php include $webroot.'/php/states.php'; ?>
		</select>
		
		<label for="MailingZip">Zip Code</label>
		<input type="text" name="MailingZip" id="MailingZip" placeholder="Zip..." />
		
		<label for="MailingCountry">Country</label>
		<select name="MailingCountry" id="MailingCountry" size="1" >
<?php include $webroot.'/php/countries.php'; ?>
		</select>
		
		<h4 class="error errMsg1" style="display:none;">Please correct any highlighted fields above.</h4>
		<div class="clearfix"></div>
		<input id="submit-contact-1" type="submit" class="small blue button right" value="Submit Form" />
	</div>
</form>
					<div class="clear"></div>
					<div class="small right mart20">Is there a problem with this page? Help us fix it - <a href="/report-a-bug">Report a Bug</a></div>
					<div class="clear"></div>
			</div>
		</div>
<!-- END OF CONTENT CONTAINER -->
<?php get_footer(); ?>