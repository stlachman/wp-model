<?php

if(isset($_GET['type']) && $_GET['type']=='image' && (strpos($_SERVER['HTTP_REFERER'],"veris-slider-admin") ) ){
	$_GET['post_id']= 0;
	$_REQUEST['post_id'] = 0;
}

//Save Options
if (isset($_POST) && isset($_POST['save']) && $_POST['save']=="yes" ) { 
	if(isset($_POST["del_banner"])){
    	$banner_array = get_option("averis_sliders");
    	$banner_array_slugs = get_option("averis_sliders_slugs");
    	$banner_counter=0;
    	foreach ($banner_array as $banner) {
    		if($banner==$_POST["del_banner"]){
    			unset($banner_array[$banner_counter]);
    			unset($banner_array_slugs[$banner_counter]);
    			break;
    		}
    		$banner_counter++;
    	}
    	update_option("averis_sliders",$banner_array); 
    	update_option("averis_sliders_slugs",$banner_array_slugs); 
    	header("Location: ".$_SERVER['PHP_SELF'].'?page=averis-slider-admin');
    }
    else{
	 	foreach($_POST as $key => $value) { 
	        
	        if (is_array($value)) {  
	        	//echo "update_option('$key',";
	            foreach ($value as $value_array){
	              	$field_values[] = stripslashes(esc_attr($value_array)); 
	            	//echo "'".stripslashes(esc_attr($value_array))."',";
	            }
	            update_option($key, $field_values);
	            $field_values=empty($field_values);
	            //echo");";
	       } 
	       else{
	        	update_option($key,stripslashes(esc_attr($value))); 
	        	//echo "update_option('$key','".stripslashes(esc_attr($value))."');";
	       }
	    } 

	    if(isset($_POST["new_banner"])){
	    	$banner_array = get_option("averis_sliders");
	    	$banner_array_slugs = get_option("averis_sliders_slugs");
	    	if(is_array($banner_array)){
	    		array_push($banner_array, $_POST["new_banner"]);
	    		array_push($banner_array_slugs, $_POST[$_POST["new_banner"]."banner_slug"]);
	    	}
	    	else{
	    		$banner_array = array($_POST["new_banner"]);
	    		$banner_array_slugs= array($_POST[$_POST["new_banner"]."banner_slug"]);
	    	}
	    	update_option("averis_sliders",$banner_array);
	    	update_option("averis_sliders_slugs",$banner_array_slugs);
	    }
	}
}

//Loading scripts for Slider Admin
function load_admin_scripts() {
     if( is_admin() && isset($_GET["page"]) && ($_GET["page"]=="averis-slider-admin") ) {
        wp_enqueue_script('jquery');
        // Media Upload
	   	wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		// jQuery UI
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-sortable');
        wp_enqueue_script('jquery-ui-draggable');
    	// Colorpicker
        wp_enqueue_style( 'averis_colorpicker_css',get_template_directory_uri().'/functions/averis_slider_admin/colorpicker/css/colorpicker.css');
        wp_enqueue_script('averis_colorpicker_js', get_template_directory_uri().'/functions/averis_slider_admin/colorpicker/js/colorpicker.js', array('jquery'));
        wp_enqueue_script('averis_colorpicker_eye_js', get_template_directory_uri().'/functions/averis_slider_admin/colorpicker/js/eye.js', array('jquery'));
		wp_enqueue_script('averis_colorpicker_utils_js', get_template_directory_uri().'/functions/averis_slider_admin/colorpicker/js/utils.js', array('jquery'));
		wp_enqueue_script('averis_colorpicker_layout_js', get_template_directory_uri().'/functions/averis_slider_admin/colorpicker/js/layout.js?ver=1.0.2', array('jquery'));
		// The Admin
		wp_enqueue_script('AVERIS_standard_plugins_script', get_template_directory_uri()."/js/jquery.themepunch.plugins.min.js", array('jquery'));
		wp_enqueue_script('averis_admin_js', get_template_directory_uri().'/functions/averis_slider_admin/averis_admin.js', array('jquery'));
		wp_enqueue_style('averis_admin_css', get_template_directory_uri() .'/functions/averis_slider_admin/averis_admin.css');
    }
}
add_action('admin_head','load_admin_scripts');

