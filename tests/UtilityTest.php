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

	/**
	 * Test get_numbers function.
	 *
	 * @return void
	 */
	public function test_get_numbers(): void {

		$numbers = Utility::get_numbers( 100, 3 );
		$this->assertEquals( array( 100, 101, 102, 103 ), array_keys( $numbers ) );
		$this->assertEquals( array( 100, 101, 102, 103 ), array_values( $numbers ) );

		$numbers = Utility::get_numbers( 100, 3, true );
		$this->assertEquals( array( 100, 99, 98, 97 ), array_keys( $numbers ) );
		$this->assertEquals( array( 100, 99, 98, 97 ), array_values( $numbers ) );
	}

	/**
	 * Test get_file_types function.
	 *
	 * @return void
	 */
	public function test_get_file_types(): void {

		$type = Utility::get_file_types( 'image' );
		$this->assertTrue( in_array( 'image/jpeg', $type, true ) );

		$type = Utility::get_file_types( 'plain' );
		$this->assertTrue( in_array( 'text/plain', $type, true ) );

		$type = Utility::get_file_types( 'pdf' );
		$this->assertTrue( in_array( 'application/pdf', $type, true ) );

		$type = Utility::get_file_types( 'word' );
		$this->assertTrue( in_array( 'application/msword', $type, true ) );

		$type = Utility::get_file_types( 'excel' );
		$this->assertTrue( in_array( 'application/vnd.ms-excel', $type, true ) );

		$type = Utility::get_file_types( 'powerpoint' );
		$this->assertTrue( in_array( 'application/vnd.ms-powerpoint', $type, true ) );

		$type = Utility::get_file_types( 'document' );
		$this->assertTrue( in_array( 'application/pdf', $type, true ) );
		$this->assertTrue( in_array( 'application/msword', $type, true ) );

		$type = Utility::get_file_types();
		$this->assertTrue( in_array( 'image/jpeg', $type, true ) );
		$this->assertTrue( in_array( 'application/pdf', $type, true ) );
		$this->assertTrue( in_array( 'application/msword', $type, true ) );
	}

	/**
	 * Test get_months function.
	 *
	 * @return void
	 */
	public function test_get_months(): void {

		$months = Utility::get_months();
		$this->assertTrue( array_key_exists( '01', $months ) );
		$this->assertTrue( in_array( 'January', $months, true ) );
	}

	/**
	 * Test get_countries function.
	 *
	 * @return void
	 */
	public function test_get_countries(): void {

		$countries = Utility::get_countries();
		$this->assertTrue( array_key_exists( 'BM', $countries ) );
		$this->assertTrue( is_array( $countries['BM'] ) );
		$this->assertTrue( array_key_exists( 'name', $countries['BM'] ) );
	}
}
