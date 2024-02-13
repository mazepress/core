<?php
/**
 * Class for utility functions.
 *
 * @package Mazepress\Core
 */

namespace Mazepress\Core;

use Mazepress\Forms\Field\Label;
use Mazepress\Forms\Field\BaseField;

/**
 * Utility class.
 */
class Utility {

	/**
	 * Get unique random string.
	 *
	 * @param string $prefix The prefix.
	 *
	 * @return string
	 */
	public static function get_unique( string $prefix = '' ): string {

		$milli = floor( microtime( true ) * 100 );
		$rand  = strtoupper( substr( uniqid( (string) $milli ) . wp_rand( 100, 999 ), 0, 20 ) );

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

	/**
	 * Get the numbers.
	 *
	 * @param int  $start The number to start.
	 * @param int  $count The count.
	 * @param bool $reverse Do reverse.
	 *
	 * @return array<int, mixed>
	 */
	public static function get_numbers( int $start, int $count, bool $reverse = false ): array {

		$numbers = array();

		if ( $reverse ) {
			for ( $i = $start; $i >= $start - $count; $i-- ) {
				$numbers[ $i ] = $i;
			}
		} else {
			for ( $i = $start; $i <= $start + $count; $i++ ) {
				$numbers[ $i ] = $i;
			}
		}

		return $numbers;
	}

	/**
	 * Get Numeric pagination.
	 *
	 * @param \WP_Query $query The query object.
	 * @param bool      $print Print the output.
	 *
	 * @return string
	 */
	public static function get_pagination( \WP_Query $query = null, bool $print = true ): string {

		global $wp_query;

		if ( empty( $query ) ) {
			$query = $wp_query;
		}

		$html = '';

		if ( $query->max_num_pages <= 1 ) {
			return $html;
		}

		$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
		$max   = intval( $query->max_num_pages );
		$links = array();

		if ( $paged >= 1 ) {
			$links[] = $paged;
		}

		if ( $paged >= 3 ) {
			$links[] = $paged - 1;
			$links[] = $paged - 2;
		}

		if ( ( $paged + 2 ) <= $max ) {
			$links[] = $paged + 2;
			$links[] = $paged + 1;
		}

		$html .= '<nav><ul class="pagination pagination-sm justify-content-center my-4">';

		if ( ! in_array( 1, $links, true ) ) {
			$class = 1 === $paged ? 'active' : '';

			$html .= wp_sprintf(
				'<li class="page-item %s"><a class="page-link" href="%s">%s</a></li>',
				$class,
				esc_url( get_pagenum_link( 1 ) ),
				'1'
			);

			if ( ! in_array( 2, $links, true ) ) {
				$html .= '<li class="page-item">…</li>';
			}
		}

		sort( $links );

		foreach ( (array) $links as $link ) {
			$class = $paged === $link ? 'active' : '';
			$html .= wp_sprintf(
				'<li class="page-item %s"><a class="page-link" href="%s">%s</a></li>',
				$class,
				esc_url( get_pagenum_link( $link ) ),
				$link
			);
		}

		if ( ! in_array( $max, $links, true ) ) {
			if ( ! in_array( $max - 1, $links, true ) ) {
				$html .= '<li class="page-item">…</li>';
			}

			$class = $paged === $max ? 'active' : '';
			$html .= wp_sprintf(
				'<li class="page-item %s"><a class="page-link" href="%s">%s</a></li>',
				$class,
				esc_url( get_pagenum_link( $max ) ),
				$max
			);
		}

		$html .= '</ul></nav>';

		if ( $print ) {
			echo $html; //phpcs:ignore WordPress.Security.EscapeOutput
		}

		return $html;
	}
}
