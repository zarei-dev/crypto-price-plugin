<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              h.mahmoodkhah@gmail.com
 * @since             1.0.0
 * @package           Crypto_price
 *
 * @wordpress-plugin
 * Plugin Name:       Crypto Price 
 * Plugin URI:        crypto_price
 * Description:       Live Crypto price
 * Version:           1.0.0
 * Author:            Hossein Mahmoodkhah
 * Author URI:        h.mahmoodkhah@gmail.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       crypto_price
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
 include "autoload.php";
/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CRYPTO_PRICE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-crypto_price-activator.php
 */
function activate_crypto_price() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-crypto_price-activator.php';
	Crypto_price_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-crypto_price-deactivator.php
 */
function deactivate_crypto_price() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-crypto_price-deactivator.php';
	Crypto_price_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_crypto_price' );
register_deactivation_hook( __FILE__, 'deactivate_crypto_price' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-crypto_price.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_crypto_price() {

	$plugin = new Crypto_price();
	$plugin->run();

}

//Register dashboard widget
dashboard_widget::latest_price();

//Register Coin custom post type
custom_post_type::coin_post_register();

//Register Coin meta data
include "includes/class-meta_data.php";


//Register admin menu pages
register_menu::list_menu();

//Register Cron to update prices from API
custom_cron::register_cron();

