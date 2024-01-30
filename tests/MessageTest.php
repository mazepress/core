<?php
/**
 * The MessageTest class file.
 *
 * @phpcs:disable WordPress.WP.AlternativeFunctions.json_encode_json_encode
 *
 * @package    Mazepress\Core
 * @subpackage Tests
 */

declare(strict_types=1);

namespace Mazepress\Core\Tests;

use WP_Mock\Tools\TestCase;
use Mazepress\Core\Message;
use Mazepress\Core\Struct\MessageInterface;
use WP_Mock;

/**
 * The MessageTest class.
 *
 * @group Message
 */
class MessageTest extends TestCase {

	/**
	 * Test class properites.
	 *
	 * @return void
	 */
	public function test_properties(): void {

		$instance = Message::instance();
		$this->assertInstanceOf( Message::class, $instance );
		$this->assertInstanceOf( MessageInterface::class, $instance );

		$code = 'warning';
		$this->assertInstanceOf( Message::class, $instance->set_code( $code ) );
		$this->assertEquals( $code, $instance->get_code() );

		$message = 'Sample alert message';
		$this->assertInstanceOf( Message::class, $instance->set_message( $message ) );
		$this->assertEquals( $message, $instance->get_message() );
	}

	/**
	 * Test load message function.
	 *
	 * @return void
	 */
	public function test_init(): void {

		$instance = Message::instance();

		WP_Mock::expectActionAdded( 'template_redirect', array( $instance, 'load_message' ) );
		$instance->init();
		WP_Mock::assertHooksAdded();
	}

	/**
	 * Test warning function.
	 *
	 * @runInSeparateProcess
	 *
	 * @return void
	 */
	public function test_warning(): void {

		$instance = Message::instance();
		$message  = 'Warning message';
		$alert    = array(
			'code'    => 'warning',
			'message' => $message,
		);

		WP_Mock::userFunction( 'wp_json_encode' )
			->with( $alert )
			->andReturn( json_encode( $alert ) );

		$this->assertTrue( $instance->warning( $message ) );
	}

	/**
	 * Test error function.
	 *
	 * @runInSeparateProcess
	 *
	 * @return void
	 */
	public function test_error(): void {

		$instance = Message::instance();
		$message  = 'Error message';
		$alert    = array(
			'code'    => 'error',
			'message' => $message,
		);

		WP_Mock::userFunction( 'wp_json_encode' )
			->with( $alert )
			->andReturn( json_encode( $alert ) );

		$this->assertTrue( $instance->error( $message ) );
	}

	/**
	 * Test success function.
	 *
	 * @runInSeparateProcess
	 *
	 * @return void
	 */
	public function test_success(): void {

		$instance = Message::instance();
		$message  = 'Success message';
		$alert    = array(
			'code'    => 'success',
			'message' => $message,
		);

		WP_Mock::userFunction( 'wp_json_encode' )
			->with( $alert )
			->andReturn( json_encode( $alert ) );

		$this->assertTrue( $instance->success( $message ) );
	}

	/**
	 * Test flash function.
	 *
	 * @return void
	 */
	public function test_flash(): void {

		$instance = Message::instance()
			->set_code( 'error' )
			->set_message( 'Error message!' );

		WP_Mock::userFunction( 'get_stylesheet_directory' )
			->andReturn( 'theme' );

		WP_Mock::userFunction( 'get_template_directory' )
			->andReturn( 'child-theme' );

		$instance::flash();

		WP_Mock::assertActionsCalled();
	}

	/**
	 * Test load message function.
	 *
	 * @runInSeparateProcess
	 *
	 * @return void
	 */
	public function test_load_message(): void {

		$instance = Message::instance();
		$message  = 'Load message test!';
		$alert    = array(
			'code'    => 'success',
			'message' => $message,
		);

		// Mock the $_COOKIE superglobal.
		$_COOKIE['coremessage'] = json_encode( $alert );

		$instance->load_message();
		$this->assertEquals( $message, $instance->get_message() );
		$this->assertEquals( 'success', $instance->get_code() );
	}
}
