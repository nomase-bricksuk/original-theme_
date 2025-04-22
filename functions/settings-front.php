<?php
// * Front-side setting
// * ----------------------------------------
// * ----------------------------------------
// * Shorten the URL to the theme directory
$theme = get_template_directory_uri();
define( 'THEME', $theme );
// * ----------------------------------------
// * Remove unwanted links
remove_action( 'wp_head', 'wp_generator' );								// generator
remove_action( 'wp_head', 'rsd_link' );									// EditURI
remove_action( 'wp_head', 'wlwmanifest_link' );							// wlwmanifest
remove_action( 'wp_head', 'rest_output_link_wp_head' );					// Embed
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );			// Embed
remove_action( 'wp_head', 'wp_oembed_add_host_js' );					// Embed
remove_action( 'wp_head', 'wp_shortlink_wp_head' );						// shortlink
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );			// prevlink nextlink
remove_action( 'wp_head', 'rel_canonical' );							// canonical
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );	// canonical

// * ----------------------------------------
// * Remove emoji links
function remove_dns_prefetch( $hints, $relation_type ){
	if( 'dns-prefetch' === $relation_type ){
		return array_diff( wp_dependencies_unique_hosts(), $hints );
	}
	return $hints;
}
add_filter( 'wp_resource_hints', 'remove_dns_prefetch', 10, 2 );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// * ----------------------------------------
// * Remove img unnecessary tag  attributes
function remove_image_attribute( $html ){
	$html = preg_replace( '/(width|height)="\d*"\s/', '', $html );
	$html = preg_replace( '/srcset=[\'"]([^\'"]+)[\'"]/i', '', $html );
	$html = preg_replace( '/sizes=[\'"]([^\'"]+)[\'"]/i', '', $html );
	$html = preg_replace( '/title=[\'"]([^\'"]+)[\'"]/i', '', $html );
	$html = preg_replace( '/<a href=".+">/', '', $html );
	$html = preg_replace( '/<\/a>/', '', $html );
	return $html;
}
add_filter( 'image_send_to_editor', 'remove_image_attribute', 10 );
add_filter( 'post_thumbnail_html', 'remove_image_attribute', 10 );
// * ----------------------------------------
// * Remove unnecessary styles
/* function disable_gutenberg_wp_enqueue_scripts() {

	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme');
	wp_dequeue_style('classic-theme-styles');
	wp_dequeue_style('wc-block-style');
	wp_dequeue_style('global-styles');

}
add_filter('wp_enqueue_scripts', 'disable_gutenberg_wp_enqueue_scripts', 100); */

?>