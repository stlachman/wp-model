<?php
/* 
Template Name: Process Account Signup
*/

// check for javascript-created field.
/* if (!isset($_POST['iowe747id8jej3748'])) { */

/*
echo '<pre>';
print_r($_POST);
// print_r(get_defined_vars());
echo '</pre>';
*/

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
		
// 	$to = "Justin Smith <Justin@AirCheckLab.com>";
 	$to = "AirCheck Service Team <ServiceTeam@AirCheckLab.com>, CDATest <CDATest@airchecklab.com>";
	
	// BCC field is set in /php/functions.php in the Recipients line. Yeah, I should add it to the parameters sent to the function...
	// Gmail SMTP does not allow us to actually change the 'from' email.
	$fromName = "AirCheck Web Request";
	$fromEmail = "ServiceTeam@AirCheckLab.com";
	
	// Visitor Info
	$IPAddress = $_SERVER['REMOTE_ADDR'];
	$UserAgent = $_SERVER['HTTP_USER_AGENT'];
	$WebServer = $_SERVER['HTTP_HOST'];
	
if (isset($_POST['AccountType'])) { $AccountType = $_POST['AccountType']; }
if (isset($_POST['CompanyName'])) { $CompanyName = $_POST['CompanyName']; }
if (isset($_POST['CompanyType'])) { $CompanyType = $_POST['CompanyType']; }
if (isset($_POST['DirectKit'])) { $DirectKit = $_POST['DirectKit']; }
if (isset($_POST['Website'])) { $Website = $_POST['Website']; }
if (isset($_POST['social'])) {
		$socialcount = count($_POST["social"]);
		$msgsocial = '';
		$sqlsocial = '';
		for ($i = 0; $i < $socialcount; $i++)
		{
		  $msgsocial.= $_POST["social"][$i].'<br />';
		  $sqlsocial.= $_POST["social"][$i]."\n";
		}
	}
