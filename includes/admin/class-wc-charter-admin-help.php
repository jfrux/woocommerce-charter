<?php
/**
 * Add some content to the help tab.
 *
 * @author 		Joshua F. Rountree
 * @category 	Admin
 * @package 	WooCommerce Charter/Admin
 * @version 	1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WC_Charter_Admin_Help' ) ) {

/**
 * WC_Charter_Admin_Help Class
 */
class WC_Charter_Admin_Help {

	/**
	 * Hook in tabs.
	 */
	public function __construct() {
		add_action( 'current_screen', array( &$this, 'add_tabs' ), 50 );
	}

	/**
	 * Add help tabs
	 */
	public function add_tabs() {
		$screen = get_current_screen();

		if ( ! in_array( $screen->id, wc_charter_get_screen_ids() ) )
			return;

		if( version_compare( WC_EXTEND_WOOVERSION, "2.1.0", '<' ) ) {
			$screen->add_help_tab( array(
				'id'	=> 'wc_charter_docs_tab',
				'title'	=> __( 'Documentation', 'wc_charter' ),
				'content'	=>

					'<p>' . sprintf( __( 'Thank you for using %s :) Should you need help using or extending %s please read the documentation.', 'wc_charter' ), WC_Charter()->name, WC_Charter()->name ) . '</p>' .

					'<p><a href="' . WC_Charter()->doc_url . '" class="button button-primary">' . sprintf( __( '%s Documentation', 'wc_charter' ), WC_Charter()->name ) . '</a></p>'

			) );

			$screen->add_help_tab( array(
				'id'	=> 'wc_charter_support_tab',
				'title'	=> __( 'Support', 'wc_charter' ),
				'content'	=>

					'<p>' . sprintf( __( 'After <a href="%s">reading the documentation</a>, for further assistance you can use the <a href="%s">community forum</a>.', 'wc_charter' ), WC_Charter()->doc_url, WC_Charter()->wp_plugin_support_url ) . '</p>' .

					'<p>' . __( 'Before asking for help I recommend checking the status page to identify any problems with your configuration.', 'wc_charter' ) . '</p>' .

					'<p><a href="' . admin_url('admin.php?page=woocommerce_status') . '" class="button button-primary">' . __( 'System Status', 'wc_charter' ) . '</a> <a href="' . WC_Charter()->wp_plugin_support_url . '" class="button">' . __( 'Community Support', 'wc_charter' ) . '</a></p>'

			) );

			$screen->add_help_tab( array(
				'id'	=> 'wc_charter_bugs_tab',
				'title'	=> __( 'Found a bug?', 'wc_charter' ),
				'content'	=>

					'<p>' . sprintf( __( 'If you find a bug within <strong>%s</strong> you can create a ticket via <a href="%s">Github issues</a>. Ensure you read the <a href="%s">contribution guide</a> prior to submitting your report. Be as descriptive as possible and please include your <a href="%s">system status report</a>.', 'wc_charter' ), WC_Charter()->name, GITHUB_REPO_URL . 'issues?state=open', GITHUB_REPO_URL . 'blob/master/CONTRIBUTING.md', admin_url( 'admin.php?page=woocommerce_status' ) ) . '</p>' .

					'<p><a href="' . GITHUB_REPO_URL . 'issues?state=open" class="button button-primary">' . __( 'Report a bug', 'wc_charter' ) . '</a> <a href="' . admin_url('admin.php?page=woocommerce_status') . '" class="button">' . __( 'System Status', 'wc_charter' ) . '</a></p>'

			) );

			$screen->set_help_sidebar(
				'<p><strong>' . __( 'For more information:', 'wc_charter' ) . '</strong></p>' .
				'<p><a href=" ' . WC_Charter()->web_url . ' " target="_blank">' . sprintf( __( 'About %s', 'wc_charter' ), WC_Charter()->name ) . '</a></p>' .
				'<p><a href=" ' . WC_Charter()->wp_plugin_url . ' " target="_blank">' . __( 'Project on WordPress.org', 'wc_charter' ) . '</a></p>' .
				'<p><a href="' . GITHUB_REPO_URL . '" target="_blank">' . __( 'Project on Github', 'wc_charter' ) . '</a></p>'
			);
		}
		else{
			$screen->add_help_tab( array(
				'id'	=> 'wc_charter_tab',
				'title'	=> WC_Charter()->name,
				'content'	=>

					'<p>' . sprintf( __( 'Thank you for using %s :) Should you need help using or extending %s please read the documentation.', 'wc_charter' ), WC_Charter()->name, WC_Charter()->name ) . '</p>' .

					'<p><a href="' . WC_Charter()->doc_url . '" class="button button-primary">' . sprintf( __( '%s Documentation', 'wc_charter' ), WC_Charter()->name ) . '</a></p><br>'.

					'<strong>' . __( 'Support', 'wc_charter' ) . '</strong>'.
					'<p>' . sprintf( __( 'After <a href="%s">reading the documentation</a>, for further assistance you can use the <a href="%s">community forum</a>.', 'wc_charter' ), WC_Charter()->doc_url, WC_Charter()->wp_plugin_support_url ) . '</p>' .

					'<p>' . __( 'Before asking for help I recommend checking the status page to identify any problems with your configuration.', 'wc_charter' ) . '</p>' .

					'<strong>' . __( 'Found a bug?', 'wc_charter' ) . '</strong>'.
					'<p>' . sprintf( __( 'If you find a bug within <strong>%s</strong> you can create a ticket via <a href="%s">Github issues</a>. Ensure you read the <a href="%s">contribution guide</a> prior to submitting your report. Be as descriptive as possible and please include your <a href="%s">system status report</a>.', 'wc_charter' ), WC_Charter()->name, GITHUB_REPO_URL . 'issues?state=open', GITHUB_REPO_URL . 'blob/master/CONTRIBUTING.md', admin_url( 'admin.php?page=wc-status' ) ) . '</p>' .

					'<p><a href="' . admin_url('admin.php?page=wc-status') . '" class="button button-primary">' . __( 'System Status', 'wc_charter' ) . '</a> <a href="' . WC_Charter()->wp_plugin_support_url . '" class="button">' . __( 'Community Support', 'wc_charter' ) . '</a> <a href="' . GITHUB_REPO_URL . 'issues?state=open" class="button">' . __( 'Report a bug', 'wc_charter' ) . '</a></p>'

			) );

		}
	}

} // end class.

} // end if class exists.

return new WC_Charter_Admin_Help();

?>
