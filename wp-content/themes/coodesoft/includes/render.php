<?php

class Html{


  static function navbar($content){ ?>
  <div id="explore">
    <nav id="main_menu" class="navbar navbar-expand-lg navbar-light bg-light center-margin">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="center-margin navbar-nav mr-auto">
        <?php
          foreach ($content as $key => $item): ?>
          <li class="nav-item">
            <a class="nav-link" href="#<?php echo strtolower($item['name'])?>"><?php echo strtoupper($item['name']) ?></a>
          </li>
        <?php endforeach; ?>
        </ul>
      </div>
    </nav>
	</div>
  <?php
  }

  static function home_section($content, $entityId, $args = null){ ?>
  	<?php 
		$theme_mod_background = get_theme_mod('background_'.$entityId);
		$theme_mod_home_logo = get_theme_mod('home_image_setting');
		$id = $args ? $args['id'] : '';
	?>
	  <section id="<?php echo $id?>">
			<div id="home_page" class="wrapper-page" style="background: url(<?php echo $theme_mod_background ?>) no-repeat center">
				<div class="cover-page">
					<div class="container">
						
						<div class="home_image">
						<!--	<div class="home_image_cover"></div> -->
							<div class="home_image_wrapper col-sm-5 col-8">
								<img src="<?php echo $theme_mod_home_logo ?>" alt="home page main image" />
							</div>
						</div>
						
						<div class="home_content">
							<?php echo $content; ?>
						</div>
						<div class="home_link">
							<a href="#explore">
								<i class="far fa-angle-double-down fa-2x"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>
  <?php
  }

  static function section($content, $entityId, $args = null){ ?>
	<?php 
		$mod = get_theme_mod('background_'.$entityId);
		$id = $args ? $args['id'] : '';
	?>
    <section id="<?php echo $id?>">
		<div class="wrapper-page" style="background: url(<?php echo $mod ?>) no-repeat center">
			<div class="cover-page">
				<div class="container content-page">
					<?php echo $content; ?>
				</div>
			</div>
		</div>
    </section>
  <?php
  }
}
