<?php
// Array that holds all Portfolio Options
// class is used to trigger some jQuery action

$custom_portfolio_meta_fields = array(
		array(
			'label'	=> 'Display Page Headline Block?',
			'text' => 'On/Off',
			'desc'	=> 'Show the block with the Headline (opt. Breadcrumb)?',
			'id'	=> $prefix.'headline_active',
			'type'	=> 'checkbox',
			'default' => 'checked',
			'class' => 'tp_options content portfolio index '
		),
		array(
			'label'	=> 'Alternative Page Title',
			'desc'	=> 'Alternative Head Title, leave blank for same as Page Title',
			'id'	=> $prefix.'header_title',
			'type'	=> 'text',
			'class' => 'tp_options content portfolio index headline'
		),
		array(
			'label'	=> 'Display Breadcrumbs?',
			'text' => 'On/Off',
			'desc'	=> 'Show Breadcrumbs in the Headline Block?',
			'id'	=> $prefix.'breadcrumbs_active',
			'type'	=> 'checkbox',
			'default' => 'checked',
			'class' => 'tp_options content portfolio index headline'
		),
		array(
			'label'	=> 'Use custom Page Background?',
			'text' => 'On/Off',
			'desc'	=> 'Use a Page Background different from the default in the Averis Options?',
			'id'	=> $prefix.'background_active',
			'type'	=> 'checkbox',
			'default' => 'checked',
			'class' => 'tp_options content contact portfolio index'
		),
		array(
			'label'	=> 'Page Background',
			'text' => 'On/Off',
			'desc'	=> 'Upload or Choose a page Background',
			'id'	=> $prefix.'background_src',
			'type'	=> 'image',
			'default' => 'checked',
			'class' => 'tp_options content contact portfolio page_background index contact'
		),
		array (
			'label'	=> 'Page Background Image Style',
			'desc'	=> 'You want your image tiled(small pic repeated), stretched(the picture will be stretched to the edges of the window ignoring the aspect ratio) or fitted(the picture size will be set to fill the screen respecting the aspect ratio, could be you do not see the whole picture depending on window dimensions)?
',
			'id'	=> $prefix.'background_type',
			'type'	=> 'radio',
			'default' => 'tiled',
			'options' => array (
				'tiled' => array (
					'label' => 'tiled',
					'value'	=> 'tiled'
				),
				'stretched' => array (
					'label' => 'stretch',
					'value'	=> 'stretch'
				),
				'fit-outside' => array (
					'label' => 'fit-outside',
					'value'	=> 'fit-outside'
				),
				'fit-inside' => array (
					'label' => 'fit-inside',
					'value'	=> 'fit-inside'
				)
			),
			'class' => 'tp_options content contact portfolio index page_background contact '
		),
		array (
			'label'	=> 'Portfolio Detail Style',
			'desc'	=> 'Detail Page Style (Image Left, Content right has no Sidebar)',
			'id'	=> $prefix.'detail_view_style',
			'type'	=> 'radio',
			'default' => 'full',
			'options' => array (
				'full' => array (
					'label' => 'Image Top, Content Bottom',
					'value'	=> 'full'
				),
				'columns' => array (
					'label' => 'Image Left, Content Right',
					'value'	=> 'columns'
				)
			),
			'class' => 'tp_options content portfolio index contact '
		),
		array(
			'label'	=> 'Activate Sidebar',
			'text' => 'On/Off',
			'desc'	=> 'Use a sidebar or full view',
			'id'	=> $prefix.'activate_sidebar',
			'type'	=> 'checkbox',
			'default' => 'checked',
			'class' => 'tp_options content portfolio columns index contact'
		),
		array (
			'label'	=> 'Sidebar Orientation',
			'desc'	=> 'Places the sidebar left or right',
			'id'	=> $prefix.'sidebar_orientation',
			'type'	=> 'radio',
			'default' => 'left',
			'options' => array (
				'right' => array (
					'label' => 'Right',
					'value'	=> 'right'
				),
				'left' => array (
					'label' => 'Left',
					'value'	=> 'left'
				)
			),
			'class' => 'tp_options content portfolio columns index sidebar contact '
		),
		array(
			'label'	=> 'Select Sidebar',
			'desc'	=> 'Choose the Sidebar to this Page',
			'id'	=>  $prefix.'sidebar',
			'default' => 'Blog Sidebar',
			'type'	=> 'sidebar_list',
			'class' => 'tp_options content  portfolio columns index sidebar contact'
		)
);


