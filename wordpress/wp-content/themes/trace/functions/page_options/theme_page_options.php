<?php
/* ------------------------------------- */
/* PAGE/POST/PORTFOLIO OPTIONS */
/* ------------------------------------- */

// Prefix for  Page/Post/Portfolio Options
$prefix="averis_";

// Load the Page Option Meta Fields
$custom_meta_fields=array();
require_once(AVERIS_FUNCTIONS . '/page_options/theme_page_custom_meta.php');
require_once(AVERIS_FUNCTIONS . '/page_options/theme_post_custom_meta.php');
require_once(AVERIS_FUNCTIONS . '/page_options/theme_portfolio_custom_meta.php');

// Generate Page/Post/Portfolio Options
add_action('admin_init', 'init_page_options');
function init_page_options() {
	add_meta_box("page-options", "Page Options", "show_custom_page_meta_box", "page", "normal", "high");
	add_meta_box("portfolio-options", "Portfolio Options", "show_custom_page_portfolio_meta_box", "page", "normal", "high");
	add_meta_box("post-options", "Post Options", "show_custom_post_meta_box", "post", "normal", "high");
	add_meta_box("post-type-options", "Post Type Options", "show_custom_post_type_meta_box", "post", "normal", "high");
	$portfolio_slugs = get_option("averis_portfolio_slug");
	if(is_array($portfolio_slugs))
		foreach ( $portfolio_slugs as $slug ){
		   add_meta_box("portfolio-post-options", "Portfolio Options", "show_custom_portfolio_meta_box", $slug, "normal", "high");	
		    add_meta_box("portfolio-post-type-options", "Portfolio Type Options", "show_custom_post_portfolio_type_meta_fields", $slug, "normal", "high"); 
		}
}



// Include the Page Option Framework Functions
require_once(AVERIS_FUNCTIONS . '/page_options/theme_page_options_functions.php');
?>