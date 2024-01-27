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

		$this->assertEquals( 'Core', $instance->get_name() );
		$this->assertEquals( 'core', $instance->get_slug() );
		$this->assertNotEmpty( $instance->get_version() );

		$url = 'http://localhost.com/wp-plugins/core';
		$this->assertInstanceOf( App::class, $instance->set_url( $url ) );
		$this->assertEquals( $url, $instance->get_url() );

		$path = '\home\wp-plugin\core';
		$this->assertInstanceOf( App::class, $instance->set_path( $path ) );
		$this->assertEquals( $path, $instance->get_path() );
	}
}