if (isset($_POST['HowFind']))   { $HowFind = $_POST['HowFind']; }
if (isset($_POST['HowFindOther'])) { $HowFindOther = $_POST['HowFindOther']; }
if (isset($_POST['Spec'])) { $Spec = $_POST['Spec']; }
if (isset($_POST['Industry'])) { $Industry = $_POST['Industry']; }
if (isset($_POST['TestedPreviously'])) { $TestedPreviously = $_POST['TestedPreviously']; }
if (isset($_POST['TestedPreviouslyLabs'])) { $TestedPreviouslyLabs = htmlspecialchars($_POST['TestedPreviouslyLabs']); }
if (isset($_POST['PrimaryFirstName'])) { $PrimaryFirstName = $_POST['PrimaryFirstName']; }
if (isset($_POST['PrimaryLastName'])) { $PrimaryLastName = $_POST['PrimaryLastName']; }
if (isset($_POST['PrimaryJobTitle'])) { $PrimaryJobTitle = $_POST['PrimaryJobTitle']; }
if (isset($_POST['PrimaryDirectPhone'])) { $PrimaryDirectPhone = $_POST['PrimaryDirectPhone']; }
if (isset($_POST['PrimaryDirectPhoneExtension'])) { $PrimaryDirectPhoneExtension = $_POST['PrimaryDirectPhoneExtension']; }
if (isset($_POST['PrimaryMobilePhone'])) { $PrimaryMobilePhone = $_POST['PrimaryMobilePhone']; }
if (isset($_POST['PrimaryEmail'])) { $PrimaryEmail = $_POST['PrimaryEmail']; }
if (isset($_POST['PrimaryContactEmailInfo'])) { $PrimaryContactEmailInfo = $_POST['PrimaryContactEmailInfo']; }
if (isset($_POST['Alternate1FirstName'])) { $Alternate1FirstName = $_POST['Alternate1FirstName']; }
if (isset($_POST['Alternate1LastName'])) { $Alternate1LastName = $_POST['Alternate1LastName']; }
if (isset($_POST['Alternate1JobTitle'])) { $Alternate1JobTitle = $_POST['Alternate1JobTitle']; }
if (isset($_POST['Alternate1DirectPhone'])) { $Alternate1DirectPhone = $_POST['Alternate1DirectPhone']; }
if (isset($_POST['Alternate1DirectPhoneExtension'])) { $Alternate1DirectPhoneExtension = $_POST['Alternate1DirectPhoneExtension']; }
if (isset($_POST['Alternate1MobilePhone'])) { $Alternate1MobilePhone = $_POST['Alternate1MobilePhone']; }
if (isset($_POST['Alternate1Email'])) { $Alternate1Email = $_POST['Alternate1Email']; }
if (isset($_POST['Alternate1ContactEmailInfo'])) { $Alternate1ContactEmailInfo = $_POST['Alternate1ContactEmailInfo']; }
if (isset($_POST['Alternate2FirstName'])) { $Alternate2FirstName = $_POST['Alternate2FirstName']; }
if (isset($_POST['Alternate2LastName'])) { $Alternate2LastName = $_POST['Alternate2LastName']; }
if (isset($_POST['Alternate2JobTitle'])) { $Alternate2JobTitle = $_POST['Alternate2JobTitle']; }
if (isset($_POST['Alternate2DirectPhone'])) { $Alternate2DirectPhone = $_POST['Alternate2DirectPhone']; }
if (isset($_POST['Alternate2DirectPhoneExtension'])) { $Alternate2DirectPhoneExtension = $_POST['Alternate2DirectPhoneExtension']; }
if (isset($_POST['Alternate2MobilePhone'])) { $Alternate2MobilePhone = $_POST['Alternate2MobilePhone']; }
if (isset($_POST['Alternate2Email'])) { $Alternate2Email = $_POST['Alternate2Email']; }
if (isset($_POST['Alternate2ContactEmailInfo'])) { $Alternate2ContactEmailInfo = $_POST['Alternate2ContactEmailInfo']; }
if (isset($_POST['BillingFirstName'])) { $BillingFirstName = $_POST['BillingFirstName']; }
if (isset($_POST['BillingLastName'])) { $BillingLastName = $_POST['BillingLastName']; }
if (isset($_POST['BillingJobTitle'])) { $BillingJobTitle = $_POST['BillingJobTitle']; }
if (isset($_POST['BillingDirectPhone'])) { $BillingDirectPhone = $_POST['BillingDirectPhone']; }
if (isset($_POST['BillingDirectPhoneExtension'])) { $BillingDirectPhoneExtension = $_POST['BillingDirectPhoneExtension']; }
if (isset($_POST['BillingMobilePhone'])) { $BillingMobilePhone = $_POST['BillingMobilePhone']; }
if (isset($_POST['BillingEmail'])) { $BillingEmail = $_POST['BillingEmail']; }
if (isset($_POST['BillingContactEmailInfo'])) { $BillingContactEmailInfo = $_POST['BillingContactEmailInfo']; }
if (isset($_POST['ShippingFirstName'])) { $ShippingFirstName = $_POST['ShippingFirstName']; }
if (isset($_POST['ShippingLastName'])) { $ShippingLastName = $_POST['ShippingLastName']; }
if (isset($_POST['ShippingJobTitle'])) { $ShippingJobTitle = $_POST['ShippingJobTitle']; }
if (isset($_POST['ShippingDirectPhone'])) { $ShippingDirectPhone = $_POST['ShippingDirectPhone']; }
if (isset($_POST['ShippingDirectPhoneExtension'])) { $ShippingDirectPhoneExtension = $_POST['ShippingDirectPhoneExtension']; }
if (isset($_POST['ShippingMobilePhone'])) { $ShippingMobilePhone = $_POST['ShippingMobilePhone']; }
if (isset($_POST['ShippingEmail'])) { $ShippingEmail = $_POST['ShippingEmail']; }
if (isset($_POST['ShippingContactEmailInfo'])) { $ShippingContactEmailInfo = $_POST['ShippingContactEmailInfo']; }
if (isset($_POST['SamplingTech1FirstName'])) { $SamplingTech1FirstName = $_POST['SamplingTech1FirstName']; }
if (isset($_POST['SamplingTech1LastName'])) { $SamplingTech1LastName = $_POST['SamplingTech1LastName']; }
if (isset($_POST['SamplingTech1Email'])) { $SamplingTech1Email = $_POST['SamplingTech1Email']; }
if (isset($_POST['SamplingTech1MobilePhone'])) { $SamplingTech1MobilePhone = $_POST['SamplingTech1MobilePhone']; }
if (isset($_POST['SamplingTech2FirstName'])) { $SamplingTech2FirstName = $_POST['SamplingTech2FirstName']; }
if (isset($_POST['SamplingTech2LastName'])) { $SamplingTech2LastName = $_POST['SamplingTech2LastName']; }
if (isset($_POST['SamplingTech2Email'])) { $SamplingTech2Email = $_POST['SamplingTech2Email']; }
if (isset($_POST['SamplingTech2MobilePhone'])) { $SamplingTech2MobilePhone = $_POST['SamplingTech2MobilePhone']; }
if (isset($_POST['SamplingTech3FirstName'])) { $SamplingTech3FirstName = $_POST['SamplingTech3FirstName']; }
if (isset($_POST['SamplingTech3LastName'])) { $SamplingTech3LastName = $_POST['SamplingTech3LastName']; }
if (isset($_POST['SamplingTech3Email'])) { $SamplingTech3Email = $_POST['SamplingTech3Email']; }
if (isset($_POST['SamplingTech3MobilePhone'])) { $SamplingTech3MobilePhone = $_POST['SamplingTech3MobilePhone']; }
if (isset($_POST['AcctsPayableStreet'])) { $AcctsPayableStreet = $_POST['AcctsPayableStreet']; }
if (isset($_POST['AcctsPayableStreet2'])) { $AcctsPayableStreet2 = $_POST['AcctsPayableStreet2']; }
if (isset($_POST['AcctsPayableCity'])) { $AcctsPayableCity = $_POST['AcctsPayableCity']; }
if (isset($_POST['AcctsPayableState'])) { $AcctsPayableState = $_POST['AcctsPayableState']; }
if (isset($_POST['AcctsPayableZipCode'])) { $AcctsPayableZipCode = $_POST['AcctsPayableZipCode']; }
if (isset($_POST['AcctsPayableCountry'])) { $AcctsPayableCountry = $_POST['AcctsPayableCountry']; }
if (isset($_POST['ShippingStreet'])) { $ShippingStreet = $_POST['ShippingStreet']; }
if (isset($_POST['ShippingStreet2'])) { $ShippingStreet2 = $_POST['ShippingStreet2']; }
if (isset($_POST['ShippingCity'])) { $ShippingCity = $_POST['ShippingCity']; }
if (isset($_POST['ShippingState'])) { $ShippingState = $_POST['ShippingState']; }
if (isset($_POST['ShippingZipCode'])) { $ShippingZipCode = $_POST['ShippingZipCode']; }
if (isset($_POST['ShippingCountry'])) { $ShippingCountry = $_POST['ShippingCountry']; }
if (isset($_POST['MailingStreet'])) { $MailingStreet = $_POST['MailingStreet']; }
if (isset($_POST['MailingStreet2'])) { $MailingStreet2 = $_POST['MailingStreet2']; }
if (isset($_POST['MailingCity'])) { $MailingCity = $_POST['MailingCity']; }
if (isset($_POST['MailingState'])) { $MailingState = $_POST['MailingState']; }
if (isset($_POST['MailingZipCode'])) { $MailingZipCode = $_POST['MailingZipCode']; }
if (isset($_POST['MailingCountry'])) { $MailingCountry = $_POST['MailingCountry']; }
if (isset($_POST['ServiceArea'])) { $ServiceArea = $_POST['ServiceArea']; }
if (isset($_POST['PONumber'])) { $PONumber = $_POST['PONumber']; }
if (isset($_POST['QuoteNumber'])) { $QuoteNumber = $_POST['QuoteNumber']; }
if (isset($_POST['POAmount'])) { $POAmount = $_POST['POAmount']; }
if (isset($_POST['CreditCardNo'])) { $CreditCardNo = $_POST['CreditCardNo']; }
if (isset($_POST['CreditCardCVV'])) { $CreditCardCVV = $_POST['CreditCardCVV']; }
if (isset($_POST['CreditCardExp'])) { $CreditCardExp = $_POST['CreditCardExp']; }
if (isset($_POST['BillingInstructions'])) { $BillingInstructions = $_POST['BillingInstructions']; }
if (isset($_POST['TestingFrequency'])) { $TestingFrequency = $_POST['TestingFrequency']; }
if (isset($_POST['RentalOrPurchase'])) { $RentalOrPurchase = $_POST['RentalOrPurchase']; }
if (isset($_POST['ShipCarrier'])) { $ShipCarrier = $_POST['ShipCarrier']; }
if (isset($_POST['OtherShipCarrier'])) { $OtherShipCarrier = $_POST['OtherShipCarrier']; }
if (isset($_POST['ShipSpeed'])) { $ShipSpeed = $_POST['ShipSpeed']; }
if (isset($_POST['ShippingPayMethod'])) { $ShippingPayMethod = $_POST['ShippingPayMethod']; }
if (isset($_POST['ShippingAcctNo'])) { $ShippingAcctNo = $_POST['ShippingAcctNo']; }
if (isset($_POST['Comments'])) { $Comments = htmlspecialchars($_POST['Comments']); }

// 	$subject = $AccountType . ' Account Signup Request';
	$subject = 'Account Signup Request from ' . $PrimaryFirstName . ' ' . $PrimaryLastName;
	$replyTo = $PrimaryEmail;



	/*
	/////////////////////////// insert into MySQL ////////////////////////////////////////////
	*/
	// escape all of the strings
