<?php
/* 
Template Name: Exam - Food Grade Air
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
					
					<h2><span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Exam&trade;</span> &mdash; Food Grade Air in Manufacturing</h2>
					
					<?php // the_content(); ?>
					
					<div class="clear"></div>
					
					<?php
						if (!pg_user_logged()) { echo '<div class="pg_login_block"><p>You must be logged in to view the <span class="aircheck2">AirCheck<span class="tracecheck">&#x2713;</span> Exam</span></p></div>'; }
						else {
					?>
					
					<!-- Begin Form -->
					
					<form id="AirCheckExam1" class="contact_form" name="frm" method="post" action="../food-grade-air-in-manufacturing-aircheck-exam-results">
					<fieldset>
						<input type="hidden" name="examName" value="Food Grade Air in Manufacturing" />
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
			'Question'	=> 'Compressed air used in the food and beverage industry may contaminate the final product with',
			'AnswerA'	=> 'water only',
			'AnswerB'	=> 'particles only',
			'AnswerC'	=> 'methane gases and bacteria',
			'AnswerD'	=> 'particles, water, oil, and microorganisms',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '02',
			'Question'	=> 'The BCAS <em>Food and Beverage Grade Compressed Air: Best Practice Guideline 102</em> includes purity limits for ',
			'AnswerA'	=> 'particles, water, and carbon monoxide.',
			'AnswerB'	=> 'particles, water, and nitrogen oxides.',
			'AnswerC'	=> 'particles, water, and total oil.',
			'AnswerD'	=> 'particles, water, and lead.',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '03',
			'Question'	=> 'According to the BCAS Guideline, what is the minimum recommendation for testing compressed air quality?',
			'AnswerA'	=> 'once a year',
			'AnswerB'	=> 'twice a year',
			'AnswerC'	=> 'once each quarter',
			'AnswerD'	=> 'twice per quarter',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '04',
			'Question'	=> 'The risk for microbiological contaminants should be assessed per which reference document? ',
			'AnswerA'	=> 'ISO 7501-2',
			'AnswerB'	=> 'ISO 8573-7',
			'AnswerC'	=> 'ISO 9141-2',
			'AnswerD'	=> 'ISO 10993-7',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '05',
			'Question'	=> 'Which of the following include primary sources of contamination of compressed air?',
			'AnswerA'	=> 'the ambient intake air and the compressor itself',
			'AnswerB'	=> 'the cleaning surface and the packaging',
			'AnswerC'	=> 'the compressor motor',
			'AnswerD'	=> 'the regulator',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '06',
			'Question'	=> 'In addition to oil contamination from the compressor, other sources of contamination may include which of the following?',
			'AnswerA'	=> 'intake air',
			'AnswerB'	=> 'storage receivers',
			'AnswerC'	=> 'system piping',
			'AnswerD'	=> 'all of the above',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '07',
			'Question'	=> 'Indirect contact of compressed air in packaging may include blow molding, surface cleaning, and ',
			'AnswerA'	=> 'mixing the product.',
			'AnswerB'	=> 'cleaning of the packaging.',
			'AnswerC'	=> 'cutting the product.',
			'AnswerD'	=> 'cleaning the product and packaging.',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '08',
			'Question'	=> 'Compressed air that comes into direct contact with food, according to the BCAS Guideline, shall meet which of the following?',
			'AnswerA'	=> ' ISO 22000:2005',
			'AnswerB'	=> ' ISO 8573-2:1996 Purity Class 1:1:0',
			'AnswerC'	=> ' ISO 22000:2007',
			'AnswerD'	=> ' ISO 8573-1:2010 Purity Class 2:2:1',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '09',
			'Question'	=> 'According to the BCAS Guideline, compressed air that falls under the indirect contact category shall meet',
			'AnswerA'	=> 'ISO 8573-1:2010 Purity Class 2:4:2',
			'AnswerB'	=> 'ISO 8573-2:1996 Purity Class 1:1:0',
			'AnswerC'	=> 'ISO 22002-1:2009',
			'AnswerD'	=> 'ISO 22002-3:2011',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '10',
			'Question'	=> 'The pet food industry is regulated by which of the following organizations?',
			'AnswerA'	=> 'The American Society for the Prevention of Cruelty to Animals (ASPCA)',
			'AnswerB'	=> 'People for the Ethical Treatment of Animals (PETA)',
			'AnswerC'	=> 'The Food and Drug Administration (FDA)',
			'AnswerD'	=> 'The World Health Organization (WHO)',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '11',
			'Question'	=> 'According to the BCAS, the maximum number of particles per m³ for .01-.05 micron should be ',
			'AnswerA'	=> '200,000.',
			'AnswerB'	=> '300,000.',
			'AnswerC'	=> '400,000.',
			'AnswerD'	=> '500,000.',
			'ImgLink'	=> '',
			'ImgAlt'	=> '',
			'ImgStyle'	=> '',
			),
	array(	'QNo'		=> '12',
			'Question'	=> 'Which of the following states the maximum number of particles per m³ for 0.5-1.0 micron, according to the BCAS?',
			'AnswerA'	=> '5,000',
			'AnswerB'	=> '6,000',
			'AnswerC'	=> '7,000',
			'AnswerD'	=> ' 8,000',
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