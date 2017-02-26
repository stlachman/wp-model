<?php
/* 
Template Name: Exam - ISO 8573
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
					
					<h2><span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Exam&trade;</span> &mdash; ISO 8573</h2>
					
					<?php // the_content(); ?>
					
					<div class="clear"></div>
					
					<?php
						if (!pg_user_logged()) { echo '<div class="pg_login_block"><p>You must be logged in to view the <span class="aircheck2">AirCheck<span class="tracecheck">&#x2713;</span> Exam</span></p></div>'; }
						else {
					?>
					
					<!-- Begin Form -->
					
					<form id="AirCheckExam1" class="contact_form" name="frm" method="post" action="../iso-8573-aircheck-exam-results">
					<fieldset>
						<input type="hidden" name="examName" value="ISO 8573" />
						<input type="hidden" name="examURL" value="<?php echo curpageurl(); ?>" />
						<input type="hidden" name="FirstName" id="ContactFirstName" value="<?php echo $user_firstname; ?>" />
						<input type="hidden" name="LastName" id="ContactLastName" value="<?php echo $user_lastname; ?>" />
						<input type="hidden" name="Email" id="ContactEmail" value="<?php echo $user_email; ?>" />
						<input type="hidden" name="Organization" id="ContactOrganization" value="<?php echo $user_company; ?>" />
						<div class="exam_question">
							<span class="exam_question_title"><h2 class="marb0">Your Information</h2><!-- <small class="mart0"><a href="#">Update your information</a></small> --></span>
							<div class="padl15 padt15">
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
			'Question'	=> 'What is the maximum allowable pressure at the sampling point using the NPT adaptor labeled UNR?',
			'AnswerA'	=> '125 psig',
			'AnswerB'	=> '50 psig',
			'AnswerC'	=> '200 psig',
			'AnswerD'	=> '25 psig',
			'ImgLink'	=> '/images/AirCheck-Exams/K8573-Exam/Q01-Adaptor.png',
			'ImgAlt'	=> 'UNR NPT Adaptor',
			'ImgStyle'	=> 'portrait',
			),
	array(	'QNo'		=> '02',
			'Question'	=> 'What is the thread size of the NPT Adaptor port that is used to connect to the sampling outlet?',
			'AnswerA'	=> '5/8&quot;',
			'AnswerB'	=> '1/4&quot;',
			'AnswerC'	=> '1/2&quot;',
			'AnswerD'	=> '3/4&quot;',
			'ImgLink'	=> '/images/AirCheck-Exams/K8573-Exam/Q02-NPT-Adaptor-Port.png',
			'ImgAlt'	=> 'UNR NPT Adaptor',
			'ImgStyle'	=> 'portrait',
			),
	array(	'QNo'		=> '03',
			'Question'	=> 'What contaminants can be sampled with the <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit K8573NB&trade;</span>?',
			'AnswerA'	=> 'Particles, Water, and Microbial',
			'AnswerB'	=> 'Particles, Microbial, and Oil',
			'AnswerC'	=> 'Particles, Water, and Oil',
			'AnswerD'	=> 'None of the above',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '04',
			'Question'	=> 'Which purity classes are selected when conducting Baseline Testing?',
			'AnswerA'	=> '2:4:1',
			'AnswerB'	=> 'The highest of each category, ex: Class 7',
			'AnswerC'	=> 'The lowest of each category, ex: Class 1',
			'AnswerD'	=> 'The most appropriate classes for my industry',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	
	array(	'QNo'		=> '05',
			'Question'	=> 'What portion of the test requires knowledge of the type of dryer installed on the compressed air or gas system?',
			'AnswerA'	=> 'Water',
			'AnswerB'	=> 'Oil Vapor',
			'AnswerC'	=> 'Oil Aerosol',
			'AnswerD'	=> 'Particulates',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '06',
			'Question'	=> 'In the following example, how many sets of Blank Media (pictured below) would be required?<br style="display:block;" /> <span style="font-weight:normal;">Example: 3 samples will be taken on a Monday and 2 samples will be taken the following Wednesday.</span>',
			'AnswerA'	=> '3',
			'AnswerB'	=> '1',
			'AnswerC'	=> '2',
			'AnswerD'	=> '0',
			'ImgLink'	=> '/images/AirCheck-Exams/K8573-Exam/Q06-Blank-Media.png',
			'ImgAlt'	=> 'Blank Media',
			'ImgStyle'	=> 'landscape',
			),
	array(	'QNo'		=> '07',
			'Question'	=> 'How often should the <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade;</span> and Adaptors be cleaned?',
			'AnswerA'	=> 'If contamination is suspected',
			'AnswerB'	=> 'Before each new sampling point',
			'AnswerC'	=> 'When visible contamination is present',
			'AnswerD'	=> 'All of the above',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '08',
			'Question'	=> 'What is the preferred material for fittings used to connect the <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade; K8573NB</span> to the sampling point?',
			'AnswerA'	=> 'Stainless Steel',
			'AnswerB'	=> 'Copper',
			'AnswerC'	=> 'Rubber Tubing',
			'AnswerD'	=> 'Medical-Grade Teflon',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '09',
			'Question'	=> 'Which fields are required when filling out a Data Sheet?',
			'AnswerA'	=> 'My location and signature only',
			'AnswerB'	=> 'All fields must completed',
			'AnswerC'	=> 'Only the answers I know',
			'AnswerD'	=> 'Location, flow rate, and my signature',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '10',
			'Question'	=> 'In the diagram below, which point on the <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade;</span> connects to the sampling point?',
			'AnswerA'	=> 'Point B',
			'AnswerB'	=> 'Point E',
			'AnswerC'	=> 'Point H',
			'AnswerD'	=> 'Point D',
			'ImgLink'	=> '/images/AirCheck-Exams/K8573-Exam/Q10-Flow-Diagram-2.png',
			'ImgAlt'	=> 'Flow Diagram',
			'ImgStyle'	=> 'landscape',
			),
	array(	'QNo'		=> '11',
			'Question'	=> 'How are Sampling Times for each portion of the test determined?',
			'AnswerA'	=> 'The tables in the <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Notebook&trade;</span>',
			'AnswerB'	=> 'According to the purity class needed',
			'AnswerC'	=> 'Air volume divided by the flow rate',
			'AnswerD'	=> 'All of the above',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '12',
			'Question'	=> 'At what point in the sampling is the blue Filter Cassette removed?',
			'AnswerA'	=> 'After the Particle test',
			'AnswerB'	=> 'After the Oil test',
			'AnswerC'	=> 'After completion of all tests',
			'AnswerD'	=> 'After connecting the compressed air supply',
			'ImgLink'	=> '/images/AirCheck-Exams/K8573-Exam/Q12-Filter-Cassette.png',
			'ImgAlt'	=> 'Blue Filter Cassette',
			'ImgStyle'	=> 'landscape',
			),
	array(	'QNo'		=> '13',
			'Question'	=> 'Which flowmeter measures air flow through the blue Filter Cassette?',
			'AnswerA'	=> 'Small tube flowmeter with control valve',
			'AnswerB'	=> 'Large filter flowmeter',
			'AnswerC'	=> 'Flowmeters are not necessary for this portion of the test - use the outlet pressure to determine flow rate',
			'AnswerD'	=> 'Both flowmeters are used in conjunction to determine flow rate',
			'ImgLink'	=> '/images/AirCheck-Exams/K8573-Exam/Q13-Flowmeters.png',
			'ImgAlt'	=> 'Flowmeters',
			'ImgStyle'	=> 'portrait',
			),
	array(	'QNo'		=> '14',
			'Question'	=> 'If the required flow rate cannot be achieved, what measures should be taken?',
			'AnswerA'	=> 'Run the test for 2 hours',
			'AnswerB'	=> 'Add an additional 2 hours to the test',
			'AnswerC'	=> 'Calculate the sampling time with the calculations provided in the <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Notebook&trade;</span>',
			'AnswerD'	=> 'Halt sampling and adjust system pressure to achieve the desired flow rate',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '15',
			'Question'	=> 'Which Detector Tube is appropriate for systems that use a desiccant dryer?',
			'AnswerA'	=> '5/a-P Tube (yellow caps)',
			'AnswerB'	=> '20/a-P Tube (gray caps)',
			'AnswerC'	=> 'Either the 5/a-P or 20/a-P Detector Tube may be used.',
			'AnswerD'	=> 'Detector Tubes may not be used for these types of systems',
			'ImgLink'	=> '/images/AirCheck-Exams/K8573-Exam/Q15-Detector-Tubes.png',
			'ImgAlt'	=> 'Detector Tubes',
			'ImgStyle'	=> 'landscape',
			),
	array(	'QNo'		=> '16',
			'Question'	=> 'Which of the following steps must be performed during the Water Vapor Test?',
			'AnswerA'	=> 'Prepare for the Oil Vapor Test',
			'AnswerB'	=> 'Watch and record the time and amount of color change, if any',
			'AnswerC'	=> 'Prepare the second Detector Tube in case there is color change in the first one',
			'AnswerD'	=> 'Disconnect the compressed air supply and remove the blue filter cassette',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '17',
			'Question'	=> 'In which direction should the arrows point when inserting the Detector Tubes into the Tube Flowmeter?',
			'AnswerA'	=> 'Up',
			'AnswerB'	=> 'Down',
			'AnswerC'	=> 'The direction of the arrows does not impact this portion of the sampling procedure.',
			'AnswerD'	=> 'The Detector Tubes should never be inserted into the Tube Flowmeter',
			'ImgLink'	=> '/images/AirCheck-Exams/K8573-Exam/Q17-Detector-Tubes.png',
			'ImgAlt'	=> 'Detector Tubes',
			'ImgStyle'	=> 'portrait',
			),
	array(	'QNo'		=> '18',
			'Question'	=> 'In the picture below, which side of the Filter Cassette connects to the NPT Adaptor?',
			'AnswerA'	=> 'Side A',
			'AnswerB'	=> 'Side B',
			'AnswerC'	=> 'The Filter Cassette does not connect to the NPT Adaptor',
			'AnswerD'	=> 'The Filter Cassette may be connected either way',
			'ImgLink'	=> '/images/AirCheck-Exams/K8573-Exam/Q18-Filter-Cassette.png',
			'ImgAlt'	=> 'Blue Filter Cassette',
			'ImgStyle'	=> 'landscape',
			),
	array(	'QNo'		=> '19',
			'Question'	=> 'What is the proper method for shipping more than one sample from a given location?',
			'AnswerA'	=> 'Put all Filters, Data Sheets and Blanks together in one large box',
			'AnswerB'	=> 'Put each set of media with the corresponding Data Sheet in a pre-addressed box',
			'AnswerC'	=> 'Put all of the Filters in one box, Data Sheets in another and all Tubes in another',
			'AnswerD'	=> '',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '20',
			'Question'	=> 'How long should the Blank Control Media be attached to the compressed air or gas supply?',
			'AnswerA'	=> '30 seconds',
			'AnswerB'	=> 'Blank Control Media should be attached for the same amount of time as the Sampling Media',
			'AnswerC'	=> 'Blank Control Media should never be attached to any compressed air or gas source',
			'AnswerD'	=> '',
			'ImgLink'	=> '/images/AirCheck-Exams/K8573-Exam/Q06-Blank-Media.png',
			'ImgAlt'	=> 'Blank Media',
			'ImgStyle'	=> 'landscape',
			),
	array(	'QNo'		=> '21',
			'Question'	=> 'What is the Detector Tube reading in the picture shown below?',
			'AnswerA'	=> '125',
			'AnswerB'	=> '140',
			'AnswerC'	=> 'Red',
			'AnswerD'	=> '',
			'ImgLink'	=> '/images/AirCheck-Exams/K8573-Exam/Q21-Detector-Tube.png',
			'ImgAlt'	=> 'Detector Tube',
			'ImgStyle'	=> 'landscape',
			),
	array(	'QNo'		=> '22',
			'Question'	=> 'Is it necessary to break the tips off of the Blank Charcoal Tube?',
			'AnswerA'	=> 'Yes, the tips must be broken off of the Blank Charcoal Tube',
			'AnswerB'	=> 'No, the Blank Charcoal Tube must stay intact',
			'AnswerC'	=> 'It does not matter if the tips are broken or not',
			'AnswerD'	=> '',
			'ImgLink'	=> '/images/AirCheck-Exams/K8573-Exam/Q22-Charcoal-Blank.png',
			'ImgAlt'	=> 'Blank Charcoal Tube',
			'ImgStyle'	=> 'landscape'
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