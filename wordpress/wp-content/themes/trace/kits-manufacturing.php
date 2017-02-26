<?php
/* 
Template Name: AirCheck Kits - Manufacturing
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
<!-- TRACETEMPLATE AirCheck Kits - Manufacturing -->
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
	<h1><span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kits&trade;</span> for Manufacturing / Critical Air / ISO 8573</h1>
	<p>At Trace Analytics, LLC, the <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Lab&trade;</span>, we have the right kit for any of your compressed air &amp; gas testing needs. Samples obtained are sent to Trace’s A2LA accredited laboratory &mdash; the <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Lab&trade;</span> &mdash; for prompt analysis. After analysis, reports are e-mailed to authorized contacts you designate. Choose from one of our industry-leading kits below:</p>
	<ul class="marb20">
		<li><a href="#K8573NB">K8573NB - the <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade;</span> for Particles, Water, and Oil</a></li>
		<li><a href="#K8573NX">K8573NX - the <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade;</span> for Gases, Particles, Water, and Oil</a></li>
		<li><a href="#KPSII">KPSII - the <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade;</span> for Microorganisms</a></li>
	</ul>
</div>

<!-- K8573NB Product -->
<div class="sixteen columns" id="K8573NB">
	<div class="home-h2">
	<?php $kitID = 'K8573NB'; ?>
		<span>K8573NB - <i class="aircheck">AirCheck<i class="tracecheck">&#x2713;</i> Kit&trade;</i> for Particles, Water, and Oil</span>
	</div>
	<div class="clearfix"></div>
	<p><span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade; Model K8573NB</span> is Trace's solution to affordable testing per ISO 8573-1:2010, Food Grade Air, Critical Process Air, or your custom specifications. This kit allows for sampling of particles, water and oil for any critical air use. Food Grade Air Testing, pharmaceutical, medical device, and electronics are just a few examples of critical air use. If you require clean air for your manufacturing process K8573NB is the kit for you.</p>
	<form action="/contact-an-expert" method="post" name="<?php echo $kitID; ?>Form">
		<input type="hidden" name="QuoteRequest" value="<?php echo $kitID; ?> Rental Request" />
<!--					<input type="submit" class="blue button" value="Request Rental Info" /> -->
		
		<p>Need to take samples, but don't want to purchase a kit? The <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade; <?php echo $kitID; ?></span> is also available for rental. <a href="#" onclick="document['<?php echo $kitID; ?>Form'].submit()">Request <?php echo $kitID; ?> Rental Info</a></p>
	</form>

	<p>Need more sampling media? Use our easy <a href="/products/restocks">restock</a> page to quickly order supplies.</p>
</div>
<div class="sixteen columns product-listing">
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
	<div class="five columns right-border">
		<div class="padr15">
			<h3><span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade;</span> K8573NB Contents</h3>
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
	</div>

	<hr />
</div>
<!-- end product -->
<!-- K8573NX Product -->
<?php $kitID = 'K8573NX'; ?>
<div class="columns sixteen" id="<?php echo $kitID; ?>">
	<div class="home-h2">
		<span>K8573NX - <i class="aircheck">AirCheck<i class="tracecheck">&#x2713;</i> Kit&trade;</i> for Gases, Particles, Water, and Oil</span>
	</div>
	<div class="clearfix"></div>
	<p><span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade; Model K8573NX</span> is Trace's solution to affordable testing per ISO 8573-1:2010, Food Grade Air, Critical Process Air, or your custom specifications. In addition to sampling for particles, water and oil; this kit can also be used to sample for other gases in air such as O<sub>2</sub>, CO, CO<sub>2</sub>, total volatile hydrocarbons, NO<sub>X</sub>, and SO<sub>2</sub>. The kit can also be used with Pure Gases such as O<sub>2</sub>, N<sub>2</sub>, N<sub>2</sub>O, and Ar. Food Grade Air Testing, pharmaceutical, medical device, and electronics are just a few examples of critical air use. If you require clean air or pure gas for your manufacturing process K8573NX is the kit for you.</p>
	
	<form action="/contact-an-expert" method="post" name="<?php echo $kitID; ?>Form">
		<input type="hidden" name="QuoteRequest" value="<?php echo $kitID; ?> Rental Request" />
<!--					<input type="submit" class="blue button" value="Request Rental Info" /> -->
		<p>Need to take samples, but don't want to purchase a kit? The <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade; <?php echo $kitID; ?></span> is also available for rental. <a href="#" onclick="document['<?php echo $kitID; ?>Form'].submit()">Request <?php echo $kitID; ?> Rental Info</a></p>
	</form>
	<p>Need more sampling media? Use our easy <a href="/products/restocks">restock</a> page to quickly order supplies.</p>
<div class="sixteen columns product-listing">
	<div class="six columns alpha">
		<div class="portfolio-wrap shadow rounded-top">
			<div class="hover-img border1 rounded-top">
				<span class="wraperr">
				<a data-rel="prettyPhoto" class="zoom fade-img" href="/images/products/K8573NX.jpg" title="K8573NX AirCheck Kit&trade; for ISO 8573"></a>
				</span>
				<img src="/images/products/K8573NX-sm.jpg" alt="Compressed Air Testing Kit for ISO 8573 - Gases, Particles, Water, and Oil" class="max-image">
			</div>
			<div class="portfolio-text">
				<b><span>The <i class="aircheck">AirCheck<i class="tracecheck">&#x2713;</i> Kit&trade; K8573NX</i></span></b>
			</div>
		</div>	
	</div>
	<div class="five columns right-border">
		<div class="padr15">
			<h3><span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade;</span> K8573NX Contents</h3>
   			<p>Sampling kit packaged to your specific requirements. <a href="/aircheck-academy">Training videos available online.</a> Hardware includes:</p>
			<ul>
				<li><strong>Standard Items</strong>
					<ul class="checklist">
						<li>2 piece Bottle Holder</li>
						<li>Needle Cleaner</li>
						<li>Needle Replacement Tool</li>
						<li>Spare Needles, 2 ea.</li>
						<li>SS NPT Female Adaptor, 2 ea.</li>
						<li>SS Double Tee</li>
						<li>Tube Flowmeter, 2 ea.</li>
						<li>Filter Flowmeter</li>
						<li>Flowmeter Tubing</li>
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
						<li>Needles</li>
						<li>Cleaner</li>
					</ul>
				</li>
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
	</div>
	
	<hr />
</div>
</div>
<!-- end product -->
<!-- KPSII Product -->
<?php $kitID = 'KPSII'; ?>
<div class="columns sixteen" id="<?php echo $kitID; ?>">
	<div class="home-h2">
		<span>KPSII - the Microbial Impaction Sampler</span>
	</div>
	<div class="clearfix"></div>
	<p>The microbial impaction sampler is available for daily rental. It connects to your compressed air/gas outlet with sterile tubing. Outlet pressure must be 60 psi or less. Unit can be disassembled for easy cleaning and autoclave sterilization. Commonly used for total aerobic plate counts. Further identification of colony forming units available.</p>
	<form action="/contact-an-expert" method="post" name="<?php echo $kitID; ?>Form">
		<input type="hidden" name="QuoteRequest" value="<?php echo $kitID; ?> Purchase Request" />
<!-- 					<input type="submit" class="blue button" value="Request Rental Info" /> -->
		<p>The <span class="aircheck"><?php echo $kitID; ?></span> is available for rental to U.S. customers only. Requires a 2-day minimum rental and reservation for specific dates.</p>
		<p>The KPSII is available for purchase inside the U.S. and internationally. <a href="#" onclick="document['<?php echo $kitID; ?>Form'].submit()">Request <?php echo $kitID; ?> Purchase Info</a></p>
		</form>
</div>
<div class="sixteen columns product-listing">
	<div class="six columns alpha">
		<div class="portfolio-wrap shadow rounded-top">
			<div class="hover-img border1 rounded-top">
				<span class="wraperr">
				<a data-rel="prettyPhoto" class="zoom fade-img" href="/images/products/KPSII.jpg" title="KPSII - the Microbial Impaction Sampler"></a>
				</span>
				<img src="/images/products/KPSII-sm.jpg" alt="Compressed Air Testing Kit - Microbial Impaction Sampler" class="max-image">
			</div>
			<div class="portfolio-text">
				<b><span>KPSII - the Microbial Impaction Sampler</span></b>
			</div>
		</div>	
	</div>
	<div class="five columns right-border">
		<div class="padr15">
			<h3>KPSII Contents</h3>
   			<p>The microbial impaction sampler is packaged to your specific testing requirements. Available for daily rental. <a href="/aircheck-academy">Training videos available online.</a> Analyses are provided by a 3rd party accredited laboratory specializing in microbial analyses. Hardware includes:</p>
			<ul>
				<li><strong>Standard Components</strong>
					<ul class="checklist">
						<li>Pinocchio Super II</li>
						<li>Sampling Port Pressure Gauge</li>
						<li>Sterile Tubing</li>
						<li>Cleaner</li>
						<li>Misc. Spare Parts</li>
						<li>Sampling Instructions</li>
						<li>Carrying Case</li>
					</ul>
				</li>
				<li><strong>Consumables</strong>
					<ul class="checklist">
						<li>Contact Plates</li>
						<li>Sterile Tubing</li>
						<li>Cleaner</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<div class="five columns omega">
		<div class="five columns omega">
		<h2>Get a Quote</h2>
		<p>The <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade; <?php echo $kitID; ?></span> requires customization prior to rental - the number of samples, date required, and testing specifications. Get a customized quote using the button below:</p>
		<div class="center">
			<form action="/contact-an-expert" method="post">
				<input type="hidden" name="QuoteRequest" value="<?php echo $kitID; ?> Quote Request" />
				<input type="submit" class="blue button" value="Request a Quote" />
			</form>
		</div>
	</div>
	</div>
</div>
<!-- end product -->

<div class="sixteen columns">
<hr />
	<p>If you have questions before placing your order online, feel free to contact your <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Team&trade;</span> at 800.247.1024 or <a href="/contact-an-expert">Contact Us</a></p>
	<h2>Other <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kits&trade;</span>:</h2>
	<div class="padl15">
		<ul class="">
			<li><a href="/products/aircheck-kits/breathing-air">Breathing Air</a></li>
			<li><a href="/products/aircheck-kits/manufacturing---critical-air---iso-8573">Manufacturing / Critical Air / ISO 8573</a></li>
			<li><a href="/products/aircheck-kits/medical-gases">Medical Gases</a></li>
		</ul>
	</div>
</div>

					<div class="clear"></div>
					<div class="small right mart20">Is there a problem with this page? Help us fix it - <a href="/report-a-bug">Report a Bug</a></div>
					<div class="clear"></div>
			</div>
		</div>
<!-- END OF CONTENT CONTAINER -->
<?php get_footer(); ?>