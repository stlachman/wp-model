<?php
define('AVERIS_FUNCTIONS', TEMPLATEPATH . '/functions/');
define('AVERIS_THEME', get_template_directory_uri());
define('AVERIS_JAVASCRIPT', get_template_directory_uri() . '/js');
define('AVERIS_CSS', get_template_directory_uri() . '/css');


function optiontree_check(){

	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];
	require_once($path_to_wp . 'wp-admin/includes/plugin.php');

	if (is_plugin_active('option-tree/index.php')) {
		add_thickbox();
		add_action('admin_notices', 'optiontree_check_notice');
	}
	else{
		require_once (TEMPLATEPATH . '/functions/option-tree/index.php');
	}
}

function optiontree_check_notice(){
?>
  <div class='updated fade'>
    <p>Please <strong>deactivate</strong> the <strong>OptionTree plugin</strong> for the best Averis backend solution.</p>
  </div>
<?php
}

optiontree_check();

//require_once (TEMPLATEPATH . '/functions/option-tree/index.php');

/* Admin Functionality */
if (is_admin()){
	require_once(AVERIS_FUNCTIONS . '/theme_activation.php');
	//require_once(AVERIS_FUNCTIONS . '/averis_slider_admin/averis_admin.php');
	require_once(AVERIS_FUNCTIONS . '/page_options/theme_page_options.php');
	require_once(AVERIS_FUNCTIONS . '/theme_sidebars_functions.php');
	require_once(AVERIS_FUNCTIONS . '/theme_portfolio_functions.php');
	//require_once(AVERIS_FUNCTIONS . '/theme_featured_image_preview.php');
}


/* JavaScripts, Widgets, Sidebars, Shortcodes */
require_once(AVERIS_FUNCTIONS . '/theme_functions.php');
require_once(AVERIS_FUNCTIONS . '/theme_javascriptcss.php');
require_once(AVERIS_FUNCTIONS . '/theme_widgets.php');
require_once(AVERIS_FUNCTIONS . '/theme_sidebars.php');
require_once(AVERIS_FUNCTIONS . '/theme_shortcodes.php');
require_once(AVERIS_FUNCTIONS . '/theme_post_customtypes.php');
require_once(AVERIS_FUNCTIONS . '/theme_breadcrumbs.php');
require_once(AVERIS_FUNCTIONS . '/theme_pagination.php');
require_once(AVERIS_FUNCTIONS . '/theme_post_comments.php');

/* Theme Language */
require_once(AVERIS_FUNCTIONS . '/theme_language.php');

if (function_exists('camera_main_ss_add')) {
    add_action('admin_init','camera_main_ss_add');
}

?>