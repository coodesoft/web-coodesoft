<?php

$directorio = dirname( __FILE__ );
require_once $directorio.'/includes/helpers.php';

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



function coode_prepare_content(){
  $content = get_pages();
  return coode_build_sections($content);
}

function coode_build_sections($content){
  $menu_items = [];
  $sections = [];
  foreach ($content as $key => $page) {
    $menu_items[] = [ 'name' => get_the_title($page), 'order' => $page->menu_order ];
    $sections[]   = [ 'content' => $page->post_content, 'order' => $page->menu_order ];
  }



  return [ 'menu_items' => coode_sort_by_orderAttr($menu_items),
           'content' => coode_sort_by_orderAttr($sections)];
}

function coode_sort_by_orderAttr($collection){
  usort($collection, function($A, $B){
      if ($A['order'] == $B['order']) return 0;
      return ($A['order'] < $B['order']) ? -1 : +1;
    });
  return $collection;
}
