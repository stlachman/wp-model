<?php
/* 
Template Name: Process Form
*/

// check for javascript-created field.
/* if (!isset($_POST['iowe747id8jej3748'])) { */

	$webroot = $_SERVER['DOCUMENT_ROOT'];

	global $wp_query;
    if(isset($wp_query))
    	$content_array = $wp_query->get_queried_object();
	if(isset($content_array->ID)){
    	$post_id = $content_array->ID;
	}	
	
	$template_uri = get_template_directory_uri();
	
	define('INCLUDE_CHECK',true);
	
	require $webroot.'/php/connect.php';
/* 	require $webroot.'/php/functions.php'; */
		
	$to = "AirCheck Service Team <ServiceTeam@AirCheckLab.com>";
	
	// BCC field is set in /php/functions.php in the Recipients line. Yeah, I should add it to the parameters sent to the function...
	// Gmail SMTP does not allow us to actually change the 'from' email.
	$fromName = "AirCheck Web Request";
	$fromEmail = "ServiceTeam@AirCheckLab.com";
	
	// Visitor Info
	$IPAddress = $_SERVER['REMOTE_ADDR'];
	$UserAgent = $_SERVER['HTTP_USER_AGENT'];
	$WebServer = $_SERVER['HTTP_HOST'];
	
	if (isset($_POST['FirstName'])) { $FirstName = $_POST['FirstName']; }
	if (isset($_POST['LastName'])) { $LastName = $_POST['LastName']; }
	if (isset($_POST['Phone'])) { $Phone = $_POST['Phone']; }
	if (isset($_POST['JobTitle'])) { $JobTitle = $_POST['JobTitle']; }
	if (isset($_POST['Organization'])) { $Organization = $_POST['Organization']; }
	if (isset($_POST['CustomerNo'])) { $CustomerNo = $_POST['CustomerNo']; }
	if (isset($_POST['Email'])) { $Email = $_POST['Email']; }
	if (isset($_POST['City'])) { $City = $_POST['City']; }
	if (isset($_POST['State'])) { $State = $_POST['State']; }
	if (isset($_POST['ZipCode'])) { $ZipCode = $_POST['ZipCode']; }
	if (isset($_POST['Country'])) { $Country = $_POST['Country']; }
	if (isset($_POST['contactVia'])) { $contactVia = $_POST['contactVia'];}
	if (isset($_POST['Info'])) { $Info = $_POST['Info'].' '; }
	if (isset($_POST['SampleCount'])) { $SampleCount = $_POST['SampleCount']; }
	if (isset($_POST['PurityClass'])) { $PurityClass = $_POST['PurityClass']; }
	if (isset($_POST['brochure'])) {
		$brochurecount = count($_POST["brochure"]);
		$msgbrochures = '';
		$sqlbrochures = '';
		for ($i = 0; $i < $brochurecount; $i++)
		{
		  $msgbrochures.= $_POST["brochure"][$i].'<br />';
		  $sqlbrochures.= $_POST["brochure"][$i]."\n";
		}
		
		// Set $to based on which brochures are selected - NOTE - search terms must be lowercase.
		$string = str_replace("\n", ' ', $sqlbrochures);
		$array = array("automotive","food","iso","medical","microbial","nuclear","pharmaceutical","sqf","other");
		if(0 < count(array_intersect(array_map('strtolower', explode(' ', $string)), $array)))
		{
			$to = "AirCheck Clean Dry Air Team <CDATest@AirCheckLab.com>, AirCheck Service Team <ServiceTeam@AirCheckLab.com>";
			}
		
	}
	if (isset($_POST['SampleMethod'])) { 
		$SampleMethodChoice = $_POST['SampleMethod']; 
		if ($SampleMethodChoice == "1") {
			$SampleMethod = 'I will take samples myself';
		}
		elseif ($SampleMethodChoice == "2") {
			$SampleMethod = 'I would like an AirCheck Service Distributor to take air samples';
			}
		elseif ($SampleMethodChoice == "3") {
			$SampleMethod = 'I would like to become an AirCheck Service Distributor';
			}
		else {
			$SampleMethod = 'No sample method selected.';
			}
	}
	
	// set subject based on request type
	$request = $_POST["request"];
	
	if ($request == "1") { $subject = 'Information Request'; }
	elseif ($request == "2") { $subject = 'Existing Customer Request'; $to = "AirCheck Clean Dry Air Team <CDATest@AirCheckLab.com>, AirCheck Service Team <ServiceTeam@AirCheckLab.com>";}
	elseif ($request == "3") { $subject = 'Additional Order Info'; }
	elseif ($request == "4") { $subject = 'Restock Request'; }
