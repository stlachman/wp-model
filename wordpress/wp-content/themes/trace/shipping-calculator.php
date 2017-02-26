<?php
/* 
Template Name: Shipping Calculator
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
<!-- TRACETEMPLATE Shipping Calculator -->
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






<?php

$webroot = $_SERVER['DOCUMENT_ROOT'];
define('INCLUDE_CHECK',true);

/*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
/* You must fill in the "Service Logins
/* values below for the example to work	
/*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/

/*********** Shipping Services ************/
/* Here's an array of all the standard
/* shipping rates. You'll probably want to
/* comment out the ones you don't want 
/******************************************/
// UPS
$services['ups']['03'] = 'Ground';
$services['ups']['12'] = '3 Day Select';
$services['ups']['02'] = '2nd Day Air';
$services['ups']['59'] = '2nd Day Air Early AM';
$services['ups']['01'] = 'Next Day Air';
$services['ups']['14'] = 'Next Day Air Early AM';
$services['ups']['11'] = 'Standard';
$services['ups']['65'] = 'Saver';
$services['ups']['07'] = 'Worldwide Express';
$services['ups']['54'] = 'Worldwide Express Plus';
$services['ups']['08'] = 'Worldwide Expedited';

// USPS
/*
$services['usps']['EXPRESS'] = 'Express';
$services['usps']['PRIORITY'] = 'Priority';
$services['usps']['PARCEL'] = 'Parcel';
$services['usps']['FIRST CLASS'] = 'First Class';
$services['usps']['EXPRESS SH'] = 'Express SH';
$services['usps']['BPM'] = 'BPM';
$services['usps']['MEDIA '] = 'Media';
$services['usps']['LIBRARY'] = 'Library'; */

// FedEx
$services['fedex']['FEDEXGROUND'] = 'Ground';
$services['fedex']['GROUNDHOMEDELIVERY'] = 'Ground Home Delivery';
$services['fedex']['FEDEXEXPRESSSAVER'] = 'Express Saver';
$services['fedex']['PRIORITYOVERNIGHT'] = 'Priority Overnight';
$services['fedex']['FEDEX2DAY'] = '2 Day';
$services['fedex']['STANDARDOVERNIGHT'] = 'Standard Overnight';
$services['fedex']['FIRSTOVERNIGHT'] = 'First Overnight';
$services['fedex']['INTERNATIONALPRIORITY'] = 'International Priority';
$services['fedex']['INTERNATIONALECONOMY'] = 'International Economy';
$services['fedex']['INTERNATIONALFIRST'] = 'International First';
//$services['fedex']['FEDEX1DAYFREIGHT'] = 'Overnight Day Freight';
//$services['fedex']['FEDEX2DAYFREIGHT'] = '2 Day Freight';
//$services['fedex']['FEDEX3DAYFREIGHT'] = '3 Day Freight';

// Set variables based on URL
if (isset($_GET['weight'])) { $weight = $_GET['weight']; }
else { $weight = '14'; }

//$to_address1 = $_GET['address1'];
//$to_city = $_GET['city'];
$to_zip = $_GET['zip'];
$to_state = $_GET['state'];
$to_country = str_replace('+', ' ', $_GET['country']);
$form_country = str_replace('+', ' ', $_GET['country']);

//$to_country = (str_replace($_GET['country']), '+', ' ');

// Translate Countries to two-letter country codes
if ($to_country=='USA') { $to_country = 'US'; }
if ($to_country=='') { $to_country = 'US'; }
if ($to_country==' ') { $to_country = 'US'; }