$custom_post_portfolio_type_meta_fields = array(
		array (
			'label'	=> 'Post Type',
			'desc'	=> 'Of which type is this blog post?',
			'id'	=> $prefix.'post_type',
			'type'	=> 'radio',
			'default' => 'image',
			'options' => array (
			//	'tp_valiano_post_type_text' => array ('label' => 'No special Type','value'	=> 'text'),
				'tp_valiano_post_type_image' => array ('label' => 'Image','value'	=> 'image'),
				'tp_valiano_post_type_video' => array ('label' => 'Video','value'	=> 'video'),
				'tp_valiano_post_type_audio' => array ('label' => 'Audio','value'	=> 'audio'),
				'tp_valiano_post_type_slider' => array ('label' => 'Slider','value'	=> 'slider')
			),
			'class' => ''
		),
		array (
			'label'	=> 'Video Type',
			'desc'	=> 'Where is the video located?',
			'id'	=> $prefix.'video_type',
			'type'	=> 'radio',
			'default' => '',
			'options' => array (
				'youtube' => array ('label' => 'Youtube','value'	=> 'youtube'),
				'vimeo' => array ('label' => 'Vimeo','value'	=> 'vimeo'),
				'flv' => array ('label' => 'FLV','value'	=> 'flv'),
				'webm' => array ('label' => 'HTML5','value'	=> 'webm')
			),
			'class' => 'post_type video youtube vimeo flv webm'
		),
		array(
			'label'	=> 'Youtube ID',
			'desc'	=> 'ID of the Youtube Video',
			'id'	=> $prefix.'youtube_id',
			'type'	=> 'text',
			'class' => 'post_type youtube'
		),
		array(
			'label'	=> 'Vimeo ID',
			'desc'	=> 'ID of the Vimeo Video',
			'id'	=> $prefix.'vimeo_id',
			'type'	=> 'text',
			'class' => 'post_type vimeo'
		),
		array(
			'label'	=> 'Video Width',
			'desc'	=> 'Width of the Video',
			'id'	=> $prefix.'video_width',
			'type'	=> 'text',
			'class' => 'post_type youtube vimeo flv'
		),
		array(
			'label'	=> 'Video Height',
			'desc'	=> 'Height of the Video',
			'id'	=> $prefix.'video_height',
			'type'	=> 'text',
			'class' => 'post_type youtube vimeo flv'
		),
		array(
			'label'	=> 'Video URL Link',
			'desc'	=> 'Link to the Video (FLV file)',
			'id'	=> $prefix.'flv_link',
			'type'	=> 'text',
			'class' => 'post_type flv'
		),
		array(
			'label'	=> 'MP4 URL Link',
			'desc'	=> 'Link to the MP4 (MP4 file)',
			'id'	=> $prefix.'mp4_link',
			'type'	=> 'text',
			'class' => 'post_type webm'
		),
		array(
			'label'	=> 'Audio URL Link',
			'desc'	=> 'Link to the Audio file',
			'id'	=> $prefix.'audio_link',
			'type'	=> 'text',
			'class' => 'post_type audio'
		),
		array(
			'label'	=> 'Select Slider',
			'desc'	=> 'Choose the Slider to this Page',
			'id'	=>  $prefix.'slider',
			'default' => '',
			'type'	=> 'slider_list',
			'class' => 'post_type slider'
		),
		array(
			'label'	=> '',
			'id' 	=> '',
			'desc'	=> 'Please use the "<strong>featured image</strong>" option of WP to display thumb preview pics and optional lightbox pics',
			'type'	=> 'desc',
			'class' => 'post_type slider audio flv webm'
		)
);
?>