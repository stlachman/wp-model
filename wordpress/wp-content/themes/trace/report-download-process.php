<?php
/* 
Template Name: Report Download Process
*/

// if (isset($_POST['iowe747id8jej3748'])) {
	
	if (session_status() == PHP_SESSION_NONE) { session_start(); }
	if (isset($_SESSION['report'])) { $report = trim(base64_decode($_SESSION['report'])); }
	
	if (isset($_SESSION['number'])) { $number = trim(base64_decode($_SESSION['number'])); }
		
	if (isset($_POST['AccessCode'])) { $AccessCode = $_POST['AccessCode']; }
	
	$referer = $_SERVER['HTTP_REFERER'];
		
/*
	echo 'session report = ' . $_SESSION['report'] . '<br />';
	echo 'session number = ' . $_SESSION['number'] . '<br />';
	echo 'variable report = ' . $report . '<br />';
	echo 'variable number = ' . $number . '<br />';
	echo 'AccessCode = ' . $AccessCode . '<br />';

	echo '<hr /><hr /><pre>';
	print_r(get_defined_vars());
	echo '</pre><hr /><hr />';
*/

	if ($AccessCode == $number) {
		// echo '<h1>Success!</h1><p>https://www.airchecklab.com/report-pdfs/' . $report . '.zip</p>';
		// header('Location: https://www.airchecklab.com/report-pdfs/' . $report . '.zip');
		
		$_SESSION['reportSuccess'] = 's';
		 header('Location: ' . $referer . '#Download');
		}
	else {
		// echo '<h1>Fail</h1>';
		
		$_SESSION['reportFail'] = 'f';
		header('Location: ' . $referer . '#Download');
		}

/*
	}
else {
	header('Location: http://www.airchecklab.com');
}
*/

?>