switch($to_country) {
	case "Andorra": $to_country='AD'; break;
	case "United Arab Emirates": $to_country='AE'; break;
	case "Afghanistan": $to_country='AF'; break;
	case "Antigua and Barbuda": $to_country='AG'; break;
	case "Anguilla": $to_country='AI'; break;
	case "Albania": $to_country='AL'; break;
	case "Armenia": $to_country='AM'; break;
	case "Netherlands Antilles": $to_country='AN'; break;
	case "Angola": $to_country='AO'; break;
	case "Antarctica": $to_country='AQ'; break;
	case "Argentina": $to_country='AR'; break;
	case "American Samoa": $to_country='AS'; break;
	case "Austria": $to_country='AT'; break;
	case "Australia": $to_country='AU'; break;
	case "Aruba": $to_country='AW'; break;
	case "Azerbaijan": $to_country='AZ'; break;
	case "Bosnia and Herzegovina": $to_country='BA'; break;
	case "Barbados": $to_country='BB'; break;
	case "Bangladesh": $to_country='BD'; break;
	case "Belgium": $to_country='BE'; break;
	case "Burkina Faso": $to_country='BF'; break;
	case "Bulgaria": $to_country='BG'; break;
	case "Bahrain": $to_country='BH'; break;
	case "Burundi": $to_country='BI'; break;
	case "Benin": $to_country='BJ'; break;
	case "Bermuda": $to_country='BM'; break;
	case "Brunei Darussalam": $to_country='BN'; break;
	case "Bolivia": $to_country='BO'; break;
	case "Brazil": $to_country='BR'; break;
	case "Bahama": $to_country='BS'; break;
	case "Bhutan": $to_country='BT'; break;
	case "Burma (no longer exists)": $to_country='BU'; break;
	case "Bouvet Island": $to_country='BV'; break;
	case "Botswana": $to_country='BW'; break;
	case "Belarus": $to_country='BY'; break;
	case "Belize": $to_country='BZ'; break;
	case "Canada": $to_country='CA'; break;
	case "Cocos (Keeling) Islands": $to_country='CC'; break;
	case "Central African Republic": $to_country='CF'; break;
	case "Congo": $to_country='CG'; break;
	case "Switzerland": $to_country='CH'; break;
	case "Côte D'ivoire (Ivory Coast)": $to_country='CI'; break;
	case "Cook Iislands": $to_country='CK'; break;
	case "Chile": $to_country='CL'; break;
	case "Cameroon": $to_country='CM'; break;
	case "China": $to_country='CN'; break;
	case "Colombia": $to_country='CO'; break;
	case "Costa Rica": $to_country='CR'; break;
	case "Czechoslovakia (no longer exists)": $to_country='CS'; break;
	case "Cuba": $to_country='CU'; break;
	case "Cape Verde": $to_country='CV'; break;
	case "Christmas Island": $to_country='CX'; break;
	case "Cyprus": $to_country='CY'; break;
	case "Czech Republic": $to_country='CZ'; break;
	case "German Democratic Republic (no longer exists)": $to_country='DD'; break;
	case "Germany": $to_country='DE'; break;
	case "Djibouti": $to_country='DJ'; break;
	case "Denmark": $to_country='DK'; break;
	case "Dominica": $to_country='DM'; break;
	case "Dominican Republic": $to_country='DO'; break;
	case "Algeria": $to_country='DZ'; break;
	case "Ecuador": $to_country='EC'; break;
	case "Estonia": $to_country='EE'; break;
	case "Egypt": $to_country='EG'; break;
	case "Western Sahara": $to_country='EH'; break;
	case "Eritrea": $to_country='ER'; break;
	case "Spain": $to_country='ES'; break;
	case "Ethiopia": $to_country='ET'; break;
	case "Finland": $to_country='FI'; break;
	case "Fiji": $to_country='FJ'; break;
	case "Falkland Islands (Malvinas)": $to_country='FK'; break;
	case "Micronesia": $to_country='FM'; break;
	case "Faroe Islands": $to_country='FO'; break;
	case "France": $to_country='FR'; break;
	case "France, Metropolitan": $to_country='FX'; break;
	case "Gabon": $to_country='GA'; break;
	case "United Kingdom (Great Britain)": $to_country='GB'; break;
	case "Grenada": $to_country='GD'; break;
	case "Georgia": $to_country='GE'; break;
	case "French Guiana": $to_country='GF'; break;
	case "Ghana": $to_country='GH'; break;
	case "Gibraltar": $to_country='GI'; break;
	case "Greenland": $to_country='GL'; break;
	case "Gambia": $to_country='GM'; break;
	case "Guinea": $to_country='GN'; break;
	case "Guadeloupe": $to_country='GP'; break;
	case "Equatorial Guinea": $to_country='GQ'; break;
	case "Greece": $to_country='GR'; break;
	case "South Georgia and the South Sandwich Islands": $to_country='GS'; break;
	case "Guatemala": $to_country='GT'; break;
	case "Guam": $to_country='GU'; break;
	case "Guinea-Bissau": $to_country='GW'; break;
	case "Guyana": $to_country='GY'; break;
	case "Hong Kong": $to_country='HK'; break;
	case "Heard and McDonald Islands": $to_country='HM'; break;
	case "Honduras": $to_country='HN'; break;
	case "Croatia": $to_country='HR'; break;
	case "Haiti": $to_country='HT'; break;
	case "Hungary": $to_country='HU'; break;
	case "Indonesia": $to_country='ID'; break;
	case "Ireland": $to_country='IE'; break;
	case "Israel": $to_country='IL'; break;
	case "India": $to_country='IN'; break;
	case "British Indian Ocean Territory": $to_country='IO'; break;
	case "Iraq": $to_country='IQ'; break;
	case "Islamic Republic of Iran": $to_country='IR'; break;
	case "Iceland": $to_country='IS'; break;
	case "Italy": $to_country='IT'; break;
	case "Jamaica": $to_country='JM'; break;
	case "Jordan": $to_country='JO'; break;
	case "Japan": $to_country='JP'; break;
	case "Kenya": $to_country='KE'; break;
	case "Kyrgyzstan": $to_country='KG'; break;
	case "Cambodia": $to_country='KH'; break;
	case "Kiribati": $to_country='KI'; break;
	case "Comoros": $to_country='KM'; break;
	case "St. Kitts and Nevis": $to_country='KN'; break;
	case "Korea, Democratic People's Republic of": $to_country='KP'; break;
	case "Korea, Republic of": $to_country='KR'; break;
	case "Kuwait": $to_country='KW'; break;
	case "Cayman Islands": $to_country='KY'; break;
	case "Kazakhstan": $to_country='KZ'; break;
	case "Lao People's Democratic Republic": $to_country='LA'; break;
	case "Lebanon": $to_country='LB'; break;
	case "Saint Lucia": $to_country='LC'; break;
	case "Liechtenstein": $to_country='LI'; break;
	case "Sri Lanka": $to_country='LK'; break;
	case "Liberia": $to_country='LR'; break;
	case "Lesotho": $to_country='LS'; break;
	case "Lithuania": $to_country='LT'; break;
	case "Luxembourg": $to_country='LU'; break;
	case "Latvia": $to_country='LV'; break;
	case "Libyan Arab Jamahiriya": $to_country='LY'; break;
	case "Morocco": $to_country='MA'; break;
	case "Monaco": $to_country='MC'; break;
	case "Moldova, Republic of": $to_country='MD'; break;
	case "Madagascar": $to_country='MG'; break;
	case "Marshall Islands": $to_country='MH'; break;
	case "Mali": $to_country='ML'; break;
	case "Mongolia": $to_country='MN'; break;
	case "Myanmar": $to_country='MM'; break;
	case "Macau": $to_country='MO'; break;
	case "Northern Mariana Islands": $to_country='MP'; break;
	case "Martinique": $to_country='MQ'; break;
	case "Mauritania": $to_country='MR'; break;
	case "Monserrat": $to_country='MS'; break;
	case "Malta": $to_country='MT'; break;
	case "Mauritius": $to_country='MU'; break;
	case "Maldives": $to_country='MV'; break;
	case "Malawi": $to_country='MW'; break;
	case "Mexico": $to_country='MX'; break;
	case "Malaysia": $to_country='MY'; break;
	case "Mozambique": $to_country='MZ'; break;
	case "Namibia": $to_country='NA'; break;
	case "New Caledonia": $to_country='NC'; break;
	case "Niger": $to_country='NE'; break;
	case "Norfolk Island": $to_country='NF'; break;
	case "Nigeria": $to_country='NG'; break;
	case "Nicaragua": $to_country='NI'; break;
	case "Netherlands": $to_country='NL'; break;
	case "Norway": $to_country='NO'; break;
	case "Nepal": $to_country='NP'; break;
	case "Nauru": $to_country='NR'; break;
	case "Neutral Zone (no longer exists)": $to_country='NT'; break;
	case "Niue": $to_country='NU'; break;
	case "New Zealand": $to_country='NZ'; break;
	case "Oman": $to_country='OM'; break;
	case "Panama": $to_country='PA'; break;
	case "Peru": $to_country='PE'; break;
	case "French Polynesia": $to_country='PF'; break;
	case "Papua New Guinea": $to_country='PG'; break;
	case "Philippines": $to_country='PH'; break;
	case "Pakistan": $to_country='PK'; break;
	case "Poland": $to_country='PL'; break;
	case "St. Pierre and Miquelon": $to_country='PM'; break;
	case "Pitcairn": $to_country='PN'; break;
	case "Puerto Rico": $to_country='PR'; break;
	case "Portugal": $to_country='PT'; break;
	case "Palau": $to_country='PW'; break;
	case "Paraguay": $to_country='PY'; break;
	case "Qatar": $to_country='QA'; break;
	case "Réunion": $to_country='RE'; break;
	case "Romania": $to_country='RO'; break;
	case "Russian Federation": $to_country='RU'; break;
	case "Rwanda": $to_country='RW'; break;
	case "Saudi Arabia": $to_country='SA'; break;
	case "Solomon Islands": $to_country='SB'; break;
	case "Seychelles": $to_country='SC'; break;
	case "Sudan": $to_country='SD'; break;
	case "Sweden": $to_country='SE'; break;
	case "Singapore": $to_country='SG'; break;
	case "St. Helena": $to_country='SH'; break;
	case "Slovenia": $to_country='SI'; break;
	case "Svalbard and Jan Mayen Islands": $to_country='SJ'; break;
	case "Slovakia": $to_country='SK'; break;
	case "Sierra Leone": $to_country='SL'; break;
	case "San Marino": $to_country='SM'; break;
	case "Senegal": $to_country='SN'; break;
	case "Somalia": $to_country='SO'; break;
	case "Suriname": $to_country='SR'; break;
	case "Sao Tome and Principe": $to_country='ST'; break;
	case "Union of Soviet Socialist Republics (no longer exists)": $to_country='SU'; break;
	case "El Salvador": $to_country='SV'; break;
	case "Syrian Arab Republic": $to_country='SY'; break;
	case "Swaziland": $to_country='SZ'; break;
	case "Turks and Caicos Islands": $to_country='TC'; break;
	case "Chad": $to_country='TD'; break;
	case "French Southern Territories": $to_country='TF'; break;
	case "Togo": $to_country='TG'; break;
	case "Thailand": $to_country='TH'; break;
	case "Tajikistan": $to_country='TJ'; break;
	case "Tokelau": $to_country='TK'; break;
	case "Turkmenistan": $to_country='TM'; break;
	case "Tunisia": $to_country='TN'; break;
	case "Tonga": $to_country='TO'; break;
	case "East Timor": $to_country='TP'; break;
	case "Turkey": $to_country='TR'; break;
	case "Trinidad and Tobago": $to_country='TT'; break;
	case "Tuvalu": $to_country='TV'; break;
	case "Taiwan, Province of China": $to_country='TW'; break;
	case "Tanzania, United Republic of": $to_country='TZ'; break;
	case "Ukraine": $to_country='UA'; break;
	case "Uganda": $to_country='UG'; break;
	case "United States Minor Outlying Islands": $to_country='UM'; break;
	case "United States of America": $to_country='US'; break;
	case "Uruguay": $to_country='UY'; break;
	case "Uzbekistan": $to_country='UZ'; break;
	case "Vatican City State (Holy See)": $to_country='VA'; break;
	case "St. Vincent and the Grenadines": $to_country='VC'; break;
	case "Venezuela": $to_country='VE'; break;
	case "British Virgin Islands": $to_country='VG'; break;
	case "United States Virgin Islands": $to_country='VI'; break;
	case "Viet Nam": $to_country='VN'; break;
	case "Vanuatu": $to_country='VU'; break;
	case "Wallis and Futuna Islands": $to_country='WF'; break;
	case "Samoa": $to_country='WS'; break;
	case "Democratic Yemen (no longer exists)": $to_country='YD'; break;
	case "Yemen": $to_country='YE'; break;
	case "Mayotte": $to_country='YT'; break;
	case "Yugoslavia": $to_country='YU'; break;
	case "South Africa": $to_country='ZA'; break;
	case "Zambia": $to_country='ZM'; break;
	case "Zaire": $to_country='ZR'; break;
	case "Zimbabwe": $to_country='ZW'; break;
}

