<?php
/**
 * The Message class file.
 *
 * @package    Mazepress\Core
 * @subpackage Helpers
 */

declare(strict_types=1);

namespace Mazepress\Core\Helpers;

/**
 * The Message trait class.
 */
trait Message {

	/**
	 * Create the alert message and redirect page request.
	 *
	 * @param string $message  The message.
	 * @param string $location The redirect url.
	 * @param string $code     The code - success, info, warning or error.
	 *
	 * @return void
	 */
	public function notify_redirect( string $message, string $location, string $code = 'warning' ) {

		$this->notify( $message, $code );

		if ( wp_safe_redirect( $location ) ) {
			exit();
		}
	}

	/**
	 * Create the alert message.
	 *
	 * @param string $message The message.
	 * @param string $code    The code - success, info, warning or error.
	 * @param bool   $admin   Is admin message.
	 *
	 * @return void
	 */
	public function notify( string $message, string $code = 'warning', bool $admin = false ) {

		$html = sprintf(
			apply_filters(
				'mazepress_core_alert_notice',
				'<div class="notice notice-%1$s is-dismissible"><p>%2$s</p></div>'
			),
			$code,
			$message
		);

		if ( $admin ) {
			add_action(
				'admin_notices',
				function () use ( $html ) {
					echo $html; // phpcs:ignore WordPress.Security.EscapeOutput
				}
			);
		} else {
			add_action(
				'alert_notices',
				function () use ( $html ) {
					echo $html; // phpcs:ignore WordPress.Security.EscapeOutput
				}
			);
		}
	}
}
