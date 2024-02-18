<?php
/**
 * The Message class file.
 *
 * @package    Mazepress\Core
 * @subpackage Helper
 */

declare(strict_types=1);

namespace Mazepress\Core;

use Mazepress\Core\App;
use Mazepress\Core\Helper\Cookie;

/**
 * The Message trait class.
 */
final class Message {

	use Cookie;

	/**
	 * The key.
	 *
	 * @var string $key
	 */
	private $key = 'coremessage';

	/**
	 * The code.
	 *
	 * @var string $code
	 */
	private $code;

	/**
	 * The message.
	 *
	 * @var string $message
	 */
	private $message;

	/**
	 * Instance for this class.
	 *
	 * @var self|null $instance
	 */
	private static $instance;

	/**
	 * Get the Message class instance
	 *
	 * @return self
	 */
	public static function instance(): self {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Load the alert message from cookie.
	 *
	 * @return void
	 */
	public function init(): void {

		// Load the message from cookie.
		\add_action( 'template_redirect', array( self::$instance, 'load_message' ) );
	}

	/**
	 * Load the alert message from cookie.
	 *
	 * @return self
	 */
	public function load_message(): self {

		$cokkie = $this->get_cookie( $this->key );
		$cokkie = ! empty( $cokkie ) ? json_decode( wp_unslash( $cokkie ), true ) : array();

		if ( ! empty( $cokkie['code'] ) ) {
			$this->set_code( $cokkie['code'] );
		}

		if ( ! empty( $cokkie['message'] ) ) {
			$this->set_message( $cokkie['message'] );
		}

		$this->delete_cookie( $this->key );

		return $this;
	}

	/**
	 * Get the code.
	 *
	 * @return string|null
	 */
	public function get_code(): ?string {
		return $this->code;
	}

	/**
	 * Set the code.
	 *
	 * @param string $code the code.
	 *
	 * @return self
	 */
	public function set_code( string $code ): self {
		$this->code = $code;
		return $this;
	}

	/**
	 * Get the message.
	 *
	 * @return string|null
	 */
	public function get_message(): ?string {
		return $this->message;
	}

	/**
	 * Set the message.
	 *
	 * @param string $message the message.
	 *
	 * @return self
	 */
	public function set_message( string $message ): self {
		$this->message = $message;
		return $this;
	}

	/**
	 * Create the alert message.
	 *
	 * @phpcs:disable WordPress.WP.AlternativeFunctions
	 *
	 * @param string $message The message.
	 * @param string $code    The code.
	 *
	 * @return bool
	 */
	public function create( string $message, string $code = 'warning' ): bool {
		return $this->set_cookie(
			$this->key,
			json_encode(
				array(
					'code'    => $code,
					'message' => $message,
				)
			)
		);
	}

	/**
	 * Prevent initiate.
	 */
	private function __construct() {}

	/**
	 * Prevent cloning.
	 */
	private function __clone() {}
}
