<?php

/**
 * @package CoodeServices
 */
/*
Plugin Name: Coode Services
Description: Plugin para listar los servicios que una empresa ofrece
Version: 4.1
Author: Coodesoft Team
Author URI: https://www.coodesoft.com.ar
License: GPLv2 or later
Text Domain: skirmisher
*/


// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}


add_action( 'init', 'coode_service_event_type', 0 );
function coode_service_event_type() {
    register_post_type( 'service', array(
      'labels' => array(
        'name' => 'Servicios',
        'singular_name' => 'Servicio',
       ),
      'description' => 'Servicios que una empresa presta',
      'public' => true,
      'menu_position' => 20,
      'supports' => array( 'title', 'editor', 'custom-fields', 'page-attributes')
    ));
}


require_once 'coode_services_public.php';
