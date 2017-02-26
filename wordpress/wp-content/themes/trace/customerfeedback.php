<?php
/* 
Template Name: Customer Feedback
*/

/*
ini_set('display_errors',1); 
error_reporting(E_ALL);
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
<!-- TRACETEMPLATE INDEX -->
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

$webroot = $_SERVER['DOCUMENT_ROOT'];
	
define('INCLUDE_CHECK',true);
	
require $webroot.'/php/connect.php';
/* require $webroot.'/php/functions.php'; */


/*
$CustomerID = '8000';
$CustomerEmail = 'justin@airchecklab.com';
$EmailID = rand();
$Rating = '2';
$Comment = 'This is a comment.';
$OriginalSubject = 'AirCheck Report - "2015-11-09-26102-57928-Metro_Link__29th_Street" ready for download';
*/

echo "<h1>Customer Feedback</h1>";

if (isset($_GET['CID'])) {

	$CustomerID = base64_decode($_GET['CID']);
	$CustomerEmail = base64_decode($_GET['CE']);
	$EmailID = base64_decode($_GET['EID']);
	$Rating = base64_decode($_GET['R']);
	$OriginalSubject = base64_decode($_GET['OS']);
	
	switch ($Rating) {
		case "4":
			$RatingName = 'Outstanding';
			$RatingThankYou = 'Thank you for your rating of '.$RatingName.'!';
			$RatingResponse = "We're delighted that you are so happy with our service and really appreciate your feedback. If you'd like to make any specific comments regarding our service, please enter them below:";
			break;
		case "3":
			$RatingName = 'Good';
			$RatingThankYou = 'Thank you for your rating of '.$RatingName.'.';
			$RatingResponse = "We're always striving to improve our service and really appreciate your feedback. If there is anything we could have done to improve this rating to Outstanding, please let us know below:";
			break;
		case "2":
			$RatingName = 'Okay';
			$RatingThankYou = 'We\'re sorry that you rated us at '.$RatingName.'.';
			$RatingResponse = "We're always striving to improve our service and greatly appreciate your feedback. If there is anything we could have done to improve this rating, please let us know below:";
			break;
		case "1":
			$RatingName = 'Poor';
			$RatingThankYou = 'We\'re sorry that you rated us at '.$RatingName.'.';
			$RatingResponse = "We're always striving to improve our service and greatly appreciate your feedback. If there is anything we could have done to improve this rating, please let us know below:";
			break;
		}
	
	/*
	/////////////////////////// insert into MySQL ////////////////////////////////////////////
	*/
	// escape all of the strings

	$my_CustomerID = mysql_real_escape_string($CustomerID);
	$my_CustomerEmail = mysql_real_escape_string($CustomerEmail);
	$my_EmailID = mysql_real_escape_string($EmailID);
	$my_Rating = mysql_real_escape_string($Rating);
	$my_OriginalSubject = mysql_real_escape_string($OriginalSubject);
	
	// Insert into MySQL AirCheckWeb » ContactRequests table
	$sql = "insert into CustomerFeedback(CustomerID,CustomerEmail,EmailID,OriginalSubject,Rating) values('$my_CustomerID','$my_CustomerEmail','$my_EmailID','$my_OriginalSubject','$my_Rating')";
	
	mysql_query($sql);
	
	$sqlError = mysql_error($link);
	
	if (strpos($sqlError,'Duplicate') !== false) {
	$errorCheck = 'true';
    echo "<p>A rating has already been submitted by $CustomerEmail for the message with subject \"$OriginalSubject\".</p>";
	}
	
	// Get the pk_id of the previously inserted row.	
	$msgID = mysql_insert_id();
	$RatingID = $msgID;
	
	if ($errorCheck !== 'true') {  // What the heck?? --------------------------------------------------------------------------------------------
		
// 		echo "<pre><p>Successfully inserted row $msgID.</p></pre>";
		
		echo "<h2>$RatingThankYou</h2><p>$RatingResponse</p>";
		
		echo "
		
		<div class='form-div contact-wrap'>
			<form id='feedbackComment' name='frm' class='contact_form widelabel' method='post' action='/customer-feedback'>
			<div class='eight columns'>
				<input type='hidden' name='RID' value='$RatingID' />
				<input type='hidden' name='MID' value='$msgID' />
				<label for='field9755417' class='wide100'><strong>Comment:</strong></label>
				<textarea id='field9755417' name='C' placeholder='Comment' required ></textarea>
				<div class='right'>
					<input type='submit' class='blue button' value='Submit Form' />
				</div>
			</div>
			</form>
		</div>
		
		";
		
		}

	$subject = "A feedback rating of $Rating ($RatingName) has been submitted.";

	}


if (isset($_POST['RID'])) {

	$Comment = $_POST['C'];
	$msgID = $_POST['MID'];
	
	$my_Comment = mysql_real_escape_string($Comment);

	// Get the rest of the variables from MySQL
	
 	$sqlGet = "SELECT CustomerID,CustomerEmail,EmailID,OriginalSubject,Rating FROM CustomerFeedback WHERE ID_pk=$msgID";
	
	$result = mysql_query($sqlGet);

	while ($row = mysql_fetch_assoc($result)) {
	$CustomerID = $row["CustomerID"];
	$CustomerEmail = $row["CustomerEmail"];
	$EmailID = $row["EmailID"];
	$OriginalSubject = $row["OriginalSubject"];
	$Rating = $row["Rating"];
	}

	$sqlComment = "UPDATE CustomerFeedback SET Comment='".$my_Comment."' WHERE ID_pk=$msgID";
	
	mysql_query($sqlComment);
	
	
// 	echo "<p>Added comment \"$Comment\" to row $msgID.</p>";
	echo "<h2>Thank you for your comment</h2><p>We have forwarded your comment to our service team. If any action is required, we will follow up once a resolution has been reached.</p>";
	
	$subject = "A comment has been submitted.";

}

