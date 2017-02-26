<?php
/* 
Template Name: Exam - Micro
*/
?>
<?php
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
<!-- TRACETEMPLATE EXAM - SOURCES OF CONTAMINATION -->
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
					?></div>
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
					
					<h2>Micro Exam</h2>
					
					<?php the_content(); ?>
					
					<div class="clear"></div>
					
					<?php
						if (!pg_user_logged()) { echo '<div class="pg_login_block"><p>You must be logged in to view the <span class="aircheck2">AirCheck<span class="tracecheck">&#x2713;</span> Exam</span></p></div>'; }
						else {
					?>
					
					<!-- Begin Form -->
					
					<form id="AirCheckExam1" class="contact_form" name="frm" method="post" action="../microbial-aircheck-exam-results">
					<fieldset>
						<input type="hidden" name="examName" value="KPSII Microbial Sampler" />
						<input type="hidden" name="examURL" value="<?php echo curpageurl(); ?>" />
						<input type="hidden" name="FirstName" id="ContactFirstName" value="<?php echo $user_firstname; ?>" />
						<input type="hidden" name="LastName" id="ContactLastName" value="<?php echo $user_lastname; ?>" />
						<input type="hidden" name="Email" id="ContactEmail" value="<?php echo $user_email; ?>" />
						<input type="hidden" name="Organization" id="ContactOrganization" value="<?php echo $user_company; ?>" />
						<div class="exam_question">
							<span class="exam_question_title"><h2 class="marb0">Your Information</h2><!-- <small class="mart0"><a href="#">Update your information</a></small> --></span>
							<div class="pad15 float-left">
								<table>
									<tr>
										<td>First Name: </td><td class="padl10"><span class="gray"><?php echo $user_firstname; ?></span></td>
									</tr>
									<tr>
										<td>Last Name: </td><td class="padl10"><span class="gray"><?php echo $user_lastname; ?></span></td>
									</tr>
									<tr>
										<td>Email: </td><td class="padl10"><span class="gray"><?php echo $user_email; ?></span></td>
									</tr>
									<tr>
										<td>Company: </td><td class="padl10"><span class="gray"><?php echo $user_company; ?></span></td>
									</tr>
								</table>
							</div>
						</div>
<?php
$exam = array(
	array(	'QNo'		=> '01',
			'Question'	=> 'What is the maximum allowable pressure at the sampling point to avoid damaging the KPSII sampler?',
			'AnswerA'	=> '100 psig',
			'AnswerB'	=> '60 psig',
			'AnswerC'	=> '40 psig',
			'AnswerD'	=> '175 psig',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '02',
			'Question'	=> 'What is the inner diameter of the hose used to connect to the sampling outlet?',
			'AnswerA'	=> '1/4&quot;',
			'AnswerB'	=> '1/2&quot;',
			'AnswerC'	=> '5/8&quot;',
			'AnswerD'	=> '3/16&quot;',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '03',
			'Question'	=> 'What is the proper procedure when you receive the cardboard box with the sampling plates?',
			'AnswerA'	=> 'Immediately put into vehicle’s trunk to be ready to take sample next day',
			'AnswerB'	=> 'Do not open until ready to use',
			'AnswerC'	=> 'Immediately open box and place sampling plates into refrigerator and ice packs into freezer.',
			'AnswerD'	=> 'Open all sampling plates to acclimatize and prevent condensation',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '04',
			'Question'	=> 'Which of the following cleaning solutions is acceptable for cleaning the sampler?',
			'AnswerA'	=> 'Isopropyl Alcohol',
			'AnswerB'	=> 'Bleach',
			'AnswerC'	=> 'Ammonia',
			'AnswerD'	=> '',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '05',
			'Question'	=> 'How often should the KPSII Microbial Sampler be cleaned?',
			'AnswerA'	=> 'Just once, when I receive it.',
			'AnswerB'	=> 'After a sample is taken from each sample point.',
			'AnswerC'	=> 'Cleaning of the KPSII is not necessary.',
			'AnswerD'	=> '',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '06',
			'Question'	=> 'What should be done immediately after assigning unique ID numbers to the Contact Plates?',
			'AnswerA'	=> 'Immediately place the contact plates back into the cooler.',
			'AnswerB'	=> 'Remove the lids of all contact plates to prepare them for sampling.',
			'AnswerC'	=> 'The ID number should be immediately written on the Chain of Custody form.',
			'AnswerD'	=> '',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '07',
			'Question'	=> 'After sampling, how should the Contact Plates be stacked in the cooler?',
			'AnswerA'	=> 'Sealed with the provided tape, lid on top, agar on bottom.',
			'AnswerB'	=> 'Sealed with the provided tape, stored on their sides so that all plates stay cool.',
			'AnswerC'	=> 'Sealed with the provided tape, agar on the top and lid on the bottom.',
			'AnswerD'	=> 'Any of the above',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '08',
			'Question'	=> 'Which of the following statements regarding Blind Samples is true?',
			'AnswerA'	=> 'Blind samples are recommended and show if there were any problems due to the sampling techniques or the environment.',
			'AnswerB'	=> 'Not really necessary.',
			'AnswerC'	=> 'Have air run across them for 10 minutes each.',
			'AnswerD'	=> 'All of the above',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '09',
			'Question'	=> 'How long should Blind Samples be exposed to the compressed air source?',
			'AnswerA'	=> '5 minutes',
			'AnswerB'	=> '10 minutes',
			'AnswerC'	=> 'No air should flow across the Blind Samples',
			'AnswerD'	=> '',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '10',
			'Question'	=> 'How long should air flow across the Sample Contact Plates?',
			'AnswerA'	=> '200 LPM for 10 minutes',
			'AnswerB'	=> '100 LPM for 10 minutes',
			'AnswerC'	=> '100 LPM for 20 minutes',
			'AnswerD'	=> '',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '11',
			'Question'	=> 'How many copies should be made of the Chain of Custody (COC) form?',
			'AnswerA'	=> 'One copy, for my records.',
			'AnswerB'	=> 'Two copies - one for my records, and one for Trace Analytics.',
			'AnswerC'	=> 'None - send the original COC form to the micro lab, and they will distribute copies after analysis.',
			'AnswerD'	=> '',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '12',
			'Question'	=> 'How should the KPSII Sampler be returned to Trace Analytics?',
			'AnswerA'	=> 'UPS Ground Shipping, within one week of sampling.',
			'AnswerB'	=> 'Using the provided shipping labels, on the scheduled date.',
			'AnswerC'	=> 'FedEx Next Day service, within 2 days of sampling.',
			'AnswerD'	=> '',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '13',
			'Question'	=> 'How should the Contact Plates be shipped to the micro lab?',
			'AnswerA'	=> 'UPS Ground Shipping, within one week of sampling.',
			'AnswerB'	=> 'Using the provided shipping labels, on the same day that the samples were taken.',
			'AnswerC'	=> 'FedEx Next Day service, within 2 days of sampling.',
			'AnswerD'	=> '',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '14',
			'Question'	=> 'Which of the following must be done prior to handling any of the microbial sampling equipment?',
			'AnswerA'	=> 'Wash your hands and put on gloves.',
			'AnswerB'	=> 'Wash your hands, put on a sterile gown, gloves, face mask and goggles.',
			'AnswerC'	=> 'Wash your hands.',
			'AnswerD'	=> '',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '15',
			'Question'	=> 'How should the contact plates be placed in the housing?',
			'AnswerA'	=> 'Do not open the plate until it is secured by the housing clips then gently remove the top of the plate.',
			'AnswerB'	=> 'Open the plate carefully like an Oreo cookie then clip into place.',
			'AnswerC'	=> 'There is no special way as the gloves will protect the plate from any contamination.',
			'AnswerD'	=> '',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			)
);

foreach ($exam as $question) {
	// set variables
	$QNo		= $question['QNo'];
	$Question	= $question['Question'];
	$AnswerA	= $question['AnswerA'];
	$AnswerB	= $question['AnswerB'];
	$AnswerC	= $question['AnswerC'];
	$AnswerD	= $question['AnswerD'];
	$ImgLink	= $question['ImgLink'];
	$ImgAlt		= $question['ImgAlt'];
	$ImgStyle	= $question['ImgStyle'];
	// foreach continues past the code block below
?>
					<div class="exam_question">
						<span class="exam_question_title"><h2>Question <?php echo $QNo; ?></h2></span>
						<div class="pad15">
							<p class="marb0"><strong><?php echo $Question; ?></strong></p>
							<div class="brochure">
								<input type="radio" id="E02_Q<?php echo $QNo; ?>_A01" name="E02_Q<?php echo $QNo; ?>" value="A" required />
								<label for="E02_Q<?php echo $QNo; ?>_A01"><?php echo $AnswerA; ?></label>
								<div class="clearfix"></div>
								
								<input type="radio" id="E02_Q<?php echo $QNo; ?>_A02" name="E02_Q<?php echo $QNo; ?>" value="B" />
								<label for="E02_Q<?php echo $QNo; ?>_A02"><?php echo $AnswerB; ?></label>
								<div class="clearfix"></div>
								
								<input type="radio" id="E02_Q<?php echo $QNo; ?>_A03" name="E02_Q<?php echo $QNo; ?>" value="C" />
								<label for="E02_Q<?php echo $QNo; ?>_A03"><?php echo $AnswerC; ?></label>
								<div class="clearfix"></div>
								
							<?php if ($AnswerD!==''){ ?>
								<input type="radio" id="E02_Q<?php echo $QNo; ?>_A04" name="E02_Q<?php echo $QNo; ?>" value="D" />
								<label for="E02_Q<?php echo $QNo; ?>_A04"><?php echo $AnswerD; ?></label>
							<?php } ?>
								<?php if($ImgLink!==''){ echo "<img src='$ImgLink' alt='$ImgAlt' class='$ImgStyle' />";} ?>
							</div>
						</div>
					</div>
<?php
	// end of the foreach statement
	}
?>
						
						<div class="center mart0 padt0">
							<h4 class="error errMsg2" style="display:none;">Please correct any highlighted fields above.</h4>
							<div class="clearfix"></div>
							<input id="submit-contact-1" type="submit" class="blue button" value="Submit Exam" />
						</div>
					</fieldset>
				</form>
				<div class="divide30"></div>
					
					<!-- End Form -->
					<?php } ?>
					<div class="small right mart20">Is there a problem with this page? Help us fix it - <a href="/report-a-bug">Report a Bug</a></div>
			</div>
		</div>
	<?php  endwhile; endif; //have_posts ?>
<!-- END OF CONTENT CONTAINER -->
<?php get_footer(); ?>