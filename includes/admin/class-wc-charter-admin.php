<?php
/**
 * WooCommerce Charter Admin.
 *
 * @author 		Joshua F. Rountree
 * @category 	Admin
 * @package 	WooCommerce Charter/Admin
 * @version 	0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WC_Charter_Admin' ) ) {

class WC_Charter_Admin {

	/**
	 * Constructor
	 */
	public function __construct() {
		// Actions
		add_action( 'init', array( &$this, 'includes' ) );
		add_action( 'current_screen', array( &$this, 'conditonal_includes' ) );
	}

	/**
	 * Include any classes we need within admin.
	 */
	public function includes() {
		// Functions
		include( 'wc-charter-admin-functions.php' );

		// Classes we only need if the ajax is not-ajax
		if ( ! is_ajax() ) {
			include( 'class-wc-charter-admin-notices.php' );

			// Help
			if ( apply_filters( 'wc_charter_enable_admin_help_tab', true ) ) {
				include( 'class-wc-charter-admin-help.php' );
			}
		}
	}

	/**
	 * Include admin files conditionally
	 */
	public function conditonal_includes() {
		$screen = get_current_screen();

		switch ( $screen->id ) {

			case 'dashboard' :
				break;

			case 'products':
				break;

			case 'users' :
			case 'user' :
			case 'profile' :
			case 'user-edit' :
				break;

		} // end switch
	}

}

} // end if class exists

return new WC_Charter_Admin();

?>
