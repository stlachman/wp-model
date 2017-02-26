<?php


	// use page meta fields if page
function show_custom_page_meta_box(){
	global $custom_page_meta_fields,$custom_meta_fields;
	$custom_meta_fields=$custom_page_meta_fields;
	show_custom_meta_box();
}

function show_custom_page_portfolio_meta_box(){
	global $custom_page_portfolio_meta_fields,$custom_meta_fields;
	$custom_meta_fields=$custom_page_portfolio_meta_fields;
	show_custom_meta_box();
}

// use post meta fields if post
function show_custom_post_meta_box(){
	global $custom_post_meta_fields,$custom_meta_fields;
	$custom_meta_fields=$custom_post_meta_fields;
	show_custom_meta_box();
}

// use post meta fields if post
function show_custom_post_type_meta_box(){
	global $custom_post_type_meta_fields,$custom_meta_fields;
	$custom_meta_fields=$custom_post_type_meta_fields;
	show_custom_meta_box();
}

function show_custom_portfolio_meta_box(){
	global $custom_portfolio_meta_fields,$custom_meta_fields;
	$custom_meta_fields=$custom_portfolio_meta_fields;
	show_custom_meta_box();
}

function show_custom_post_portfolio_type_meta_fields(){
	global $custom_post_portfolio_type_meta_fields,$custom_meta_fields;
	$custom_meta_fields=$custom_post_portfolio_type_meta_fields;
	show_custom_meta_box();
}

