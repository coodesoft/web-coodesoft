<?php

add_action('customize_register','coode_customize_register');

function coode_customize_register($wp_customize){
/**
 * PANEL: Home page
 *
 * Primero creamos el panel donde alojaremos nuestras opciones.
 */
    $wp_customize->add_panel( 'home_page_template', array(
        'priority' => 100,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __('Coode Settings', TEXTDOMAIN),
        'description' => __('Several settings pertaining my theme', TEXTDOMAIN),
    ) );

/**
 * FIRST SECTION: SERVICES
 *
 * Luego creamos la sección de ejemplo "Servicios"
 */
    $wp_customize->add_section('services', array(
        'priority' => 100,
        'title'    => __('Services section', TEXTDOMAIN),
        'description' => 'The first section',
        'panel' => 'home_page_template'
    ));

    // Con esta función creamos la primera opción. En este caso se llamará "Main section title"
    $wp_customize->add_setting('home_page_image', array(
        'default' => '',
        'type' => 'theme_mod',
    ));
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'image_control', array(
        'label'     => __( 'Featured Home Page Image', 'theme_textdomain' ),
        'section'   => 'services',
        'mime_type' => 'image',
        'settings'  => 'home_page_image',
      )
    ));

/**
 * SECOND SECTION: ABOUT
 *
 * Luego creamos otra sección dentro de nuestro panel principal
 */
    $wp_customize->add_section('about_us', array(
        'priority' => 100,
        'title'    => __('About us section', TEXTDOMAIN),
        'description' => 'The second section',
        'panel' => 'home_page_template'
    ));

    // Y nuevamente agregamos la opción y esta vez con el valor por defecto "Set title"
    $wp_customize->add_setting('second_section_title', array(
        'default' => 'Set title'
    ));
    // Una vez más, agregamos el controlador que será tipo "text" por defecto ya que no lo definimos con la variable "type"
    $wp_customize->add_control('second_section_title_control', array(
        'label'      => __('Main section title', TEXTDOMAIN),
        'section'    => 'about_us',
        'settings'   => 'second_section_title',
    ));
    // Creamos otra sección con un valor "vacío" por defecto
    $wp_customize->add_setting('second_section_text', array(
        'default' => ''
    ));
    // Y nuevamente el controlador tipo "textarea"
    $wp_customize->add_control('second_section_text_control', array(
        'label'      => __('Short description', TEXTDOMAIN),
        'section'    => 'about_us',
        'settings'   => 'second_section_text',
        'type'   => 'textarea',
    ));

}
