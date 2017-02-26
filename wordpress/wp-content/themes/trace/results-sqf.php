<?php
/* 
Template Name: Results - SQF
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
<?php if ($averis_headline_active!="offzz"){?>

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

$VideoID = 'S0V0eJDQ1tU';

$QuestionNo = '1'; $Answer = 'A'; $Minutes = '0'; $Seconds = '23';
$Question = 'According to the Trace Analytics SQF Air Purity video, SQF Air Purity Testing should monitor which of the following?';
$E02_Q01 = array($Answer, '<strong>Question '.$QuestionNo.'</strong> - '.$Question.' <a data-rel="prettyPhoto" class="zoom" title="'.$Question.'" target="blank" href="http://www.youtube.com/watch?v='.$VideoID.'&t='.$Minutes.'m'.$Seconds.'s'.'&start='.(($Minutes * 60) + $Seconds).'&width=640&height=360">Watch the video</a>');

$QuestionNo = '2'; $Answer = 'C'; $Minutes = '8'; $Seconds = '25';
$Question = 'Compressed air classes typically used in the food industry can be found in which document?';
$E02_Q02 = array($Answer, '<strong>Question '.$QuestionNo.'</strong> - '.$Question.' <a title="'.$Question.'" target="blank" href="https://www.airchecklab.com/aircheck-academy/compressed-air-in-the-food-industry/sqf-air-purity/sqf-air-purity-info/#BCAS">Find the answer</a>');

$QuestionNo = '3'; $Answer = 'D'; $Minutes = '3'; $Seconds = '55';
$Question = 'Examples of compressed air used directly with the product include compressed air that is used to:';
$E02_Q03 = array($Answer, '<strong>Question '.$QuestionNo.'</strong> - '.$Question.' <a title="'.$Question.'" target="blank" href="https://www.airchecklab.com/aircheck-academy/compressed-air-in-the-food-industry/sqf-air-purity/sqf-air-purity-info/#q3">Find the answer</a>');

$QuestionNo = '4'; $Answer = 'A'; $Minutes = '5'; $Seconds = '54';
$Question = 'According to the experts at Trace Analytics, which of the following include common sources of contamination?';
$E02_Q04 = array($Answer, '<strong>Question '.$QuestionNo.'</strong> - '.$Question.' <a title="'.$Question.'" target="blank" href="https://www.airchecklab.com/aircheck-academy/compressed-air-in-the-food-industry/sqf-air-purity/sqf-air-purity-info/#q4">Find the answer</a>');

$QuestionNo = '5'; $Answer = 'A'; $Minutes = '6'; $Seconds = '09';
$Question = 'In order to comply with SQF Air Purity Requirements, it is highly recommended that';
$E02_Q05 = array($Answer, '<strong>Question '.$QuestionNo.'</strong> - '.$Question.' <a title="'.$Question.'" target="blank" href="https://www.airchecklab.com/aircheck-academy/compressed-air-in-the-food-industry/sqf-air-purity/sqf-air-purity-info/#q5">Find the answer</a>');

$QuestionNo = '6'; $Answer = 'A'; $Minutes = '9'; $Seconds = '10';
$Question = 'A course of action following inadequate test results may include';
$E02_Q06 = array($Answer, '<strong>Question '.$QuestionNo.'</strong> - '.$Question.' <a title="'.$Question.'" target="blank" href="https://www.airchecklab.com/aircheck-academy/compressed-air-in-the-food-industry/sqf-air-purity/sqf-air-purity-info/#q6">Find the answer</a>');

$QuestionNo = '7'; $Answer = 'B'; $Minutes = '11'; $Seconds = '46';
$Question = 'What is the recommended filter size at point of use?';
$E02_Q07 = array($Answer, '<strong>Question '.$QuestionNo.'</strong> - '.$Question.' <a title="'.$Question.'" target="blank" href="https://www.airchecklab.com/aircheck-academy/compressed-air-in-the-food-industry/sqf-air-purity/sqf-faqs/#q7">Find the answer</a>');

$QuestionNo = '8'; $Answer = 'B'; $Minutes = '10'; $Seconds = '48';
$Question = 'According to the the SQF website, food manufacturing plants must operate from the assumption that compressed air can be a source of which types of contamination?';
$E02_Q08 = array($Answer, '<strong>Question '.$QuestionNo.'</strong> - '.$Question.' <a title="'.$Question.'" target="blank" href="https://www.airchecklab.com/aircheck-academy/compressed-air-in-the-food-industry/sqf-air-purity/sqf-faqs/#q8">Find the answer</a>');

$QuestionNo = '9'; $Answer = 'A'; $Minutes = '12'; $Seconds = '50';
$Question = 'SQF Code states that when external labs are used, the labs must be accredited, according to';
$E02_Q09 = array($Answer, '<strong>Question '.$QuestionNo.'</strong> - '.$Question.' <a title="'.$Question.'" target="blank" href="https://www.airchecklab.com/aircheck-academy/compressed-air-in-the-food-industry/sqf-air-purity/sqf-faqs/#q9">Find the answer</a>');

$QuestionNo = '10'; $Answer = 'D'; $Minutes = '14'; $Seconds = '15';
$Question = 'Which AirCheck Kit, created by Trace Analytics, tests for particles, water, and oil?';
$E02_Q10 = array($Answer, '<strong>Question '.$QuestionNo.'</strong> - '.$Question.' <a title="'.$Question.'" target="blank" href="https://www.airchecklab.com/aircheck-academy/compressed-air-in-the-food-industry/sqf-air-purity/sqf-faqs/#q10">Find the answer</a>');

$QuestionNo = '11'; $Answer = 'A'; $Minutes = '15'; $Seconds = '28';
$Question = 'SQF states that air testing requirements and the number of samples should be based on which of the following?';
$E02_Q11 = array($Answer, '<strong>Question '.$QuestionNo.'</strong> - '.$Question.' <a title="'.$Question.'" target="blank" href="https://www.airchecklab.com/aircheck-academy/compressed-air-in-the-food-industry/sqf-air-purity/sqf-faqs/#q11">Find the answer</a>');

$QuestionNo = '12'; $Answer = 'D'; $Minutes = '14'; $Seconds = '46';
$Question = 'SQF website states that microbiological testing may include testing for:';
$E02_Q12 = array($Answer, '<strong>Question '.$QuestionNo.'</strong> - '.$Question.' <a title="'.$Question.'" target="blank" href="https://www.airchecklab.com/aircheck-academy/compressed-air-in-the-food-industry/sqf-air-purity/sqf-faqs/#q11">Find the answer</a>');

$QuestionNo = '13'; $Answer = 'C'; $Minutes = '2'; $Seconds = '39';
$Question = 'Which of the following should be used where compressed air comes in contact with exposed product, direct product contact surfaces, and interior surface packaging?';
$E02_Q13 = array($Answer, '<strong>Question '.$QuestionNo.'</strong> - '.$Question.' <a title="'.$Question.'" target="blank" href="https://www.airchecklab.com/aircheck-academy/compressed-air-in-the-food-industry/sqf-air-purity/sqf-faqs/#q13">Find the answer</a>');

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
	
	$subject = "Your $examName Exam Results";
	
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
	$subject = 'Your '.$examName.' Exam Certificate is enclosed';
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
		</div>
		<div class="small right mart20">Is there a problem with this page? Help us fix it - <a href="/report-a-bug">Report a Bug</a></div>
	<?php  endwhile; endif; //have_posts ?>
	</div>
<!-- END OF CONTENT CONTAINER -->
<?php get_footer(); ?>