$my_AccountType = mysql_real_escape_string($AccountType);
$my_CompanyName = mysql_real_escape_string($CompanyName);
$my_CompanyType = mysql_real_escape_string($CompanyType);
$my_DirectKit = mysql_real_escape_string($DirectKit);
$my_Website = mysql_real_escape_string($Website);
$my_social = mysql_real_escape_string($sqlsocial);
$my_HowFind = mysql_real_escape_string($HowFind);
$my_HowFindOther = mysql_real_escape_string($HowFindOther);
$my_Spec = mysql_real_escape_string($Spec);
$my_Industry = mysql_real_escape_string($Industry);
$my_TestedPreviously = mysql_real_escape_string($TestedPreviously);
$my_TestedPreviouslyLabs = mysql_real_escape_string($TestedPreviouslyLabs);
$my_PrimaryFirstName = mysql_real_escape_string($PrimaryFirstName);
$my_PrimaryLastName = mysql_real_escape_string($PrimaryLastName);
$my_PrimaryJobTitle = mysql_real_escape_string($PrimaryJobTitle);
$my_PrimaryDirectPhone = mysql_real_escape_string($PrimaryDirectPhone);
$my_PrimaryDirectPhoneExtension = mysql_real_escape_string($PrimaryDirectPhoneExtension);
$my_PrimaryMobilePhone = mysql_real_escape_string($PrimaryMobilePhone);
$my_PrimaryEmail = mysql_real_escape_string($PrimaryEmail);
$my_PrimaryContactEmailInfo = mysql_real_escape_string($PrimaryContactEmailInfo);
$my_Alternate1FirstName = mysql_real_escape_string($Alternate1FirstName);
$my_Alternate1LastName = mysql_real_escape_string($Alternate1LastName);
$my_Alternate1JobTitle = mysql_real_escape_string($Alternate1JobTitle);
$my_Alternate1DirectPhone = mysql_real_escape_string($Alternate1DirectPhone);
$my_Alternate1DirectPhoneExtension = mysql_real_escape_string($Alternate1DirectPhoneExtension);
$my_Alternate1MobilePhone = mysql_real_escape_string($Alternate1MobilePhone);
$my_Alternate1Email = mysql_real_escape_string($Alternate1Email);
$my_Alternate1ContactEmailInfo = mysql_real_escape_string($Alternate1ContactEmailInfo);
$my_Alternate2FirstName = mysql_real_escape_string($Alternate2FirstName);
$my_Alternate2LastName = mysql_real_escape_string($Alternate2LastName);
$my_Alternate2JobTitle = mysql_real_escape_string($Alternate2JobTitle);
$my_Alternate2DirectPhone = mysql_real_escape_string($Alternate2DirectPhone);
$my_Alternate2DirectPhoneExtension = mysql_real_escape_string($Alternate2DirectPhoneExtension);
$my_Alternate2MobilePhone = mysql_real_escape_string($Alternate2MobilePhone);
$my_Alternate2Email = mysql_real_escape_string($Alternate2Email);
$my_Alternate2ContactEmailInfo = mysql_real_escape_string($Alternate2ContactEmailInfo);
$my_BillingFirstName = mysql_real_escape_string($BillingFirstName);
$my_BillingLastName = mysql_real_escape_string($BillingLastName);
$my_BillingJobTitle = mysql_real_escape_string($BillingJobTitle);
$my_BillingDirectPhone = mysql_real_escape_string($BillingDirectPhone);
$my_BillingDirectPhoneExtension = mysql_real_escape_string($BillingDirectPhoneExtension);
$my_BillingMobilePhone = mysql_real_escape_string($BillingMobilePhone);
$my_BillingEmail = mysql_real_escape_string($BillingEmail);
$my_BillingContactEmailInfo = mysql_real_escape_string($BillingContactEmailInfo);
$my_ShippingFirstName = mysql_real_escape_string($ShippingFirstName);
$my_ShippingLastName = mysql_real_escape_string($ShippingLastName);
$my_ShippingJobTitle = mysql_real_escape_string($ShippingJobTitle);
$my_ShippingDirectPhone = mysql_real_escape_string($ShippingDirectPhone);
$my_ShippingDirectPhoneExtension = mysql_real_escape_string($ShippingDirectPhoneExtension);
$my_ShippingMobilePhone = mysql_real_escape_string($ShippingMobilePhone);
$my_ShippingEmail = mysql_real_escape_string($ShippingEmail);
$my_ShippingContactEmailInfo = mysql_real_escape_string($ShippingContactEmailInfo);
$my_SamplingTech1FirstName = mysql_real_escape_string($SamplingTech1FirstName);
$my_SamplingTech1LastName = mysql_real_escape_string($SamplingTech1LastName);
$my_SamplingTech1Email = mysql_real_escape_string($SamplingTech1Email);
$my_SamplingTech1MobilePhone = mysql_real_escape_string($SamplingTech1MobilePhone);
$my_SamplingTech2FirstName = mysql_real_escape_string($SamplingTech2FirstName);
$my_SamplingTech2LastName = mysql_real_escape_string($SamplingTech2LastName);
$my_SamplingTech2Email = mysql_real_escape_string($SamplingTech2Email);
$my_SamplingTech2MobilePhone = mysql_real_escape_string($SamplingTech2MobilePhone);
$my_SamplingTech3FirstName = mysql_real_escape_string($SamplingTech3FirstName);
$my_SamplingTech3LastName = mysql_real_escape_string($SamplingTech3LastName);
$my_SamplingTech3Email = mysql_real_escape_string($SamplingTech3Email);
$my_SamplingTech3MobilePhone = mysql_real_escape_string($SamplingTech3MobilePhone);
$my_AcctsPayableStreet = mysql_real_escape_string($AcctsPayableStreet);
$my_AcctsPayableStreet2 = mysql_real_escape_string($AcctsPayableStreet2);
$my_AcctsPayableCity = mysql_real_escape_string($AcctsPayableCity);
$my_AcctsPayableState = mysql_real_escape_string($AcctsPayableState);
$my_AcctsPayableZipCode = mysql_real_escape_string($AcctsPayableZipCode);
$my_AcctsPayableCountry = mysql_real_escape_string($AcctsPayableCountry);
$my_ShippingStreet = mysql_real_escape_string($ShippingStreet);
$my_ShippingStreet2 = mysql_real_escape_string($ShippingStreet2);
$my_ShippingCity = mysql_real_escape_string($ShippingCity);
$my_ShippingState = mysql_real_escape_string($ShippingState);
$my_ShippingZipCode = mysql_real_escape_string($ShippingZipCode);
$my_ShippingCountry = mysql_real_escape_string($ShippingCountry);
$my_MailingStreet = mysql_real_escape_string($MailingStreet);
$my_MailingStreet2 = mysql_real_escape_string($MailingStreet2);
$my_MailingCity = mysql_real_escape_string($MailingCity);
$my_MailingState = mysql_real_escape_string($MailingState);
$my_MailingZipCode = mysql_real_escape_string($MailingZipCode);
$my_MailingCountry = mysql_real_escape_string($MailingCountry);
$my_ServiceArea = mysql_real_escape_string($ServiceArea);
$my_PONumber = mysql_real_escape_string($PONumber);
$my_QuoteNumber = mysql_real_escape_string($QuoteNumber);
$my_POAmount = mysql_real_escape_string($POAmount);
$my_CreditCardNo = mysql_real_escape_string($CreditCardNo);
$my_CreditCardCVV = mysql_real_escape_string($CreditCardCVV);
$my_CreditCardExp = mysql_real_escape_string($CreditCardExp);
$my_BillingInstructions = mysql_real_escape_string($BillingInstructions);
$my_TestingFrequency = mysql_real_escape_string($TestingFrequency);
$my_RentalOrPurchase = mysql_real_escape_string($RentalOrPurchase);
$my_ShipCarrier = mysql_real_escape_string($ShipCarrier);
$my_OtherShipCarrier = mysql_real_escape_string($OtherShipCarrier);
$my_ShipSpeed = mysql_real_escape_string($ShipSpeed);
$my_ShippingPayMethod = mysql_real_escape_string($ShippingPayMethod);
$my_ShippingAcctNo = mysql_real_escape_string($ShippingAcctNo);
$my_Comments = mysql_real_escape_string($Comments);
	
	// Insert into MySQL AirCheckWeb » ContactRequests table
	$sql = "insert into AccountSignup(DateSubmitted,AccountType,CompanyName,CompanyType,DirectKit,Website,social,HowFind,HowFindOther,Spec,Industry,TestedPreviously,TestedPreviouslyLabs,PrimaryFirstName,PrimaryLastName,PrimaryJobTitle,PrimaryDirectPhone,PrimaryDirectPhoneExtension,PrimaryMobilePhone,PrimaryEmail,PrimaryContactEmailInfo,Alternate1FirstName,Alternate1LastName,Alternate1JobTitle,Alternate1DirectPhone,Alternate1DirectPhoneExtension,Alternate1MobilePhone,Alternate1Email,Alternate1ContactEmailInfo,Alternate2FirstName,Alternate2LastName,Alternate2JobTitle,Alternate2DirectPhone,Alternate2DirectPhoneExtension,Alternate2MobilePhone,Alternate2Email,Alternate2ContactEmailInfo,BillingFirstName,BillingLastName,BillingJobTitle,BillingDirectPhone,BillingDirectPhoneExtension,BillingMobilePhone,BillingEmail,BillingContactEmailInfo,ShippingFirstName,ShippingLastName,ShippingJobTitle,ShippingDirectPhone,ShippingDirectPhoneExtension,ShippingMobilePhone,ShippingEmail,ShippingContactEmailInfo,SamplingTech1FirstName,SamplingTech1LastName,SamplingTech1Email,SamplingTech1MobilePhone,SamplingTech2FirstName,SamplingTech2LastName,SamplingTech2Email,SamplingTech2MobilePhone,SamplingTech3FirstName,SamplingTech3LastName,SamplingTech3Email,SamplingTech3MobilePhone,AcctsPayableStreet,AcctsPayableStreet2,AcctsPayableCity,AcctsPayableState,AcctsPayableZipCode,AcctsPayableCountry,ShippingStreet,ShippingStreet2,ShippingCity,ShippingState,ShippingZipCode,ShippingCountry,MailingStreet,MailingStreet2,MailingCity,MailingState,MailingZipCode,MailingCountry,ServiceArea,PONumber,QuoteNumber,POAmount,CreditCardNo,CreditCardCVV,CreditCardExp,BillingInstructions,TestingFrequency,RentalOrPurchase,ShipCarrier,OtherShipCarrier,ShipSpeed,ShippingPayMethod,ShippingAcctNo,Comments) values(now(),'$my_AccountType','$my_CompanyName','$my_CompanyType','$my_DirectKit','$my_Website','$my_social','$my_HowFind','$my_HowFindOther','$my_Spec','$my_Industry','$my_TestedPreviously','$my_TestedPreviouslyLabs','$my_PrimaryFirstName','$my_PrimaryLastName','$my_PrimaryJobTitle','$my_PrimaryDirectPhone','$my_PrimaryDirectPhoneExtension','$my_PrimaryMobilePhone','$my_PrimaryEmail','$my_PrimaryContactEmailInfo','$my_Alternate1FirstName','$my_Alternate1LastName','$my_Alternate1JobTitle','$my_Alternate1DirectPhone','$my_Alternate1DirectPhoneExtension','$my_Alternate1MobilePhone','$my_Alternate1Email','$my_Alternate1ContactEmailInfo','$my_Alternate2FirstName','$my_Alternate2LastName','$my_Alternate2JobTitle','$my_Alternate2DirectPhone','$my_Alternate2DirectPhoneExtension','$my_Alternate2MobilePhone','$my_Alternate2Email','$my_Alternate2ContactEmailInfo','$my_BillingFirstName','$my_BillingLastName','$my_BillingJobTitle','$my_BillingDirectPhone','$my_BillingDirectPhoneExtension','$my_BillingMobilePhone','$my_BillingEmail','$my_BillingContactEmailInfo','$my_ShippingFirstName','$my_ShippingLastName','$my_ShippingJobTitle','$my_ShippingDirectPhone','$my_ShippingDirectPhoneExtension','$my_ShippingMobilePhone','$my_ShippingEmail','$my_ShippingContactEmailInfo','$my_SamplingTech1FirstName','$my_SamplingTech1LastName','$my_SamplingTech1Email','$my_SamplingTech1MobilePhone','$my_SamplingTech2FirstName','$my_SamplingTech2LastName','$my_SamplingTech2Email','$my_SamplingTech2MobilePhone','$my_SamplingTech3FirstName','$my_SamplingTech3LastName','$my_SamplingTech3Email','$my_SamplingTech3MobilePhone','$my_AcctsPayableStreet','$my_AcctsPayableStreet2','$my_AcctsPayableCity','$my_AcctsPayableState','$my_AcctsPayableZipCode','$my_AcctsPayableCountry','$my_ShippingStreet','$my_ShippingStreet2','$my_ShippingCity','$my_ShippingState','$my_ShippingZipCode','$my_ShippingCountry','$my_MailingStreet','$my_MailingStreet2','$my_MailingCity','$my_MailingState','$my_MailingZipCode','$my_MailingCountry','$my_ServiceArea','$my_PONumber','$my_QuoteNumber','$my_POAmount','$my_CreditCardNo','$my_CreditCardCVV','$my_CreditCardExp','$my_BillingInstructions','$my_TestingFrequency','$my_RentalOrPurchase','$my_ShipCarrier','$my_OtherShipCarrier','$my_ShipSpeed','$my_ShippingPayMethod','$my_ShippingAcctNo','$my_Comments')";

	// Only submit if it's not bingbot. Other bots haven't been submitting, but Bing has.
	if (stripos($UserAgent, 'bingbot') == FALSE) { mysql_query($sql); }
	

	// Get the pk_id of the previously inserted row.	
	$msgID = mysql_insert_id();
	mysql_close($link);

	/*
	/////////////////////////// html email ////////////////////////////////////////////
	*/
		$msg="";
		$msg.="<center><table style='width:600px;font-family:arial, helvetica, sans-serif; font-weight:normal; border-collapse:collapse; border:2px solid #3d63a9;margin: 10px; padding:0; background:#fff;box-shadow: 0 1px 4px #666;'>\n";
		$msg.="	<tr>\n";
		$msg.="	<tr><td style='background:#3d63a9;'><a href='http://" . $WebServer . "'><img width='600' src='https://" . $WebServer . "/images/Trace-Logo-Short-Address-Block-Blue-Top.png' alt='Trace Analytics - The AirCheck Lab' /></a></td></tr>\n";
		$msg.="	<tr>\n";
		$msg.="		<td style='padding:10px; margin:0;'>\n";
		$msg.="			<table style='width:580px;font-family:arial, helvetica, sans-serif; font-weight: normal;  border-collapse:collapse; border:none;margin: 0px auto 5px; background:#fff;'>\n";
		$msg.="				<tr>\n";
		$msg.="					<td style='padding:0; margin:0;'><img src='https://www.airchecklab.com/images/blank.gif' width='150' height='1' /></td>\n";
		$msg.="					<td style='padding:0; margin:0;'><img src='https://www.airchecklab.com/images/blank.gif' width='425' height='1' /></td>\n";
		$msg.="				</tr>\n";
		$msg.="				<tr>\n";
		$msg.="					<td colspan='2' style='padding:0px; margin:0;padding-bottom:10px;'>Thank you for contacting Trace Analytics, The AirCheck Lab&trade;. Our Team of Experts will respond to your inquiry as soon as possible.<hr /></td>\n";
		$msg.="				</tr>\n";
		$msg.="				<tr><td style='vertical-align:top;'><strong>Subject:</strong> </td><td style='vertical-align:top;'>" . $subject . "</td></tr>\n";
		if (isset($msgID)) { $msg.="				<tr><td style='vertical-align:top;'><strong>Reference No:</strong> </td><td style='vertical-align:top;'>" . $msgID . "</td></tr>\n"; }

