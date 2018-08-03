<div class="flex-container">
  <header>
  </header>
  <?php

  get_page($page_id);
  $page_data = get_page($page_id);

  echo ” . $page_data->post_title . ”;

  echo apply_filters(‘the_content’, $page_data->post_content);
?>
</div>
