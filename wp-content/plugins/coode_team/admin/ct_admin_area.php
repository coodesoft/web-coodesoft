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
  <div id="coodeTeamPanel" class="wrap">
    <h4 class="panel-title">Crea las tarjetas de presentación de tu equipo!</h4>
    <div class="panel-body">
		<div class="row">
			<div class="col-12">
				<button id="newCardButton" type="button" class="btn btn-dark">Nueva Tarjeta</button>
			</div>
		<div id="coodeCardContainer" class="col-12">
			<div class="row"></div>
		</div>
	</div>	

    </div>
  </div>

<?php
}
add_action( 'wp_ajax_ct_create_team_card', 'ct_create_team_card' );
function ct_create_team_card(){

	$photo = $_FILES['photo'];
	if (move_uploaded_file($photo['tmp_name'], TEAM_PHOTOS_PATH . '\\'. $photo['name'])){
		$teamMember = $_POST['TeamMember'];
		$toSave['img_path'] = TEAM_PHOTOS_PATH . '\\'. $photo['name'];
		$toSave['name'] = $teamMember['name'];
		$toSave['mail'] = $teamMember['email'];
		$toSave['linkedin'] = isset($teamMember['linkedin']) ? $teamMember['linkedin'] : '';
		$toSave['freelancer'] = isset($teamMember['freelancer']) ? $teamMember['freelancer'] : '';
		
		$result = CoodeTeam::add($toSave);
		echo json_encode($result);
	} else {
		echo false;
	}	
	
	wp_die();
}