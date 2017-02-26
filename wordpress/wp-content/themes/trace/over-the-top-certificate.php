<?php
/* 
Template Name: Over the Top Certificate
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
<!-- TRACETEMPLATE INDEX -->
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
<?php
require('fpdf.php');

$certRecipient = $_POST['RecipientName'];
$certName = 'Over the Top';
$certReason = $_POST['AwardReason'];
$awardedBy = $_POST['ManagerName'];
$ManagerEmail = $_POST['ManagerEmail'];

$certDate = date("F j, Y");
$fileDate = date("Y-m-d");

$CertFileName = $fileDate.'-'.$certRecipient.'-'.$certName.'.pdf';
$itemSearch  = array(" ", "'", ";", "(", ")", ":");
$itemReplace = array("-", "",  "",  "",  "",  "");
$pdfName = str_replace($itemSearch, $itemReplace, nl2br($CertFileName));
$pdfFolder = '/Volumes/WebFiles/sites/airchecklab-new/OverTheTopCertificates/';
$pdfLink = '/OverTheTopCertificates/'.$pdfName;

$pdf = new FPDF('L','in','Letter');

$pdf->AddFont('Arial Narrow','','Arial Narrow.php');
$pdf->AddFont('Arial Narrow','U','Arial Narrow.php');

$pdf->AddFont('Arial Narrow Bold','','Arial Narrow Bold.php');
$pdf->AddFont('Arial Narrow Bold','U','Arial Narrow Bold.php');

$pdf->AddPage();
$pdf->Image('/Volumes/WebFiles/sites/airchecklab-new/resources/Over-the-Top-Certificate-Big.png',.5,.5,10);

$pdf->SetX(.5);
$pdf->SetY(4.2);
$pdf->SetFont('Arial Narrow Bold','',60);
$pdf->Cell(10,.5,$certRecipient,0,0,'C');

$pdf->SetX(.5);
$pdf->SetY(5.5);
$pdf->SetFont('Arial Narrow','',20);
$pdf->Cell(10,.5,"In recognition of: $certReason",0,0,'C');

$pdf->SetX(.5);
$pdf->SetY(6);
$pdf->SetFont('Arial Narrow','',16);
$pdf->Cell(10,.5,"Awarded by: $awardedBy on $certDate",0,0,'C');

/* $pdf->Output(); */
$pdf->Output($pdfFolder.$pdfName,'F');

	$WebServer = $_SERVER['HTTP_HOST'];
	$subject = 'Your Over the Top Certificate is enclosed';
	$msg= <<< EOF
	<table style='width:600px;font-family:arial, helvetica, sans-serif; font-weight:normal; border-collapse:collapse; border:6px solid #3d63a9;margin: 10px; padding:0; background:#fff;box-shadow: 0 1px 4px #666;'>
		
		<tr>
			<td style='padding:15px;'>
				<h3>Here is your Over the Top certificate!</h3>
				<p><strong>Presented to:</strong> {$certRecipient}<br />
				   <strong>In recognition of:</strong> {$certReason}<br />
				   <strong>Awarded by:</strong> {$awardedBy} on {$certDate}
				</p>
				<p>If there is no PDF attached to this email, you may also <a href="http://{$WebServer}{$pdfLink}">download the Over the Top certificate</a>.</p>
			</td>
		</tr>
	</table>
</center>
EOF;
	
	$PDFAttachment = $pdfFolder.$pdfName;

	$to = $ManagerEmail;
	$replyTo = '';
	$bcc = 'justin@airchecklab.com';
	$fromName = 'Over the Top!';
	$fromEmail = 'Justin@AirCheckLab.com';
	$subject = $subject; // $subject is set in the error or success areas above.
	$msg = $msg; // $msg is set in the error or success areas above
	$PDFAttachment = $PDFAttachment; // $PDF Attachment is set in the success area above
	$pdfName = $pdfName; // why am I doing this? Why did I do it on the line above?

	trace_mail_attachPDF($to,$replyTo,$bcc,$fromName,$fromEmail,$subject,$msg,$PDFAttachment,$pdfName);
?>
			
<div class="twelve columns offset-by-two center mart20">
	<h1>Your <em>Over the Top!</em> certificate is ready!</h1>
	<p>It has been emailed to <strong><?php echo $ManagerEmail;?></strong>.<br />You may also download your <strong><em>Over the Top!</em></strong> Certificate by clicking the button below:</p>
	<div class="center">
		<a target="_blank" class="button blue medium" href="<?php echo $pdfLink; ?>">Download Your <strong><em>Over the Top!</em></strong> Certificate Now <i class="icon-arrow-right"></i></a>	
	</div>
</div>

					<div class="clear"></div>
					<div class="small right mart20">Is there a problem with this page? Help us fix it - <a href="/report-a-bug">Report a Bug</a></div>
					<div class="clear"></div>
			</div>
		</div>
<!-- END OF CONTENT CONTAINER -->
<?php get_footer(); ?>