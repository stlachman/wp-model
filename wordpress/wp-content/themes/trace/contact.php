<?php
/* 
Template Name: Contact
*/
?>
<?php
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
				$sidebar_class = "offset-by-one omega sidebar";	
				$main_class = "left alpha";
			}
			else {
				$sidebar_class = "leftfloat";
				$main_class = "rightfloat omega";
			}
		}
		else {
			$averis_activate_sidebar="off";
			$post_column_full = "";
			$main_class = "";

		}		

	// Contact Options
		if ( function_exists( 'get_option_tree') ) {
			if((get_option_tree("aversis_contact_google_map_active"))){
				//Google Data
				$gmapaddress = get_option_tree('aversis_contact_gmap_address');
				$gmapzoom = get_option_tree('aversis_contact_gmap_zoom');
				//if($gmapzoom=="") $gmapzoom=14;
				$gmapinfo = get_option_tree('aversis_contact_gmap_box_html');
			}
			else{
				$gmapaddress = "";
				$gmapzoom = 0;
				$gmapinfo ="";
			}
		}	

	// Language Options
		$contact_labelname = __('Name *', 'averis');
		$contact_labelemail = __('Email *', 'averis');
		$contact_labeladdress = __('Address', 'averis');
		$contact_labelphone = __('Phone', 'averis');
		$contact_labelmessage = __('Message *', 'averis');
		$contact_buttonsubmit = __('Send Message', 'averis');
		$contact_messageerror = __('Error! Please correct marked fields.', 'averis');
		$contact_messagesuccess = __('Message send successfully!', 'averis');
		$contact_messagesending = __('Sending...', 'averis');
		$contact_send = __('Send', 'averis');

?>    

<?php get_header(); ?>
<!-- TRACETEMPLATE CONTACT -->
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
	<div class="divide50"></div>
	
<!-- MAIN CONTENT CONTAINER	-->
	<?php if(have_posts()) : while(have_posts()) : the_post();?>
		<div class="sixteen columns alpha">
			<div class="<?php echo $post_column_full." ".$main_class;?> columns" style="overflow:visible">
					<div class="clear"></div>
					<?php if($gmapaddress!=""){ ?><div class="tp_blog_imgholder" style="max-width:100%;height:auto;overflow:auto;"><div id="googlemap"></div></div>
								<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
				    			<script type="text/javascript" src="<?php echo $template_uri;?>/js/jquery.gmap.js"></script> 
				    			<script> 
				    			          jQuery(window).load(function(){
				    			              //set google map with marker
				    					      jQuery("#googlemap").gMap({
				    			                  markers: [{
				    			                              address: '<?php echo $gmapaddress; ?>'<?php if($gmapinfo!="") {?>,
				    			                              html: '<?php echo $gmapinfo; ?>' <?php  } ?>
				    			                          }],
				    			                  zoom: <?php echo $gmapzoom;?>
				    			              });
				    			          });
				    			    </script> 
							<?php } ?>
					<div class="clear"></div>
					<div class="divide25"></div>
					<?php the_content(); ?>
					<div class="clear"></div>
					<div class="divide10"></div>
					<div id="contactus" style="width:100%">
					        <form id="contactform" method="post" action="#" >
					        	<input type="text" name="name" id="reply_name" class="InputBox requiredfield" onFocus="if(this.value == '<?php echo $contact_labelname ?>') { this.value = ''; }" onBlur="if(this.value == '') { this.value = '<?php echo $contact_labelname ?>'; }" value="<?php echo $contact_labelname ?>"/>
					            <input type="text" name="email" id="reply_email" class="InputBox requiredfield " onFocus="if(this.value == '<?php echo $contact_labelemail ?>') { this.value = ''; }" onBlur="if(this.value == '') { this.value = '<?php echo $contact_labelemail ?>'; }" value="<?php echo $contact_labelemail ?>"/>
					            <input type="text" name="phone" id="reply_phone" class="InputBox last" onFocus="if(this.value == '<?php echo $contact_labelphone ?>') { this.value = ''; }" onBlur="if(this.value == '') { this.value = '<?php echo $contact_labelphone ?>'; }" value="<?php echo $contact_labelphone ?>"/>
					            <div class="clear"></div>
					            <textarea name="message" id="reply_message" class="TextBox requiredfield last" rows=8 onFocus="if(this.value == '<?php echo $contact_labelmessage ?>') { this.value = ''; }" onBlur="if(this.value == '') { this.value = '<?php echo $contact_labelmessage ?>'; }"><?php echo $contact_labelmessage ?></textarea>
					            <div class="clear"></div>
					            <div class="leftfloat"><input type="submit" id="From_Comment_Go" value="<?php echo $contact_send;?>" class="submitbutton bfade"/></div>
					            
					            
					            <span class="errormessage"><?php echo $contact_messageerror ?></span>
					            <span class="successmessage"><?php echo $contact_messagesuccess ?></span>
					            <span class="sendingmessage"><?php echo $contact_messagesending ?></span>  
					        </form>
					</div>
					<div class="clear"></div>
					
			</div>
			<?php if($averis_activate_sidebar!="off") {?>
				<div class="four columns sidebar <?php echo $sidebar_class;?>">
					 <div class="smallsizedivider"></div>
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
		</div>
		<div class="small right mart20">Is there a problem with this page? Help us fix it - <a href="/report-a-bug">Report a Bug</a></div>
	<?php  endwhile; endif; //have_posts ?>
<!-- END OF CONTENT CONTAINER -->
<?php get_footer(); ?>