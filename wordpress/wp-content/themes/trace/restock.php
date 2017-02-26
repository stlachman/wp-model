<?php
/* 
Template Name: Restock Request
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
<!-- TRACETEMPLATE RESTOCK -->
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
<div class="sixteen columns">
	<h1>Restocks</h1>
	<p>Restock your <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade;</span> using this form. We have listed our most common restock requests below. If you need to request additional parts, please use the comments field at the bottom of this page. You can find all part numbers in your <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade;</span> instructions.</p>
</div>

			<form id="restockForm" name="frm" class="contact_form widelabel" method="post" action="/Process-Form">
<!--			<form id="restockForm" name="frm" class="contact_form widelabel" method="post" action="/tests/arrayform.php"> -->
			<div class="eight columns alpha form-div contact-wrap">
				<h3>Customer Information:</h3>
				<input type="hidden" name="request" value="4" />
				
				<label for="ContactOrganization2">Company<span>*</span></label>
				<input type="text" name="Organization" id="ContactOrganization2" placeholder="Organization..." required />
				
				<label for="field9755420">Customer No.</label>
				<input type="text" id="field9755420" name="CustomerNo" placeholder="Customer Number..." />
				
				<label for="PurchaseOrder">P.O. Number</label>
				<input type="text" name="PurchaseOrder" id="PurchaseOrder" placeholder="P.O. Number..." />
				
				<label for="TraceQuote">Trace Quote No.</label>
				<input type="text" name="TraceQuote" id="TraceQuote" placeholder="Trace Quote Number..." />
				
				<label for="ContactFirstName2">First Name<span>*</span></label>
				<input type="text" name="FirstName" id="ContactFirstName2" placeholder="First Name..." required />
				
				<label for="ContactLastName2">Last Name<span>*</span></label>
				<input type="text" name="LastName" id="ContactLastName2" placeholder="Last Name..." required />
				
				<label for="ContactPhone2">Phone<span>*</span></label>
				<input type="tel" name="Phone" id="ContactPhone2" placeholder="Phone..." required />

				<label for="ContactEmail2">Email<span>*</span></label>
				<input type="email" name="Email" id="ContactEmail2" placeholder="Email..." required />
				
			</div>

			<div class="eight columns omega form-div contact-wrap">
				<h3>Restock Information:</h3>
<?php
// Products
$product['SamplingMedia']="Sampling Media";
$product['SamplingMediaWithAmbient']="Sampling Media w/ Ambient";
$product['SamplingBlanks']="Sampling Blanks";
$product['BottleHolders']="Bottle Holders";
$product['ReplacementNeedles']="Replacement Needles";
$product['DetectorTubes']="Detector Tubes";
?>

				<div class="checkboxes">
<?php foreach($product as $ProdID=>$ProdName) {
	echo "				<input type='checkbox' name='product[]' value='" . $ProdName . "' id='" . $ProdID . "' onclick=\"document.getElementById('".$ProdID."Qty').disabled=(this.checked)?0:1\"><label for='" . $ProdID . "'>" . $ProdName . "</label>\n";
	echo "				<div class='qty'><label for='" . $ProdID . "Qty'>Qty:</label><input type='number' id='" . $ProdID . "Qty' name='quantity[]' disabled /></div>\n";
	}
?>
				</div>
				<p class="marb0"><strong>Are these restock parts for <i class="aircheck">AirCheck<i class="tracecheck">&#x2713;</i> Kits&trade;</i> used with Breathing Air or Manufacturing?</strong></p>
				<div class="restockRadio wide98 clearfix">
					<input type="radio" id="field65464589" name="KitType" value="Breathing Air">
					<label for="field65464589">Breathing Air</label>
					<input type="radio" id="field98735323" name="KitType" value="Manufacturing">
					<label for="field98735323">Manufacturing</label>
				</div>
			</div>
			<div class="sixteen columns">
				<label for="PartsRequested" class="wide100"><strong>Missing other parts for your <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade;</span>?</strong> Refer to your instructions to find the part number(s) you need and enter them with the quantities desired below:</label>
				<textarea id="PartsRequested" name="HowUse" placeholder="Additional Parts Requested..." ></textarea>

				<h4 class="error errMsg1" style="display:none;">Please correct any highlighted fields above.</h4>
				<div class="clearfix"></div>
				<div class="right"><input id="submit-contact-1" type="submit" class="blue button right" value="Submit Form" /></div>
			</div>
			</form>

					<div class="clear"></div>
					<div class="small right mart20">Is there a problem with this page? Help us fix it - <a href="/report-a-bug">Report a Bug</a></div>
					<div class="clear"></div>
			</div>
		</div>
<!-- END OF CONTENT CONTAINER -->
<?php get_footer(); ?>