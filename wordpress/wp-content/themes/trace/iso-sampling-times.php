<?php
/* 
Template Name: ISO Sampling Times
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
			if(isset($pagecustoms["averis_breadcrumbs_active"])){
				$averis_breadcrumbs_active="on";
				}else {$averis_breadcrumbs_active="off";
				}
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
<?php // Camera Slideshow
if (function_exists('camera_meta_slideshow')) {
    $meta_camera = get_post_custom( $post->ID );
    if( (isset($meta_camera['camera_meta_slideshow'])) && ( $meta_camera['camera_meta_slideshow'][0]!=='none' ) ){
        echo '</div>';
        echo camera_meta_slideshow($meta_camera['camera_meta_slideshow'][0]);
        echo '<div class="container2 content_container">';
    }
}
?>
<?php /* Featured Image */
	if ( has_post_thumbnail() ) {
		echo '</div>';
		$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
		echo '<div class="page-banner shadow"><img src="' . $featured_image[0] . '" alt="' . the_title_attribute('echo=0') . '" class="wide100" /></div>';
		echo '<div class="container2 content_container">';
	}
?>
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
<?php if($averis_activate_sidebar=="off") {?>
	<div class="divide20"></div>
<?php } ?>
<!-- MAIN CONTENT CONTAINER	-->
	<?php if(have_posts()) : while(have_posts()) : the_post();
		//if(strlen(get_the_content())){
	?>
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
					<?php /*
						// show Facebook LIKE and GooglePlus buttons if breadcrumbs are off
						if($averis_breadcrumbs_active=="off"){
							echo "
								<div style='float:right'>
									<div class='fb-like' data-href='https://www.facebook.com/TraceAnalytics' data-layout='button_count' data-action='like' data-show-faces='true' data-share='false' style='display:block; float:right;'></div>
									<div class='g-plusone' data-href='http://www.airchecklab.com' data-annotation='bubble' data-size='medium' data-width='100' style='display:block; float:right; margin-top:12px !important; margin-left: 6px !important;'></div>
								</div>";
						} */
					?>					
					<?php // the_content(); ?>

<?php
/*
ini_set('display_errors',1); 
error_reporting(E_ALL);
*/

if (isset($_POST['particleClass']) && $_POST['particleClass'] !=='') { $particleClass = $_POST['particleClass']; } else { $particleClass = '2';}
if (isset($_POST['waterClass']) && $_POST['waterClass'] !=='') { $waterClass = $_POST['waterClass']; } else { $waterClass = '4';}
if (isset($_POST['oilClass']) && $_POST['oilClass'] !=='') { $oilClass = $_POST['oilClass']; } else { $oilClass = '2';}
if (isset($_POST['flowRate']) && $_POST['flowRate'] !=='') { $flowRate = $_POST['flowRate']; } else { $flowRate = '100';}
if (isset($_POST['smFlowRate']) && $_POST['smFlowRate'] !=='') { $smFlowRate = $_POST['smFlowRate']; } else { $smFlowRate = '4';}
if (isset($_POST['pressure']) && $_POST['pressure'] !=='') { $pressure = $_POST['pressure']; } else { $pressure = '125';}
?>

<!--
<hr />
<h2>Baseline Tests:</h2>
<form method="post" action="">
	<input type="hidden" name="particleClass" value="1" />
	<input type="hidden" name="waterClass" value="2" />
	<input type="hidden" name="oilClass" value="1" />
	<input id="submit-isocalc" type="submit" class="blue button left" value="Baseline 1 [1:2:1]" />
</form>

<form method="post" action="">
	<input type="hidden" name="particleClass" value="2" />
	<input type="hidden" name="waterClass" value="2" />
	<input type="hidden" name="oilClass" value="2" />
	<input id="submit-isocalc" type="submit" class="blue button" style="float:left;" value="Baseline 2 [2:2:2]" />
</form>

<hr />
<h2>Custom Purity Classes:</h2>
-->
<?php
/* echo "<pre>Particles = $particleClass
Water = $waterClass
Oil = $oilClass
Flowrate = $flowRate
Water flowrate = $smFlowRate
"; */


