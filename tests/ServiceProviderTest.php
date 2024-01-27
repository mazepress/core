<?php
/**
 * The ServiceProvider test class file.
 *
 * @package    Mazepress\Core
 * @subpackage Tests
 */

declare(strict_types=1);

namespace Mazepress\Core\Tests;

use WP_Mock\Tools\TestCase;
use Mazepress\Core\ServiceProvider;
use Mazepress\Core\PackageInterface;
use Mazepress\Core\ServiceProviderInterface;
use Mazepress\Core\Tests\Stubs\HelloWorld;
use Mazepress\Core\Tests\Stubs\WorldPackages;
use WP_Mock;

/**
 * The ServiceProvider test class.
 *
 * @group ServiceProvider
 */
class ServiceProviderTest extends TestCase {

	/**
	 * Test class properites.
	 *
	 * @return void
	 */
	public function test_properties(): void {

		$plugin = HelloWorld::instance();
		$this->assertInstanceOf( PackageInterface::class, $plugin );

		$wpackages = new WorldPackages( $plugin );
		$this->assertInstanceOf( ServiceProvider::class, $wpackages );
		$this->assertInstanceOf( ServiceProviderInterface::class, $wpackages );
		$this->assertInstanceOf( PackageInterface::class, $wpackages->get_package() );
		$this->assertInstanceOf( WorldPackages::class, $wpackages->set_package( $plugin ) );
	}

	/**
	 * Test error message.
	 *
	 * @return void
	 */
	public function test_get_package_missing_message(): void {

		$plugin    = HelloWorld::instance();
		$wpackages = new WorldPackages( $plugin );
		$message   = 'The package PackageOne is missing';

		WP_Mock::userFunction( 'wp_sprintf' )
			->once()
			->andReturn( $message );

		$this->assertEquals( $message, $wpackages->get_package_missing_message( 'PackageOne', 'HelloWorld' ) );
	}

	/**
	 * Test load method.
	 *
	 * @return void
	 */
	public function test_load(): void {

		$plugin    = HelloWorld::instance();
		$wpackages = new WorldPackages( $plugin );

		$packages = array(
			'HelloWorld' => 'Mazepress\\Core\\Tests\\Stubs\\HelloWorld',
		);

		$this->assertInstanceOf( WorldPackages::class, $wpackages->set_packages( $packages ) );
		$this->assertEquals( $packages, $wpackages->get_packages() );

		WP_Mock::expectActionAdded( 'example_action', \WP_Mock\Functions::type( 'callable' ) );
		$wpackages->load();
		WP_Mock::assertActionsCalled();
	}

	/**
	 * Test load method.
	 *
	 * @return void
	 */
	public function test_load_error(): void {

		$plugin    = HelloWorld::instance();
		$wpackages = new WorldPackages( $plugin );

		$packages = array(
			'PackageOne' => 'Mazepress\\Core\\Tests\\Stubs\\PackageOne',
		);

		$this->assertInstanceOf( WorldPackages::class, $wpackages->set_packages( $packages ) );
		$this->assertEquals( $packages, $wpackages->get_packages() );

		WP_Mock::userFunction( 'wp_sprintf' )->once()->andReturn( 'The package not found' );
		WP_Mock::expectActionAdded( 'admin_notices', \WP_Mock\Functions::type( 'callable' ) );
		$wpackages->load();
		WP_Mock::assertActionsCalled();
	}
}
