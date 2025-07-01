<?php
/**
 * Plugin Name:     WP Secure Login Redirect
 * Plugin URI:      https://github.com/humayun-sarfraz/wp-secure-login-redirect
 * Description:     Redirects wp-login.php and wp-admin requests to HTTPS if accessed over HTTP.
 * Version:         1.0.0
 * Author:          Humayun Sarfraz
 * Author URI:      https://github.com/humayun-sarfraz
 * Text Domain:     wp-secure-login-redirect
 * Domain Path:     /languages
 * License:         GPLv2 or later
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'WP_Secure_Login_Redir', false ) ) {

	final class WP_Secure_Login_Redir {

		/** Singleton instance */
		private static $instance;

		/** Get or create singleton */
		public static function instance(): self {
			if ( null === self::$instance ) {
				self::$instance = new self();
				self::$instance->init_hooks();
			}
			return self::$instance;
		}

		/** Prevent direct construct */
		private function __construct() {}

		/** Hook into WordPress */
		private function init_hooks(): void {
			add_action( 'login_init',   [ $this, 'maybe_force_ssl' ], 1 );
			add_action( 'admin_init',   [ $this, 'maybe_force_ssl' ], 1 );
		}

		/**
		 * Redirect to HTTPS if not already secure.
		 */
		public function maybe_force_ssl(): void {
			if ( isset( $_SERVER['HTTPS'] ) && 'off' !== strtolower( $_SERVER['HTTPS'] ) ) {
				return; // already HTTPS
			}
			if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && 'https' === strtolower( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) ) {
				return; // behind proxy using HTTPS
			}

			$request_uri = $_SERVER['REQUEST_URI'] ?? '';
			// Only redirect login or admin pages
			if ( false !== strpos( $request_uri, 'wp-login.php' ) || false !== strpos( $request_uri, '/wp-admin' ) ) {
				$https_url = 'https://' . $_SERVER['HTTP_HOST'] . $request_uri;
				wp_safe_redirect( esc_url_raw( $https_url ), 301 );
				exit;
			}
		}
	}

	// Initialize plugin
	WP_Secure_Login_Redir::instance();
}
