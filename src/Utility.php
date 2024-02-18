<?php
/**
 * Class for utility functions.
 *
 * @package Mazepress\Core
 */

namespace Mazepress\Core;

/**
 * Utility class.
 */
class Utility {

	/**
	 * Get unique random string.
	 *
	 * @phpcs:disable WordPress.WP.AlternativeFunctions
	 *
	 * @param string $prefix The prefix.
	 *
	 * @return string
	 */
	public static function get_unique( string $prefix = '' ): string {

		$milli = floor( microtime( true ) * 100 );
		$rand  = strtoupper( substr( uniqid( (string) $milli ) . rand( 100, 999 ), 0, 20 ) );

		return $prefix . $rand;
	}

	/**
	 * Parse the date and return dattetime object if true
	 *
	 * @param string $date   The date string.
	 * @param string $format The date current format.
	 *
	 * @return \DateTimeImmutable|null
	 */
	public static function parse_date( string $date, string $format = 'Y-m-d' ): ?\DateTimeImmutable {

		$datetime = \DateTimeImmutable::createFromFormat( $format, $date, wp_timezone() );
		$result   = ( ! empty( $datetime ) && $datetime->format( $format ) === $date ) ? $datetime : null;

		return $result;
	}

	/**
	 * Parse money format.
	 *
	 * @param  float  $amount   The amount.
	 * @param  string $currency The currency format.
	 * @return string
	 */
	public static function parse_money( float $amount, string $currency = 'USD' ): string {

		$numfmt = numfmt_create( 'en_US', \NumberFormatter::CURRENCY );
		$value  = numfmt_format_currency( $numfmt, $amount, $currency );

		return $value;
	}
}
