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
use Mazepress\Core\Package;
use Mazepress\Core\PackageInterface;
use Mazepress\Core\Tests\Stubs\HelloWorld;

/**
 * The PackageTest class.
 *
 * @group Package
 */
class PackageTest extends TestCase {

	/**
	 * Test class properites.
	 *
	 * @return void
	 */
	public function test_properties(): void {

		$instance = HelloWorld::instance();
		$this->assertInstanceOf( HelloWorld::class, $instance );
		$this->assertInstanceOf( Package::class, $instance );
		$this->assertInstanceOf( PackageInterface::class, $instance );

		$url = 'http://localhost.com/wp-plugins/hello-world';
		$this->assertInstanceOf( HelloWorld::class, $instance->set_url( $url ) );
		$this->assertEquals( $url, $instance->get_url() );

		$path = '\home\wordpress\wp-plugin\hello-world';
		$this->assertInstanceOf( HelloWorld::class, $instance->set_path( $path ) );
		$this->assertEquals( $path, $instance->get_path() );
	}
}
