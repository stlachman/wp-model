<?php
/* 
Template Name: Account Signup
*/

error_reporting(E_ALL);
ini_set('display_errors', 1);

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
<!-- TRACETEMPLATE ACCOUNT SIGNUP -->
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
?>
<div class="sixteen columns alpha omega">
	<h1>Account Signup</h1>
	<p>Please submit the form below to complete your New Account Signup.</p>
</div>
<div class="clearfix"></div>

<div id="pr1" class="form-div contact-wrap">
	<form id="signupForm" class="contact_form" name="frm" method="post" action="/Process-Account-Signup" target="_window2">
	<fieldset>
	<div class="sixteen columns">
		<input type="hidden" name="AccountType" value="ISO" />
		<hr />
		<h1>Company Information</h1>
	</div>
	<div class="eight columns">
		<label class="wide100" for="ContactCompanyName">Company Name<span>*</span></label>
		<input class="wide100" type="text" name="CompanyName" id="ContactCompanyName" placeholder="Company Name..." requiredNOT />
		
		<label class="wide100" for="ContactCompanyType">Company Type<span>*</span></label>
		<select class="wide100" name="CompanyType" id="ContactCompanyType" requiredNOT >
<?php include $webroot.'/php/companytypes.php'; ?>
		</select>
		
		<label class="wide100" for="ContactDirectKit">Send this kit directly to your customer? <span>*</span></label>
		<select class="wide100" name="DirectKit" id="ContactDirectKit" requiredNOT >
<?php include $webroot.'/php/yesno.php'; ?>
		</select>

		<label class="wide100" for="Website">Website<span>*</span></label>
		<input class="wide100" type="text" name="Website" id="Website" placeholder="Website..." requiredNOT />
		
		<p style="margin-bottom:0;">Do you use social media?</p>
		<div class="brochure">
			<input type="checkbox" id="field9755741_3" name="social[]" value="Facebook" />
			<label class="fsOptionLabel" for="field9755741_3">Facebook</label>
			
			<input type="checkbox" id="field020202045" name="social[]" value="LinkedIn" />
			<label class="fsOptionLabel" for="field020202045">LinkedIn</label>
			
			<input type="checkbox" id="field9755741_4" name="social[]" value="Pinterest" />
			<label class="fsOptionLabel" for="field9755741_4">Pinterest</label>

			<input type="checkbox" id="field656479" name="social[]" value="Twitter" />
			<label class="fsOptionLabel" for="field656479">Twitter</label>
		</div>
	</div>
	<div class="eight columns">
		<label class="wide100" for="HowFind">How did you find us?<span>*</span></label>
		<select class="wide100" name="HowFind" id="HowFind" requiredNOT >
			<option value="" label="Select One"></option>
			<option value="Customer Referral">Customer Referral</option>
			<option value="Email Advertising">Email Advertising</option>
			<option value="Internet Search">Internet Search</option>
			<option value="Magazine Ad">Magazine Ad</option>
			<option value="Other">Other</option>
		</select>
		
		<label class="wide100" for="HowFindOther">Who referred you / Other<span>*</span></label>
		<input class="wide100" type="text" name="HowFindOther" id="HowFindOther" placeholder="..." requiredNOT />
		
		<label class="wide100" for="TestedPreviously">Have you tested compressed air previously?<span>*</span></label>
		<select class="wide100" name="TestedPreviously" id="TestedPreviously" requiredNOT >
