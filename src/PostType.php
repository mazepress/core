<?php
/**
 * The PostType class file.
 *
 * @package Mazepress\Core
 */

declare(strict_types=1);

namespace Mazepress\Core;

use Mazepress\Core\Struct\PostTypeInterface;

/**
 * The PostType class.
 */
abstract class PostType implements PostTypeInterface {

	/**
	 * Get the post type.
	 *
	 * @return string
	 */
	abstract public function get_post_type(): string;
}
