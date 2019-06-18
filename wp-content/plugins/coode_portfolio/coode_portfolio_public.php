<?php 
wp_enqueue_style( 'coode_portfolio_public_css',  plugins_url('/css/coode_portfolio.css', __FILE__));

wp_register_script('coode_portfolio_public_js', plugins_url('/js/coode_portfolio.js', __FILE__), ['jquery'], false, true );
wp_register_script('isotope_coode', plugins_url('/js/isotope.pkgd.min.js', __FILE__), ['jquery'], false, true );


add_action('wp_enqueue_scripts', 'add_scripts_coode_portfolio_public' );
function add_scripts_coode_portfolio_public(){
    wp_enqueue_script( 'coode_portfolio_public_js' );
    wp_enqueue_script( 'isotope_coode' );
}

function coode_portfolio_html(){
	$portfolios = get_posts(['post_type' => 'portfolio', 'orderBy' => 'menu_order', 'order' => 'ASC']);
	$categories = get_terms([
		'taxonomy' => 'coode-categoria',
		'hide_empty' => false,
	]);
	?>
	<div id="coode-portfolio-container">
        <div class="row">
          <div id="service-area-header">
            <h3>Portfolio</h3>

            <p>Nuestros trabajos</p>
          </div>
        </div>
        <div class="row">
			<ul class="coode-categories">
				<li class="category-item" data-id="0">Todos</li>
			<?php foreach($categories as $key => $cat) : ?>
				<li class="category-item" data-id="<?php echo $cat->term_id ?>"><?php echo $cat->name ?></li>
			<?php endforeach; ?>
			</ul>
        </div>
        <div class="porftolio-elements row">
          <?php foreach ($portfolios as $key => $portfolio): ?>
            <?php $link = get_post_meta($portfolio->ID, 'link', true);?>
            <?php  $attachImage = get_the_post_thumbnail($portfolio->ID, ['200', '200']);?>
            <div class="portfolio-wrapper col-md-4 sol-sm-6 col-12">
				<div class="portfolio-image">
					<?php echo $attachImage?>
				</div>
				<div class="portfolio-cover"></div>
				<div class="portfolio-content">
					<div class="portfolio-title"><?php echo strtoupper($portfolio->post_title) ?> </div>
					<a href="<?php echo $link ?>" target="_blank">
						<i class="far fa-link"></i>
					</a>
				</div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
	
<?php } ?>



<?php
add_shortcode( 'coode_portfolio', 'coode_portfolio_func' );
function coode_portfolio_func($atts){
  return coode_portfolio_html();
}

add_action('wp_ajax_nopriv_coode_filter_portfolio', 'coode_filter_portfolio');
function coode_filter_portfolio(){

	$category = $_POST['category'];
	$category = intval($category);

	if (!$category)
		$portfolios = get_posts(['post_type' => 'portfolio', 'orderBy' => 'menu_order', 'order' => 'ASC']);
	else
		$portfolios = get_posts(['post_type' => 'portfolio', 
								 'orderBy' => 'menu_order', 
								 'order' => 'ASC',
								 'tax_query' => [
										[
											'taxonomy' => 'coode-categoria',
											'field' => 'id',
											'terms' => $category,
										]
									]
								]);
	
	
	foreach ($portfolios as $key => $portfolio): ?>
            <?php $link = get_post_meta($portfolio->ID, 'link', true);?>
            <?php  $attachImage = get_the_post_thumbnail($portfolio->ID, ['200', '200']);?>
            <div class="portfolio-wrapper col-md-4 sol-sm-6 col-12">
				<div class="portfolio-image">
					<?php echo $attachImage?>
				</div>
				<div class="portfolio-cover"></div>
				<div class="portfolio-content">
					<div class="portfolio-title"><?php echo strtoupper($portfolio->post_title) ?> </div>
					<a href="<?php echo $link ?>" target="_blank">
						<i class="far fa-link"></i>
					</a>
				</div>
            </div>
    <?php endforeach; 
    
    wp_die(); 
}
