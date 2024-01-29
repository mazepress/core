<?php
/**
 * The TemplateTest class file.
 *
 * @package    Mazepress\Core
 * @subpackage Tests\Helper
 */

declare(strict_types=1);

namespace Mazepress\Core\Tests\Helper;

use WP_Mock;
use WP_Mock\Tools\TestCase;
use Mazepress\Core\Tests\Stubs\HelloWorld;
use Mazepress\Core\Tests\Stubs\HelloWorldParent;

/**
 * The TemplateTest class.
 *
 * @group Helper
 */
class TemplateTest extends TestCase {

	/**
	 * Test get_template_part.
	 *
	 * @return void
	 */
	public function test_get_template_part(): void {

		$instance = HelloWorld::instance();
		$instance->set_path( dirname( __DIR__ ) );

		WP_Mock::userFunction( 'get_stylesheet_directory' )
			->andReturn( '' );

		WP_Mock::userFunction( 'get_template_directory' )
			->andReturn( '' );

		$instance::get_template_part( 'coretest', 'template' );

		WP_Mock::assertActionsCalled();
	}

	/**
	 * Test locate_template.
	 *
	 * @return void
	 */
	public function test_locate_template(): void {

		$parent   = HelloWorldParent::instance();
		$instance = HelloWorld::instance();
		$instance->set_path( dirname( __DIR__ ) );
		$instance->set_parent( $parent );

		$template = 'coretest-template.php';
		$path     = dirname( __DIR__ ) . '/templates';

		WP_Mock::userFunction( 'get_stylesheet_directory' )
			->once()
			->andReturn( '' );

		WP_Mock::userFunction( 'get_template_directory' )
			->once()
			->andReturn( '' );

		$located = $instance::locate_template( $instance, $template );

		$this->assertEquals( $path . '/' . $template, $located );
	}
}
