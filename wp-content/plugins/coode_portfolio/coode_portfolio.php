<?php

/**
 * @package CoodePortfolio
 */
/*
Plugin Name: Coode Portfolio
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


add_action( 'init', 'coode_portfolio_event_type', 0 );
function coode_portfolio_event_type() {
    register_post_type( 'portfolio', array(
      'labels' => array(
        'name' => 'Portfolios',
        'singular_name' => 'Portfolio',
       ),
      'description' => 'Potfolio de una empresa',
      'public' => true,
      'menu_position' => 20,
      'taxonomies' => array( 'coode-categoria' ),
      'supports' => array( 'title', 'editor', 'custom-fields', 'thumbnail', 'page-attributes')
    ));
}

add_action( 'init', 'coode_add_coode_cateroy', 0 );
function coode_add_coode_cateroy(){

	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Categorías', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Coode Categoría', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Buscar Coode Categorías', 'textdomain' ),
		'all_items'         => __( 'Todas las Coode Categorías ', 'textdomain' ),
		'edit_item'         => __( 'Editar Coode Categoría', 'textdomain' ),
		'update_item'       => __( 'Actualizar Coode Categorías', 'textdomain' ),
		'add_new_item'      => __( 'Agregar nueva', 'textdomain' ),
		'new_item_name'     => __( 'Nuevo nombre de Coode Categoría', 'textdomain' ),
		'menu_name'         => __( 'Coode Categoría', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'coode-categoria' ),
	);

	register_taxonomy( 'coode-categoria', array( 'portfolio' ), $args );

}

add_action('wp_head', 'coode_portfolio_ajaxurl');
function coode_portfolio_ajaxurl() {
    echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}


require_once 'coode_portfolio_public.php';

