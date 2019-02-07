<?php

if ( ! defined( 'WPINC' ) ) {
	die; // If this file is called directly, abort.
}

$option = wp_parse_args( get_option( 'filterable_portfolio' ), array(
	'project_details_text'    => __( 'Project Details', 'filterable-portfolio' ),
	'project_skills_text'     => __( 'Skills Needed:', 'filterable-portfolio' ),
	'project_categories_text' => __( 'Categories:', 'filterable-portfolio' ),
	'project_url_text'        => __( 'Project URL:', 'filterable-portfolio' ),
	'project_date_text'       => __( 'Project Date:', 'filterable-portfolio' ),
	'project_client_text'     => __( 'Client:', 'filterable-portfolio' ),
) );

$id               = get_the_ID();
$client_name      = get_post_meta( $id, '_client_name', true );
$project_url      = get_post_meta( $id, '_project_url', true );
$project_date     = get_post_meta( $id, '_project_date', true );
$project_date     = date_i18n( get_option( 'date_format' ), strtotime( $project_date ) );
$categories       = get_the_terms( $id, 'portfolio_cat' );
$categories_names = is_array( $categories ) ? wp_list_pluck( $categories, 'name' ) : array();
$skills           = get_the_terms( $id, 'portfolio_skill' );
$skills_names     = is_array( $skills ) ? wp_list_pluck( $skills, 'name' ) : array();
$support_archive  = Filterable_Portfolio_Helper::support_archive_template();
?>
<div class="portfolio-meta">
	<?php if ( ! empty( $option['project_details_text'] ) ) { ?>
        <h4 class="portfolio-meta-title"><?php echo esc_html( $option['project_details_text'] ); ?></h4>
	<?php } ?>
    <div class="portfolio-meta-list">
		<?php if ( count( $skills_names ) ) { ?>
            <div class="portfolio-meta-list-item">
                <strong><?php echo esc_html( $option['project_skills_text'] ); ?></strong>
                <p>
					<?php
					if ( $support_archive ) {
						$skills = get_the_term_list( $id, 'portfolio_skill', '', '<br>', '' );
						echo $skills;
					} else {
						foreach ( $skills_names as $name ) {
							echo esc_html( $name ) . '<br>';
						}
					}
					?>
                </p>
            </div>
		<?php } ?>
		<?php if ( count( $categories_names ) ) { ?>
            <div class="portfolio-meta-list-item">
                <strong><?php echo esc_html( $option['project_categories_text'] ); ?></strong>
                <p>
					<?php
					if ( $support_archive ) {
						$skills = get_the_term_list( $id, 'portfolio_cat', '', '<br>', '' );
						echo $skills;
					} else {
						foreach ( $categories_names as $name ) {
							echo esc_html( $name ) . '<br>';
						}
					}
					?>
                </p>
            </div>
		<?php } ?>
		<?php if ( ! empty( $client_name ) ) { ?>
            <div class="portfolio-meta-list-item">
                <strong><?php echo esc_html( $option['project_client_text'] ); ?></strong>
                <p><?php echo esc_html( $client_name ) ?></p>
            </div>
		<?php } ?>
		<?php if ( ! empty( $project_date ) ) { ?>
            <div class="portfolio-meta-list-item">
                <strong><?php echo esc_html( $option['project_date_text'] ); ?></strong>
                <p><?php echo esc_html( $project_date ) ?></p>
            </div>
		<?php } ?>
		<?php if ( ! empty( $project_url ) ) { ?>
            <div class="portfolio-meta-list-item">
                <strong><?php echo esc_html( $option['project_url_text'] ); ?></strong>
                <p>
                    <a target="_blank" href="<?php echo esc_url( $project_url ) ?>" rel="nofollow">
						<?php echo esc_url( $project_url ) ?>
                    </a>
                </p>
            </div>
		<?php } ?>
    </div>
</div>
