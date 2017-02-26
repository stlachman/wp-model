<?php
/* 
Template Name: Report Download
*/

if (!isset($_GET['r'])) { header('Location: http://'.(basename($_SERVER['SERVER_NAME']))); }

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
<!-- TRACETEMPLATE REPORT DOWNLOAD -->
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
					$report = trim(base64_decode($_GET['r'])).'.zip';
					$fileName = substr( $report, strrpos( $report, '/' )+1 );
					$customerName = str_replace('_', ' ', trim(base64_decode($_GET['c'])));
					$customerPIN = trim(base64_decode($_GET['n']));
					$_SESSION['report'] = $_GET['r'];
					$_SESSION['number'] = $_GET['n'];
				?>
				<h1 id="Download" class="align-left"><span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Report&trade;</span> Download for <em><?php echo $customerName; ?></em></h1>
				<div class='thirteen columns offset-by-three'>
					<div class='blueBox ten columns'><img class='wide100' src='/images/Trace-Logo-Short-Address-Block-Top.png' alt='Trace Analytics - The AirCheck Lab' /></div>
					<div class='whiteBox ten columns pad10 align-left' style="background-image:none;">
						<?php
							if (!isset($_SESSION['reportSuccess'])) {
								echo '<p>Dear ' . $customerName . ',</p><p>In the email directing you to this page, you should have received an <strong>Access Code</strong>. Please enter it below to access your reports:<br /><small><em class="padl15">note &mdash; reports will download as a .zip file, which may not work on some mobile devices</em></small></p>';
// 								echo '<p>Dear ' . $customerName . ',</p><p style="color:red;font-weight:bold;">AirCheck Reports are currently unavailable for download. We are working on the issue, and should have it resolved shortly.</p>';
								}
						?>
						<?php
							if ( (isset($_SESSION['reportFail'])) && (!isset($_SESSION['reportSuccess'])) ) {
								echo '<div class="rounded notification error"><h4>Please check the Access Code provided to you via email.</h4><p>If you are sure that your access code is correct and you are still receiving this error, please <a href="/report-a-bug">Report this problem</a> and we will contact you immediately.</p></div>'; unset($_SESSION['reportFail']);
								}
						?>
						<div style="width:400px; margin:0px auto; <?php if (isset($_SESSION['reportSuccess'])) { echo 'display:none;'; } ?>">
							<form id="DownloadAccess" name="DownloadAccess" class="contact_form widelabel center" method="post" action="/Process-Report-Download">
								<input style="width:170px !important; float:left; margin-top:3px;" type="text" name="AccessCode" autofocus="autofocus" id="AccessCode" autocomplete="off" placeholder="Enter Access Code..." required />
								<input type="submit" class="blue button marl15" style="float:left;" value="Download" />
							</form>
						</div>
						<div class="clearfix"></div>
						<?php
						if (isset($_SESSION['reportSuccess'])) {
$SuccessMsg = <<< EOF
<div class="rounded notification success center">
							<p>Thank you! Your reports are now available for download:</p>
							<h1 class="mart15">Your <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Report(s)&trade;</span> should start downloading automatically</h1>
							<p>If the download does not start automatically, you may<br /><a href="/report-pdfs/{$report}">Click Here to Download your <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Report(s)&trade;</span></a></p>
						</div>
						<p><strong>"{$fileName}"</strong> will be the name of the downloaded file; it will expand to a folder containing your <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Reports&trade;</span> and data sheets.</p>

EOF;
						
							echo $SuccessMsg; unset($_SESSION['reportSuccess']);	
							}
?>
						<hr />
						<p><strong>Important: You must use Adobe Reader to view your <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Reports&trade;</span></strong></p>
						
						<p>If you are having any problems viewing your reports, first update Adobe Reader and Adobe Flash, and then make sure that you are opening the PDFs with Adobe Reader.</p>
						
						<ul class="checklist">
							<li><a target="_blank" href="http://get.adobe.com/reader">Download Adobe Reader</a></li>
							<li><a target="_blank" href="http://get.adobe.com/flashplayer">Download Adobe Flash Player</a></li>
						</ul>
						<hr />
						<ul class="padList">
							<li><strong>To unzip and view your downloaded files:</strong>
