<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       h.mahmoodkhah@gmail.com
 * @since      1.0.0
 *
 * @package    Crypto_price
 * @subpackage Crypto_price/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Crypto_price
 * @subpackage Crypto_price/includes
 * @author     Hossein Mahmoodkhah <h.mahmoodkhah@gmail.com>
 */
class Crypto_price_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'crypto_price',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
