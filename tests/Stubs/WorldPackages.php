<?php
/**
 * The Packages class file.
 *
 * @package    Mazepress\Core
 * @subpackage Tests\Stubs
 */

declare(strict_types=1);

namespace Mazepress\Core\Tests\Stubs;

use Mazepress\Core\PackageInterface;
use Mazepress\Core\Packages;

/**
 * The Packages class.
 */
class WorldPackages extends Packages {

	/**
	 * Addon packages or plugins.
	 * Where the array `key` = Package name and `value` = Package Entry class.
	 *
	 * @example array( 'Core' => 'Mazepress\\Core\\App' )
	 *
	 * @var string[]
	 */
	private $packages = array();

	/**
	 * Initiate class.
	 *
	 * @param PackageInterface $package The package.
	 */
	public function __construct( PackageInterface $package ) {
		$this->set_package( $package );
	}

	/**
	 * Get the admin message.
	 *
	 * @param string $package The package name.
	 * @param string $parent  The parent package name.
	 *
	 * @return string
	 */
	public function get_package_missing_message( string $package, string $parent ): string {
		return wp_sprintf(
			/* translators: 1: The package. 2: Plugin name */
			esc_html__(
				'The package %1$s is missing, which is required by the %2$s plugin',
				'mazepress-core'
			),
			'<code>' . esc_html( $package ) . '</code>',
			'<code>' . esc_html( $parent ) . '</code>'
		);
	}

	/**
	 * Get the dependent packages.
	 *
	 * @return string[]
	 */
	public function get_packages(): array {
		return $this->packages;
	}

	/**
	 * Set the dependent packages.
	 *
	 * @param string[] $packages The packages.
	 *
	 * @return self
	 */
	public function set_packages( array $packages ): self {
		$this->packages = $packages;
		return $this;
	}
}