$GoogleAddress = $to_zip.',+'.$to_state.',+'.$to_country;

//if ($to_country == 'USA') { $to_country = 'US'; }

// Config
$config = array(
	// Services
	'services' => $services,
	// Weight
	'weight' => $weight, // Default = 1
	'weight_units' => 'lb', // lb (default), oz, gram, kg
	// Size
	'size_length' => 18, // Default = 8
	'size_width' => 14.5, // Default = 4
	'size_height' => 12, // Default = 2
	'size_units' => 'in', // in (default), feet, cm
	// From
	'from_zip' => 78738, 
	'from_state' => "TX", // Only Required for FedEx
	'from_country' => "US",
	// To
	'to_zip' => $to_zip,
	'to_state' => $to_state, // Only Required for FedEx
	'to_country' => $to_country,
	
	// Service Logins
	'ups_access' => '3CAED5B16EB983C0', // UPS Access License Key
	'ups_user' => 'tracean', // UPS Username  
	'ups_pass' => 'aircheck', // UPS Password  
	'ups_account' => '34597X', // UPS Account Number
	'usps_user' => '', // USPS User Name
	'fedex_account' => '510087046', // FedEX Account Number
	'fedex_meter' => '100152253' // FedEx Meter Number 
);

// Shipping Calculator Class
require_once $webroot.'/php/ShippingCalculator.php';

