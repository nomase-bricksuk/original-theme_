<?php
// * ----------------------------------------
// * Admin settings
// * ----------------------------------------
// * ----------------------------------------
// * Applying CSS for the admin panel
function admin_load_style(){
	wp_register_style( 'custom_wp_admin_css', get_stylesheet_directory_uri(). '/assets/css/admin-style.css', false, '1.0.0' );
	wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'admin_load_style' );

// * ----------------------------------------
// * Add copyright
function admin_footer_link(){
	echo '© <a href="https://bricksuk.biz/" target="_blank">Bricks&Uk</a>';
}
add_filter( 'admin_footer_text', 'admin_footer_link' );

// * ----------------------------------------
// * Customize wysiwyg
// * Remove and add functions
function admin_change_wysiwyg_btn( $buttons ){
	$remove = 'wp_more'; // Delete
	if( ( $key = array_search( $remove, $buttons ) ) !== false ){ unset( $buttons[ $key ] ); }
	array_push( $buttons, 'underline' ); // Add
	return $buttons;
}
add_filter( 'mce_buttons','admin_change_wysiwyg_btn' );

// * Disable wysiwyg conversion function
function admin_change_wysiwyg( $init_array ){
	global $allowedposttags;
	$init_array[ 'valid_elements' ] = '*[*]';
	$init_array[ 'extended_valid_elements' ] = '*[*]';
	$init_array[ 'valid_children' ] = '+a[' .implode( '|', array_keys( $allowedposttags ) ). ']';
	$init_array[ 'indent' ] = true;
	$init_array[ 'wpautop' ] = false;
	$init_array[ 'force_p_newlines' ] = false;
	return $init_array;
}
add_filter( 'tiny_mce_before_init', 'admin_change_wysiwyg' );

// * ----------------------------------------
// * Customize the admin bar
function admin_remove_admin_bar( $wp_admin_bar ){
	$wp_admin_bar->remove_menu( 'wp-logo' ); // Hide wp logo
}
add_action( 'admin_bar_menu', 'admin_remove_admin_bar', 70 );

function admin_add_admin_bar(){
	global $wp_admin_bar;
	$wp_admin_bar->add_menu( array(
		'id' => 'new_item_in_admin_bar',
		'title' => __( 'ログアウト' ),
		'href' => wp_logout_url(),
		'meta' => array(
			'class' => 'ab-top-secondary'
		)
	) );
}
add_action( 'wp_before_admin_bar_render', 'admin_add_admin_bar' );

// * ----------------------------------------
// * Hide the header menu
function admin_remove_head_navi(){
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'comments' );			// Comment
	$wp_admin_bar->remove_menu( 'new-content' );		// Add New Button
	//$wp_admin_bar->remove_node( 'view-site' );		// View Site
	$wp_admin_bar->remove_node( 'view' ); 			// Post Views
	$wp_admin_bar->remove_node( 'customize' ); 		// Customize
}
add_action( 'admin_bar_menu', 'admin_remove_head_navi', 99 );

// * ----------------------------------------
// * Hide the side navigation
function admin_remove_side_navi(){
	remove_menu_page( 'edit.php' );					// Submission
	remove_menu_page( 'link-manager.php' );			// Link
	remove_menu_page( 'edit-comments.php' );			// Comment

	global $submenu;
	// var_dump( $submenu );
	remove_submenu_page( 'themes.php', 'customize.php?return=%2Fwp-admin%2Fthemes.php' );// Customize Appearance
}
add_action( 'admin_init', 'admin_remove_side_navi' );

// * ----------------------------------------
// * Customize the dashboard
// * Widget hide
function admin_remove_dashboard(){
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );		// Quick Draft
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );			// WordPress News
}
add_action( 'wp_dashboard_setup', 'admin_remove_dashboard' );

// * Added widget overview
function admin_add_dashboard_outline(){
	$args = array( 'public' => true, '_builtin' => false );
	$output = 'object';
	$operator = 'and';

	$post_types = get_post_types( $args, $output, $operator );
	foreach( $post_types as $post_type ){
		$num_posts = wp_count_posts( $post_type->name );
		$num = number_format_i18n( $num_posts->publish );
		$text = _n( $post_type->labels->singular_name, $post_type->labels->name, intval( $num_posts->publish ) );
		if( current_user_can('edit_posts') ){
			$output = '<a href="edit.php?post_type=' .$post_type->name. '">' .$num. '件の' .$text. '</a>';
		}
		echo '<li class="post-count ' .$post_type->name. '-count">' .$output. '</li>';
	}
}
add_action( 'dashboard_glance_items', 'admin_add_dashboard_outline' );

// * ----------------------------------------
// * [Fixed Page] Visual Editor (Hide Visual)
//function admin_disable_editor(){
//	global $typenow;
//	if( $typenow == 'page' ){
//		add_filter( 'user_can_richedit', 'admin_disable_editor_filter' );
//	}
//}
//function admin_disable_editor_filter(){
//	return false;
//}
//add_action( 'load-post.php', 'admin_disable_editor' );
//add_action( 'load-post-new.php', 'admin_disable_editor' );

// * ----------------------------------------
// * Disable the selection of attachments
function media_script_buffer_start(){
	ob_start();
}
add_action( 'post-upload-ui', 'media_script_buffer_start' );

function media_script_buffer_get(){
	$scripts = ob_get_clean();
	$scripts = preg_replace( '#<option value="post">.*?</option>#s', '', $scripts );
	echo $scripts;
}
add_action( 'print_media_templates', 'media_script_buffer_get' );

// * ----------------------------------------
// * Remove h1 from wysiwyg
function custom_editor_settings( $initArray ){
	$initArray[ 'block_formats '] = '見出し2=h2;見出し3=h3;見出し4=h4;見出し5=h5;見出し6=h6;段落=p;';
	return $initArray;
}
add_filter( 'tiny_mce_before_init', 'custom_editor_settings' );

// * ----------------------------------------
// * Specifying the display items and display style of the article list
function admin_add_posts_columns( $columns ){
	$columns[ 'thumbnail' ] = 'サムネイル';
	$columns[ 'postid' ] = 'ID';
	return $columns;
}
function admin_add_posts_columns_row( $column_name, $post_id ){
	if( 'thumbnail' == $column_name ){
		$thumb = get_the_post_thumbnail( $post_id, array( 130, 87 ), 'preview' );
		echo ( $thumb ) ? $thumb : '－';
	} elseif( 'postid' == $column_name ){
		echo $post_id;
	}
}
add_filter( 'manage_posts_columns', 'admin_add_posts_columns' );
add_action( 'manage_posts_custom_column', 'admin_add_posts_columns_row', 10, 2 );

?>