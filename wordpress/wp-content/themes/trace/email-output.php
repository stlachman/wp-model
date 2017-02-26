<?php
/* 
Template Name: Email Output
*/
	$message = stripslashes($_POST['editor1']);
?>
<html>
<body>
<center>
<table style='width:600px;font-family:arial, helvetica, sans-serif; font-weight:normal; border-collapse:collapse; border:2px solid #3d63a9;margin: 10px; padding:0; background:#fff;box-shadow: 0 1px 4px #666;'>
	<tr>
	<tr><td style='background:#3d63a9;'><a href='https://www.airchecklab.com'><img width='600' height='72' src='https://www.airchecklab.com/images/Trace-Logo-Short-Address-Block-Blue-Top.png' alt='Trace Analytics - The AirCheck Lab' /></a></td></tr>
	<tr>
		<td style='padding:10px; margin:0;'>
			<table style='width:580px;font-family:arial, helvetica, sans-serif; font-weight: normal;  border-collapse:collapse; border:none;margin: 0px auto 5px; background:#fff;'>
				<tr>
					<td style='padding:0; margin:0;'><img src='https://www.airchecklab.com/images/blank.gif' width='575' height='1' /></td>
				</tr>
				<tr>
					<td style='padding:0px; margin:0;'>
<?php echo $message; ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
<!--
	<tr>
		<td style="padding-bottom:10px; padding-top:10px; border-top:2px solid #3d63a9; text-align:center;">
			<p><strong>Trace Analytics, LLC</strong> &mdash; <em>the AirCheck Lab&trade;</em><br />
			<a href="https://www.airchecklab.com" style="color:#000 !important; text-decoration:none !important;">www.AirCheckLab.com</a> &bull; 
			15768 Hamilton Pool Rd., Austin, TX 78738<br />
			<strong>phone:</strong> 512-263-0000 &bull; 
			<strong>tfree:</strong> 800-247-1024 &bull; 
			<strong>fax:</strong> 512-263-0002</p>
		</td>
	</tr>
-->
 	<tr><td style='background:#3d63a9;'><a href='https://www.airchecklab.com'><img width='600' height='31' src='https://www.airchecklab.com/images/Trace-Logo-Short-Address-Block-Blue-Bottom.png' alt='Trace Analytics - The AirCheck Lab' /></a></td></tr>
</table>
</center>
<p>&nbsp;</p>
<hr />
<center>
<p>When emailing, delete the line and everything below (including this paragraph and the button below)</p>
<form action="/Email-Creator" method="post">
	<input type="hidden" name="editor1" value='<?php echo trim(preg_replace('/\s\s+/', ' ', $message)); ?>' />
<p><input type="submit" value="Edit"></p>
</form>
</center>
</body>
</html>