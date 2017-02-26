<?php 

	header("Content-Type: text/css; charset=utf-8");
	
	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];
	require_once( $path_to_wp.'/wp-load.php' );
	require_once( $path_to_wp.'/wp-includes/functions.php');
	
	$template_uri = get_template_directory_uri();
	if ( function_exists( 'get_option_tree') ) {
		$main_google_font = get_option_tree("aversis_main_google_font_family"); 
		$highlight_color = get_option_tree("aversis_main_color");
		if(isset($_GET["maincolor"])) $highlight_color = "#".$_GET["maincolor"];
		if(get_option_tree( 'aversis_footer_active' )) $aversis_footer_active="-145"; else $aversis_footer_active="0";
	}
	
?>



/*----------------------------------------------------------------------------- 

STYLE CONFIGURATION FROM AVERIS THEME

Screen Stylesheet 

version:   	1.0 
date:      	20.04.2012 
author:		themepunch
email:     	support@themepunch.com 
website:   	http://www.themepunch.com
-----------------------------------------------------------------------------*/



/*********************************************
			TABLE OF CONTENT
			
			BASICS
			cONTENTS
			BACKGROUNDS
			TOP SOCIAL CONTAINER
			TOOLTIP
			HEADER AND NAVIGATION			
			QUOTES
			SOCIALS
			DIVIDER
			PAGINATION
			PORTFOLIO
			CONTENT LISTS
			WP-CORE			
			SIDEBARS
			BUTTONS
			INPUTBOX
			BLOG
			TEASER
			FOOTER
			TWIITER					
			
		
*********************************************/
							
							

/***********************
	-	BASICS 	-
***********************/


html 		{	width: 100%;	 margin: 0px;		overflow-x:hidden; 	padding: 0;}

body		{	margin:0px; background-color:<?php echo get_option_tree("aversis_body_background_color");?> ; font-family: Arial, sans-serif;
				/* background-image:url(https://www.aircheckacademy.com/wp-content/themes/trace/images/bg/trace_texture_bg.png); */
	}

.container	{ 	z-index:10;}

ol, ul 		{   list-style: none; }

a, a:visited {	text-decoration:none; color:<?php echo $highlight_color;?>;}

.button,
.purchase,
.button.big,
.button a,
.purchase a,
.tabs a	{  -webkit-transition: none 0s ease-out; -moz-transition: none 0s ease-out; -o-transition: none 0s ease-out; -ms-transition: none 0s ease-in-out;}

