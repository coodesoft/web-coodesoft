<?php

add_action('customize_register','coode_customize');

function coode_customize($wp_customize){
	
	$wp_customize->add_panel( 'coodesoft', array(
		'title' => __( 'Coodesoft Panel', 'textdomain' ),
		'description' => __( 'Aqui podemos mostrar un mensaje', 'textdomain' ),
		'priority' => 160,
		'capability' => 'edit_theme_options',
	));
	
	$content = get_pages();
	
	foreach($content as $key => $page){
			
			$wp_customize->add_section( 'page_'.$page->ID , array(
				'title' => __( $page->post_title, 'textdomain' ),
				'panel' => 'coodesoft',
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
	
}
