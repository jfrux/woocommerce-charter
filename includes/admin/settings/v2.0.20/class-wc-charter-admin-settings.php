<?php
/**
 * WooCommerce Charter First Tab Settings
 *
 * @author 		Joshua F. Rountree
 * @category 	Admin
 * @package 	WooCommerce Charter/Admin
 * @version 	1.0.0
 */

if(!defined('ABSPATH')) exit; // Exit if accessed directly

if(!class_exists('WC_Charter_Admin_Settings')) {

/**
 * WC_Charter_Admin_Settings
 */
class WC_Charter_Admin_Settings {

	/**
	 * Constructor.
	 */
	public function __construct(){
		$this->id 		= WC_CHARTER_PAGE;
		$this->label 	= apply_filters( 'wc_extend_settings_tab_label', __( 'Charter', 'wc_charter' ) );

		add_filter('woocommerce_settings_tabs_array', array( &$this, 'add_settings_tab' ) );
		add_action('woocommerce_settings_tabs_' . $this->id, array( &$this, 'output' ) );
		add_action('woocommerce_update_options_' . $this->id, array( &$this, 'save' ) );
	}

	/**
	 * Get settings array
	 *
	 * @return array
	 */
	public function get_settings(){

		return apply_filters( 'wc_extend_' . $this->id . '_settings', array(

			array(
				'title' 	=> __( 'Product / Checkout', 'wc_charter' ), 
				'type' 		=> 'title', 
				'desc' 		=> __( 'Customize the checkout experience.', 'wc_charter' ), 
				'id' 		=> $this->id . '_options'
			),

			array(
				'title' 	=> __( 'Maximum Guests Per Room', 'wc_charter' ),
				'desc' 		=> __( 'Sets the ships maximum guest per room capacity.', 'wc_charter' ),
				'id' 		=> 'wc_charter_max_guests',
				'default'	=> '5',
				'type' 		=> 'number',
				'custom_attributes' => array(
					'min' 	=> 0,
					'step' 	=> 1
				),
				'css' 		=> 'min-width:100px;',
				'autoload' 	=> false
			),

			array(
				'title' 	=> __( 'Tax / Gratuity Per Person', 'wc_charter' ),
				'desc' 		=> __( 'This will add a tax / gratuity line item multiplied by the number of guests.', 'wc_charter' ),
				'id' 		=> 'wc_charter_tax_gratuity',
				'default'	=> 0,
				'type' 		=> 'text',
				'css' 		=> 'min-width:300px;',
				'autoload' 	=> false
			),

			array( 'type' => 'sectionend', 'id' => $this->id . '_options'),

		)); // End of your settings

	}

	/**
	 * Add a tab to the settings page of WooCommerce for Product Reviews Plus.
	 *
	 * @access public
	 * @return void
	 */
	public function add_settings_tab( $tabs ){
		$tabs[$this->id] = $this->label;

		return $tabs;
	}

	/**
	 * Output the settings
	 */
	public function output(){
		$settings = $this->get_settings();

		woocommerce_admin_fields($settings);
	}

	/**
	 * Save settings
	 */
	public function save(){
		global $woocommerce;

		include_once($woocommerce->plugin_path.'/admin/settings/settings-save.php');

		$settings = $this->get_settings();

		woocommerce_update_options($settings);
	}

}

} // end if class exists.

?>
