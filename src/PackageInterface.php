<?php
/**
 * The PackageInterface class file.
 *
 * @package Mazepress\Core
 */

declare(strict_types=1);

namespace Mazepress\Core;

/**
 * The PackageInterface class.
 */
interface PackageInterface {

	/**
	 * Get the package name.
	 *
	 * @return string
	 */
	public function get_name(): string;

	/**
	 * Get the package slug.
	 *
	 * @return string
	 */
	public function get_slug(): string;

	/**
	 * Get the package version.
	 *
	 * @return string
	 */
	public function get_version(): string;

	/**
	 * Get the base url.
	 *
	 * @return string|null
	 */
	public function get_url(): ?string;

	/**
	 * Set the base url.
	 *
	 * @param string $url the base url.
	 *
	 * @return self
	 */
	public function set_url( string $url ): self;

	/**
	 * Get the base path.
	 *
	 * @return string|null
	 */
	public function get_path(): ?string;

	/**
	 * Set the base path.
	 *
	 * @param string $path the base path.
	 *
	 * @return self
	 */
	public function set_path( string $path ): self;
}
