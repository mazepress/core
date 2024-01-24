<?php
/**
 * The Factory test class file.
 *
 * @package Mazepress\Core\Tests
 */

declare(strict_types=1);

namespace Mazepress\Core\Tests;

use WP_Mock\Tools\TestCase;
use Mazepress\Core\Factory;
use WP_Mock;

/**
 * The FactoryTest class.
 */
class FactoryTest extends TestCase {

	/**
	 * Test class properites.
	 *
	 * @return void
	 */
	public function test_properties(): void {

		$url  = 'http://localhost.com/wp-plugins/my-plugin';
		$path = '\home\wp-plugin\my-plugin';

		WP_Mock::userFunction( 'plugin_dir_url' )->once()->andReturn( $url );
		WP_Mock::userFunction( 'plugin_dir_path' )->once()->andReturn( $path );

		$instance = Factory::instance();
		$this->assertInstanceOf( Factory::class, $instance );
		$this->assertNotEmpty( $instance->get_name() );
		$this->assertNotEmpty( $instance->get_version() );

		$this->assertEquals( $url, $instance->get_url() );
		$this->assertInstanceOf( Factory::class, $instance->set_url( $url . '/test' ) );
		$this->assertEquals( $url . '/test', $instance->get_url() );

		$this->assertEquals( $path, $instance->get_path() );
		$this->assertInstanceOf( Factory::class, $instance->set_path( $path . '\test' ) );
		$this->assertEquals( $path . '\test', $instance->get_path() );
	}

	/**
	 * Test init method.
	 *
	 * @return void
	 */
	public function test_init(): void {

		Factory::instance()->init();
		WP_Mock::assertActionsCalled();
	}
}
