<?php

wp_register_script('ct_admin', plugins_url('/js/ct_admin.js', __FILE__), ['jquery_js'], false, true );
add_action('admin_enqueue_scripts', 'add_ascripts_admin' );
function add_ascripts_admin(){
    wp_enqueue_script( 'ct_admin');
}

function global_coode_team_content(){
	$screen =  get_current_screen();
	$pluginPageUID = $screen->parent_file;
  ?>
  <div id="customUploadPanel" class="wrap">
    <h4 class="panel-title">Crea las tarjetas de presentación de tu equipo!</h4>
    <div class="panel-body">
		<div class="row">
			<div class="col-12">
				<button id="newCardButton" type="button" class="btn btn-dark">Nueva Tarjeta</button>
			</div>
		<div id="coodeCardContainer" class="col-12"><div class="row"></div></div>
	</div>	

    </div>
  </div>

<?php
}