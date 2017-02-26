<?php
/* ------------------------------------- */
/* SIDEBAR REGISTRATION */
/* ------------------------------------- */

if ( function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Blog Sidebar',
        'id' => 'widget-slot',
        'before_widget' => '<div id="%1$s">',
/*         JAS 'after_widget' => '<div class="clear"></div><div class="divide50 widget_divide"></div></div>', */
        'after_widget' => '<div class="clear"></div><div style="margin-bottom:20px;" class="widget_divide"></div></div>',
/*         JAS 'before_title' => '<div style="margin-bottom:20px"><span class="widget_title">', */
        'before_title' => '<div><span class="widget_title">',
        'after_title' => '</span></div>'
    ));
    register_sidebar(array(
        'name' => 'Page Sidebar',
        'id' => 'page-sidebar-1',
        'before_widget' => '<div id="%1$s">',
/*         JAS 'after_widget' => '<div class="clear"></div><div class="divide50 widget_divide"></div></div>', */
        'after_widget' => '<div class="clear"></div><div style="margin-bottom:20px;" class="widget_divide"></div></div>',
/*         JAS 'before_title' => '<div style="margin-bottom:20px"><span class="widget_title">', */
        'before_title' => '<div><span class="widget_title">',
        'after_title' => '</span></div>'
    ));
    register_sidebar(array(
        'name' => 'Footer Widget Slot 1',
        'id' => 'footer-slot-1',
        'before_widget' => '<div id="%1$s">',
        'after_widget' => '<div class="clear"></div></div>',
        'before_title' => '<div style="margin-bottom:20px"><span class="widget_title">',
        'after_title' => '</span></div>'
    ));
    register_sidebar(array(
        'name' => 'Footer Widget Slot 2',
        'id' => 'footer-slot-2',
        'before_widget' => '<div id="%1$s">',
        'after_widget' => '<div class="clear"></div></div>',
        'before_title' => '<div style="margin-bottom:20px"><span class="widget_title">',
        'after_title' => '</span></div>'
    ));
    register_sidebar(array(
        'name' => 'Footer Widget Slot 3',
        'id' => 'footer-slot-3',
        'before_widget' => '<div id="%1$s">',
        'after_widget' => '<div class="clear"></div></div>',
        'before_title' => '<div style="margin-bottom:20px"><span class="widget_title">',
        'after_title' => '</span></div>'
    ));
    register_sidebar(array(
        'name' => 'Footer Widget Slot 4',
        'id' => 'footer-slot-4',
        'before_widget' => '<div id="%1$s">',
        'after_widget' => '<div class="clear"></div></div>',
        'before_title' => '<div style="margin-bottom:20px"><span class="widget_title">',
        'after_title' => '</span></div>'
    ));
    register_sidebar(array(
        'name' => 'Footer Widget Slot 5',
        'id' => 'footer-slot-5',
        'before_widget' => '<div id="%1$s">',
        'after_widget' => '<div class="clear"></div></div>',
        'before_title' => '<div style="margin-bottom:20px"><span class="widget_title">',
        'after_title' => '</span></div>'
    ));
    register_sidebar(array(
        'name' => 'Footer Widget Slot 6 is hard coded.',
        'id' => 'footer-slot-6',
        'before_widget' => '<div id="%1$s">',
        'after_widget' => '<div class="clear"></div></div>',
        'before_title' => '<div style="margin-bottom:20px"><span class="widget_title">',
        'after_title' => '</span></div>'
    ));

    $sidebars = get_option("averis_sidebar_name");
    $sidebar_count = 0;
    $sidebar_slug_nr = get_option("averis_sidebar_slug_nr");
    if(is_array($sidebars))
        foreach ( $sidebars as $sidebar ){
           register_sidebar(array(
                'name' => $sidebar,
                'id' => 'sidebar-'.$sidebar_slug_nr[$sidebar_count++],
                'before_widget' => '<div class="widget" id="%1$s">',
                /*         JAS 'after_widget' => '<div class="clear"></div><div class="divide50 widget_divide"></div></div>', */
                'after_widget' => '<div class="clear"></div><div style="margin-bottom:20px;" class="widget_divide"></div></div>',
                /*         JAS 'before_title' => '<div style="margin-bottom:20px"><span class="widget_title">', */
                'before_title' => '<div><span class="widget_title">',
                'after_title' => '</span></div>'
           ));     
        }
} ?>