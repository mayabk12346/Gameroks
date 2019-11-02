<?php

/***** Fetch Theme Data *****/

$mh_magazine_lite_data = wp_get_theme('mh-magazine-lite');
$mh_magazine_lite_version = $mh_magazine_lite_data['Version'];
$mh_urbanmag_data = wp_get_theme('mh-urbanmag');
$mh_urbanmag_version = $mh_urbanmag_data['Version'];

/***** Load Google Fonts *****/

function mh_urbanmag_fonts() {
	wp_dequeue_style('mh-google-fonts');
	wp_enqueue_style('mh-urbanmag-fonts', 'https://fonts.googleapis.com/css?family=Muli:300,400,400italic%7cCaudex:400,400italic,700', array(), null);
}
add_action('wp_enqueue_scripts', 'mh_urbanmag_fonts', 11);

/***** Load Stylesheets *****/

function mh_urbanmag_styles() {
	global $mh_magazine_lite_version, $mh_urbanmag_version;
    wp_enqueue_style('mh-magazine-lite', get_template_directory_uri() . '/style.css', array(), $mh_magazine_lite_version);
    wp_enqueue_style('mh-urbanmag', get_stylesheet_uri(), array('mh-magazine-lite'), $mh_urbanmag_version);
    if (is_rtl()) {
		wp_enqueue_style('mh-magazine-lite-rtl', get_template_directory_uri() . '/rtl.css', array(), $mh_magazine_lite_version);
	}
}
add_action('wp_enqueue_scripts', 'mh_urbanmag_styles');

/***** Load Translations *****/

function mh_urbanmag_theme_setup(){
	load_child_theme_textdomain('mh-urbanmag', get_stylesheet_directory() . '/languages');
}
add_action('after_setup_theme', 'mh_urbanmag_theme_setup');

/***** Change Defaults for Custom Header *****/

function mh_urbanmag_custom_colors() {
	remove_theme_support('custom-header');
	add_theme_support('custom-header', array('default-image' => '', 'default-text-color' => 'ffffff', 'width' => 300, 'height' => 100, 'flex-width' => true, 'flex-height' => true));
}
add_action('after_setup_theme', 'mh_urbanmag_custom_colors');

/***** Remove Custom Background Support *****/

function mh_urbanmag_custom_background() {
	remove_theme_support('custom-background');
}
add_action('after_setup_theme', 'mh_urbanmag_custom_background', 11);

/***** Remove Functions from Parent Theme *****/

function mh_urbanmag_remove_parent_functions() {
    remove_action('mh_before_header', 'mh_magazine_boxed_container_open');
    remove_action('mh_after_footer', 'mh_magazine_boxed_container_close');
}
add_action('wp_loaded', 'mh_urbanmag_remove_parent_functions');

/***** Enable Wide Layout *****/

function mh_urbanmag_wide_container_open() {
	echo '<div class="mh-container mh-container-outer">' . "\n";
}
add_action('mh_after_header', 'mh_urbanmag_wide_container_open');

function mh_urbanmag_wide_container_close() {
	mh_before_container_close();
	echo '</div><!-- .mh-container-outer -->' . "\n";
}
add_action('mh_before_footer', 'mh_urbanmag_wide_container_close');

?>