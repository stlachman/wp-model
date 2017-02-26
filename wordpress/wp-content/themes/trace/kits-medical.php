<?php
/* 
Template Name: AirCheck Kits - Medical
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
<!-- TRACETEMPLATE AirCheck Kits - Medical -->
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
		<h1><span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade;</span> for <?php echo $curPage; ?></h1>
		<p>At Trace Analytics, LLC, the <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Lab&trade;</span>, we have the right kit for any of your compressed medical gas testing needs.
	</div>
	
<!-- K901 Product -->
	<div class="sixteen columns" id="K6088">
		<div class="home-h2">
			<span>K6088 - <i class="aircheck">AirCheck<i class="tracecheck">&#x2713;</i> Kit&trade;</i> for Medical Gases</span>
		</div>
	</div>
	<div class="sixteen columns product-listing">
		<div class="six columns alpha">
			<div class="portfolio-wrap shadow rounded-top">
				<div class="hover-img border1 rounded-top">
					<span class="wraperr">
					<a data-rel="prettyPhoto" class="zoom fade-img" href="/images/products/K901.jpg" title="K6088 AirCheck Kit&trade; for Medical Gases"></a>
					</span>
					<img src="/images/products/K6088-sm.jpg" alt="Compressed Air Testing Kit for Medical Gases" class="max-image">
				</div>
				<div class="portfolio-text">
					<b><span>K6088 - <i class="aircheck">AirCheck<i class="tracecheck">&#x2713;</i> Kit&trade;</i> for Medical Gases</span></b>
				</div>
			</div>	
		</div>
		<div class="five columns right-border">
			<div class="padr15">
				<h2>Medical gas and air testing for healthcare facilities</h2>
	   			<p>Easy-to-use hardware includes all supplies necessary for certified analysis:</p>
				<ul class="checklist">
					<li>Flowmeter</li>
					<li>&frac14; &quot; NPT Adaptor</li>
					<li>Two-Piece Threaded Bottle Holder</li>
					<li>(2) Spare Needles for Bottle Holder</li>
					<li>Needle Replacement Tool</li>
					<li>Needle Cleaner</li>
					<li>Tubing</li>
					<li>Spare O-Ring(s)</li>
					<li>Threaded Fitting for 47 mm Cassette</li>
					<li>Carrying Bag</li>
				</ul>
				<p>Sample according to NFPA 99, USP O2, CGA Grade D or E, OSHA, medical air purity, medical gas concentration for N2, O2, and N2O, piping particulate and purity testing, USP medical air and more. If you do not see the type of testing needed listed, please <a href="/contact-an-expert/">contact us</a> for additional information.</p>
			</div>
		</div>
		<div class="five columns omega">
			<h2>Get a Quote</h2>
			<?php $kitID = 'K6088'; ?>
			<p>The <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade; <?php echo $kitID; ?></span> requires customization prior to purchase - the number and frequency of samples, hardware and fittings required, and testing specifications. Get a customized quote using the button below:</p>
			<div class="center">
				<form action="/contact-an-expert" method="post">
					<input type="hidden" name="QuoteRequest" value="<?php echo $kitID; ?> Quote Request" />
					<input type="submit" class="blue button" value="Request a Quote" />
				</form>
			</div>
			<hr />
			<h3>Retrieve a Quote</h3>
			<p>Already have a quote? Review and purchase your <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade; <?php echo $kitID; ?></span>:</p>
			<form id="<?php echo $kitID; ?>Quote" class="product_form_3col" action="/products/invoice-quote-retrieval/">
				<div class="center">
					<input type="submit" class="blue button" value="Retrieve Quote" />
				</div>
			</form>
		</div>
		<div class="sixteen columns mart15">
			<form action="/contact-an-expert" method="post" name="<?php echo $kitID; ?>Form">
				<input type="hidden" name="QuoteRequest" value="<?php echo $kitID; ?> Rental Request" />
<!-- 						<input type="submit" class="blue button" value="Request Rental Info" /> -->
				<p>Need to take samples, but don't want to purchase a kit? The <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade; <?php echo $kitID; ?></span> is also available for rental. <a href="#" onclick="document['<?php echo $kitID; ?>Form'].submit()">Request <?php echo $kitID; ?> Rental Info</a></p>
			</form>
			<p>Need more sampling media? Use our easy <a href="/products/restocks">restock</a> page to quickly order supplies.</p>
		</div>
	</div>
<!-- end product -->

<div class="sixteen columns">
<hr />
	<h2>Other <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kits&trade;</span>:</h2>
	<div class="padl15">
		<ul class="">
			<li><a href="/products/aircheck-kits/breathing-air/">Breathing Air</a></li>
			<li><a href="/products/aircheck-kits/manufacturing-critical-air-iso-8573/">Manufacturing / Critical Air / ISO 8573</a></li>
			<li><a href="/products/aircheck-kits/medical-gases/">Medical Gases</a></li>
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