<?php


$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];

$template_uri = get_template_directory_uri();
$template_path = get_bloginfo("template_directory");

// Access WordPress
require_once( $path_to_wp . '/wp-load.php' );

include( TEMPLATEPATH .'/functions/zilla-shortcodes/zilla-shortcodes.php' );
?>