if ( $errorCheck !== 'true' && ((isset($_POST['RID'])) || (isset($_GET['CID'])))) {

	// Construct the verification email
	
	$WebServer = $_SERVER['HTTP_HOST'];
	$to = 'serviceteam@airchecklab.com, cdatest@airchecklab.com';
	$replyTo = $CustomerEmail;
	$fromName = 'Customer Rating';
	$fromEmail = 'justin@airchecklab.com';
	/* $subject = "A feedback rating of $Rating has been submitted."; */
	
		$msg="";
			$msg.="<center><table style='width:600px;font-family:arial, helvetica, sans-serif; font-weight:normal; border-collapse:collapse; border:2px solid #3d63a9;margin: 10px; padding:0; background:#fff;box-shadow: 0 1px 4px #666;'>\n";
			$msg.="	<tr>\n";
			$msg.="	<tr><td style='background:#3d63a9;'><a href='https://" . $WebServer . "'><img width='600' src='https://" . $WebServer . "/images/Trace-Logo-Short-Address-Block-Blue-Top.png' alt='Trace Analytics - The AirCheck Lab' /></a></td></tr>\n";
			$msg.="	<tr>\n";
			$msg.="		<td style='padding:10px; margin:0;'>\n";
			$msg.="			<table style='width:580px;font-family:arial, helvetica, sans-serif; font-weight: normal;  border-collapse:collapse; border:none;margin: 0px auto 5px; background:#fff;'>\n";
			$msg.="				<tr>\n";
			$msg.="					<td style='padding:0; margin:0;'><img src='https://www.airchecklab.com/images/blank.gif' width='150' height='1' /></td>\n";
			$msg.="					<td style='padding:0; margin:0;'><img src='https://www.airchecklab.com/images/blank.gif' width='425' height='1' /></td>\n";
			$msg.="				</tr>\n";
			$msg.="				<tr>\n";
			$msg.="				<tr><td colspan='2' style='vertical-align:top;'><center><h2>" . $subject . "</h2></center></td></tr>\n";
			$msg.="				<tr><td style='vertical-align:top;'><strong>Orig. Email Subject:</strong> </td><td style='vertical-align:top;'>" . $OriginalSubject . "</td></tr>\n";
			if (isset($CustomerID)) { $msg.="				<tr><td style='vertical-align:top;'><strong>Customer ID:</strong> </td><td style='vertical-align:top;'>" . $CustomerID . "</td></tr>\n"; }
			if (isset($CustomerEmail)) { $msg.="				<tr><td style='vertical-align:top;'><strong>Email:</strong> </td><td style='vertical-align:top;'>" . $CustomerEmail . "</td></tr>\n"; }
			if (isset($EmailID)) { $msg.="				<tr><td style='vertical-align:top;'><strong>Message ID:</strong> </td><td style='vertical-align:top;'>" . $EmailID . "</td></tr>\n"; }
			if (isset($Rating)) { $msg.="				<tr><td style='vertical-align:top;'><strong>Rating:</strong> </td><td style='vertical-align:top;'>" . $Rating . " ($RatingName)</td></tr>\n"; }
			if (isset($Comment) && $Comment !== '') { $msg.="				<tr><td style='vertical-align:top;'><strong>Comment:</strong> </td><td style='vertical-align:top;'>" . $Comment . "</td></tr>\n"; }	
			$msg.="			</table>\n";
			$msg.="		</td>\n";
			$msg.="	</tr>\n";
			$msg.="	<tr><td style='background:#3d63a9;'><a href='https://" . $WebServer . "'><img width='600' src='https://" . $WebServer . "/images/Trace-Logo-Short-Address-Block-Blue-Bottom.png' alt='Trace Analytics - The AirCheck Lab' /></a></td></tr>\n";
			$msg.="</table>\n";
			$msg.="</center>\n";
	
/* 	echo $msg; */
	
	// Send Confirmation Email
	trace_mail($to,$replyTo,$fromName,$fromEmail,$subject,$msg);
	
	// Construct and send Activities email
	
	$to = 'traceactivities@airchecklab.com';
	$replyTo = '';
	$fromName = 'Customer Rating';
	$fromEmail = 'justin@airchecklab.com';
	$msg = "Rating  = $Rating
	Comment = $Comment
	Email = $CustomerEmail
	Original Message = $OriginalSubject
	
	Customer ID: $CustomerID
	Followup: No";
	
	trace_mail_plaintext($to,$replyTo,$fromName,$fromEmail,$subject,$msg);

	}
	
/* 	printf("Errormessage: %s\n", mysql_error($link)); */
	
	mysql_close($link);
	
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
					<?php the_content(); ?>
					<div class="clear"></div>
					<div class="small right mart20">Is there a problem with this page? Help us fix it - <a href="/report-a-bug">Report a Bug</a></div>
					<div class="clear"></div>
			</div>
		</div>
	<?php  endwhile; endif; //have_posts ?>
<!-- END OF CONTENT CONTAINER -->
<?php get_footer(); ?>