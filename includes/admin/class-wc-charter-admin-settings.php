<?php
/**
 * WooCommerce Charter Admin Settings Class.
 *
 * @author 		Joshua F. Rountree
 * @category 	Admin
 * @package 	WooCommerce Charter/Admin
 * @version 	1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WC_Charter_Admin_Settings' ) ) {

/**
 * WC_Charter_Admin_Settings
 */
class WC_Charter_Admin_Settings {

	private static $settings = array();

	/**
	 * Include the settings page classes
	 */
	public static function get_settings_pages( ) {
		$settings[] = include( 'settings/class-wc-charter-settings.php' );

		return $settings;
	}

	/**
	 * Save the settings
	 */
	public static function save() {
		global $current_section, $current_tab;

		if ( empty( $_REQUEST['_wpnonce'] ) || ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'woocommerce-settings' ) ) {
			die( __( 'Action failed. Please refresh the page and retry.', 'wc_charter' ) );
		}

	}

}

} // end if class exists.

?>
