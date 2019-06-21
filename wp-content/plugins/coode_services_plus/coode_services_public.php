<?php

wp_enqueue_style( 'coode_services_public_css',  plugins_url('/css/coode_services.css', __FILE__));

wp_register_script('coode_services_public_js', plugins_url('/js/coode_services.js', __FILE__), ['jquery'], false, true );

add_action('wp_enqueue_scripts', 'add_scripts_coode_services_public' );
function add_scripts_coode_services_public(){
    wp_enqueue_script( 'coode_services_public_js' );
}

const SIZE = 3;


function get_matrix_positions($count){
    switch ($count){
        case 4:
            return [ [0, 1], [1, 2], [2, 1], [1, 0] ];
            break;
        case 5:
            return [ [0, 1], [1, 2], [2, 2], [2, 0], [1, 0]] ;
            break;
        case 6:
            return [ [0, 0], [0, 2], [1, 0], [1, 2], [2, 0], [2, 2] ];
            break;
        case 7:
            return [ [0, 0], [0, 2], [1, 0], [1, 2], [2, 0], [2, 1], [2, 2] ];
            break;
        case 8:
            return [ [0, 0], [0, 1], [0, 2], [1, 0], [1, 2], [2, 0], [2, 1], [2, 2] ];
            break;
        default:
            return [ [0, 1], [1, 2], [2, 1], [1, 0] ];
            break;
    } 
}

function get_services_html_matrix($services){
    $count = count($services);
    $positions = get_matrix_positions($count);
    $matrix = [SIZE][SIZE]; 
    $IDs = [SIZE][SIZE]; 

    for($t=0; $t<$count; $t++){
        $service = $services[$t];
        $dot = $positions[$t];
        $matrix[$dot[0]][$dot[1]] = get_post_meta($service->ID, 'icon', true);
        $IDs[$dot[0]][$dot[1]] = $service->ID;
    }

    $first_service_id = $services[0]->ID;
    for($i=0; $i<SIZE; $i++){ 
        $middle = ( $i == intdiv(SIZE, 2) ) ? 'middle-row-service' : 'side-row-service';
    ?>
       
        <div class="<?php echo $middle?>">
        
           <?php for($t=0; $t<SIZE; $t++){ 
                $cellClass = ($t==1) ? 'central-cell' : 'side-cell'; 
             
                if ( $i==1 && $t==1 ){ ?>
            
                    <div class="s-cell <?php echo $cellClass ?>">
                        <div class="service-hexagon">
                            <?php foreach($services as $key => $service) {
                                $classes = ($first_service_id == $service->ID) ? 'service-excerpt-active' : 'service-excerpt';
                            ?>
                                <span class="<?php echo $classes ?>"><?php echo $service->post_excerpt ?></span>
                            <?php }?>
                        </div>
                    </div>
            
                <?php } else { 
                    $id = $IDs[$i][$t] ? 'service-'.$IDs[$i][$t] : '';
                    $active = ($IDs[$i][$t] == $first_service_id) ? 'service-active' : '';
                ?>
            
                    <div id="<?php echo $id ?>" class="s-cell service-icon <?php echo $cellClass?> <?php echo $active ?>">
                        <i class="icon-element <?php echo $matrix[$i][$t] ?> fa-2x"></i>
                    </div>
                <?php }
           } ?>
        </div>
    <?php }
}
    
function get_services_html_description($services){ 
   
    foreach($services as $key => $service){
        $classes = ($key == 0) ? 'service-description-active' : 'service-description';                                       
    ?>
        
        <div class="<?php echo $classes ?>"><?php echo $service->post_content?></div>
   <?php }
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
        <div class="row service-area-body">
         
            <div class="col-7">
                <?php echo get_services_html_description($services) ?>
            </div>
            <div class="col-5 service-selector">
                <?php echo get_services_html_matrix($services)?>
            </div>
        </div>
      </div>
    <?php
}


add_shortcode( 'coode_services', 'coode_services_func' );
function coode_services_func($atts){
  return coode_service_html();
}
