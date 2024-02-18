<?php
/**
 * The EmailTest class file.
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
 * The EmailTest class.
 *
 * @group Helper
 */
class EmailTest extends TestCase {

	/**
	 * Test send_email function.
	 *
	 * @return void
	 */
	public function test_send_email(): void {

		$instance = HelloWorld::instance();

		WP_Mock::passthruFunction( 'wp_sprintf' );
		WP_Mock::passthruFunction( 'get_bloginfo' );

		WP_Mock::userFunction( 'get_stylesheet_directory' )
			->andReturn( 'theme' );

		WP_Mock::userFunction( 'get_template_directory' )
			->andReturn( 'child-theme' );

		WP_Mock::userFunction(
			'wp_mail',
			array(
				'times' => 1,
				'args'  => array(
					'one@example.com',
					'Test Subject',
					WP_Mock\Functions::type( 'string' ),
					WP_Mock\Functions::type( 'array' ),
					WP_Mock\Functions::type( 'array' ),
				),
			)
		);

		$instance->send_email( 'one@example.com', 'Test Subject', 'The message body' );

		WP_Mock::assertActionsCalled();
	}
}
