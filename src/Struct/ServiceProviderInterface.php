<?php
/**
 * The ServiceProviderInterface class file.
 *
 * @package    Mazepress\Core
 * @subpackage Struct
 */

declare(strict_types=1);

namespace Mazepress\Core\Struct;

use Mazepress\Core\Struct\PackageInterface;

/**
 * The ServiceProviderInterface class.
 */
interface ServiceProviderInterface {

	/**
	 * Get the package.
	 *
	 * @return PackageInterface
	 */
	public function get_package(): PackageInterface;

	/**
	 * Set the package.
	 *
	 * @param PackageInterface $package The package.
	 *
	 * @return self
	 */
	public function set_package( PackageInterface $package ): self;

	/**
	 * Get the dependent packages.
	 *
	 * @return string[]
	 */
	public function get_packages(): array;

	/**
	 * Set the dependent packages.
	 *
	 * @param string[] $packages The packages.
	 *
	 * @return self
	 */
	public function set_packages( array $packages ): self;
}
