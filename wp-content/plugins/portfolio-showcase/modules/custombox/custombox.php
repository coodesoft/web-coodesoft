<?php

function ps_custombox_aseets(){
    wp_enqueue_script( 'ps-custombox', PS_PLUGIN_URL . '/modules/custombox/src/jquery.custombox.js', array('jquery') );
    wp_enqueue_style( 'ps-custombox', PS_PLUGIN_URL . '/modules/custombox/src/jquery.custombox.css' );
}

function ps_custombox_init(){
    ?>
    <script>
	jQuery(function ($) {
            $('.pm-popup').on('click', function ( e ) {
                    var url = this.href;    		 
                    $.fn.custombox( this, {
                        url: url,		
                        effect: 'fadein'
                    });
                e.preventDefault();
            });
	});
    </script>

    <?php
}

add_action('wp_enqueue_scripts', 'ps_custombox_aseets');
add_action('wp_head', 'ps_custombox_init');

