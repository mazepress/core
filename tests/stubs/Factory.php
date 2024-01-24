<?php
/**
 * The sample Factory stub class file.
 *
 * @package    Mazepress\Skeleton\Tests
 * @subpackage Stubs
 */

namespace Mazepress\Skeleton\Tests\Stubs;

/**
 * The Factory class.
 */
final class Factory {

	/**
	 * The plugin name.
	 *
	 * @var string
	 */
	const NAME = 'HelloWorld';

	/**
	 * The plugin version.
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
	 * Initialize the plugin properties.
	 *
	 * @return void
	 */
	public static function init(): void {
		// Call sample action.
		add_action( 'example_action', function () {} );
	}
}