switch ($particleClass) {
	case "1":
		$particleVolume = '12000';
		break;
	case "2":
		$particleVolume = '1200';
		break;
	case "3":
		$particleVolume = '500';
		break;
	case "4":
		$particleVolume = '500';
		break;
	case "5":
		$particleVolume = '500';
		break;
	case "6":
		$particleVolume = '500';
		break;
    default:
        $particleVolume = '-';
}

switch ($waterClass) {
	case "1":
		switch ($pressure) {
			case "0":
				$waterVolume = "160";
				break;
			case "10":
				$waterVolume = "160";
				break;
			case "20":
				$waterVolume = "160";
				break;
			case "25":
				$waterVolume = "160";
				break;
			case "30":
				$waterVolume = "160";
				break;
			case "40":
				$waterVolume = "160";
				break;
			case "50":
				$waterVolume = "280";
				break;
			case "60":
				$waterVolume = "160";
				break;
			case "70":
				$waterVolume = "160";
				break;
			case "75":
				$waterVolume = "400";
				break;
			case "80":
				$waterVolume = "160";
				break;
			case "90":
				$waterVolume = "160";
				break;
			case "100":
				$waterVolume = "480";
				break;
			case "110":
				$waterVolume = "160";
				break;
			case "120":
				$waterVolume = "160";
				break;
			case "125":
				$waterVolume = "640";
				break;
		}
		$dewpointC = "-70";
		$dewpointF = "-94";
		$dtMessage = "Note: Use the 5/a-P Detector Tube.";
		break;
	case "2":
		$waterVolume = '50';
		$dewpointC = '-40';
		$dewpointF = '-40';
		$dtMessage = "Note: Use the 5/a-P Detector Tube.";
		break;
	case "3":
		$waterVolume = '50';
		$dewpointC = '-20';
		$dewpointF = '-4';
		$dtMessage = "Note: Use the 5/a-P Detector Tube.";
		break;
	case "4":
		$waterVolume = '40';
		$dewpointC = '+3';
		$dewpointF = '+37';
		$dtMessage = "Note: Use the 20/a-P Detector Tube.";
		break;
	case "5":
		$waterVolume = '20';
		$dewpointC = '+7';
		$dewpointF = '+45';
		$dtMessage = "Note: Use the 20/a-P Detector Tube.";
		break;
	case "6":
		$waterVolume = '10';
		$dewpointC = '+10';
		$dewpointF = '+50';
		$dtMessage = "Note: Use the 20/a-P Detector Tube.";
		break;
    default:
        $waterVolume = '-';
}

switch ($oilClass) {
	case "1":
		$oilVolume = "400";
		$aerosolVolume = '5000';
		break;
	case "2":
		$oilVolume = "40";
		$aerosolVolume = '500';
		break;
	case "3":
		$oilVolume = "-";
		$aerosolVolume = '250';
		break;
	case "4":
		$oilVolume = "-";
		$aerosolVolume = '250';
		break;
	case "5":
		$oilVolume = "-";
		$aerosolVolume = '250';
		break;
	case "6":
		$oilVolume = "-";
		$aerosolVolume = '-';
		break;
	default:
		$oilVolume = '-';
		$aerosolVolume = '-';
}

// Particle / Filter sample time
if($particleVolume !== '-') { $particleTime = round($particleVolume / $flowRate, 1); } else { $particleTime = '0'; }
if($aerosolVolume !== '-') { $aerosolTime = round($aerosolVolume / $flowRate, 1); } else { $aerosolTime = '0'; }
if($particleTime > $aerosolTime) { $filterTime = $particleTime; } else { $filterTime = $aerosolTime; }

// Water sample time
if($waterVolume !== '-') { $waterTime = round($waterVolume / $smFlowRate, 1); } else { $waterTime = '0'; }

// Oil sample time
if($oilVolume !== '-') { $oilTime = round($oilVolume / $smFlowRate, 1); } else { $oilTime = '0'; }

