<?php
/**
 * The HelloWorld stub class file.
 *
 * @package    Mazepress\Core
 * @subpackage Tests\Stubs
 */

namespace Mazepress\Core\Tests\Stubs;

use Mazepress\Core\Plugin;
use Mazepress\Core\PackageInterface;
use Mazepress\Core\Helper\Template;
use Mazepress\Core\Helper\Cookie;
use Mazepress\Core\Tests\Stubs\WorldPackages;

/**
 * The HelloWorld class.
 */
final class HelloWorld extends Plugin {

	use Template;
	use Cookie;

	/**
	 * The name.
	 *
	 * @var string
	 */
	const NAME = 'HelloWorld';

	/**
	 * The slug.
	 *
	 * @var string
	 */
	const SLUG = 'hello-world';

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
	 * Initialize the package features.
	 *
	 * @param PackageInterface $package The package.
	 *
	 * @return void
	 */
	public static function init( PackageInterface $package = null ): void {

		if ( is_null( $package ) ) {
			$package = self::$instance;
		}

		// Load the dependent packages.
		( new WorldPackages( $package ) )->load();

		// ToDo - Register all classes.
		// Call sample action.
		add_action( 'example_action', function () {} );
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