<?php include $webroot.'/php/yesno.php'; ?>
		</select>
		
		<label class="wide100" for="TestedPreviouslyLabs">If yes, which lab(s) have you used?<span>*</span></label>
		<input class="wide100" type="text" name="TestedPreviouslyLabs" id="TestedPreviouslyLabs" placeholder="Previously used laboratories..." requiredNOT />
		
	</div>
	
	<div class="sixteen columns">
		<hr />
		<h1>Account Type</h1>
	</div>
	<div class="eight columns">
		<label class="wide100" for="Industry">What is your industry?<span>*</span></label>
		<select class="wide100" name="Industry" id="Industry" requiredNOT >
			<option value="" label="Select One"></option>
			<option value="Breathing Air">Breathing Air</option>
			<option value="Compressor Manufacturer">Compressor Manufacturer</option>
			<option value="Food Manufacturing">Food Manufacturing</option>
			<option value="ISO 8573">ISO 8573</option>
			<option value="Manufacturing">Manufacturing</option>
			<option value="Medical Gas">Medical Gas</option>
			<option value="Nuclear">Nuclear</option>
			<option value="Pharmaceutical">Pharmaceutical</option>
			<option value="Pure Gas">Pure Gas</option>
		</select>
	</div>
	<div class="eight columns">
		<label class="wide100" for="Spec">Compressed Air / Gas Specification (if known)<span>*</span></label>
		<input class="wide100" type="text" name="Spec" id="Spec" placeholder="Specification..." requiredNOT />
	</div>
	<div class="sixteen columns">
		
		<hr />
		
		<h1>Authorized Contacts</h1>
		<p>Primary and Alternate Contacts are considered Authorized Contacts. Reports and other account information will be emailed and discussed with Authorized Contacts only.</p>
	</div>
	<div class="eight columns">
		
		<h2 class="mart20">Primary Contact</h2>

		<label for="PrimaryContactFirstName">First Name<span>*</span></label>
		<input type="text" name="PrimaryFirstName" id="PrimaryContactFirstName" placeholder="First Name..." requiredNOT />
		
		<label for="PrimaryContactLastName">Last Name<span>*</span></label>
		<input type="text" name="PrimaryLastName" id="PrimaryContactLastName" placeholder="Last Name..." requiredNOT />
		
		<label for="PrimaryContactJobTitle">Job Title</label>
		<input type="text" name="PrimaryJobTitle" id="PrimaryContactJobTitle" placeholder="Job Title..." />
		
		<label for="PrimaryContactDirectPhone">Direct Phone<span>*</span></label>
		<input type="tel" name="PrimaryDirectPhone" id="PrimaryContactDirectPhone" placeholder="Direct Phone..." requiredNOT />
		
		<label for="PrimaryContactDirectPhoneExtension">Extension<span>*</span></label>
		<input type="tel" name="PrimaryDirectPhoneExtension" id="PrimaryContactDirectPhoneExtension" placeholder="Extension..." requiredNOT />
		
		<label for="PrimaryContactMobilePhone">Mobile Phone<span>*</span></label>
		<input type="tel" name="PrimaryMobilePhone" id="PrimaryContactMobilePhone" placeholder="Mobile Phone..." requiredNOT />
		
		<label for="PrimaryContactEmail">Email<span>*</span></label>
		<input type="email" name="PrimaryEmail" id="PrimaryContactEmail" placeholder="Email..." requiredNOT />
		
		<label for="PrimaryContactEmailInfo">Email Type<span>*</span></label>
		<select name="PrimaryContactEmailInfo" id="PrimaryContactEmailInfo" requiredNOT >
<?php include $webroot.'/php/emailtypes.php'; ?>
		</select>
		
	</div>
	<div class="eight columns">
		<h2 class="mart20">Alternate Contact 1</h2>

		<label for="Alternate1ContactFirstName">First Name<span>*</span></label>
		<input type="text" name="Alternate1FirstName" id="Alternate1ContactFirstName" placeholder="First Name..." requiredNOT />
		
		<label for="Alternate1ContactLastName">Last Name<span>*</span></label>
		<input type="text" name="Alternate1LastName" id="Alternate1ContactLastName" placeholder="Last Name..." requiredNOT />
		
		<label for="Alternate1ContactJobTitle">Job Title</label>
		<input type="text" name="Alternate1JobTitle" id="Alternate1ContactJobTitle" placeholder="Job Title..." />
		
		<label for="Alternate1ContactDirectPhone">Direct Phone<span>*</span></label>
		<input type="tel" name="Alternate1DirectPhone" id="Alternate1ContactDirectPhone" placeholder="Direct Phone..." requiredNOT />
		
		<label for="Alternate1ContactDirectPhoneExtension">Extension<span>*</span></label>
		<input type="tel" name="Alternate1DirectPhoneExtension" id="Alternate1ContactDirectPhoneExtension" placeholder="Extension..." requiredNOT />
		
		<label for="Alternate1ContactMobilePhone">Mobile Phone<span>*</span></label>
		<input type="tel" name="Alternate1MobilePhone" id="Alternate1ContactMobilePhone" placeholder="Mobile Phone..." requiredNOT />
		
		<label for="Alternate1ContactEmail">Email<span>*</span></label>
		<input type="email" name="Alternate1Email" id="Alternate1ContactEmail" placeholder="Email..." requiredNOT />
		
		<label for="Alternate1ContactEmailInfo">Email Type<span>*</span></label>
		<select name="Alternate1ContactEmailInfo" id="Alternate1ContactEmailInfo" requiredNOT >
