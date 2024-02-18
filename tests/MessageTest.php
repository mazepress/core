<?php
/**
 * The MessageTest class file.
 *
 * @package    Mazepress\Core
 * @subpackage Tests
 */

declare(strict_types=1);

namespace Mazepress\Core\Tests;

use Mazepress\Core\Message;
use WP_Mock\Tools\TestCase;
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
	 * Test error function.
	 *
	 * @runInSeparateProcess
	 *
	 * @return void
	 */
	public function test_create(): void {

		$instance = Message::instance();
		$this->assertTrue( $instance->create( 'Warning message' ) );
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
		$_COOKIE['coremessage'] = json_encode( $alert ); //phpcs:ignore WordPress.WP.AlternativeFunctions

		WP_Mock::passthruFunction( 'wp_unslash' );

		$instance->load_message();
		$this->assertEquals( $message, $instance->get_message() );
		$this->assertEquals( 'success', $instance->get_code() );
	}
}
