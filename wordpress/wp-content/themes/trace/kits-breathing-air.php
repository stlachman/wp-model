<?php
/* 
Template Name: AirCheck Kits - Breathing Air
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
<!-- TRACETEMPLATE AIRCHECK KITS - BREATHING AIR -->
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
	<h1><span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kits&trade;</span> for Compressed Breathing Air</h1>
	<p>At Trace Analytics, LLC, the <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Lab&trade;</span>, we have the right kit for any of your compressed breathing air testing needs. Choose from one of our industry-leading kits below:</p>
	<ul>
		<li><a href="#K901">K901 - the <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span>&trade; Compressed Air Testing Kit</span> for Breathing Air</a></li>
		<li><a href="#K201">K201 - the <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span>&trade; Compressed Air Testing Kit</span> for Breathing Air</a></li>
		<li><a href="#K901A">K901A - the <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span>&trade; Compressed Air Testing Kit</span> for ANDI members</a></li>
		<li><a href="#K201P">K201P - the <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span>&trade; Compressed Air Testing Kit</span> for PADI members</a></li>
	</ul>
	<hr />
	<h3>A special note to our international customers:</h3>
	
	<p>Currently, our website cannot provide correct shipping costs outside the U.S. After you submit your online order, we will e-mail you with a selection of carriers and the cost for shipping. We apologize for this inconvenience.</p>
	
	<p>If you have questions before placing your order online, feel free to contact your <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Team</span> at 800.247.1024 or <a href="/contact-an-expert">e-mail us</a>.</p>
</div>
<!-- K901 Product -->
<?php //Set Variables for product
	$kitID = 'K901';
	$kitPrice = '100000.00';
?>
<div class="sixteen columns" id="<?php echo $kitID; ?>">
	<div class="home-h2">
		<span><?php echo $kitID; ?> - the <i class="aircheck">AirCheck<i class="tracecheck">&#x2713;</i> Starter Kit&trade;</i> for Breathing Air</span>
	</div>
	<div class="clearfix"></div>
	<p>The <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade; K901</span> is designed for use with breathing air specifications requiring a dry dew point, such as NFPA 1989, OSHA 1910.134 (Cylinder or SCBA), CGA Grade D (0), and CGA Grade L. Other specifications are available at an additional cost. This kit is typically used by <strong>fire service</strong>, <strong>industrial fire brigades</strong>, some <strong>dive facilities</strong> who use high pressure breathing air to fill SCBAs or any <strong>compressor with a desiccant dryer</strong>. Test from the compressor or cascade. Watch our online sampling video for <a href="/aircheck-academy">Breathing Air Testing.</a></p>
	
	<p>When you're ready for a <a href="/products/restocks">restock</a>, cost is $80.00 each. This includes sampling media and analysis. Discounts available for quantities over 11.</p>
</div>
<div class="sixteen columns product-listing">
	<div class="six columns alpha">
		<div class="portfolio-wrap shadow rounded-top">
			<div class="hover-img border1 rounded-top">
				<span class="wraperr">
				<a data-rel="prettyPhoto" class="zoom fade-img" href="/images/products/<?php echo $kitID; ?>.jpg" title="<?php echo $kitID; ?> Starter AirCheck Kit&trade; for Breathing Air"></a>
				</span>
				<img src="/images/products/<?php echo $kitID; ?>-sm.jpg" alt="Compressed Air Testing Kit for Breathing Air" class="max-image">
			</div>
			<div class="portfolio-text">
				<b><span><?php echo $kitID; ?> - the <i class="aircheck">AirCheck<i class="tracecheck">&#x2713;</i> Kit&trade; for Breathing Air</i></span></b>
			</div>
		</div>
	</div>
	<div class="five columns right-border">
		<div class="padr15">
   			<p>Easy-to-use hardware includes all supplies necessary for certified analysis of 4 samples:</p>
			<ul class="checklist">
				<li>Analyses, 4 ea.</li>
				<li>Sampling Media, 4 ea.</li>
				<li>Adaptor (CGA 346/347, SCUBA, or &frac14;&quot; NPT)</li>
				<li>Flowmeter</li>
				<li>Bottle Holder</li>
				<li>Detector Tube Assembly</li>
				<li>Needle Replacement Tool</li>
				<li>Needle Cleaner</li>
				<li>Spare Needles</li>
				<li>Tubing</li>
				<li>Sampling Instructions</li>
				<li>Carrying Bag</li>
			</ul>
		</div>
	</div>
	<div class="five columns omega">
		<h2>Get a Quote</h2>
		<p>The <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade; <?php echo $kitID; ?></span> requires customization prior to purchase - the number and frequency of samples, hardware and fittings required, and testing specifications. Get a customized quote using the button below:</p>
		<div class="center">
			<form action="/contact-an-expert" method="post">
				<input type="hidden" name="QuoteRequest" value="<?php echo $kitID; ?> Quote Request" />
				<input type="submit" class="blue button" value="Request a Quote" />
			</form>
		</div>
		<hr />
		<h3>Retrieve a Quote</h3>
		<p>Already have a quote? Review and purchase or rent your <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade; <?php echo $kitID; ?></span>:</p>
		<form id="<?php echo $kitID; ?>Quote" class="product_form_3col" action="/products/invoice-quote-retrieval/">
			<div class="center">
				<input type="submit" class="blue button" value="Retrieve Quote" />
			</div>
		</form>
	</div>
</div>
<div class="clearfix"></div>
<hr />
<!-- end product -->
<!-- K201 product -->
<?php //Set Variables for product
	$kitID = 'K201';
	$kitPrice = '100000.00';
?>
<div class="columns sixteen" id="<?php echo $kitID; ?>">
	<div class="home-h2">
		<span><?php echo $kitID; ?> - the <i class="aircheck">AirCheck<i class="tracecheck">&#x2713;</i> Starter Kit&trade;</i> for Breathing Air</span>
	</div>
	<div class="clearfix"></div>
	<p>The <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade; <?php echo $kitID; ?></span> is designed for use with routine breathing air specifications which do not have a limit for dew point, such as CGA Grade D1 or E1, IANTD / O2 Compatible (I), OSHA 1910.134 (COMP), OSHA 1910.430, and US Navy Diving. Other specifications are available at an additional cost. This kit is typically used by <strong>commercial diving</strong>, <strong>industrial airline respirators</strong>, or <strong>low pressure compressors</strong> with a refrigerated dryer or no dryer. Test from the compressor, storage, or outlet. Watch our online sampling video for <a href="/aircheck-academy">Breathing Air Testing.</a></p>
	
	<p>When you're ready for a <a href="/products/restocks">restock</a>, cost is $80.00 each. This includes sampling media and analysis according to a routine spec. Discounts available for quantities over 11.</p>
</div>
<div class="sixteen columns product-listing">
	<div class="six columns alpha">
		<div class="portfolio-wrap shadow rounded-top">
			<div class="hover-img border1 rounded-top">
				<span class="wraperr">
				<a data-rel="prettyPhoto" class="zoom fade-img" href="/images/products/<?php echo $kitID; ?>.jpg" title="the AirCheck Kit&trade; <?php echo $kitID; ?>"></a>
				</span>
				<img src="/images/products/<?php echo $kitID; ?>-sm.jpg" alt="Compressed Air Testing Kit for Breathing Air" class="max-image">
			</div>
			<div class="portfolio-text">
				<b><span><?php echo $kitID; ?> - the <i class="aircheck">AirCheck<i class="tracecheck">&#x2713;</i> Kit&trade;</i> for Breathing Air</span></b>
			</div>
		</div>	
	</div>
	<div class="five columns right-border">
		<div class="padr15">
			<p>Easy-to-use sampling hardware kit includes all supplies necessary for the certified analysis of 4 samples:</p>
			 <ul class="checklist">
				 <li>Analyses, 4 ea.</li>
				 <li>Sampling Media, 4 ea.</li>
				 <li>Adaptor (SCUBA or &frac14;&quot; NPT)</li> 
				 <li>Flowmeter</li>
				 <li>Bottle Holder</li>
				 <li>Needle Replacement Tool</li>
				 <li>Needle Cleaner</li>
				 <li>Spare Needles</li>
				 <li>Tubing</li>
				 <li>Sampling Instructions</li>
				 <li>Carrying Bag</li>
			 </ul>
			 <!-- <p>Special online offer includes reduced kit price and one free sample a savings of $125 only when you order online!</p> -->
		</div>
	</div>
	<div class="five columns omega">
		<h2>Get a Quote</h2>
		<p>The <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade; <?php echo $kitID; ?></span> requires customization prior to purchase - the number and frequency of samples, hardware and fittings required, and testing specifications. Get a customized quote using the button below:</p>
		<div class="center">
			<form action="/contact-an-expert" method="post">
				<input type="hidden" name="QuoteRequest" value="<?php echo $kitID; ?> Quote Request" />
				<input type="submit" class="blue button" value="Request a Quote" />
			</form>
		</div>
		<hr />
		<h3>Retrieve a Quote</h3>
		<p>Already have a quote? Review and purchase or rent your <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade; <?php echo $kitID; ?></span>:</p>
		<form id="<?php echo $kitID; ?>Quote" class="product_form_3col" action="/products/invoice-quote-retrieval/">
			<div class="center">
				<input type="submit" class="blue button" value="Retrieve Quote" />
			</div>
		</form>
	</div>
</div>
<div class="clearfix"></div>
<hr />
<!-- end product -->
<!-- K901A Product -->
<?php //Set Variables for product
	$kitID = 'K901A';
	$kitPrice = '100000.00';
?>
<div class="columns sixteen" id="<?php echo $kitID; ?>">
	<div class="home-h2">
		<span><?php echo $kitID; ?> - the <i class="aircheck">AirCheck<i class="tracecheck">&#x2713;</i> Starter Kit&trade;</i> for ANDI members</span>
	</div>
	<div class="clearfix"></div>
	<p>The <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade; <?php echo $kitID; ?></span> samples according to ANDI Oxygen Compatible or ANDI Oxygen Compatible and CGA Grade E air specifications. Also includes 4 ambient/intake air analyses. This kit is only available to ANDI members. Membership will be verified prior to shipment.</p>
	<p>When you're ready for a <a href="/products/restocks">restock</a>, cost is guaranteed for ANDI members to be $80.00. This includes sampling media and analysis according to ANDI Oxygen Compatible or ANDI Oxygen Compatible and CGA Grade E air specifications.</p>
</div>
<div class="sixteen columns product-listing">
	<div class="six columns alpha">
		<div class="portfolio-wrap shadow rounded-top">
			<div class="hover-img border1 rounded-top">
				<span class="wraperr">
				<a data-rel="prettyPhoto" class="zoom fade-img" href="/images/products/<?php echo $kitID; ?>.jpg" title="<?php echo $kitID; ?> Starter AirCheck Kit&trade; for ANDI members"></a>
				</span>
				<img src="/images/products/<?php echo $kitID; ?>-sm.jpg" alt="Compressed Air Testing Kit for ANDI members" class="max-image">
			</div>
			<div class="portfolio-text">
				<b><span><?php echo $kitID; ?> - the <i class="aircheck">AirCheck<i class="tracecheck">&#x2713;</i> Kit&trade; for ANDI</i></span></b>
			</div>
		</div>	
	</div>
	<div class="five columns right-border">
		<div class="padr15">
   			<p>Easy-to-use hardware includes all supplies necessary for certified analysis of 4 samples:</p>
			<ul class="checklist" style="margin-bottom:65px;">
				<li>Analyses, 4 ea.</li>
				<li>Sampling Media, 4 ea.</li>
				<li>SCUBA Adaptor</li>
				<li>Flowmeter</li>
				<li>Bottle Holder</li>
				<li>Needle Cleaner</li>
				<li>Spare Needles</li>
				<li>Tubing</li>
				<li>Sampling Instructions</li>
				<li>Special Packaging</li>
			</ul>
		</div>
	</div>
	<div class="five columns omega">
		<h2>Get a Quote</h2>
		<p>The <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade; <?php echo $kitID; ?></span> requires customization prior to purchase - the number and frequency of samples, hardware and fittings required, and testing specifications. Get a customized quote using the button below:</p>
		<div class="center">
			<form action="/contact-an-expert" method="post">
				<input type="hidden" name="QuoteRequest" value="<?php echo $kitID; ?> Quote Request" />
				<input type="submit" class="blue button" value="Request a Quote" />
			</form>
		</div>
		<hr />
		<h3>Retrieve a Quote</h3>
		<p>Already have a quote? Review and purchase or rent your <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade; <?php echo $kitID; ?></span>:</p>
		<form id="<?php echo $kitID; ?>Quote" class="product_form_3col" action="/products/invoice-quote-retrieval/">
			<div class="center">
				<input type="submit" class="blue button" value="Retrieve Quote" />
			</div>
		</form>
	</div>
</div>
<div class="clearfix"></div>
<hr />
<!-- end product -->
<!-- K201P Product -->
<?php //Set Variables for product
	$kitID = 'K201P';
	$kitPrice = '100000.00';
?>
<div class="columns sixteen" id="<?php echo $kitID; ?>">
	<div class="home-h2">
		<span><?php echo $kitID; ?> - the <i class="aircheck">AirCheck<i class="tracecheck">&#x2713;</i> Starter Kit&trade;</i> for PADI members</span>
	</div>
	<div class="clearfix"></div>
	<p>The <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade; <?php echo $kitID; ?></span> samples according to CGA Grade E or CGA Grade E and Oxygen Compatible (I) air specifications. Also includes 2 FREE ambient/intake air analyses. This kit is only available to PADI members. Membership will be verified prior to shipment.</p>
	<p>When you're ready for a <a href="/products/restocks">restock</a>, cost is guaranteed for PADI members to be $40.00 each for two additional years, then $45.00 for subsequent years. This includes sampling media and analysis according to CGA Grade E or CGA Grade E and Oxygen Compatible (I) air specifications.</p>
</div>
<div class="sixteen columns product-listing">
	<div class="six columns alpha">
		<div class="portfolio-wrap shadow rounded-top">
			<div class="hover-img border1 rounded-top">
				<span class="wraperr">
				<a data-rel="prettyPhoto" class="zoom fade-img" href="/images/products/<?php echo $kitID; ?>.jpg" title="<?php echo $kitID; ?> Starter AirCheck Kit&trade; for PADI members"></a>
				</span>
				<img src="/images/products/<?php echo $kitID; ?>-sm.jpg" alt="Compressed Air Testing Kit for PADI members" class="max-image">
			</div>
			<div class="portfolio-text">
				<b><span><?php echo $kitID; ?> - the <i class="aircheck">AirCheck<i class="tracecheck">&#x2713;</i> Kit&trade; for PADI</i></span></b>
			</div>
		</div>	
	</div>
	<div class="five columns right-border">
		<div class="padr15">
			<p>Best price for PADI facilities! Easy-to-use sampling hardware includes all supplies necessary for certified analysis of 4 samples:</p>
			<ul class="checklist" style="margin-bottom:45px;">
				<li>Analyses, 4 ea.</li>
				<li>Sampling Media, 4 ea.</li>
				<li>SCUBA Adaptor</li>
				<li>Flowmeter</li>
				<li>Bottle Holder</li>
				<li>Needle Cleaner</li>
				<li>Spare Needles</li>
				<li>Tubing</li>
				<li>Sampling Instructions</li>
				<li>Special Packaging</li>
			</ul>
		</div>
	</div>
	<div class="five columns omega">
		<h2>Get a Quote</h2>
		<p>The <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade; <?php echo $kitID; ?></span> requires customization prior to purchase - the number and frequency of samples, hardware and fittings required, and testing specifications. Get a customized quote using the button below:</p>
		<div class="center">
			<form action="/contact-an-expert" method="post">
				<input type="hidden" name="QuoteRequest" value="<?php echo $kitID; ?> Quote Request" />
				<input type="submit" class="blue button" value="Request a Quote" />
			</form>
		</div>
		<hr />
		<h3>Retrieve a Quote</h3>
		<p>Already have a quote? Review and purchase or rent your <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade; <?php echo $kitID; ?></span>:</p>
		<form id="<?php echo $kitID; ?>Quote" class="product_form_3col" action="/products/invoice-quote-retrieval/">
			<div class="center">
				<input type="submit" class="blue button" value="Retrieve Quote" />
			</div>
		</form>
	</div>
</div>
<div class="clearfix"></div>
<hr />
<!-- end product -->
<div class="clearfix"></div>
<div class="sixteen columns">
	<h2>Other <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kits&trade;</span>:</h2>
	<div class="padl15">
		<ul class="">
			<li><a href="/products/aircheck-kits/breathing-air">Breathing Air</a></li>
			<li><a href="/products/aircheck-kits/manufacturing---critical-air---iso-8573">Manufacturing / Critical Air / ISO 8573</a></li>
			<li><a href="/products/aircheck-kits/medical-gases">Medical Gases</a></li>
		</ul>
	</div>
</div>
</div>
					<div class="clear"></div>
					<div class="small right mart20">Is there a problem with this page? Help us fix it - <a href="/report-a-bug">Report a Bug</a></div>
					<div class="clear"></div>
			</div>
<!-- END OF CONTENT CONTAINER -->
<?php get_footer(); ?>