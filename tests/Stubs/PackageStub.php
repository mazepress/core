<?php
/**
 * The PackageStub class file.
 *
 * @package    Mazepress\Core
 * @subpackage Test\Stubs
 */

declare(strict_types=1);

namespace Mazepress\Core\Test\Stubs;

use Mazepress\Core\Package;

/**
 * The PackageStub class.
 */
final class PackageStub extends Package {

	/**
	 * The name.
	 *
	 * @var string
	 */
	const NAME = 'PackageStub';

	/**
	 * The slug.
	 *
	 * @var string
	 */
	const SLUG = 'package-stub';

	/**
	 * The version.
	 *
	 * @var string
	 */
	const VERSION = '1.0.0';

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
