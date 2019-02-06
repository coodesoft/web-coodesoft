<?php

$directorio = dirname( __FILE__ );
require_once $directorio.'/includes/helpers.php';
//require_once $directorio.'/includes/render.php';
require_once $directorio.'/customize/index.php';

//##############################################################################
// Scripts correspondientes al tema
//##############################################################################
wp_register_script('jquery_js', get_stylesheet_directory_uri().'/js/jquery-3.2.1.min.js', [], false, true );
wp_register_script('popper_js', get_stylesheet_directory_uri().'/js/popper.min.js', ['jquery_js'], false, true );
wp_register_script('bootstrap_js', get_stylesheet_directory_uri().'/js/bootstrap.min.js', ['jquery_js'], false, true );
wp_register_script('fontawesome-all', get_stylesheet_directory_uri().'/js/fontawesome-all.js', [], false, true );
wp_register_script('coode', get_stylesheet_directory_uri().'/js/style.js', ['jquery_js'], false, true );

function add_scripts_front(){
    wp_enqueue_script( 'jquery_js ');
    wp_enqueue_script( 'popper_js' );
    wp_enqueue_script( 'bootstrap_js' );
    wp_enqueue_script( 'fontawesome-all' );
    wp_enqueue_script( 'coode' );

}
add_action( 'wp_footer', 'add_scripts_front' );


function create_nav_menu(){
  query_posts(['post_type' => 'page', 'orderby'=>'menu_order', 'order' => 'ASC']);
  global $wp_query;

  $menu_name = 'coode_nav_menu';
  $menu_exists = wp_get_nav_menu_object( $menu_name );

  // If it doesn't exist, let's create it.
  if( !$menu_exists){
      $menu_id = wp_create_nav_menu($menu_name);

      while ( have_posts() ) : the_post();
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' =>  get_the_title(),
            'menu-item-classes' => 'coode_nav_item',
            'menu-item-url' => '#'. strtolower( get_the_title() ),
            'menu-item-status' => 'publish' ));
      endwhile;
  }
}

create_nav_menu();
