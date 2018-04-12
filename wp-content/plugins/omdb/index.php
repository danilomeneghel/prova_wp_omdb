<?php
/*
Plugin Name: OMDB API
Plugin URI: http://wordpress.org
Description: This plugin consists of a movie query system using OMDB Web Service.
Author: Danilo Meneghel
Version: 1.0
Author URI:
License: GPLv2
*/

// Register the css
add_action( 'wp_enqueue_scripts', 'omdb_style');

// Register the js
add_action( 'wp_enqueue_scripts', 'omdb_script');
add_action( 'wp_enqueue_scripts', 'check_shortcode_existence');

/**
 * A function to register the stylesheet
 * @return [type] [description]
 */
function omdb_style()
{
    wp_register_style( 'bootstrap-style', plugins_url('/css/bootstrap.min.css', __FILE__) );
    wp_enqueue_style( 'bootstrap-style' );
	
	wp_register_style( 'omdb-style', plugins_url('/css/omdb.css', __FILE__) );
    wp_enqueue_style( 'omdb-style' );
	
	wp_register_style( 'pagination-style', plugins_url('/css/pagination.css', __FILE__) );
    wp_enqueue_style( 'pagination-style' );
}

/**
 * A function to register the script
 * @return [type] [description]
 */
function omdb_script()
{
	wp_register_script( 'url-script', 'url' );
	wp_enqueue_script( 'url-script' );
	wp_localize_script( 'url-script', 'pluginUrl', array( 'dir' => plugin_dir_url( __FILE__ ) ) );
	
	wp_register_script( 'bootstrap-script', plugins_url('/js/bootstrap.min.js', __FILE__), array( 'jquery' ) );
    wp_enqueue_script( 'bootstrap-script' );
	
	wp_register_script( 'omdb-movies-script', plugins_url('/js/omdb-movies.js', __FILE__), array( 'jquery' ));
    wp_enqueue_script( 'omdb-movies-script' );
}

function check_shortcode_existence() {
    global $post;
    if( has_shortcode( $post->post_content, 'omdb_favorites') && !is_admin() ) {
        wp_register_script( 'pagination-script', plugins_url('/js/pagination.min.js', __FILE__), array( 'jquery' ) );
		wp_enqueue_script( 'pagination-script' );
		
		wp_register_script( 'omdb-favorites-script', plugins_url('/js/omdb-favorites.js', __FILE__), array( 'jquery' ) );
		wp_enqueue_script( 'omdb-favorites-script' );
    }
}

//Create tables
function create_plugin_tables()
{
    include "create_tables.php";
}
register_activation_hook( __FILE__, 'create_plugin_tables' );

function movies_func( $atts, $content = "" ) {
	$content = '<form id="search-movie" onsubmit="return(false)">
				  <label>
					  <input class="form-control" type="text" name="movie" placeholder="Enter title movie" />
				  </label>
				  <button class="btn btn-default">Search</button>
				</form>';
	$content .= '<div id="movies"></div>';
	
	return $content;
}
add_shortcode( 'omdb_movies', 'movies_func' );

function favorites_func( $atts, $content = "" ) {
	$content = '<div id="data-container"></div>';
	$content .= '<div id="pagination-container"></div>';
	
	return $content;
}
add_shortcode( 'omdb_favorites', 'favorites_func' );

function login_form( $atts, $content = null ) {
	extract( shortcode_atts( array(
      'redirect' => ''
      ), $atts ) );
 
	if (!is_user_logged_in()) {
		if($redirect) {
			$redirect_url = $redirect;
		} else {
			$redirect_url = get_permalink();
		}
		$form = wp_login_form(array('echo' => false, 'redirect' => $redirect_url ));
	} 
	return $form;
}
add_shortcode( 'login_form', 'login_form' );

function login_redirect( $atts, $content = null ){
	if (!is_user_logged_in()) {
		$url = site_url('/wp-login.php?action=login&redirect_to='.get_permalink());
        echo '<script>window.location="'.$url.'";</script>';
		exit;
    }
}
add_shortcode('login_redirect', 'login_redirect' );

//Admin Settings
add_action('admin_menu', function() {
    add_options_page( 'OMDB API', 'OMDB API', 'manage_options', 'omdb_api', 'omdb_settings_page' );
});

add_action( 'admin_init', function() {
    register_setting( 'omdb_settings', 'api_url' );
	register_setting( 'omdb_settings', 'api_key' );
});

function omdb_settings_page() {
	include "admin/omdb_api.php";
}
