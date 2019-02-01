<?php
/*
Plugin Name: Coode Team
Plugin URI: http://cu.coodesoft.com.ar
Description: Plugin de Team para OnePage sites.
Version: 1.0
Author: Coodesoft
Author URI: http://coodesoft.com.ar
License: GPL2
*/


define( 'COODETEAM__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'TEAM_PHOTOS_PATH', COODETEAM__PLUGIN_DIR . 'team');
define( 'TEAM_PHOTOS_URL', get_site_url() . '/wp-content/plugins/coode_team/team' );


/*
 * ACTIVACIÓN - Creación de la tabla -----------------------
 */

register_activation_hook( __FILE__, 'coode_team_install' );
function coode_team_install(){
	coode_team_create_table();
}

function coode_team_create_table(){
    global $wpdb;

	$table_name = $wpdb->prefix. 'coode_team_plugin';

    if( $wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name ) {
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $table_name (
            member_id int(10) NOT NULL AUTO_INCREMENT,
            img_path varchar(300) NOT NULL,
            name varchar(100) NOT NULL,
						linkedin varchar(300) NOT NULL,
						mail varchar(100) NOT NULL,
						freelancer varchar(300) NOT NULL,
            PRIMARY KEY  (member_id)
        ) $charset_collate;";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }
}

/*
 * ACTIVACIÓN - Registro de assets -----------------------
 */

wp_register_script('jquery_js', plugins_url('/js/jquery-3.2.1.min.js', __FILE__), [], false, true );
wp_register_script('bootstrap_js', plugins_url('/js/bootstrap.min.js', __FILE__), ['jquery_js'], false, true );
wp_register_script('popper_js', plugins_url('/js/popper.min.js', __FILE__), [], false, true );
//wp_register_script('fontawesome-all', plugins_url('/js/fontawesome-all.js', __FILE__), [], false, true );

add_action('admin_enqueue_scripts', 'add_scripts_deps' );
function add_scripts_deps(){
    wp_enqueue_script( 'jquery_js');
    wp_enqueue_script( 'popper_js' );
    wp_enqueue_script( 'bootstrap_js');
    //wp_enqueue_script( 'fontawesome-all' );
}

add_action('admin_enqueue_scripts', 'add_stylesheet_deps' );
function add_stylesheet_deps($hook){
	if($hook != 'toplevel_page_global_coode_team')  return;
	wp_enqueue_style( 'bootstrap_css',  plugins_url('/css/bootstrap.min.css', __FILE__) );
}


/*
 * ACTIVACIÓN -Integración a Wordpress -----------------------
 */

add_action('admin_menu', 'coode_team_admin_menu');
function coode_team_admin_menu(){
	add_menu_page('Coode Team', 'Coode Team', 'manage_options', 'global_coode_team', 'global_coode_team_content');
}

require_once 'db/CoodeTeam.php';
require_once 'util/helpers.php';
require_once 'admin/templates/team_card.php';
require_once 'admin/ct_admin_area.php';