// Create Class (with config array)
$ship = new ShippingCalculator($config);


// Get Rates
if (isset($_GET['go'])) { $rates = $ship->calculate(); }

// Print Array of Rates
if (isset($_GET['go'])) { print "<h1>Shipping Quote</h1><h3>Rates for sending a ".$config[weight]." ".$config[weight_units].", ".$config[size_length]." x ".$config[size_width]." x ".$config[size_height]." ".$config[size_units]." package from ".$config[from_zip]." to ".$config[to_zip]." ".$config[to_state]." ".$config[to_country].": </h3>"; }

else { echo "<h3>No Destination Set - Please use the form below</h3>"; }

//print "<xmp>";
//print_r($rates);
//print "</xmp>";

/******* Setting Options After Class Creation ********
If you would rather not set all the config options 
when you first create an instance of the class you can
set them like this:

$ship = new ShippingCalculator ();
$ship->set_value('from_zip','12345');

..where the first variable is the name of the value 
and the second variable is the value
/*****************************************************/


/***************** Single Rate ***********************
If you only want to get one rate you can pass the 
company and service code via the 'calculate' method

$ship = new ShippingCalculator ($config);
$rates = $ship->calculate('usps','FIRST CLASS')

..this would return a rates array like 
$rates =>
	'usps' =>
		'FIRST CLASS' = rate;
/*****************************************************/



