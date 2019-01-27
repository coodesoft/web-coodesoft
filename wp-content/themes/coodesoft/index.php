<?php get_header(); 


?>
<body>
  <div class="container-fluid">
    <?php
      $stored = coode_prepare_content();
      foreach ($stored['content'] as $key => $page) {
		
        if ($key == 1)
          echo Html::navbar($stored['menu_items']);

        echo Html::section($page['content'], $page['webId'], $page['id']);

      }

    ?>
    <?php get_footer(); ?>
