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
	 * If an instance exists, returns it. If not, creates one and retuns it.
	 *
	 * @return self
	 */
	abstract public static function instance();

	/**
	 * Initialize the package features.
	 *
	 * @return void
	 */
	abstract public static function init(): void;

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
	 * @param  string $description The description.
	 * @return self
	 */
	public function set_description( string $description ): self {
		$this->description = $description;
		return $this;
	}
}