<?php include $webroot.'/php/emailtypes.php'; ?>
		</select>
		
	</div>
	<div class="eight columns">
		<h2 class="mart20">Alternate Contact 2</h2>

		<label for="Alternate2ContactFirstName">First Name<span>*</span></label>
		<input type="text" name="Alternate2FirstName" id="Alternate2ContactFirstName" placeholder="First Name..." requiredNOT />
		
		<label for="Alternate2ContactLastName">Last Name<span>*</span></label>
		<input type="text" name="Alternate2LastName" id="Alternate2ContactLastName" placeholder="Last Name..." requiredNOT />
		
		<label for="Alternate2ContactJobTitle">Job Title</label>
		<input type="text" name="Alternate2JobTitle" id="Alternate2ContactJobTitle" placeholder="Job Title..." />
		
		<label for="Alternate2ContactDirectPhone">Direct Phone<span>*</span></label>
		<input type="tel" name="Alternate2DirectPhone" id="Alternate2ContactDirectPhone" placeholder="Direct Phone..." requiredNOT />
		
		<label for="Alternate2ContactDirectPhoneExtension">Extension<span>*</span></label>
		<input type="tel" name="Alternate2DirectPhoneExtension" id="Alternate2ContactDirectPhoneExtension" placeholder="Extension..." requiredNOT />
		
		<label for="Alternate2ContactMobilePhone">Mobile Phone<span>*</span></label>
		<input type="tel" name="Alternate2MobilePhone" id="Alternate2ContactMobilePhone" placeholder="Mobile Phone..." requiredNOT />
		
		<label for="Alternate2ContactEmail">Email<span>*</span></label>
		<input type="email" name="Alternate2Email" id="Alternate2ContactEmail" placeholder="Email..." requiredNOT />
		
		<label for="Alternate2ContactEmailInfo">Email Type<span>*</span></label>
		<select name="Alternate2ContactEmailInfo" id="Alternate2ContactEmailInfo" requiredNOT >
<?php include $webroot.'/php/emailtypes.php'; ?>
		</select>
		
	</div>
	<div class="eight columns">
			
		<h2 class="mart20">Billing Contact</h2>

		<label for="BillingContactFirstName">First Name<span>*</span></label>
		<input type="text" name="BillingFirstName" id="BillingContactFirstName" placeholder="First Name..." requiredNOT />
		
		<label for="BillingContactLastName">Last Name<span>*</span></label>
		<input type="text" name="BillingLastName" id="BillingContactLastName" placeholder="Last Name..." requiredNOT />
		
		<label for="BillingContactJobTitle">Job Title</label>
		<input type="text" name="BillingJobTitle" id="BillingContactJobTitle" placeholder="Job Title..." />
		
		<label for="BillingContactDirectPhone">Direct Phone<span>*</span></label>
		<input type="tel" name="BillingDirectPhone" id="BillingContactDirectPhone" placeholder="Direct Phone..." requiredNOT />
		
		<label for="BillingContactDirectPhoneExtension">Extension<span>*</span></label>
		<input type="tel" name="BillingDirectPhoneExtension" id="BillingContactDirectPhoneExtension" placeholder="Extension..." requiredNOT />
		
		<label for="BillingContactMobilePhone">Mobile Phone<span>*</span></label>
		<input type="tel" name="BillingMobilePhone" id="BillingContactMobilePhone" placeholder="Mobile Phone..." requiredNOT />
		
		<label for="BillingContactEmail">Email<span>*</span></label>
		<input type="email" name="BillingEmail" id="BillingContactEmail" placeholder="Email..." requiredNOT />
		
		<label for="BillingContactEmailInfo">Email Type<span>*</span></label>
		<select name="BillingContactEmailInfo" id="BillingContactEmailInfo" requiredNOT >
