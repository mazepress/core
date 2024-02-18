<?php
/**
 * The Cookie class file.
 *
 * @package    Mazepress\Core
 * @subpackage Helper
 */

declare(strict_types=1);

namespace Mazepress\Core\Helper;

/**
 * The Cookie trait class.
 */
trait Cookie {

	/**
	 * Set cookie - wrapper for setcookie using WP constants.
	 *
	 * @param string $name   Name of the cookie being set.
	 * @param string $value  Value of the cookie.
	 * @param int    $expire Expiry of the cookie.
	 * @param bool   $secure Whether the cookie should be served only over https.
	 *
	 * @return bool
	 */
	public function set_cookie( string $name, string $value, int $expire = 0, bool $secure = false ): bool {

		if ( headers_sent() ) {
			return false;
		}

		$path   = (string) constant( 'COOKIEPATH' );
		$doamin = (string) constant( 'COOKIE_DOMAIN' );

		return setcookie( $name, $value, $expire, $path, $doamin, $secure );
	}

	/**
	 * Delete cookie
	 *
	 * @param string $name Name of the cookie being set.
	 *
	 * @return void
	 */
	public function delete_cookie( string $name ): void {

		self::set_cookie( $name, '', -1 );

		if ( isset( $_COOKIE[ $name ] ) ) {
			unset( $_COOKIE[ $name ] );
		}
	}

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
	 * Store the temporary data.
	 *
	 * @phpcs:disable WordPress.WP.AlternativeFunctions
	 *
	 * @param array<mixed> $data The data.
	 * @param string       $name The cookie name.
	 *
	 * @return bool
	 */
	public function set_session( array $data, string $name = 'tmpdata' ): bool {
		return self::set_cookie( $name, json_encode( $data ) );
	}

	/**
	 * Get the temporary data.
	 *
	 * @phpcs:disable WordPress.WP.AlternativeFunctions
	 *
	 * @param string $name The cookie name.
	 *
	 * @return array<mixed>
	 */
	public function get_session( string $name = 'tmpdata' ): array {
		$cookie = self::get_cookie( $name );
		return ! empty( $cookie ) ? json_decode( $cookie, true ) : array();
	}
}
