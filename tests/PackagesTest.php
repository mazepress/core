<?php
/**
 * The Packages test class file.
 *
 * @package Mazepress\Skeleton\Tests
 */

declare(strict_types=1);

namespace Mazepress\Skeleton\Tests;

use WP_Mock\Tools\TestCase;
use Mazepress\Skeleton\Packages;
use WP_Mock;

/**
 * The Packages test class.
 */
class PackagesTest extends TestCase {

	/**
	 * Test class properites.
	 *
	 * @return void
	 */
	public function test_properties(): void {

		$packages = array( 'PackageOne' => '\\Mazepress\\Skeleton\\PackageOne' );
		$instance = new Packages( 'ParentPackage' );

		$this->assertInstanceOf( Packages::class, $instance->set_packages( $packages ) );
		$this->assertEquals( $packages, $instance->get_packages() );
	}

	/**
	 * Test load method.
	 *
	 * @return void
	 */
	public function test_load(): void {

		$packages = array( 'HelloWorld' => \Mazepress\Skeleton\Tests\Stubs\Factory::class );
		$instance = ( new Packages( 'ParentPackage' ) )->set_packages( $packages );

		WP_Mock::expectActionAdded( 'example_action', \WP_Mock\Functions::type( 'callable' ) );
		$instance->load();
		WP_Mock::assertActionsCalled();
	}

	/**
	 * Test load method.
	 *
	 * @return void
	 */
	public function test_load_error(): void {

		$packages = array( 'PackageOne' => '\\Mazepress\\Skeleton\\PackageOne' );
		$instance = ( new Packages( 'ParentPackage' ) )->set_packages( $packages );

		WP_Mock::userFunction( 'wp_sprintf' )->once()->andReturn( 'The package not found' );
		WP_Mock::expectActionAdded( 'admin_notices', \WP_Mock\Functions::type( 'callable' ) );
		$instance->load();
		WP_Mock::assertActionsCalled();
	}
}