<?php include $webroot.'/php/emailtypes.php'; ?>
		</select>
		
	</div>
	<div class="eight columns">
		<h2 class="mart20">Shipping Contact</h2>

		<label for="ShippingContactFirstName">First Name<span>*</span></label>
		<input type="text" name="ShippingFirstName" id="ShippingContactFirstName" placeholder="First Name..." requiredNOT />
		
		<label for="ShippingContactLastName">Last Name<span>*</span></label>
		<input type="text" name="ShippingLastName" id="ShippingContactLastName" placeholder="Last Name..." requiredNOT />
		
		<label for="ShippingContactJobTitle">Job Title</label>
		<input type="text" name="ShippingJobTitle" id="ShippingContactJobTitle" placeholder="Job Title..." />
		
		<label for="ShippingContactDirectPhone">Direct Phone<span>*</span></label>
		<input type="tel" name="ShippingDirectPhone" id="ShippingContactDirectPhone" placeholder="Direct Phone..." requiredNOT />
		
		<label for="ShippingContactDirectPhoneExtension">Extension<span>*</span></label>
		<input type="tel" name="ShippingDirectPhoneExtension" id="ShippingContactDirectPhoneExtension" placeholder="Extension..." requiredNOT />
		
		<label for="ShippingContactMobilePhone">Mobile Phone<span>*</span></label>
		<input type="tel" name="ShippingMobilePhone" id="ShippingContactMobilePhone" placeholder="Mobile Phone..." requiredNOT />
		
		<label for="ShippingContactEmail">Email<span>*</span></label>
		<input type="email" name="ShippingEmail" id="ShippingContactEmail" placeholder="Email..." requiredNOT />
		
		<label for="ShippingContactEmailInfo">Email Type<span>*</span></label>
		<select name="ShippingContactEmailInfo" id="ShippingContactEmailInfo" requiredNOT >
