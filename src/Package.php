<?php
/**
 * The Package class file.
 *
 * @package Mazepress\Core
 */

declare(strict_types=1);

namespace Mazepress\Core;

use Mazepress\Core\PackageInterface;

/**
 * The Package class.
 */
abstract class Package implements PackageInterface {

	/**
	 * The base url.
	 *
	 * @var string|null $url
	 */
	private $url;

	/**
	 * The base path.
	 *
	 * @var string|null $path
	 */
	private $path;

	/**
	 * If an instance exists, returns it. If not, creates one and retuns it.
	 *
	 * @return self
	 */
	abstract public static function instance();

	/**
	 * Initialize the package features.
	 *
	 * @param PackageInterface $package The package.
	 *
	 * @return void
	 */
	abstract public static function init( PackageInterface $package = null ): void;

	/**
	 * Get the base url.
	 *
	 * @return string|null
	 */
	public function get_url(): ?string {
		return $this->url;
	}

	/**
	 * Set the base url.
	 *
	 * @param string $url the base url.
	 *
	 * @return self
	 */
	public function set_url( string $url ): self {
		$this->url = $url;
		return $this;
	}

	/**
	 * Get the base path.
	 *
	 * @return string|null
	 */
	public function get_path(): ?string {
		return $this->path;
	}

	/**
	 * Set the base path.
	 *
	 * @param string $path the base path.
	 *
	 * @return self
	 */
	public function set_path( string $path ): self {
		$this->path = $path;
		return $this;
	}
}
