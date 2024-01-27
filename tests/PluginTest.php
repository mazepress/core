<?php
/**
 * The PluginTest class file.
 *
 * @package    Mazepress\Core
 * @subpackage Tests
 */

declare(strict_types=1);

namespace Mazepress\Core\Tests;

use WP_Mock\Tools\TestCase;
use Mazepress\Core\Test\Stubs\PluginStub;

/**
 * The PluginTest class.
 */
class PluginTest extends TestCase {

	/**
	 * Test class properites.
	 *
	 * @return void
	 */
	public function test_properties(): void {

		$instance = PluginStub::instance();

		$this->assertEquals( 'PluginStub', $instance->get_name() );
		$this->assertEquals( 'plugin-stub', $instance->get_slug() );
		$this->assertNotEmpty( $instance->get_version() );

		$url = 'http://localhost.com/wp-plugins/plugin-stub';
		$this->assertInstanceOf( PluginStub::class, $instance->set_url( $url ) );
		$this->assertEquals( $url, $instance->get_url() );

		$path = '\home\wp-plugin\plugin-stub';
		$this->assertInstanceOf( PluginStub::class, $instance->set_path( $path ) );
		$this->assertEquals( $path, $instance->get_path() );

		$desc = 'This is a sample plugin';
		$this->assertInstanceOf( PluginStub::class, $instance->set_description( $desc ) );
		$this->assertEquals( $desc, $instance->get_description() );
	}
}