<?php include $webroot.'/php/emailtypes.php'; ?>
		</select>
		

	</div>
	<div class="clearfix"></div>

	<hr />

	<div class="eight columns">
		<h2 class="mart20">Sampling Technicians</h2>

		<label for="SamplingTech1ContactFirstName">First Name<span>*</span></label>
		<input type="text" name="SamplingTech1FirstName" id="SamplingTech1ContactFirstName" placeholder="First Name..." requiredNOT />
		
		<label for="SamplingTech1ContactLastName">Last Name<span>*</span></label>
		<input type="text" name="SamplingTech1LastName" id="SamplingTech1ContactLastName" placeholder="Last Name..." requiredNOT />
		
		<label for="SamplingTech1ContactEmail">Email<span>*</span></label>
		<input type="email" name="SamplingTech1Email" id="SamplingTech1ContactEmail" placeholder="Email..." requiredNOT />

		<label for="SamplingTech1ContactMobilePhone">Mobile Phone<span>*</span></label>
		<input type="tel" name="SamplingTech1MobilePhone" id="SamplingTech1ContactMobilePhone" placeholder="Mobile Phone..." requiredNOT />
		
		
		<label class="mart20" for="SamplingTech2ContactFirstName">First Name<span>*</span></label>
		<input class="mart20" type="text" name="SamplingTech2FirstName" id="SamplingTech2ContactFirstName" placeholder="First Name..." requiredNOT />
		
		<label for="SamplingTech2ContactLastName">Last Name<span>*</span></label>
		<input type="text" name="SamplingTech2LastName" id="SamplingTech2ContactLastName" placeholder="Last Name..." requiredNOT />
		
		<label for="SamplingTech2ContactEmail">Email<span>*</span></label>
		<input type="email" name="SamplingTech2Email" id="SamplingTech2ContactEmail" placeholder="Email..." requiredNOT />

		<label for="SamplingTech2ContactMobilePhone">Mobile Phone<span>*</span></label>
		<input type="tel" name="SamplingTech2MobilePhone" id="SamplingTech2ContactMobilePhone" placeholder="Mobile Phone..." requiredNOT />
		
		
		<label class="mart20" for="SamplingTech3ContactFirstName">First Name<span>*</span></label>
		<input class="mart20" type="text" name="SamplingTech3FirstName" id="SamplingTech3ContactFirstName" placeholder="First Name..." requiredNOT />
		
		<label for="SamplingTech3ContactLastName">Last Name<span>*</span></label>
		<input type="text" name="SamplingTech3LastName" id="SamplingTech3ContactLastName" placeholder="Last Name..." requiredNOT />
		
		<label for="SamplingTech3ContactEmail">Email<span>*</span></label>
		<input type="email" name="SamplingTech3Email" id="SamplingTech3ContactEmail" placeholder="Email..." requiredNOT />

		<label for="SamplingTech3ContactMobilePhone">Mobile Phone<span>*</span></label>
		<input type="tel" name="SamplingTech3MobilePhone" id="SamplingTech3ContactMobilePhone" placeholder="Mobile Phone..." requiredNOT />
		
	</div>
	<div class="clearfix"></div>
	<div class="sixteen columns">
		<hr />
		<h1>Physical Addresses</h1>
	</div>
	<div class="eight columns">
		<h2 class="mart20">Accounts Payable Address</h2>
		
		<label for="AcctsPayableStreet">Street<span>*</span></label>
		<input type="text" name="AcctsPayableStreet" id="AcctsPayableStreet" placeholder="Street..." requiredNOT />
		
		<label for="AcctsPayableStreet2">Street 2<span>*</span></label>
		<input type="text" name="AcctsPayableStreet2" id="AcctsPayableStreet2" placeholder="Street2..." requiredNOT />
		
		<label for="AcctsPayableCity">City<span>*</span></label>
		<input type="text" name="AcctsPayableCity" id="AcctsPayableCity" placeholder="City..." requiredNOT />
		
		<label for="AcctsPayableState">State/Province<span>*</span></label>
		<select name="AcctsPayableState" id="AcctsPayableState" requiredNOT >
<?php include $webroot.'/php/states.php'; ?>
		</select>
		
		<label for="AcctsPayableZipCode">ZIP Code</label>
		<input type="text" name="AcctsPayableZipCode" id="AcctsPayableZipCode" placeholder="ZIP Code..." />

		<label for="AcctsPayableCountry">Country<span>*</span></label>
		<select name="AcctsPayableCountry" id="AcctsPayableCountry" size="1" requiredNOT >
<?php include $webroot.'/php/countries.php'; ?>
		</select>
	</div>
	
	<div class="eight columns">
		<h2 class="mart20">Shipping Address</h2>
		
		<label for="ShippingStreet">Street<span>*</span></label>
		<input type="text" name="ShippingStreet" id="ShippingStreet" placeholder="Street..." requiredNOT />
		
		<label for="ShippingStreet2">Street 2<span>*</span></label>
		<input type="text" name="ShippingStreet2" id="ShippingStreet2" placeholder="Street2..." requiredNOT />
		
		<label for="ShippingCity">City<span>*</span></label>
		<input type="text" name="ShippingCity" id="ShippingCity" placeholder="City..." requiredNOT />
		
		<label for="ShippingState">State/Province<span>*</span></label>
		<select name="ShippingState" id="ShippingState" requiredNOT >
<?php include $webroot.'/php/states.php'; ?>
		</select>
		
		<label for="ShippingZipCode">ZIP Code</label>
		<input type="text" name="ShippingZipCode" id="ShippingZipCode" placeholder="ZIP Code..." />

		<label for="ShippingCountry">Country<span>*</span></label>
		<select name="ShippingCountry" id="ShippingCountry" size="1" requiredNOT >
