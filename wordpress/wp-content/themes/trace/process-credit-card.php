<?php
/* 
Template Name: Process Credit Card
*/

// check for javascript-created field.
/* if (!isset($_POST['iowe747id8jej3748'])) { */

	$webroot = $_SERVER['DOCUMENT_ROOT'];

/* JAS
	global $wp_query;
    if(isset($wp_query))
    	$content_array = $wp_query->get_queried_object();
	if(isset($content_array->ID)){
    	$post_id = $content_array->ID;
	}	
	
	$template_uri = get_template_directory_uri();
	
	define('INCLUDE_CHECK',true);
	
	require $webroot.'/php/connect.php';
*/

/* 	require $webroot.'/php/functions.php'; */
	

	if (isset($_POST['QuoteID']) && isset($_POST['CustomerID'])) {

// echo "<h2>This feature is temporarily unavailable. We apologize for the inconvenience.</h2>";
	
	$CustomerID			= $_POST['CustomerID'];
	$QuoteID			= $_POST['QuoteID'];
	$AmountDue			= $_POST['AmountDue'];
	$CreditCardName		= $_POST['CreditCardName'];
	$CreditCardNumber	= $_POST['CreditCardNumber'];
	$CreditCardExp		= $_POST['CreditCardExp'];
	$CreditCardCVV		= $_POST['CreditCardCVV'];
	$ConfirmationEmail	= $_POST['ConfirmationEmail'];
	$KeepCC				= $_POST['KeepCC'];
	
	$lookup = CaptureCC($CustomerID, $QuoteID, $AmountDue, $CreditCardName, $CreditCardNumber, $CreditCardExp, $CreditCardCVV, $ConfirmationEmail, $KeepCC); 
	
	$ReturnedCustomerID 		= $lookup->WSM_CaptureCC->InputCustomerID;
	$ReturnedQuoteID			= $lookup->WSM_CaptureCC->InputQuoteID;
	$ReturnedAmountDue			= $lookup->WSM_CaptureCC->InputAmountDue;
	$ReturnedCreditCardName		= $lookup->WSM_CaptureCC->InputCreditCardName;
	$ReturnedCreditCardNumber	= $lookup->WSM_CaptureCC->InputCreditCardNumber;
	$ReturnedCreditCardExp		= $lookup->WSM_CaptureCC->InputCreditCardExp;
	$ReturnedCreditCardCVV		= $lookup->WSM_CaptureCC->InputCreditCardCVV;
	$ReturnedConfirmationEmail	= $lookup->WSM_CaptureCC->InputConfirmationEmail;
	$ReturnedSubmissionID		= $lookup->WSM_CaptureCC->OutputTransactionID;
	$ReturnedKeepCC				= $lookup->WSM_CaptureCC->KeepCC;
	
	}
	
	echo "<pre>
	CustomerID	= $ReturnedCustomerID
	QuoteID		= $ReturnedQuoteID
	AmountDue	= $ReturnedAmountDue
	CC Name		= $ReturnedCreditCardName
	CC Number	= $ReturnedCreditCardNumber
	CC Exp		= $ReturnedCreditCardExp
	CC CVV		= $ReturnedCreditCardCVV
	CC Email	= $ReturnedConfirmationEmail
	Submission ID	= $ReturnedSubmissionID
	KeepCC		= $KeepCC
	</pre>";	
	
// JAS 	$to = "AirCheck Service Team <ServiceTeam@AirCheckLab.com>";
	$to = "$ReturnedCreditCardName <$ReturnedConfirmationEmail>";
	
	// BCC field is set in /php/functions.php in the Recipients line. Yeah, I should add it to the parameters sent to the function...
	// Gmail SMTP does not allow us to actually change the 'from' email.
	$fromName = "Trace Analytics LLC";
	$fromEmail = "ServiceTeam@AirCheckLab.com";
	$replyTo = $fromEmail;
	
	// Visitor Info
	$IPAddress = $_SERVER['REMOTE_ADDR'];
	$UserAgent = $_SERVER['HTTP_USER_AGENT'];
	$WebServer = $_SERVER['HTTP_HOST'];
	
	$subject = "Credit Card Payment for Trace Analytics Invoice No. $ReturnedQuoteID";

	
	/*
	/////////////////////////// html email ////////////////////////////////////////////
	*/


		$msg="
<center><table style='width:600px;font-family:arial, helvetica, sans-serif; font-weight:normal; border-collapse:collapse; border:2px solid #3d63a9;margin: 10px; padding:0; background:#fff;box-shadow: 0 1px 4px #666;'>
	<tr><td style='background:#3d63a9;'><a href='https://$WebServer'><img width='600' src='https://$WebServer/images/Trace-Logo-Short-Address-Block-Blue-Top.png' alt='Trace Analytics - The AirCheck Lab' /></a></td></tr>
	<tr>
		<td style='padding:10px; margin:0;'>
			<table style='width:580px;font-family:arial, helvetica, sans-serif; font-weight: normal;  border-collapse:collapse; border:none;margin: 0px auto 5px; background:#fff;'>
				<tr>
					<td style='padding:0; margin:0;'><img src='https://www.airchecklab.com/images/blank.gif' width='150' height='1' /></td>
					<td style='padding:0; margin:0;'><img src='https://www.airchecklab.com/images/blank.gif' width='425' height='1' /></td>
				</tr>
				<tr>
					<td colspan='2' style='padding:0px; margin:0;padding-bottom:10px;'><p>Thank you for submitting your payment for invoice $ReturnedQuoteID. Our Team of Experts will process your payment and send you a receipt.</p><hr /></td>
				</tr>
				<tr><td style='vertical-align:top;'><strong>Name:</strong> </td><td style='vertical-align:top;'>$ReturnedCreditCardName</td></tr>
				<tr><td style='vertical-align:top;'><strong>Email:</strong> </td><td style='vertical-align:top;'>$ReturnedConfirmationEmail</td></tr>
				<tr><td style='vertical-align:top;'><strong>Invoice No:</strong> </td><td style='vertical-align:top;'>$ReturnedQuoteID</td></tr>
				<tr><td style='vertical-align:top;'><strong>Amount:</strong> </td><td style='vertical-align:top;'>$$ReturnedAmountDue</td></tr>
				<tr><td style='vertical-align:top;'><strong>Credit Card No:</strong> </td><td style='vertical-align:top;'>$ReturnedCreditCardNumber</td></tr>
				<!-- <tr><td style='vertical-align:top;'><strong>Transaction ID:</strong> </td><td style='vertical-align:top;'>$ReturnedSubmissionID</td></tr> -->
				<tr><td colspan='2' style='padding-top:10px;'><small><em>Please note: this is not a receipt. You will be emailed a receipt once your payment has been processed.</em></small></td></tr>
			</table>
		</td>
	</tr>
	<tr><td style='background:#3d63a9;'><a href='https://$WebServer'><img width='600' src='https://$WebServer/images/Trace-Logo-Short-Address-Block-Blue-Bottom.png' alt='Trace Analytics - The AirCheck Lab' /></a></td></tr>
</table></center>";

	
		$inPage = $msg;
	
	// Send the email
	$msg = stripcslashes($msg);
	trace_mail($to,$replyTo,$fromName,$fromEmail,$subject,$msg);
	
	// Set the sessions
	if (session_status() == PHP_SESSION_NONE) { session_start(); }
	$_SESSION['inPage'] = stripcslashes($inPage);
	$_SESSION['to'] = $to;


	header('Location: https://' . $WebServer . '/Thank-You');

/*
	}
else {
	header('Location: https://' . $WebServer);
}
*/

?>