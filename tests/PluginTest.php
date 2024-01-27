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
use Mazepress\Core\Plugin;
use Mazepress\Core\Package;
use Mazepress\Core\PackageInterface;
use Mazepress\Core\PluginInterface;
use Mazepress\Core\Tests\Stubs\HelloWorld;

/**
 * The PluginTest class.
 *
 * @group Plugin
 */
class PluginTest extends TestCase {

	/**
	 * Test class properites.
	 *
	 * @return void
	 */
	public function test_properties(): void {

		$instance = HelloWorld::instance();
		$this->assertInstanceOf( HelloWorld::class, $instance );
		$this->assertInstanceOf( Plugin::class, $instance );
		$this->assertInstanceOf( Package::class, $instance );
		$this->assertInstanceOf( PluginInterface::class, $instance );
		$this->assertInstanceOf( PackageInterface::class, $instance );

		$desc = 'This is a sample plugin';
		$this->assertInstanceOf( HelloWorld::class, $instance->set_description( $desc ) );
		$this->assertEquals( $desc, $instance->get_description() );
	}
}
