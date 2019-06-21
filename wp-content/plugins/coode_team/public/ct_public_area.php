<?php

wp_enqueue_style( 'coode_team_public_css',  plugins_url('/css/coode_team.css', __FILE__));

wp_register_script('fontawesome-all', plugins_url('/js/fontawesome-all.js', __FILE__), [], false, true );
add_action('wp_enqueue_scripts', 'add_scripts_public' );
function add_scripts_public(){
    wp_enqueue_script( 'fontawesome-all' );
}


function cards_html(){
  $cards = CoodeTeam::getAll();
  ?>
  <div id="coode-team-plugin">
    <div class="row">
      <div id="coode-team-title" class="text-center col-12">
        <h3>Equipo</h3>
      </div>
      <div id="coode-team-intro" class="text-center col-12">
        <p>¿Quiénes somos a fin de cuenta?</p>
      </div>
    </div>
    <div class="row">
    <?php foreach ($cards as $key => $teamMember): ?>
      <div class="col-md-3 col-12">
        <div class="thumb-container">
          <div class="thumb">
            <div class="img-container">
              <img src="<?php echo TEAM_PHOTOS_URL."/".get_file_name($teamMember['img_path'])?>" alt="">
            </div>
          </div>
        </div>
        <div class="member-name">
          <h5><?php echo $teamMember['name'] ?></h5>
        </div>
        <div class="member-social">
          <? if (isset($teamMember['linkedin'])){ ?>
            <a target="_blank" class="member-link" href="https://www.linkedin.com/in/<?php echo $teamMember['linkedin'] ?>">
              <i class="fab fa-linkedin fa-2x"></i>
            </a>
          <?php } ?>
          <? if (isset($teamMember['mail'])){ ?>
            <a class="member-link" href="mailto:<?php echo $teamMember['mail'] ?>">
              <i class="fas fa-envelope-square fa-2x"></i>
            </a>
          <?php } ?>
        </div>
      </div>
    <?php endforeach; ?>
    </div>
  </div>

<?php }


add_shortcode('coode_team', 'coode_team_base');
function coode_team_base($atts){
	return cards_html();
}
