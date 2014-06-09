<?php
/**
 * WooCommerce Charter Admin Functions
 *
 * @author 		Joshua F. Rountree
 * @category 	Core
 * @package 	WooCommerce Charter/Admin/Functions
 * @version 	0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Get all WooCommerce Charter screen ids
 *
 * @return array
 */
function wc_charter_get_screen_ids() {
	$menu_name = strtolower( str_replace ( ' ', '-', WC_CHARTER_PAGE ) );

	$wc_charter_screen_id = strtolower( str_replace ( ' ', '-', WC_CHARTER ) );

	return apply_filters( 'wc_charter_screen_ids', array(
		'toplevel_page_' . $wc_charter_screen_id,
		'woocommerce_page_wc_settings',
		'woocommerce_page_wc-settings',
		'woocommerce_page_woocommerce_settings',
		'woocommerce_page_woocommerce-settings'
	) );
}

/**
 * Get a setting from the settings API.
 *
 * @param mixed $option
 * @return string
 */
function wc_charter_settings_get_option( $option_name, $default = '' ) {
	if ( ! class_exists( 'WC_Charter_Admin_Settings' ) ) {
		include 'class-wc-charter-admin-settings.php';
	}

	return WC_Charter_Admin_Settings::get_option( $option_name, $default );
}

?>
