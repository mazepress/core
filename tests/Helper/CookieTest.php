<?php
/**
 * The CookieTest class file.
 *
 * @package    Mazepress\Core
 * @subpackage Tests\Helper
 */

declare(strict_types=1);

namespace Mazepress\Core\Tests\Helper;

use Mazepress\Core\Tests\Stubs\HelloWorld;
use WP_Mock\Tools\TestCase;

/**
 * The CookieTest class.
 *
 * @group Helper
 */
class CookieTest extends TestCase {

	/**
	 * Test set_cookie headers_sent to return true.
	 *
	 * @return void
	 */
	public function test_set_cookie_headers_sent(): void {

		$instance = HelloWorld::instance();
		$result   = $instance->set_cookie( 'test_cookie', 'test_value' );

		$this->assertFalse( $result );
	}

	/**
	 * Test set_cookie.
	 *
	 * @runInSeparateProcess
	 *
	 * @return void
	 */
	public function test_set_cookie(): void {

		$instance = HelloWorld::instance();
		$expire   = time() + 3600; // Expire in 1 hour.

		$result = $instance->set_cookie( 'test_cookie', 'test_value', $expire );
		$this->assertTrue( $result );
	}

	/**
	 * Test delete_cookie.
	 *
	 * @runInSeparateProcess
	 *
	 * @return void
	 */
	public function test_delete_cookie(): void {

		$instance = HelloWorld::instance();

		// Mock the $_COOKIE superglobal.
		$_COOKIE['test_cookie'] = 'test_value';

		$instance->delete_cookie( 'test_cookie' );
		$this->assertArrayNotHasKey( 'test_cookie', $_COOKIE );
	}

	/**
	 * Test get_cookie.
	 *
	 * @return void
	 */
	public function test_get_cookie(): void {

		$instance = HelloWorld::instance();
		$result   = $instance->get_cookie( 'test_cookie' );

		$this->assertNull( $result );

		// Mock the $_COOKIE superglobal.
		$_COOKIE['test_cookie'] = 'test_value';

		$result = $instance->get_cookie( 'test_cookie' );

		$this->assertEquals( 'test_value', $result );
	}

	/**
	 * Test set_session.
	 *
	 * @runInSeparateProcess
	 *
	 * @return void
	 */
	public function test_set_session(): void {

		$instance = HelloWorld::instance();
		$data     = array(
			'id'    => 1,
			'title' => 'test',
		);

		$result = $instance->set_session( $data );
		$this->assertTrue( $result );
	}

	/**
	 * Test session.
	 *
	 * @runInSeparateProcess
	 *
	 * @return void
	 */
	public function test_get_session(): void {

		$instance = HelloWorld::instance();
		$data     = array(
			'id'    => 1,
			'title' => 'test',
		);

		// Mock the $_COOKIE superglobal.
		$_COOKIE['tmpdata'] = json_encode( $data ); //phpcs:ignore WordPress.WP.AlternativeFunctions

		$this->assertEquals( $data, $instance->get_session() );
	}
}
