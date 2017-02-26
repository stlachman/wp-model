<?php
/* 
Template Name: Exam - SQF
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
					
					<h2><span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Exam&trade;</span> &mdash; SQF Air Purity</h2>
					
					<?php // the_content(); ?>
					
					<div class="clear"></div>
					
					<?php
						if (!pg_user_logged()) { echo '<div class="pg_login_block"><p>You must be logged in to view the <span class="aircheck2">AirCheck<span class="tracecheck">&#x2713;</span> Exam</span></p></div>'; }
						else {
					?>
					
					<!-- Begin Form -->
					
					<form id="AirCheckExam1" class="contact_form" name="frm" method="post" action="../sqf-air-purity-aircheck-exam-results">
					<fieldset>
						<input type="hidden" name="examName" value="SQF Air Purity" />
						<input type="hidden" name="examURL" value="<?php echo curpageurl(); ?>" />
						<input type="hidden" name="FirstName" id="ContactFirstName" value="<?php echo $user_firstname; ?>" />
						<input type="hidden" name="LastName" id="ContactLastName" value="<?php echo $user_lastname; ?>" />
						<input type="hidden" name="Email" id="ContactEmail" value="<?php echo $user_email; ?>" />
						<input type="hidden" name="Organization" id="ContactOrganization" value="<?php echo $user_company; ?>" />
						<div class="exam_question">
							<span class="exam_question_title"><h2 class="marb0">Your Information</h2><!-- <small class="mart0"><a href="#">Update your information</a></small> --></span>
							<div class="pad15">
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
			'Question'	=> 'According to Trace Analytics’ SQF Air Purity video, SQF Air Purity Testing should monitor which of the following?',
			'AnswerA'	=> 'particles, water, oil, and microbial contaminants',
			'AnswerB'	=> 'water, oil, and particles',
			'AnswerC'	=> 'particles and water only',
			'AnswerD'	=> 'oil and water only',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),

	array(	'QNo'		=> '02',
			'Question'	=> 'Compressed air classes typically used in the food industry can be found in which document?',
			'AnswerA'	=> 'Food Safety Modernization Act',
			'AnswerB'	=> 'ISO 17025',
			'AnswerC'	=> 'ISO 8573',
			'AnswerD'	=> 'Global Food Safety Initiative',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),

	array(	'QNo'		=> '03',
			'Question'	=> 'Examples of compressed air used directly with the product include compressed air that is used to:',
			'AnswerA'	=> 'package the product.',
			'AnswerB'	=> 'assist in creating product molds.',
			'AnswerC'	=> 'cleaning surfaces.',
			'AnswerD'	=> 'mix, cut, move, sort, or clean the product.',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),

	array(	'QNo'		=> '04',
			'Question'	=> 'According to the experts at Trace Analytics, which of the following include common sources of contamination?',
			'AnswerA'	=> 'the compressor, intake air, piping, and storage',
			'AnswerB'	=> 'filters only',
			'AnswerC'	=> 'packaging and the product itself',
			'AnswerD'	=> 'new piping',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),

	array(	'QNo'		=> '05',
			'Question'	=> 'In order to comply with SQF Air Purity Requirements, it is highly recommended that',
			'AnswerA'	=> 'sufficient filtration is used.',
			'AnswerB'	=> 'the original filter remains on the compressor.',
			'AnswerC'	=> 'filters are changed annually.',
			'AnswerD'	=> 'filtration is considered after negative results are obtained.',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),

	array(	'QNo'		=> '06',
			'Question'	=> 'A course of action following inadequate test results may include',
			'AnswerA'	=> 'in-line filtration, point of use filters, and cleaning piping.',
			'AnswerB'	=> 'additional testing and replacement equipment.',
			'AnswerC'	=> 'shutdown of the manufacturing facility.',
			'AnswerD'	=> 'solidifying a prerequisite program.',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),

	array(	'QNo'		=> '07',
			'Question'	=> 'What is the recommended filter size at point of use?',
			'AnswerA'	=> '0.5&micro; (micron)',
			'AnswerB'	=> '0.1&micro; (micron)',
			'AnswerC'	=> '1.5&micro; (micron)',
			'AnswerD'	=> '2.0&micro; (micron)',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),

	array(	'QNo'		=> '08',
			'Question'	=> 'According to SQF’s website, food manufacturing plants must operate from the assumption that compressed air can be a source of which types of contamination?',
			'AnswerA'	=> 'bacterial',
			'AnswerB'	=> 'chemical and microbial',
			'AnswerC'	=> 'water vapor',
			'AnswerD'	=> 'coolants and lubricants',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),

	array(	'QNo'		=> '09',
			'Question'	=> 'SQF Code states that when external labs are used, the labs must be accredited, according to',
			'AnswerA'	=> 'ISO 17025.',
			'AnswerB'	=> 'the BCAS Guideline.',
			'AnswerC'	=> 'ISO 8573.',
			'AnswerD'	=> 'the Global Food Safety Initiative.',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),

	array(	'QNo'		=> '10',
			'Question'	=> 'Which <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade;</span>, created by Trace Analytics, tests for particles, water, and oil?',
			'AnswerA'	=> 'AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade; K6088',
			'AnswerB'	=> 'AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade; K201P',
			'AnswerC'	=> 'AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade; K901',
			'AnswerD'	=> 'AirCheck<span class="tracecheck">&#x2713;</span> Kit&trade; K8573NB',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),

	array(	'QNo'		=> '11',
			'Question'	=> 'SQF states that air testing requirements and the number of samples should be based on which of the following?',
			'AnswerA'	=> 'the risk to the product and process',
			'AnswerB'	=> 'available testing personnel',
			'AnswerC'	=> 'individual local requirements',
			'AnswerD'	=> 'feedback from consumers',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),

	array(	'QNo'		=> '12',
			'Question'	=> 'SQF website states that microbiological testing may include testing for',
			'AnswerA'	=> 'moisture.',
			'AnswerB'	=> 'particles and water. ',
			'AnswerC'	=> 'hazardous chemical contamination.',
			'AnswerD'	=> 'aerobic plate count and/or indicator organisms.',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),

	array(	'QNo'		=> '13',
			'Question'	=> 'Which of the following should be used where compressed air comes in contact with exposed product, direct product contact surfaces, and interior surface packaging?',
			'AnswerA'	=> 'fans',
			'AnswerB'	=> 'aerosols',
			'AnswerC'	=> 'food grade oil',
			'AnswerD'	=> 'lubricating oil',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
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