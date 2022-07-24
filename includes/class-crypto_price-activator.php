<?php

/**
 * Fired during plugin activation
 *
 * @link       h.mahmoodkhah@gmail.com
 * @since      1.0.0
 *
 * @package    Crypto_price
 * @subpackage Crypto_price/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Crypto_price
 * @subpackage Crypto_price/includes
 * @author     Hossein Mahmoodkhah <h.mahmoodkhah@gmail.com>
 */
class Crypto_price_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
          $table_name = $wpdb->prefix.'coin_info';
          if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
    // table not in database. Create new table
     $charset_collate = $wpdb->get_charset_collate();
  
     $sql = "CREATE TABLE $table_name (
          id mediumint(9) NOT NULL AUTO_INCREMENT,
          post_id varchar(20) NOT NULL,
          currency_name varchar(20) NOT NULL,
          market_cap varchar(20) NOT NULL,
          usd_price varchar(20) NOT NULL,
          last_update datetime NOT NULL,
          UNIQUE KEY id (id)
     ) $charset_collate;";
     require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
     dbDelta( $sql );
	
}
else{
}

	}

}
