<?php
// * ----------------------------------------
// * Editor shortcode
// * ----------------------------------------
function template_part( $atts, $content = null ){
	$tp_atts = shortcode_atts(array(
	   'path' =>  null,
	), $atts);
	ob_start();
	get_template_part($tp_atts['path']);
	$ret = ob_get_contents();
	ob_end_clean();
	return $ret;
 }
 add_shortcode('template_part', 'template_part');

 ?>