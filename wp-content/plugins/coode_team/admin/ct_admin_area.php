<?php

wp_register_script('ct_admin', plugins_url('/js/ct_admin.js', __FILE__), ['jquery_js'], false, true );
add_action('admin_enqueue_scripts', 'add_ascripts_admin' );
function add_ascripts_admin(){
    wp_enqueue_script( 'ct_admin');
}

function global_coode_team_content(){
	$screen =  get_current_screen();
	$pluginPageUID = $screen->parent_file;

  $storedCards = CoodeTeam::getAll();
  ?>
  <div id="coodeTeamPanel" class="wrap">
    <h4 class="panel-title">Crea las tarjetas de presentación de tu equipo!</h4>
    <div class="panel-body">
		<div class="row">
			<div class="col-12">
				<button id="newCardButton" type="button" class="btn btn-dark">Nueva Tarjeta</button>
			</div>
      <div class="col-12 ct_result d-none alert"></div>
  		<div id="coodeCardContainer" class="col-12">
  			<div class="row">
          <?php foreach ($storedCards as $key => $card): ?>
              <?php the_team_card($card); ?>
          <?php endforeach; ?>
  			</div>
  		</div>
	</div>

    </div>
  </div>

<?php
}


function updateTeamCard($uid, $teamMember){
	$stored = CoodeTeam::getById($uid);
	if ( is_uploaded_file($_FILES['photo']['tmp_name']) ){
		$photo = $_FILES['photo'];
		if ( unlink( $stored['img_path'] ) && move_uploaded_file($photo['tmp_name'], TEAM_PHOTOS_PATH . '/'. $photo['name']) ){
			$toSave['img_path'] = TEAM_PHOTOS_PATH . '/'. $photo['name'];

			if ( isset($teamMember['name']) )
				$toSave['name'] = $teamMember['name'];

			if ( isset($teamMember['email']) )
				$toSave['mail'] = $teamMember['email'];

			if ( isset($teamMember['linkedin']) )
				$toSave['linkedin'] = isset($teamMember['linkedin']) ? $teamMember['linkedin'] : '';

			if ( isset($teamMember['freelancer']) )
				$toSave['freelancer'] = isset($teamMember['freelancer']) ? $teamMember['freelancer'] : '';

			return CoodeTeam::update($toSave, $teamMember['uid']);
		}
	}
	return null;
}


add_action( 'wp_ajax_ct_create_team_card', 'ct_save_team_card' );
function ct_save_team_card(){
	$teamMember = $_POST['TeamMember'];

	$photo = $_FILES['photo'];
	if (move_uploaded_file($photo['tmp_name'], TEAM_PHOTOS_PATH . '/'. $photo['name'])){
			$toSave['img_path'] = TEAM_PHOTOS_PATH . '/'. $photo['name'];
			$toSave['name'] = $teamMember['name'];
			$toSave['mail'] = $teamMember['email'];
			$toSave['linkedin'] = isset($teamMember['linkedin']) ? $teamMember['linkedin'] : '';
			$toSave['freelancer'] = isset($teamMember['freelancer']) ? $teamMember['freelancer'] : '';

			$result = CoodeTeam::add($toSave);
			$response = ['uid' => $result,
					 'status' => $result>0 ? 'success' : 'danger',
					 'msg'    => $result>0 ? 'La tarjeta se creó exitosamente! (:' : 'Algo se rompió al intentar crear la tarjeta  ):'
					];

	} else {
			$response = ['uid' => 0,
						 'status' => 'danger',
						 'msg'    => 'Hay algo mal que no anda bien ):. No se pudo guardar la imágen en el servidor ',
						];
	}

	echo json_encode($response);
	wp_die();
}


add_action( 'wp_ajax_ct_delete_team_card', 'ct_delete_team_card' );
function ct_delete_team_card(){
	$toDelete = intval($_POST['uid']);
	if ($toDelete > 0){
		$result = CoodeTeam::del($toDelete);
		$response = ['result' => $result, 'uid' => $toDelete ];
	} else{
		$response = ['result' => false, 'uid' => toDelete ];
	}

	echo json_encode($response);
	wp_die();
}
