<?php
/**
 * The AppTest class file.
 *
 * @package    Mazepress\Core
 * @subpackage Tests
 */

declare(strict_types=1);

namespace Mazepress\Core\Tests;

use WP_Mock\Tools\TestCase;
use Mazepress\Core\App;
use Mazepress\Core\Package;
use Mazepress\Core\PackageInterface;

/**
 * The AppTest class.
 */
class AppTest extends TestCase {

	/**
	 * Test class properites.
	 *
	 * @return void
	 */
	public function test_properties(): void {

		$instance = App::instance();
		$this->assertInstanceOf( App::class, $instance );
		$this->assertInstanceOf( Package::class, $instance );
		$this->assertInstanceOf( PackageInterface::class, $instance );

		// Define the regular expression for SemVer.
		$semver = '/^\d+\.\d+\.\d+(-[0-9A-Za-z-]+(\.[0-9A-Za-z-]+)*)?(\+[0-9A-Za-z-]+(\.[0-9A-Za-z-]+)*)?$/';

		$this->assertEquals( 'Core', $instance->get_name() );
		$this->assertEquals( 'core', $instance->get_slug() );
		$this->assertMatchesRegularExpression( $semver, $instance->get_version() );
	}
}
