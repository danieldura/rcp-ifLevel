<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       danidura.es
 * @since      1.0.0
 *
 * @package    Rcp_Iflevel
 * @subpackage Rcp_Iflevel/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Rcp_Iflevel
 * @subpackage Rcp_Iflevel/includes
 * @author     Dani <danieldura7@gmail.com>
 */
class Rcp_Iflevel_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'rcp-iflevel',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