// 	else { $subject = 'Default Subject'; }
	// redirect for spam submissions
	else { header('Location: http://' . $WebServer . '/Thank-You'); die;}
	
	if ($contactVia == "Phone") { $subject = $Info .'Phone Call Request'; }
	if (isset($_POST['QuoteRequest'])) { $QuoteRequest = $_POST['QuoteRequest']; $subject = $QuoteRequest; }
	
	$subject.=' from ' . $FirstName . ' ' . $LastName;
	// Additional Order Info form info:
	if (isset($_POST['Mobile'])) { $Mobile = $_POST['Mobile']; }
	if (isset($_POST['Fax'])) { $Fax = $_POST['Fax']; }
	if (isset($_POST['AltFirstName'])) { $AltFirstName = $_POST['AltFirstName']; }
	if (isset($_POST['AltLastName'])) { $AltLastName = $_POST['AltLastName']; }
	if (isset($_POST['AltEmail'])) { $AltEmail = $_POST['AltEmail']; }
	if (isset($_POST['AltPhone'])) { $AltPhone = $_POST['AltPhone']; }
	if (isset($_POST['AltMobile'])) { $AltMobile = $_POST['AltMobile']; }
	if (isset($_POST['AltFax'])) { $AltFax = $_POST['AltFax']; }
	if (isset($_POST['MailingAddress'])) { $MailingAddress = $_POST['MailingAddress']; }
	if (isset($_POST['MailingCity'])) { $MailingCity = $_POST['MailingCity']; }
	if (isset($_POST['MailingState'])) { $MailingState = $_POST['MailingState']; }
	if (isset($_POST['MailingZip'])) { $MailingZip = $_POST['MailingZip']; }
	if (isset($_POST['MailingCountry'])) { $MailingCountry = $_POST['MailingCountry']; }
	if (isset($_POST['HowUse'])) { $HowUse = htmlspecialchars($_POST['HowUse'])."\n"; }
	if (isset($_POST['HowHelp'])) { $HowHelp = htmlspecialchars($_POST['HowHelp']); }
	if (isset($_POST['QuoteRequest'])) {$HowHelp = $QuoteRequest."\n".$HowHelp; }
	
	// Restocks
	if (isset($_POST['PurchaseOrder'])) { $PurchaseOrder = htmlspecialchars($_POST['PurchaseOrder']); }
	if (isset($_POST['KitType'])) { $KitType = htmlspecialchars($_POST['KitType']); }
	if (isset($_POST['TraceQuote'])) { $TraceQuote = htmlspecialchars($_POST['TraceQuote']); }
	
	// add Restock info to $HowUse
	if (isset($_POST['PurchaseOrder'])) { $HowUse.="PurchaseOrder: " . $PurchaseOrder . "\n"; }
	
	if ($request == "4") {
		$HowUse = '';
	}
	
	if (isset($_POST['KitType'])) { $HowUse .= "Kit Type: " . $KitType . "\n"; }
	
	if (isset($_POST['product']) && isset($_POST['quantity'])) {
		
		// clear out $HowUse so we can re-add it to the bottom of this block
	//	$HowUse = '';
		$product = $_POST['product'];
		$quantity = $_POST['quantity'];
		$products = array_combine($product, $quantity);
		foreach ($products as $item => $qty) {
			$HowUse.="$item: $qty\n";
			}
		if (isset($_POST['HowUse'])) { $HowUse .= htmlspecialchars($_POST['HowUse'])."\n"; }
		}
	
	$replyTo = $Email;
	
	// set HowHelp to additional info for Order Info submissions.
	if ($request == "3") {
		$HowHelp.="";
		$HowHelp.="Organization: " . $Organization . "\n";
		$HowHelp.="FirstName: " . $FirstName . "\n";
		$HowHelp.="LastName: " . $LastName . "\n";
		$HowHelp.="Email: " . $Email . "\n";
		$HowHelp.="Phone: " . $Phone . "\n";
		$HowHelp.="Mobile: " . $Mobile . "\n";
		$HowHelp.="Fax: " . $Fax . "\n";
		$HowHelp.="AltFirstName: " . $AltFirstName . "\n";
		$HowHelp.="AltLastName: " . $AltLastName . "\n";
		$HowHelp.="AltEmail: " . $AltEmail . "\n";
		$HowHelp.="AltPhone: " . $AltPhone . "\n";
		$HowHelp.="AltMobile: " . $AltMobile . "\n";
		$HowHelp.="AltFax: " . $AltFax . "\n";
		$HowHelp.="MailingAddress: " . $MailingAddress . "\n";
		$HowHelp.="MailingCity: " . $MailingCity . "\n";
		$HowHelp.="MailingState: " . $MailingState . "\n";
		$HowHelp.="MailingZip: " . $MailingZip . "\n";
		$HowHelp.="MailingCountry: " . $MailingCountry . "\n";
	}
	
	/*
	/////////////////////////// insert into MySQL ////////////////////////////////////////////
	*/
	// escape all of the strings
	$my_request = mysql_real_escape_string($request);
	$my_CustomerNo = mysql_real_escape_string($CustomerNo);
	$my_FirstName = mysql_real_escape_string($FirstName);
	$my_LastName = mysql_real_escape_string($LastName);
	$my_Phone = mysql_real_escape_string($Phone);
	$my_Email = mysql_real_escape_string($Email);
	$my_Organization = mysql_real_escape_string($Organization);
	$my_JobTitle = mysql_real_escape_string($JobTitle);
	$my_City = mysql_real_escape_string($City);
	$my_State = mysql_real_escape_string($State);
	$my_Country = mysql_real_escape_string($Country);
	$my_sqlbrochures = mysql_real_escape_string($sqlbrochures);
	$my_SampleMethodChoice = mysql_real_escape_string($SampleMethodChoice);
	$my_HowUse = mysql_real_escape_string(htmlspecialchars_decode($HowUse));
	$my_HowHelp = mysql_real_escape_string(htmlspecialchars_decode($HowHelp));
	$my_subject = mysql_real_escape_string(htmlspecialchars_decode($subject));
	$my_IPAddress = mysql_real_escape_string($IPAddress);
	$my_UserAgent = mysql_real_escape_string($UserAgent);
	$my_TraceQuote = mysql_real_escape_string($TraceQuote);
	
	// Insert into MySQL AirCheckWeb » ContactRequests table
	$sql = "insert into ContactRequests(ContactType,DateSubmitted,Status,CustomerNo,FirstName,LastName,Phone,Email,Organization,JobTitle,City,State,Country,Brochures,SampleMethod,HowUse,HowHelp,MsgSubject,IPAddress,UserAgent,TraceQuote) values('$my_request',now(),'1','$my_CustomerNo','$my_FirstName','$my_LastName','$my_Phone','$my_Email','$my_Organization','$my_JobTitle','$my_City','$my_State','$my_Country','$my_sqlbrochures','$my_SampleMethodChoice','$my_HowUse','$my_HowHelp','$my_subject','$my_IPAddress','$my_UserAgent','$my_TraceQuote')";
	
    if ($subject !== 'Default Subject from ') { mysql_query($sql); }

	// Get the pk_id of the previously inserted row.	
	$msgID = mysql_insert_id();
	mysql_close($link);
	
	/*
	/////////////////////////// html email ////////////////////////////////////////////
	*/
		$msg="";
	//	$msg.="<table style='width:100%; background:#3d63a9;'><tr><td>\n";
		$msg.="<center><table style='width:600px;font-family:arial, helvetica, sans-serif; font-weight:normal; border-collapse:collapse; border:2px solid #3d63a9;margin: 10px; padding:0; background:#fff;box-shadow: 0 1px 4px #666;'>\n";
		$msg.="	<tr>\n";
	//	$msg.="		<td style='padding:0; margin:0;background:#3d63a9;'><img src='http://www.airchecklab.com/images/blank.gif' width='150' height='1' /></td>\n";
	//	$msg.="		<td style='padding:0; margin:0;background:#3d63a9;'><img src='http://www.airchecklab.com/images/blank.gif' width='425' height='1' /></td>\n";
	//	$msg.="	</tr>\n";
		$msg.="	<tr><td style='background:#3d63a9;'><a href='http://" . $WebServer . "'><img width='600' src='http://" . $WebServer . "/images/Trace-Logo-Short-Address-Block-Blue-Top.png' alt='Trace Analytics - The AirCheck Lab' /></a></td></tr>\n";
	//	$msg.="	<tr><td colspan='2' style='background:#3d63a9;'><h1 style='color:#ffcc00; font-size:26px; text-align:center; margin-bottom:6px; margin-top:6px;'>Trace Analytics, LLC Web Request</h1></td></tr>\n";
		$msg.="	<tr>\n";
		$msg.="		<td style='padding:10px; margin:0;'>\n";
		$msg.="			<table style='width:580px;font-family:arial, helvetica, sans-serif; font-weight: normal;  border-collapse:collapse; border:none;margin: 0px auto 5px; background:#fff;'>\n";
		$msg.="				<tr>\n";
		$msg.="					<td style='padding:0; margin:0;'><img src='http://www.airchecklab.com/images/blank.gif' width='150' height='1' /></td>\n";
		$msg.="					<td style='padding:0; margin:0;'><img src='http://www.airchecklab.com/images/blank.gif' width='425' height='1' /></td>\n";
		$msg.="				</tr>\n";
		$msg.="				<tr>\n";
		if ($request=="1" || $request=="2") { $msg.="					<td colspan='2' style='padding:0px; margin:0;padding-bottom:10px;'>Thank you for contacting Trace Analytics, The AirCheck Lab&trade;. Our Team of Experts will respond to your inquiry as soon as possible.<hr /></td>\n"; }
		if ($request =="3") { $msg.="					<td colspan='2' style='padding:0px; margin:0;padding-bottom:10px;'>Thank you for submitting your additional order information to Trace Analytics, The AirCheck Lab&trade;. Our Team of Experts will respond to your inquiry as soon as possible.<hr /></td>\n"; }
		$msg.="				</tr>\n";
		$msg.="				<tr><td style='vertical-align:top;'><strong>Subject:</strong> </td><td style='vertical-align:top;'>" . $subject . "</td></tr>\n";
		if (isset($msgID)) { $msg.="				<tr><td style='vertical-align:top;'><strong>Reference No:</strong> </td><td style='vertical-align:top;'>" . $msgID . "</td></tr>\n"; }
		if (isset($_POST['FirstName'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>First Name:</strong> </td><td style='vertical-align:top;'>" . $FirstName . "</td></tr>\n"; }
		if (isset($_POST['LastName'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>Last Name:</strong> </td><td style='vertical-align:top;'>" . $LastName . "</td></tr>\n"; }
		if (isset($_POST['Phone'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>Phone:</strong> </td><td style='vertical-align:top;'>" . $Phone . "</td></tr>\n"; }
		if (isset($_POST['Mobile'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>Mobile:</strong> </td><td style='vertical-align:top;'>" . $Mobile . "</td></tr>\n"; }
		if (isset($_POST['Fax'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>Fax:</strong> </td><td style='vertical-align:top;'>" . $Fax . "</td></tr>\n"; }
		if (isset($_POST['Email'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>Email:</strong> </td><td style='vertical-align:top;'>" . $Email . "</td></tr>\n"; }
		if (isset($_POST['Organization'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>Company:</strong> </td><td style='vertical-align:top;'>" . $Organization . "</td></tr>\n"; }
		if (isset($_POST['CustomerNo'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>Customer No.:</strong> </td><td style='vertical-align:top;'>" . $CustomerNo . "</td></tr>\n"; }
		if (isset($_POST['JobTitle'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>Job Title:</strong> </td><td style='vertical-align:top;'>" . $JobTitle . "</td></tr>\n"; }
		if (isset($_POST['City'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>City:</strong> </td><td style='vertical-align:top;'>" . $City . "</td></tr>\n"; }
		if (isset($_POST['State'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>State:</strong> </td><td style='vertical-align:top;'>" . $State . "</td></tr>\n"; }
		if (isset($_POST['ZipCode'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>ZIP:</strong> </td><td style='vertical-align:top;'>" . $ZipCode . "</td></tr>\n"; }
		if (isset($_POST['Country'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>Country:</strong> </td><td style='vertical-align:top;'>" . $Country . "</td></tr>\n"; }
		if (isset($_POST['TraceQuote'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>Quote No.:</strong> </td><td style='vertical-align:top;'>" . $TraceQuote . "</td></tr>\n"; }
		if (isset($_POST['brochure'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>Brochures:</strong> </td><td style='vertical-align:top;'>" . $msgbrochures . "</td></tr>\n"; }
		if (isset($_POST['contactVia'])) { 
			$msg.="				<tr><td colspan='2'><strong>How would you like us to contact you?</strong><br />\n";
			$msg.="				<p style='padding-left:15px; margin-top:0; padding-top:0;'>Please contact me via " . $contactVia. "</p></td></tr>\n";
			}
		if (isset($_POST['SampleMethod'])) { 
			$msg.="				<tr><td colspan='2'><strong>Which sampling method do you prefer?</strong><br />\n";
			$msg.="				<p style='padding-left:15px; margin-top:0; padding-top:0;'>" . $SampleMethod. "</p></td></tr>\n";
			}
		if (isset($_POST['SampleCount'])) { 
			$msg.="				<tr><td colspan='2'><strong>How many samples do you plan on taking? How often do you need to sample?</strong><br />\n";
			$msg.="				<p style='padding-left:15px; margin-top:0; padding-top:0;'>" . $SampleCount. "</p></td></tr>\n";
			}
		if (isset($_POST['PurityClass'])) { 
			$msg.="				<tr><td colspan='2'><strong>If known, what Purity Class(es) do you require analysis for? [__:__:__]</strong><br />\n";
			$msg.="				<p style='padding-left:15px; margin-top:0; padding-top:0;'>" . $PurityClass. "</p></td></tr>\n";
			}
		if (isset($_POST['HowUse'])) { 
			if ($request == "4") {
				$msg.="				<tr><td colspan='2'><strong>Restock Information:</strong><br />\n";
				$msg.="				<p style='padding-left:15px; margin-top:0; padding-top:0;'>" . nl2br($HowUse) . "</p></td></tr>\n";
				}
			else {
				$msg.="				<tr><td colspan='2'><strong>How do you use your compressed air or gas?</strong><br />\n";
				$msg.="				<p style='padding-left:15px; margin-top:0; padding-top:0;'>" . nl2br($HowUse) . "</p></td></tr>\n";
				}
			}
		if (isset($_POST['HowHelp'])) { 
			$msg.="				<tr><td colspan='2'><strong>How can we help you?</strong><br />\n";
			$msg.="				<p style='padding-left:15px; margin-top:0; padding-top:0;'>" . nl2br($HowHelp) . "</p></td></tr>\n";
			}
	
		if (isset($_POST['AltFirstName'])) { $msg.="				<tr><td colspan='2' style='vertical-align:top;'><hr /><h3>Secondary Contact:</h3></td></tr>\n"; }
		if (isset($_POST['AltFirstName'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>First Name:</strong> </td><td style='vertical-align:top;'>" . $AltFirstName . "</td></tr>\n"; }
		if (isset($_POST['AltLastName'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>Last Name:</strong> </td><td style='vertical-align:top;'>" . $AltLastName . "</td></tr>\n"; }
		if (isset($_POST['AltEmail'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>Email:</strong> </td><td style='vertical-align:top;'>" . $AltEmail . "</td></tr>\n"; }
		if (isset($_POST['AltPhone'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>Phone:</strong> </td><td style='vertical-align:top;'>" . $AltPhone . "</td></tr>\n"; }
		if (isset($_POST['AltMobile'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>Mobile:</strong> </td><td style='vertical-align:top;'>" . $AltMobile . "</td></tr>\n"; }
		if (isset($_POST['AltFax'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>Fax:</strong> </td><td style='vertical-align:top;'>" . $AltFax . "</td></tr>\n"; }
		if (isset($_POST['MailingAddress'])) { $msg.="				<tr><td colspan='2' style='vertical-align:top;'><hr /><h3>Mailing Address:</h3></td></tr>\n"; }
		if (isset($_POST['MailingAddress'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>Address:</strong> </td><td style='vertical-align:top;'>" . $MailingAddress . "</td></tr>\n"; }
		if (isset($_POST['MailingCity'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>City:</strong> </td><td style='vertical-align:top;'>" . $MailingCity . "</td></tr>\n"; }
		if (isset($_POST['MailingState'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>State:</strong> </td><td style='vertical-align:top;'>" . $MailingState . "</td></tr>\n"; }
		if (isset($_POST['MailingZip'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>Zip:</strong> </td><td style='vertical-align:top;'>" . $MailingZip . "</td></tr>\n"; }
		if (isset($_POST['MailingCountry'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>Country:</strong> </td><td style='vertical-align:top;'>" . $MailingCountry . "</td></tr>\n"; }
	
		$msg.="			</table>\n";
		$msg.="		</td>\n";
		$msg.="	</tr>\n";
		$msg.="	<tr><td style='background:#3d63a9;'><a href='http://" . $WebServer . "'><img width='600' src='http://" . $WebServer . "/images/Trace-Logo-Short-Address-Block-Blue-Bottom.png' alt='Trace Analytics - The AirCheck Lab' /></a></td></tr>\n";
		$msg.="</table>\n";
		$msg.="</center>\n";
	//	$msg.='</td></tr></table>';
	
	/*
	/////////////////////////// in-page display ////////////////////////////////////////////
	*/
		$inPage="";
		$inPage.="	<div class='thirteen columns offset-by-three'><div class='whiteBox ten columns pad10'>\n";
		if (isset($_POST['Email'])) { $inPage.="		<div class='two columns'><strong>From:</strong> </div><div class='seven columns'><strong>" . $FirstName . " " . $LastName . " &lt;" . $Email . "&gt;</strong></div>\n"; }
		$inPage.="		<div class='two columns'><strong>Subject:</strong> </div><div class='seven columns'>" . $subject . "</div>\n";
		$inPage.="		<div class='two columns'><strong>To:</strong> </div><div class='seven columns'>" . htmlentities($to) . "</div>\n";
		$inPage.="	</div>";
		$inPage.="	<div class='blueBox ten columns'><img class='wide100' src='/images/Trace-Logo-Short-Address-Block-Top.png' alt='Trace Analytics - The AirCheck Lab' /></div>";
		$inPage.="	<div class='whiteBox ten columns'>\n";
		if ($request=="1" || $request=="2") { $inPage.="		<div class='nine columns'>Thank you for contacting Trace Analytics, The AirCheck Lab&trade;. Our Team of Experts will respond to your inquiry as soon as possible.<hr /></div>\n"; }
		
		if ($request =="3") { $inPage.="		<div class='nine columns'>Thank you for submitting your additional order information to Trace Analytics, The AirCheck Lab&trade;. Our Team of Experts will respond to your inquiry as soon as possible.<hr /></div>\n"; }
		$inPage.="		<div class='three columns'><strong>Subject:</strong> </div><div class='six columns padl10'>" . $subject . "</div>\n";
		if (isset($msgID))					{ $inPage.="		<div class='three columns'><strong>Reference No:</strong> </div><div class='six columns padl10'>" . $msgID . "&nbsp;</div>\n"; }
		if (isset($_POST['FirstName']))		{ $inPage.="		<div class='three columns'><strong>First Name:</strong> </div><div class='six columns padl10'>" . $FirstName . "&nbsp;</div>\n"; }
		if (isset($_POST['LastName']))		{ $inPage.="		<div class='three columns'><strong>Last Name:</strong> </div><div class='six columns padl10'>" . $LastName . "&nbsp;</div>\n"; }
		if (isset($_POST['Phone']))			{ $inPage.="		<div class='three columns'><strong>Phone:</strong> </div><div class='six columns padl10'>" . $Phone . "&nbsp;</div>\n"; }
		if (isset($_POST['Mobile']))		{ $inPage.="		<div class='three columns'><strong>Mobile:</strong> </div><div class='six columns padl10'>" . $Mobile . "&nbsp;</div>\n"; }
		if (isset($_POST['Fax']))			{ $inPage.="		<div class='three columns'><strong>Fax:</strong> </div><div class='six columns padl10'>" . $Fax . "&nbsp;</div>\n"; }
		if (isset($_POST['Email']))			{ $inPage.="		<div class='three columns'><strong>Email:</strong> </div><div class='six columns padl10'>" . $Email . "&nbsp;</div>\n"; }
		if (isset($_POST['Organization']))	{ $inPage.="		<div class='three columns'><strong>Company:</strong> </div><div class='six columns padl10'>" . $Organization . "&nbsp;</div>\n"; }
		if (isset($_POST['CustomerNo']))	{ $inPage.="		<div class='three columns'><strong>Customer No.:</strong> </div><div class='six columns padl10'>" . $CustomerNo . "&nbsp;</div>\n"; }
		if (isset($_POST['JobTitle']))		{ $inPage.="		<div class='three columns'><strong>Job Title:</strong> </div><div class='six columns padl10'>" . $JobTitle . "&nbsp;</div>\n"; }
		if (isset($_POST['City']))			{ $inPage.="		<div class='three columns'><strong>City:</strong> </div><div class='six columns padl10'>" . $City . "&nbsp;</div>\n"; }
		if (isset($_POST['State']))			{ $inPage.="		<div class='three columns'><strong>State:</strong> </div><div class='six columns padl10'>" . $State . "&nbsp;</div>\n"; }
		if (isset($_POST['ZipCode']))		{ $inPage.="		<div class='three columns'><strong>State:</strong> </div><div class='six columns padl10'>" . $ZipCode . "&nbsp;</div>\n"; }
		if (isset($_POST['Country']))		{ $inPage.="		<div class='three columns'><strong>Country:</strong> </div><div class='six columns padl10'>" . $Country . "&nbsp;</div>\n"; }
		if (isset($_POST['TraceQuote']))	{ $inPage.="		<div class='three columns'><strong>Quote No:</strong> </div><div class='six columns padl10'>" . $TraceQuote . "&nbsp;</div>\n"; }
		if (isset($_POST['brochure']))		{ $inPage.="		<div class='three columns'><strong>Brochures:</strong> </div><div class='six columns padl10'>" . $msgbrochures . "&nbsp;</div>\n"; }
		if (isset($_POST['contactVia'])) { 
			$inPage.="<div class='ten columns'><strong>How would you like us to contact you?</strong>\n";
			$inPage.="<p style='padding-left:15px; margin-top:0; padding-top:0;'>Please contact me via " . $contactVia. "</p></div>\n";
			}
		if (isset($_POST['SampleMethod'])) { 
			$inPage.="<div class='ten columns'><strong>Which sampling method do you prefer?</strong>\n";
			$inPage.="<p style='padding-left:15px; margin-top:0; padding-top:0;'>" . $SampleMethod. "</p></div>\n";
			}
		if (isset($_POST['SampleCount'])) { 
			$inPage.="<div class='ten columns'><strong>How many samples do you plan on taking? How often do you need to sample?</strong>\n";
			$inPage.="<p style='padding-left:15px; margin-top:0; padding-top:0;'>" . $SampleCount. "</p></div>\n";
			}
		if (isset($_POST['PurityClass'])) { 
			$inPage.="<div class='ten columns'><strong>If known, what Purity Class(es) do you require analysis for? [__:__:__]</strong>\n";
			$inPage.="<p style='padding-left:15px; margin-top:0; padding-top:0;'>" . $PurityClass. "</p></div>\n";
			}
		if (isset($_POST['HowUse'])) { 
			if ($request == "4") {
				$inPage.="<div class='ten columns'><strong>Restock Information:</strong>\n";
				$inPage.="<p style='padding-left:15px; margin-top:0; padding-top:0;'>" . nl2br($HowUse) . "</p></div>\n";
				}
			else {
				$inPage.="<div class='ten columns'><strong>How do you use your compressed air or gas?</strong>\n";
				$inPage.="<p style='padding-left:15px; margin-top:0; padding-top:0;'>" . nl2br($HowUse) . "</p></div>\n";
				}
			}
		if (isset($_POST['HowHelp'])) { 
			$inPage.="<div class='ten columns'><strong>How can we help you?</strong>\n";
			$inPage.="<p style='padding-left:15px; margin-top:0; padding-top:0;'>" . nl2br($HowHelp) . "</p></div>\n";
			}
		
		if (isset($_POST['AltFirstName']))		{ $inPage.="		<div class='nine columns'><hr /><h3>Secondary Contact:</h3></div>\n"; }
		if (isset($_POST['AltFirstName']))		{ $inPage.="		<div class='three columns'><strong>First Name:</strong> </div><div class='six columns padl10'>" . $AltFirstName . "&nbsp;</div>\n"; }
		if (isset($_POST['AltLastName']))		{ $inPage.="		<div class='three columns'><strong>Last Name:</strong> </div><div class='six columns padl10'>" . $AltLastName . "&nbsp;</div>\n"; }
		if (isset($_POST['AltEmail']))			{ $inPage.="		<div class='three columns'><strong>Email:</strong> </div><div class='six columns padl10'>" . $AltEmail . "&nbsp;</div>\n"; }
		if (isset($_POST['AltPhone']))			{ $inPage.="		<div class='three columns'><strong>Phone:</strong> </div><div class='six columns padl10'>" . $AltPhone . "&nbsp;</div>\n"; }
		if (isset($_POST['AltMobile']))			{ $inPage.="		<div class='three columns'><strong>Mobile:</strong> </div><div class='six columns padl10'>" . $AltMobile . "&nbsp;</div>\n"; }
		if (isset($_POST['AltFax']))			{ $inPage.="		<div class='three columns'><strong>Fax:</strong> </div><div class='six columns padl10'>" . $AltFax . "&nbsp;</div>\n"; }
		if (isset($_POST['MailingAddress']))	{ $inPage.="		<div class='nine columns'><hr /><h3>Mailing Address:</h3></div>\n"; }
		if (isset($_POST['MailingAddress']))	{ $inPage.="		<div class='three columns'><strong>Address:</strong> </div><div class='six columns padl10'>" . $MailingAddress . "&nbsp;</div>\n"; }
		if (isset($_POST['MailingCity']))		{ $inPage.="		<div class='three columns'><strong>City:</strong> </div><div class='six columns padl10'>" . $MailingCity . "&nbsp;</div>\n"; }
		if (isset($_POST['MailingState']))		{ $inPage.="		<div class='three columns'><strong>State:</strong> </div><div class='six columns padl10'>" . $MailingState . "&nbsp;</div>\n"; }
		if (isset($_POST['MailingZip']))		{ $inPage.="		<div class='three columns'><strong>Zip:</strong> </div><div class='six columns padl10'>" . $MailingZip . "&nbsp;</div>\n"; }
		if (isset($_POST['MailingCountry']))	{ $inPage.="		<div class='three columns'><strong>Country:</strong> </div><div class='six columns padl10'>" . $MailingCountry . "&nbsp;</div>\n"; }
	
		$inPage.= '	</div>';
		$inPage.="	<div class='blueBox ten columns'><img class='wide100' src='/images/Trace-Logo-Short-Address-Block-Bottom.png' alt='Trace Analytics - The AirCheck Lab' /></div>";
		$inPage.= '	</div>';
		$inPage.= '';
	
	// Send the email
	$msg = stripcslashes($msg);
	if ($subject !== 'Default Subject from ') { trace_mail($to,$replyTo,$fromName,$fromEmail,$subject,$msg); }
	
	// Set the sessions
	if (session_status() == PHP_SESSION_NONE) { session_start(); }
	$_SESSION['inPage'] = stripcslashes($inPage);
	$_SESSION['to'] = $to;
	


/*
	echo '<hr /><hr /><pre>';
	print_r(get_defined_vars());
	echo '</pre>';
*/



	header('Location: http://' . $WebServer . '/Thank-You');

/*
	}
else {
	header('Location: http://' . $WebServer);
}
*/

?>