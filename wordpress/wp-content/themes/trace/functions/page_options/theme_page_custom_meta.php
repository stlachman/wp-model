<?php
// Array that holds all Page Options
// class is used to trigger some jQuery action

$custom_page_meta_fields = array(
		array(
			'label'	=> 'Meta Description',
			'desc'	=> 'Override site-wide Meta Description set in Averis Options -> SEO',
			'id'	=> $prefix.'meta_description',
			'type'	=> 'textarea',
			'class' => ''
		),
		array(
			'label'	=> 'Meta Keywords',
			'desc'	=> 'Override site-wide Meta Keywords set in Averis Options -> SEO',
			'id'	=> $prefix.'meta_keywords',
			'type'	=> 'textarea',
			'class' => ''
		),
		array(
			'label'	=> 'Display Page Headline Block?',
			'text' => 'On/Off',
			'desc'	=> 'Show the block with the Headline (opt. Breadcrumb)?',
			'id'	=> $prefix.'headline_active',
			'type'	=> 'checkbox',
			'default' => 'checked',
			'class' => ' '
		),
		array(
			'label'	=> 'Alternative Page Title',
			'desc'	=> 'Alternative Head Title, leave blank for same as Page Title',
			'id'	=> $prefix.'header_title',
			'type'	=> 'text',
			'class' => 'tp_options headline'
		),
		array(
			'label'	=> 'Display Breadcrumbs?',
			'text' => 'On/Off',
			'desc'	=> 'Show Breadcrumbs in the Headline Block?',
			'id'	=> $prefix.'breadcrumbs_active',
			'type'	=> 'checkbox',
			'default' => 'checked',
			'class' => 'tp_options headline'
		),
		array(
			'label'	=> 'Use custom Page Background?',
			'text' => 'On/Off',
			'desc'	=> 'Use a Page Background different from the default in the Averis Options?',
			'id'	=> $prefix.'background_active',
			'type'	=> 'checkbox',
			'default' => '',
			'class' => ''
		),
		array(
			'label'	=> 'Page Background',
			'text' => 'On/Off',
			'desc'	=> 'Upload or Choose a page Background',
			'id'	=> $prefix.'background_src',
			'type'	=> 'image',
			'default' => '',
			'class' => 'tp_options page_background'
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
			'class' => 'tp_options page_background'
		),
		array(
			'label'	=> 'Activate Sidebar',
			'text' => 'On/Off',
			'desc'	=> 'Use a sidebar or full view',
			'id'	=> $prefix.'activate_sidebar',
			'type'	=> 'checkbox',
			'default' => 'checked',
			'class' => ''
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
			'class' => 'tp_options sidebar'
		),
		array(
			'label'	=> 'Select Sidebar',
			'desc'	=> 'Choose the Sidebar to this Page',
			'id'	=>  $prefix.'sidebar',
			'default' => 'Food Grade Air',
			'type'	=> 'sidebar_list',
			'class' => 'tp_options sidebar'
		)
);

$custom_page_portfolio_meta_fields = array(
		array(
			'label'	=> 'Select Portfolio',
			'desc'	=> 'Choose the Portfolio to display',
			'id'	=>  $prefix.'portfolio',
			'type'	=> 'portfolio_list',
			'class' => 'portfolio portfolio_blogview'
		)
);

?>