/***************** Printing Rates *********************
.. and finally, if you wanted to loop through the 
returned rates and print radio buttons so your user 
could select a shipping method you can do something 
like this:

foreach($rates as $company => $codes) {
	foreach($codes as $code => $rate) print "
<input type='checkbox' name='shipping' value='".$rate."' /> ".$services[$company][$code]."<br />";
}
*/


if (isset($_GET['go'])) { 
	foreach($rates as $company => $codes) {
		if (strlen($to_country)=='2') { echo "<div class='shipquote notification notice'>\n<table>\n"; }
		else { echo "<div class='shipquote notification error'>\n<h5>Country Code may not be set correctly.</h2><p>If no shipping rates are shown below, please update the country.</h5>\n"; }
		
		echo "\t<h1>" . strtoupper($company) . "</h1>\n";
			foreach($codes as $code => $rate) { 
			if (isset($rate)) {  
				print "\t<tr><td>".$services[$company][$code].":</td><td><strong>$" . $rate ."</strong></td></tr>\n";
				}
			}
		echo "</table>\n";
		echo "</div>\n";
	}
}
/*
which will print the radio buttons, each having the 
value of the respective shipping code which displaying
the more user friendly name of the shipping method.
/*****************************************************/

?>
			<div class="clearfix"></div>
			<div class="eight columns">
				<h3>Shipping Destination</h3>
				<p>(approximate - shows destination zip code):</p>
				
				<iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=<?php echo $to_zip; ?>&key=AIzaSyCycrAvEUwT0QrR0NnNL5h2oU3jc2FAiNs" allowfullscreen></iframe> 

			</div>
			</div>
			<div class="clearfix"></div>
			<div class="eight columns">
				<div class="form-div contact-wrap">
					<form id="ShipQuote" name="frm" class="contact_form widelabel" method="get" action="/Shipping-Calculator">
					
						<h4 class="error marb15 mart20">To get a manual shipping quote, use the form below:</h4>
						<input type="hidden" id="go" name="go" value="go" />
						<label for="weight">Weight (lbs)</label>
						<input type="text" name="weight" id="weight" value="<?php echo $weight; ?>" placeholder="Weight..." />
						
						<label for="zip">Postal Code</label>
						<input type="text" name="zip" id="zip" value="<?php echo $to_zip; ?>" placeholder="Zip..." />
						
						<label for="state">State</label>
						<input type="text" name="state" id="state" value="<?php echo $to_state; ?>" placeholder="State..." />
						
						<label for="country">Country</label>
						<select name="country" id="country">
							<option value="<?php echo $form_country; ?>" selected><?php echo $form_country; ?></option>
<?php include $webroot.'/php/countries.php'; ?>
						</select>

						<input type="submit" class="blue button float-right" value="Get Shipping Quote" />
					</form>
				</div>			

			</div>
		</div>







					<div class="clear"></div>
					<div class="small right mart20">Is there a problem with this page? Help us fix it - <a href="/report-a-bug">Report a Bug</a></div>
					<div class="clear"></div>
			</div>
		</div>
	<?php  endwhile; endif; //have_posts ?>
<!-- END OF CONTENT CONTAINER -->
<?php get_footer(); ?>