<?php include $webroot.'/php/countries.php'; ?>
		</select>
	</div>
	
	<div class="eight columns">
		<h2 class="mart20">Mailing Address</h2>
		
		<label for="MailingStreet">Street<span>*</span></label>
		<input type="text" name="MailingStreet" id="MailingStreet" placeholder="Street..." requiredNOT />
		
		<label for="MailingStreet2">Street 2<span>*</span></label>
		<input type="text" name="MailingStreet2" id="MailingStreet2" placeholder="Street2..." requiredNOT />
		
		<label for="MailingCity">City<span>*</span></label>
		<input type="text" name="MailingCity" id="MailingCity" placeholder="City..." requiredNOT />
		
		<label for="MailingState">State/Province<span>*</span></label>
		<select name="MailingState" id="MailingState" requiredNOT >
<?php include $webroot.'/php/states.php'; ?>
		</select>
		
		<label for="MailingZipCode">ZIP Code</label>
		<input type="text" name="MailingZipCode" id="MailingZipCode" placeholder="ZIP Code..." />

		<label for="MailingCountry">Country<span>*</span></label>
		<select name="MailingCountry" id="MailingCountry" size="1" requiredNOT >
<?php include $webroot.'/php/countries.php'; ?>
		</select>
	</div>
	<div class="clearfix"></div>
	
	<hr />
	
	<div class="sixteen columns">
		<h2>Service Area</h2>
		<label for="ServiceArea" class="wide100">If you are a distributor, please provide us with a detailed description of your service area:</label>
		<textarea id="ServiceArea" name="ServiceArea" placeholder="Service Area"></textarea>
	</div>
	
	<div class="clearfix"></div>
	
	<hr />
	
	<div class="sixteen columns">
		<h2>Order Info</h2>
		<p>A Purchase Order is required for all orders except Credit Card, PayPal, or Wire Transfer Orders. All part numbers, prices, descriptions, including Blanks and other items that may be of no charge, must be listed on the PO to process your order. Billing terms are Net 30 days. All rentals require a valid credit card on file and are billed upon shipment. International orders require pre-payment. All shipping fees, wire transfer fees (from either parties’ financial institution), customs fees, and any other associated fees are the sole responsibility of the Customer.</p>
	</div>
	
	<div class="eight columns">
		<label for="PONumber">PO #<span>*</span></label>
		<input type="text" name="PONumber" id="PONumber" placeholder="PO #..." requiredNOT />

		<label for="QuoteNumber">Quote #<span>*</span></label>
		<input type="text" name="QuoteNumber" id="QuoteNumber" placeholder="Quote #..." requiredNOT />

		<label for="POAmount">PO Amount<span>*</span></label>
		<input type="text" name="POAmount" id="POAmount" placeholder="PO Amount..." requiredNOT />
	</div>
	<div class="eight columns">
		<label for="CreditCardNo">Credit Card #<span>*</span></label>
		<input type="text" name="CreditCardNo" id="CreditCardNo" placeholder="Credit Card #..." requiredNOT />
		
		<label for="CreditCardCVV">CVV<span>*</span></label>
		<input type="text" name="CreditCardCVV" id="CreditCardCVV" placeholder="CVV..." requiredNOT />
		
		<label for="CreditCardExp">Expiration<span>*</span></label>
		<input type="text" name="CreditCardExp" id="CreditCardExp" placeholder="Expiration..." requiredNOT />
	</div>
	
	<div class="eight columns">
		<label class="wide100 mart20" for="BillingInstructions">Billing Instructions<span>*</span></label>
		<select class="wide100" name="BillingInstructions" id="BillingInstructions" requiredNOT >
			<option value="" label="Select One"></option>
			<option value="RENTAL - Billed Upon Shipment Only">RENTAL - Billed Upon Shipment Only</option>
			<option value="PURCHASE - Bill Supplies and Analysis Upon Shipment">PURCHASE - Bill Supplies and Analysis Upon Shipment</option>
			<option value="PURCHASE - Bill Supplies First and Analysis Separate">PURCHASE - Bill Supplies First &amp; Analysis Separate</option>
			<option value="Not Sure - please contact me to discuss">Not Sure - please contact me to discuss.</option>
		</select>
		
		<label class="wide100" for="TestingFrequency">Testing Frequency<span>*</span></label>
		<select class="wide100" name="TestingFrequency" id="TestingFrequency" requiredNOT >
			<option value="" label="Select One">Select One</option>
			<option value="Annually">Annually</option>
			<option value="Semi-Annually">Semi-Annually</option>
			<option value="Quarterly">Quarterly</option>
			<option value="Randomly">Randomly</option>
			<option value="One Time Only">One Time Only</option>
			<option value="Undecided">Undecided</option>
		</select>
		
		<label class="wide100" for="RentalOrPurchase">Kit Rental or Purchase<span>*</span></label>
		<select class="wide100" name="RentalOrPurchase" id="RentalOrPurchase" requiredNOT >
			<option value="" label="Select One">Select One</option>
			<option value="Rental">Rental - Billed Upon Shipment</option>
			<option value="Purchase">Purchase</option>
		</select>
		
		<label class="wide100" for="ShipCarrier">Preferred Shipping Carrier<span>*</span></label>
		<select class="wide100" name="ShipCarrier" id="ShipCarrier" requiredNOT >
			<option value="" label="Select One">Select One</option>
			<option value="UPS">UPS</option>
			<option value="FedEx">FedEx</option>
			<option value="DHL">DHL</option>
			<option value="Other">Other</option>
		</select>
		
		<label class="wide100" for="OtherShipCarrier">Other Shipping Carrier<span>*</span></label>
		<input class="wide100" type="text" name="OtherShipCarrier" id="OtherShipCarrier" placeholder="Other Shipping Carrier..." requiredNOT />
		
		<label class="wide100" for="ShipSpeed">Preferred Shipping Speed<span>*</span></label>
		<select class="wide100" name="ShipSpeed" id="ShipSpeed" requiredNOT >
			<option value="" label="Select One">Select One</option>
			<option value="Ground">Ground</option>
			<option value="3 Day">3 Day</option>
			<option value="2 Day">2 Day</option>
			<option value="Next Day - Standard">Next Day - Standard</option>
			<option value="Next Day - AM">Next Day - AM</option>
		</select>
		
		<label class="wide100" for="ShippingPayMethod">Shipping Payment Method<span>*</span></label>
		<select class="wide100" name="ShippingPayMethod" id="ShippingPayMethod" requiredNOT >
			<option value="" label="Select One">Select One</option>
			<option value="Use My Shipping Account">Use My Shipping Account</option>
			<option value="Add to each PO">Add to each PO</option>
			<option value="Non-US Orders Must Provide Shipping Acct">Non-US Orders Must Provide Shipping Acct. #</option>
		</select>
		
		<label class="wide100" for="ShippingAcctNo">Shipping Account No.<span>*</span></label>
		<input class="wide100" type="text" name="ShippingAcctNo" id="OtherShippingMethod" placeholder="Shipping Account No..." requiredNOT />

	</div>
	
	<hr />
	
	<div class="eight columns">
		<label for="Comments" class="wide100"><strong>Additional Comments:</strong></label>
		<textarea id="Comments" name="Comments" placeholder="Additional Comments..."></textarea>
		
		<p>Thank you for your order! We look forward to working with you.</p>
		
		<h4 class="error errMsg1" style="display:none;">Please correct any highlighted fields above.</h4>
		<div class="clearfix"></div>
		<div class="right"><input id="submit-contact-1" type="submit" class="blue button right" value="Submit Form" /></div>
	</div>

	</fieldset>
	</form>
</div>

					<div class="clear"></div>
					<div class="small right mart20">Is there a problem with this page? Help us fix it - <a href="/report-a-bug">Report a Bug</a></div>
					<div class="clear"></div>
			</div>
		</div>
<!-- END OF CONTENT CONTAINER -->
<?php //JAS get_footer(); ?>