<?php
/**
 * The Cookie class file.
 *
 * @package    Mazepress\Core
 * @subpackage Helpers
 */

declare(strict_types=1);

namespace Mazepress\Core\Helpers;

/**
 * The Cookie trait class.
 */
trait Cookie {

	/**
	 * Get cookie by name reference
	 *
	 * @phpcs:disable WordPress.Security.ValidatedSanitizedInput
	 *
	 * @param string $name Name of the cookie being set.
	 *
	 * @return string|null
	 */
	public function get_cookie( string $name ): ?string {
		return ( isset( $_COOKIE[ $name ] ) ) ? (string) $_COOKIE[ $name ] : null;
	}

	/**
	 * Set cookie - wrapper for setcookie using WP constants.
	 *
	 * @param string $name   Name of the cookie being set.
	 * @param string $value  Value of the cookie.
	 * @param int    $expire Expiry of the cookie.
	 * @param bool   $secure Whether the cookie should be served only over https.
	 *
	 * @return void
	 */
	public function set_cookie( string $name, string $value, int $expire = 0, bool $secure = false ) {

		if ( headers_sent() ) {
			return;
		}

		$path   = constant( 'COOKIEPATH' );
		$doamin = constant( 'COOKIE_DOMAIN' );

		setcookie( $name, $value, $expire, $path, $doamin, $secure );
	}

	/**
	 * Delete cookie
	 *
	 * @param string $name Name of the cookie being set.
	 *
	 * @return void
	 */
	public function delete_cookie( string $name ): void {

		$this->set_cookie( $name, '', -1 );

		if ( isset( $_COOKIE[ $name ] ) ) {
			unset( $_COOKIE[ $name ] );
		}
	}
}