echo "<h1>ISO 8573-1:2010 [$particleClass:$waterClass:$oilClass]<br />Recommended Sampling Times:</h1>";
echo "<table><tr><td>Particle Class [$particleClass]</td><td><strong>Filter Sampling Time</strong><br />(Particles &amp; Oil Aerosol)</td>";
if($filterTime == '0') { echo "<td>Not required.</td></tr>"; } else { echo "<td>$filterTime minutes.</td><td><strong>Min. air volume:</strong> $particleVolume L</td></tr>"; }

echo "<tr><td>Water Class [$waterClass]</td><td><strong>Detector Tube Sampling Time</strong><br />(Water)<br /><em>$dtMessage</em></td>";
if($waterTime == '0') { echo "<td>Not required.</td></tr>"; } else { echo "<td>$waterTime minutes.</td><td><strong>Min. air volume:</strong> $waterVolume L</td</tr>"; }

echo "<tr><td>Oil Class [$oilClass]</td><td><strong>Charcoal Tube Sampling Time</strong><br />(Oil Vapor)</td>";
if($oilTime == '0') { echo "<td>Not required for Oil Class $oilClass.</td></tr>"; } else { echo "<td>$oilTime minutes.</td><td><strong>Min. air volume:</strong> $oilVolume L</td></tr>"; }
echo "</table>";
?>

<hr />

<h1>ISO 8573-1:2010 Compressed Air Testing - Sampling Time Calculator</h1>
<p>To calculate the recommended sampling times for your K8573NB or K8573NX <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade;</span>, select your desired <!-- Baseline or --> Purity Classes below:</p>