// add some custom js to the head of the page
function add_custom_scripts() {
	global $custom_meta_fields,$custom_page_meta_fields, $post;
	if(!isset($_GET["page"])&& !isset($_GET['type'])){
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('jquery-ui-slider');
		wp_enqueue_script('custom-js', get_template_directory_uri() . '/functions/page_options/page-options.js');
		wp_enqueue_script('custom-js-page', get_template_directory_uri() . '/functions/page_options/page-options-custom.js');
		//wp_enqueue_style('jquery-ui-custom', get_template_directory_uri() .'/functions/template/admin/adminpanel/css/jquery-ui-custom.css');
	}
	$output = '<script type="text/javascript">
				jQuery(function() {';
	
	foreach ($custom_page_meta_fields as $field) { // loop through the fields looking for certain types
		if(isset($field['type'])){
			// date
			if($field['type'] == 'date')
				$output .= 'jQuery(".datepicker").datepicker();';
			// slider
			if ($field['type'] == 'slider' && isset($post->ID)) {
				$value = get_post_meta($post->ID, $field['id'], true);
				if ($value == '') $value = $field['min'];
				$output .= '
						jQuery( "#'.$field['id'].'-slider" ).slider({
							value: '.$value.',
							min: '.$field['min'].',
							max: '.$field['max'].',
							step: '.$field['step'].',
							slide: function( event, ui ) {
								jQuery( "#'.$field['id'].'" ).val( ui.value );
							}
						});';
			}
		}
	}
	
	$output .= '});';
		
	//echo $output;
}

add_action('admin_enqueue_scripts','add_custom_scripts');

// The Callback
function show_custom_meta_box() {
	global $custom_meta_fields,$post;
	// Use nonce for verification
	echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
	
	// Begin the field table and loop
	echo '<table class="form-table">';
	foreach ($custom_meta_fields as $field) {
		// get value of this field if it exists for this post
		$meta = get_post_meta($post->ID, $field['id'], true);
		// begin a table row with
		echo '<tr class="'.$field['class'].'">
				<th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
				';
				switch($field['type']) {
					//description
					case 'desc':
						echo '<td colspan=2><span class="description">'.$field['desc'].'</span></td>';
					break;
					// text
					case 'text':
						echo '<td><input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" /></td>
								<td width="30%"><span class="description">'.$field['desc'].'</span></td>';
					break;
					// textarea
					case 'textarea':
						echo '<td><textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="30" rows="4">'.$meta.'</textarea></td>
								<td><span class="description">'.$field['desc'].'</span></td>';
					break;
					// checkbox
					case 'checkbox':
						echo '<td><input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>
								<label for="'.$field['id'].'">'.$field['text'].'</label>
								</td><td><span class="description">'.$field['desc'].'</span></td>';
					break;
					// select
					case 'select':
						echo '<td><select name="'.$field['id'].'" id="'.$field['id'].'">';
						foreach ($field['options'] as $option) {
							echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
						}
						echo '</select>
							</td><td><span class="description">'.$field['desc'].'</span></td>';
					break;
					// radio
					case 'radio':
						echo '<td>';
						foreach ( $field['options'] as $option ) {
							if ($meta=="") $meta=$field['default'];
							echo '<input type="radio" name="'.$field['id'].'" id="'.$field['id']."_".$option['value'].'" value="'.$option['value'].'" ',$meta == $option['value'] ? ' checked="checked"' : '',' />
									<label for="'.$option['value'].'">'.$option['label'].'</label><br />';
						}
						echo '</td><td><span class="description">'.$field['desc'].'</span></td>';
					break;
					// checkbox_group
					case 'checkbox_group':
						foreach ($field['options'] as $option) {
							echo '<td><input type="checkbox" value="'.$option['value'].'" name="'.$field['id'].'[]" id="'.$option['value'].'"',$meta && in_array($option['value'], $meta) ? ' checked="checked"' : '',' /> 
									<label for="'.$option['value'].'">'.$option['label'].'</label><br />';
						}
						echo '</td><td><span class="description">'.$field['desc'].'</span></td>';
					break;
					// tax_select
					case 'tax_select':
						echo '<td><select name="'.$field['id'].'" id="'.$field['id'].'">
								<option value="">Select One</option>'; // Select One
						$terms = get_terms($field['id'], 'get=all');
						$selected = wp_get_object_terms($post->ID, $field['id']);
						foreach ($terms as $term) {
							if (!empty($selected) && !strcmp($term->slug, $selected[0]->slug)) 
								echo '<option value="'.$term->slug.'" selected="selected">'.$term->name.'</option>'; 
							else
								echo '<option value="'.$term->slug.'">'.$term->name.'</option>'; 
						}
						$taxonomy = get_taxonomy($field['id']);
						echo '</select></td>
						<td><span class="description"><a href="'.get_bloginfo('home').'/wp-admin/edit-tags.php?taxonomy='.$field['id'].'">Manage '.$taxonomy->label.'</a></span></td>';
					break;
/*
					case 'slider_list':
						echo '<td><select name="'.$field['id'].'" id="'.$field['id'].'">';
                		
                		global $wpdb;
                		global $table_prefix;
                		$table_prefix = $wpdb->base_prefix;
                		if (!isset($wpdb->tablename)) {
							$wpdb->tablename = $table_prefix . 'revslider_sliders';
						}
                		$revolution_sliders = $wpdb->get_results( 
							"
							SELECT title,alias 
							FROM $wpdb->tablename
							"
						);
					foreach ( $revolution_sliders as $revolution_slider ) 
					{
						$checked="";
            		 	if($revolution_slider->alias==$meta) $checked="selected";
            		 	echo "<option value='$revolution_slider->alias' $checked>".$revolution_slider->title."</option>";
					}
                	echo '</select></td>';
					break;
*/
					// post_list
					case 'post_list':
					$items = get_posts( array (
						'post_type'	=> $field['post_type'],
						'posts_per_page' => -1
					));
						echo '<td><select name="'.$field['id'].'" id="'.$field['id'].'">
								<option value="">Select One</option>'; // Select One
							foreach($items as $item) {
								echo '<option value="'.$item->ID.'"',$meta == $item->ID ? ' selected="selected"' : '','>'.$item->post_type.': '.$item->post_title.'</option>';
							} // end foreach
						echo '</select></td>
							<td><span class="description">'.$field['desc'].'</span></td>';
					break;
					// unlimited sidebars
					case 'sidebar_list':
						global $wp_registered_sidebars;
					    if( empty( $wp_registered_sidebars ) )
					        return;
					    $name = $field['id'];
					    $current = ( $meta ) ? esc_attr( $meta ) : false;     
					    $selected = '';
					    echo "<td><select name='$name'>";
					    foreach( $wp_registered_sidebars as $sidebar ) : 
					        if( $current ) 
					            if($sidebar['name'] == $current)
					            	$selected = "selected";
					            else 
					            	$selected = "";
					        echo "<option value='".$sidebar['name']."' $selected>";
					        echo $sidebar['name'];
					    	echo "</option>";
					    endforeach;
					    echo "</select></td>";
						echo '<td><span class="description">'.$field['desc'].'</span></td>';
					break;  
					/*case 'slider_list':
						echo '<td><select name="'.$field['id'].'" id="'.$field['id'].'">';
                		$slider_slugs = get_option("averis_sliders");
                		$slider_counter = 0;
            			foreach ( $slider_slugs as $slug ){
                			$checked="";
                		 	if($slug==$meta) $checked="selected";
                		 	echo "<option value='$slug' $checked>".get_option($slug."banner_slug")."</option>";
                		} 
                		echo '</select>';
					break;
					case 'slider_list2':
						echo '<td><select name="'.$field['id'].'" id="'.$field['id'].'">';
                		
                		global $wpdb;
                		global $table_prefix;
                		$table_prefix = $wpdb->base_prefix;
                		if (!isset($wpdb->tablename)) {
							$wpdb->tablename = $table_prefix . 'revslider_sliders';
						}
                		$revolution_sliders = $wpdb->get_results( 
							"
							SELECT title,alias 
							FROM $wpdb->tablename
							"
						);
					foreach ( $revolution_sliders as $revolution_slider ) 
					{
						$checked="";
            		 	if($revolution_slider->alias==$meta) $checked="selected";
            		 	echo "<option value='$revolution_slider->alias' $checked>".$revolution_slider->title."</option>";
					}
                	echo '</select>';
					break;*/
					// unlimited portfolios
					case 'portfolio_list':
						echo '<td><select name="'.$field['id'].'" id="'.$field['id'].'">';
                		$portfolio_slugs = get_option("averis_portfolio_slug");
                		$portfolio_counter = 0;
                		$portfolio_name = get_option("averis_portfolio_name");
	                		foreach ( $portfolio_slugs as $slug ){
	                			$checked="";
	                		 	if($slug==$meta) $checked="selected";
	                		 	echo "<option value='$slug' $checked>".$portfolio_name[$portfolio_counter++]."</option>";
	                		} 
                		echo '</select>';
					break;
					// date
					case 'date':
						echo '<td><input type="text" class="datepicker" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" /></td>
								<td><span class="description">'.$field['desc'].'</span></td>';
					break;
					// slider
					case 'slider':
					$value = $meta != '' ? $meta : '0';
						echo '<td><div id="'.$field['id'].'-slider"></div>
								<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$value.'" size="5" /></td>
								<td><span class="description">'.$field['desc'].'</span></td>';
					break;
					// image
					case 'image':
						$image_def = get_template_directory_uri().'/images/assets/bg/tiled1.jpg';	
						if ($meta) { $image = wp_get_attachment_image_src($meta, 'medium');	$image = $image[0]; }	
						else $image = $image_def;			
						echo '<td style="max-width:100%"><span class="custom_default_image" style="display:none">'.$image_def.'</span><a href="#" class="custom_media_upload">Choose Image</a><br>
								<img style="max-width:300px;" class="custom_media_image" src="'.$image.'" />
								<input class="custom_media_url" type="hidden" name="attachment_url" value="">
								<input class="custom_media_id" type="hidden" name="'.$field['id'].'" value=""><br clear="all" /><small>&nbsp;<a href="#" class="custom_clear_image_button">Remove Image</a></small></td>
							<td><span class="description">'.$field['desc'].'</span></td>';
					break;
					// repeatable
					case 'repeatable_taglines':
						$meta_head = get_post_meta($post->ID, $field['id']."_head", true);
						$meta_body = get_post_meta($post->ID, $field['id']."_body", true);
						echo '<td><a class="repeatable-add button" href="#">Add another Tagline</a>
								<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
						$i = 0;
						if ($meta_head) {
							foreach($meta_head as $row) {
								echo '<li class="widget ui-draggable"><div class="widget-top sort hndle" style="cursor:move; height:30px;margin-bottom:2px;"><span style="line-height:30px;margin-left:10px;">|||</span><a class="repeatable-remove button" style="float:right;margin-top:3px;margin-right:10px;" href="#">Remove</a></div>
											<div style="padding:10px;">
												Headline
												<input type="hidden" name="'.$field['id'].'_head['.$i.']" id="'.$field['id'].'_head" value="'.$row.'" style="width: 100%;margin-bottom:10px;" />
												Body
												<textarea name="'.$field['id'].'_body['.$i.']" id="'.$field['id'].'_body" rows=8 style="width: 100%;">'.$meta_body[$i].'</textarea>
											</div>
										</li>';
								$i++;
							}
						} else {
							echo '<li class="widget ui-draggable"><div class="widget-top sort hndle" style="cursor:move; height:30px;margin-bottom:2px;"><span style="line-height:30px;margin-left:10px;">|||</span><a class="repeatable-remove button" style="float:right;margin-top:3px;margin-right:10px;" href="#">Remove</a></div>
											<div style="padding:10px;">
												Headline
												<input type="hidden" name="'.$field['id'].'_head['.$i.']" id="'.$field['id'].'_head" value="" style="width: 100%;margin-bottom:10px;"  />
												Body
												<textarea name="'.$field['id'].'_body['.$i.']" rows=8 id="'.$field['id'].'_body" style="width: 100%;"></textarea>
											</div>
								  </li>';
						}
						echo '</ul></td>
							<td><span class="description">'.$field['desc'].'</span></td>';
					break;
					/*case 'repeatable_images':
						$meta_head = get_post_meta($post->ID, $field['id'], true);
						echo '<td><a class="repeatable-add button" href="#">Add another Background</a>
								<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
						$i = 0;
						if ($meta_head) {
							foreach($meta_head as $row) {
								echo '<li class="widget ui-draggable"><div class="widget-top sort hndle" style="cursor:move; height:30px;margin-bottom:2px;"><span style="line-height:30px;margin-left:10px;">|||</span><a class="repeatable-remove button" style="float:right;margin-top:3px;margin-right:10px;" href="#">Remove</a></div>
											<div style="padding:10px;">
												Headline
												<input type="hidden" name="'.$field['id'].'_head['.$i.']" id="'.$field['id'].'_head" value="'.$row.'" style="width: 100%;margin-bottom:10px;" />
												Body
												<textarea name="'.$field['id'].'_body['.$i.']" id="'.$field['id'].'_body" rows=8 style="width: 100%;">'.$meta_body[$i].'</textarea>
											</div>
										</li>';
								$i++;
							}
						} else {
							echo '<li class="widget ui-draggable"><div class="widget-top sort hndle" style="cursor:move; height:30px;margin-bottom:2px;"><span style="line-height:30px;margin-left:10px;">|||</span><a class="repeatable-remove button" style="float:right;margin-top:3px;margin-right:10px;" href="#">Remove</a></div>
											<div style="padding:10px;">
												Headline
												<input type="hidden" name="'.$field['id'].'_head['.$i.']" id="'.$field['id'].'_head" value="" style="width: 100%;margin-bottom:10px;"  />
												Body
												<textarea name="'.$field['id'].'_body['.$i.']" rows=8 id="'.$field['id'].'_body" style="width: 100%;"></textarea>
											</div>
								  </li>';
						}
						echo '</ul></td>
							<td><span class="description">'.$field['desc'].'</span></td>';
					break;
					*/
					case 'home_list':
						//list of used home teasers
						$teaser_list_used="";
						$tp_home_teasers = $meta;
						$tp_showbiz_teasers = get_option("tp_showbiz_uniq");

						if(is_array($tp_home_teasers)){
							foreach ($tp_home_teasers as $teaser) {
								$teaser_headline_short=get_option("tp_showbiz_slug_".$teaser);
								if(in_array($teaser, $tp_showbiz_teasers) || $teaser_headline_short ==""){
									if ($teaser_headline_short=="") $teaser_headline_short="Page Content";
									if(strlen($teaser_headline_short)>14)
										$teaser_headline_short= substr($teaser_headline_short, 0,14)."...";
										$teaser_list_used .= '<li class="widget ui-draggable"><input name="dragon_home_teasers[]" type="hidden" value="'.$teaser.'">'.$teaser_headline_short.'</li>
									';
								}
							}
						}

						//list of unused teasers
						$teaser_list_unused="";
						
						//if(in_array("Content", haystack))
						if(is_array($tp_showbiz_teasers)){
							foreach ($tp_showbiz_teasers as $teaser) {
								$teaser_headline_short=get_option("tp_showbiz_slug_".$teaser);
								if(strlen($teaser_headline_short)>14)
									$teaser_headline_short= substr($teaser_headline_short, 0,14)."...";
								if(!is_array($tp_home_teasers) || !in_array($teaser, $tp_home_teasers))
									$teaser_list_unused .= '<li class="widget ui-draggable"><input name="dragon_home_teasers[]" type="hidden" value="'.$teaser.'" disabled>'.$teaser_headline_short.'</li>
								';
							}
						}

						if (!strpos($teaser_list_used, 'value="dragon_home_content">Page Content</li>'))
						$teaser_list_unused .= '<li class="widget ui-draggable"><input name="dragon_home_teasers[]" type="hidden" value="dragon_home_content" disabled>Page Content</li>';	

						echo '<style>
						#used, #unused { list-style-type: none; margin: 0; padding: 0; float: left; background-color: #FCFCFC;border: 1px solid #DFDFDF; margin-right: 10px;  padding: 5px; width: 143px; min-height:45px;}
						#used li, #unused li { margin: 5px; padding: 5px; width: 120px; cursor:pointer;}
						</style>
						<script>
						jQuery(function() {
							jQuery( "#used" ).sortable({
								connectWith: "ul",
								receive: function(event, ui){
									$this = jQuery(this);
									$this.find("input").removeAttr("disabled");
								}
							});
							
							jQuery( "#unused" ).sortable({
								connectWith: "ul",
								receive: function(event, ui){
									$this = jQuery(this);
									$this.find("input").attr("disabled",true);
								}
							});

							jQuery( "#used, #unused" ).disableSelection();
						});
						</script>

					
						<td valign="top">
						In Use<br>
						<ul id="used">
							'.$teaser_list_used.'
						</ul>
						</td>
						<td valign="top">
						Available<br>
						<ul id="unused">
							'.$teaser_list_unused.'
						</ul>
						</td><td></td></tr>
						';
					break;
				} //end switch
		echo '</tr>';
	} // end foreach
	echo '<tr><td colspan=3 align="right"><input name="save" type="button" class="button-primary tp_publish_buttons" id="mypublish" accesskey="p" value=""></td></tr>';
	echo '</table>'; // end table
}

function remove_taxonomy_boxes() {
	remove_meta_box('categorydiv', 'post', 'side');
}
//add_action( 'admin_menu' , 'remove_taxonomy_boxes' );

// Save the Data
function save_custom_meta($post_id) {
    global $custom_meta_fields,$custom_post_portfolio_type_meta_fields,$custom_page_portfolio_meta_fields,$custom_page_meta_fields,$custom_post_meta_fields,$custom_portfolio_meta_fields,$custom_post_type_meta_fields;
    if(isset($_POST['post_type'])){
	    // which fields to use
	    if ('page' == $_POST['post_type']) {
			$custom_meta_fields = array_merge($custom_page_meta_fields,$custom_page_portfolio_meta_fields);
		}
		if ('post' == $_POST['post_type']) {
			$custom_meta_fields = array_merge($custom_post_meta_fields,$custom_post_type_meta_fields);
		}

		$portfolio_slugs = get_option("averis_portfolio_slug");
		if(is_array($portfolio_slugs)){
			if (in_array($_POST['post_type'], $portfolio_slugs)) {
				$custom_meta_fields = array_merge($custom_portfolio_meta_fields,$custom_post_portfolio_type_meta_fields);
			}
		}

		// verify nonce
		if(isset($_POST['custom_meta_box_nonce'])){
			if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) 
				return $post_id;
		}
		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return $post_id;
		// check permissions
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id))
				return $post_id;
			} elseif (!current_user_can('edit_post', $post_id)) {
				return $post_id;
		}

		// loop through fields and save the data
		foreach ($custom_meta_fields as $field) {
			//if($field['type'] == 'tax_select') continue;

				$old = get_post_meta($post_id, $field['id'], true);
				
				if(isset($_POST[$field['id']]))
					$new = $_POST[$field['id']];
				else $new = "";
			
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}


		} // end foreach
		
		// save taxonomies
		//$post = get_post($post_id);
		//$category = $_POST['category'];
		//wp_set_object_terms( $post_id, $category, 'category' );
	}
}
add_action('save_post', 'save_custom_meta');


?>