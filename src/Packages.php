<?php
/**
 * The Packages class file.
 *
 * @package Mazepress\Skeleton
 */

declare(strict_types=1);

namespace Mazepress\Skeleton;

/**
 * The Packages class.
 */
class Packages {

	/**
	 * Addon packages or plugin.
	 * Where the array `key` = Package name and `value` = Entry class.
	 *
	 * @example array( 'HellowWorld' => 'Mazepress\\HellowWorld\\Factory' )
	 *
	 * @var string[]
	 */
	private $packages = array();

	/**
	 * The packages name.
	 *
	 * @var string $name
	 */
	private $name = null;

	/**
	 * Initiate class.
	 *
	 * @param string $name The package name.
	 */
	public function __construct( string $name ) {
		$this->set_name( $name );
	}

	/**
	 * Initialize all the packages.
	 *
	 * @return void
	 */
	public function load(): void {

		foreach ( self::get_packages() as $package => $instance ) {

			// If a package is missing, add an admin notice.
			if ( ! is_callable( array( $instance, 'init' ) ) ) {
				// Enque admin message.
				$this->enque_admin_notice( $package );
				continue;
			}

			// Cal the init function on the package.
			call_user_func( array( $instance, 'init' ), $this->get_name() );
		}
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
	 * @param  string[] $packages The packages.
	 * @return self
	 */
	public function set_packages( array $packages ): self {
		$this->packages = $packages;
		return $this;
	}

	/**
	 * Get the package name.
	 *
	 * @return string
	 */
	public function get_name(): string {
		return $this->name;
	}

	/**
	 * Set the package name.
	 *
	 * @param  string $name The package name.
	 * @return self
	 */
	public function set_name( string $name ): self {
		$this->name = $name;
		return $this;
	}

	/**
	 * Send admin warning notice
	 *
	 * @param string $package The package name.
	 *
	 * @return void
	 */
	private function enque_admin_notice( string $package ) {

		// Show autoloader warning.
		$message = wp_sprintf(
			/* translators: 1: The package. 2: Plugin name */
			esc_html__(
				'The package %1$s is missing, which is required by the %2$s plugin',
				'skeleton'
			),
			'<code>' . esc_html( $package ) . '</code>',
			'<code>' . esc_html( $this->get_name() ) . '</code>'
		);

		add_action(
			'admin_notices',
			function () use ( $message ) {
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				printf( '<div class="notice notice-warning"><p>%1$s</p></div>', $message ); // @codeCoverageIgnore
			}
		);
	}
}
