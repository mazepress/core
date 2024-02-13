<?php
/**
 * The PostTypeInterface class file.
 *
 * @package    Mazepress\Core
 * @subpackage Struct
 */

declare(strict_types=1);

namespace Mazepress\Core\Struct;

/**
 * The PostTypeInterface class.
 */
interface PostTypeInterface {

	/**
	 * Get the post type.
	 *
	 * @return string
	 */
	public function get_post_type(): string;
}
