<?php
function Wpc_short_codes(){

   function shortcode_fx($attr, $content) {
	   return '';
   }

   function shortcode_logo($attr) {
	   return '';
   }

   add_shortcode('wpc_fx', 'shortcode_fx');
   add_shortcode('wpc_logo', 'shortcode_logo');
}

 ?>
