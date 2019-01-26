<?php

$directorio = dirname( __FILE__ );
require_once $directorio.'/includes/helpers.php';
require_once $directorio.'/includes/render.php';
require_once $directorio.'/customize/index.php';

//##############################################################################
// Scripts correspondientes al tema
//##############################################################################
wp_register_script('jquery_js', get_template_directory_uri().'/js/jquery-3.2.1.min.js', [], false, true );
wp_register_script('bootstrap_js', get_template_directory_uri().'/js/bootstrap.min.js', [], false, true );
wp_register_script('popper_js', get_template_directory_uri().'/js/popper.min.js', [], false, true );
wp_register_script('fontawesome-all', get_template_directory_uri().'/js/fontawesome-all.js', [], false, true );

function add_scripts_front(){
    wp_enqueue_script( 'jquery_js');
    wp_enqueue_script( 'popper_js' );
    wp_enqueue_script( 'bootstrap_js');
    wp_enqueue_script( 'fontawesome-all' );
}
add_action( 'wp_footer', 'add_scripts_front' );
