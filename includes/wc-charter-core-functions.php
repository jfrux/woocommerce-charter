<?php
/**
 * WooCommerce Charter Core Functions
 *
 * General core functions available on both the front-end and admin.
 *
 * @author 		Joshua F. Rountree
 * @category 	Core
 * @package 	WooCommerce Charter/Functions
 * @version 	1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Include core functions
include( 'wc-charter-conditional-functions.php' );
include( 'wc-charter-formatting-functions.php' );

/**
 * Get template part.
 *
 * @access public
 * @param mixed $slug
 * @param string $name (default: '')
 * @return void
 */
function wc_charter_get_template_part( $slug, $name = '' ) {
	$template = '';

	// Look in yourtheme/slug-name.php and yourtheme/woocommerce-extension-plugin-name/slug-name.php
	if ( $name ) {
		$template = locate_template( array ( "{$slug}-{$name}.php", WC_Charter()->template_path() . "{$slug}-{$name}.php" ) );
	}

	// Get default slug-name.php
	if ( !$template && $name && file_exists( WC_Charter()->wc_plugin_path() . "/templates/{$slug}-{$name}.php" ) )
		$template = WC_Charter()->wc_plugin_path() . "/templates/{$slug}-{$name}.php";

	// If template file doesn't exist, look in yourtheme/slug.php and yourtheme/woocommerce-extension-plugin-name/slug.php
	if ( !$template )
		$template = locate_template( array ( "{$slug}.php", WC_Charter()->template_path() . "{$slug}.php" ) );

	if ( $template )
		load_template( $template, false );
}

/**
 * Get other templates. passing attributes and including the file.
 *
 * @access public
 * @param mixed $template_name
 * @param array $args (default: array())
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return void
 */
function wc_charter_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
	if ( $args && is_array($args) )
		extract( $args );

	$located = wc_charter_locate_template( $template_name, $template_path, $default_path );

	do_action( 'wc_charter_before_template_part', $template_name, $template_path, $located, $args );

	include( $located );

	do_action( 'wc_charter_after_template_part', $template_name, $template_path, $located, $args );
}

/**
 * Locate a template and return the path for inclusion.
 *
 * This is the load order:
 *
 *		yourtheme		/	$template_path	/	$template_name
 *		yourtheme		/	$template_name
 *		$default_path	/	$template_name
 *
 * @access public
 * @param mixed $template_name
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return string
 */
function wc_charter_locate_template( $template_name, $template_path = '', $default_path = '' ) {
	if ( ! $template_path ) $template_path = WC_Charter()->template_path();
	if ( ! $default_path ) $default_path = WC_Charter()->wc_plugin_path() . '/templates/';

	// Look within passed path within the theme - this is priority
	$template = locate_template(
		array(
			trailingslashit( $template_path ) . $template_name,
			$template_name
		)
	);

	// Get default template
	if ( ! $template )
		$template = $default_path . $template_name;

	// Return what we found
	return apply_filters('wc_charter_locate_template', $template, $template_name, $template_path);
}

?>
