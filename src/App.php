<?php
/**
 * The App class file.
 *
 * @package Mazepress\Core
 */

declare(strict_types=1);

namespace Mazepress\Core;

use Mazepress\Core\Package;
use Mazepress\Core\Helper\Template;
use Mazepress\Core\Message;

/**
 * The App class.
 */
final class App extends Package {

	use Template;

	/**
	 * The name.
	 *
	 * @var string
	 */
	const NAME = 'Core';

	/**
	 * The slug.
	 *
	 * @var string
	 */
	const SLUG = 'core';

	/**
	 * The version.
	 *
	 * @var string
	 */
	const VERSION = '1.0.0';

	/**
	 * Instance for the Message class.
	 *
	 * @var Message|null $message
	 */
	private $message = null;

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
	private static $instance = null;

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
	 * Initialize the package features.
	 *
	 * @return void
	 */
	public static function init(): void {

		// Prevent duplicate call.
		if ( self::$loaded ) {
			return;
		} else {
			self::$loaded = true;
		}

		// Load message intance.
		self::$instance->message()->init();
	}

	/**
	 * Initialize the package features.
	 *
	 * @param string       $slug The template slug.
	 * @param string       $name The template name.
	 * @param array<mixed> $args The additional arguments.
	 *
	 * @return void
	 */
	public static function get_template_part( string $slug, string $name = null, array $args = array() ): void {
		self::get_template( self::$instance, $slug, $name, $args );
	}

	/**
	 * Get the Message class instance
	 *
	 * @return Message
	 */
	public function message(): Message {

		if ( is_null( $this->message ) ) {
			$this->message = Message::instance();
		}

		return $this->message;
	}

	/**
	 * Get the package name.
	 *
	 * @return string
	 */
	public function get_name(): string {
		return self::NAME;
	}

	/**
	 * Get the package slug.
	 *
	 * @return string
	 */
	public function get_slug(): string {
		return self::SLUG;
	}

	/**
	 * Get the package version.
	 *
	 * @return string
	 */
	public function get_version(): string {
		return self::VERSION;
	}

	/**
	 * Prevent initiate.
	 */
	private function __construct() {}

	/**
	 * Prevent cloning.
	 */
	private function __clone() {}
}
