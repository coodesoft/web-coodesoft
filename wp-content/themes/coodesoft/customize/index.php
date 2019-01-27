<?php

add_action('customize_register','coode_customize');

function coode_customize($wp_customize){
	
	$wp_customize->add_panel( 'coodesoft_pages', array(
		'title' => __( 'Coodesoft Sections', 'textdomain' ),
		'description' => __( 'Configuración general', 'textdomain' ),
		'priority' => 160,
		'capability' => 'edit_theme_options',
	));
	
	$content = get_pages();
	
	foreach($content as $key => $page){
			
			$wp_customize->add_section( 'page_'.$page->ID , array(
				'title' => __( $page->post_title, 'textdomain' ),
				'panel' => 'coodesoft_pages',
				'priority' => 1,
				'capability' => 'edit_theme_options',
			));

			//Campo de texto
			$wp_customize->add_setting( 'background_'.$page->ID, array(
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
			    'transport' => 'refresh',

			));

			$wp_customize->add_control(
				   new WP_Customize_Image_Control($wp_customize, 'image_'.$page->ID, array(
						   'label'      => __( 'Upload a logo', 'theme_name' ),
						   'section'    => 'page_'.$page->ID,
						   'settings'   => 'background_'.$page->ID,
						   'context'    => 'your_setting_context' 
					   )
				   )
			);
	}
	
	$wp_customize->add_panel('coodesoft_home', array(
		'title'			=>  __( 'Coodesoft Home Page Setting', 'textdomain' ),
		'description'	=>  __( 'Imagen principal de la Home Page', 'textdomain' ),
		'priority'		=> 170,
		'capability' => 'edit_theme_options',
	));
	
	$wp_customize->add_section('home_image_section', array(
		'title' 		=> __('Imagen de la Home Page', 'textdomain'),
		'panel'			=> 'coodesoft_home',
		'priority'		=> 2,
		'capability'	=> 'edit_theme_options',
	));
	
	$wp_customize->add_setting('home_image_setting', array(
		'type'	=> 'theme_mod',
		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
	));
	
	$wp_customize->add_control( 
		new WP_Customize_Image_Control($wp_customize, 'home_image_control', array(
		   'label'      => __( 'Upload a home image', 'theme_name' ),
		   'section'    => 'home_image_section',
		   'settings'   => 'home_image_setting',
		   'context'    => 'your_setting_context' 
		)
    ));
	
}
