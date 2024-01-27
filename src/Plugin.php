<?php
/**
 * The Package class file.
 *
 * @package Mazepress\Core
 */

declare(strict_types=1);

namespace Mazepress\Core;

use Mazepress\Core\Package;
use Mazepress\Core\PluginInterface;
use Mazepress\Core\PackageInterface;

/**
 * The Package class.
 */
abstract class Plugin extends Package implements PluginInterface {

	/**
	 * The description.
	 *
	 * @var string|null $description
	 */
	protected $description;

	/**
	 * Initialize the package features.
	 *
	 * @param PackageInterface $package The package.
	 *
	 * @return void
	 */
	abstract public static function init( PackageInterface $package = null ): void;

	/**
	 * Get the product description.
	 *
	 * @return string|null
	 */
	public function get_description(): ?string {
		return $this->description;
	}

	/**
	 * Set the product description.
	 *
	 * @param  string $description the description.
	 * @return self
	 */
	public function set_description( string $description ): self {
		$this->description = $description;
		return $this;
	}
}
