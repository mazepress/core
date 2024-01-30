<?php
/**
 * The MessageInterface class file.
 *
 * @package    Mazepress\Core
 * @subpackage Struct
 */

declare(strict_types=1);

namespace Mazepress\Core\Struct;

/**
 * The MessageInterface class.
 */
interface MessageInterface {

	/**
	 * Create the warning alert.
	 *
	 * @param string $message The message.
	 *
	 * @return bool
	 */
	public function warning( string $message ): bool;

	/**
	 * Create the error alert.
	 *
	 * @param string $message The message.
	 *
	 * @return bool
	 */
	public function error( string $message ): bool;

	/**
	 * Create the success alert.
	 *
	 * @param string $message The message.
	 *
	 * @return bool
	 */
	public function success( string $message ): bool;
}
