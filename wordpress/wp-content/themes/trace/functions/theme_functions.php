<?php

if(0==1) add_theme_support( 'automatic-feed-links' );

//remove auto loading rel=next rel=shortlink link in header (Firefox was loading 'next', causing issues.)
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );

if ( function_exists('get_option_tree')) {
  $theme_options = get_option('option_tree');
}
if ( function_exists( 'register_nav_menu' ) ) {
	register_nav_menu( 'navigation', 'Main Navigation' );
}
add_theme_support( 'post-thumbnails' );

/* ------------------------------------- */
/* CUSTOM EXCERPT WORD LENGTH */
/* ------------------------------------- */

function excerpt($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
	} else {
		$excerpt = implode(" ",$excerpt);
	} 
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);

	return $excerpt;
}

/* ------------------------------------- */
/* FUNCTION TO RETRIEVE POST AND PAGE OPTIONS http://www.wprecipes.com/wordpress-tip-get-all-custom-fields-from-a-page-or-a-post */
/* ------------------------------------- */

function getOptions($id = 0){
    if ($id == 0) :
        global $wp_query;
        $content_array = $wp_query->get_queried_object();
		if(isset($content_array->ID)){
        	$id = $content_array->ID;
		}
    endif;   

    $first_array = get_post_custom_keys($id);

	if(isset($first_array)){
		foreach ($first_array as $key => $value) :
			   $second_array[$value] =  get_post_meta($id, $value, FALSE);
				foreach($second_array as $second_key => $second_value) :
						   $result[$second_key] = $second_value[0];
				endforeach;
		 endforeach;
	 }
	
	if(isset($result)){
    	return $result;
	}
}

/* ------------------------------------- */
/* ID BY SLUG FUNCTION */
/* ------------------------------------- */

function idbyslug($page_slug) {
	$page = get_page_by_path($page_slug);
	if ($page) {
		return $page->ID;
	} else {
		return null;
	}
};

/* ------------------------------------- */
/* SEARCH RESULTS REDIRECT by Mark Jaquith http://txfx.net/wordpress-plugins/nice-search/ */
/* ------------------------------------- */

function search_redirect() {
	if ( is_search() && strpos( $_SERVER['REQUEST_URI'], '/wp-admin/' ) === false && strpos( $_SERVER['REQUEST_URI'], '/search/' ) === false ) {
		wp_redirect( home_url( '/search/' . str_replace( array( ' ', '%20' ),  array( '+', '+' ), get_query_var( 's' ) ) ) );
		exit();
	}
}

add_action( 'template_redirect', 'search_redirect' );

$content_width = 960; 

/* ------------------------------------- */
/* ADD FIRST AND LAST CSS CLASS TO WIDGETS
   by MathSmath http://wordpress.org/support/topic/how-to-first-and-last-css-classes-for-sidebar-widgets*/
/* ------------------------------------- */

