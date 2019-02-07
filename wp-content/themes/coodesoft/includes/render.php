<?php

class Html{


  static function navbar(){

    query_posts(['post_type' => 'page', 'orderby'=>'menu_order', 'order' => 'ASC']); ?>
    <div id="explore">
      <nav id="main_menu" class="navbar navbar-expand-lg navbar-light bg-light center-margin">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu-coode_nav_menu-container">
          <ul class="center-margin navbar-nav mr-auto" id="menu-coode_nav_menu">
          <?php while ( have_posts() ) : the_post(); ?>
            <li class="nav-item">
              <a class="nav-link" href="#<?php echo strtolower(get_the_title())?>"><?php echo strtoupper(get_the_title()) ?></a>
            </li>
          <?php endwhile; ?>
          </ul>
        </div>
      </nav>
  	</div>
    <?php
  }
}