if (isset($_POST['AccountType']) && $_POST['AccountType'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Account Type:</strong> </td><td style='vertical-align:top;'>" . $AccountType . "</td></tr>"; }
if (isset($_POST['CompanyName']) && $_POST['CompanyName'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Company Name:</strong> </td><td style='vertical-align:top;'>" . $CompanyName . "</td></tr>"; }

if (isset($_POST['CompanyType']) && $_POST['CompanyType'] !=="") { $msg.="<tr><td style='margin-top:15px; vertical-align:top;'><strong>Company Type:</strong> </td><td style='vertical-align:top;'>" . $CompanyType . "</td></tr>"; }
if (isset($_POST['DirectKit']) && $_POST['DirectKit'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Direct Kit:</strong> </td><td style='vertical-align:top;'>" . $DirectKit . "</td></tr>"; }
if (isset($_POST['Website']) && $_POST['Website'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Website:</strong> </td><td style='vertical-align:top;'>" . $Website . "</td></tr>"; }
if (isset($_POST['social']) && $_POST['social'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Social:</strong> </td><td style='vertical-align:top;'>" . $msgsocial . "</td></tr>"; }
if (isset($_POST['HowFind']) && $_POST['HowFind'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>How did you find us?</strong> </td><td style='vertical-align:top;'>" . $HowFind . "</td></tr>"; }
if (isset($_POST['HowFindOther']) && $_POST['HowFindOther'] !=="") { $msg.="<tr><td style='vertical-align:top;'></td><td style='vertical-align:top;'>" . $HowFindOther . "</td></tr>"; }
if (isset($_POST['TestedPreviously']) && $_POST['TestedPreviously'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Have you tested previously?</strong> </td><td style='vertical-align:top;'>" . $TestedPreviously . "</td></tr>"; }
if (isset($_POST['TestedPreviouslyLabs']) && $_POST['TestedPreviouslyLabs'] !=="") { $msg.="<tr><td style='vertical-align:top;'> </td><td style='vertical-align:top;'>" . $TestedPreviouslyLabs . "</td></tr>"; }

if (isset($_POST['Industry']) && $_POST['Industry'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>What is your industry?</strong> </td><td style='vertical-align:top;'>" . $Industry . "</td></tr>"; }
if (isset($_POST['Spec']) && $_POST['Spec'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Specification (if known):</strong> </td><td style='vertical-align:top;'>" . $Spec . "</td></tr>"; }

if (isset($_POST['PrimaryFirstName']) && $_POST['PrimaryFirstName'] !=="") { $msg.="<tr><td colspan='2'><h2 style='margin-top:15px;margin-bottom:0;'>Primary Contact</h2></td></tr>"; }
if (isset($_POST['PrimaryFirstName']) && $_POST['PrimaryFirstName'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>First Name:</strong> </td><td style='vertical-align:top;'>" . $PrimaryFirstName . "</td></tr>"; }
if (isset($_POST['PrimaryLastName']) && $_POST['PrimaryLastName'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Last Name:</strong> </td><td style='vertical-align:top;'>" . $PrimaryLastName . "</td></tr>"; }
if (isset($_POST['PrimaryJobTitle']) && $_POST['PrimaryJobTitle'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Job Title:</strong> </td><td style='vertical-align:top;'>" . $PrimaryJobTitle . "</td></tr>"; }
if (isset($_POST['PrimaryDirectPhone']) && $_POST['PrimaryDirectPhone'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Phone:</strong> </td><td style='vertical-align:top;'>" . $PrimaryDirectPhone . "</td></tr>"; }
if (isset($_POST['PrimaryDirectPhoneExtension']) && $_POST['PrimaryDirectPhoneExtension'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Extension:</strong> </td><td style='vertical-align:top;'>" . $PrimaryDirectPhoneExtension . "</td></tr>"; }
if (isset($_POST['PrimaryMobilePhone']) && $_POST['PrimaryMobilePhone'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Mobile:</strong> </td><td style='vertical-align:top;'>" . $PrimaryMobilePhone . "</td></tr>"; }
if (isset($_POST['PrimaryEmail']) && $_POST['PrimaryEmail'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Email:</strong> </td><td style='vertical-align:top;'>" . $PrimaryEmail . "</td></tr>"; }
if (isset($_POST['PrimaryContactEmailInfo']) && $_POST['PrimaryContactEmailInfo'] !=="") { $msg.="<tr><td style='vertical-align:top;'> </td><td style='vertical-align:top;'>" . $PrimaryContactEmailInfo . "</td></tr>"; }

if (isset($_POST['Alternate1FirstName']) && $_POST['Alternate1FirstName'] !=="") { $msg.="<tr><td colspan='2'><h2 style='margin-top:15px;margin-bottom:0;'>Alternate Contact 1</h2></td></tr>"; }
if (isset($_POST['Alternate1FirstName']) && $_POST['Alternate1FirstName'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>First Name:</strong> </td><td style='vertical-align:top;'>" . $Alternate1FirstName . "</td></tr>"; }
if (isset($_POST['Alternate1LastName']) && $_POST['Alternate1LastName'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Last Name:</strong> </td><td style='vertical-align:top;'>" . $Alternate1LastName . "</td></tr>"; }
if (isset($_POST['Alternate1JobTitle']) && $_POST['Alternate1JobTitle'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Job Title:</strong> </td><td style='vertical-align:top;'>" . $Alternate1JobTitle . "</td></tr>"; }
if (isset($_POST['Alternate1DirectPhone']) && $_POST['Alternate1DirectPhone'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Phone:</strong> </td><td style='vertical-align:top;'>" . $Alternate1DirectPhone . "</td></tr>"; }
if (isset($_POST['Alternate1DirectPhoneExtension']) && $_POST['Alternate1DirectPhoneExtension'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Extension:</strong> </td><td style='vertical-align:top;'>" . $Alternate1DirectPhoneExtension . "</td></tr>"; }
if (isset($_POST['Alternate1MobilePhone']) && $_POST['Alternate1MobilePhone'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Mobile:</strong> </td><td style='vertical-align:top;'>" . $Alternate1MobilePhone . "</td></tr>"; }
if (isset($_POST['Alternate1Email']) && $_POST['Alternate1Email'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Email:</strong> </td><td style='vertical-align:top;'>" . $Alternate1Email . "</td></tr>"; }
if (isset($_POST['Alternate1ContactEmailInfo']) && $_POST['Alternate1ContactEmailInfo'] !=="") { $msg.="<tr><td style='vertical-align:top;'> </td><td style='vertical-align:top;'>" . $Alternate1ContactEmailInfo . "</td></tr>"; }

if (isset($_POST['Alternate2FirstName']) && $_POST['Alternate2FirstName'] !=="") { $msg.="<tr><td colspan='2'><h2 style='margin-top:15px;margin-bottom:0;'>Alternate Contact 2</h2></td></tr>"; }
if (isset($_POST['Alternate2FirstName']) && $_POST['Alternate2FirstName'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>First Name:</strong> </td><td style='vertical-align:top;'>" . $Alternate2FirstName . "</td></tr>"; }
if (isset($_POST['Alternate2LastName']) && $_POST['Alternate2LastName'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Last Name:</strong> </td><td style='vertical-align:top;'>" . $Alternate2LastName . "</td></tr>"; }
if (isset($_POST['Alternate2JobTitle']) && $_POST['Alternate2JobTitle'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Job Title:</strong> </td><td style='vertical-align:top;'>" . $Alternate2JobTitle . "</td></tr>"; }
if (isset($_POST['Alternate2DirectPhone']) && $_POST['Alternate2DirectPhone'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Phone:</strong> </td><td style='vertical-align:top;'>" . $Alternate2DirectPhone . "</td></tr>"; }
if (isset($_POST['Alternate2DirectPhoneExtension']) && $_POST['Alternate2DirectPhoneExtension'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Extension:</strong> </td><td style='vertical-align:top;'>" . $Alternate2DirectPhoneExtension . "</td></tr>"; }
if (isset($_POST['Alternate2MobilePhone']) && $_POST['Alternate2MobilePhone'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Mobile:</strong> </td><td style='vertical-align:top;'>" . $Alternate2MobilePhone . "</td></tr>"; }
if (isset($_POST['Alternate2Email']) && $_POST['Alternate2Email'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Email:</strong> </td><td style='vertical-align:top;'>" . $Alternate2Email . "</td></tr>"; }
if (isset($_POST['Alternate2ContactEmailInfo']) && $_POST['Alternate2ContactEmailInfo'] !=="") { $msg.="<tr><td style='vertical-align:top;'> </td><td style='vertical-align:top;'>" . $Alternate2ContactEmailInfo . "</td></tr>"; }

if (isset($_POST['BillingFirstName']) && $_POST['BillingFirstName'] !=="") { $msg.="<tr><td colspan='2'><h2 style='margin-top:15px;margin-bottom:0;'>Billing Contact</h2></td></tr>"; }
if (isset($_POST['BillingFirstName']) && $_POST['BillingFirstName'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>First Name:</strong> </td><td style='vertical-align:top;'>" . $BillingFirstName . "</td></tr>"; }
if (isset($_POST['BillingLastName']) && $_POST['BillingLastName'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Last Name:</strong> </td><td style='vertical-align:top;'>" . $BillingLastName . "</td></tr>"; }
if (isset($_POST['BillingJobTitle']) && $_POST['BillingJobTitle'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Job Title:</strong> </td><td style='vertical-align:top;'>" . $BillingJobTitle . "</td></tr>"; }
if (isset($_POST['BillingDirectPhone']) && $_POST['BillingDirectPhone'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Phone:</strong> </td><td style='vertical-align:top;'>" . $BillingDirectPhone . "</td></tr>"; }
if (isset($_POST['BillingDirectPhoneExtension']) && $_POST['BillingDirectPhoneExtension'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Extension:</strong> </td><td style='vertical-align:top;'>" . $BillingDirectPhoneExtension . "</td></tr>"; }
if (isset($_POST['BillingMobilePhone']) && $_POST['BillingMobilePhone'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Mobile:</strong> </td><td style='vertical-align:top;'>" . $BillingMobilePhone . "</td></tr>"; }
if (isset($_POST['BillingEmail']) && $_POST['BillingEmail'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Email:</strong> </td><td style='vertical-align:top;'>" . $BillingEmail . "</td></tr>"; }
if (isset($_POST['BillingContactEmailInfo']) && $_POST['BillingContactEmailInfo'] !=="") { $msg.="<tr><td style='vertical-align:top;'> </td><td style='vertical-align:top;'>" . $BillingContactEmailInfo . "</td></tr>"; }


if (isset($_POST['ShippingFirstName']) && $_POST['ShippingFirstName'] !=="") { $msg.="<tr><td colspan='2'><h2 style='margin-top:15px;margin-bottom:0;'>Shipping Contact</h2></td></tr>"; }
if (isset($_POST['ShippingFirstName']) && $_POST['ShippingFirstName'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>First Name:</strong> </td><td style='vertical-align:top;'>" . $ShippingFirstName . "</td></tr>"; }
if (isset($_POST['ShippingLastName']) && $_POST['ShippingLastName'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Last Name:</strong> </td><td style='vertical-align:top;'>" . $ShippingLastName . "</td></tr>"; }
if (isset($_POST['ShippingJobTitle']) && $_POST['ShippingJobTitle'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Job Title:</strong> </td><td style='vertical-align:top;'>" . $ShippingJobTitle . "</td></tr>"; }
if (isset($_POST['ShippingDirectPhone']) && $_POST['ShippingDirectPhone'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Phone:</strong> </td><td style='vertical-align:top;'>" . $ShippingDirectPhone . "</td></tr>"; }
if (isset($_POST['ShippingDirectPhoneExtension']) && $_POST['ShippingDirectPhoneExtension'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Extension:</strong> </td><td style='vertical-align:top;'>" . $ShippingDirectPhoneExtension . "</td></tr>"; }
if (isset($_POST['ShippingMobilePhone']) && $_POST['ShippingMobilePhone'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Mobilee:</strong> </td><td style='vertical-align:top;'>" . $ShippingMobilePhone . "</td></tr>"; }
if (isset($_POST['ShippingEmail']) && $_POST['ShippingEmail'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Email:</strong> </td><td style='vertical-align:top;'>" . $ShippingEmail . "</td></tr>"; }
if (isset($_POST['ShippingContactEmailInfo']) && $_POST['ShippingContactEmailInfo'] !=="") { $msg.="<tr><td style='vertical-align:top;'> </td><td style='vertical-align:top;'>" . $ShippingContactEmailInfo . "</td></tr>"; }

if (isset($_POST['SamplingTech1FirstName']) && $_POST['SamplingTech1FirstName'] !=="") { $msg.="<td colspan='2'><h2 style='margin-top:15px;margin-bottom:0;'>Sampling Technicians</h2></td></tr>"; }
if (isset($_POST['SamplingTech1FirstName']) && $_POST['SamplingTech1FirstName'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>First Name:</strong> </td><td style='vertical-align:top;'>" . $SamplingTech1FirstName . "</td></tr>"; }
if (isset($_POST['SamplingTech1LastName']) && $_POST['SamplingTech1LastName'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Last Name:</strong> </td><td style='vertical-align:top;'>" . $SamplingTech1LastName . "</td></tr>"; }
if (isset($_POST['SamplingTech1Email']) && $_POST['SamplingTech1Email'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Email:</strong> </td><td style='vertical-align:top;'>" . $SamplingTech1Email . "</td></tr>"; }
if (isset($_POST['SamplingTech1MobilePhone']) && $_POST['SamplingTech1MobilePhone'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Mobile:</strong> </td><td style='vertical-align:top;'>" . $SamplingTech1MobilePhone . "</td></tr>"; }

if (isset($_POST['SamplingTech2FirstName']) && $_POST['SamplingTech2FirstName'] !=="") { $msg.="<tr><td colspan='2'>&nbsp;</td></tr><tr><td style='vertical-align:top;'><strong>First Name:</strong> </td><td style='vertical-align:top;'>" . $SamplingTech2FirstName . "</td></tr>"; }
if (isset($_POST['SamplingTech2LastName']) && $_POST['SamplingTech2LastName'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Last Name:</strong> </td><td style='vertical-align:top;'>" . $SamplingTech2LastName . "</td></tr>"; }
if (isset($_POST['SamplingTech2Email']) && $_POST['SamplingTech2Email'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Email:</strong> </td><td style='vertical-align:top;'>" . $SamplingTech2Email . "</td></tr>"; }
if (isset($_POST['SamplingTech2MobilePhone']) && $_POST['SamplingTech2MobilePhone'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Mobile:</strong> </td><td style='vertical-align:top;'>" . $SamplingTech2MobilePhone . "</td></tr>"; }

if (isset($_POST['SamplingTech3FirstName']) && $_POST['SamplingTech3FirstName'] !=="") { $msg.="<tr><td colspan='2'>&nbsp;</td></tr><tr><td style='vertical-align:top;'><strong>First Name:</strong> </td><td style='vertical-align:top;'>" . $SamplingTech3FirstName . "</td></tr>"; }
if (isset($_POST['SamplingTech3LastName']) && $_POST['SamplingTech3LastName'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Last Name:</strong> </td><td style='vertical-align:top;'>" . $SamplingTech3LastName . "</td></tr>"; }
if (isset($_POST['SamplingTech3Email']) && $_POST['SamplingTech3Email'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Email:</strong> </td><td style='vertical-align:top;'>" . $SamplingTech3Email . "</td></tr>"; }
if (isset($_POST['SamplingTech3MobilePhone']) && $_POST['SamplingTech3MobilePhone'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Mobile:</strong> </td><td style='vertical-align:top;'>" . $SamplingTech3MobilePhone . "</td></tr>"; }

if (isset($_POST['AcctsPayableStreet']) && $_POST['AcctsPayableStreet'] !=="") { $msg.="<tr><td colspan='2'><h2 style='margin-top:15px;margin-bottom:0;'>Accounts Payable Address</h2></td></tr>"; }
if (isset($_POST['AcctsPayableStreet']) && $_POST['AcctsPayableStreet'] !=="") { $msg.="<tr><td colspan='2' style='vertical-align:top;'>" . $AcctsPayableStreet . "</td></tr>"; }
if (isset($_POST['AcctsPayableStreet2']) && $_POST['AcctsPayableStreet2'] !=="") { $msg.="<tr><td colspan='2' style='vertical-align:top;'>" . $AcctsPayableStreet2 . "</td></tr>"; }
if (isset($_POST['AcctsPayableCity']) && $_POST['AcctsPayableCity'] !=="") { $msg.="<tr><td colspan='2' style='vertical-align:top;'>" . $AcctsPayableCity . ", " . $AcctsPayableState . " " . $AcctsPayableZipCode . "</td></tr>"; }
if (isset($_POST['AcctsPayableCountry']) && $_POST['AcctsPayableCountry'] !=="") { $msg.="<tr><td  colspan='2' style='vertical-align:top;'>" . $AcctsPayableCountry . "</td></tr>"; }

if (isset($_POST['ShippingStreet']) && $_POST['ShippingStreet'] !=="") { $msg.="<tr><td colspan='2'><h2 style='margin-top:15px;margin-bottom:0;'>Shipping Address</h2></td></tr>"; }
if (isset($_POST['ShippingStreet']) && $_POST['ShippingStreet'] !=="") { $msg.="<tr><td colspan='2' style='vertical-align:top;'>" . $ShippingStreet . "</td></tr>"; }
if (isset($_POST['ShippingStreet2']) && $_POST['ShippingStreet2'] !=="") { $msg.="<tr><td colspan='2' style='vertical-align:top;'>" . $ShippingStreet2 . "</td></tr>"; }
if (isset($_POST['ShippingCity']) && $_POST['ShippingCity'] !=="") { $msg.="<tr><td colspan='2' style='vertical-align:top;'>" . $ShippingCity . ", " . $ShippingState . " " . $ShippingZipCode . "</td></tr>"; }
if (isset($_POST['ShippingCountry']) && $_POST['ShippingCountry'] !=="") { $msg.="<tr><td  colspan='2' style='vertical-align:top;'>" . $ShippingCountry . "</td></tr>"; }

if (isset($_POST['MailingStreet']) && $_POST['MailingStreet'] !=="") { $msg.="<tr><td colspan='2'><h2 style='margin-top:15px;margin-bottom:0;'>Mailing Address</h2></td></tr>"; }
if (isset($_POST['MailingStreet']) && $_POST['MailingStreet'] !=="") { $msg.="<tr><td colspan='2' style='vertical-align:top;'>" . $MailingStreet . "</td></tr>"; }
if (isset($_POST['MailingStreet2']) && $_POST['MailingStreet2'] !=="") { $msg.="<tr><td colspan='2' style='vertical-align:top;'>" . $MailingStreet2 . "</td></tr>"; }
if (isset($_POST['MailingCity']) && $_POST['MailingCity'] !=="") { $msg.="<tr><td colspan='2' style='vertical-align:top;'>" . $MailingCity . ", " . $MailingState . " " . $MailingZipCode . "</td></tr>"; }
if (isset($_POST['MailingCountry']) && $_POST['MailingCountry'] !=="") { $msg.="<tr><td  colspan='2' style='vertical-align:top;'>" . $MailingCountry . "</td></tr>"; }

$msg.="<tr><td colspan='2'><h2 style='margin-top:15px;margin-bottom:0;'>Other Information</h2></td></tr>";
if (isset($_POST['ServiceArea']) && $_POST['ServiceArea'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Service Area:</strong> </td><td style='vertical-align:top;'>" . $ServiceArea . "</td></tr>"; }

if (isset($_POST['PONumber']) && $_POST['PONumber'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>PO Number:</strong> </td><td style='vertical-align:top;'>" . $PONumber . "</td></tr>"; }
if (isset($_POST['QuoteNumber']) && $_POST['QuoteNumber'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Quote Number:</strong> </td><td style='vertical-align:top;'>" . $QuoteNumber . "</td></tr>"; }
if (isset($_POST['POAmount']) && $_POST['POAmount'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>PO Amount:</strong> </td><td style='vertical-align:top;'>" . $POAmount . "</td></tr>"; }

if (isset($_POST['CreditCardNo']) && $_POST['CreditCardNo'] !=="") { $msg.="<tr><td style='margin-top:15px;vertical-align:top;'><strong>Credit Card No:</strong> </td><td style='vertical-align:top;'>**** **** **** ****</td></tr>"; }
if (isset($_POST['CreditCardCVV']) && $_POST['CreditCardCVV'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Credit Card CVV:</strong> </td><td style='vertical-align:top;'>***</td></tr>"; }
if (isset($_POST['CreditCardExp']) && $_POST['CreditCardExp'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Credit Card Exp:</strong> </td><td style='vertical-align:top;'>**/****</td></tr>"; }

if (isset($_POST['BillingInstructions']) && $_POST['BillingInstructions'] !=="") { $msg.="<tr><td style='margin-top:15px;vertical-align:top;'><strong>Billing Instructions:</strong> </td><td style='vertical-align:top;'>" . $BillingInstructions . "</td></tr>"; }
if (isset($_POST['TestingFrequency']) && $_POST['TestingFrequency'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Testing Frequency:</strong> </td><td style='vertical-align:top;'>" . $TestingFrequency . "</td></tr>"; }
if (isset($_POST['RentalOrPurchase']) && $_POST['RentalOrPurchase'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Rental Or Purchase:</strong> </td><td style='vertical-align:top;'>" . $RentalOrPurchase . "</td></tr>"; }

if (isset($_POST['ShipCarrier']) && $_POST['ShipCarrier'] !=="") { $msg.="<tr><td colspan='2'><h2 style='margin-top:15px;margin-bottom:0;'>Shipping Instructions</h2></td></tr>"; }
if (isset($_POST['ShipCarrier']) && $_POST['ShipCarrier'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Ship Carrier:</strong> </td><td style='vertical-align:top;'>" . $ShipCarrier . "</td></tr>"; }
if (isset($_POST['OtherShipCarrier']) && $_POST['OtherShipCarrier'] !=="") { $msg.="<tr><td style='vertical-align:top;'> </td><td style='vertical-align:top;'>" . $OtherShipCarrier . "</td></tr>"; }
if (isset($_POST['ShipSpeed']) && $_POST['ShipSpeed'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Shipping Speed:</strong> </td><td style='vertical-align:top;'>" . $ShipSpeed . "</td></tr>"; }
if (isset($_POST['ShippingPayMethod']) && $_POST['ShippingPayMethod'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Shipping Payment:</strong> </td><td style='vertical-align:top;'>" . $ShippingPayMethod . "</td></tr>"; }
if (isset($_POST['ShippingAcctNo']) && $_POST['ShippingAcctNo'] !=="") { $msg.="<tr><td style='vertical-align:top;'><strong>Shipping Acct No:</strong> </td><td style='vertical-align:top;'>" . $ShippingAcctNo . "</td></tr>"; }

if (isset($_POST['Comments']) && $_POST['Comments'] !=="") { $msg.="<tr><td colspan='2'><h2 style='margin-top:15px;margin-bottom:0;'>Comments</h2></td></tr>"; }
if (isset($_POST['Comments']) && $_POST['Comments'] !=="") { $msg.="<tr><td colspan='2' style='vertical-align:top;'>" . $Comments . "</td></tr>"; }
		$msg.="				<tr><td style='vertical-align:top;'><strong>IP Address:</strong> </td><td style='vertical-align:top;'>" . $IPAddress . "</td></tr>\n";
		$msg.="				<tr><td style='vertical-align:top;'><strong>User Agent:</strong> </td><td style='vertical-align:top;'>" . $UserAgent . "</td></tr>\n";
		$msg.="			</table>\n";
		$msg.="		</td>\n";
		$msg.="	</tr>\n";
		$msg.="	<tr><td style='background:#3d63a9;'><a href='http://" . $WebServer . "'><img width='600' src='https://" . $WebServer . "/images/Trace-Logo-Short-Address-Block-Blue-Bottom.png' alt='Trace Analytics - The AirCheck Lab' /></a></td></tr>\n";
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
	
		$inPage.= '	</div>';
		$inPage.="	<div class='blueBox ten columns'><img class='wide100' src='/images/Trace-Logo-Short-Address-Block-Bottom.png' alt='Trace Analytics - The AirCheck Lab' /></div>";
		$inPage.= '	</div>';
		$inPage.= '';
	
	// Kill the special $inpage stuff and just show the damned table. Mobile users be damned.
	$inPage = $msg;
	
	
	// Send the email
	$msg = stripcslashes($msg);

	// Only send if it's not bingbot. Because Bing has been submitting our forms...
	if (stripos($UserAgent, 'bingbot') == FALSE) { trace_mail($to,$replyTo,$fromName,$fromEmail,$subject,$msg); }
	
	// Set the sessions
	if (session_status() == PHP_SESSION_NONE) { session_start(); }
	$_SESSION['inPage'] = stripcslashes($inPage);
	$_SESSION['to'] = $to;

/*
echo $msg;
echo '<hr />';
echo $inPage;
*/




header('Location: http://' . $WebServer . '/Thank-You');

/*
	}
else {
	header('Location: http://' . $WebServer);
}
*/

?>