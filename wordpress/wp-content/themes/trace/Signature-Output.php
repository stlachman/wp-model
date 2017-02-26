<?php

/* 
Template Name: Signature Output
*/

ini_set('display_errors',1); 
error_reporting(E_ALL);

$Picture = $_GET['Picture'];
$firstname = $_GET['firstname'];
$lastname = $_GET['lastname'];
$yourname = $firstname . ' ' . $lastname;
$yourtitle = $_GET['yourtitle'];
$youremail = str_replace('airchecklab', 'AirCheckLab', $_GET['youremail']) ;

if (isset($_GET['yourext'])) { $yourext = ' ex. '.$_GET['yourext']; }
else { $yourext = ''; }

$facebook = $_GET['facebook'];
$youtube = $_GET['youtube'];
$twitter = $_GET['twitter'];
$linkedin = $_GET['linkedin'];
$OtherText = $_GET['OtherText'];


$vCard = <<< EOF
BEGIN:VCARD
VERSION:3.0
PRODID:-//Apple Inc.//Address Book 6.1.3//EN
N:{$lastname};{$firstname};;;
FN:{$yourname}
ORG:Trace Analytics\, LLC;
TITLE:{$yourtitle}
EMAIL;type=INTERNET;type=WORK;type=pref:{$youremail}
TEL;type=WORK;type=VOICE;type=pref: (512) 263-0000 {$yourext}
item1.TEL: (800) 247-1024 {$yourext}
item1.X-ABLabel:toll-free
TEL;type=WORK;type=FAX: (512) 263-0002
item2.ADR;type=WORK;type=pref:;;15768 Hamilton Pool Rd.;Austin;TX;78738;
item2.X-ABADR:us
item3.URL;type=pref:www.AirCheckLab.com
item3.X-ABLabel:_$!<HomePage>!\$_
END:VCARD

EOF;

//echo nl2br($vCard);

$vCardName = str_replace(' ', '-', $yourname).'.vcf';

// Write out the vCard to the "new" website
$vCard1 = 'vcards/'.$vCardName;
$fhandle = fopen($vCard1, "w+");
fwrite($fhandle, $vCard);
fclose($fhandle);

// Write out the vCard to the old site
/*
$vCard2 = '../../airchecklab/vcards/'.$vCardName;
$fhandle = fopen($vCard2, "w+");
fwrite($fhandle, $vCard);
fclose($fhandle);
*/

/* X-ABUID:9BA15331-88F5-485D-B3B1-27133D149F97:ABPerson */

/*
echo '<pre>';
print_r(get_defined_vars());
echo '</pre><br><hr>';
*/
?>

