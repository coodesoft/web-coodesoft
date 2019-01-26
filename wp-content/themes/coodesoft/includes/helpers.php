<?php



function coode_prepare_content(){
  $content = get_pages();
  return coode_build_sections($content);
}

function coode_build_sections($content){
  $menu_items = [];
  $sections = [];
  foreach ($content as $key => $page) {
    $menu_items[] = [ 'name' => get_the_title($page), 'order' => $page->menu_order ];
    $sections[]   = [ 'id' => strtolower(get_the_title($page)), 'content' => $page->post_content, 'order' => $page->menu_order ];
  }

  return [ 'menu_items' => coode_sort_by_orderAttr($menu_items),
           'content' => coode_sort_by_orderAttr($sections) ];
}

function coode_sort_by_orderAttr($collection){
  usort($collection, function($A, $B){
      if ($A['order'] == $B['order']) return 0;
      return ($A['order'] < $B['order']) ? -1 : +1;
    });
  return $collection;
}
