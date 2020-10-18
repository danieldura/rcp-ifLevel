<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              danidura.es
 * @since             1.0.0
 * @package           Rcp_Iflevel
 *
 * @wordpress-plugin
 * Plugin Name:       iflevel RCP
 * Plugin URI:        danidura.es
 * Description:       Mostrar en nivel de usuario de Restrint content Pro
 * Version:           1.0.0
 * Author:            Dani
 * Author URI:        danidura.es
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rcp-iflevel
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'RCP_IFLEVEL_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rcp-iflevel-activator.php
 */
function activate_rcp_iflevel() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rcp-iflevel-activator.php';
	Rcp_Iflevel_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rcp-iflevel-deactivator.php
 */
function deactivate_rcp_iflevel() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rcp-iflevel-deactivator.php';
	Rcp_Iflevel_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_rcp_iflevel' );
register_deactivation_hook( __FILE__, 'deactivate_rcp_iflevel' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rcp-iflevel.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_rcp_iflevel() {

	$plugin = new Rcp_Iflevel();
	$plugin->run();

}
run_rcp_iflevel();

function getLevel() {
	if ( function_exists('rcp_get_customer') ) {
		$customer = rcp_get_customer();
	   }
	   if ( $customer ) {
		$membership = rcp_get_membership( $customer->get_id() );
	   }
	   if ( $membership ) {
		$join_date = $membership->get_created_date();
		$level = $membership->get_times_billed();
		return $level;
	   }
	return 1;	
}

function rcp_level_get_level(){
	return getLevel();
}

add_shortcode( 'rcp_level', 'rcp_level_get_level' );

function rcp_level_check_level( $level, $contenido = null ){
	$userLevel = getLevel();
	extract( shortcode_atts( array( 'minlevel' => '1' ), $level ) );

	if ($userLevel >= $minlevel) {
		return 'Tienes un nivel de ' . $userLevel . '<p>' . $contenido . '</p>';
	} else {
		return "<b>¡No tienes el nivel suficiente para acceder al contenido!</b>";
	}	
}
add_shortcode( 'rcp_if_level','rcp_level_check_level' );