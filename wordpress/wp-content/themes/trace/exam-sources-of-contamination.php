<?php
/* 
Template Name: Exam - Sources of Contamination
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
					
					<h2><span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Exam&trade;</span> &mdash; Sources of Contamination</h2>
					
					<?php // the_content(); ?>
					
					<div class="clear"></div>
					
					<?php
						if (!pg_user_logged()) { echo '<div class="pg_login_block"><p>You must be logged in to view the <span class="aircheck2">AirCheck<span class="tracecheck">&#x2713;</span> Exam</span></p></div>'; }
						else {
					?>
					
					<!-- Begin Form -->
					
					<form id="AirCheckExam1" class="contact_form" name="frm" method="post" action="../sources-of-contamination-aircheck-exam-results">
					<fieldset>
						<input type="hidden" name="examName" value="Sources of Contamination" />
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
			'Question'	=> 'The two primary sources of contamination in a compressed air system are:',
			'AnswerA'	=> 'the compressor itself and water vapor.',
			'AnswerB'	=> 'the compressor itself and ambient air.',
			'AnswerC'	=> 'system piping and oil vapor.',
			'AnswerD'	=> 'system piping and bacteria.',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '02',
			'Question'	=> 'Which of the following contaminants are most likely to be present in the atmospheric air that feeds the compressor inlet?',
			'AnswerA'	=> 'rust and pipe scale',
			'AnswerB'	=> 'particulates, solders, bacteria, and glues',
			'AnswerC'	=> 'carbon monoxide and gaseous hydrocarbons',
			'AnswerD'	=> 'solid particles, water vapor, oil vapor, and microorganisms',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '03',
			'Question'	=> 'Contaminants created by the compressor system include:',
			'AnswerA'	=> 'liquid oil and oil vapor.',
			'AnswerB'	=> 'wear particles and intake water. ',
			'AnswerC'	=> 'dirt, sand, soot, and metal.',
			'AnswerD'	=> 'oxides, salt crystals, and water vapor.',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '04',
			'Question'	=> 'Which of the following gases may be produced by compressors?',
			'AnswerA'	=> 'carbon monoxide and oil vapor',
			'AnswerB'	=> 'gaseous hydrocarbons and water vapor',
			'AnswerC'	=> 'gaseous hydrocarbons, nitrous oxide, and hydrogen',
			'AnswerD'	=> 'carbon monoxide, carbon dioxide, and gaseous hydrocarbons',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '05',
			'Question'	=> 'Why is it important to test new piping for use with compressed air systems?',
			'AnswerA'	=> 'to ensure it fits properly',
			'AnswerB'	=> 'to ensure it is easy to use',
			'AnswerC'	=> 'to verify it has been thoroughly cleaned',
			'AnswerD'	=> 'to verify it has been purged of contaminants ',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '06',
			'Question'	=> 'When fitting new piping to old piping in a compressed air system, it may cause:',
			'AnswerA'	=> 'contaminants to be transferred to the new piping. ',
			'AnswerB'	=> 'improper fitting of the piping.',
			'AnswerC'	=> 'contaminants to be produced in the new piping.',
			'AnswerD'	=> 'improper use of the new piping.',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '07',
			'Question'	=> 'To ensure best practices of compressed air testing, what must an air test program include?',
			'AnswerA'	=> 'one-time testing of samples',
			'AnswerB'	=> 'a significant number and frequent testing of samples',
			'AnswerC'	=> 'an annual testing of samples',
			'AnswerD'	=> 'a limited number and infrequent testing of samples',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '08',
			'Question'	=> 'According to Parker Balston, how many points of use should be considered Risk Point(s) and tested?',
			'AnswerA'	=> 'only one point of use',
			'AnswerB'	=> 'several points of use',
			'AnswerC'	=> 'no points of use need to be considered and tested ',
			'AnswerD'	=> 'any point of use contact between the compressed air and the food',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '09',
			'Question'	=> 'The inlet air of a compressed air system may contain which of the following?',
			'AnswerA'	=> '5 to 50 bacteria per ft<sup>3</sup> ',
			'AnswerB'	=> '5 to 100 bacteria per ft<sup>3</sup>',
			'AnswerC'	=> '50 to 100 bacteria per ft<sup>3</sup>',
			'AnswerD'	=> '50 to 150 bacteria per ft<sup>3</sup>',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '10',
			'Question'	=> 'Direct and indirect contact points of compressed air and food include:',
			'AnswerA'	=> 'piping and filters.',
			'AnswerB'	=> 'bagging and filters.',
			'AnswerC'	=> 'pneumatic exhaust and seals.',
			'AnswerD'	=> 'air knives and pneumatic exhaust. ',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '11',
			'Question'	=> 'What is the first line of defense when preventing microbial contamination of a compressed air system?',
			'AnswerA'	=> 'point-of-use sterile air filtration ',
			'AnswerB'	=> 'proper fitting of piping',
			'AnswerC'	=> 'point-of-use refurbished air filters',
			'AnswerD'	=> 'proper fitting of o-rings',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '12',
			'Question'	=> 'According to the BCAS and Parker Balston, compressed air used in the manufacturing process should have a dew point of at least what degree to help prevent microbial growth?',
			'AnswerA'	=> '-20&deg;C / -4&deg;F',
			'AnswerB'	=> '+3&deg;C / +37&deg;F',
			'AnswerC'	=> '-40&deg;C / -40&deg;F',
			'AnswerD'	=> '-70&deg;C / -94&deg;F',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '13',
			'Question'	=> 'According to the SSOP: Maintenance of Filters for microbiological contaminants, how often should the Stage 3 filter elements be changed?',
			'AnswerA'	=> 'every 6-12 months, or sooner, based on point of use air quality testing',
			'AnswerB'	=> 'every 4 months',
			'AnswerC'	=> 'every 3-6 months, or sooner, based on point of use air quality testing',
			'AnswerD'	=> 'every 12 months',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '14',
			'Question'	=> 'Which standard does Parker Balston reference for microbiological testing',
			'AnswerA'	=> 'BCAS',
			'AnswerB'	=> 'HACCP',
			'AnswerC'	=> 'SQF Code',
			'AnswerD'	=> 'ISO 8573-7:2003',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '15',
			'Question'	=> 'According to Parker Balston, which of the SQF Code edition 7 modules listed below states, &quot;Compressed air used in the manufacturing process shall be regularly monitored for purity&quot;?',
			'AnswerA'	=> '11.5.7.1',
			'AnswerB'	=> '11.5.7.2',
			'AnswerC'	=> 'Level 1',
			'AnswerD'	=> 'Level 3',
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