<?php

// GET FEATURED IMAGE
function ST4_get_featured_image($post_ID){
 $post_thumbnail_id = get_post_thumbnail_id($post_ID);
 if ($post_thumbnail_id){
  $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id);
  return $post_thumbnail_img[0];
 }
}

// ADD NEW COLUMN
function ST4_columns_head($defaults) {
 $defaults['featured_image'] = 'Featured Image';
 return $defaults;
}

// SHOW INFO IN THE NEW COLUMN
function ST4_columns_content($column_name, $post_ID) {
 if ($column_name == 'featured_image') {
  $post_featured_image = ST4_get_featured_image($post_ID);
  if ($post_featured_image){
   echo '<img src="' . aq_resize($post_featured_image,55,55,true) . '" />'; 
  }
 }
}

add_filter('manage_posts_columns', 'ST4_columns_head');
add_filter('manage_posts_custom_column', 'ST4_columns_content', 10, 2);

function ST4_columns_content_with_default_image($column_name, $post_ID) {
 // Create a default.jpg image and save it in the images directory of your active theme.

 if ($column_name == 'featured_image') {
  $post_featured_image = ST4_get_featured_image($post_ID);
  if ($post_featured_image){
   // HAS A FEATURED IMAGE
   echo '<img src="' . $post_featured_image . '" />';
   } else {
    // NO FEATURED IMAGE, USE THE DEFAULT ONE
    echo '<img src="' . aq_resize($get_bloginfo( 'template_url' ) . '/images/admin_icons/blank.png',55,55,true).'" />'; 
   }
  }
}


add_filter('manage_posts_columns', 'ST4_columns_head');
add_action('manage_posts_custom_column', 'ST4_columns_content', 10, 2);

// ADD NEW COLUMN
function ST5_columns_head($defaults) {
 $defaults['averis_post_type'] = 'Post Type';
 return $defaults;
}

function ST5_columns_content($column_name, $post_ID) {
  if ($column_name == 'averis_post_type') {
    echo ucwords(get_post_meta($post_ID, 'averis_post_type', true));
  }
}

add_filter('manage_posts_columns', 'ST5_columns_head');
add_action('manage_posts_custom_column', 'ST5_columns_content', 10, 2);

?>