<ul class="contentsc accordion">
	<li class="accordion-item noicon">
		<div class="toggleswitch accordionopen">
			<div class="toggletitle">Instructions for Windows</div>
		</div>									
		<div class="clear"></div>
		<div class="togglecontent">
			<ol class="number">
				<li>Locate the compressed file or folder</li>
				<li>Do one of the following:
					<ul class="square">
						<li>To extract a single file or folder, double-click the compressed folder to open it. Then, drag the file or folder from the compressed folder to a new location</li>
						<li>To extract all files or folders, right-click the compressed folder, and then click Extract All. In the Compressed (zipped) Folders Extraction Wizard, specify where you want to store the extracted files.</li>
					</ul>
				</li>
			</ol>
		</div>
	</li>								
	<li class="accordion-item noicon">
		<div class="toggleswitch accordionopen">
			<div class="toggletitle">Instructions for Mac</div>
		</div>									
		<div class="clear"></div>
		<div class="togglecontent">
			<ol class="number">
				<li>Locate the compressed file or folder</li>
				<li>Double-click the .zip file.</li>
			</ol>
		</div>
	</li>		
	<li class="accordion-item noicon">
		<div class="toggleswitch accordionopen">
			<div class="toggletitle">Instructions for iPhone</div>
		</div>														
		<div class="clear"></div>
		<div class="togglecontent">
			<ol class="number">
				<li>Open the downloaded .zip file using the free <a href="https://itunes.apple.com/us/app/izip-zip-unzip-unrar-tool/id413971331?mt=8">iZip</a> app (or another app that can decompress .zip files)</li>
				<li>For some PDFs, you may be able to view them directly in iZip.</li>
				<li>If you received a PDF Portfolio (multiple PDFs in a single file), you will need to use the free <a href="https://itunes.apple.com/us/app/adobe-reader/id469337564?mt=8">Adobe Reader</a> app to view the file.</li>
			</ol>
		</div>
	</li>
	<li class="accordion-item noicon">
		<div class="toggleswitch accordionopen">
			<div class="toggletitle">Instructions for Android</div>
		</div>														
		<div class="clear"></div>
		<div class="togglecontent">
			<ol class="number">
				<li>After the file finishes downloading, open the .zip file using Archive Viewer.</li>
				<li>Select the PDF file that you want to view - it should automatically open using the free <a href="https://play.google.com/store/apps/details?id=com.adobe.reader">Adobe Reader</a> app.</li>
			</ol>
		</div>
	</li>
</ul>
							</li>
							<li><strong>If you are unable to locate your downloaded reports:</strong>
<ul class="contentsc accordion">
	<li class="accordion-item noicon">
		<div class="toggleswitch accordionopen">
			<div class="toggletitle">Check the browser&rsquo;s download location</div>
		</div>									
		<div class="clear"></div>
		<div class="togglecontent">
			<p>Check the location where your browser automatically saves downloaded files:</p>
			<ul class="square">
				<li><strong>Internet Explorer:</strong> C:\...[user name]\My Documents\Downloads</li>
				<li><strong>Firefox:</strong> Choose Firefox &raquo; Preferences (Mac OS) or Tools &raquo; Options (Windows). In the General tab, look in the Downloads area. Check the setting <em>"Save Files To"</em> to see the download location.</li>
				<li><strong>Safari:</strong> Choose Safari &raquo; Preferences. In the General tab, check the setting <em>"Save Downloaded Files To"</em>.</li>
				<li><strong>Google Chrome:</strong> Choose Customize and Control Google Chrome &raquo; Options. In the Under The Hood tab, look under the Downloads heading. Check the Download location setting.</li>
			</ul>
		</div>
	</li>								
	<li class="accordion-item noicon">
		<div class="toggleswitch accordionopen">
			<div class="toggletitle">Check the Downloads window (Firefox, Safari, Chrome)</div>
		</div>									
		<div class="clear"></div>
		<div class="togglecontent">
			<p>Firefox, Safari, and Chrome track the progress of files they download. Check the Downloads window for the location of your downloaded files.</p>
			<ul class="square">
				<li><strong>Firefox: </strong>Choose Tools &raquo; Downloads or press Ctrl+J (Windows) or Command+J (Mac OS). Right-click (Windows) or Control-click (Mac OS) the downloaded file and choose Open Containing Folder (Windows) or Show In Finder (Mac OS).</li>
				<li><strong>Safari (Mac OS):</strong> Choose Window &raquo; Downloads or press Option+Command+L. Control-click the downloaded file and choose Show In Finder.</li>
				<li><strong>Google Chrome</strong>: Choose Customize and Control Google Chrome &raquo; Downloads or press Ctrl+J. Click the Show in folder link under the downloaded file.</li>
			</ul>
		</div>
	</li>		
	<li class="accordion-item noicon">
		<div class="toggleswitch accordionopen">
			<div class="toggletitle">Search your hard drive</div>
		</div>														
		<div class="clear"></div>
		<div class="togglecontent">
			<p>Search your hard drives for the downloaded files using either of the following criteria:</p>
			<ul class="square">
				<li>Search for the file name <pre>"<?php echo $fileName; ?>"</pre></li>
				<li>Files modified on the date that you downloaded</li>
			</ul>
			<p>For further assistance with searching your hard disk, see the Help files for your operating system.</p>
		</div>
	</li>
</ul>
							</li>
							<li>It is recommended that you use Adobe Acrobat or the free Adobe Reader (<a target="_blank" href="http://get.adobe.com/reader/">http://get.adobe.com/reader/</a>) to open your reports.</li>
						</ul>
						<p>Thank you for your continued loyalty to Trace Analytics, LLC!</p>
						<p>Best Regards,</p>
						<p>the <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span> Team of Experts&trade;</span><br />
						We do one thing - Test Compressed Air</p>
					</div>
					<div class='blueBox ten columns'><img class='wide100' src='/images/Trace-Logo-Short-Address-Block-Bottom.png' alt='Trace Analytics - The AirCheck Lab' /></div>
				</div>	
			</div>
			<div class="clearfix"></div>

					<div class="clear"></div>
					<div class="small right mart20">Is there a problem with this page? Help us fix it - <a href="/report-a-bug">Report a Bug</a></div>
					<div class="clear"></div>
			</div>
		</div>
<!-- END OF CONTENT CONTAINER -->
<?php get_footer(); ?>