<div class="form-div contact-wrap">
<form id="ISOCalculation" class="contact_form" name="frm" method="post" action="">
	<fieldset>
	<div class="six columns alpha">
		
		<label for="particleClass" class="wide100">Particles:</label>
		<select name="particleClass" id="particleClass">
			<option value="1" <?php if($particleClass == "1") {echo "selected";} ?> >Class 1</option>
			<option value="2" <?php if($particleClass == "2") {echo "selected";} ?> >Class 2</option>
			<option value="3" <?php if($particleClass == "3") {echo "selected";} ?> >Class 3</option>
			<option value="4" <?php if($particleClass == "4") {echo "selected";} ?> >Class 4</option>
			<option value="5" <?php if($particleClass == "5") {echo "selected";} ?> >Class 5</option>
			<option value="6" <?php if($particleClass == "6") {echo "selected";} ?> >Class 6</option>
			<option value="-" <?php if($particleClass == "-") {echo "selected";} ?> >-</option>
		</select>
		
		<label for="waterClass" class="wide100">Water:</label>
		<select name="waterClass" id="waterClass">
			<option value="1" <?php if($waterClass == "1") {echo "selected";} ?> onClick="toggle_it('pr1')">Class 1 &mdash; Dew Point of &le; -70&deg;C or &le; -94&deg;F</option>
			<option value="2" <?php if($waterClass == "2") {echo "selected";} ?> onClick="toggle_it('pr2')">Class 2 &mdash; Dew Point of &le; -40&deg;C or &le; -40&deg;F</option>
			<option value="3" <?php if($waterClass == "3") {echo "selected";} ?> onClick="toggle_it('pr2')">Class 3 &mdash; Dew Point of &le; -20&deg;C or &le; -4&deg;F</option>
			<option value="4" <?php if($waterClass == "4") {echo "selected";} ?> onClick="toggle_it('pr2')">Class 4 &mdash; Dew Point of &le; +3&deg;C or &le; +37&deg;F</option>
			<option value="5" <?php if($waterClass == "5") {echo "selected";} ?> onClick="toggle_it('pr2')">Class 5 &mdash; Dew Point of &le; +7&deg;C or &le; +45&deg;F</option>
			<option value="6" <?php if($waterClass == "6") {echo "selected";} ?> onClick="toggle_it('pr2')">Class 6 &mdash; Dew Point of &le; +10&deg;C or &le; +50&deg;F</option>
			<option value="-" <?php if($waterClass == "-") {echo "selected";} ?> onClick="toggle_it('pr2')">-</option>
		</select>
		
		<div id="pr2NOT" style="display:none;"></div>
		<div id="pr1NOT" style="display:<?php if($waterClass !== "1") {echo "noneNOT";} ?>;">
		<label for="pressure" class="wide100">Sampling Point Pressure: <em><small>(Only required for Class 1 Water)</small></em></label>
		<select name="pressure" id="pressure">
			<option value="25" <?php if($pressure == "25") {echo "selected";} ?> >25 PSIG</option>
			<option value="50" <?php if($pressure == "50") {echo "selected";} ?> >50 PSIG</option>
			<option value="75" <?php if($pressure == "75") {echo "selected";} ?> >75 PSIG</option>
			<option value="100" <?php if($pressure == "100") {echo "selected";} ?> >100 PSIG</option>
			<option value="125" <?php if($pressure == "125") {echo "selected";} ?> >125 PSIG</option>
		</select>
		</div>

		
		<label for="oilClass" class="wide100">Oil:</label>
		<select name="oilClass" id="oilClass">
			<option value="1" <?php if($oilClass == "1") {echo "selected";} ?> >Class 1 &mdash; &le; 0.01 mg/m<sup>3</sup></option>
			<option value="2" <?php if($oilClass == "2") {echo "selected";} ?> >Class 2 &mdash; &le; 0.1 mg/m<sup>3</sup></option>
			<option value="3" <?php if($oilClass == "3") {echo "selected";} ?> >Class 3 &mdash; &le; 1 mg/m<sup>3</sup></option>
			<option value="4" <?php if($oilClass == "4") {echo "selected";} ?> >Class 4 &mdash; &le; 5 mg/m<sup>3</sup></option>
			<option value="5" <?php if($oilClass == "5") {echo "selected";} ?> >Class 5</option>
			<option value="6" <?php if($oilClass == "6") {echo "selected";} ?> >Class 6</option>
			<option value="-" <?php if($oilClass == "-") {echo "selected";} ?> >-</option>
		</select>
		
		<label for="flowRate" class="wide100">Filter Flowrate: <em>(20-140 LPM)</em></label>
		<input type="number" name="flowRate" id="flowRate" value="<?php echo $flowRate; ?>" />
		
		<label for="smFlowRate" class="wide100">Tube Flowrate: <em>(1-5 LPM)</em></label>
		<select name="smFlowRate" id="smFlowRate">
			<option value="1" <?php if($smFlowRate == "1") {echo "selected";} ?> >1 LPM</option>
			<option value="2" <?php if($smFlowRate == "2") {echo "selected";} ?> >2 LPM</option>
			<option value="3" <?php if($smFlowRate == "3") {echo "selected";} ?> >3 LPM</option>
			<option value="4" <?php if($smFlowRate == "4") {echo "selected";} ?> >4 LPM</option>
			<option value="5" <?php if($smFlowRate == "5") {echo "selected";} ?> >5 LPM</option>
		</select>
				
		<div class="right"><input id="submit-isocalc" type="submit" class="blue button right" value="Submit Form" /></div>
	</div>
	</fieldset>
</form>
</div>

<hr />

<p>ISO 8573-1:2010 Compressed Air Contaminants and Purity Classes are listed below. If the specification you need is not shown, please <a href="/contact-an-expert">Contact Us</a>. We have many more air &amp; gas specifications in our database. If you need a custom specification, <a href="/contact-an-expert">Contact Us</a> with your requirements.</p>
<?php
$webroot = '/Volumes/WebFiles/sites/airchecklab-new';
include($webroot.'/inc/airspecs-ISO.php');

?>

					<div class="clear"></div>
					<div class="small right mart20">Is there a problem with this page? Help us fix it - <a href="/report-a-bug">Report a Bug</a></div>
					<div class="clear"></div>
			</div>
		</div>
	<?php  endwhile; endif; //have_posts ?>
<!-- END OF CONTENT CONTAINER -->
<?php get_footer(); ?>