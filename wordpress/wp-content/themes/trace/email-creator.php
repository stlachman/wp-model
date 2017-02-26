<?php
/* 
Template Name: Email Creator
*/
?>
<script type="text/javascript" src="/php/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/php/ckfinder/ckfinder.js"></script>
<?php
	if (isset($_POST['editor1'])) {$message = $_POST['editor1'];}
	else $message = '<p>Dear (Valued Customer Name),</p><p>We hope this letter finds you well. Because we value your business and strive for excellence in our quality of service, we would appreciate your feedback on your experience. With your permission, Trace Analytics would like to use your comments as a testimonial to help convince future clients that they can benefit from working with us as well.</p><p>To help you get started, we\'ve included a few questions, but please feel free to write whatever you would like.</p><p>Thank you so much for your time, and thanks again for your business. Please let us know if there\'s anything further we can do for you.</p><p>Sincerely,<br />The Trace Analytics Team</p>';

?>

<center>
<form method="post" action="/email-creator/email-output/">
<table style='width:600px;font-family:arial, helvetica, sans-serif; font-weight:normal; border-collapse:collapse; border:2px solid #3d63a9;margin: 10px; padding:0; background:#fff;box-shadow: 0 1px 4px #666;'>
	<tr>
	<tr><td style='background:#3d63a9;'><a href='https://www.airchecklab.com'><img width='600' src='https://www.airchecklab.com/images/Trace-Logo-Short-Address-Block-Blue-Top.png' alt='Trace Analytics - The AirCheck Lab' /></a></td></tr>
	<tr>
		<td style='padding:10px; margin:0;'>
			<table style='width:580px;font-family:arial, helvetica, sans-serif; font-weight: normal;  border-collapse:collapse; border:none;margin: 0px auto 5px; background:#fff;'>
				<tr>
					<td style='padding:0; margin:0;'><img src='https://www.airchecklab.com/images/blank.gif' width='575' height='1' /></td>
				</tr>
				<tr>
					<td style='padding:0px; margin:0;'>
						<textarea contenteditable="true" class="ckeditor" cols="80" id="editor1" name="editor1" rows="10">
<?php echo stripslashes($message); ?>
						</textarea>
					</td>
				</tr>
			</table>
		</td>
	</tr>
<!--
	<tr>
		<td style="padding-bottom:10px; padding-top:10px; border-top:2px solid #3d63a9; text-align:center;">
			<p><strong>Trace Analytics, LLC</strong> &mdash; <em>the AirCheck Lab&trade;</em><br />
			15768 Hamilton Pool Rd., Austin, TX 78738</p>
			<p><a href="https://www.airchecklab.com" style="color:#3d63a9 !important; text-decoration:none !important;"><strong>www.AirCheckLab.com</strong></a></p>
			<p>
			<strong>phone:</strong> 512-263-0000 &bull;
			<strong>tfree:</strong> 800-247-1024 &bull;
			<strong>fax:</strong> 512-263-0002</p>
		</td>
	</tr>
-->
	<tr><td style='background:#3d63a9;'><a href='https://www.airchecklab.com'><img width='600' height='31' src='https://www.airchecklab.com/images/Trace-Logo-Short-Address-Block-Blue-Bottom.png' alt='Trace Analytics - The AirCheck Lab' /></a></td></tr>
</table>
<p><input type="submit" value="Submit"></p>
</form>
</center>

<script type="text/javascript">

// This is a check for the CKEditor class. If not defined, the paths must be checked.
if ( typeof CKEDITOR == 'undefined' )
{
	document.write(
		'<strong><span style="color: #ff0000">Error</span>: CKEditor not found</strong>.' +
		'This sample assumes that CKEditor (not included with CKFinder) is installed in' +
		'the "/ckeditor/" path. If you have it installed in a different place, just edit' +
		'this file, changing the wrong paths in the &lt;head&gt; (line 5) and the "BasePath"' +
		'value (line 32).' ) ;
}
else
{
	var editor = CKEDITOR.replace( 'editor1' );
/* 	editor.setData( '<p>Just click the <b>Image</b> or <b>Link</b> button, and then <b>&quot;Browse Server&quot;</b>.</p>' ); */

	// Just call CKFinder.setupCKEditor and pass the CKEditor instance as the first argument.
	// The second parameter (optional), is the path for the CKFinder installation (default = "/ckfinder/").
	CKFinder.setupCKEditor( editor, '/php/ckfinder/' ) ;

	// It is also possible to pass an object with selected CKFinder properties as a second argument.
	// CKFinder.setupCKEditor( editor, { basePath : '../', skin : 'v1' } ) ;
}

		</script>