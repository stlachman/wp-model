<?php
/* 
Template Name: Process Bug Report
*/

// check for javascript-created field.
/* if (!isset($_POST['iowe747id8jej3748'])) { */

/* 	$webroot = $_SERVER['DOCUMENT_ROOT']; */

	global $wp_query;
    if(isset($wp_query))
    	$content_array = $wp_query->get_queried_object();
	if(isset($content_array->ID)){
    	$post_id = $content_array->ID;
	}	
	
	$template_uri = get_template_directory_uri();
	
	define('INCLUDE_CHECK',true);
	
	//require $webroot.'/php/connect.php';
/* 	require $webroot.'/php/functions.php'; */
	
	// Visitor Info
	$IPAddress = $_SERVER['REMOTE_ADDR'];
/* 	$IPAddress = $_SERVER['HTTP_X_FORWARDED_FOR']; */
	$UserAgent = $_SERVER['HTTP_USER_AGENT'];
	$WebServer = $_SERVER['HTTP_HOST'];
	
	if (isset($_POST['FirstName'])) { $FirstName = $_POST['FirstName']; }
	if (isset($_POST['LastName'])) { $LastName = $_POST['LastName']; }
	if (isset($_POST['Email'])) { $Email = $_POST['Email']; }
	if (isset($_POST['ReferringPage'])) { $ReferringPage = $_POST['ReferringPage']; }
	if (isset($_POST['Website'])) { $Website = $_POST['Website']; }
	if (isset($_POST['YesNoBox']) && 
	 $_POST['YesNoBox'] == 'Yes') {
			$YesNoBox = "Yes";
		} else {
		$YesNoBox = "No";
			}
			
	
	$subject = 'AirCheck Bug Report';
	
	$to = "bugreport@AirCheckLab.com";
	if (isset($_POST['Email'])) { $replyTo = $Email; }
	$fromName = "Bug Report";
	$fromEmail = "ServiceTeam@AirCheckLab.com";
	
	if (isset($_POST['BugDescription'])) { $BugDescription = htmlspecialchars($_POST['BugDescription']); }
	
	
	/*
	/////////////////////////// html email ////////////////////////////////////////////
	*/
		$msg="";
		$msg.="<center><table style='width:600px;font-family:arial, helvetica, sans-serif; font-weight:normal; border-collapse:collapse; border:2px solid #3d63a9;margin: 10px; padding:0; background:#fff;box-shadow: 0 1px 4px #666;'>\n";
		$msg.="	<tr>\n";
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
		$msg.="					<td colspan='2' style='padding:0px; margin:0;padding-bottom:10px;'>A bug report has been filed for the following URL: <strong>" . $ReferringPage . "</strong><hr /></td>\n";
		$msg.="				</tr>\n";
		$msg.="				<tr><td style='vertical-align:top;'><strong>Subject:</strong> </td><td style='vertical-align:top;'>" . $subject . "</td></tr>\n";
		if (isset($_POST['FirstName'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>First Name:</strong> </td><td style='vertical-align:top;'>" . $FirstName . "</td></tr>\n"; }
		if (isset($_POST['LastName'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>Last Name:</strong> </td><td style='vertical-align:top;'>" . $LastName . "</td></tr>\n"; }
		if (isset($_POST['Email'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>Email:</strong> </td><td style='vertical-align:top;'>" . $Email . "</td></tr>\n"; }
		if (isset($_POST['Website'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>Website/Social Media:</strong> </td><td style='vertical-align:top;'>" . $Website . "</td></tr>\n"; }
		if (isset($_POST['YesNoBox'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>Have you reported a bug before?:</strong> </td><td style='vertical-align:top;'>" . $YesNoBox . "</td></tr>\n"; }
		if (isset($_POST['ReferringPage'])) { $msg.="				<tr><td style='vertical-align:top;'><strong>Referring Page:</strong> </td><td style='vertical-align:top;'>" . $ReferringPage . "</td></tr>\n"; }
		if (isset($_POST['BugDescription'])) { 
			$msg.="				<tr><td colspan='2'><strong>What was the problem or error encountered?</strong><br />\n";
			$msg.="				<p style='padding-left:15px; margin-top:0; padding-top:0;'>" . nl2br($BugDescription) . "</p></td></tr>\n";
			}
		$msg.="				<tr><td style='vertical-align:top;'><strong>IP Address:</strong> </td><td style='vertical-align:top;'><a href='http://www.infosniper.net/index.php?ip_address=" . $IPAddress . "'>" . $IPAddress . "</a></td></tr>\n";
		$msg.="				<tr><td style='vertical-align:top;'><strong>User Agent:</strong> </td><td style='vertical-align:top;'>" . $UserAgent . "</td></tr>\n";
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
		$inPage.="	<div class='thirteen columns'><div class='whiteBox ten columns pad10'>\n";
		$inPage.="		<div class='two columns'><strong>Subject:</strong> </div><div class='seven columns'>" . $subject . "</div>\n";
		$inPage.="		<div class='two columns'><strong>To:</strong> </div><div class='seven columns'>" . $to . "</div>\n";
		$inPage.="	</div>";
		$inPage.="	<div class='blueBox ten columns'><img class='wide100' src='/images/Trace-Logo-Short-Address-Block-Top.png' alt='Trace Analytics - The AirCheck Lab' /></div>";
		$inPage.="	<div class='whiteBox ten columns'>\n";
		$inPage.="		<div class='nine columns align-left'>A bug report has been filed for the following URL:<br /><strong>" . $ReferringPage . "</strong><hr /></div>\n";
		$inPage.="		<div class='three columns'><strong>Subject:</strong> </div><div class='six columns padl10'>" . $subject . "</div>\n";
		if (isset($_POST['FirstName'])) { $inPage.="		<div class='three columns'><strong>First Name:</strong> </div><div class='six columns padl10'>" . $FirstName . "</div><div class='clearfix'></div>\n"; }
		if (isset($_POST['LastName'])) { $inPage.="		<div class='three columns'><strong>Last Name:</strong> </div><div class='six columns padl10'>" . $LastName . "</div><div class='clearfix'></div>\n"; }
		if (isset($_POST['Email'])) { $inPage.="		<div class='three columns'><strong>Email:</strong> </div><div class='six columns padl10'>" . $Email . "</div><div class='clearfix'></div>\n"; }
		if (isset($_POST['Website'])) { $inPage.="		<div class='three columns'><strong>Website/Social Media:</strong> </div><div class='six columns padl10'>" . $Website . "</div><div class='clearfix'></div>\n"; }
		if (isset($_POST['ReferringPage'])) { $inPage.="		<div class='three columns'><strong>Referring Page:</strong> </div><div class='six columns padl10'><a href='$ReferringPage'>$ReferringPage</a></div><div class='clearfix'></div>\n"; }
		if (isset($_POST['BugDescription'])) { 
			$inPage.="<div class='ten columns'><strong>What was the problem or error encountered?</strong>\n";
			$inPage.="<p style='padding-left:15px; margin-top:0; padding-top:0;'>" . nl2br($BugDescription) . "</p></div>\n";
			}
		if (isset($_POST['YesNoBox'])) { 
			$inPage.="		<div class='three columns'><strong>Have you reported a bug before?:</strong> </div><div class='six columns padl10'>" . $YesNoBox . "</div><div class='clearfix'></div>\n"; }
		
		$inPage.= '	</div>';
		$inPage.="	<div class='blueBox ten columns'><img class='wide100' src='/images/Trace-Logo-Short-Address-Block-Bottom.png' alt='Trace Analytics - The AirCheck Lab' /></div>";
		$inPage.= '	</div>';
		$inPage.= "<div class='clearfix'></div><h2 class='mart15'>Return to <a href='$ReferringPage'>$ReferringPage</a></h2>";
	
	// Send the email
	
	if (isset($_POST['ReferringPage'])) { trace_mail($to,$replyTo,$fromName,$fromEmail,$subject,$msg); }
	
	// Set the sessions
	if (session_status() == PHP_SESSION_NONE) { session_start(); }
	$_SESSION['inPage'] = $inPage;
	$_SESSION['to'] = $to;
	

/*
	echo '<hr /><hr /><pre>';
	print_r(get_defined_vars());
	echo '</pre><hr />'.$msg.'<hr />'.$inPage;
*/

	header('Location: http://' . $WebServer . '/Thank-You');
/*
	}
else {
	header('Location: http://www.airchecklab.com');
}
*/

?>