<?php
	global $wp_query;
    $content_array = $wp_query->get_queried_object();
	if(isset($content_array->ID)){
    	$post_id = $content_array->ID;
	}	
	if (!isset($post_id)) $post_id = idbyslug ('category');
	// Language Options
		$averis_readmore = __('Learn More', 'averis');
		$averis_search = __('Search the Site...', 'averis');

	// General Options
		$template_uri = get_template_directory_uri();
		$SEO_description = get_bloginfo('description');

		if ( function_exists( 'get_option_tree') ) {
			$logo_subline = get_option_tree( 'aversis_logo_tagline' );
			$contact_line = get_option_tree( 'aversis_header_contactline' );
			$social_line = get_option_tree( 'aversis_header_social_text_line' );

			if(get_option_tree( 'aversis_search_box' )) $aversis_search_box="on"; else $aversis_search_box="off";
			if(get_option_tree( 'aversis_header_socialblock' )) $aversis_header_socialblock="on"; else $aversis_header_socialblock="off";

			$socials = get_option_tree( 'aversis_social_icons', '', false, true, -1 );

/*
			$aversis_favicon = get_option_tree( 'aversis_favicon' );
			if(!strpos($aversis_favicon, "ttp:")) $aversis_favicon = get_template_directory_uri().'/'.$aversis_favicon;

			$aversis_favicon57 = get_option_tree( 'aversis_favicon57' );
			if(!strpos($aversis_favicon57, "ttp:")) $aversis_favicon57 = get_template_directory_uri().'/'.$aversis_favicon57;

			$aversis_favicon72 = get_option_tree( 'aversis_favicon72' );
			if(!strpos($aversis_favicon72, "ttp:")) $aversis_favicon72 = get_template_directory_uri().'/'.$aversis_favicon72;
			
			$aversis_favicon114 = get_option_tree( 'aversis_favicon114' );
			if(!strpos($aversis_favicon114, "ttp:")) $aversis_favicon114 = get_template_directory_uri().'/'.$aversis_favicon114;
*/


			if(get_option_tree('aversis_seo_active') && isset($post_id)){
/* 				$SEO_description .= " ".get_option_tree('aversis_seo_global_description');  */
				$SEO_description = get_option_tree('aversis_seo_global_description'); 
				$SEO_tags = get_option_tree('aversis_seo_global_tags'); 
					if(get_option_tree('aversis_seo_page_active')){	
/* 						$SEO_description .= " ".my_get_the_excerpt($post_id); */
						$posttags = get_the_tags();
						if ($posttags) {
						  foreach($posttags as $tag) {
						  	if($SEO_tags!="") $SEO_tags .= ', ';
						    $SEO_tags .= $tag->name ; 
						  }
						}
					}
			}
			// JAS Never mind the sitewide description. We want to pull the excerpt instead, if there is one.
			if( my_get_the_excerpt($post_id)!=='' ) { $SEO_description = my_get_the_excerpt($post_id); }
			
			// Background Default
			$def_background = get_option_tree( 'aversis_body_background_image' );
			$def_background_style = get_option_tree( 'aversis_background_image_style' );
		}

		if (isset($post_id)){
			$pagecustoms = getOptions($post_id);
			//Background Custom
			if(isset($pagecustoms["averis_background_active"])){
				$def_background = wp_get_attachment_image_src($pagecustoms["averis_background_src"],'full');
				$def_background = $def_background[0]; 
				$def_background_style = $pagecustoms["averis_background_type"];
			}
		}
		
		if(isset($pagecustoms["averis_meta_keywords"])){
				$SEO_tags = $pagecustoms["averis_meta_keywords"].' '.$SEO_tags; 
			}
		
		// JAS If the SEO Description is set in the page options, use it instead of the excerpt
		if(isset($pagecustoms["averis_meta_description"])){
				$SEO_description = $pagecustoms["averis_meta_description"];
			}
/* 		$SEO_description = (strlen($SEO_description) > 150) ? substr($SEO_description,0,157).'&#8230;' : $SEO_description; */
		
?><!DOCTYPE html>
<html lang="en">
<head>

<?php
// For downloading of reports - If proper access code is set, start their report download automatically
if (isset($_SESSION['reportSuccess'])) {
	$report = trim(base64_decode($_GET['r'])).'.zip';
	echo '<meta http-equiv="refresh" content="1;url=https://www.airchecklab.com/report-pdfs/'.$report.'">';
	}
?>
	<title><?php echo wp_title(" | ",1,'right'); ?><?php echo get_bloginfo('name'); ?> </title>
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<meta charset="<?php echo get_bloginfo('charset'); ?>">
	<meta name="keywords" content="<?php if(isset($SEO_tags)) { echo $SEO_tags; } ?>" />
	<meta name="description" content="<?php if(isset($SEO_description)) { echo $SEO_description; } ?>" />
	<meta name="robots" content="index, follow" />
	<meta name="viewport" content="initial-scale=1, maximum-scale=5, user-scalable=1">
	<?php // echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/colorpicker.css" type="text/css" media="all">';?>
<?php /*
    <!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="<?php echo $aversis_favicon;?>" type="image/png"> 
	<link rel="apple-touch-icon" href="<?php echo $aversis_favicon57;?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $aversis_favicon72;?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $aversis_favicon114;?>">
*/ ?>

     <?php wp_head(); ?>
	 <script type="text/javascript" src="//assets.pinterest.com/js/pinit.js" data-pin-hover="true"></script>
</head>
<body  <?php body_class( 'body' ); ?>>

<div class="container content_container">
	<div class="sixteen columns" id="header">
		<a href="/"><img class="twelve columns alpha" src="/wp-content/uploads/2016/08/Training-Banner.png" alt="Compressed Air Testing" /></a>
		<div class="four columns omega">
			<div class="phone-box">(800) 247-1024</div>
			<div id="search">
				<form method="get" action="<?php echo home_url(); ?>/">
					<input type="text" id="Form_Search" name="s" placeholder="<?php echo $averis_search;?>" class="InputBox" />
					<input type="submit" id="Form_Go" value="" class="Button" />
				</form>
			</div>
		</div>
		<div class="clear"></div>
<!-- NAVIGATION	-->
		<div id="navholder" class="sixteen columns alpha omega">
			<?php wp_nav_menu( array(
				  'menu' 			=> 'Main',
				  'container'       => 'div',
				  'container_class' => '',
				  'container_id' 	=> 'nav'
			)); ?>

<!-- SOCIAL MEDIA -->
			<div class="menuright_holder">
				<ul class="socials">
				<?php 
					if($aversis_header_socialblock=="on" && is_array($socials)){
					foreach ($socials as $social) {
						if(strpos($social["image"], "ttp:")) $social_image = $social["image"];
						else $social_image = get_template_directory_uri().'/'.$social["image"];
						echo '<li><a href="'.$social["link"].'"><div class="soc" style="width:20px;height:20px;background:url('.$social_image.') no-repeat;"><div class="bg"></div><div class="tooltip">'.$social["title"].'</div></div></a></li>';
					}}?>
				</ul>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
<!-- Responsive Menu -->
			<form id="responsive-menu" action="#" method="post">
				<div id="responsive-menu-button">Navigation</div>
				<select>
					<option value="">Navigation</option>
				</select>
			</form>
		</div>
	</div>