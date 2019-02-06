<?php get_header();

  $args = ['post_type' => 'page', 'orderby' => 'menu_order', 'order' => 'ASC'];
  $query = new WP_Query( $args );

?>
  <main id="main_coode">
    <?php
    while ( $query->have_posts() ) : $query->the_post();

      if ($query->post->menu_order == 0 ){
        get_template_part( 'template-parts/content', 'home' );
        Html::navbar();
      } else
        get_template_part( 'template-parts/content', 'page' );

    endwhile; ?>
  </main>

 <?php get_footer(); ?>
