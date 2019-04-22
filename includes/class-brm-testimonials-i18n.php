<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://ernestoarellano.dev
 * @since      1.0.0
 *
 * @package    Brm_Testimonials
 * @subpackage Brm_Testimonials/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Brm_Testimonials
 * @subpackage Brm_Testimonials/includes
 * @author     Ernesto Arellano <ernesto@bigrigmedia.net>
 */
class Brm_Testimonials_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'brm-testimonials',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
