<?php
/**
 * The WordPress Plugin Boilerplate.
 *
 * A foundation off of which to build well-documented WordPress plugins that
 * also follow WordPress Coding Standards and PHP best practices.
 *
 * @package   Shortest_Monetization
 * @author    Dawid Chomicz <chomicz@shorte.st>
 * @license   GPL-2.0+
 * @link      https://shorte.st
 * @copyright 2016 Shorte.st
 *
 * @wordpress-plugin
 * Plugin Name:       Shortest Monetization
 * Plugin URI:        http://wordpress.org/plugins/shortest-website-monetization
 * Description:       Shortest way to monetize your traffic
 * Version:           1.2.0
 * Author:            Shortest Team
 * Author URI:        shortes_team
 * Text Domain:       en
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once( plugin_dir_path( __FILE__ ) . 'class-shortest-monetization.php' );
require_once( plugin_dir_path( __FILE__ ) . 'class-shortest-monetization-admin.php' );

if( !class_exists( 'WP_Http' ) )
    include_once( ABSPATH . WPINC. '/class-http.php' );

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 *
 */
register_activation_hook( __FILE__, array( 'Shortest_Monetization', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Shortest_Monetization', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'Shortest_Monetization', 'get_instance' ) );
add_action( 'plugins_loaded', array( 'Shortest_Monetization_Admin', 'get_instance' ) );
