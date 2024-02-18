<?php
/**
 * The Notice class file.
 *
 * @package    Mazepress\Core
 * @subpackage Helper
 */

declare(strict_types=1);

namespace Mazepress\Core\Helper;

use Mazepress\Core\App;
use Mazepress\Core\Message;

/**
 * The Notice trait class.
 */
trait Notice {

	/**
	 * Create a warning alert.
	 *
	 * @param string $message The message.
	 *
	 * @return bool
	 */
	public function warning_notice( string $message ): bool {
		return Message::instance()->create( $message, 'warning' );
	}

	/**
	 * Create an error alert.
	 *
	 * @param string $message The message.
	 *
	 * @return bool
	 */
	public function error_notice( string $message ): bool {
		return Message::instance()->create( $message, 'danger' );
	}

	/**
	 * Create a success alert.
	 *
	 * @param string $message The message.
	 *
	 * @return bool
	 */
	public function success_notice( string $message ): bool {
		return Message::instance()->create( $message, 'success' );
	}

	/**
	 * Flash the message.
	 *
	 * @return void
	 */
	public static function flash_notice(): void {

		$instance = Message::instance();

		App::instance()->get_template_part(
			'notice',
			null,
			array(
				'code'    => $instance->get_code(),
				'message' => $instance->get_message(),
			)
		);
	}
}
