<?php 

	header("Content-Type: text/javascript; charset=utf-8");
	
	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];
	require_once( $path_to_wp.'/wp-load.php' );
	
	$template_uri = get_template_directory_uri();
?>
jQuery(document).ready(function() {	
	/* Contact Form */
	if(jQuery('#contactform').length != 0){
		addForm('#contactform');
	}
	
	/* Quick Contact */
	if(jQuery('#quickcontact').length != 0){
		addForm('#quickcontact');
	}
	
	/* Blog Comments */
	if(jQuery('#replyform').length != 0){
		addForm('#replyform');
	}
});

	function addForm(formtype) {
	var formid = jQuery(formtype);
	var emailsend = false;
	
	formid.find("input[type=submit]").click(sendemail);
	
	
	function validator() {
		
		var emailcheck = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		var othercheck = /.{4}/;
		var noerror = true;
		
		formid.find(".requiredfield").each(function () {
													 
			var fieldname = jQuery(this).attr('name');
			var value = jQuery(this).val();
			if(value == "Name *" || value == "Email *" || value == "Message *"){
				value = "";	
			}

			if(fieldname == "email"){
				if (!emailcheck.test(value)) {
					jQuery(this).addClass("formerror");
					noerror = false;
				} else {
					jQuery(this).removeClass("formerror");
				}	
			}else{
				if (!othercheck.test(value)) {
					jQuery(this).addClass("formerror");
					noerror = false;
				} else {
					jQuery(this).removeClass("formerror");
				}	
			}
		})
		
		if(!noerror){
			formid.find(".errormessage").fadeIn();
		}
		
		return noerror;
	}
	
	function resetform() {
		formid.find("input").each(function () {
			if(!jQuery(this).hasClass("button")) jQuery(this).val("");	
		})
		formid.find("textarea").val("");
		emailsend = false;
	}
	

	function sendemail() {
		formid.find(".successmessage").hide();
		var phpfile = "";
		if(formtype=="#contactform"){
			phpfile = "<?php echo $template_uri; ?>/forms/contact.php";
		}else if(formtype.lastIndexOf("c_")){
			phpfile = "<?php echo $template_uri; ?>/forms/quickcontact.php";
		}else{
			phpfile = "";
		}
		if (validator()) {
			if(!emailsend){
				emailsend = true;
				formid.find(".errormessage").hide();
				formid.find(".sendingmessage").show();
				jQuery.post(phpfile, formid.serialize(), function() {
					formid.find(".sendingmessage").hide();
					formid.find(".successmessage").fadeIn();
					if(!formtype.lastIndexOf("c_"))resetform();
				});
			}
		} 
		return false
	}
}