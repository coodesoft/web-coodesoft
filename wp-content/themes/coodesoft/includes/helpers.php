<?php

class Html{


  static function navbar($content){ ?>

    <nav id="mainMenu" class="navbar navbar-expand-lg navbar-light bg-light">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <?php
          foreach ($content as $key => $item): ?>
          <li class="nav-item">
            <a class="nav-link" href="#<?php echo strtolower($item['name'])?>"><?php echo strtoupper($item['name']) ?></a>
          </li>
        <?php endforeach; ?>
        </ul>
      </div>
    </nav>

  <?php
  }

  static function section($content){

  }
}
