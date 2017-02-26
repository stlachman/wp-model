<?php
/* 
Template Name: Results - ISO 8573
*/

// Make sure the form has been submitted. If not, redirect to the front page of the website.
if(!isset($_POST['examName'])) {
	$WebServer = $_SERVER['HTTP_HOST'];
	header('Location: http://'.$WebServer);
	die;
	}

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
<!-- TRACETEMPLATE RESULTS - SOURCES OF CONTAMINATION -->
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
	<!-- JAS <div class="divide50"></div> -->
	
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
				</div>
			<?php } ?>
			<div class="<?php echo $post_column_full." ".$main_class;?> columns" style="overflow:visible;">
					<div class="clear"></div>

<?php
	// Get info if the user is logged in

	if(isset($_SESSION['pg_user_id'])) {
		// get user data
		$userData = pg_user_logged();

		$user_id = $userData->id;
		$user_firstname = $userData->name;
		$user_lastname = $userData->surname;
		$user_username = $userData->username;
		$user_email = $userData->email;
		$user_company = $userData->tel;
		$user_page_id = $userData->page_id;
		$user_disable_pvt_page = $userData->disable_pvt_page;
		}

?>

					<?php // echo "<strong>Using the API:</strong><br />ID = $user_id<br />Name = $user_firstname<br />Last = $user_lastname<br />Username = $user_username<br />Email = $user_email<br />Company = $user_company<br />Page ID = $user_page_id<br />Disable Pvt Page = $user_disable_pvt_page"; ?>
					
					<?php // the_content(); ?>
					
					<div class="clear"></div>
					
					<?php
						if (!pg_user_logged()) { echo '<div class="pg_login_block"><p>You must be logged in to view the <span class="aircheck2">AirCheck<span class="tracecheck">&#x2713;</span> Exam</span></p></div>'; }
						else {

// For any fields that are not exam questions, do this:
$examName = array('','');
$FirstName = array('','');
$LastName = array('','');
$Email = array('','');
$Organization = array('','');
$examURL = array('','');

// set our Correct, Incorrect, and Total arrays
$correct = array();
$incorrect = array();
$total = array();

$E02_Q01 = array('B', '<strong>Question 1</strong> - What is the maximum allowable pressure for the NPT adaptor labeled UNR? <a data-rel="prettyPhoto" class="zoom" title="What is the maximum allowable pressure for the NPT adaptor labeled UNR?" href="http://www.youtube.com/watch?v=B1RwwXw1uEI&t=2m40s&start=160&width=640&height=360">Watch the video</a>');
$E02_Q02 = array('B', '<strong>Question 2</strong> - What is the thread size of the NPT Adaptor port that is used to connect to the sampling outlet? <a data-rel="prettyPhoto" class="zoom" title="What is the maximum allowable pressure for the NPT adaptor labeled UNR?" href="http://www.youtube.com/watch?v=B1RwwXw1uEI&start=160&t=2m40s&width=640&height=360">Watch the video</a>');
$E02_Q03 = array('C', '<strong>Question 3</strong> - What contaminants can be sampled with the <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit K8573NB&trade;?</span> <a data-rel="prettyPhoto" class="zoom" title="What contaminants can be sampled with the AirCheck&#x2713; Kit K8573NB?</span>" href="http://www.youtube.com/watch?v=B1RwwXw1uEI&t=0m20s&start=20&width=640&height=360">Watch the video</a>');
$E02_Q04 = array('C', '<strong>Question 4</strong> - Which purity classes are selected when conducting Baseline Testing? <a data-rel="prettyPhoto" class="zoom" title="Which purity classes are selected when conducting Baseline Testing?" href="http://www.youtube.com/watch?v=B1RwwXw1uEI&t=0m57s&start=57&width=640&height=360">Watch the video</a>');
$E02_Q05 = array('A', '<strong>Question 5</strong> - What portion of the test requires knowledge of the type of dryer installed on the compressed air or gas system? <a data-rel="prettyPhoto" class="zoom" title="What portion of the test requires knowledge of the type of dryer installed on the compressed air or gas system?" href="http://www.youtube.com/watch?v=B1RwwXw1uEI&t=10m30s&start=630&width=640&height=360">Watch the video</a>');
$E02_Q06 = array('C', '<strong>Question 6</strong> - In the given example, how many sets of Blank Media would be required? <a data-rel="prettyPhoto" class="zoom" title="In the given example, how many sets of Blank Media would be required?" href="http://www.youtube.com/watch?v=B1RwwXw1uEI&t=1m56s&start=116&width=640&height=360">Watch the video</a>');
$E02_Q07 = array('D', '<strong>Question 7</strong> - How often should the <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade;</span> and Adaptors be cleaned? <a data-rel="prettyPhoto" class="zoom" title="How often should the AirCheck&#x2713; Kit&trade; and Adaptors be cleaned?" href="http://www.youtube.com/watch?v=B1RwwXw1uEI&t=2m14s&start=134&width=640&height=360">Watch the video</a>');
$E02_Q08 = array('A', '<strong>Question 8</strong> - What is the preferred material for fittings used to connect the <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade; K8573NB</span> to the sampling point? <a data-rel="prettyPhoto" class="zoom" title="What is the preferred material for fittings used to connect the AirCheck&#x2713; Kit&trade; K8573NB to the sampling point?" href="http://www.youtube.com/watch?v=B1RwwXw1uEI&t=3m04s&start=184&width=640&height=360">Watch the video</a>');
$E02_Q09 = array('B', '<strong>Question 9</strong> - What fields are required when filling out a Data Sheet? <a data-rel="prettyPhoto" class="zoom" title="What fields are required when filling out a Data Sheet?" href="http://www.youtube.com/watch?v=B1RwwXw1uEI&t=17m13s&start=1033&width=640&height=360">Watch the video</a>');
$E02_Q10 = array('A', '<strong>Question 10</strong> - Which point on the <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade;</span> connects to the sampling point? <a data-rel="prettyPhoto" class="zoom" title="Which point on the AirCheck&#x2713; Kit&trade; connects to the sampling point?" href="http://www.youtube.com/watch?v=B1RwwXw1uEI&t=4m33s&start=273&width=640&height=360">Watch the video</a>');
$E02_Q11 = array('D', '<strong>Question 11</strong> - How are Sampling Times for each portion of the test determined? <ul><li><a data-rel="prettyPhoto" class="zoom" title="Determining Sampling Times - Section 1" href="http://www.youtube.com/watch?v=B1RwwXw1uEI&t=6m55s&start=415&width=640&height=360">Determining Sampling Times - Section 1</a></li><li><a data-rel="prettyPhoto" class="zoom" title="Determining Sampling Times - Section 2" href="http://www.youtube.com/watch?v=B1RwwXw1uEI&t=7m20s&start=440&width=640&height=360">Determining Sampling Times - Section 2</a></li><li><a data-rel="prettyPhoto" class="zoom" title="Determining Sampling Times - Section 3" href="http://www.youtube.com/watch?v=B1RwwXw1uEI&t=9m33s&start=573&width=640&height=360">Determining Sampling Times - Section 3</a></li></ul>');
$E02_Q12 = array('C', '<strong>Question 12</strong> - At what point in the sampling is the Blue Filter Cassette removed? <a data-rel="prettyPhoto" class="zoom" title="At what point in the sampling is the Blue Filter Cassette removed?" href="http://www.youtube.com/watch?v=B1RwwXw1uEI&t=16m22s&start=982&width=640&height=360">Watch the video</a>');
$E02_Q13 = array('B', '<strong>Question 13</strong> - Which flowmeter measures air flow through the filter cassette? <ul><li><a data-rel="prettyPhoto" class="zoom" title="Flowmeter Usage - Section 1" href="http://www.youtube.com/watch?v=B1RwwXw1uEI&t=8m10s&start=490&width=640&height=360">Flowmeter Usage - Section 1</a></li><li><a data-rel="prettyPhoto" class="zoom" title="Flowmeter Usage - Section 2" href="http://www.youtube.com/watch?v=B1RwwXw1uEI&t=8m48s&start=528&width=640&height=360">Flowmeter Usage - Section 2</a></li></ul>');
$E02_Q14 = array('C', '<strong>Question 14</strong> - If the required flow rate cannot be achieved, what measures should be taken? <a data-rel="prettyPhoto" class="zoom" title="If the required flow rate cannot be achieved, what measures should be taken?" href="http://www.youtube.com/watch?v=B1RwwXw1uEI&t=9m30s&start=570&width=640&height=360">Watch the video</a>');
$E02_Q15 = array('A', '<strong>Question 15</strong> - Which Detector Tube is appropriate for systems that use a desiccant dryer? <a data-rel="prettyPhoto" class="zoom" title="Which Detector Tube is appropriate for systems that use a desiccant dryer?" href="http://www.youtube.com/watch?v=B1RwwXw1uEI&t=10m30s&start=630&width=640&height=360">Watch the video</a>');
$E02_Q16 = array('B', '<strong>Question 16</strong> - Which of the following steps must be performed during the Water Vapor Test? <ul><li><a data-rel="prettyPhoto" class="zoom" title="Water Vapor Test - Section 1" href="http://www.youtube.com/watch?v=B1RwwXw1uEI&t=12m50s&start=770&width=640&height=360">Water Vapor Test - Section 1</a></li><li><a data-rel="prettyPhoto" class="zoom" title="Water Vapor Test - Section 2" href="http://www.youtube.com/watch?v=B1RwwXw1uEI&t=13m20s&start=800&width=640&height=360">Water Vapor Test - Section 2</a></li></ul>');
$E02_Q17 = array('A', '<strong>Question 17</strong> - In which direction should the arrows point when inserting the Detector Tubes into the Tube Flowmeter? <ul><li><a data-rel="prettyPhoto" class="zoom" title="Detector Tubes - Section 1" href="http://www.youtube.com/watch?v=B1RwwXw1uEI&t=12m25s&start=745&width=640&height=360">Detector Tubes - Section 1</a></li><li><a data-rel="prettyPhoto" class="zoom" title="Detector Tubes - Section 2" href="http://www.youtube.com/watch?v=B1RwwXw1uEI&t=15m46s&start=946&width=640&height=360">Detector Tubes - Section 2</a></li></ul>');
$E02_Q18 = array('A', '<strong>Question 18</strong> - which side of the Filter Cassette connects to the NPT Adaptor? <ul><li><a data-rel="prettyPhoto" class="zoom" title="Connecting the Filter Cassette - Section 1" href="http://www.youtube.com/watch?v=B1RwwXw1uEI&t=5m30s&start=330&width=640&height=360">Connecting the Filter Cassette - Section 1</a></li><li><a data-rel="prettyPhoto" class="zoom" title="Connecting the Filter Cassette - Section 2" href="http://www.youtube.com/watch?v=B1RwwXw1uEI&t=8m37s&start=517&width=640&height=360">Connecting the Filter Cassette - Section 2</a></li></ul>');
$E02_Q19 = array('B', '<strong>Question 19</strong> - What is the proper method for shipping more than one sample from a given location? <a data-rel="prettyPhoto" class="zoom" title="What is the proper method for shipping more than one sample from a given location?" href="http://www.youtube.com/watch?v=B1RwwXw1uEI&t=19m25s&start=1165&width=640&height=360">Watch the video</a>');
$E02_Q20 = array('C', '<strong>Question 20</strong> - How long should the Blank Control Media be attached to the compressed air or gas supply? <a data-rel="prettyPhoto" class="zoom" title="How long should the Blank Control Media be attached to the compressed air or gas supply?" href="http://www.youtube.com/watch?v=B1RwwXw1uEI&t=19m54s&start=1194&width=640&height=360">Watch the video</a>');
$E02_Q21 = array('A', '<strong>Question 21</strong> - In the given example, what was the Detector Tube reading? <a data-rel="prettyPhoto" class="zoom" title="In the given example, what was the Detector Tube reading?" href="https://www.airchecklab.com/aircheck-academy/compressed-air-in-the-food-industry/iso-8573-compressed-air-testing/iso-8573-1-manual/">See Page 11 of the K8573NB Manual</a>');
$E02_Q22 = array('A', '<strong>Question 22</strong> - Is it necessary to break the tips off of the Blank Charcoal Tube? <a data-rel="prettyPhoto" class="zoom" title="Is it necessary to break the tips off of the Blank Charcoal Tube?" href="http://www.youtube.com/watch?v=B1RwwXw1uEI&t=19m54s&start=1194&width=640&height=360">Watch the video</a>');

/* echo '<div class="eight columns"><div class="notification warning"><h4>Answer summary (for testing only):</h4>'; */

foreach ($_POST as $question => $guess) {
	$total[] = $question;
	if($guess == reset($$question)) {
/*  		echo "$question is correct<br>"; */
		$correct[] = $question;
		}
	else {
/*  		echo "$question is incorrect. Your answer was $guess.<br>"; */
 		$hint = end($$question);
 		if ($hint !== '') {
/* 			echo "\n\t<li>$hint. <em>Your answer was $guess.</em></li>"; */
			$incorrectList.="\n\t<li>$hint. <em>Your answer was $guess.</em></li>";
			}
		$incorrect[] = $question;
		}
	}

/* echo '</div></div>'; */

$correctNumber = count($correct);
$incorrectNumber = count($incorrect)-6;
$percentage = round(($correctNumber / (count($total)-6))*100);

echo "<h1 class='center'><span class='aircheck'>AirCheck<span class='tracecheck'>&#x2713;</span> Exam&trade; Results</span><br />".$_POST['examName']."</h1>";
echo "<div class='center seven columns offset-by-two'>";
echo "<div class='rounded notification success'>Correct Answers = $correctNumber</div>";
echo "<div class='rounded notification error'>Incorrect Answers = $incorrectNumber</div>";
echo "<div class='rounded notification box'>Percentage = $percentage%</div>";
echo '</div>';

/////////// If any questions are incorrect ///////////////////
if ($incorrectNumber > 0 ) {
		/*
$incorrectList = '';
		foreach ($incorrect as $number) {
		$hint = end($$number);
		if ($hint !== '') {
			$incorrectList.="\n\t<li>$hint</li>";
			}
		}
*/
	$WebServer = $_SERVER['HTTP_HOST'];
	$referrer = $_SERVER['HTTP_REFERER'];
	$examName = $_POST['examName'];
	$examURL = $_POST['examURL'];
	$FirstName = $_POST['FirstName'];
	$Email = $_POST['Email'];
	
	echo "<div class='clearfix'></div>\n<hr />\n<div class=''>\n<h1 class='center'>You're almost there, $FirstName!</h1><p>We noticed some problem areas in your exam - you may wish to review the following materials before retaking the <em>$examName</em> exam:</p>\n<ul class='examHints'>$incorrectList\n</ul>\n<div class='divide20'></div><div class='center'><h2>Earn your Certificate of Completion by scoring 100% on this exam!</h2>\n<a class='blue button' href='$examURL'>Retake the <span class='aircheck'>$examName</span> Exam Now <i class='icon-arrow-right'></i></a>\n</div>";
	
	$subject = "$FirstName, your $examName Exam Results are enclosed";
	
	$msg= <<< EOF
<center>
	<table style='width:600px;font-family:arial, helvetica, sans-serif; font-weight:normal; border-collapse:collapse; border:2px solid #3d63a9;margin: 10px; padding:0; background:#fff;box-shadow: 0 1px 4px #666;'>
		<tr>
			<td style='background:#3d63a9;'>
				<a href='https://{$WebServer}'><img width='600' src='https://{$WebServer}/images/Trace-Logo-Short-Address-Block-Blue-Top.png' alt='Trace Analytics - The AirCheck Lab' /></a>
			</td>
		</tr>
		<tr>
			<td style='padding:15px;'>
				<h1>You're almost there, {$FirstName}! </h1>
				<p>Thank you for taking the <a href="{$examURL}">{$examName} Exam</a> at the AirCheck Academy. </p>
				<center>
					<h2>AirCheck&#x2713; Exam Results</h2>
					<table style="width:350px;font-family:arial, helvetica, sans-serif; font-weight:normal; border-collapse:collapse; text-align:center;">
						<tr>
							<td style="background-color:#EFF9E6; border: 1px solid #B3DC82; color: #5F9025;padding:10px;">Correct Answers = {$correctNumber}</td>
						</tr>
						<tr>
							<td style="background-color:#FFEDED; border: 1px solid #FBC4C4; color: #DE5959; padding:10px;">Incorrect Answers = {$incorrectNumber}</td>
						</tr>
						<tr>
							<td style="background-color:#F1F1F1; border: 1px solid #B6D7E8; color: #000000; padding:10px;">Percentage = {$percentage}%</td>
						</tr>
					</table>
				</center>
				<h3>Earn your Certificate of Completion by scoring 100% on this exam!</h3>
				<p>We noticed some problem areas in your exam - you may wish to review the following materials before retaking it: </p>
				<ul>
					{$incorrectList}
				</ul>
				<center>
					<hr />
					<h2><a href="{$examURL}">Retake the <strong>{$examName}</strong> Exam Now</a></h2>
				</center>
			</td>
		</tr>
		<tr>
			<td style='background:#3d63a9;'>
				<a href='https://{$WebServer}'><img width='600' src='https://{$WebServer}/images/Trace-Logo-Short-Address-Block-Blue-Bottom.png' alt='Trace Analytics - The AirCheck Lab' /></a>
			</td>
		</tr>
	</table>
</center>
EOF;
	
	$PDFAttachment = '';
}

/////////// If all questions are answered correctly //////////////////
else {
	$examName = $_POST['examName'];
	$FirstName = $_POST['FirstName'];
	$examTester = $_POST['FirstName'].' '.$_POST['LastName'];
	$examCompany = $_POST['Organization'];
	$Email = $_POST['Email'];

//// build the PDF
	require('fpdf.php');
	
	$examDate = date("F j, Y");
	$fileDate = date("Y-m-d");
	
	$CertName = $fileDate.'-'.$examTester.'-'.$examCompany.'-'.$examName.'.pdf';
	$itemSearch  = array(" ", "'", ";", "(", ")", ":", ",", "\\", "/");
	$itemReplace = array("-", "",  "",  "",  "",  "",  "",   "",   "");
	$pdfName = str_replace($itemSearch, $itemReplace, nl2br($CertName));
	$pdfFolder = '/Volumes/WebFiles/sites/airchecklab-new/AirCheck-Exam-Certificates/';
	$pdfLink = '/AirCheck-Exam-Certificates/'.$pdfName;

	if(!file_exists($pdfFolder.$pdfName)) {

		$pdf = new FPDF('L','in','Letter');

		$pdf->AddFont('Arial Narrow','','Arial Narrow.php');
		$pdf->AddFont('Arial Narrow','U','Arial Narrow.php');
		
		$pdf->AddFont('Arial Narrow Italic','','Arial Narrow Italic.php');
		
		$pdf->AddFont('Arial Narrow Bold','','Arial Narrow Bold.php');
		$pdf->AddFont('Arial Narrow Bold','U','Arial Narrow Bold.php');
		
		$pdf->AddPage();
		$pdf->Image($pdfFolder.'AirCheckCertificate.png',.5,.5,10);
		
		$pdf->SetX(.5);
		$pdf->SetY(2.8);
		$pdf->SetFont('Arial Narrow Italic','',18);
		$pdf->Cell(10,.5,'This Certificate of Completion verifies that',0,0,'C');
		
		$pdf->SetX(.5);
		$pdf->SetY(3.35);
		$pdf->SetFont('Arial Narrow Bold','',40);
		$pdf->Cell(10,.5,$examTester,0,0,'C');
		
		$pdf->SetX(.5);
		$pdf->SetY(3.75);
		$pdf->SetFont('Arial Narrow','',16);
		$pdf->Cell(10,.5,$examCompany,0,0,'C');
		
		$pdf->SetX(.5);
		$pdf->SetY(4.25);
		$pdf->SetFont('Arial Narrow Italic','',18);
		$pdf->Cell(10,.5,'has successfully completed the training course identified below,',0,0,'C');
		
		$pdf->SetX(.5);
		$pdf->SetY(4.55);
		$pdf->SetFont('Arial Narrow Italic','',18);
		$pdf->Cell(10,.5,'provided by Trace Analytics, LLC in Austin, Texas:',0,0,'C');
		
		$pdf->SetX(.5);
		$pdf->SetY(5.2);
		$pdf->SetFont('Arial Narrow Bold','',32);
		$pdf->Cell(10,.5,$examName,0,0,'C');
		
		$pdf->SetX(.5);
		$pdf->SetY(5.6);
		$pdf->SetFont('Arial Narrow','',20);
		$pdf->Cell(10,.5,'Granted: '.$examDate,0,0,'C');
	
		$pdf->Output($pdfFolder.$pdfName,'F');
		}

//////// Send the email

	$WebServer = $_SERVER['HTTP_HOST'];
	$subject = $FirstName.', your '.$examName.' Exam Certificate is enclosed';
	$msg= <<< EOF
<center>
	<table style='width:600px;font-family:arial, helvetica, sans-serif; font-weight:normal; border-collapse:collapse; border:2px solid #3d63a9;margin: 10px; padding:0; background:#fff;box-shadow: 0 1px 4px #666;'>
		<tr>
			<td style='background:#3d63a9;'>
				<a href='https://{$WebServer}'><img width='600' src='https://{$WebServer}/images/Trace-Logo-Short-Address-Block-Blue-Top.png' alt='Trace Analytics - The AirCheck Lab' /></a>
			</td>
		</tr>
		<tr>
			<td style='padding:15px;'>
				<h1>Congratulations, {$FirstName}!</h1>
				<p>You've successfully completed the <strong>{$examName} Exam</strong> with a perfect score!</p>
				<center>
					<h2>AirCheck&#x2713; Exam Results</h2>
					<table style="width:350px;font-family:arial, helvetica, sans-serif; font-weight:normal; border-collapse:collapse; text-align:center;">
						<tr>
							<td style="background-color:#EFF9E6; border: 1px solid #B3DC82; color: #5F9025;padding:10px;">Correct Answers = {$correctNumber}</td>
						</tr>
						<tr>
							<td style="background-color:#FFEDED; border: 1px solid #FBC4C4; color: #DE5959; padding:10px;">Incorrect Answers = {$incorrectNumber}</td>
						</tr>
						<tr>
							<td style="background-color:#F1F1F1; border: 1px solid #B6D7E8; color: #000000; padding:10px;">Percentage = {$percentage}%</td>
						</tr>
					</table>
				</center>
				<p>A PDF of your Certificate of Completion is enclosed.</p>
				<p>If there is no PDF attached to this email, you may also <a href="https://{$WebServer}{$pdfLink}">download your Certificate of Completion</a>.</p>
			</td>
		</tr>
		<tr>
			<td style='background:#3d63a9;'>
				<a href='https://{$WebServer}'><img width='600' src='https://{$WebServer}/images/Trace-Logo-Short-Address-Block-Blue-Bottom.png' alt='Trace Analytics - The AirCheck Lab' /></a>
			</td>
		</tr>
	</table>
</center>
EOF;
	
	$PDFAttachment = $pdfFolder.$pdfName;

////// Echo the success message

	$SuccessMessage = <<< EOF

<div class="eleven columns center mart20 noborder">
	<h1>Congratulations, {$FirstName}!</h1>
	<p>You have successfully completed the <strong>{$examName} Exam</strong> with a perfect score!</p>
	<p>Your Certificate of Completion has been emailed to <strong>{$Email}</strong>.<br />You may also download your Certificate of Completion by clicking the button below:</p>
	<div class="center">
		<a target="_blank" class="button blue medium" href="{$pdfLink}">Download Your <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Certificate of Completion</span> Now <i class="icon-arrow-right"></i></a>	
	</div>
</div>

EOF;

	echo $SuccessMessage;
}

//////// Send the email

	$to = $Email;
	//$replyTo = 'ServiceTeam@AirCheckLab.com'; // Setting the reply-to address also BCC's that reply-to address.
	$replyTo = '';
/* 	$bcc = 'justin.a.smitty@gmail.com'; */
	$bcc = 'justin@airchecklab.com, laura@airchecklab.com, marka@airchecklab.com, ruby@airchecklab.com';
	$fromName = 'AirCheck Exam Results';
	$fromEmail = 'ServiceTeam@AirCheckLab.com';
	$subject = $subject; // $subject is set in the error or success areas above.
	$msg = $msg; // $msg is set in the error or success areas above
	$PDFAttachment = $PDFAttachment; // $PDF Attachment is set in the success area above
	$pdfName = $examName; // for emailing, set the PDF Name to the exam name. Extra-long PDF names were causing problems with email clients.

	trace_mail_attachPDF($to,$replyTo,$bcc,$fromName,$fromEmail,$subject,$msg,$PDFAttachment,$pdfName);
}
?>

			<div class="clearfix"></div>
			<?php the_content(); ?>
			<div class="clearfix"></div>

			</div>
			<div class="small right mart20">Is there a problem with this page? Help us fix it - <a href="/report-a-bug">Report a Bug</a></div>
		</div>
	<?php  endwhile; endif; //have_posts ?>
	</div>
<!-- END OF CONTENT CONTAINER -->
<?php get_footer(); ?>