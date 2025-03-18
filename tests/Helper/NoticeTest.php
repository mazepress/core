<?php
/**
 * The NoticeTest class file.
 *
 * @package    Mazepress\Core
 * @subpackage Tests\Helper
 */

declare(strict_types=1);

namespace Mazepress\Core\Tests\Helper;

use Mazepress\Core\Tests\Stubs\HelloWorld;
use WP_Mock\Tools\TestCase;
use WP_Mock;

/**
 * The NoticeTest class.
 *
 * @group Helper
 */
class NoticeTest extends TestCase {

	/**
	 * Test warning_notice function.
	 *
	 * @runInSeparateProcess
	 *
	 * @return void
	 */
	public function test_warning_notice(): void {

		$instance = HelloWorld::instance();
		$this->assertTrue( $instance->warning_notice( 'Warning message' ) );
	}

	/**
	 * Test error_notice function.
	 *
	 * @runInSeparateProcess
	 *
	 * @return void
	 */
	public function test_error_notice(): void {

		$instance = HelloWorld::instance();
		$this->assertTrue( $instance->error_notice( 'Error message' ) );
	}

	/**
	 * Test success_notice function.
	 *
	 * @runInSeparateProcess
	 *
	 * @return void
	 */
	public function test_success_notice(): void {

		$instance = HelloWorld::instance();
		$this->assertTrue( $instance->success_notice( 'Success message' ) );
	}

	/**
	 * Test flash function.
	 *
	 * @runInSeparateProcess
	 *
	 * @return void
	 */
	public function test_flash(): void {

		$instance = HelloWorld::instance();
		$data     = array(
			'code'    => 'warning',
			'message' => 'Warning message',
		);

		// Mock the $_COOKIE superglobal.
		$_COOKIE['coremessage'] = json_encode( $data ); //phpcs:ignore WordPress.WP.AlternativeFunctions

		WP_Mock::userFunction( 'get_stylesheet_directory' )
			->andReturn( 'theme' );

		WP_Mock::userFunction( 'get_template_directory' )
			->andReturn( 'child-theme' );

		$instance::flash_notice();
		$instance::flash_admin_notice();

		WP_Mock::assertActionsCalled();
	}
}
