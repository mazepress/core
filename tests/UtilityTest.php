<?php
/**
 * The UtilityTest class file.
 *
 * @phpcs:disable WordPress.WP.AlternativeFunctions.json_encode_json_encode
 *
 * @package    Mazepress\Core
 * @subpackage Tests
 */

declare(strict_types=1);

namespace Mazepress\Core\Tests;

use Mazepress\Core\Utility;
use WP_Mock\Tools\TestCase;

/**
 * The UtilityTest class.
 *
 * @group Utility
 */
class UtilityTest extends TestCase {

	/**
	 * Test get_unique function.
	 *
	 * @return void
	 */
	public function test_get_unique(): void {

		$value = Utility::get_unique( 'test-' );
		$this->assertStringContainsString( 'test-', $value );
	}

	/**
	 * Test parse_date function.
	 *
	 * @return void
	 */
	public function test_parse_date(): void {

		$date = Utility::parse_date( '18-01-1982', 'd-m-Y' );
		$this->assertNotEmpty( $date );
		$this->assertEquals( '1982-01-18', $date->format( 'Y-m-d' ) );
	}

	/**
	 * Test parse_money function.
	 *
	 * @return void
	 */
	public function test_parse_money(): void {

		$value = Utility::parse_money( 10000.50 );
		$this->assertEquals( '$10,000.50', $value );
	}
}
