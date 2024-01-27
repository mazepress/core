<?php
/**
 * The PackageTest class file.
 *
 * @package    Mazepress\Core
 * @subpackage Tests
 */

declare(strict_types=1);

namespace Mazepress\Core\Tests;

use WP_Mock\Tools\TestCase;
use Mazepress\Core\Test\Stubs\PackageStub;

/**
 * The PackageTest class.
 */
class PackageTest extends TestCase {

	/**
	 * Test class properites.
	 *
	 * @return void
	 */
	public function test_properties(): void {

		$instance = PackageStub::instance();

		$this->assertEquals( 'PackageStub', $instance->get_name() );
		$this->assertEquals( 'package-stub', $instance->get_slug() );
		$this->assertNotEmpty( $instance->get_version() );

		$url = 'http://localhost.com/wp-plugins/package-stub';
		$this->assertInstanceOf( PackageStub::class, $instance->set_url( $url ) );
		$this->assertEquals( $url, $instance->get_url() );

		$path = '\home\wp-plugin\package-stub';
		$this->assertInstanceOf( PackageStub::class, $instance->set_path( $path ) );
		$this->assertEquals( $path, $instance->get_path() );
	}
}
