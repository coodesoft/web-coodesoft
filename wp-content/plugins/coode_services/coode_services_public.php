<?php

wp_enqueue_style( 'coode_services_public_css',  plugins_url('/css/coode_services.css', __FILE__));

wp_register_script('coode_services_public_js', plugins_url('/js/coode_services.js', __FILE__), ['jquery'], false, true );

add_action('wp_enqueue_scripts', 'add_scripts_coode_services_public' );
function add_scripts_coode_services_public(){
    wp_enqueue_script( 'coode_services_public_js' );
}

function coode_service_html(){
    $services = get_posts(['post_type' => 'service', 'orderBy' => 'menu_order', 'order' => 'ASC']);
    ?>
      <div id="coode-services-container">
        <div class="row">
          <div id="service-area-header">
            <h3>Servicios</h3>

            <p>¿Qué servicios ofrecemos?</p>
          </div>
        </div>
        <div class="row">
          <?php foreach ($services as $key => $service): ?>
            <? $icon = get_post_meta($service->ID, 'icon', true);?>
            <div class="service col-md-3 sol-sm-6 col-12">
                <div class="service-hexagon"></div>
                <div class="service-content">
                    <div class="service-icon">
                      <i class="icon-element <?php echo $icon ?>"></i>
                    </div>
                    <div class="service-title">
                      <div><?php echo $service->post_title ?></div>
                    </div>
                </div>
                <div class="service-description service-hidden">
                  <div class="service-description-content">
                      <?php echo $service->post_content ?>
                  </div>
                </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php
}


add_shortcode( 'coode_services', 'coode_services_func' );
function coode_services_func($atts){
  return coode_service_html();
}
