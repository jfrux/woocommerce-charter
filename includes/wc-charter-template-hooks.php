<?php
/**
 * WooCommerce Charter Template Hooks
 *
 * Action/filter hooks used for WooCommerce Charter functions/templates
 *
 * @author 		Joshua F. Rountree
 * @package 	WooCommerce Charter/Templates
 * @version 	1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Templates
 *
 * Override template files for the products.
 * @see wc_charter_locate_template()
 */
add_filter( 'woocommerce_locate_template', 'wc_charter_locate_template', 10, 3 );

?>
