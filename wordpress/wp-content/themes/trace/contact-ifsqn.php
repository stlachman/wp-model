<?php
/* 
Template Name: Contact - IFSQN
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

<h1>Thank you, IFSQN!</h1>
<h2 class="marb0">$75 Off Food Grade Air Testing</h2>
<p class="mart0"><small>(Valid with the K8573 Series of <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span>&trade; Kits</span>. Limited Time Offer. New Customers Only.)</small></p>

<p>Thank you for your support, IFSQN! Trace Analytics has been testing compressed air and gas for customers worldwide since 1989. We are accredited to ISO/IEC 17025:2005 as required by many organizations. Our Team of Clean Dry Air Experts is available and eager to assist you with establishing your compressed air or gas monitoring program. We offer online instructions and step-by-step manuals for collecting samples. The <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span>&trade; Kit</span> is lightweight and easy to transport and ship. Contact us today to start your compressed air or gas monitoring program.</p>

<hr />
<h1>Order Now</h1>

<!-- K8573NB Product -->
<h2>K8573NB - <i class="aircheck">AirCheck<i class="tracecheck">&#x2713;</i> Kit&trade;</i> for SQF, BRC, and Other PWO (Particles, Water, and Oil) and C6+ Hydrocarbon Testing</h2>

<p><span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade; Model K8573NB</span> is Trace's solution to affordable testing per ISO 8573-1:2010, Food Grade Air, Critical Process Air, or your custom specifications. This kit allows for sampling of particles, water and oil for any critical air use. Food Grade Air Testing, pharmaceutical, medical device, and electronics are just a few examples of critical air use. If you require clean air for your manufacturing process K8573NB is the kit for you.</p>

<div class="product-listing mart20">
	<div class="six columns alpha">
		<div class="portfolio-wrap shadow rounded-top">
			<div class="hover-img border1 rounded-top">
				<span class="wraperr">
				<a data-rel="prettyPhoto" class="zoom fade-img" href="/images/products/K8573NB.jpg" title="K8573NB - AirCheck Kit&trade; for ISO 8573, Food Grade, and Critical Process Air"></a>
				</span>
				<img src="/images/products/K8573NB-sm.jpg" alt="Compressed Air Testing Kit for ISO 8573 and Critical Process Air - Particles, Water, and Oil" class="max-image">
			</div>
			<div class="portfolio-text">
				<b><span>The <i class="aircheck">AirCheck<i class="tracecheck">&#x2713;</i> Kit&trade; K8573NB</i></span></b>
			</div>
		</div>	
	</div>
	<h2><span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade;</span> K8573NB Contents</h2>
	<div class="five columns right-border">
		<div class="padr15">
			<p>Sampling kit packaged to your specific requirements. <a href="/aircheck-academy">Training videos available online.</a> Hardware includes:</p>
			<ul>
				<li><strong>Standard Items</strong>
					<ul class="checklist">
						<li>NPT Female Adaptor, 2 ea.</li>
						<li>Tube Flowmeter</li>
						<li>Filter Flowmeter</li>
						<li>Tubing</li>
						<li>Tube Holder, 4 ea.</li>
						<li>Detector Tube Tip Breaker</li>
						<li>Misc. Spare Parts</li>
						<li>Cleaner, 1 bottle</li>
						<li>Sampling Instructions</li>
						<li>Carrying Case</li>
					</ul>
				</li>
				<li><strong>Optional Items</strong>
					<ul class="checklist">
						<li>Calibrated NIST Traceable Flowmeters</li>
						<li>Calibrated NIST Traceable Timer</li>
						<li>Sampling Tubing – Particle Free</li>
						<li>Pressure Gauge</li>
						<li>Control Valve</li>
						<li>Data Package</li>
					</ul>
				</li>
				<li><strong>Consumables</strong>
					<ul class="checklist">
						<li>Sampling Media</li>
						<li>Cleaner</li>
					</ul>
				</li>
				<li><strong>Example Report</strong>
					<ul class="checklist">
						<li>View example <a href="/support/example-documents/"><span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Report&trade;</span></a></li>
					</ul>
				</li>
				<li><strong>Note:</strong>
					<ul class="checklist">
						<li>If you require particle measurements as low as 0.1-0.5 microns, C1-C5 hydrocarbons, or microbiological analyses of your compressed air or gas, please <a href="#contact">Contact Us</a> for more information.</li>
						<li><strong>International Customers:</strong> Please contact us with your preferred shipper and account number so that we can process your order.</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<div class="five columns omega">
		<h3 class="marb0">Rent the <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade;</span> K8573NB<br />$100 for 1-week rental</h3>
		<small><em>$75 IFSQN Discount will be reflected at checkout</em></small>
		<?php //Set Variables for product
			$kitID = 'K8573NB';
			$kitPrice = '550.00';
			$rentalPrice = '100.00';
			$samplePrice = '390.00';
		?>
		<form id="form<?php echo $kitID; ?>" class="product_form_3col" action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_cart" />
			<input type="hidden" name="upload" value="1" />
			<input type="hidden" name="business" value="ruby@airchecklab.com" />
			<input type="hidden" name="item_name" value="<?php echo $kitID; ?> AirCheck Kit Rental" />
			<input type="hidden" name="item_number" value="<?php echo $kitID; ?>" />
			<input type="hidden" name="amount" value="<?php echo $rentalPrice; ?>" />
			<input type="hidden" name="currency_code" value="USD" />

			<input type="hidden" name="discount_amount_cart" value="75.00" />

			<input type="hidden" name="on0" value="<?php echo $kitID; ?>SampleQty" />
			<input type="hidden" name="return" value="http://www.airchecklab.com/thank-you.html" />
			<input type="hidden" name="cancel_return" value="http://www.airchecklab.com/ifsqn" />
			
			<input type="hidden" name="item_name_1" value="<?php echo $kitID; ?> AirCheck Kit Rental" />
			<input type="hidden" name="amount_1" value="<?php echo $rentalPrice; ?>" />
			<input type="hidden" name="shipping_1" value="12.00" />
			<input type="hidden" name="quantity_1" value="1" />

			<input type="hidden" name="item_name_2" value="IFSQN Analysis w/ Sampling Media" />
			<input type="hidden" name="amount_2" value="<?php echo $samplePrice; ?>" />
			<label for="<?php echo $kitID; ?>SampleQty">Select No. of Samples ($390 ea):</label>
			<select id="<?php echo $kitID; ?>SampleQty" name="quantity_2" required>
				<option value="1" selected>1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
			</select>

			<input type="hidden" name="item_name_3" value="Customer Information" />
			<input type="hidden" name="amount_3" value="0.00" />

			<label for="<?php echo $kitID; ?>Name">Contact Name:</label>
			<input name="os1_3" type="text" id="<?php echo $kitID; ?>Name" required placeholder="Contact Name..." />
			<input type="hidden" name="on1_3" value="ContactName" />
			
			<label for="<?php echo $kitID; ?>CompanyName">Company Name:</label>
			<input name="os2_3" type="text" id="<?php echo $kitID; ?>CompanyName" required placeholder="Company Name..." />
			<input type="hidden" name="on2_3" value="CompanyName" />

			<label for="<?php echo $kitID; ?>Phone">Phone Number:</label>
			<input name="os3_3" type="text" id="<?php echo $kitID; ?>Phone" required placeholder="Phone Number..." />
			<input type="hidden" name="on3_3" value="PhoneNumber" />
	
<!-- 			<h3 class="center">Total Price: $<?php echo $kitPrice; ?></h3> -->
			<h4 class="error <?php echo $kitID; ?>ErrMsg" style="display:none;">Please correct any highlighted fields above.</h4>
			
			<div class="center">
				<input type="submit" class="blue button" name="addcart" value="Rent the K8573NB" />
			</div>

		</form>
<hr />
	</div>
	<div class="five columns omega">
		<h3 class="marb0">Purchase the <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade;</span> K8573NB<br />$550 - Lifetime Warranty</h3>
		<small><em>$75 IFSQN Discount will be reflected at checkout</em></small>
		<?php //Set Variables for product
			$kitID = 'K8573NB';
			$kitPrice = '550.00';
			$rentalPrice = '100.00';
			$samplePrice = '390.00';
		?>
		<form id="form<?php echo $kitID; ?>" class="product_form_3col" action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_cart" />
			<input type="hidden" name="upload" value="1" />
			<input type="hidden" name="business" value="ruby@airchecklab.com" />
			<input type="hidden" name="item_name" value="<?php echo $kitID; ?> AirCheck Kit Purchase" />
			<input type="hidden" name="item_number" value="<?php echo $kitID; ?>" />
			<input type="hidden" name="amount" value="<?php echo $kitPrice; ?>" />
			<input type="hidden" name="currency_code" value="USD" />

			<input type="hidden" name="discount_amount_cart" value="75.00" />

			<input type="hidden" name="on0" value="<?php echo $kitID; ?>SampleQty" />
			<input type="hidden" name="return" value="http://www.airchecklab.com/thank-you.html" />
			<input type="hidden" name="cancel_return" value="http://www.airchecklab.com/ifsqn" />
			
			<input type="hidden" name="item_name_1" value="<?php echo $kitID; ?> AirCheck Kit Purchase" />
			<input type="hidden" name="amount_1" value="<?php echo $kitPrice; ?>" />
			<input type="hidden" name="shipping_1" value="12.00" />
			<input type="hidden" name="quantity_1" value="1" />

			<input type="hidden" name="item_name_2" value="IFSQN Analysis w/ Sampling Media" />
			<input type="hidden" name="amount_2" value="<?php echo $samplePrice; ?>" />
			<label for="<?php echo $kitID; ?>SampleQty">Select No. of Samples ($390 ea):</label>
			<select id="<?php echo $kitID; ?>SampleQty" name="quantity_2" required>
				<option value="1" selected>1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
			</select>

			<input type="hidden" name="item_name_3" value="Customer Information" />
			<input type="hidden" name="amount_3" value="0.00" />

			<label for="<?php echo $kitID; ?>Name">Contact Name:</label>
			<input name="os1_3" type="text" id="<?php echo $kitID; ?>Name" required placeholder="Contact Name..." />
			<input type="hidden" name="on1_3" value="ContactName" />
			
			<label for="<?php echo $kitID; ?>CompanyName">Company Name:</label>
			<input name="os2_3" type="text" id="<?php echo $kitID; ?>CompanyName" required placeholder="Company Name..." />
			<input type="hidden" name="on2_3" value="CompanyName" />

			<label for="<?php echo $kitID; ?>Phone">Phone Number:</label>
			<input name="os3_3" type="text" id="<?php echo $kitID; ?>Phone" required placeholder="Phone Number..." />
			<input type="hidden" name="on3_3" value="PhoneNumber" />
	
<!-- 			<h3 class="center">Total Price: $<?php echo $kitPrice; ?></h3> -->
			<h4 class="error <?php echo $kitID; ?>ErrMsg" style="display:none;">Please correct any highlighted fields above.</h4>
			
			<div class="center">
				<input type="submit" class="blue button" name="addcart" value="Purchase the K8573NB" />
			</div>

		</form>
	</div>
</div>
<!-- end product -->

			</div>
<hr />
<h1 class="marb0" id="contact">Have Questions? Contact an Expert!</h1>

<p>We will get back to you within one business day - usually much faster!</p>

<div id="pr1" class="form-div contact-wrap">
	<form id="signupForm" class="contact_form" name="frm" method="post" action="/Process-Form">
	<fieldset>
	<div class="eight columns alpha">
		<input type="hidden" name="request" value="1" />
		<input type="hidden" name="Info" value="IFSQN" />
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
		
		<p class="marb0"><strong>How should we contact you?</strong></p>
		<div class="halfwidth padl15 marb15">
			<label for="contactViaEmail"><input type="radio" id="contactViaEmail" name="contactVia" value="Email" checked>Contact me via Email</label>
			<label for="contactViaPhone"><input type="radio" id="contactViaPhone" name="contactVia" value="Phone">Contact me via Phone</label>
		</div>
		
		<p class="marb0"><strong>Which program(s) are you interested in?</strong></p>
		<div class="brochure">
			
			<input type="checkbox" id="field656479" name="brochure[]" value="Food and Beverage Compressed Air &amp; Gases" />
			<label class="fsOptionLabel" for="field656479">Food and Beverage Compressed Air &amp; Gases</label>
			
			<input type="checkbox" id="field656479brc" name="brochure[]" value="BRC" />
			<label class="fsOptionLabel" for="field656479brc">BRC</label>
			
			<input type="checkbox" id="field9755741_6" name="brochure[]" value="ISO 8573 Air Sampling Program" />
			<label class="fsOptionLabel" for="field9755741_6">ISO 8573 Air Sampling Program</label>
			
			<input type="checkbox" id="field848490390" name="brochure[]" value="Microbial Compressed Air &amp; Gases Testing" />
			<label class="fsOptionLabel" for="field848490390">Microbial Compressed Air &amp; Gases Testing</label>
						
			<input type="checkbox" id="field975939002" name="brochure[]" value="SQF Air Purity" />
			<label class="fsOptionLabel" for="field975939002">SQF Air Purity</label>
			
			<input type="checkbox" id="field978876755" name="brochure[]" value="Other" />
			<label class="fsOptionLabel" for="field978876755">Other (Please explain below)</label>
			
		</div>
	</div>
	<div class="eight columns omega">
		<p class="marb0"><strong>Which sampling method do you prefer?</strong></p>
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
		<textarea class="tall100" id="ContactHowUse" name="HowUse" placeholder="How do you use your compressed air or gases?"></textarea>
		
		<label for="ContactHowHelp" class="wide100"><strong>How can we help you?</strong></label>
		<textarea class="tall100" id="ContactHowHelp" name="HowHelp" placeholder="How can we help you?"></textarea>
		
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
<?php get_footer(); ?>