function widget_first_last_classes($params) {
	global $my_widget_num; // Global a counter array
	$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
	$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets	

	if(!$my_widget_num) {// If the counter array doesn't exist, create it
		$my_widget_num = array();
	}

	if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { // Check if the current sidebar has no widgets
		return $params; // No widgets in this sidebar... bail early.
	}

	if(isset($my_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
		$my_widget_num[$this_id] ++;
	} else { // If not, create it starting with 1
		$my_widget_num[$this_id] = 1;
	}

	$class = 'class="widget-' . $my_widget_num[$this_id] . ' '; // Add a widget number class for additional styling options

	if($my_widget_num[$this_id] == 1 && $my_widget_num[$this_id] != count($arr_registered_widgets[$this_id])) { // If this is the first widget
		$class .= ' first ';
	} elseif($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) { // If this is the last widget
		$class .= ' last ';
	}

	$params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']); // Insert our new classes into "before widget"

	return $params;
}
add_filter('dynamic_sidebar_params','widget_first_last_classes');

/* ------------------------------------- */
/* HIGHLIGHT SEARCH
   by http://speckyboy.com/2010/09/19/10-useful-wordpress-search-code-snippets/
/* ------------------------------------- */

function hls_set_query() {
  $query  = esc_attr(get_search_query());
 
  if(strlen($query) > 0){
    echo '
      <script type="text/javascript">var hls_query  = "'.$query.'";</script>
    ';
  }
}
 
function hls_init_jquery() {
//  wp_enqueue_script('jquery');
}

/* ------------------------------------- */
/* Special Comment Reply Link
/* ------------------------------------- */
function special_comment_reply_link($args = array(), $comment = null, $post = null) {
	        global $user_ID;
	
	        $defaults = array('add_below' => 'comment', 'respond_id' => 'respond', 'reply_text' => __('REPLY','averis'),
	                'login_text' => __('Log in to Reply','averis'), 'depth' => 0, 'before' => '', 'after' => '');
	
	        $args = wp_parse_args($args, $defaults);
	
	        if ( 0 == $args['depth'] || $args['max_depth'] <= $args['depth'] )
	                return;
	
	        extract($args, EXTR_SKIP);
	
	        $comment = get_comment($comment);
	        if ( empty($post) )
	                $post = $comment->comment_post_ID;
	        $post = get_post($post);
	
	        if ( !comments_open($post->ID) )
	                return false;
	
	        $link = '';

	        if ( get_option('comment_registration') && !$user_ID )
	                $link = '<a rel="nofollow" class="comment-reply-login sh_arrowright lunchproject" href="' . esc_url( wp_login_url( get_permalink() ) ) . '">' . $login_text . '</a>';
	        else
	                $link = "<a class='tpbutton bfade leftfloat' style='margin-top:45px' href='" . esc_url( add_query_arg( 'replytocom', $comment->comment_ID ) ) . "#" . $respond_id . "' onclick='return addComment.moveForm(\"$add_below-$comment->comment_ID\", \"$comment->comment_ID\", \"$respond_id\", \"$post->ID\")'>$reply_text &raquo;</a>";
	        return apply_filters('comment_reply_link', $before . $link . $after, $args, $comment, $post);
	}



/**
* Title		: Aqua Resizer
* Description	: Resizes WordPress images on the fly
* Version	: 1.1.2
* Author	: Syamil MJ
* Author URI	: http://aquagraphite.com
* License	: WTFPL - http://sam.zoy.org/wtfpl/
* Documentation	: https://github.com/sy4mil/Aqua-Resizer/
*
* @param string $url - (required) must be uploaded using wp media uploader
* @param int $width - (required)
* @param int $height - (optional)
* @param bool $crop - (optional) default to soft crop
* @param bool $single - (optional) returns an array if false
* @uses wp_upload_dir()
* @uses image_resize_dimensions()
* @uses image_resize()
*
* @return str|array
*/

function aq_resize( $url, $width, $height = null, $crop = null, $single = true ) {

	//validate inputs
	if(!$url OR !$width ) return false;

	//define upload path & dir
	$upload_info = wp_upload_dir();
	$upload_dir = $upload_info['basedir'];
	$upload_url = $upload_info['baseurl'];

	//check if $img_url is local
	if(strpos( $url, home_url() ) === false) return false;

	//define path of image
	$rel_path = str_replace( $upload_url, '', $url);
	$img_path = $upload_dir . $rel_path;

	//check if img path exists, and is an image indeed
	if( !file_exists($img_path) OR !getimagesize($img_path) ) return false;

	//get image info
	$info = pathinfo($img_path);
	$ext = $info['extension'];
	list($orig_w,$orig_h) = getimagesize($img_path);

	//get image size after cropping
	$dims = image_resize_dimensions($orig_w, $orig_h, $width, $height, $crop);
	$dst_w = $dims[4];
	$dst_h = $dims[5];

	//use this to check if cropped image already exists, so we can return that instead
	$suffix = "{$dst_w}x{$dst_h}";
	$dst_rel_path = str_replace( '.'.$ext, '', $rel_path);
	$destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";

	//if orig size is smaller
	if($width >= $orig_w) {

		if(!$dst_h) :
			//can't resize, so return original url
			$img_url = $url;
			$dst_w = $orig_w;
			$dst_h = $orig_h;

		else :
			//else check if cache exists
			if(file_exists($destfilename) && getimagesize($destfilename)) {
				$img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
			} 
			//else resize and return the new resized image url
			else {
				$resized_img_path = image_resize( $img_path, $width, $height, $crop );
				$resized_rel_path = str_replace( $upload_dir, '', $resized_img_path);
				$img_url = $upload_url . $resized_rel_path;
			}

		endif;

	}
	//else check if cache exists
	elseif(file_exists($destfilename) && getimagesize($destfilename)) {
		$img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
	} 
	//else, we resize the image and return the new resized image url
	else {
		$resized_img_path = image_resize( $img_path, $width, $height, $crop );
		$resized_rel_path = str_replace( $upload_dir, '', $resized_img_path);
		$img_url = $upload_url . $resized_rel_path;
	}

	//return the output
	if(!$single) {
		//array return
		$image = array (
			'url' => $img_url,
			'width' => $dst_w,
			'height' => $dst_h
		);

	} else {
		//str return
		$image = $img_url;
	}

	return $image;
}


/* ------------------------------------- */
/* Navigation Menu -> Selectbox
/* ------------------------------------- */
function get_page_selector($menu="Main") {
  $page_menu_items = wp_get_nav_menu_items($menu);

  $selectbox="<select>";
  foreach($page_menu_items as $page_menu_item) {
      $link = get_page_link($page_menu_item->object_id);
      $title = $page_menu_item->title;
      $selectbox.='<option="'.$link.'">'.$title.'</option>';
  }
  $selectbox.="</select>";
  return $selectbox;
}
 
add_action('init', 'hls_init_jquery');
add_action('wp_print_scripts', 'hls_set_query');


// set permalink
function set_permalink(){
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure('/%category%/%postname%/');
}
add_action('init', 'set_permalink');

 function my_get_the_excerpt($id=false) {
            global $post;

            $old_post = $post;
            if ($id != $post->ID) {
                $post = get_page($id);
            }

            if (!$excerpt = trim($post->post_excerpt)) {
                $excerpt = $post->post_content;
                $excerpt = strip_shortcodes( $excerpt );
                $excerpt = apply_filters('the_content', $excerpt);
                $excerpt = str_replace(']]>', ']]&gt;', $excerpt);
                $excerpt = strip_tags($excerpt);
                $excerpt_length = apply_filters('excerpt_length', 55);
                $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');

                $words = preg_split("/[\n\r\t ]+/", $excerpt, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
                if ( count($words) > $excerpt_length ) {
                    array_pop($words);
                    $excerpt = implode(' ', $words);
                    $excerpt = $excerpt . $excerpt_more;
                } else {
                    $excerpt = implode(' ', $words);
                }
            }

            $post = $old_post;

            return $excerpt;
        }

/* ------------------------------------- */
/* Fix Shortcodes Columns 
/* ------------------------------------- */

function fix_shortcodes($content){
			$columns = 	array("one_half","one_half_last","one_third","one_third_last","two_third","two_third_last","one_fourth","one_fourth_last","three_fourth","three_fourth_last","one_fifth","one_fifth_last","two_fifth","two_fifth_last","three_fifth","three_fith_last","four_fifth","four_fifth_last","one_sixth","one_sixth_last","five_sixth","five_sixth_last","contact-form-7");
	        $block = join("|",$columns);

			// opening tag
			$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
			
			// closing tag
			$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)/","[/$2]",$rep);
			
			return $rep;
	}
add_filter('the_content', 'fix_shortcodes');

/* ------------------------------------- */
/* Send email with attachments using PEAR / SMTP 
/* ------------------------------------- */

function trace_mail($to,$replyTo,$fromName,$fromEmail,$subject,$msg)
{
	// PEAR	mail function, so that we can send using an SMTP server.
	
	require_once "Mail.php";
	require_once "Mail/mime.php";
	
	// mail SENDING account
	$host = "ssl://secure.emailsrvr.com";
	$port = "465";
	$username = "serviceteam@airchecklab.com";
	$password = "TraceAnalytics775";
	$recipients = $to . ',justin@airchecklab.com';
	if ($replyTo!=='') { $recipients .= ',' . $replyTo; }
/*
	$headers = array (
		'From' => $fromName . ' <' . $fromEmail . '>',
		'To' => $to,
		'Cc' => $replyTo,
		'Subject' => $subject);
*/

	$headers = array (
		'From' => $fromName . ' <' . $fromEmail . '>',
		'To' => $to,
		'Cc' => $replyTo,
		'Reply-To' => $replyTo,
		'Subject' => $subject);

	
	$smtp = Mail::factory('smtp',
		array ('host' => $host,
		 'port' => $port,
		 'auth' => true,
		 'username' => $username,
		 'password' => $password));
	
	$mime = new Mail_mime();
	$mime->setHTMLBody($msg);
	
	$msg = $mime->get();
	$headers = $mime->headers($headers);
	
	$mail = $smtp->send($recipients, $headers, $msg);
	 
	if (PEAR::isError($mail)) {
		echo("<p>" . $mail->getMessage() . "</p>");
		} else {
//		   echo("<h1>Message successfully sent to " . htmlspecialchars($to) . "</h1>");
	}
}

function trace_mail_attachPDF($to,$replyTo,$bcc,$fromName,$fromEmail,$subject,$msg,$PDFAttachment,$pdfName)
{
	// PEAR	mail function, so that we can send using an SMTP server.
	
	require_once "Mail.php";
	require_once "Mail/mime.php";
	
	// mail SENDING account
	$host = "ssl://secure.emailsrvr.com";
	$port = "465";
	$username = "serviceteam@airchecklab.com";
	$password = "TraceAnalytics775";
/* 	$recipients = $to . ',justin@airchecklab.com'; */
	$recipients = $to;

	if ($bcc!=='') { $recipients .= ',' . $bcc; }
	if ($replyTo!=='') { $recipients .= ',' . $replyTo; }

	$headers = array (
		'From' => $fromName . ' <' . $fromEmail . '>',
		'To' => $to,
		//'Cc' => $replyTo,
		'Reply-To' => $replyTo,
		'Subject' => $subject);

	
	$smtp = Mail::factory('smtp',
		array ('host' => $host,
		 'port' => $port,
		 'auth' => true,
		 'username' => $username,
		 'password' => $password));
	
	$mime = new Mail_mime();
	$mime->setHTMLBody($msg);
	$mime->addAttachment($PDFAttachment,'application/pdf',$pdfName);
		
	$msg = $mime->get();
	$headers = $mime->headers($headers);
	
	$mail = $smtp->send($recipients, $headers, $msg);
	
	if (PEAR::isError($mail)) {
		echo("<p>" . $mail->getMessage() . "</p>");
		} else {
//		   echo("<h1>Message successfully sent to " . htmlspecialchars($to) . "</h1>");
	}
}

function trace_mail_plaintext($to,$replyTo,$fromName,$fromEmail,$subject,$msg)
{
	// PEAR	mail function, so that we can send using an SMTP server.
	
	require_once "Mail.php";
	require_once "Mail/mime.php";
	
	// mail SENDING account
	$host = "ssl://secure.emailsrvr.com";
	$port = "465";
	$username = "serviceteam@airchecklab.com";
	$password = "TraceAnalytics775";
/* 	$recipients = $to . ',justin@airchecklab.com'; */
	$recipients = $to;
	if ($replyTo!=='') { $recipients .= ',' . $replyTo; }
/*
	$headers = array (
		'From' => $fromName . ' <' . $fromEmail . '>',
		'To' => $to,
		'Cc' => $replyTo,
		'Subject' => $subject);
*/

	$headers = array (
		'From' => $fromName . ' <' . $fromEmail . '>',
		'To' => $to,
		'Cc' => $replyTo,
		'Reply-To' => $replyTo,
		'Subject' => $subject);

	
	$smtp = Mail::factory('smtp',
		array ('host' => $host,
		 'port' => $port,
		 'auth' => true,
		 'username' => $username,
		 'password' => $password));
	
	$mime = new Mail_mime();
 	$mime->setTxtBody($msg);
	
	$msg = $mime->get();
	$headers = $mime->headers($headers);
	
	$mail = $smtp->send($recipients, $headers, $msg);
	 
	if (PEAR::isError($mail)) {
		echo("<p>" . $mail->getMessage() . "</p>");
		} else {
//		   echo("<h1>Message successfully sent to " . htmlspecialchars($to) . "</h1>");
	}
}

/* ------------------------------------- */
/* Get the current page URL 
/* ------------------------------------- */

function curPageURL() {
	$pageURL = 'http';
	if ( isset( $_SERVER["HTTPS"] ) && strtolower( $_SERVER["HTTPS"] ) == "on" ) {$pageURL .= "s";}
	$pageURL .= "://";
	if (($_SERVER["SERVER_PORT"] != "80") && ($_SERVER["SERVER_PORT"] != "443")) {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	$pageURL = strtok($pageURL,'?');
	return $pageURL;
}

/* ------------------------------------- */
/* Fetch Quote / Invoice 
/* ------------------------------------- */
function QuoteFetchWithDetail($CustomerID, $QuoteID) {
//	$server = $_SERVER['HTTP_HOST'];
	$ini = ini_set("soap.wsdl_cache_enabled", 0);
//	$soap = new SoapClient('https://'.$server.'/php/websvcmgr.php?wsdl&Service=TraceCustomerAccess');
	$soap = new SoapClient('http://192.168.100.112/websvcmgr.php?wsdl&Service=TraceCustomerAccess');
	$lookup = $soap->QuoteFetchWithDetail(array("CustomerID" => "".$CustomerID."", "QuoteID" => "".$QuoteID.""));
	return $lookup;
}

/* ------------------------------------- */
/* Capture CC Info 
/* ------------------------------------- */
function CaptureCC($CustomerID, $QuoteID, $AmountDue, $CreditCardName, $CreditCardNumber, $CreditCardExp, $CreditCardCVV, $ConfirmationEmail, $KeepCC) {
	$ini = ini_set("soap.wsdl_cache_enabled", 0);
	$soap = new SoapClient('http://192.168.100.112/websvcmgr.php?wsdl&Service=TraceCustomerAccess');
	$lookup = $soap->CaptureCC(array("CustomerID" => "".$CustomerID."", "QuoteID" => "".$QuoteID."", "AmountDue" => "".$AmountDue."", "CreditCardName" => "".$CreditCardName."", "CreditCardNumber" => "".$CreditCardNumber."", "CreditCardExp" => "".$CreditCardExp."", "CreditCardCVV" => "".$CreditCardCVV."", "ConfirmationEmail" => "".$ConfirmationEmail."", "KeepCC" => "".$KeepCC.""));
	return $lookup;
}


?>