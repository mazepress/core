<?php
/**
 * The ServiceProvider class file.
 *
 * @package Mazepress\Core
 */

declare(strict_types=1);

namespace Mazepress\Core;

use Mazepress\Core\Struct\PackageInterface;
use Mazepress\Core\Struct\ServiceProviderInterface;

/**
 * The ServiceProvider class.
 */
abstract class ServiceProvider implements ServiceProviderInterface {

	/**
	 * The package.
	 *
	 * @var PackageInterface $package
	 */
	private $package = null;

	/**
	 * Get the dependent packages.
	 *
	 * @return string[]
	 */
	abstract public function get_packages(): array;

	/**
	 * Set the dependent packages.
	 *
	 * @param string[] $packages The packages.
	 *
	 * @return self
	 */
	abstract public function set_packages( array $packages ): self;

	/**
	 * Get the admin message.
	 *
	 * @param string $package The package name.
	 * @param string $parent  The parent package name.
	 *
	 * @return string
	 */
	abstract public function get_package_missing_message( string $package, string $parent ): string;

	/**
	 * Initialize all dependent packages.
	 *
	 * @return void
	 */
	public function load(): void {

		$vendor_path = 'packages';
		$package     = $this->get_package();
		$path        = \trailingslashit( (string) $package->get_path() ) . $vendor_path;
		$url         = \trailingslashit( (string) $package->get_url() ) . $vendor_path;

		foreach ( $this->get_packages() as $name => $class ) {

			// If a package is missing, send an admin notice.
			if ( ! is_callable( array( $class, 'instance' ) ) ) {
				// Enque admin message.
				$this->enque_admin_notice( $name, $package->get_name() );
				continue;
			}

			$instance = call_user_func( array( $class, 'instance' ) );

			// Cal the init function on the package.
			if ( $instance instanceof PackageInterface ) {

				$path = \trailingslashit( $path ) . $instance->get_slug();
				$url  = \trailingslashit( $url ) . $instance->get_slug();

				$instance
					->set_path( $path )
					->set_url( $url )
					->set_parent( $package )
					->init();
			}
		}
	}

	/**
	 * Get the package.
	 *
	 * @return PackageInterface
	 */
	public function get_package(): PackageInterface {
		return $this->package;
	}

	/**
	 * Set the package.
	 *
	 * @param PackageInterface $package The package.
	 *
	 * @return self
	 */
	public function set_package( PackageInterface $package ): self {
		$this->package = $package;
		return $this;
	}

	/**
	 * Send admin warning notice
	 *
	 * @param string $name The package name.
	 * @param string $parent The parent package name.
	 *
	 * @return void
	 */
	private function enque_admin_notice( string $name, string $parent ) {

		$message = $this->get_package_missing_message( $name, $parent );

		// Enqueue admin notice.
		\add_action(
			'admin_notices',
			function () use ( $message ) {
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				printf( '<div class="notice notice-error"><p>%1$s</p></div>', $message ); // @codeCoverageIgnore
			}
		);
	}
}
