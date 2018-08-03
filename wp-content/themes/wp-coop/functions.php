<?php
$directorio = dirname( __FILE__ );
require_once $directorio.'/options-framework.php';
require_once $directorio.'/includes/bs4navwalker.php';
require_once $directorio.'/includes/WpcSection.php';
require_once $directorio.'/includes/WpcPodsField.php';
require_once $directorio.'/includes/WpcSectionPodsGrid.php';
require_once $directorio.'/includes/WpcSectionTitle.php';
require_once $directorio.'/includes/Config.php';
require_once $directorio.'/includes/WpcWidgetManager.php';
require_once $directorio.'/includes/WpcShortCodes.php';

////////////////////////////////////////////////////////////////////////////////
// Scripts correspondientes al tema
////////////////////////////////////////////////////////////////////////////////
wp_register_script('jquery_js', get_template_directory_uri().'/js/jquery-3.2.1.min.js', [], false, true );
wp_register_script('bootstrap_js', get_template_directory_uri().'/js/bootstrap.min.js', [], false, true );
wp_register_script('popper_js', get_template_directory_uri().'/js/popper.min.js', [], false, true );
wp_register_script('wp-coop_js', get_template_directory_uri().'/js/wp-coop.js', [], false, true );
wp_register_script('wp-coop_admin_js', get_template_directory_uri().'/js/wp-coop-admin.js', [], false, true );
wp_register_script('fontawesome-all', get_template_directory_uri().'/js/fontawesome-all.js', [], false, true );

function add_scripts_front()
{
    wp_enqueue_script( 'jquery_js');
    wp_enqueue_script( 'popper_js' );
    wp_enqueue_script( 'bootstrap_js');
    wp_enqueue_script( 'fontawesome-all' );
    wp_enqueue_script( 'wp-coop_js' );
}

add_action( 'wp_footer', 'add_scripts_front' );

////////////////////////////////////////////////////////////////////////////////
// Scripts correspondientes a la página de administracion
////////////////////////////////////////////////////////////////////////////////
function add_scripts_admin()
{
  wp_register_script('wp-coop_admin_js', get_template_directory_uri().'/js/wp-coop-admin.js', [], false, true );

  //wp_enqueue_script( 'jquery_js');
  wp_enqueue_script( 'popper_js' );
  wp_enqueue_script( 'wp-coop_admin_js' );
}

add_action( 'admin_init', 'add_scripts_admin' );

////////////////////////////////////////////////////////////////////////////////
// COMENTARIOS
////////////////////////////////////////////////////////////////////////////////
function enable_threaded_comments(){
    if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
       wp_enqueue_script('comment-reply');
    }
}
add_action('get_header', 'enable_threaded_comments');

////////////////////////////////////////////////////////////////////////////////
/////  Zonas de widgets
////////////////////////////////////////////////////////////////////////////////

function wpc_widgets_init() {
  $widgetManager = new WpcWidgetManager;
  $widgetManager->findStaticWidgets(WpcGetSectionsIndexInfo());
  $widgetManager->registerWidgets();
}
add_action( 'widgets_init', 'wpc_widgets_init' );

////////////////////////////////////////////////////////////////////////////////
//opciones del tema
///////////////////////////////////////////////////////////////////////////////
$wpc_opciones = [];

function wpc_css_backend(){
  echo '<link rel="stylesheet" type="text/css" href="'.get_stylesheet_directory_uri().'/css/bootstrap4.css">';
}
//cargamos bootstrap en el backend
add_action('admin_head', 'wpc_css_backend');

function longitud_excerpt($length) {
    return 10;
}
add_filter('excerpt_length', 'longitud_excerpt');
////////////////////////////////////////////////////////////////////////////////
//secciones del tema
///////////////////////////////////////////////////////////////////////////////

function wpc_get_sections($sec){
  foreach ($sec as $v) {
    $seccion = new WpcSection($v);
    $seccion->printHTML();
  }
}

////////////////////////////////////////////////////////////////////////////////
if (function_exists( 'add_theme_support' )){
  add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size(380, 380);
}

Wpc_short_codes();
?>
