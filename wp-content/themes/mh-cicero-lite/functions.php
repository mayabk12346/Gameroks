<?php

/***** Fetch Theme Data & Options *****/

$mh_cicero_lite_data = wp_get_theme('mh_cicero_lite');
$mh_cicero_lite_version = $mh_cicero_lite_data['Version'];
$mh_cicero_lite_options = get_option('mh_cicero_lite_options');

/***** Custom Hooks *****/

function mh_cicero_lite_after_header() {
    do_action('mh_cicero_lite_after_header');
}
function mh_cicero_lite_before_page_content() {
    do_action('mh_cicero_lite_before_page_content');
}

/***** Theme Setup *****/

if (!function_exists('mh_cicero_lite_themes_setup')) {
	function mh_cicero_lite_themes_setup() {
		if (!isset($content_width))
			$content_width = 610;
		load_theme_textdomain('mh-cicero-lite', get_template_directory() . '/languages');
		add_filter('use_default_gallery_style', '__return_false');
		add_post_type_support('page', 'excerpt');
		add_theme_support('custom-header', array('default-image' => '', 'default-text-color' => 'fff', 'width' => 200, 'height' => 30, 'flex-width' => true, 'flex-height' => true));
		add_theme_support('title-tag');
		add_theme_support('automatic-feed-links');
		add_theme_support('custom-background', array('default-color' => '#f6f5f2'));
		add_theme_support('post-thumbnails');
		add_theme_support('customize-selective-refresh-widgets');
		add_image_size('large-thumb', 610, 343, true);
		add_image_size('small-thumb', 70, 70, true);
		register_nav_menus(array('main_nav' => esc_html__('Main Navigation', 'mh-cicero-lite')));
	}
}
add_action('after_setup_theme', 'mh_cicero_lite_themes_setup');

/***** Load CSS & JavaScript *****/

if (!function_exists('mh_cicero_lite_scripts')) {
	function mh_cicero_lite_scripts() {
		global $mh_cicero_lite_version;
		wp_enqueue_style('mh-google-fonts', "https://fonts.googleapis.com/css?family=Open+Sans:300,400,400italic,600,700", array(), null);
		wp_enqueue_style('mh-font-awesome', get_template_directory_uri() . '/includes/font-awesome.min.css', array(), null);
		wp_enqueue_style('mh-style', get_stylesheet_uri(), false, $mh_cicero_lite_version);
		wp_enqueue_script('mh-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), $mh_cicero_lite_version);
		if (is_singular() && comments_open() && get_option('thread_comments') == 1) {
			wp_enqueue_script('comment-reply');
		}
	}
}
add_action('wp_enqueue_scripts', 'mh_cicero_lite_scripts');

if (!function_exists('mh_cicero_lite_admin_scripts')) {
	function mh_cicero_lite_admin_scripts($hook) {
		if ('appearance_page_cicero' === $hook || 'widgets.php' === $hook) {
			wp_enqueue_style('mh-admin', get_template_directory_uri() . '/admin/admin.css');
		}
	}
}
add_action('admin_enqueue_scripts', 'mh_cicero_lite_admin_scripts');

/***** Register Widget Areas / Sidebars	*****/

if (!function_exists('mh_cicero_lite_widgets_init')) {
	function mh_cicero_lite_widgets_init() {
		register_sidebar(array('name' => esc_html__('Sidebar', 'mh-cicero-lite'), 'id' => 'sidebar', 'description' => esc_html__('Sidebar on Posts/Pages.', 'mh-cicero-lite'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s"><div class="widget-content">', 'after_widget' => '</div></div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
	}
}
add_action('widgets_init', 'mh_cicero_lite_widgets_init');

/***** Include Several Functions *****/

require_once('includes/mh-customizer.php');
require_once('includes/mh-custom-functions.php');
require_once('includes/mh-widgets.php');

if (class_exists('Jetpack')) {
	require_once('includes/mh-jetpack.php');
}

if (is_admin()) {
	require_once('admin/admin.php');
}

?>