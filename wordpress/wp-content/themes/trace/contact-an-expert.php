<?php
/* 
Template Name: Contact An Expert
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
	if (isset($_POST['PhoneRequest'])) { $PhoneRequest = $_POST['PhoneRequest']; }
	if (isset($_POST['Info'])) { $Info = $_POST['Info']; }
	if (isset($_POST['QuoteRequest'])) { $QuoteRequest = $_POST['QuoteRequest']; }
?>
<div class="sixteen columns alpha omega">
	<h1><?php
			if (isset($_POST['QuoteRequest'])) { echo $QuoteRequest; }
			else echo 'Contact an Expert'; 
		?>
	</h1>
	<?php
		if (isset($_POST['QuoteRequest'])) { echo '<p class="marb0">Please fill out the form below so that we can answer your '.$QuoteRequest.'. Contact us using the form below, and we\'ll get back to you within one business day - usually much faster!</p>'; }
		else echo '<p>Have questions? Contact us using the form below. We will get back to you within one business day - usually much faster!</p>';
	?>
</div>
<?php if ( (!isset($_POST['PhoneRequest'])) && (!isset($_POST['Info'])) && (!isset($_POST['QuoteRequest'])) ) { ?>
<div class="eight columns alpha">
	<h3>Get in Touch</h3>

	<form class="contact_form halfwidth">
		<label for="field65464589"><input type="radio" id="field65464589" name="customer" checked onClick="toggle_it('pr1')" value="information">I would like Information</label>
		<label for="field98735323"><input type="radio" id="field98735323" name="customer" onClick="toggle_it('pr2')" value="customer">I am a Current Customer</label>
	</form>
</div>
<div class="eight columns omega">
	<h3>Trace Analytics Address &amp; Phone:</h3>
	<div class="four columns alpha">
		Phone: (800) 247-1024<br />
		Fax: (512) 263-0002				</div>
	<div class="four columns alpha">
		15768 Hamilton Pool Rd.<br />
		Austin, TX 78738
	</div>
</div>
<?php } ?>
<div class="clearfix"></div>
<hr />
<div id="pr1" class="form-div contact-wrap">
	<form id="signupForm" class="contact_form" name="frm" method="post" action="/Process-Form">
	<fieldset>
	<div class="eight columns alpha">
		<input type="hidden" name="request" value="1" />
		<?php
			if (isset($_POST['Info'])) { echo "<input type='hidden' name='Info' value='".$Info."' />\n"; }
			if (isset($_POST['QuoteRequest'])) { echo "<input type='hidden' name='QuoteRequest' value='".$QuoteRequest."' />\n"; }
		?>
		<label for="ContactFirstName">First Name<span>*</span></label>
		<input type="text" name="FirstName" id="ContactFirstName" placeholder="First Name..." required />
		
		<label for="ContactLastName">Last Name<span>*</span></label>
		<input type="text" name="LastName" id="ContactLastName" placeholder="Last Name..." required />
		
		<label for="ContactPhone">Phone<span>*</span></label>
		<input type="tel" name="Phone" id="ContactPhone" placeholder="Phone..." required />
		
		<label for="ContactEmail">Email<span>*</span></label>
		<input type="email" name="Email" id="ContactEmail" placeholder="Email..." required />
		
		<label for="ContactOrganization">Company<span>*</span></label>
		<input type="text" name="Organization" id="ContactOrganization" placeholder="Company Name..." required />
		
		<label for="ContactJobTitle">Job Title</label>
		<input type="text" name="JobTitle" id="ContactJobTitle" placeholder="Job Title..." />
		
		<label for="ContactCity">City<span>*</span></label>
		<input type="text" name="City" id="ContactCity" placeholder="City..." required />

		<label for="ContactState">State/Province<span>*</span></label>
		<select name="State" id="ContactState" required >
<?php include $webroot.'/php/states.php'; ?>
		</select>
		
		<label for="ContactZipCode">ZIP Code</label>
		<input type="text" name="ZipCode" id="ContactZipCode" placeholder="ZIP Code..." />

		<label for="ContactCountry">Country<span>*</span></label>
		<select name="Country" id="ContactCountry" size="1" required >
<?php include $webroot.'/php/countries.php'; ?>
		</select>
		
		<p style="margin-bottom:0;"><strong>How should we contact you?</strong></p>
		<div class="halfwidth padl15 marb15">
			<label for="contactViaEmail"><input type="radio" id="contactViaEmail" name="contactVia" value="Email" <?php if (!isset($PhoneRequest)) { echo 'checked'; } ?>>Contact me via Email</label>
			<label for="contactViaPhone"><input type="radio" id="contactViaPhone" name="contactVia" value="Phone" <?php if ( (isset($PhoneRequest)) && ($PhoneRequest == '1')) { echo 'checked'; } ?>>Contact me via Phone</label>
		</div>
		
		<p style="margin-bottom:0;"><strong>Which program(s) are you interested in?</strong></p>
		<div class="brochure">
			
			<input type="checkbox" id="field9755741_3" name="brochure[]" value="ANDI" />
			<label class="fsOptionLabel" for="field9755741_3">ANDI</label>
			
			<input type="checkbox" id="field020202045" name="brochure[]" value="Automotive Manufacturing" />
			<label class="fsOptionLabel" for="field020202045">Automotive Manufacturing</label>
			
			<input type="checkbox" id="field9755741_4" name="brochure[]" value="Fire, General Industry &amp; Commercial Diving" />
			<label class="fsOptionLabel" for="field9755741_4">Fire, General Industry &amp; Commercial Diving</label>

			<input type="checkbox" id="field656479" name="brochure[]" value="Food and Beverage Compressed Air &amp; Gases" />
			<label class="fsOptionLabel" for="field656479">Food and Beverage Compressed Air &amp; Gases</label>
			
			<input type="checkbox" id="field9755741_6" name="brochure[]" value="ISO 8573 Air Sampling Program" />
			<label class="fsOptionLabel" for="field9755741_6">ISO 8573 Air Sampling Program</label>
			
			<input type="checkbox" id="field8484902320" name="brochure[]" value="Medical Device Compressed Gas Testing" />
			<label class="fsOptionLabel" for="field8484902320">Medical Device Compressed Gas Testing</label>
			
			<input type="checkbox" id="field848490390" name="brochure[]" value="Microbial Compressed Air &amp; Gases Testing" />
			<label class="fsOptionLabel" for="field848490390">Microbial Compressed Air &amp; Gases Testing</label>
			
			<input type="checkbox" id="field848490390224" name="brochure[]" value="MOD UK BS EN12021:2014" />
			<label class="fsOptionLabel" for="field848490390224">MOD UK BS EN12021:2014</label>
			
			<input type="checkbox" id="field97272738456" name="brochure[]" value="Nuclear" />
			<label class="fsOptionLabel" for="field97272738456">Nuclear</label>
			
			<input type="checkbox" id="field9755741_1" name="brochure[]" value="PADI Program" />
			<label class="fsOptionLabel" for="field9755741_1">PADI Program</label>
			
			<input type="checkbox" id="field9755741_2" name="brochure[]" value="PADI Canada Program" />
			<label class="fsOptionLabel" for="field9755741_2">PADI Canada Program</label>
			
			<input type="checkbox" id="field9755741_8" name="brochure[]" value="Pharmaceutical Manufacturing &amp; Distribution" />
			<label class="fsOptionLabel" for="field9755741_8">Pharmaceutical Manufacturing &amp; Distribution</label>
			
			<input type="checkbox" id="field975939002" name="brochure[]" value="SQF Air Purity" />
			<label class="fsOptionLabel" for="field975939002">SQF Air Purity</label>
			
			<input type="checkbox" id="field978876755" name="brochure[]" value="Other" />
			<label class="fsOptionLabel" for="field978876755">Other (Please explain below)</label>
			
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="eight columns omega">
		<p class="marb0 mart0"><strong>Which sampling method do you prefer?</strong></p>
		<div class="brochure">
			<input type="radio" id="ContactSampleSelf" name="SampleMethod" value="1" />
			<label for="ContactSampleSelf">I will take samples myself.</label>
			<div class="clearfix"></div>
			<input type="radio" id="ContactSampleDist" name="SampleMethod" value="2" />
			<label for="ContactSampleDist">I would like an <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span>&trade;</span> Service Distributor to take air samples.</label>
			<div class="clearfix"></div>
			<input type="radio" id="ContactSampleBecomeDist" name="SampleMethod" value="3" />
			<label for="ContactSampleBecomeDist">I would like to become an <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span>&trade;</span> Service Distributor.</label>
		</div>
		<div class="clearfix"></div>
		
		<p style="margin-bottom:0; margin-top:15px;"><strong>How many samples do you plan on taking? How often do you need to sample?</strong></p>
		<input type="text" name="SampleCount" id="ContactSampleCount" placeholder="How many samples &amp; how often..." />
		
		<p style="margin-bottom:0; margin-top:15px;"><strong>If applicable, please enter the Purity Class(es) [ __ : __ : __ ], Baseline Analysis, or Air Specification that you require. </strong></p>
		<input type="text" name="PurityClass" id="ContactPurityClass" placeholder="Purity Class [ __ : __ : __ ], Baseline Analysis, or Air Spec..." />
		
		<label for="ContactHowUse" class="wide100" style="margin-top:15px;"><strong>How do you use your compressed air or gases?</strong></label>
		<textarea id="ContactHowUse" name="HowUse" placeholder="How do you use your compressed air or gases?"></textarea>
		
		<label for="ContactHowHelp" class="wide100"><strong>How can we help you?</strong></label>
		<textarea id="ContactHowHelp" name="HowHelp" placeholder="How can we help you?"></textarea>
		
		<h4 class="error errMsg1" style="display:none;">Please correct any highlighted fields above.</h4>
		<div class="clearfix"></div>
		<div class="right"><input id="submit-contact-1" type="submit" class="blue button right" value="Submit Form" /></div>
	</div>

	</fieldset>
	</form>
</div>

<div id="pr2" style="display:none;" class="form-div contact-wrap">
	<form id="signupForm2" name="frm" class="contact_form widelabel" method="post" action="/Process-Form">
	<div class="eight columns">
		<?php
			if (isset($_POST['Info'])) { echo "<input type='hidden' name='Info' value='".$Info."' />\n"; }
			if (isset($_POST['QuoteRequest'])) { echo "<input type='hidden' name='QuoteRequest' value='".$QuoteRequest."' />\n"; }
		?>
		<h3 class="error marb15">To order supplies, please use our <a href="/products/restocks">Restocks Page</a>.</h3>
		
		<input type="hidden" name="request" value="2" />
		<label for="ContactFirstName2">First Name<span>*</span></label>
		<input type="text" name="FirstName" id="ContactFirstName2" placeholder="First Name..." required />
		
		<label for="ContactLastName2">Last Name<span>*</span></label>
		<input type="text" name="LastName" id="ContactLastName2" placeholder="Last Name..." required />
		
		<label for="ContactPhone2">Phone<span>*</span></label>
		<input type="tel" name="Phone" id="ContactPhone2" placeholder="Phone..." required />

		<label for="ContactEmail2">Email<span>*</span></label>
		<input type="email" name="Email" id="ContactEmail2" placeholder="Email..." required />
		
		<label for="ContactOrganization2">Company<span>*</span></label>
		<input type="text" name="Organization" id="ContactOrganization2" placeholder="Organization..." required />
		
		<label for="field9755420">Customer No.</label>
		<input type="text" id="field9755420" name="CustomerNo" placeholder="Customer Number..." />
		
		<label for="field9755417" class="wide100"><strong>How can we help you?</strong></label>
		<textarea id="field9755417" name="HowHelp" placeholder="How can we help you?" required ></textarea>

		<h4 class="error errMsg2" style="display:none;">Please correct any highlighted fields above.</h4>
		<div class="right">
			<input type="submit" class="blue button" value="Submit Form" />
		</div>
	</div>
	</form>
</div>
					<div class="clear"></div>
					<div class="small right mart20">Is there a problem with this page? Help us fix it - <a href="/report-a-bug">Report a Bug</a></div>
					<div class="clear"></div>
			</div>
		</div>
<!-- END OF CONTENT CONTAINER -->
<?php get_footer(); ?>