<table width="320" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<a href="http://www.airchecklab.com/compressed-air-testing-services.html">
				<img src="http://www.airchecklab.com/images/SignatureImages/breathing-air.png" width="108" height="29" border="0" alt="Breathing Air Testing"></a></td>
		<td>
			<a href="http://www.airchecklab.com/process-air-critical-air-in-manufacturing.html">
				<img src="http://www.airchecklab.com/images/SignatureImages/manufacturing.png" width="106" height="29" border="0" alt="Process and Criticial Air Testing for Manufacturing"></a></td>
		<td colspan="2">
			<a href="http://www.airchecklab.com/medical-device.html">
				<img src="http://www.airchecklab.com/images/SignatureImages/medical.png" width="106" height="29" border="0" alt="Process Air and Gas Testing for Medical"></a></td>
	</tr>
	<tr>
		<td colspan="4">
			<a href="http://www.airchecklab.com">
				<img src="http://www.airchecklab.com/images/SignatureImages/Trace-Analytics.png" width="320" height="31" border="0" alt="Trace Analytics - the AirCheck Lab"></a></td>
	</tr>
	<tr>
		<td width="288" colspan="3" bgcolor="#3D63A9">
			<table width="288" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="3">
						<img src="http://www.airchecklab.com/images/SignatureImages/SigTextTop.png" width="288" height="8" alt=""></td>
				</tr>
				<tr>
					<td width="5" bgcolor="#3D63A9">
						<img src="http://www.airchecklab.com/images/SignatureImages/spacer.gif" width="5" height="87" alt=""></td>
					<td width="278" bgcolor="#FFFFFF" style="padding-left:6px; padding-top:2px; padding-bottom:4px; font-family: Arial, Helvetica, sans-serif; font-size:14px;">
						<?php if ($Picture == 'Yes') { echo '<img src="http://www.airchecklab.com/images/employees/'. str_replace(' ', '-', $yourname) . '.jpg" style="margin-right:5px;" align="left" width="75" height="105" />'; } ?>
						<strong style="font-size:18px;"><?php echo $yourname; ?></strong><br />
						<em style="font-size: 12px;"><?php echo $yourtitle; ?></em><br />
						<?php echo $youremail; ?><br />
						800-247-1024<?php echo $yourext; ?><br />
						<?php if (isset($_GET['OtherText'])) { echo nl2br($OtherText); } ?>
					</td>
					<td width="5" bgcolor="#3D63A9">
						<img src="http://www.airchecklab.com/images/SignatureImages/spacer.gif" width="5" height="87" alt=""></td>
				</tr>
				<tr><td colspan="3"><img src="http://www.airchecklab.com/images/SignatureImages/SigTextBottom.png" width="288" height="29" border="0" alt="We do one thing - Test Compressed Air!"></td></tr>
			</table>
		</td>
		<td width="32" bgcolor="#3D63A9" valign="top">
			<table width="32" border="0" cellpadding="0" cellspacing="0">
				<?php
					
					if (isset($_GET['facebook'])) { echo '<tr><td><a href="'. $facebook .'"><img src="http://www.airchecklab.com/images/SignatureImages/facebook.png" width="32" height="30" border="0" alt="Connect with me on Facebook!" /></a></td></tr>'; }
					
					if (isset($_GET['youtube'])) { echo '<tr><td><a href="'. $youtube .'"><img src="http://www.airchecklab.com/images/SignatureImages/youtube.png" width="32" height="30" border="0" alt="View our Training Videos online!" /></a></td></tr>'; }
					
					if (isset($_GET['youtube'])) { echo '<tr><td><a href="'. $twitter .'"><img src="http://www.airchecklab.com/images/SignatureImages/twitter.png" width="32" height="30" border="0" alt="Follow me on Twitter!" /></a></td></tr>'; }
				
					if (isset($_GET['linkedin'])) { echo '<tr><td><a href="'. $linkedin .'"><img src="http://www.airchecklab.com/images/SignatureImages/linkedin.png" width="32" height="30" border="0" alt="Find me on LinkedIn" /></a></td></tr>'; }
				?>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="4">
			<a href="http://www.airchecklab.com">
				<img src="http://www.airchecklab.com/images/SignatureImages/address-and-phone.png" width="320" height="41" border="0" alt="800-247-1024  www.AirCheckLab.com"></a></td>
	</tr>
	<tr>
		<td colspan="4">
			<a href="http://www.airchecklab.com/vcards/<?php echo str_replace(' ', '-', $yourname); ?>.vcf">
				<img src="http://www.airchecklab.com/images/SignatureImages/download-my-vcard.png" width="320" height="24" border="0" alt="Download my vCard"></a></td>
	</tr>
	<tr>
		<td>
			<img src="http://www.airchecklab.com/images/SignatureImages/spacer.gif" width="108" height="1" alt=""></td>
		<td>
			<img src="http://www.airchecklab.com/images/SignatureImages/spacer.gif" width="106" height="1" alt=""></td>
		<td>
			<img src="http://www.airchecklab.com/images/SignatureImages/spacer.gif" width="74" height="1" alt=""></td>
		<td>
			<img src="http://www.airchecklab.com/images/SignatureImages/spacer.gif" width="32" height="1" alt=""></td>
	</tr>
</table>