a:hover 	{	text-decoration: none;	cursor: pointer; /* JAS color:#777;	*/ color: #ed1d26; }
a:focus 	{   outline: none; }

.clear		{	clear:both;}
	
.centerme	{	margin-left:auto;margin-right:auto;	}
.content { padding-top: 20px; }


.leftfloat {float:left !important;}
.rightfloat { float: right !important;}

.rightfloat_leftfloat { float: right !important;}

   @media only screen and (min-width: 768px) and (max-width: 959px) {  
		.rightfloat_leftfloat { clear:both; float:left !important;}
	}
		
   @media only screen and (min-width: 480px) and (max-width: 767px) {  
		.rightfloat_leftfloat { float:left !important;}
	}   
   @media only screen and (min-width: 0px) and (max-width: 479px) {	
		.rightfloat_leftfloat { float:left !important;}
	}

.maincolor	{	color:<?php echo $highlight_color;?>}

h1, h2, h3, h4, h5, h6 {
		color: #000;
		 <?php echo $main_google_font;?>		
	}

	.titledivider	{	color: #666;  <?php echo $main_google_font;?>		font-weight: normal; font-size:18px; line-height:1; padding-bottom:10px;border-bottom:1px solid #ddd; width:100%}
	
	.more,a.more:visited			{	color:<?php echo $highlight_color;?>; <?php echo $main_google_font;?>		font-weight: bold; font-size:<?php echo (get_option_tree( 'aversis_main_font_size', '', false, true, 0 )+2).get_option_tree( 'aversis_main_font_size', '', false, true, 1 );?>; line-height:1;}


	h1 { font-size: <?php echo get_option_tree( 'aversis_h1_font_size', '', false, true, 0 ).get_option_tree( 'aversis_h1_font_size', '', false, true, 1 );?>; line-height: <?php echo (get_option_tree( 'aversis_h1_font_size', '', false, true, 0 )+4).get_option_tree( 'aversis_h1_font_size', '', false, true, 1 );?>; margin-bottom: 10px /* !important */;} 
	h2 { font-size: <?php echo get_option_tree( 'aversis_h2_font_size', '', false, true, 0 ).get_option_tree( 'aversis_h2_font_size', '', false, true, 1 );?>; line-height: <?php echo (get_option_tree( 'aversis_h2_font_size', '', false, true, 0 )+5).get_option_tree( 'aversis_h2_font_size', '', false, true, 1 );?>; margin-bottom: 10px /* !important */;} 
	h3 { font-size: <?php echo get_option_tree( 'aversis_h3_font_size', '', false, true, 0 ).get_option_tree( 'aversis_h3_font_size', '', false, true, 1 );?>; line-height: <?php echo (get_option_tree( 'aversis_h3_font_size', '', false, true, 0 )+6).get_option_tree( 'aversis_h3_font_size', '', false, true, 1 );?>;  margin-bottom: 10px /* !important */;}
	h4 { font-size: <?php echo get_option_tree( 'aversis_h4_font_size', '', false, true, 0 ).get_option_tree( 'aversis_h4_font_size', '', false, true, 1 );?>; line-height: <?php echo (get_option_tree( 'aversis_h4_font_size', '', false, true, 0 )+9).get_option_tree( 'aversis_h4_font_size', '', false, true, 1 );?>;  margin-bottom: 10px /* !important */;}
	h5 { font-size: <?php echo get_option_tree( 'aversis_h5_font_size', '', false, true, 0 ).get_option_tree( 'aversis_h5_font_size', '', false, true, 1 );?>; line-height: <?php echo (get_option_tree( 'aversis_h5_font_size', '', false, true, 0 )+7).get_option_tree( 'aversis_h5_font_size', '', false, true, 1 );?>;  margin-bottom: 10px /* !important */;} 
	h6 { font-size: <?php echo get_option_tree( 'aversis_h6_font_size', '', false, true, 0 ).get_option_tree( 'aversis_h6_font_size', '', false, true, 1 );?>; line-height: <?php echo (get_option_tree( 'aversis_h6_font_size', '', false, true, 0 )+7).get_option_tree( 'aversis_h6_font_size', '', false, true, 1 );?>;  margin-bottom: 10px /* !important */;} 


p { margin: 0 0 20px 0; font-family: Arial, sans-serif; font-size:<?php echo (get_option_tree( 'aversis_main_font_size', '', false, true, 0 )).get_option_tree( 'aversis_main_font_size', '', false, true, 1 );?>; line-height:<?php echo (get_option_tree( 'aversis_main_font_size', '', false, true, 0 )+8).get_option_tree( 'aversis_main_font_size', '', false, true, 1 );?>;}

ul.square li { font-family: Arial, sans-serif; font-size:<?php echo (get_option_tree( 'aversis_main_font_size', '', false, true, 0 )).get_option_tree( 'aversis_main_font_size', '', false, true, 1 );?>; /* line-height:<?php echo (get_option_tree( 'aversis_main_font_size', '', false, true, 0 )+13).get_option_tree( 'aversis_main_font_size', '', false, true, 1 );?>; */}

ul.checklist li {	font-family: Arial, sans-serif;
					font-size:<?php echo (get_option_tree( 'aversis_main_font_size', '', false, true, 0 )).get_option_tree( 'aversis_main_font_size', '', false, true, 1 );?>;
					/* line-height:<?php echo (get_option_tree( 'aversis_main_font_size', '', false, true, 0 )+13).get_option_tree( 'aversis_main_font_size', '', false, true, 1 );?>;
					*/list-style-type: none;/* background: url('<?php echo $template_uri; ?>/images/icons/check.png') no-repeat left 3px; */
					/* padding-left: 10px; */
					text-indent: -16px;
					margin-left: 42px;}

ul.checklist li:before { content: '\2713'; /* float:left; */ color:#ed1d26; margin-right: 2px;}

ul.checklist, ul.square {margin-bottom:20px;}

blockquote { /*border-left: 1px solid #ccc;*/ padding-left: 10px; }
blockquote p{ font-family: Palatino, serif, Arial, sans-serif; font-size:<?php echo ((get_option_tree( 'aversis_main_font_size', '', false, true, 0 ))+2).get_option_tree( 'aversis_main_font_size', '', false, true, 1 );?>; line-height:<?php echo (get_option_tree( 'aversis_main_font_size', '', false, true, 0 )+8).get_option_tree( 'aversis_main_font_size', '', false, true, 1 );?>;}

/***************************
	-	CONTENTS	-
***************************/

	.content_container {
		width:960px;
/* JAS		background-color:#fff !important; */
		padding:0px 0px 00px 0px;
		/* JAS margin-top: 50px; */
		 /*-webkit-box-shadow:  0px 0px 10px 0px #bbb; box-shadow:  0px 0px 10px 0px #bbb;*/
		z-index:3;margin-left:auto;margin-right:auto; 
		}						
					.footer_container		{	 width:960px;  
												 
												 z-index:2;margin-left:auto;margin-right:auto;
											}
											
											
					.subfooter_container	{	 width:960px; margin-top:<?php echo $aversis_footer_active;?>px;  margin-bottom:50px; z-index:3;													
												 margin-left:auto;margin-right:auto;												
											}
					
					#subfooter_content		{	width:960px; padding:10px 30px; background:#222;	height:100%; position:relative; display:inline-block;  margin-left:-30px; border-radius: 0 0 6px 6px;}
											
									
	.content {
		width:960px;
		padding:0 30px;
		height:100%;
		position:relative;
		display:inline-block;
		background-color:#fff;
		margin-left:-30px;
		border-top:5px solid #fc0; /* <?php echo $highlight_color;?>; */
		margin-bottom:-6px;
		-webkit-box-shadow:  0px 0px 10px 0px rgba(0, 0, 0, 0.25); box-shadow:  0px 0px 10px 0px rgba(0, 0, 0, 0.25); -moz-box-shadow:0px 0px 10px 0px rgba(0, 0, 0, 0.25);
		}
					#footer_content	{	background:#333; width:960px; padding:30px 30px 60px !important; position:relative; display:inline-block !important;  margin-left:-30px;
										-moz-box-shadow:0px 0px 10px 0px rgba(0,0,0,0.25);  -webkit-box-shadow:  0px 0px 10px 0px rgba(0,0,0,0.25); box-shadow:  0px 0px 10px 0px rgba(0,0,0,0.25);
									}						
						
						.phone-box 				{	margin:40px 0 20px 0; float: right; text-align: right; white-space: nowrap;}
						
						@media only screen and (min-width: 768px) and (max-width: 959px) { 
							.content_container	{	width:768px;}
							.content			{	width:768px;}
							.footer_container	{	width:768px;}
							#footer_content		{	width:768px}		
							#subfooter_content		{	width:768px}		
							.subfooter_container	{  width:768px;}
							.phone-box 				{	margin:20px -20px 20px 0; float: right; text-align: right;}
							#nav ul > li 			{	padding:5px !important; font-size: 15px !important;	}
						}    
						
					   @media only screen and (min-width: 480px) and (max-width: 767px) {  
								.content_container		{	width:420px;}
								.content				{	width:420px; padding-left:20px !important; padding-right:20px !important; margin-left:-20px;}		
								#footer_content			{	width:420px; padding-left:20px !important; padding-right:20px !important; margin-left:-20px;}		
								#subfooter_content		{	width:420px; padding-left:20px !important; padding-right:20px !important; margin-left:-20px;}		
								#footer_content >sixteen.columns	{	margin-left:0px !important;}
								.footer_container		{	width:420px;}
								.subfooter_container	{	width:420px; padding-top:10px;padding-left:20px;padding-right:20px;}
								.phone-box 				{	margin:10px auto 0 auto; float: none !important; text-align: center;}
								.home-h2				{	left:-20px !important;}
						}
					   
					   @media only screen and (min-width: 0px) and (max-width: 479px) {	
								body					{	width:320px !important; overflow:hidden !important; margin-left:auto; margin-right:auto;}
								.content_container		{	margin-top:-5px !important; width:300px; padding-left:20px !important; padding-right:20px !important;margin-left:-10px;border-top:5px solid <?php echo $highlight_color;?>}
								.content				{	/* border-top:none; */width:300px; padding-left:10px !important; padding-right:10px !important;margin-left:-10px;}		
								#footer_content			{	width:300px; padding-left:20px !important; padding-right:20px !important;margin-left:-20px;}	
								#subfooter_content		{	width:300px; padding-left:20px !important; padding-right:20px !important;margin-left:-20px;}										
								#footer_content >sixteen.columns	{	margin-left:0px !important;}	
								
								.footer_container					{	width:300px;padding-left:0px; padding-right:0px;}
								.subfooter_container				{	width:300px;padding-left:0px; padding-right:0px;}
								
								.phone-box 				{	margin:10px auto 0 auto; float: none !important; text-align: center;}
								.home-h2				{	left:-20px !important;}
								
				   }



/***************************************
	-	THE BACKGROUNDS -
****************************************/



/**************************************************
	-	TOP  - BOTTOM CONTAINER WITH SOCIALS -	
****************************************************/

.sharings_wrap				{	margin-top:20px;}
.sharings					{	float:left;margin-left:15px;margin-top:1px;}
.sharings.first				{	margin-left:0px;}
.shgoogleplus				{	width:58px;height:20px}
.shfacebook					{	width:115px; height:20px}
.shpinterest				{	width:77px;height:20px}
.shtwitter					{	width:77px; height:20px}


/****************************
	-	TOOLTIP	-
*****************************/	

/*******************************
	-	MENU / HEAD 	-	
********************************/
#header 			{}

.pagetitle			{	float:left;	}
.pagetitle h3		{	margin-bottom:0px !important; line-height:1; font-size:23px;}
.breadcrumb_holder	{	/* JAS float:right; */}
.breadcrumb 		{	/* JAS float:right; */ <?php echo $main_google_font;?> text-shadow:1px 1px 0px #fff; font-size:15px; color:#777;}
.breadcrumb a, .breadcrumb a:visited		{	color:#777; -webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.3s ease-out; -ms-transition: all 1s ease-in-out;}
.breadcrumb a:hover,
.breadcrumb span.marked	{	color:<?php echo $highlight_color;?>;}


.sitelogo			{	float:left;position:relative;  width:<?php echo get_option_tree( 'aversis_logo_width');?>px; height:<?php echo get_option_tree( 'aversis_logo_height');?>px; background:url(<?php echo get_option_tree("aversis_logo_src");?>) no-repeat;}
.logo-topline		{	float:left;color:#999; font-size:12px; line-height:1; font-style:italic; font-family: sans-serif; position:relative; margin-top:17px;  margin-left:20px;}
.head-phone			{	float:left;color:#000; font-size:16px; line-height:1; font-weight:200; <?php echo $main_google_font;?> position:relative; margin-top:7px;  margin-left:20px;}
.headright_holder	{	float:right;}

.menuright_holder 		{	float:right;}
.menuright_holder span	{	float:left; position:relative;  margin-right:20px; color:#e3e3e3; font-size:14px;  font-style:italic; font-weight:200; <?php echo $main_google_font;?>  line-height:30px; text-shadow:0px 1px 0px #000; }

   @media only screen and (min-width: 768px) and (max-width: 959px) {  
		.head-phone	{	margin-left:0px;}
		
   }       
   
   @media only screen and (min-width: 480px) and (max-width: 767px) { 
		.head-phone	{	float:left; margin-left:2px; margin-top:27px;}
		.headright_holder	{	float:left; }
		.menuright_holder 		{	float:left;}
   }   
   
   @media only screen and (min-width: 0px) and (max-width: 479px) {	
		.breadcrumb_holder	{	clear:left;float:left;}
		.head-phone		{	float:left; margin-top:20px; margin-left:2px;}
		.menuright_holder 		{	float:left;}
		.menuright_holder >ul	{	}
		
   }




#navholder				{   width:960px; margin-left:-40px; background:#000; padding:0px 30px; border-top:1px solid #000; border-bottom:1px solid #000; margin-top:10px; border-radius: 10px 10px 0 0; -webkit-box-shadow:  0px 0px 10px 0px rgba(0, 0, 0, 0.25); box-shadow:  0px 0px 10px 0px rgba(0, 0, 0, 0.25); -moz-box-shadow:0px 0px 10px 0px rgba(0, 0, 0, 0.25);}
#nav					{	position:relative;	z-index:1000;	height:auto;	font-size:16px;	<?php echo $main_google_font;?>	/* text-shadow:0px 1px 0px #777; */	font-weight:normal;color:#e3e3e3; }

#nav a					{	 color:#fff; }

#nav ul					{	list-style:none;	 position:relative;}
#nav ul>li				{	line-height:20px; padding:5px 15px; float:left;	 position:relative;	z-index:10; cursor:pointer; border-right:1px solid #666;}

#nav >ul>li:hover,
#nav >ul>li.current-menu-item,
#nav >ul>li.current-menu-parent	{	background:#333; /* border-top:1px solid #333; border-left:1px solid #111 !important; border-right:1px solid #666 !important;  margin-top:-1px; */}

#nav >ul>li:hover a,
#nav >ul>li.current-menu-item a,
#nav >ul>li.current-menu-parent >a		{	color:#fff;}


#nav >ul>li:first-child	{	border-left:1px solid #222; }

#nav ul li ul a			{ 	width:200px;}
#nav ul li:first-child	{	margin-left:10px;}
#nav ul>li:last-child	{	margin-right:15px;}

#nav ul li>ul li a		{ 	line-height:20px; /* -webkit-transition: margin 0.3s; -moz-transition: margin 0.3s; -o-transition: margin 0.3s; -ms-transition: margin 0.3s; */}
#nav ul li>ul			{	display:none;padding:0px !important; margin-top:0px !important; margin-bottom:0px !important; top: 30px;   left: -31px; position:absolute;  }
#nav ul li ul li		{	margin-top:0px;margin-bottom:0px; padding-bottom:7px; padding-top:5px;padding-left:16px; /* font-weight:200; */ border-left:1px solid #444; border-right:1px solid #222; background:#333; margin-left:0px !important; margin-right:0px !important;clear:both;  border-bottom:1px solid #222; border-top:1px solid #444;width:180px; }

/*
#nav ul li ul li:first-child { border-top:none; border-left:none; border-right:none;}
#nav ul li ul li:last-child { border-bottom:none; border-left:none; border-right:none;}
*/

#nav >ul>li a:hover,
#nav ul li ul li:hover>a,
#nav ul li ul li.current-menu-item>a{	/* margin-left:5px; */color:#FFCC00; }   /* Color for hover nav text */
 

/* #nav ul li ul li:hover>a:before,
#nav ul li ul li.current-menu-item a:before {	content:'\2192'; float:left;} */


/* 3rd level nav */
#nav ul li ul li>ul {
	position: absolute;
	margin-top:-31px !important;
	margin-left: 243px;
	
	}

#nav ul li ul li>ul li {
	background:#444;
	}

#nav ul li ul li.menu-item-has-children>a:after {	content:'\2192'; float:right;}




#responsive-menu		 { cursor:pointer; display:none;height:40px;overflow:visible;position:relative;  z-index:99999; margin-bottom:10px;}
#responsive-menu select  { cursor:pointer; font-size:16px;width:100%;padding:10px;color:#000;border:none;background:#fff; }

#responsive-menu select.apple  { color:#333;background-color:rgba(255,255,255,0.75);}



 @media only screen and (min-width: 768px) and (max-width: 959px) {
		#responsive-menu	{ display:none;}
		#nav {display:block}
		#sitetitle  {margin-top:30px !important;}
		#navholder	{	width:768px;}
		.camera_caption > div { margin-left: 20px !important; margin-right: 20px !important; }
  }
  
  
   @media only screen and (min-width: 480px) and (max-width: 767px) {
		#nav 							{	display:none}
		#responsive-menu 				{ 	display:block;}
		#responsive-menu select 		{	cursor:pointer; position:absolute;top:0px; z-index:1000;opacity:0; -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; /*filter: alpha(opacity=0);-moz-opacity: 0;-khtml-opacity: 0;opacity: 0; */}
		#responsive-menu-button			{	cursor:pointer; margin-top:10px; color:#000; font-size:12px; font-family:Arial; padding:10px;position:relative;z-index:5;background:url(../images/selectnav_420.png) no-repeat;width:420px;height:20px;}
		#sitetitle 						{	margin-top:30px !important;	}
		#navholder						{	margin-left:-20px; width:420px; margin-top:20px;  padding-left:20px; padding-right:20px;}
		.camera_caption > div { margin-left: 20px !important; margin-right: 20px !important; }
		
   }
   
   @media only screen and (min-width: 0px) and (max-width: 479px) {
		#nav {display:none}
		#responsive-menu 				{ display:block; }		
		#responsive-menu select 		{	cursor:pointer; position:absolute;top:0px; z-index:1000;opacity:0;-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; /*filter: alpha(opacity=0);-moz-opacity: 0;-khtml-opacity: 0;opacity: 0; */}
		#responsive-menu-button			{	cursor:pointer; margin-top:10px; color:#000; font-size:12px; font-family:Arial; padding:10px;position:relative;z-index:5;background:url(../images/selectnav_300.png) no-repeat;width:280px;height:20px;}
		
		#sitetitle {margin-top:30px !important;}
		#navholder	{	margin-left:-10px; width:290px; margin-top:10px; padding-left:10px; padding-right:20px;}
		.camera_caption > div { margin-left: 20px !important; margin-right: 20px !important; }
   }


   
   
/*************************
	-	SOCIALS	-
*************************/

.socials			{	float:left;position:relative;	 height:25px;}	

.socials li				{	position:relative; float:left; margin-right:10px; z-index:100;}


.socials .soc .bg 	{	 background-position:top; margin-top:6px;
						-webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.3s ease-out; -ms-transition: all 1s ease-in-out;
					}



.socials .soc .tooltip	{	position:absolute;  top:0px;  margin-top:-51px;  margin-left:50%;  padding:5px 8px 5px 8px; background:#222; color:#f4f3f2; font-family:'Share', Arial; font-size:12px;
							border-radius: 2px;   -moz-border-radius: 2px;   -webkit-border-radius: 2px;
							visibility:hidden; -moz-opacity:0; /* filter:alpha(opacity=0); */ opacity:0;
							-webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.3s ease-out; -ms-transition: all 1s ease-in-out;
						}

.socials .soc .tooltip:after{
	content: '';
	position: absolute;
	bottom: -4px;
	left: 50%;
	margin-left: -6px;
	width: 0;
	height: 0;
	border-left: 6px solid transparent;
	border-right: 6px solid transparent;
	border-top: 6px solid #1a2d36;
}						
						
						
.socials .soc:hover .tooltip { visibility:visible; -moz-opacity:1; /* filter:alpha(opacity=100); */ opacity:1;margin-top:-33px;}						



.socials .soc:hover	.bg {	background-position:bottom; cursor:pointer;	}		  

.socials .dribble .bg		{	 width:20px; height:20px; background:url(../images/social/dribble.png) no-repeat;}
.socials .facebook .bg		{	 width:20px; height:20px;background:url(../images/social/facebook.png) no-repeat;}
.socials .twitter .bg		{	 width:20px; height:20px;background:url(../images/social/twitter.png) no-repeat;}
.socials .vimeo .bg			{	 width:20px; height:20px;background:url(../images/social/vimeo.png) no-repeat;}
.socials .youtube .bg		{	 width:20px; height:20px;background:url(../images/social/youtube.png) no-repeat;}



 @media only screen and (min-width: 768px) and (max-width: 959px) {
	
  }
  
  
   @media only screen and (min-width: 480px) and (max-width: 767px) {
		
		
   }
   
   @media only screen and (min-width: 0px) and (max-width: 479px) {
		
   }
   
   
   
   
  /******************************
	-	SHORTCODES	-
********************************/

	.tp-check				{	min-width:24px; height:10px;  padding-left:39px; padding-top:10px;  background:url(../images/icons/check_large.png) no-repeat 0px 0px;}	
	.tp-support				{	min-width:32px; height:23px;  padding-left:41px; padding-top:8px; margin-bottom:10px; background:url(../images/icons/agt_support.png) no-repeat 0px 0px;}	
	.tp-global				{	min-width:32px; height:23px;  padding-left:41px; padding-top:8px; margin-bottom:13px; background:url(../images/icons/Globe2.png) no-repeat 0px 0px;}	
	.tp-usflag				{	min-width:32px; height:23px;  padding-left:41px; padding-top:8px; margin-bottom:13px; background:url(../images/icons/USFlag.png) no-repeat 0px 0px;}
	.tp-question			{	min-width:32px; height:23px;  padding-left:41px; padding-top:8px; margin-bottom:13px; background:url(../images/icons/question.png) no-repeat 0px 0px;}	
	.tp-modular				{	min-width:32px; height:23px;  padding-left:41px; padding-top:8px; margin-bottom:10px; background:url(../images/icons/blockdevice.png) no-repeat 0px 0px;}	
	.tp-team				{	min-width:32px; height:23px;  padding-left:41px; padding-top:8px; margin-bottom:10px; background:url(../images/icons/agt_family.png) no-repeat 0px 0px;}		
	.tp-alert				{	min-width:32px; height:23px;  padding-left:41px; padding-top:8px; margin-bottom:10px; background:url(../images/icons/alert.png) no-repeat 0px 0px;}		
	.tp-cart				{	min-width:22px; height:12px;  padding-left:37px; padding-top:0px; background:url(../images/tiles/cart.png) no-repeat 0px 0px;}	

	.tag_holder				{ 	}
	.tag_holder li			{	float:left;}
	.tag					{	cursor:pointer; min-width:19px; height:17px; padding:2px 10px 4px 19px; background:url(../images/tiles/tagarrow.png) no-repeat;color:#fff; font-size:11px; font-weight:bold; margin-right:10px;}
	.tag.last			{	margin-right:0px;}
	.tag a					{	color:#fff; }	
	
	
	

	
	
	
	
/********************************
	-	QUOTES	-
********************************/


.sixteen .quoteholder {   width:960px; margin-left:-50px; background:#777;  padding:30px 30px; border-top:1px solid #ddd; border-bottom:1px solid #ddd; background:#eee;}
.pagetitleholder				{   width:940px; margin-left:-30px; background:#777;  padding:10px 40px 5px 40px; border-bottom:1px solid #ddd; background:#eee;}

 
	 @media only screen and (min-width: 768px) and (max-width: 959px) {
			
			.pagetitleholder				{	width:748px !important;}
			.sixteen .quoteholder			{	width:768px !important; margin:-50px;}
	  }
	  
	  
	   @media only screen and (min-width: 480px) and (max-width: 767px) {

			.sixteen .quoteholder,
			.pagetitleholder	{	margin-left:-20px; width:420px; margin-top:20px; padding-top:20px; padding-left:20px; padding-right:20px;}
			
			.pagetitleholder	{ margin-top:0px !important; padding-bottom:20px;}
			
	   }
	   
	   @media only screen and (min-width: 0px) and (max-width: 479px) {

			.sixteen .quoteholder,
			.pagetitleholder	{	margin-left:-20px; width:300px; margin-top:20px; padding-top:20px; padding-left:20px; padding-right:20px;}
			.pagetitleholder	{ margin-top:0px !important; padding-bottom:20px;}
	   }



/*******************************
	-	DIVIDER -	
********************************/

	.bigdivider p		{ color:#777;}
	.pagedivider, .linedivider		{ border-bottom:1px solid #ddd; margin-top:30px; margin-bottom:30px;	}
	.smallsizedivider	{}
	.killerclear		{	clear:both;	height:35px;}
	.killerclear:last-child	{	height:0px;}
	
	 @media only screen and (min-width: 768px) and (max-width: 959px) {
			
			.smallsizedivider	{}
			.killerclear	{	height:20px;}
			
	  }
	  
	  
	   @media only screen and (min-width: 480px) and (max-width: 767px) {

			.smallsizedivider	{ margin-bottom:30px;}
			.killerclear	{	height:0px;}
			
	   }
	   
	   @media only screen and (min-width: 0px) and (max-width: 479px) {

			.smallsizedivider	{ margin-bottom:30px;}
			.killerclear	{	height:0px;}
	   }

	

/********************************
	-	PAGINATION	-
*********************************/

	.pagination					{	margin-top:5px;}
	.pagination .page			{	padding:8px 12px; border-radius: 3px; -moz-border-radius: 3px; 	-webkit-border-radius: 3px; color:#000; font-size:12px; text-decoration:underline; font-weight:bold; 
									-webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.8s ease-out; -ms-transition: all 0.3s ease-in-out;
								}
	.pagination .page.marked,
	.pagination .page:hover		{	background-color:<?php echo $highlight_color;?>; color:#fff; text-decoration:none;}


	
/************************************************************
	-	BLOG, PORTFOLIO, TEASER TOPLINE and SUBLINES   -
*************************************************************/


.topline, .topline a, .topline a:visited,
.blog_topline, .blog_topline a, .blog_topline a:visited,
.teaser_topline, .teaser_topline a, .teaser_topline a:visited 			
	
	  {	 
		font-style:normal !important; color: #000 !important;	 <?php echo str_replace(";", " !important;", $main_google_font);?>	margin-bottom:11px !important; font-size: 18px !important; line-height: 1 !important; 	
		-webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.8s ease-out; -ms-transition: all 0.3s ease-in-out;
		}

.teaser_topline.teaser_without_subinfos	{	margin-bottom:16px !important; }


		
.blog_subinfos,
.blog_subinfos a,
.blog_subinfos a:visited,		
.subline, .subline a, .subline a:visited	
	  {	 
		
		font-size:11px;  color:#777; font-style:italic; line-height:15px; margin-bottom:15px;
		-webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.8s ease-out; -ms-transition: all 0.3s ease-in-out;
	  }


.blog_subinfos a:hover,
.subline a:hover,
.blog_topline a:hover,
.teaser_topline a:hover 	{ color:<?php echo $highlight_color;?>;}


a.more, a.more:visited {	 color:<?php echo $highlight_color;?> !important; font-size:14px !important; font-style:normal !important; -webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.3s ease-out; -ms-transition: all 1s ease-in-out;}

a.more:hover 	{	text-decoration: none;	cursor: pointer;color:#777 !important;	 }

.portfolio .subline, .portfolio .subline a, .portfolio .subline:visited	{	margin-bottom:0px !important}

/*******************************
	-	PORTFOLIO	-
********************************/




/*	PORTFOLIO DETAILS */

#portfolio_details_mask					{	position:relative; width:105%; height:0px; overflow:hidden; }

#portfolio_details						{	display:none;}

.portfolio_detail_imgholder				{	position:relative; padding:4px; overflow:hidden; background:#fff; border:1px solid #e5e5e5;  
											-webkit-box-shadow:  0px 0px 5px 0px rgba(0, 0, 0, 0.15);        -moz-box-shadow:  0px 0px 5px 0px rgba(0, 0, 0, 0.15);        box-shadow:  0px 0px 5px 0px rgba(0, 0, 0, 0.15);  }					   

.sixteen .portfolio_detail_imgholder	{	width:450px; }											
.eleven .portfolio_detail_imgholder		{	width:300px; }

.portfolio_detail_imgholder img 		{	position:relative; left:0px; top:0px; margin-bottom:-5px; width:100%; }

.sixteen .portfolio_detail_info_holder			{	padding-left:20px;}
.eleven .portfolio_detail_info_holder			{	padding-left:30px;}

.portfolio .topline, .portfolio .topline a, .portfolio .subline				{	text-align:center; }


.portfolio_navigation			{	position:relative; margin-left:20px; margin-top:20px;
									-webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.8s ease-out; -ms-transition: all 0.3s ease-in-out;}

.sixteen .portfolio_navigation	{	margin-left:20px; margin-top:20px;}
.eleven .portfolio_navigation	{	margin-left:30px; margin-top:20px;}


									
.portfolio_navigation_holder	 {	position:relative; }
.tochange						 {  position:relative;}


.portfolio_close			{	float:left;  background:URL(../images/tiles/thex.png) no-repeat 7px 5px; background-color:#ababab; width:20px; height:20px;margin-right:2px;
							-webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.8s ease-out; -ms-transition: all 0.3s ease-in-out;
							cursor:pointer;
							}
							
.portfolio_right			{	float:left;  background:URL(../images/tiles/small_right.png) no-repeat 7px 5px; background-color:#ababab; width:20px; height:20px;
							-webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.8s ease-out; -ms-transition: all 0.3s ease-in-out;
							cursor:pointer;
							}
.portfolio_left			{	float:left;  background:URL(../images/tiles/small_left.png) no-repeat 6px 5px; background-color:#ababab; width:20px; height:20px;margin-right:2px;
							-webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.8s ease-out; -ms-transition: all 0.3s ease-in-out;
							cursor:pointer;
						}
						
.portfolio_close:hover,
.portfolio_right:hover, .portfolio_left:hover	{	background-color:#cfcfcf;}
.portfolio_right.notinuse, .portfolio_left.notinuse	{	background-color:#e5e5e5; cursor:default;}



/*	PORTFOLIO FILTER	*/
.portfolio_selector_wrap		{	margin-bottom:20px; margin-top:1px;}
.portfolio_filter ul li			{	float:left; font-size:12px; color:#555; position:relative;}
.portfolio_category_divider		{	margin:0px 10px;border-left: 1px solid #ccc;height:14px;padding-bottom: 0px;padding-top:0px;}


.portfolio_filter a, .portfolio_filter a:visited	{	font-weight:bold; color:#555; -webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.8s ease-out; -ms-transition: all 0.3s ease-in-out;}
.portfolio_filter a:hover, 
.portfolio_filter .selected_selector	{	font-weight:bold;color:<?php echo $highlight_color;?>;} 
.portfolio_filter >ul					{	margin-bottom:20px !important;}



/*	SORT BY SETTINGS  */
.portfolio_sort_wrap			{	float:right;  color:#555; font-size:12px; margin-bottom:20px;}
.portfolio_sotrer_form			{	float:left; position:relative;margin-left:10px; width:129px;}
.portfolio_sorter_fake			{    background:url(../images/tiles/dropdown.png) no-repeat; width:129px;height:20px; padding:0px 5px;}
.portfolio_sotrer_form select	{	position:absolute;top:0px; left:0px; width:129px;
									-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";	/* filter: alpha(opacity=0);*/	-moz-opacity: 0;	-khtml-opacity: 0;	opacity: 0;
									color:#555; font-size:12px;}

.eleven .portfolio_sort_wrap	{	margin-bottom:30px !important;}
									
/*	PORTFOLIO ENTRIES	*/

									
.portfolio_imgholder		{	position:relative; padding:4px; overflow:hidden; background:#fff; border:1px solid #e5e5e5; margin-bottom:10px;   
								-webkit-box-shadow:  0px 0px 5px 0px rgba(0, 0, 0, 0.15);        -moz-box-shadow:  0px 0px 5px 0px rgba(0, 0, 0, 0.15);        box-shadow:  0px 0px 5px 0px rgba(0, 0, 0, 0.15);
							}

.sixteen .portfolio_imgholder	{	width:210px; }														

.eleven .portfolio ul li		{	width:310px !important; }
.eleven .portfolio_imgholder	{	width:300px; }
						   
.portfolio_imgholder img 	{	position:relative; left:0px; top:0px; margin-bottom:-4px; width:100%; }
								

								
/*	PORTFOLIO HOVER EFFECTS	 */								
.hovering						{ position:relative; overflow:hidden;}
.portfolio .portfolio_link, 
.hovering_link
								{	 width:36px; height:37px; position:absolute; z-index:10; margin-left:-18px; margin-top:-18px; left:50%; top:50%;
									-webkit-transform: translate(100%) rotate(180deg); 	-moz-transform: translate(100%) rotate(180deg);	-o-transform: translate(100%) rotate(180deg);-ms-transform: translate(100%) rotate(180deg);
									-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";	/* filter: alpha(opacity=0); */	-moz-opacity: 0;	-khtml-opacity: 0;	opacity: 0;
									-webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.3s ease-out; -ms-transition: all 0.3s ease-in-out;padding-top:2px;
								}
								
.portfolio_link .plink,
.hovering_link .plink			{	background:url(../images/tiles/link.png) no-repeat; width:36px; height:37px;}							
								
.portfolio_link.notalone,
.hovering_link.notalone			{   margin-left:2px;}

.portfolio .portfolio_link:hover .plink,
.hovering .hovering_link:hover .plink { background-position:bottom;}

.portfolio .portfolio_more,
.hovering_more					{	background:url(../images/tiles/plus.png) no-repeat; width:36px; height:37px; position:absolute; z-index:10; margin-left:-18px; margin-top:-18px; left:50%; top:50%;
									-webkit-transform: translate(-100%) rotate(-180deg); -moz-transform: translate(-100%) rotate(-180deg);-o-transform: translate(-100%) rotate(-180deg);-ms-transform: translate(-100%) rotate(-180deg);
									-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";	/* filter: alpha(opacity=0); */	-moz-opacity: 0;	-khtml-opacity: 0;	opacity: 0;
									-webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.3s ease-out; -ms-transition: all 0.3s ease-in-out;
								}
.portfolio_more .pmore,
.hovering_more .pmore			{	background:url(../images/tiles/plus.png) no-repeat; width:36px; height:37px;}															
								

.portfolio_more.notalone,
.hovering_more.notalone		{   margin-left:-40px;}

.portfolio .portfolio_more:hover .pmore,
.hovering_more:hover .pmore { background-position:bottom;}
								

.portfolio ul li:hover .topline,
.portfolio ul li:hover .topline a	{	color:<?php echo $highlight_color;?>; }

.portfolio ul li.notclickable	{	cursor:default; -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=30)";	/* filter: alpha(opacity=30); */	-moz-opacity: 0.3;	-khtml-opacity: 0.3;	opacity: 0.3;}


.portfolio ul li:hover .portfolio_link,
.portfolio ul li:hover .portfolio_more,

.hovering:hover .hovering_link,
.hovering:hover .hovering_more	{	-webkit-transform: translate(0%) rotate(0deg); -moz-transform: translate(0%) rotate(0deg);-o-transform: translate(0%) rotate(0deg);-ms-transform: translate(0%) rotate(0deg);
											-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";	/* filter: alpha(opacity=100); */	-moz-opacity: 1;	-khtml-opacity: 1;	opacity: 1;	-webkit-transform: translateZ(0) 									
										}

.hovering p {	display:none;	}
										
.portfolio ul li.notclickable .portfolio_link,
.portfolio ul li.notclickable .portfolio_more	{ display:none;}																			

										
/*	PORTFOLIO RESOPNSIVE SETTINGS	*/										
	@media only screen and (min-width: 768px) and (max-width: 959px) {
		
		.sixteen .portfolio_navigation			{	margin-left:10px; margin-top:10px;}		
		.sixteen .portfolio_detail_info_holder	{	padding-left:10px;}		
		.sixteen .portfolio_imgholder			{	width:165px;}
		.sixteen .portfolio_detail_imgholder	{	width:355px;}		
		
		.eleven .portfolio_navigation			{	margin-left:30px; margin-top:10px;}		
		.eleven .portfolio_sort_wrap			{	float:left; }
		.eleven .portfolio_detail_info_holder	{	padding-left:30px;}		
		.eleven .portfolio_imgholder			{	width:240px;}
		.eleven .portfolio_detail_imgholder		{	width:240px;}		
		.eleven .portfolio ul li				{	width:240px !important; }
	}
	  
	  
	   @media only screen and (min-width: 480px) and (max-width: 767px) {

			.portfolio ul li							{  margin-bottom:20px !important;}
			.portfolio_filter >ul						{	margin-bottom:10px !important;}
			.portfolio_selector_wrap					{  margin-bottom:20px !important;}
			.portfolio_sort_wrap						{  float:left; margin-bottom:20px !important;}
			
			.sixteen .portfolio_navigation				{	margin-left:0px; margin-top:10px;}			
			.sixteen .portfolio_detail_info_holder		{	padding-left:0px; margin-top:20px;}						
			.sixteen .portfolio_imgholder				{	width:410px;}
			.sixteen .portfolio_detail_imgholder		{	width:410px !important;}
			
			.eleven .portfolio_navigation				{	margin-left:10px; margin-top:10px;}			
			.eleven .portfolio_detail_info_holder		{	padding-left:10px; margin-top:20px;}
			.eleven .portfolio_imgholder				{	width:410px;}
			.eleven .portfolio_detail_imgholder			{	width:410px !important;}
			.eleven .portfolio ul li					{	width:420px !important; }
			
	   }
	   
	   @media only screen and (min-width: 0px) and (max-width: 479px) {

			.portfolio ul li							{	margin-bottom:20px !important;}
			.portfolio_sort_wrap						{ 	float:left; margin-bottom:20px !important;}
			.portfolio_filter >ul						{	margin-bottom:10px !important;}
			
			.sixteen .portfolio_navigation				{	margin-left:0px; margin-top:10px;}			
			.sixteen .portfolio_detail_info_holder		{	padding-left:0px; margin-top:20px;}		
			.sixteen .portfolio_imgholder				{	width:290px;}
			.sixteen .portfolio_detail_imgholder		{	width:290px;}
			
			.eleven .portfolio_navigation				{	margin-left:10px; margin-top:10px;}			
			.eleven .portfolio_detail_info_holder		{	padding-left:10px; margin-top:20px;}
			.eleven .portfolio_imgholder				{	width:290px;}
			.eleven .portfolio_detail_imgholder			{	width:290px;}
			
			.portfolio_sotrer_form						{ width:100%; clear:both; margin-top:10px; margin-left:0px;}
	   }



	   
	   
	   
	   
	   
	
/*********************************
	-	COMMENT LISTS	-
**********************************/
.commentlist li					{ margin-bottom:30px;}
.commentlist li:last-child		{ margin-bottom:0px;}


.commentwrap			{ float:right; padding:20px;  position:relative; background:#f5f5f5; border:5px solid #fff;  
						  -webkit-box-shadow:  0px 0px 5px 0px rgba(0, 0, 0, 0.15);        -moz-box-shadow:  0px 0px 5px 0px rgba(0, 0, 0, 0.15);        box-shadow:  0px 0px 5px 0px rgba(0, 0, 0, 0.15);
						  overflow:visible;
						 }
.commentwrap p				{	margin-bottom:0px !important;}						
						 
.commentwrap .commentarrow		{	background:url(../images/tiles/commentarrow.png) no-repeat; width:16px; height:32px; position:absolute;top:28px; left:-20px;z-index:5;}									
						  
.commentwrap h5			{ color:#333; font-size:16px; <?php echo $main_google_font;?>  line-height:1;margin-bottom:5px !important;}
.commentwrap .timestamp { font-size:11px; color:#777; margin-bottom:10px; line-height:1; font-style:italic;}

.commentwrap .replylink a,
.commentwrap .replylink a:visited	{	color:<?php echo $highlight_color;?>; font-weight:bold; font-size:14px; <?php echo $main_google_font;?>text-shadow:1px 1px 0px #fff;
										-webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.3s ease-out; -ms-transition: all 1s ease-in-out;}



.commentwrap .replylink a:hover 	{	text-decoration: none;	cursor: pointer;color:#777;	 }


.sixteen .commentlist .depth-1	{	width:940px; float:right; }
.sixteen .commentlist .depth-2	{ 	width:910px;  float:right;}
.sixteen .commentlist .depth-3	{ 	width:880px;  float:right;  }
.sixteen .commentlist .depth-4	{ 	width:850px;  float:right; }
.sixteen .commentlist .depth-5	{ 	width:820px;  float:right; }

.sixteen .commentlist .depth-1 .commentwrap 	{ width:800px;}
.sixteen .commentlist .depth-2 .commentwrap 	{ width:770px;}
.sixteen .commentlist .depth-3 .commentwrap 	{ width:740px;}
.sixteen .commentlist .depth-4 .commentwrap 	{ width:710px;}
.sixteen .commentlist .depth-5 .commentwrap 	{ width:680px;}

.eleven .commentlist .depth-1	{	width:640px; float:right; }
.eleven .commentlist .depth-2	{ 	width:610px;  float:right;}
.eleven .commentlist .depth-3	{ 	width:580px;  float:right;  }
.eleven .commentlist .depth-4	{ 	width:550px;  float:right; }
.eleven .commentlist .depth-5	{ 	width:520px;  float:right; }

.eleven .commentlist .depth-1 .commentwrap 	{ width:500px;}
.eleven .commentlist .depth-2 .commentwrap 	{ width:470px;}
.eleven .commentlist .depth-3 .commentwrap 	{ width:440px;}
.eleven .commentlist .depth-4 .commentwrap 	{ width:410px;}
.eleven .commentlist .depth-5 .commentwrap 	{ width:380px;}


.posterpic				{ float:left; width:60px;height:60px;float:left; margin-top:20px; margin-right:20px;}
.posterpic img			{ width:100%;margin-bottom:-6px;}
.commentwrap .replylink { position:absolute; right:20px;top:-10px;}



	
	

	
	@media only screen and (min-width: 768px) and (max-width: 959px) {		
	
			.sixteen .commentlist .depth-1	{	width:750px; float:right; }
			.sixteen .commentlist .depth-2	{ 	width:720px;  float:right;}
			.sixteen .commentlist .depth-3	{ 	width:690px;  float:right;  }
			.sixteen .commentlist .depth-4	{ 	width:660px;  float:right; }
			.sixteen .commentlist .depth-5	{ 	width:630px;  float:right; }

			.sixteen .commentlist .depth-1 .commentwrap 	{ width:610px;}
			.sixteen .commentlist .depth-2 .commentwrap 	{ width:580px;}
			.sixteen .commentlist .depth-3 .commentwrap 	{ width:550px;}
			.sixteen .commentlist .depth-4 .commentwrap 	{ width:520px;}
			.sixteen .commentlist .depth-5 .commentwrap 	{ width:490px;}
			
			
			.eleven .commentlist .depth-1	{	width:510px; float:right;  }
			.eleven .commentlist .depth-2	{ 	width:480px;  float:right; }
			.eleven .commentlist .depth-3	{ 	width:450px;  float:right; }
			.eleven .commentlist .depth-4	{ 	width:420px;  float:right; }
			.eleven .commentlist .depth-5	{ 	width:390px;  float:right; }

			.eleven .commentlist .depth-1 .commentwrap 	{ width:370px;}
			.eleven .commentlist .depth-2 .commentwrap 	{ width:340px;}
			.eleven .commentlist .depth-3 .commentwrap 	{ width:310px;}
			.eleven .commentlist .depth-4 .commentwrap 	{ width:280px;}
			.eleven .commentlist .depth-5 .commentwrap 	{ width:250px;}
	}
  

  
   @media only screen and (min-width: 480px) and (max-width: 767px) {		
			
			
			
			.eleven .commentlist .depth-1, .sixteen .commentlist .depth-1	{	width:420px !important; float:right;  }
			.eleven .commentlist .depth-2, .sixteen .commentlist .depth-2	{ 	width:390px !important;  float:right; }
			.eleven .commentlist .depth-3, .sixteen .commentlist .depth-3	{ 	width:360px !important;  float:right; }
			.eleven .commentlist .depth-4, .sixteen .commentlist .depth-4	{ 	width:330px !important;  float:right; }
			.eleven .commentlist .depth-5, .sixteen .commentlist .depth-5	{ 	width:300px !important;  float:right; }

			.eleven .commentlist .depth-1 .commentwrap,
			.sixteen .commentlist .depth-1 .commentwrap			{ width:280px !important;}
			.eleven .commentlist .depth-2 .commentwrap,
			.sixteen .commentlist .depth-2 .commentwrap			{ width:250px !important;}			
			.eleven .commentlist .depth-3 .commentwrap,
			.sixteen .commentlist .depth-3 .commentwrap			{ width:220px !important;}
			.eleven .commentlist .depth-4 .commentwrap,
			.sixteen .commentlist .depth-4 .commentwrap			{ width:190px !important;}
			.eleven .commentlist .depth-5 .commentwrap,
			.sixteen .commentlist .depth-5 .commentwrap			{ width:160px !important;}
		

   }
   
   @media only screen and (min-width: 0px) and (max-width: 479px) {
			.posterpic	{display:none;}
			.commentwrap .commentarrow { display:none;}
		
			.eleven .commentlist .depth-1, .sixteen .commentlist .depth-1	{	width:300px; float:right;  }
			.eleven .commentlist .depth-2, .sixteen .commentlist .depth-2	{ 	width:270px;  float:right; }
			.eleven .commentlist .depth-3, .sixteen .commentlist .depth-3	{ 	width:240px;  float:right; }
			.eleven .commentlist .depth-4, .sixteen .commentlist .depth-4	{ 	width:210px;  float:right; }
			.eleven .commentlist .depth-5, .sixteen .commentlist .depth-5	{ 	width:180px;  float:right; }

			.eleven .commentlist .depth-1 .commentwrap,
			.sixteen .commentlist .depth-1 .commentwrap	 	{ width:250px;}
			.eleven .commentlist .depth-2 .commentwrap,
			.sixteen .commentlist .depth-2 .commentwrap 	{ width:220px;}
			.eleven .commentlist .depth-3 .commentwrap,
			.sixteen .commentlist .depth-3 .commentwrap	{ width:190px;}
			.eleven .commentlist .depth-4 .commentwrap,
			.sixteen .commentlist .depth-4 .commentwrap 	{ width:160px;}
			.eleven .commentlist .depth-5 .commentwrap,
			.sixteen .commentlist .depth-5 .commentwrap 	{ width:130px;}
	}

	
/***************************************
	-	WP CORE STYLES / SHORTCODES -	
****************************************/



	/* == WordPress WYSIWYG Editor Styles == */

	.entry-content img {
		margin: 0 0 1.5em 0;
		}
	.alignleft, img.alignleft {
		margin-right: 1.5em;
		display: inline;
		float: left;
		margin-top: 6px;
		}
	.alignright, img.alignright {
		margin-left: 1.5em;
		display: inline;
		float: right;
		margin-top: 6px;
		}
	.aligncenter, img.aligncenter {
		margin-right: auto;
		margin-left: auto;
		display: block;
		clear: both;
		}
	.alignnone, img.alignnone {
		/* not sure about this one */
		}
	.wp-caption {
		margin-bottom: 1.5em;
		text-align: center;
		padding-top: 5px;
		}
	.wp-caption img {
		border: 0 none;
		padding: 0;
		margin: 0;
		}
	.wp-caption p.wp-caption-text {
		line-height: 1.5;
		font-size: 10px;
		margin: 0;
		}
	.wp-smiley {
		margin: 0 !important;
		max-height: 1em;
		}
	blockquote.left {
		margin-right: 20px;
		text-align: right;
		margin-left: 0;
		width: 33%;
		float: left;
		}
	blockquote.right {
		margin-left: 20px;
		text-align: left;
		margin-right: 0;
		width: 33%;
		float: right;
		}
	.gallery dl {}
	.gallery dt {}
	.gallery dd {}
	.gallery dl a {}
	.gallery dl img {}
	.gallery-caption {}

	.size-full {}
	.size-large {}
	.size-medium {}
	.size-thumbnail {}

	.space5, .divide5 	{	height:5px;}
	.space10, .divide10	{	height:10px;}
	.space15, .divide15	{	height:15px;}
	.space20, .divide20	{	height:20px;}
	.space25, .divide25	{	height:25px;}
	.space30, .divide30	{	height:30px;}
	.space40, .divide40	{	height:40px;}
	.space40, .divide50	{	height:50px;}

	@media only screen and (min-width: 768px) and (max-width: 959px) {  
		
    }       
   
    @media only screen and (min-width: 480px) and (max-width: 767px) {  
			.space25, .divide25	{	height:20px;}
			.space30, .divide30	{	height:20px;}
			.space40, .divide40	{	height:20px;}
			.space40, .divide50	{	height:40px;}
    }   
   
	@media only screen and (min-width: 0px) and (max-width: 479px) {	
			.space25, .divide25	{	height:20px;}
			.space30, .divide30	{	height:20px;}
			.space40, .divide40	{	height:20px;}
			.space40, .divide50	{	height:40px;}
	}

	
	
	.r5		{	margin-right:5px; }
	.r10	{	margin-right:10px; }
	.r15	{	margin-right:15px; }
	.r20	{	margin-right:20px; }
	
	.l5		{	margin-left:5px; }
	.l10	{	margin-left:10px; }
	.l15	{	margin-left:15px; }
	.l20	{	margin-left:20px; }
	
	.nspace0	{	margin-bottom:0px;}			/** DIRK NOCH HIER **/
	.nspace5	{	margin-bottom:-5px;}
	.nspace10	{	margin-bottom:-10px;}
	.nspace15	{	margin-bottom:-15px;}
	.nspace20	{	margin-bottom:-20px;}
	.nspace25	{	margin-bottom:-25px;}
	.nspace30	{	margin-bottom:-30px;}
	.nspace35	{	margin-bottom:-35px;}
	.nspace40	{	margin-bottom:-40px;}

.alignnone 						{    margin: 5px 20px 20px 0;}

.aligncenter, div.aligncenter 	{    display:block;    margin: 5px auto 5px auto;}

.wp-caption 					{    background: #fff;    border: 1px solid #f0f0f0;    max-width: 96%; /* Image does not overflow the content area */    padding: 5px 3px 10px;    text-align: center;}

.wp-caption.alignnone 			{    margin: 5px 20px 20px 0;	}

.wp-caption.alignleft 			{    margin: 5px 15px 10px 0;	}

.wp-caption.alignright 			{    margin: 5px 0 20px 20px;	}

.wp-caption img 				{    border: 0 none;    height: auto;    margin:0;    max-width: 98.5%;    padding:0;    width: auto;}

.wp-caption p.wp-caption-text 	{    font-size:11px;    line-height:17px;    margin:0;    padding:0 4px 5px;	}

img.size-auto,
img.size-large,
img.size-full,
img.size-medium 				{	max-width: 100%;	height: auto;}

.alignleft,
img.alignleft 					{	display: inline;	float: left;	margin-right: 20px;	margin-top: 6px;}

.alignright,
img.alignright 					{	display: inline;	float: right;	margin-left: 20px;	margin-top: 6px;}

.aligncenter,
img.aligncenter 				{	clear: both;	display: block;	margin-left: auto;	margin-right: auto;}

img.alignleft,
img.alignright,
img.aligncenter 				{	margin-bottom: 10px;}

.bordered 						{	padding:5px; background:#fff; border:1px solid #e5e5e5;   
							   -webkit-box-shadow:  0px 0px 5px 0px rgba(0, 0, 0, 0.15);        -moz-box-shadow:  0px 0px 5px 0px rgba(0, 0, 0, 0.15);        box-shadow:  0px 0px 5px 0px rgba(0, 0, 0, 0.15);}

.hover-img div.bordered			{ padding: 0; border: none; -webkit-box-shadow: none; -moz-box-shadow: none; box-shadow: none; }
.hover-img div.rounded			{ border-radius: 0px; }

.bypostauthor {}
.sticky{}
.gallery-caption{}


.short-pdf						{	min-width:43px; height:43px; background:url(../images/icons/pdf.png) no-repeat; color:<?php echo $highlight_color;?>; font-size:12px; padding-left:53px; font-style:italic;}


/*******************************
	-	SIDEBAR  -	
********************************/
.sidebar.leftfloat {
	/* JAS */
	overflow:hidden;
	/* background-color: aqua; */
	}



/******************************
	-	BUTTONS	-
*******************************/


.purchase 			{						
						color:#fff; text-shadow:0px 1px 1px rgba(0, 0, 0, 0.6); padding:9px 20px; 
						font-family: 'PT Sans Narrow', sans-serif;
						font-size:17px;  line-height:40px; font-weight:bold;
						background:url(../images/other/gradient/g40.png) repeat-x top;
						border-radius: 3px; -moz-border-radius: 3px; -webkit-border-radius: 3px;
					}

.purchase span 		{	color:#fff !important;padding-left:40px; padding-right:10px; white-space:nowrap;background-repeat:no-repeat; background-position:10px 1px;}
.purchase a:visited, 
.purchase a			{	color:#fff !important;}


.purchase span:hover,
.purchase a:hover span,
.purchase a:hover {   color:#fff !important;}

.button				{	padding:4px 12px;
						border-radius: 4px;
						-moz-border-radius: 4px;
						-webkit-border-radius: 4px;
						/* height:37px; */
						cursor:pointer;
						/* white-space: nowrap; */
						/* border:2px solid rgba(162,162,162,0.6) */;
						color:#fff !important;
						text-shadow:0px 1px 1px rgba(0, 0, 0, 0.6);
						font-size:17px;
						/* line-height:45px !important; */
						background:url(../images/other/gradient/g30.png) repeat-x top;
						font-family: 'PT Sans Narrow', sans-serif;
						font-weight: normal;
						/* text-transform: uppercase; */
						display: inline-block;
						margin-bottom: 15px;
					}
					
.button.big			{	color:#fff; text-shadow:0px 1px 1px rgba(0, 0, 0, 0.6); font-weight:bold; padding:9px 20px; font-size:19px;  line-height:57px !important; background:url(../images/other/gradient/g40.png) repeat-x top;}				

						
.purchase:hover,
.button:hover,
.button.big:hover		{	background-position:bottom , 15px 11px;}
					
.button.tiny, input.tiny[type="submit"], button.tiny {
    padding: 2px 5px;
    height: auto;
}


/*	BUTTON COLORS	*/					



.button.green, .button:hover.green,
.purchase.green, .purchase:hover.green	{
	background-color:#21a117;
	-webkit-box-shadow: 2px 2px 1px 0px #104d0b;
	-moz-box-shadow: 0px 3px 0px 0px #104d0b;
	box-shadow:   0px 3px 0px 0px #104d0b;
	}

.button.blue, .button:hover.blue,
.purchase.blue, .purchase:hover.blue {
	background-color:#1d78cb;
	-webkit-box-shadow: 2px 2px 1px 0px #0f3e68;
	-moz-box-shadow: 2px 2px 1px 0px #0f3e68;
	box-shadow: 2px 2px 1px 0px #0f3e68;
	}

.button.yellow, .button:hover.yellow,
.purchase.yellow, .purchase:hover.yellow {
	background-color:#fc0;
	-webkit-box-shadow: 2px 2px 1px 0px #352a00;
	-moz-box-shadow: 2px 2px 1px 0px #352a00;
	box-shadow: 2px 2px 1px 0px #352a00;
	}

.button.red, .button:hover.red,
.purchase.red, .purchase:hover.red {
	background-color:#cb1d1d;
	-webkit-box-shadow: 2px 2px 1px 0px #7c1212;
	-moz-box-shadow: 0px 3px 0px 0px #7c1212;
	box-shadow: 0px 3px 0px 0px #7c1212;
	}

.button.orange, .button:hover.orange,
.purchase.orange, .purchase:hover.orange {
	background-color:#ff7700;
	-webkit-box-shadow: 2px 2px 1px 0px #a34c00;
	-moz-box-shadow: 0px 3px 0px 0px #a34c00;
	box-shadow: 0px 3px 0px 0px #a34c00;
	}

.button.darkgrey,.button.grey,
.button:hover.darkgrey,.button:hover.grey,
.purchase.darkgrey, .purchase:hover.darkgrey {
	background-color:#555;
	-webkit-box-shadow: 2px 2px 1px 0px #222;
	-moz-box-shadow: 0px 3px 0px 0px #222;
	box-shadow: 0px 3px 0px 0px #222;
	}

.button.lightgrey, .button:hover.lightgrey,
.purchase.lightgrey, .purchase:hover.lightgrey {
	background-color:#888;
	-webkit-box-shadow: 2px 2px 1px 0px #555;
	-moz-box-shadow: 0px 3px 0px 0px #555;
	box-shadow: 0px 3px 0px 0px #555;
	}

.button.disabled, .button.disabled:hover {
    background-color: #CCCCCC;
    border: 1px solid #999999 !important;
    cursor: default;
    text-shadow: none;
}

 @media only screen and (min-width: 768px) and (max-width: 959px) {  
			
   }       
   
   @media only screen and (min-width: 480px) and (max-width: 767px) {  
		
   }   
   
   @media only screen and (min-width: 0px) and (max-width: 479px) {	
	
   }



/******************************
	-	INPUTBOX	-
*******************************/
#search								{	float:left; margin-top:0px;  margin-left:20px;}
#search .InputBox					{	width:180px;float:left; border:1px solid #ccc; background-color:#fff; padding:6px 8px 6px 8px; color:#777; font-size:13px; line-height:1;  font-family: Arial, sans-serif; border-radius:6px;}	
#search .Button						{	float:left; position:relative; margin-left:-28px; background:url(../images/search.png) no-repeat top ;width:15px;height:16px;border:none;margin-top:7px;}
#search .Button:hover				{	cursor:pointer; background-position:bottom;}

  @media only screen and (min-width: 768px) and (max-width: 959px) {  
		
   }       
   
   @media only screen and (min-width: 480px) and (max-width: 767px) {  
	#search	{	 margin-left:0px; margin-top:20px;}
   }   
   
   @media only screen and (min-width: 0px) and (max-width: 479px) {	
	#search	{	float:left; margin-left:2px !important; margin-top:20px;}
	#search .InputBox	{	width:278px !important;}
   }

   


#commentfields .InputBox,
#commentfields .TextBox, #contactus .InputBox, #contactus .TextBox							{	margin-top:10px; float:left;  border:1px solid #ccc; background-color:#fff; padding:7px 10px; color:#777; font-size:13px; line-height:20px;  font-family: Arial, sans-serif;}	
		


.sixteen #commentfields .InputBox,.sixteen #contactus .InputBox						{ 	float:left;width:284px;margin-right:10px;	}
.eleven #commentfields .InputBox,.eleven #contactus .InputBox						{ 	float:left;width:184px;margin-right:10px;	}


.sixteen #commentfields .TextBox,.sixteen #contactus .TextBox						{ 	width: 916px; margin-bottom:15px;	}
.eleven #commentfields .TextBox,.eleven #contactus .TextBox							{ 	width: 616px; margin-bottom:15px;	}
#commentfields .InputBox.last,#contactus .InputBox.last								{	margin-right:0;}

textarea#quickcontact_message,.TextBox	{	resize:vertical;	}

 @media only screen and (min-width: 768px) and (max-width: 959px) {
		
		.sixteen #commentfields .InputBox,.sixteen #contactus .InputBox		{ float:left;width:220px;margin-right:10px;}
		.eleven #commentfields .InputBox,.eleven #contactus .InputBox		{ float:left;width:140px;margin-right:10px;}
		
		.sixteen #commentfields .TextBox,.sixteen #contactus .TextBox		{ width:724px; resize:vertical;}
		.eleven #commentfields .TextBox,.eleven #contactus .TextBox			{ width:484px; resize:vertical;}
		
		#commentfields .InputBox.last,#contactus .InputBox.last			{ margin-right:0;}
		#search .InputBox						{ width:156px;}
		
  }
  
   @media only screen and (min-width: 480px) and (max-width: 767px) {
		
		.sixteen #commentfields .InputBox,.sixteen #contactus .InputBox	{ float:none;width:398px;margin-right:0;}
		.eleven #commentfields .InputBox,.eleven #contactus .InputBox	{ float:none;width:398px;margin-right:0;}
		
		.sixteen #commentfields .TextBox, .sixteen #contactus .TextBox,
		.eleven #commentfields .TextBox, .eleven #contactus .TextBox, 
		#search .InputBox			{ width:398px; resize:vertical;}
				
		
   }
   
   @media only screen and (min-width: 0px) and (max-width: 479px) {
		.sixteen #commentfields .InputBox,.sixteen #contactus .InputBox,
		.eleven #commentfields .InputBox,.eleven #contactus .InputBox   { float:none;width:277px !important;margin-right:0;}
		
		.sixteen #commentfields .TextBox, .sixteen #contactus .TextBox, 
		.eleven #commentfields .TextBox, .eleven #contactus .TextBox, 
		#search .InputBox					{ width:277px;}
	}



/*********************************
	-	BLOG	-
**********************************/


.blog_subinfos_divider		{	margin:0px 3px 0 5px;border-left: 1px solid #ccc;height:14px;padding-bottom: 0px;padding-top:0px;}



.tp_blog_imgholder			{	padding:5px; background:#fff; border:1px solid #e5e5e5;  width:330px !important; 
							   -webkit-box-shadow:  0px 0px 5px 0px rgba(0, 0, 0, 0.15);        -moz-box-shadow:  0px 0px 5px 0px rgba(0, 0, 0, 0.15);        box-shadow:  0px 0px 5px 0px rgba(0, 0, 0, 0.15);}							   						   

.sixteen .tp_blog_imgholder		{	width:930px !important; margin-bottom:20px;}							   
.eleven .tp_blog_imgholder		{	width:630px !important; margin-bottom:20px;}
.eight  .tp_blog_imgholder		{	width:440px !important; margin-bottom:0px;}
.six .tp_blog_imgholder			{	width:330px !important; margin-bottom:0px;}

							   
							   
.tp_blog_imgholder img 		{	margin-bottom:-5px; width:100% }



@media only screen and (min-width: 768px) and (max-width: 959px) {
			
			.sixteen .tp_blog_imgholder		{	width:738px !important; }			
			.eleven .tp_blog_imgholder		{	width:500px !important; }
			.eight  .tp_blog_imgholder		{	width:350px !important; }
			.six .tp_blog_imgholder			{  width:250px !important;}
			
	}
  
    @media only screen and (min-width: 480px) and (max-width: 767px) {
			
			.sixteen .tp_blog_imgholder		{	width:408px !important; }
			.eleven .tp_blog_imgholder		{	width:410px !important; }
			.eight  .tp_blog_imgholder		{	width:408px !important; margin-bottom:20px;}
			.six .tp_blog_imgholder		{  width:410px !important; margin-bottom:20px;}	
			
    }
   
   @media only screen and (min-width: 0px) and (max-width: 479px) {
			
			.sixteen .tp_blog_imgholder		{	width:290px !important; }
			.eleven .tp_blog_imgholder		{	width:290px !important; }
			.eight  .tp_blog_imgholder		{	width:288px !important; margin-bottom:20px;}
			.six .tp_blog_imgholder		{  width:290px !important; margin-bottom:20px;}			
			
	}


	
	
/*****************************************
	-	RESPONSIVE VIDEO CONTAINER	-
******************************************/

.eleven .video-container {		position: relative;		padding-bottom: 56.25%;		padding-top: 10px;	height: 0;	overflow: hidden;}
.sixteen .video-container {		position: relative;		padding-bottom: 56.25%;		padding-top: 10px;	height: 0;	overflow: hidden;}


.eleven .video-wrapper {	width: 630px;		max-width: 100%;	}
.sixteen .video-wrapper {	width: 930px;		max-width: 100%;	}

.video-container iframe,  
.video-container object,  
.video-container embed {	position: absolute;	top: 0;	left: 0;	width: 100%;	height: 100%;}	

.sixteen .html5video { width:930px; height:523px}
.eight .html5video {width: 440px; height:269px;}
.sixteen .html5audio { width:930px; height:auto;}

.eleven .html5video { width:330px; height:207px}
.eleven .html5audio { width:330px; height:auto;}

.scalevid {margin-bottom:20px;}

	@media only screen and (min-width: 768px) and (max-width: 959px) {
			.sixteen .html5video { width:735px; height:413px}
			.eight .html5video 	{width: 350px; height:206px;}
			.sixteen .html5audio { width:740px;}
			
			.eleven .html5video { width:252px; height:162px}
			.eleven .html5audio { width:252px;}
			
			
	  }
  
   @media only screen and (min-width: 480px) and (max-width: 767px) {
			.sixteen .html5video { width:410px; height:230px}
			.sixteen .html5audio { width:410px; }
			
			.eleven .html5video { width:410px; height:230px}
			.eleven .html5audio { width:410px; }
			
   }
   
   @media only screen and (min-width: 0px) and (max-width: 479px) {
			.sixteen .html5video { width:290px; height:163px}
			.sixteen .html5audio { width:290px; }
			
			.eleven .html5video { width:290px; height:163px}
			.eleven .html5audio { width:290px; }
			
	}

audio,.mejs-container, .mejs-audio {width:100% !important; max-width:100%;}


/*************************************/
/*		TEASER             			*/
/*************************************/


.tp_teaser_rotator 			{	width:946px; margin-left:-4px; overflow:hidden; }
.tp_teaser p		{	margin:0px !important;}
.eleven .tp_teaser_rotator	{	width:643px;}


.tp_teaser_rotator ul		{   width:5000px; margin-left:4px; position:relative; }
.tp_teaser_rotator ul li	{	float:left; width:220px; margin-right:20px;}
.eleven .tp_teaser_rotator ul li	{	float:left; width:142px; }


.tp_teaser_imgholder		{	padding:4px; background:#fff; border:1px solid #e5e5e5; margin-bottom:17px; width:210px; 
							   -webkit-box-shadow:  0px 0px 5px 0px rgba(0, 0, 0, 0.15);        -moz-box-shadow:  0px 0px 5px 0px rgba(0, 0, 0, 0.15);        box-shadow:  0px 0px 5px 0px rgba(0, 0, 0, 0.15);}
.eleven .tp_teaser_imgholder { width:142px;}

 							   
.tp_teaser_imgholder img 	{	margin-bottom:-4px; width:100%}


.tp_teaser_navigation		{	margin-top:-30px;}
.tp_teaser_right			{	float:left;  background:URL(../images/tiles/small_right.png) no-repeat 7px 5px; background-color:#ababab; width:20px; height:20px;
							-webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.8s ease-out; -ms-transition: all 0.3s ease-in-out;
							cursor:pointer;
							}
.tp_teaser_left			{	float:left;  background:URL(../images/tiles/small_left.png) no-repeat 6px 5px; background-color:#ababab; width:20px; height:20px;margin-right:2px;
							-webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.8s ease-out; -ms-transition: all 0.3s ease-in-out;
							cursor:pointer;
						}
						
.tp_teaser_right:hover, .tp_teaser_left:hover	{	background-color:#cfcfcf;}
.tp_teaser_right.notinuse, .tp_teaser_left.notinuse	{	background-color:#e5e5e5; cursor:default;}

	

	@media only screen and (min-width: 768px) and (max-width: 959px) {
			.tp_teaser_imgholder		{  width:165px;}
			.tp_teaser_rotator ul li	{  width:175px; margin-right:15px;}
			.tp_teaser_rotator			{	width:754px;}

			.eleven .tp_teaser_rotator 				{	width:510px; margin-left:-4px; overflow:hidden; }
			.eleven .tp_teaser_rotator ul li		{	float:left; width:152px; margin-right:20px;}
			.eleven .tp_teaser_imgholder			{	float:left; margin-right:10px;  width:152px; margin-bottom:17px;}
			
			

	}
  
    @media only screen and (min-width: 480px) and (max-width: 767px) {
			.tp_teaser_imgholder		{  width:190px;}
			.tp_teaser_rotator ul li	{  width:200px; margin-right:20px;}
			.tp_teaser_rotator			{	width:428px; }
			
			
			.eleven .tp_teaser_imgholder		{  width:190px; margin-bottom:17px;}
			.eleven .tp_teaser_rotator ul li	{  width:200px; margin-right:20px;}
			.eleven .tp_teaser_rotator			{	width:428px; }
			
    }
   
   @media only screen and (min-width: 0px) and (max-width: 479px) {
			.tp_teaser_imgholder		{  width:290px;}
			.tp_teaser_rotator ul li	{  width:300px; margin-right:20px;}
			.tp_teaser_rotator			{  width:307px; }
			
			
			.eleven .tp_teaser_imgholder		{  width:290px; margin-bottom:17px;}
			.eleven .tp_teaser_rotator ul li	{  width:300px; margin-right:20px;}
			.eleven .tp_teaser_rotator			{  width:307px; margin-bottom:17px;}
			
	}

		
/***************************************
	-	TWO_PER_PAGE TEASERS	-	
***************************************/

.sixteen .two_per_page .tp_teaser_rotator 			{	width:946px; margin-left:-4px; overflow:hidden; }
.eleven .two_per_page .tp_teaser_rotator 			{	width:644px; margin-left:-4px; overflow:hidden; }

.sixteen .two_per_page .tp_teaser_rotator ul li		{	float:left; width:460px; margin-right:20px;}
.eleven .two_per_page .tp_teaser_rotator ul li		{	float:left; width:310px; margin-right:20px; }

.sixteen .two_per_page .tp_teaser_imgholder			{	float:left; margin-right:20px;  width:230px; margin-bottom:17px;}
.eleven .two_per_page .tp_teaser_imgholder			{	float:left; margin-right:20px;  width:110px; margin-bottom:17px;}
.eleven .two_per_page .blog_subinfos				{	margin-bottom:9px !important; font-family:Arial; font-size:11px;}
.eleven .two_per_page .teaser_topline,
.eleven .two_per_page .teaser_topline a,
.eleven .two_per_page .teaser_topline a:visited		{	font-size:15px !important; margin-bottom:9px !important;}

.sixteen .two_per_page .tp_teaser_contentholder		{	float:left; width:200px;	}
.eleven .two_per_page .tp_teaser_contentholder		{ 	width:290px;	}
	

	@media only screen and (min-width: 768px) and (max-width: 959px) {
			
			
			.sixteen .two_per_page .tp_teaser_imgholder		{  width:345px; margin-bottom:17px;}									
			.eleven .two_per_page .tp_teaser_imgholder		{  width:235px; margin-bottom:17px;}
			
			.sixteen .two_per_page .tp_teaser_rotator ul li	{  width:370px; }
			.eleven .two_per_page .tp_teaser_rotator ul li	{  width:239px; }
			
			.sixteen .two_per_page .tp_teaser_rotator		{	width:760px; }
			.eleven .two_per_page .tp_teaser_rotator		{	width:510px; }
			
			.sixteen .two_per_page .tp_teaser_contentholder		{  width:370px; }
			.eleven .two_per_page .tp_teaser_contentholder		{ clear:both; width:235px;margin-top:0px;}

	}
  
    @media only screen and (min-width: 480px) and (max-width: 767px) {
			.sixteen .two_per_page .tp_teaser_imgholder		{  width:190px; margin-bottom:17px;}
			.sixteen .two_per_page .tp_teaser_rotator ul li	{  width:200px; margin-right:20px;}
			.sixteen .two_per_page .tp_teaser_rotator		{	width:428px; }
			
			
			.eleven .two_per_page .tp_teaser_imgholder		{  width:190px; margin-bottom:17px;}
			.eleven .two_per_page .tp_teaser_rotator ul li	{  width:200px; margin-right:20px;}
			.eleven .two_per_page .tp_teaser_rotator		{	width:428px; }
			
			
			.eleven .two_per_page .tp_teaser_contentholder		{ clear:both; width:200px;}
    }
   
   @media only screen and (min-width: 0px) and (max-width: 479px) {   
			.sixteen .two_per_page .tp_teaser_imgholder		{  width:290px; margin-bottom:17px;}
			.sixteen .two_per_page .tp_teaser_rotator ul li	{  width:300px; margin-right:20px;}
			.sixteen .two_per_page .tp_teaser_rotator		{  width:307px; }
			
			
			.eleven .two_per_page .tp_teaser_imgholder		{  width:290px; margin-bottom:17px;}
			.eleven .two_per_page .tp_teaser_rotator ul li	{  width:300px; margin-right:20px;}
			.eleven .two_per_page .tp_teaser_rotator		{  width:307px; }
			
			.sixteen .two_per_page .tp_teaser_contentholder		{  width:300px; }
			.eleven .two_per_page .tp_teaser_contentholder		{ clear:both; width:300px;}
	}

/***************************************
	-	THREE_PER_PAGE TEASERS	-	
***************************************/

.sixteen .three_per_page .tp_teaser_rotator 			{	width:946px; margin-left:-4px; overflow:hidden; }
.eleven .three_per_page .tp_teaser_rotator 				{	width:643px; margin-left:-4px; overflow:hidden; }

.sixteen .three_per_page .tp_teaser_rotator ul li		{	float:left; width:300px; margin-right:20px;}
.eleven .three_per_page .tp_teaser_rotator ul li		{	float:left; width:196px; margin-right:20px;}

.sixteen .three_per_page .tp_teaser_imgholder			{	width:290px; margin-bottom:17px;}
.eleven .three_per_page .tp_teaser_imgholder			{	float:left; margin-right:10px;  width:196px; margin-bottom:17px;}

.sixteen .three_per_page .teaser_topline				{	clear:both;} 

	@media only screen and (min-width: 768px) and (max-width: 959px) {
			.sixteen .three_per_page .tp_teaser_imgholder			{ width:232px !important;}
			
			.sixteen .three_per_page .tp_teaser_imgholder		{  width:232px; margin-bottom:17px;}									
			.eleven .three_per_page .tp_teaser_imgholder		{  width:235px; margin-bottom:17px;}
			
			.sixteen .three_per_page .tp_teaser_rotator ul li	{  width:232px; }
			.eleven .three_per_page .tp_teaser_rotator ul li	{  width:240px; }
			
			.sixteen .three_per_page .tp_teaser_rotator		{	width:760px; }
			.eleven .three_per_page .tp_teaser_rotator		{	width:510px; }
			

	}
  
    @media only screen and (min-width: 480px) and (max-width: 767px) {
			.sixteen .three_per_page .tp_teaser_imgholder		{  width:123px; margin-bottom:17px;}
			.sixteen .three_per_page .tp_teaser_rotator ul li	{  width:123px; margin-right:20px;}
			.sixteen .three_per_page .tp_teaser_rotator			{	width:428px; }
			
			
			.eleven .three_per_page .tp_teaser_imgholder		{  width:190px; margin-bottom:17px;}
			.eleven .three_per_page .tp_teaser_rotator ul li	{  width:200px; margin-right:20px;}
			.eleven .three_per_page .tp_teaser_rotator			{	width:428px; }
			
    }
   
   @media only screen and (min-width: 0px) and (max-width: 479px) {   
			.sixteen .three_per_page .tp_teaser_imgholder		{  width:290px; margin-bottom:17px;}
			.sixteen .three_per_page .tp_teaser_rotator ul li	{  width:300px; margin-right:20px;}
			.sixteen .three_per_page .tp_teaser_rotator			{  width:307px; }
			
			
			
			.eleven .three_per_page .tp_teaser_imgholder		{  width:290px; margin-bottom:17px;}
			.eleven .three_per_page .tp_teaser_rotator ul li	{  width:300px; margin-right:20px;}
			.eleven .three_per_page .tp_teaser_rotator			{  width:307px; }
			
	}
	
	
/********************************
	-	FOOTER	-
*********************************/

#footer .widget_title										{   color:#fff; border-bottom:1px solid #666; text-shadow:none; margin-bottom:25px !important; }

#footer  a		{	text-decoration: none; color:<?php echo $highlight_color;?>;}
#footer  a:hover {	color:#777; }

#footer .sitemap											{	color:#ccc;}									
#footer .accordion.sitemap .accordion-item .toggletitle		{	border-bottom:1px solid #464646;	 }
#footer .accordion .togglecontent							{	border-bottom:1px solid #464646; padding-bottom:5px; margin-bottom:5px; }
#footer	.accordion.sitemap .accordion_down					{	background-color:#464646; }
#footer .accordion.sitemap .accordion_down:hover			{	background-color:#373737;}		
#footer .accordion.sitemap p								{	color:#ccc;}					
#footer .accordion.sitemap a, #footer .accordion.sitemap a:visited	{	color:#ccc;}	
#footer .accordion.sitemap a:hover							{	color:<?php echo $highlight_color;?>;}	
.footerspacer:last-child	{	height:0px !important;}


		   
		  
		   @media only screen and (min-width: 480px) and (max-width: 767px) {
				.footerspacer	{	clear:both; height:40px !important;}
				.footerspacer:last-child	{	height:0px !important;}
				
		   }
		   
		   @media only screen and (min-width: 0px) and (max-width: 479px) {
				.footerspacer	{	clear:both; height:40px !important;}
				.footerspacer:last-child	{	height:0px !important;}
			}	
			

.subfootertext				{	font-family:Arial; font-size:11px; color:#999; }
.subfootertext a, .subfootertext a:visited			{	color:#fff; -webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.8s ease-out; -ms-transition: all 0.3s ease-in-out;}
.subfootertext a:hover		{	color:#fc0;}
					
/***************************
	-	WIDGETS	-
***************************/	

.widget_title				{   color:#000; <?php echo $main_google_font;?> 	
								font-weight: normal; font-size: 18px; padding-bottom:5px; margin-bottom:20px;}

		/********************
			-	SITEMAP	-
		********************/

			
/*
			.accordion .accordion-item				{   width:175px;  position:relative;}

			.accordion .accordion-item .toggletitle	{	 margin-top:0px; font-size:12px;  padding-bottom:5px;  margin-bottom:5px; border-bottom:1px solid #ddd;}
			.accordion li:last-child .toggletitle	{	border-bottom:none;}
			.accordion .accordion_down				{	position:absolute; right:0px; top:4px;  background:URL(../images/tiles/small_down.png) no-repeat 6px 7px; background-color:#777; width:20px; height:20px;
																-webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.8s ease-out; -ms-transition: all 0.3s ease-in-out;
																cursor:pointer; }
																
																
			.accordion .togglecontent				{	border-bottom:1px solid #ddd; padding-bottom:5px; margin-bottom:5px; }
			.accordion .accordion_down:hover		{	background-color:#373737;}		

			.accordion								{	color:#777;}
			.accordion p							{	font-size:12px; color:#777;}					
			.accordion a, .accordion a:visited		{	font-size:12px; color:<?php echo $highlight_color;?>; -webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.8s ease-out; -ms-transition: all 0.3s ease-in-out;}					
			.accordion a:hover						{	color:#777;}
*/
			.accordionopen							{	cursor:pointer;}			
			
			.sitemap .togglecontent { font-size: 12px; color: #AAA; margin-left: 10px;}
		
		/********************************
			-	TESTIMONIALS	-
		*********************************/

		.tp_testimonials									{	width:100%; overflow:hidden;}
		.tp_testimonials ul 								{	position:relative; width:3000px;height:300px;}
		.tp_testimonials >ul >li							{	position:absolute; top:0px; left:0px;}
		.tp_testimonials ul li .author						{	color:#ccc; margin-top:20px; font-size:12px;}
		.tp_testimonials ul li p							{   color:#888; font-style:italic; }

		.tp_testimonials_navigation		{	margin-top:-22px; }
		.tp_testimonials_right			{	position:relative; z-index:2;float:left;  background:URL(../images/tiles/small_right.png) no-repeat 7px 5px; background-color:#464646; width:20px; height:20px;
											-webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.8s ease-out; -ms-transition: all 0.3s ease-in-out;
											cursor:pointer;
										}
		.tp_testimonials_left			{	position:relative; z-index:2;float:left;  background:URL(../images/tiles/small_left.png) no-repeat 6px 5px; background-color:#464646; width:20px; height:20px;margin-right:2px;
											-webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.8s ease-out; -ms-transition: all 0.3s ease-in-out;
											cursor:pointer;
										}
								
		.tp_testimonials_right:hover, .tp_testimonials_left:hover		{	background-color:#373737;}


		/********************************
			-	SUBMIT FIELDS	-
		*********************************/
		
		.inputbox					{	line-height:20px;font-family:Arial !important; font-size:12px; width:198px; background:#3e3e3e; border:1px solid #666; padding:7px 10px; color:#666; margin-bottom:7px; color:#999; 
											-webkit-transition: border 0.3s, color 0.3s ease-out; -moz-transition: border 0.3s, color 0.3s ease-out; -o-transition: border 0.3s, color 0.3s ease-out; -ms-transition: border 0.3s, color 0.3s ease-in-out;
											resize:vertical;
										}
		.inputbox:focus, .inputbox:hover				{	border:1px solid #fff; color:#fff;}
		
		.submitbutton				{	cursor:pointer; color:#fff; padding:5px 10px; font-size:14px; background:#777; border:none;  <?php echo $main_google_font;?> font-weight: normal;
										-webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.8s ease-out; -ms-transition: all 0.3s ease-in-out;
									}
        .submitbutton a, .submitbutton a:visited	{	color:#fff;}
		
		#footer .submitbutton		{	background:#222; color:#ccc;}
		
		
		.submitbutton:hover			{	background:#3e3e3e; color:#fff}
		#footer .submitbutton:hover	{	background:#3e3e3e; color:#fff}	
			

		.sidebar .inputbox					{	font-family:Arial !important; font-size:12px; width:200px; background:#fff; border:1px solid #ccc; padding:7px 10px; color:#ccc; margin-bottom:10px; color:#999; 
											-webkit-transition: border 0.3s, color 0.3s ease-out; -moz-transition: border 0.3s, color 0.3s ease-out; -o-transition: border 0.3s, color 0.3s ease-out; -ms-transition: border 0.3s, color 0.3s ease-in-out;
											resize:vertical;
										}
		.sidebar .inputbox:focus, .sidebar .inputbox:hover				{	border:1px solid #666; color:#777;}
		
		 @media only screen and (min-width: 768px) and (max-width: 959px) {		
				#footer .inputbox	{	width:150px; font-size:12px;}
		   }
		  
		   @media only screen and (min-width: 480px) and (max-width: 767px) {
				#footer .inputbox	{	width:398px; }
		   }
		   
		   @media only screen and (min-width: 0px) and (max-width: 479px) {
				#footer .inputbox	{	width:278px; }
		   }

					
							
/*******************************
	-	TWITTER   -
********************************/
.twitter_reader_list 		{	overflow:auto; color:#ccc; font-size:12px;}
.sidebar .twitter_reader_list 		{	color:#777; }

.twitter_reader_quote		{	display:none; }

.twitter_reader_list li 	{	list-style-type:none;	text-align: left;	margin-bottom: 25px;		padding-left: 0px;}

/* Last LI element in column has no dividing line build by border-bottom */
.twitter_reader_list li:last-child { margin-bottom:0px;}

.twitter_reader_list li a		{	text-decoration: none; color:<?php echo $highlight_color;?>; font-size:12px;}
.twitter_reader_list li a:hover {	color:#777; }


.twitter_reader_list span	{	color:#666; font-size:11px	}
.sidebar .twitter_reader_list span	{	color:#000; font-size:11px	}


ul.averis_archive li  {	width: 175px; margin-top:0px; font-size:12px;  padding-bottom:5px;  margin-bottom:5px; border-bottom:1px solid #ddd;}
ul.averis_archive li:last-child	{	border-bottom:none;}

.widget .tp_imgholder			{	padding:5px; background:#fff; border:1px solid #e5e5e5; -webkit-box-shadow:  0px 0px 5px 0px rgba(0, 0, 0, 0.15); margin-bottom: 5px; float: left;margin-right: 5px;}


/******************************
	-	MISC WIDGETS	-	
*******************************/

/*.sidebar .blogcategories a, .sidebar .blogcategories a:visited, .sidebar .sitemap a, .sidebar .sitemap a:visited, .widget .blogposts a , .averis_archive li a , .widget .blogposts a:visited,.averis_archive li a:visited  {	color: #777;-webkit-transition: all 0.3s ease-out;-moz-transition: all 0.3s ease-out;-o-transition: all 0.3s ease-out;-ms-transition: all 1s ease-in-out;}
.sidebar .blogcategories a:hover,.sidebar .sitemap a:hover,.widget .blogposts a:hover, .widget .averis_archive a:hover 	{	color:<?php echo $highlight_color;?>;}
*/

.widget .blogposts				 		{	margin-top:10px;}
.widget .blogpost:first-child			{	margin-top:0px;}

.sidebar .blogposts .blogdetail p		{	line-height:12px; margin:0 0 10px 0 !important;}

.widget.last .divide50 {height:0;}

.blog_miniimagewrap { margin-right:10px;}

.minigallery .tp_imgholder { width:93px;}

.minigal .krikiflickr img{	width:50px; height:50px; margin-bottom:-5px;	}
.minigal .krikiflickr	{	float:left; margin-right:5px;margin-bottom:5px;width:50px; height:50px;	overflow:hidden;}
/******************************
	-	BANNER	-	
*******************************/



/*	-	THE BANNER CONTAINER (Padding, Shadow, Border etc. )	-	*/
.bannercontainer{
	width:1020px;
	margin-top:0px;
	margin-left:-40px;
	position:relative;	
	
}

.tp_blog_imgholder .bannercontainer,.portfolio_detail_imgholder .bannercontainer{
	width:100%;
	margin-top:0px;
	margin-left:0px;
	position:relative;	
}

.bannerdecor {	
	
}


/*	-	THE BANNER	(max-width)	-	*/
.banner{
	max-width:1020px;
	height:350px;
	position:relative;
	overflow:hidden;			
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";	/*filter: alpha(opacity=0); */	-moz-opacity: 0;	-khtml-opacity: 0;	opacity: 0;
}

.tp_blog_imgholder .banner,.portfolio_detail_imgholder .banner{
	max-width:100%;
}

.bannertimer{
	background:<?php echo $highlight_color;?>;
	height:2px;
	width:100%;
	position:absolute;
	top:0px;	
	z-index:25;
	/*border-top:1px solid #333;
	border-right:1px solid #333;
	border-bottom:1px solid #999;
	border-left:1px solid #999;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";	filter: alpha(opacity=50);	-moz-opacity: 0.5;	-khtml-opacity: 0.5;	opacity: 0.5;*/
}

  /*********************************************************************************************
		-	SET THE SCREEN SIZES FOR THE BANNER IF YOU WISH TO MAKE THE BANNER RESOPONSIVE 	-	
  **********************************************************************************************/
   @media only screen and (min-width: 768px) and (max-width: 959px) {		
 		  .banner				{ 	width:828px;  }		  	
		  .bannercontainer		{ 	width:828px;  }		  	
   }
  
   @media only screen and (min-width: 480px) and (max-width: 767px) {
		   .banner				{	width:460px; 	}		   		
		   .bannercontainer		{	width:460px;	margin-left:-20px;}		   		
   }
   
   @media only screen and (min-width: 0px) and (max-width: 479px) {
			.banner				{	width:340px;	}			
			.bannercontainer	{	width:340px;margin-left:-20px;	}			
   }



.tp-simpleresponsive ul {
	list-style:none;
	padding:0;
	margin:0;
}			

.tp-simpleresponsive >ul li{
/* 	list-stye:none;			 */
	position:absolute;
}

.tp-simpleresponsive .caption {
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";	/* filter: alpha(opacity=0); */	-moz-opacity: 0;	-khtml-opacity: 0;	opacity: 0; position:absolute;
}

/************************
	-	BULLETS	-
*************************/

.tp-roundbullets				{	z-index:1000; margin-left:auto; margin-right:auto;  position:relative; margin-top:-20px; background:url(../images/assets/button/navigdots_bgtile.png); height:17px;	 
									padding:9px 9px; 
									border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;  	
									-webkit-box-shadow: 0px 0px 16px -1px #000;-moz-box-shadow: 0px 0px 16px -1px #000; box-shadow: 0px 0px 16px -1px #000; 
								}
								

.tp-longbullets					{	z-index:1000; margin-left:auto; margin-right:auto;  position:relative; margin-top:0px; 	 width:800px; }	
.tp-longbullets .bullet			{	position:relative;width:100px; border:1px solid #ccc; border-top:5px solid #ccc; float:left; margin-right:-1px; text-align:center; padding:0px;
									background:#fff;
									/*-webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.8s ease-out; -ms-transition: all 0.3s ease-in-out;*/
								}	
.tp-longbullets .bullet-first	{	border-left:none; }
.tp-longbullets .bullet.last	{	border-right:none; }



.tp-fullbullets					{	z-index:1000; margin-left:auto; margin-right:auto;  position:relative; margin-top:0px; 	 width:800px; }	
.tp-fullbullets .bullet			{	position:relative;width:100px; border:1px solid #ccc; border-top:5px solid #ccc; float:left; margin-right:-1px; text-align:center; padding:10px 0px 10px;
									background:#fff;
									/*-webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.8s ease-out; -ms-transition: all 0.3s ease-in-out;*/
								}	
.tp-fullbullets .bullet-first	{	border-left:none; }
.tp-fullbullets .bullet.last	{	border-right:none; }

.tp-fullbullets	.btitle			{	color:#000; font-size:12px; line-height:1; font-weight:bold; font-family: sans-serif; position:relative; font-family: Arial, sans-serif;	}
.tp-fullbullets	.bdesc			{	margin-top:5px; color:#666; font-size:11px; line-height:1; font-style:italic; font-family: Arial; position:relative; }
			
			

.tp-fullbullets .bullet.selected:after{
	content: '';
	position: absolute;
	top:0px;
	left: 50%;
	margin-left: -6px;
	width: 0;
	height: 0;
	border-left: 6px solid transparent;
	border-right: 6px solid transparent;
	border-top: 6px solid <?php echo $highlight_color;?>;
}						
								
.tp-fullbullets .bullet:hover,
.tp-fullbullets .bullet.selected		{	border-top:5px solid <?php echo $highlight_color;?>; background:#f5f5f5; cursor:pointer;}
								
.tp-longbullets .bullet:hover,
.tp-longbullets .bullet.selected		{	border-top:5px solid <?php echo $highlight_color;?>; background:#f5f5f5; cursor:pointer;}
	


.tp-roundbullets .bullet				{	cursor:pointer; position:relative;
											background:url(../images/assets/button/navigdots.png) no-Repeat bottom left;	width:15px;	height:15px; border-radius: 8px; -moz-border-radius: 8px; -webkit-border-radius: 8px; margin-right:10px; float:left;
											-webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.8s ease-out; -ms-transition: all 0.3s ease-in-out;
											border:1px solid #373737;
										}

.tp-roundbullets .bullet:last-child		{	margin-right:0px;	}

.tp-roundbullets .bullet:hover, 
.tp-roundbullets .bullet.selected		{	background-position:top left; }


/**		BULLET THUMBS VERSION	**/

.tp-roundbullets .bulletthumbs						{	display:none; position:absolute;  top:-90px; padding:3px; background-color:#fff;
														-webkit-box-shadow: 0px 0px 3px -1px #000;-moz-box-shadow: 0px 0px 3px -1px #000; box-shadow: 0px 0px 3px -1px #000;
													}
.tp-roundbullets .bulletthumbs .smallarrow			{	margin-left:-4px; width:9px; height:5px; z-index:10; position:absolute; bottom:-5px; left:50%; background:url(../images/assets/button/arrowdown.png) no-repeat 0px 0px; }
.tp-roundbullets .bulletthumbs .thumbdecorholder	{   position:relative; top:0px; left:0px; width:120px; height:70px; overflow:hidden; }
.tp-roundbullets .bulletthumbs .thumbsholder		{	position:relative;  top:0px; left:0px; width:5000px; }
.tp-roundbullets .bulletthumbs .bulletthumb			{	float:left; width:120px; height:70px;}


.tp-longbullets .bulletthumbs						{	display:none; position:absolute;  top:-90px; padding:0px; background-color:#fff;
														-webkit-box-shadow: 0px 0px 3px -1px #000;-moz-box-shadow: 0px 0px 3px -1px #000; box-shadow: 0px 0px 3px -1px #000;
													}

.tp-longbullets .bulletthumbs .thumbdecorholder		{   position:relative; top:0px; left:0px; width:120px; overflow:hidden; }
.tp-longbullets .bulletthumbs .thumbsholder			{	position:relative;  top:0px; left:0px;  width:5000px;}
.tp-longbullets .bulletthumbs .bulletthumb			{	float:left; width:120px; height:70px;}


.caption p											{	font-size:18px;}

	
	@media only screen and (min-width: 768px) and (max-width: 959px) {
			.tp-longbullets	.btitle			{	font-size:11px; }
			.tp-longbullets	.bdesc			{	font-size:11px;}
			.caption p						{   font-size:14px;}
	  }
  
  
	
  
   @media only screen and (min-width: 480px) and (max-width: 767px) {
				.tp-fullbullets .bullet:hover:after,
				.tp-fullbullets .bullet.selected:after{		content: ''; 	position: absolute;		top:0px;	left: 0%;	margin-left: 0px;	width: 0;	height: 0;	border:none; }	
				.tp-fullbullets .bullet			{ 	padding:0px; height:0px; border-left:none; border-right:none; border-bottom:none;margin-right:1px; }
				.tp-fullbullets	.btitle			{	display:none; }
				.tp-fullbullets	.bdesc			{	display:none;}
				.caption p						{   font-size:12px;}
				.caption h1, .caption h2, 
				.caption h3, .caption h4,
				.caption h5, .caption h6		{	font-size:14px !important;}
				.caption .tp-check				{ 	background:none; padding:0px;}
   }
   
   @media only screen and (min-width: 0px) and (max-width: 479px) {   
				.tp-fullbullets .bullet:hover:after,
				.tp-fullbullets .bullet.selected:after{		content: ''; 	position: absolute;		top:0px;	left: 0%;	margin-left: 0px;	width: 0;	height: 0;	border:none; }	
				.tp-fullbullets .bullet			{ 	padding:0px; height:0px; border-left:none; border-right:none; border-bottom:none;margin-right:1px; }
				.tp-fullbullets	.btitle			{	display:none; }
				.tp-fullbullets	.bdesc			{	display:none;}
				.caption p						{   font-size:12px;}
				.caption h1, .caption h2, 
				.caption h3, .caption h4,
				.caption h5, .caption h6		{	font-size:14px !important;}
				.caption .tp-check				{ 	background:none; padding:0px;}
		
	}	
	
	
/************************************
	-	CONTENT SHORTCODES	-
************************************/
	
	.contentdivider { width: 100%; height: 0; border-bottom: 1px solid #ddd; margin-bottom: 20px; }
	.one_half { width: 48%; }
	.one_third { width: 30.66%; }
	.two_third { width: 65.33%; }
	.three_fourth { width:74%;}
	.one_fourth { width: 22%; }
	.one_fifth { width: 16.8%; }
	.one_sixth { width: 13.33%; }
	.one_half, .one_third, .two_third, .one_fourth, .one_fifth, .three_fourth, .one_sixth { margin-right: 4%; margin-bottom: 10px; float: left; }
	.lastcolumn { margin-right: 0!important; clear: right; }


	@media only screen and (max-width: 767px) {
		.one_half, .one_third, .two_third, .one_fourth, .one_fifth, .one_sixth { width: 100%; }
	}

/* #Tabs (activate in tabs.js)
================================================== */
.sidebar	ul.tabs {
		display: block;
		margin: 0 0 20px 0;
		padding: 0;
		border-bottom: solid 1px #1e1e1e; 
		border-top: 0 !important;
		/* JAS font-size:<?php echo get_option("aversis_main_font_size");?>; */
		font-size:<?php echo (get_option_tree( 'aversis_main_font_size', '', false, true, 0 )).get_option_tree( 'aversis_main_font_size', '', false, true, 1 );?>;
	}
.sidebar	ul.tabs li {
		display: block;
		width: auto;
		height: 30px;
		padding: 0 !important;
		float: left;
		margin-bottom: 0 !important; 
	border-bottom:0 !important;}
.sidebar	ul.tabs li a {
		display: block;
		text-decoration: none;
		width: auto;
		height: 29px;
		padding: 0px 20px;
		line-height: 30px;
		border: solid 1px #1e1e1e;
		border-width: 1px 1px 0 0;
		margin: 0;
		background: #111111;
		font-size: 13px; }
.sidebar	ul.tabs li a.active {
		background: #151515;
		height: 30px;
		position: relative;
		top: -4px;
		padding-top: 4px;
		border-left-width: 1px;
		margin: 0 0 0 -1px;
		color: #fff;
		-moz-border-radius-topleft: 2px;
		-webkit-border-top-left-radius: 2px;
		border-top-left-radius: 2px;
		-moz-border-radius-topright: 2px;
		-webkit-border-top-right-radius: 2px;
		border-top-right-radius: 2px; 
		}
.sidebar	ul.tabs li:first-child a.active {
		margin-left: 0; }
.sidebar	ul.tabs li:first-child a {
		border-width: 1px 1px 0 1px;
		-moz-border-radius-topleft: 2px;
		-webkit-border-top-left-radius: 2px;
		border-top-left-radius: 2px; }
.sidebar	ul.tabs li:last-child a {
		-moz-border-radius-topright: 2px;
		-webkit-border-top-right-radius: 2px;
		border-top-right-radius: 2px; }

.sidebar	ul.tabs-content { margin: 0; display: block; border-top:0 !important; }
.sidebar	ul.tabs-content > li { display:none; }
/* JAS .sidebar	ul.tabs-content > li.active { display: block; border-bottom:0 !important; font-size:<?php echo get_option("aversis_main_font_size");?> !important;} */
.sidebar	ul.tabs-content > li.active { display: block; border-bottom:0 !important; font-size:<?php echo (get_option_tree( 'aversis_main_font_size', '', false, true, 0 )).get_option_tree( 'aversis_main_font_size', '', false, true, 1 );?> !important;}

	/* Clearfixing tabs for beautiful stacking */
.sidebar	ul.tabs:before,
.sidebar	ul.tabs:after {
	  content: '\0020';
	  display: block;
	  overflow: hidden;
	  visibility: hidden;
	  width: 0;
	  height: 0; }
.sidebar	ul.tabs:after {
	  clear: both; }
.sidebar	ul.tabs {
	  /* zoom: 1; */ }

@media only screen and (min-width: 480px) and (max-width: 767px) {
		/*.widget 			{	margin-bottom:60px !important;}*/
		#tp_valiano_home_content .space70			{	margin-bottom:0px !important;}						
   }
   
@media only screen and (min-width: 0px) and (max-width: 479px) {
		/*.widget 			{	margin-bottom:60px !important;}	*/
		#tp_valiano_home_content .space70				{	margin-bottom:0px !important;}	
}
	
	
/*	TABS	*/	
	
ul.tabs 			{		display: block;		margin: 0 0 20px 0;		padding: 0;		border-bottom: solid 1px #ddd; 		border-top: 0 !important;		}
ul.tabs li 			{		display: block;		width: auto;		height: 30px;		padding: 0 !important;		float: left;				margin-bottom: 0 !important; 		border-bottom:0 !important;}		
ul.tabs li a 		{		display: block;		text-decoration: none;		width: auto;		height: 29px;		padding: 0px 20px;		line-height: 30px;		border: solid 1px #ddd;		border-width: 1px 1px 0 0;		margin: 0;		
							background-color: #f5f5f5;		font-size: 13px; 		color:#666;				}
ul.tabs li:hover a {		background:#fff;}

ul.tabs li a.active {		background: #fff;		height: 30px;		position: relative;		top: -5px;		padding-top: 10px;		border-left-width: 1px;		margin:0;		margin-top:-5px;
							margin-left:-1px;		color: #000;	font-weight:bold !important;	}
ul.tabs li:first-child a.active {		margin-left: 0;font-weight:bold !important; }

ul.tabs li:first-child a {		border-width: 1px 1px 0 1px;		}

		
ul.tabs li:last-child a {		 }

ul.tabs-content { margin: 0; display: block; border-top:0 !important; }
ul.tabs-content > li { display:none; }
ul.tabs-content > li.active { display: block; border-bottom:0 !important; }

	/* Clearfixing tabs for beautiful stacking */
ul.tabs:before,
ul.tabs:after 		{	  content: '\0020';	  display: block;	  overflow: hidden;	  visibility: hidden;	  width: 0;	  height: 0; }
ul.tabs:after 		{	  clear: both; }
ul.tabs 			{	  /* zoom: 1; */ }


/************************************
		-	PRICETABLES	-
*************************************/
	.pricecol ul	{	float:left;}
	
	.pricing.fivecols .pricecol	ul { overflow:visible; width:20%; margin-left:-1px;}
	.pricing.fourcols .pricecol	ul { overflow:visible; width:24.9%; margin-left:-1px;}
	.pricing.threecols .pricecol ul { overflow:visible; width:33%; margin-left:-1px;}
	.pricing.twocols   .pricecol ul { overflow:visible; width:50%; margin-left:-1px;}
	
	
	.pricing .pricecol .thead	{	color:#fff; font-size:20px; line-height:1; padding:17px 0px; <?php echo $main_google_font;?> text-align:center;}
	.pricing .pricecol .price	{	font-size:20px; line-height:1; text-align: center; padding:12px 0px; <?php echo $main_google_font;?> border-left:1px solid #ddd;border-top:1px solid #ddd;border-right:1px solid #ddd;}
	.pricing .pricecol .price span { color:#555; font-size:12px; line-height:1; font-style:italic; }
	.pricing .pricecol .item	{	background-color:#f5f5f5; color:#555; font-size:12px; line-height:1; padding:12px 0px; font-family:Arial; text-align:center; border-right:1px solid #ddd;border-left:1px solid #ddd;border-top:1px solid #ddd;}	
	.pricing .pricecol .buy		{	background-color:#f5f5f5; text-align:center;  padding:32px 0px; border:1px solid #ddd;}
	

	.pricecol.orange .thead	{	background-color:#ff7701;}
	.pricecol.green .thead	{	background-color:#00b100;}
	.pricecol.apple .thead	{	background-color:#00b100;}
	.pricecol.blue .thead	{	background-color:<?php echo $highlight_color;?>;}
	.pricecol.red .thead	{	background-color:#D92322;}
	.pricecol.lightgrey .thead	{	background-color:#777;}
	.pricecol.darkgrey .thead	{	background-color:#777;}
	.pricecol.candy .thead	{	background-color:#777;}
	.pricecol.yellow .thead	{	background-color:#777;}
	.pricecol.tblue .thead {  background-color:#3d63a9;}
	
	.pricecol.orange .price	{	color:#ff7701;}
	.pricecol.green .price	{	color:#00b100;}
	.pricecol.apple .price	{	color:#00b100;}
	.pricecol.blue .price	{	color:<?php echo $highlight_color;?>;}
	.pricecol.red .price	{	color:#D92322;}
	.pricecol.lightgrey .price	{	color:#777;}
	.pricecol.darkgrey .price	{	color:#777;}
	.pricecol.candy .price	{	color:#777;}
	.pricecol.yellow .price	{	color:#777;}
	
	
	/*	HIGHLIGHTS	*/
	.pricecol.orange.highlight ul		{	border:1px solid #ff7701;}
	.pricecol.green.highlight ul		{	border:1px solid #00b100;}
	.pricecol.apple.highlight ul		{	border:1px solid #00b100;}
	.pricecol.blue.highlight ul			{	border:1px solid <?php echo $highlight_color;?>;}
	.pricecol.red.highlight ul			{	border:1px solid #D92322;}
	.pricecol.lightgrey.highlight ul	{	border:1px solid #777;}
	.pricecol.darkgrey.highlight ul		{	border:1px solid #777;}
	.pricecol.candy.highlight ul		{	border:1px solid #777;}
	.pricecol.yellow.highlight ul		{	border:1px solid #777;}
	
	.pricecol.highlight ul			{	box-shadow: 2px 1px 15px rgba(0, 0, 0, 0.55);  -moz-box-shadow: 2px 1px 15px rgba(0, 0, 0, 0.55);-webkit-box-shadow: 2px 1px 15px rgba(0, 0, 0, 0.55);								}
	
	.pricing.fivecols .pricecol.highlight ul		{	width:19.9% !important; margin-top:-11px;position:relative;z-index:2; }													
	.pricing.fourcols .pricecol.highlight ul		{	width:24.8% !important; margin-top:-11px;position:relative;z-index:2; }														
	.pricing.threecols .pricecol.highlight ul		{	width:32.9% !important; margin-top:-11px;position:relative;z-index:2; }	
	.pricing.twocols .pricecol.highlight ul		{	width:50% !important; margin-top:-11px;position:relative;z-index:2; }																		
								
	.pricecol.highlight .thead	{	padding-top:27px !important;}
	.pricecol.highlight .buy	{	padding-bottom:42px !important;}
	
	.large-button-wrap		{	}
	.large-button							{	/* filter: dropshadow(color=#333333, offx=0, offy=1); */	font-weight:bold; <?php echo $main_google_font;?>
													 border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px; 													 
													 max-height:41px; padding:11px 20px 12px;
													 -webkit-transition: all 0s ease-out; -moz-transition: all 0s ease-out; -o-transition: all 0s ease-out; -ms-transition: all 1s ease-in-out;
													
											}
											
    .large-button span						{	color:#fff;	text-shadow: 0px 1px 0px #333333; font-size:15px;  }							
	
	/*.orange.large-button					{ 	background:url(../images/tiles/largebutton_orange.png) no-repeat top left; }
	.green.large-button						{ 	background:url(../images/tiles/largebutton_green.png) no-repeat top left; }
	.apple.large-button						{ 	background:url(../images/tiles/large_button_apple.png) no-repeat top left; }
	.blue.large-button, .large-button		{ 	background:url(../images/tiles/large_button.png) no-repeat top left; }
	.red.large-button						{ 	background:url(../images/tiles/large_button_red.png) no-repeat top left; }
	.lightgrey.large-button					{ 	background:url(../images/tiles/largebutton_lightgrey.png) no-repeat top left; }
	.darkgrey.large-button					{ 	background:url(../images/tiles/largebutton_darkgrey.png) no-repeat top left; }
	.candy.large-button						{ 	background:url(../images/tiles/largebutton_candy.png) no-repeat top left; }
	.yellow.large-button					{ 	background:url(../images/tiles/largebutton_yellow.png) no-repeat top left; }
*/
	.large-button:hover			{	background-position:0px -42px;}

	
	@media only screen and (min-width: 768px) and (max-width: 959px) {		
	
   }
  
   @media only screen and (min-width: 480px) and (max-width: 767px) {
		.pricing.fivecols .pricecol ul,
		.pricing.fourcols .pricecol ul,
		.pricing.threecols .pricecol ul		{ width:210px !important;}
		
		.pricing.fivecols .pricecol.highlight ul,
		.pricing.fourcols .pricecol.highlight ul,
		.pricing.threecols .pricecol.highlight ul		{ width:208px !important; margin-top:-11px;position:relative;z-index:2;}
   }
   
   @media only screen and (min-width: 0px) and (max-width: 479px) {
		.pricing.fivecols .pricecol	ul,
		.pricing.fourcols .pricecol	ul,
		.pricing.threecols .pricecol ul		{ clear:both; margin-bottom:20px; width:300px !important;}
		
		.pricing.fivecols .pricecol.highlight ul,
		.pricing.fourcols .pricecol.highlight ul,
		.pricing.threecols .pricecol.highlight ul		{ width:298px !important; margin-top:-11px;position:relative;z-index:2;}
   }
 
 
 
 /************************************
	-	content Accordion	-
***************************************/
			.contentsc.accordion 								{	/* border:1px solid #ddd; */ margin-bottom: 20px; overflow:hidden;}
			.contentsc.accordion .accordion-item				{   width:100%;  position:relative; /* background:#eee; */ /* padding:5px; */
																	-webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.3s ease-out; -ms-transition: all 1s ease-in-out; margin-bottom:5px; padding-top:5px;
																}
			.contentsc.accordion .accordion-item				{	/* border-bottom:1px solid #ddd; */}

			.contentsc.accordion .accordion-item .toggletitle	{	  margin-left:10px; margin-bottom:0px; padding-bottom:0px; /* font-size:12px; */ font-weight:bold; color:#777; border:none;  
																	-webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.3s ease-out; -ms-transition: all 1s ease-in-out;
																}

			
			
			.contentsc.accordion .accordion-item.highlight .toggletitle	{	color:#000;}
			.contentsc.accordion .accordion-item.highlight		{	background-color:#f7f7f7;}
			

			.contentsc.accordion .togglecontent				{	border:none; padding:0px 20px 10px 75px; margin-bottom:0px;}			
			
			.accordion-item.noicon .togglecontent		{	border:none; padding:0 0 1px 10px; margin-bottom:0px;}			
			.accordion-item.noicon .toggletitle		{	padding:5px 10px 5px 10px !important;}
			
			.accordion-item.noicon:before					{	content:'\21D2'; float:left; font-size: 20px; font-weight:bold; color:#777; margin-top:4px; margin-left: 2px;}
			.accordion-item.noicon.highlight:before			{	content:'\21D3'; color:#000; font-size: 20px; margin-top:3px;}
			
			.contentsc.accordion .togglecontent	p			{	margin-bottom:0px !important;}			
			.contentsc.accordion .accordion_down:hover		{	background-color:#373737;}		

			.contentsc.accordion							{	color:#000;}
			.contentsc.accordion p							{	/* font-size:12px; */ color:#000; font-family:Arial;}					
			
			.contentsc.accordion .togglecontent	a,
			.contentsc.accordion .togglecontent	a:visited 	{	/* font-size:12px; */  font-family:Arial; color:<?php echo $highlight_color;?>; -webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.3s ease-out; -ms-transition: all 1s ease-in-out;}					
			.contentsc.accordion .togglecontent	a:hover		{	color:#777;}
			
			.contentsc.accordionopen						{	cursor:pointer;}	
			
			
			.contentsc.accordion .tp-check				{	padding-left:51px;}	
			.contentsc.accordion .tp-support			{	padding-left:51px;}	
			.contentsc.accordion .tp-global				{	padding-left:51px;}	
			.contentsc.accordion .tp-usflag				{	padding-left:51px;}	
			.contentsc.accordion .tp-modular			{	padding-left:51px;}	
			.contentsc.accordion .tp-team				{	padding-left:51px;}	
			.contentsc.accordion .tp-alert				{	padding-left:51px;}	
			.contentsc.accordion .tp-cart				{	padding-left:51px;}	
			.contentsc.accordion .tp-question				{	padding-left:51px;}	
					
/************************************
	-	CONTACT	-
************************************/

	#googlemap { width: 100%; height: 250px; float: left; text-shadow:0px 0px 0px #000;}
	.errormessage, .sendingmessage, .successmessage { float: left !important; color: #444; font-size: 12px; line-height: 34px; text-decoration: none; display: none;  margin-left: 20px;}
	.errormessage { color: <?php echo $highlight_color;?>; }
	input[type="text"].formerror, textarea.formerror { border: 1px solid <?php echo $highlight_color;?> !important; }
								

/* Contact */
.footer_container .errormessage, .footer_container .sendingmessage, .footer_container .successmessage { width:100%; color: #777; font-size: 12px; line-height: 30px; text-decoration: none; display: none;  margin-left: 20px;}
	.footer_container .errormessage { color: #fff; }
	.footer_container input[type="text"].formerror, .footer_container textarea.formerror { border: 1px solid #fff !important; }
	#quickcontact .successmessage,#quickcontact .sendingmessage,#quickcontact .errormessage {	margin-left:0 !important;	}	
	
	
	
	
	
.cover				{	width:0px; height:0px; background-color:<?php echo $highlight_color;?>; position:absolute; top:5px; left:5px; 
						-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; /* filter: alpha(opacity=0); */-moz-opacity: 0;-khtml-opacity: 0;opacity: 0;
						-webkit-transition: opacity 0.3s ease-out; -moz-transition: opacity 0.3s ease-out; -o-transition: opacity 0.3s ease-out; -ms-transition: opacity 1s ease-in-out;			
					}
.cover.selected		{	opacity:0.3;-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=30)";/* filter: alpha(opacity=30); */-moz-opacity: 0.3;-khtml-opacity: 0.3;opacity: 0.3; }

/*cf7*/
.wpcf7-form-control {float:none !important;}