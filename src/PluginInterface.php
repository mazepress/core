<?php
/**
 * The PluginInterface class file.
 *
 * @package Mazepress\Core
 */

declare(strict_types=1);

namespace Mazepress\Core;

use Mazepress\Core\PackageInterface;

/**
 * The PluginInterface class.
 */
interface PluginInterface extends PackageInterface {

	/**
	 * Get the description.
	 *
	 * @return string|null
	 */
	public function get_description(): ?string;

	/**
	 * Set the description.
	 *
	 * @param string $description The description.
	 *
	 * @return self
	 */
	public function set_description( string $description ): self;
}
