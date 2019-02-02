<?php get_header(); 


?>
<body>
  <div>
    <?php
      $stored = coode_prepare_content();
      foreach ($stored['content'] as $key => $page) {
		
        if ($key == 1){
			echo Html::navbar($stored['menu_items']);
		}

		if ($key == 0){
			echo Html::home_section($page['content'], $page['id'], ['id' => $page['webId'] ]);
        } else{
			echo Html::section($page['content'], $page['id'], ['id' => $page['webId'] ]);
			}
      }

    ?>
    <?php get_footer(); ?>
