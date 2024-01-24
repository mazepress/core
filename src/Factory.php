<?php
/**
 * The main entry class file.
 *
 * @package Mazepress\Core
 */

declare(strict_types=1);

namespace Mazepress\Core;

/**
 * The Factory class.
 */
final class Factory {

	/**
	 * The plugin name.
	 *
	 * @var string
	 */
	const NAME = 'Core';

	/**
	 * The plugin version.
	 *
	 * @var string
	 */
	const VERSION = '1.0.0';

	/**
	 * The plugin url.
	 *
	 * @var string|null $url
	 */
	private $url = null;

	/**
	 * The plugin path.
	 *
	 * @var string|null $path
	 */
	private $path = null;

	/**
	 * Loaded init function.
	 *
	 * @var bool $loaded
	 */
	private static $loaded = false;

	/**
	 * Instance for this class.
	 *
	 * @var self|null $instance
	 */
	private static $instance;

	/**
	 * If an instance exists, returns it. If not, creates one and retuns it.
	 *
	 * @return self
	 */
	public static function instance(): self {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Initialize the plugin properties.
	 *
	 * @param string $name The package name.
	 *
	 * @return void
	 */
	public static function init( string $name = '' ): void {

		if ( empty( $name ) ) {
			$name = self::NAME;
		}

		// Prevent duplicate call.
		if ( self::$loaded ) {
			return;
		} else {
			self::$loaded = true;
		}

		// Enque scripts and style.
		add_action( 'admin_enqueue_scripts', array( self::$instance, 'admin_enqueue_scripts' ) );
	}

	/**
	 * Admin Enqueue a script
	 *
	 * @return void
	 */
	public function admin_enqueue_scripts(): void {
		wp_enqueue_style(
			'mazepress-core-admin',
			$this->get_url() . 'assets/css/admin.css',
			array(),
			$this->get_version(),
		);
	}

	/**
	 * Get the plugin name.
	 *
	 * @return string
	 */
	public function get_name(): string {
		$name = apply_filters( 'mazepress_core_get_name', self::NAME );
		return (string) $name;
	}

	/**
	 * Get the plugin version.
	 *
	 * @return string
	 */
	public function get_version(): string {
		$version = apply_filters( 'mazepress_core_get_version', self::VERSION );
		return (string) $version;
	}

	/**
	 * Get the plugin base url.
	 *
	 * @return string
	 */
	public function get_url(): string {
		return $this->url;
	}

	/**
	 * Set the plugin base url.
	 *
	 * @param  string $url the base url.
	 * @return self
	 */
	public function set_url( string $url ): self {
		$this->url = $url;
		return $this;
	}

	/**
	 * Get the plugin base path.
	 *
	 * @return string
	 */
	public function get_path(): string {
		return $this->path;
	}

	/**
	 * Set the plugin base path.
	 *
	 * @param  string $path the base path.
	 * @return self
	 */
	public function set_path( string $path ): self {
		$this->path = $path;
		return $this;
	}

	/**
	 * Prevent initiate.
	 */
	private function __construct() {
		$this->set_url( plugin_dir_url( __DIR__ ) )
			->set_path( plugin_dir_path( __DIR__ ) );
	}

	/**
	 * Prevent cloning.
	 */
	private function __clone() {}
}
