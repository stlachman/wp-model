<?php

$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );
require_once( $path_to_wp.'/wp-includes/functions.php');

$post_id = $_POST["post_id"];

$to = get_option_tree("aversis_contact_sendto");


//Language Options
$contact_labelmailhead = __('Contact Form Email', 'averis');
$contact_labelmailsubject = __('Contact Form Email from', 'averis');
$contact_labelname = __('Name', 'averis');
$contact_labelemail = __('Email', 'averis');
//$contact_labeladdress = __('Address', 'averis');
$contact_labelphone = __('Phone', 'averis');
$contact_labelmessage = __('Message', 'averis');

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$message = str_replace(chr(10), "<br>", $_POST['message']);

$body = "<html><head><title>$contact_labelmailhead</title></head><body><br>";
$body .= "$contact_labelname: <b>" . $name . "</b><br>";
$body .= "$contact_labelemail <b>" . $email . "</b><br>";
$body .= "$contact_labelphone: <b>" . $phone . "</b><br><br>";
$body .= "$contact_labelmessage:<br><hr><br><b>" . $message . "</b><br>";
$body .= "<br></body></html>";
	
$subject = $contact_labelmailsubject.' ' . $name;
$header = "From: $email\n" . "MIME-Version: 1.0\n" . "Content-type: text/html; charset=utf-8\n";

mail($to, $subject, $body, $header);


?>