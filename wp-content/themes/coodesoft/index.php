<?php get_header();

  $args = ['post_type' => 'page', 'orderby' => 'menu_order', 'order' => 'ASC'];
  $query = new WP_Query( $args );

?>
  <main id="main_coode">
    <?php
    while ( $query->have_posts() ) : $query->the_post();

      if ($query->post->menu_order == 0 ){
        get_template_part( 'template-parts/content', 'home' );
        ?>
        <div id="explore"></div>
        <?php
        wp_nav_menu(['name' => 'coode_nav_menu']);
      } else
        get_template_part( 'template-parts/content', 'page' );

    endwhile; ?>
  </main>

 <?php get_footer(); ?>