// adding Theme Functions to the Menu
add_action('admin_menu', 'averis_slider_menu');

function averis_slider_menu() {
	add_submenu_page('option_tree', 'Old Sliders', 'Old Sliders', 'manage_options', 'averis-slider-admin', 'averis_slider_admin',get_template_directory_uri()."/icon.png", 100 );
}

function averis_slider_admin() {
	if (!current_user_can('manage_options'))  {
		wp_die( _e('You do not have sufficient permissions to access this page.','averis') );
	}	

	//GET Basic Banner ID
	if(isset($_GET["banner_id"])){
		//Saved Banner
		$banner_id = $_GET["banner_id"];
		$build_new_banner_field = ""; //no new banner
		//FILL Banner Form Field Values
			// Basic Slider
				$banner_width = get_option($banner_id."banner_width");
				$banner_height = get_option($banner_id."banner_height");
				$slide_timer = get_option($banner_id."slide_timer");
				$banner_font = get_option($banner_id."banner_font");
			
			// Bullets/Thumbs
				$slide_thumb_visible = get_option($banner_id."slide_thumb_visible");
				$slide_thumb_type = get_option($banner_id."slide_thumb_type");
				$slide_thumb_width = get_option($banner_id."slide_thumb_width");
				$slide_thumb_height = get_option($banner_id."slide_thumb_height");

			// Slider Lists
				$banner_slug = get_option($banner_id."banner_slug");
				$banner_slug_list = get_option($banner_id."banner_slug_list");
				$banner_list = get_option($banner_id."banner_list");
	}
	else{
		//New Banner
		$banner_id = uniqid("banner_")."_";
		$build_new_banner_field = "<input type='hidden' name='new_banner' value='".$banner_id."'>";
		//FILL Banner Form Field Values
			// Basic Slider
				$banner_width = 1020;
				$banner_height = 350;
				$slide_timer = 12000;
				$banner_font = "";
			
			// Bullets
				$slide_thumb_type = "long";
				$slide_thumb_width = 120;
				$slide_thumb_height = 70;
				$slide_thumb_visible = "off";

			// Slider Lists
				$banner_slug = "No Name Yet";
				$banner_list = "";
				$banner_slug_list = "";
	}



?>
<div id="savediv" style="display:none;">
	<?php if($_GET["banner_id"]) echo html_entity_decode(stripslashes(get_option($banner_id."banner_list",ENT_QUOTES))); ?>
</div>
<form name="saveform" id="saveform_html" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?page=averis-slider-admin&banner_id='.$banner_id;?>">
					<div id="saveform"  style="display:none;">
						<input type="hidden" name="<?php echo $banner_id;?>banner_list" id="banner_list">
						<?php
							echo $build_new_banner_field;
						?>
						<span id="delfield_placeholder"></span>
						<input type="hidden" name="save" value="yes">
					</div>
 	   
					<div id="pageparentdiv" class="saloonbannerwindows postbox" style="width:900px;margin-top:20px;">
						<h3 class="hndle" style="padding:5px;"><span>Banner</span></h3><div style="margin-top:-37px;margin-right:3px;" class="openclose"></div>
						<div class="inside">
							<!-- Name Container -->
							<div class="banner_option one_fourth">
								<label for="<?php echo $banner_id;?>load_slider"> Load Slider</label><br>
								<select id="load_slider">
									<?php
										$averis_sliders = get_option("averis_sliders");
										if(!$_GET["banner_id"]){
											array_push($averis_sliders, $banner_id);
										}
										foreach ($averis_sliders as $slider) {
											if($slider==$banner_id) $selected = "selected"; else $selected="";
											$banner_name = get_option($slider."banner_slug");
											if($banner_name=="") $banner_name = "No Name Yet";
											echo '<option value="'.$_SERVER['PHP_SELF'].'?page=averis-slider-admin&banner_id='.$slider.'" '.$selected.'>'.$banner_name.'</option>';
										}
										echo '<option value="'.$_SERVER['PHP_SELF'].'?page=averis-slider-admin">Add new Slider</option>';
									?>
								</select>
							</div>
							<div class="banner_option one_fourth">
								<label for="<?php echo $banner_id;?>banner_slug">Current Slider Slug</label><br>
								<input type="text" name="<?php echo $banner_id;?>banner_slug" id="banner_slug" value="<?php echo $banner_slug;?>">
								<input type="hidden" name="<?php echo $banner_id;?>banner_id" id="banner_id" value="<?php echo $banner_id;?>">
							</div>
							<div class="banner_option one_fourth">
								<br><input type="submit" value="Save All Changes" class="save_all button-framework save-options" name="submit">
							</div>
							<div class="banner_option lastcolumn one_fourth">
								<br><input type="submit" value="Delete Slider" class="save_all button-framework del-options" name="del">
							</div>
							<!-- End Name Container -->
						</div>
						<div style="clear:both"></div>
					</div>

					<div style="clear:both"></div>

					<div id="pageparentdiv" class="saloonbannerwindows postbox" style="width:900px;margin-top:20px;">
						<h3 class="hndle" style="padding:5px;"><span>Attributes</span></h3><div style="margin-top:-37px; margin-right:3px;" class="openclose"></div>
						<div class="inside">
						<!-- Basic Container -->
							<div id="general_options">
								<div class="one_third bordered">
									
										<div class="banner_option">
											<label for="<?php echo $banner_id;?>banner_width">Max Width of the Banner (px)</label><br>
											<input type="text" name="<?php echo $banner_id;?>banner_width" id="banner_width" value="<?php echo $banner_width; ?>">
										</div>
										<div class="banner_option">
											<label for="<?php echo $banner_id;?>banner_height">Max Heigth of the Banner (px)</label><br>
											<input type="text" name="<?php echo $banner_id;?>banner_height" id="banner_height" value="<?php echo $banner_height; ?>">
										</div>
																		
								</div>
								<div class="one_third bordered">
									<div class="banner_option">										
											<label for="<?php echo $banner_id;?>banner_font">Google Font in Banner (<a href="<?php echo get_template_directory_uri();?>/functions/averis_slider_admin/google_web_fonts_banner.jpg" target="_blank">Quick Help</a>)</label><br>
											<input type="text" style="width:100%" name="<?php echo $banner_id;?>banner_font" id="banner_font" value="<?php echo $banner_font; ?>">										
									</div>
									<div class="banner_option">
										<label for="<?php echo $banner_id;?>slide_timer">Slide Timer (ms)</label><br>
										<input type="text" name="<?php echo $banner_id;?>slide_timer" id="slide_timer" value="<?php echo $slide_timer; ?>">
									</div>
								</div>
								<div class="one_third  bordered">
									<div class="banner_option" style="margin-bottom: 16px;">
										<label for="<?php echo $banner_id;?>slide_thumb_visible">Display Thumb</label><br>
										<?php if ($slide_thumb_visible=="on") $checked = "checked"; else $checked="";?>
										<input type="radio" name="<?php echo $banner_id;?>slide_thumb_visible" id="slide_thumb_visible" value="on" <?php echo $checked;?>> On 
										<?php if ($slide_thumb_visible=="off") $checked = "checked"; else $checked="";?>
										<input style="margin-left:20px;" type="radio" name="<?php echo $banner_id;?>slide_thumb_visible" id="slide_thumb_visible" value="off" <?php echo $checked;?>> Off 
									</div>
									<div class="banner_option" >
										<label for="<?php echo $banner_id;?>slide_thumb_type">Thumbnail / Bullet Type</label><br>																			
										<?php if ($slide_thumb_type=="long") $checked = "checked"; else $checked="";?>
										<input type="radio" name="<?php echo $banner_id;?>slide_thumb_type" id="slide_thumb_type" value="long" <?php echo $checked;?>> Long
										<?php if ($slide_thumb_type=="full") $checked = "checked"; else $checked="";?>
										<input style="margin-left:20px;" type="radio" name="<?php echo $banner_id;?>slide_thumb_type" id="slide_thumb_type" value="full" <?php echo $checked;?>> Full
									</div>
								</div>
								
								
									
								<div style="clear:both"></div>
							</div>
							
						<!-- End Basic Container -->
							
						</div>
					</div>
					
					<!--<div id="pageparentdiv" class="postbox" style="width:900px;margin-top:20px;">
						<h3 class="hndle" style="padding:5px;"><span>CSS</span></h3>
						<div class="inside">
						<textarea name="contentcss" class="css" value="" rows="5" style="width:100%;resize:vertical;">.caption-gelb{ background-color:#ffff00; font-family:'Share'; font-size:14px; color:#000}						
						</textarea>
						</div>
					</div>
					-->
</form>
					<div style="clear:both"></div>
					
					<!-- BEGIN EXAMPLE DIVS -->
						<div id="basic_caption_li" style="display:none">
							<li class="caption_li">
													<div class="full caption_text">
														<div class="icon-caption">Text Layer</div><div class="openclose"></div>
														<label for="caption"></label><br>
														<input type="text" name="caption" class="caption" value="Put your <strong>HTML Caption</strong> in here!">
													</div>
													<div class="full caption_image">
														<div class="icon-caption">Image Layer</div><div class="openclose"></div>
														<div style="clear:both"></div>
														<span class="custom_default_image" style="display:none"><?php echo get_template_directory_uri()."/icon.png" ?></span>
															<input name="averis_caption_background_image" type="hidden" class="custom_upload_image averis_caption_background_image" value="698">
															<div class="" style="margin-left:auto; margin-right:auto;width:50px;position:relative;padding:10px; border:1px solid #999;"><img height="50px" src="http://dummyimage.com/50x50/666666/ffffff.png&text=A" class="custom_preview_image cap_image" alt=""></div><br>
															<input class="custom_upload_image_button button" style="width:100px" type="button" value="Choose Image">
													</div>
												
													
													<div class="inside-caption">
															<div style="margin-top:10px">
																<label for="transition">Start Animation</label><br>
																<select name="transition" class="transition">
																	<option value="lfr" selected>Longway from Right</option>
																	<option value="lfl">Longway from Left</option>
																	<option value="lft">Longway from Top</option>
																	<option value="lfb">Longway from Bottom</option>																	
																	
																	<option value="sfr" selected>Shortway from Right</option>
																	<option value="sfl">Shortway from Left</option>
																	<option value="sft">Shortway from Top</option>
																	<option value="sfb">Shortway from Bottom</option>																	
																	
																	<option value="fade">fade</option>																	
																</select>
															</div>
															<div class="one_half "  style="margin-top:10px;clear:both;">
																<label for="speed">Anim Duration (millisec)</label>
																<input type="text" style="width:133px" name="speed" class="speed" value="800" >
															</div>
															<div class="one_half lastcolumn" style="margin-top:10px;">
																<label for="start">Appearence after (millisec)</label>
																<input type="text" style="width:133px" name="start"  class="start" value="600" >
															</div>
															<div class="one_half" style="clear:both;">
																<label for="xpos">X Pos. (px)</label>
																<input type="text" name="xpos" style="width:133px" class="xpos" value="145" >
																<div style="float:right; margin-top:2px;"><div class="upup"></div><div class="downdown"></div></div>
															</div>
															<div class="one_half lastcolumn"  style="">
																<label for="ypos">Y Pos. (px)</label>
																<input type="text" name="ypos" style="width:133px" class="ypos" value="235" >
																<div style="float:right; margin-top:2px;"><div class="upup"></div><div class="downdown"></div></div>
															</div>
															<div class="one_half caption_text" style="clear:both">
																<label for="background_color">Back Color (#)</label>
																<input type="text" style="width:133px" name="background_color" class="background_color" value="000000">
															</div>
															<div class="one_half caption_text lastcolumn">
																<label for="text_color"> Text Color (#)</label>
																<input type="text" style="width:133px" name="text_color" class="text_color" value="ffffff">
															</div>
															<div class="full caption_text" style="clear:both;">
																
																
																
																	<!--	NORMAL -->
																	<div style="margin-bottom:5px">
																	<label for="css_extension"><b>CSS</b> Extension {...}</label><div class="openclose"></div>

																		<div class="inside" style="padding:0 !important; margin:0 !important; width:305px;">																		 
																			<textarea name="css_extension" class="css_extension">padding-left:10px;
padding-right:10px;
padding-top:10px;
padding-bottom:10px;
font-size:16px;</textarea>
																		</div>
																	</div>
																	
																
															</div>
															<div class="full" style="clear:both;">
																<div style="height:10px; overflow:hidden"><p style="visibility:hidden">.</p></div>
																<div title="Remove Caption" class="remove_caption">Remove Layer</div>
															</div>
														</div>
												</li>
							</div>

							<div id="basic_slide_li" style="display:none;">
								<li class="slide_li"> 
											<div class="slide_options">
													<!--<label for="slidetype">Slide Type (Image / Video)</label><br>
													<select name="slidetype" style="width:100%; margin-bottom:10px;" class="slidetype">
														<option value="Image" selected>Image</option>
														<option value="YouTube">YouTube</option>
														<option value="Vimeo">Vimeo</option>																	
													</select>
													-->
													<div class="imagetype">
														<span class="custom_default_image" style="display:none"><?php echo get_template_directory_uri()."/icon.png" ?></span>
														<input name="averis_slide_background_image" type="hidden" class="custom_upload_image averis_slide_background_image" value="698">
														<div class="slideimageholder"><img src="http://dummyimage.com/1020x354/666666/ffffff.png&text=averis+slider" class="custom_preview_image slide_image" alt=""></div><br>
														<input class="custom_upload_image_button button" type="button" value="Choose Image" style="margin-bottom:10px">
														<div class="clear:both"></div>
													</div>
													
													
													
													<!--<div class="videoclass" style="margin-top:10px">
																<label for="videoid">YouTube / Vimeo ID</label>
																<input type="text" name="videoid" class="videoid" value=""  style="width:100%; margin-bottom:10px;">
													</div>
													-->
													
													<div style="float:left; width:160px;margin-right:30px;margin-bottom:10px;">
														<label for="animation">Start Animation</label><br>
																<select name="animation" style="width:160px;" class="animation">
																	<option value="slotfade" selected>slot fade</option>
																	<option value="slotslide">slot slide</option>
																	<option value="slotzoom">slot zoom</option>
																	<option value="fade">fade</option>																	
																</select>
													</div>
													<div style="float:left; width:160px;">
																<label for="slotamount">Amounts of Slots</label>
																<input type="text" name="slotamount" style="width:137px" class="slotamount" value="10" >
																<div style="float:right; margin-top:2px;"><div class="upup"></div><div class="downdown"></div></div>
													</div>
													<div style="clear:both"></div>
													<label for="thumb_title">Slide Thumb Title</label>
																<input type="text" name="thumb_title" class="thumb_title" value=""  style="width:350px; margin-bottom:10px;">
													<label for="thumb_desc">Slide Thumb Description</label>
																<textarea name="thumb_desc" style="width:350px;height:100px;" class="thumb_desc"></textarea>
											</div>

											<ul class="captions">
												<div class="new_ones">
													<span class="newcaption"></span>
													<div title="Add Caption" class="add_caption" style="clear:both">Add Text</div>
													<span class="newcaption"></span>
													<div title="Add Image" class="add_image" >Add Image</div>
												</div>
											</ul>
											<div title="Remove Slide" class="remove_slide">Remove Slide</div>
											<div style="clear:both"></div>
										</li>
							</div>

					<!-- END EXAMPLE DIVS -->
					

					<!-- BEGIN EDITOR DIV -->
					<div id="pageparentdiv" class="saloonbannerwindows postbox sliderparent" style="width:900px;margin-top:20px;">
						<h3 class="hndle" style="padding:5px;"><span>Slides</span></h3><div style="margin-top:-37px;margin-right:3px;" class="openclose"></div>
						<div class="inside">
							<!-- Slides Container -->
							<ul id="slides" class="">
								<span class="newslide"></span>
								<div title="Add Slide" class="add_slide">Add Slide</div>
							</ul>
							<!-- End Slides Container -->
						</div>
						<div style="clear:both"></div>
					</div>
					<!-- END EDITOR DIV -->
<?php
}
?>