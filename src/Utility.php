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
	 * @param bool   $usezone   Use the timezone.
	 *
	 * @return \DateTimeImmutable|null
	 */
	public static function parse_date(
		string $date,
		string $format = 'Y-m-d',
		bool $usezone = true
	): ?\DateTimeImmutable {

		$timezone = $usezone ? wp_timezone() : null;
		$datetime = \DateTimeImmutable::createFromFormat( $format, $date, $timezone );
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
	 * Get valid file formats.
	 *
	 * @param string $type The file type.
	 *
	 * @return array<mixed>
	 */
	public static function get_file_types( string $type = '' ): array {

		$types = array();

		switch ( $type ) {
			case 'image':
				$types = array(
					'image/jpeg',
					'image/png',
					'image/gif',
				);
				break;
			case 'plain':
				$types = array(
					'text/plain',
					'application/rtf',
				);
				break;
			case 'pdf':
				$types = array(
					'application/pdf',
				);
				break;
			case 'word':
				$types = array(
					'application/msword',
					'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
				);
				break;
			case 'excel':
				$types = array(
					'application/vnd.ms-excel',
					'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
				);
				break;
			case 'powerpoint':
				$types = array(
					'application/vnd.ms-powerpoint',
					'application/vnd.openxmlformats-officedocument.presentationml.presentation',
				);
				break;
			case 'document':
				$types = array(
					'application/pdf',
					'application/msword',
					'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
				);
				break;
			default:
				$types = array(
					'image/jpeg',
					'image/png',
					'image/gif',

					'text/plain',
					'application/rtf',
					'application/pdf',

					'application/msword',
					'application/vnd.openxmlformats-officedocument.wordprocessingml.document',

					'application/vnd.ms-excel',
					'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',

					'application/vnd.ms-powerpoint',
					'application/vnd.openxmlformats-officedocument.presentationml.presentation',
				);
				break;
		}

		return $types;
	}

	/**
	 * Get the months.
	 *
	 * @return string[]
	 */
	public static function get_months(): array {
		return array(
			'01' => 'January',
			'02' => 'February',
			'03' => 'March',
			'04' => 'April',
			'05' => 'May',
			'06' => 'June',
			'07' => 'July',
			'08' => 'August',
			'09' => 'September',
			'10' => 'October',
			'11' => 'November',
			'12' => 'December',
		);
	}

	/**
	 * Get the countries.
	 *
	 * @return array<mixed>
	 */
	public static function get_countries(): array {
		return array(
			'AF' => array(
				'alpha2' => 'AF',
				'alpha3' => 'AFG',
				'num'    => '004',
				'isd'    => '93',
				'name'   => 'Afghanistan',
			),
			'AX' => array(
				'alpha2' => 'AX',
				'alpha3' => 'ALA',
				'num'    => '248',
				'isd'    => '358',
				'name'   => 'Åland Islands',
			),
			'AL' => array(
				'alpha2' => 'AL',
				'alpha3' => 'ALB',
				'num'    => '008',
				'isd'    => '355',
				'name'   => 'Albania',
			),
			'DZ' => array(
				'alpha2' => 'DZ',
				'alpha3' => 'DZA',
				'num'    => '012',
				'isd'    => '213',
				'name'   => 'Algeria',
			),
			'AS' => array(
				'alpha2' => 'AS',
				'alpha3' => 'ASM',
				'num'    => '016',
				'isd'    => '1684',
				'name'   => 'American Samoa',
			),
			'AD' => array(
				'alpha2' => 'AD',
				'alpha3' => 'AND',
				'num'    => '020',
				'isd'    => '376',
				'name'   => 'Andorra',
			),
			'AO' => array(
				'alpha2' => 'AO',
				'alpha3' => 'AGO',
				'num'    => '024',
				'isd'    => '244',
				'name'   => 'Angola',
			),
			'AI' => array(
				'alpha2' => 'AI',
				'alpha3' => 'AIA',
				'num'    => '660',
				'isd'    => '1264',
				'name'   => 'Anguilla',
			),
			'AQ' => array(
				'alpha2' => 'AQ',
				'alpha3' => 'ATA',
				'num'    => '010',
				'isd'    => '672',
				'name'   => 'Antarctica',
			),
			'AG' => array(
				'alpha2' => 'AG',
				'alpha3' => 'ATG',
				'num'    => '028',
				'isd'    => '1268',
				'name'   => 'Antigua and Barbuda',
			),
			'AR' => array(
				'alpha2' => 'AR',
				'alpha3' => 'ARG',
				'num'    => '032',
				'isd'    => '54',
				'name'   => 'Argentina',
			),
			'AM' => array(
				'alpha2' => 'AM',
				'alpha3' => 'ARM',
				'num'    => '051',
				'isd'    => '374',
				'name'   => 'Armenia',
			),
			'AW' => array(
				'alpha2' => 'AW',
				'alpha3' => 'ABW',
				'num'    => '533',
				'isd'    => '297',
				'name'   => 'Aruba',
			),
			'AU' => array(
				'alpha2' => 'AU',
				'alpha3' => 'AUS',
				'num'    => '036',
				'isd'    => '61',
				'name'   => 'Australia',
			),
			'AT' => array(
				'alpha2' => 'AT',
				'alpha3' => 'AUT',
				'num'    => '040',
				'isd'    => '43',
				'name'   => 'Austria',
			),
			'AZ' => array(
				'alpha2' => 'AZ',
				'alpha3' => 'AZE',
				'num'    => '031',
				'isd'    => '994',
				'name'   => 'Azerbaijan',
			),
			'BS' => array(
				'alpha2' => 'BS',
				'alpha3' => 'BHS',
				'num'    => '044',
				'isd'    => '1242',
				'name'   => 'Bahamas',
			),
			'BH' => array(
				'alpha2' => 'BH',
				'alpha3' => 'BHR',
				'num'    => '048',
				'isd'    => '973',
				'name'   => 'Bahrain',
			),
			'BD' => array(
				'alpha2' => 'BD',
				'alpha3' => 'BGD',
				'num'    => '050',
				'isd'    => '880',
				'name'   => 'Bangladesh',
			),
			'BB' => array(
				'alpha2' => 'BB',
				'alpha3' => 'BRB',
				'num'    => '052',
				'isd'    => '1246',
				'name'   => 'Barbados',
			),
			'BY' => array(
				'alpha2' => 'BY',
				'alpha3' => 'BLR',
				'num'    => '112',
				'isd'    => '375',
				'name'   => 'Belarus',
			),
			'BE' => array(
				'alpha2' => 'BE',
				'alpha3' => 'BEL',
				'num'    => '056',
				'isd'    => '32',
				'name'   => 'Belgium',
			),
			'BZ' => array(
				'alpha2' => 'BZ',
				'alpha3' => 'BLZ',
				'num'    => '084',
				'isd'    => '501',
				'name'   => 'Belize',
			),
			'BJ' => array(
				'alpha2' => 'BJ',
				'alpha3' => 'BEN',
				'num'    => '204',
				'isd'    => '229',
				'name'   => 'Benin',
			),
			'BM' => array(
				'alpha2' => 'BM',
				'alpha3' => 'BMU',
				'num'    => '060',
				'isd'    => '1441',
				'name'   => 'Bermuda',
			),
			'BT' => array(
				'alpha2' => 'BT',
				'alpha3' => 'BTN',
				'num'    => '064',
				'isd'    => '975',
				'name'   => 'Bhutan',
			),
			'BO' => array(
				'alpha2' => 'BO',
				'alpha3' => 'BOL',
				'num'    => '068',
				'isd'    => '591',
				'name'   => 'Bolivia',
			),
			'BA' => array(
				'alpha2' => 'BA',
				'alpha3' => 'BIH',
				'num'    => '070',
				'isd'    => '387',
				'name'   => 'Bosnia and Herzegovina',
			),
			'BW' => array(
				'alpha2' => 'BW',
				'alpha3' => 'BWA',
				'num'    => '072',
				'isd'    => '267',
				'name'   => 'Botswana',
			),
			'BV' => array(
				'alpha2' => 'BV',
				'alpha3' => 'BVT',
				'num'    => '074',
				'isd'    => '61',
				'name'   => 'Bouvet Island',
			),
			'BR' => array(
				'alpha2' => 'BR',
				'alpha3' => 'BRA',
				'num'    => '076',
				'isd'    => '55',
				'name'   => 'Brazil',
			),
			'IO' => array(
				'alpha2' => 'IO',
				'alpha3' => 'IOT',
				'num'    => '086',
				'isd'    => '246',
				'name'   => 'British Indian Ocean Territory',
			),
			'BN' => array(
				'alpha2' => 'BN',
				'alpha3' => 'BRN',
				'num'    => '096',
				'isd'    => '672',
				'name'   => 'Brunei Darussalam',
			),
			'BG' => array(
				'alpha2' => 'BG',
				'alpha3' => 'BGR',
				'num'    => '100',
				'isd'    => '359',
				'name'   => 'Bulgaria',
			),
			'BF' => array(
				'alpha2' => 'BF',
				'alpha3' => 'BFA',
				'num'    => '854',
				'isd'    => '226',
				'name'   => 'Burkina Faso',
			),
			'BI' => array(
				'alpha2' => 'BI',
				'alpha3' => 'BDI',
				'num'    => '108',
				'isd'    => '257',
				'name'   => 'Burundi',
			),
			'KH' => array(
				'alpha2' => 'KH',
				'alpha3' => 'KHM',
				'num'    => '116',
				'isd'    => '855',
				'name'   => 'Cambodia',
			),
			'CM' => array(
				'alpha2' => 'CM',
				'alpha3' => 'CMR',
				'num'    => '120',
				'isd'    => '231',
				'name'   => 'Cameroon',
			),
			'CA' => array(
				'alpha2' => 'CA',
				'alpha3' => 'CAN',
				'num'    => '124',
				'isd'    => '1',
				'name'   => 'Canada',
			),
			'CV' => array(
				'alpha2' => 'CV',
				'alpha3' => 'CPV',
				'num'    => '132',
				'isd'    => '238',
				'name'   => 'Cape Verde',
			),
			'KY' => array(
				'alpha2' => 'KY',
				'alpha3' => 'CYM',
				'num'    => '136',
				'isd'    => '1345',
				'name'   => 'Cayman Islands',
			),
			'CF' => array(
				'alpha2' => 'CF',
				'alpha3' => 'CAF',
				'num'    => '140',
				'isd'    => '236',
				'name'   => 'Central African Republic',
			),
			'TD' => array(
				'alpha2' => 'TD',
				'alpha3' => 'TCD',
				'num'    => '148',
				'isd'    => '235',
				'name'   => 'Chad',
			),
			'CL' => array(
				'alpha2' => 'CL',
				'alpha3' => 'CHL',
				'num'    => '152',
				'isd'    => '56',
				'name'   => 'Chile',
			),
			'CN' => array(
				'alpha2' => 'CN',
				'alpha3' => 'CHN',
				'num'    => '156',
				'isd'    => '86',
				'name'   => 'China',
			),
			'CX' => array(
				'alpha2' => 'CX',
				'alpha3' => 'CXR',
				'num'    => '162',
				'isd'    => '61',
				'name'   => 'Christmas Island',
			),
			'CC' => array(
				'alpha2' => 'CC',
				'alpha3' => 'CCK',
				'num'    => '166',
				'isd'    => '891',
				'name'   => 'Cocos (Keeling) Islands',
			),
			'CO' => array(
				'alpha2' => 'CO',
				'alpha3' => 'COL',
				'num'    => '170',
				'isd'    => '57',
				'name'   => 'Colombia',
			),
			'KM' => array(
				'alpha2' => 'KM',
				'alpha3' => 'COM',
				'num'    => '174',
				'isd'    => '269',
				'name'   => 'Comoros',
			),
			'CG' => array(
				'alpha2' => 'CG',
				'alpha3' => 'COG',
				'num'    => '178',
				'isd'    => '242',
				'name'   => 'Congo',
			),
			'CD' => array(
				'alpha2' => 'CD',
				'alpha3' => 'COD',
				'num'    => '180',
				'isd'    => '243',
				'name'   => 'The Democratic Republic of The Congo',
			),
			'CK' => array(
				'alpha2' => 'CK',
				'alpha3' => 'COK',
				'num'    => '184',
				'isd'    => '682',
				'name'   => 'Cook Islands',
			),
			'CR' => array(
				'alpha2' => 'CR',
				'alpha3' => 'CRI',
				'num'    => '188',
				'isd'    => '506',
				'name'   => 'Costa Rica',
			),
			'CI' => array(
				'alpha2' => 'CI',
				'alpha3' => 'CIV',
				'num'    => '384',
				'isd'    => '225',
				'name'   => 'Cote D\'ivoire',
			),
			'HR' => array(
				'alpha2' => 'HR',
				'alpha3' => 'HRV',
				'num'    => '191',
				'isd'    => '385',
				'name'   => 'Croatia',
			),
			'CU' => array(
				'alpha2' => 'CU',
				'alpha3' => 'CUB',
				'num'    => '192',
				'isd'    => '53',
				'name'   => 'Cuba',
			),
			'CY' => array(
				'alpha2' => 'CY',
				'alpha3' => 'CYP',
				'num'    => '196',
				'isd'    => '357',
				'name'   => 'Cyprus',
			),
			'CZ' => array(
				'alpha2' => 'CZ',
				'alpha3' => 'CZE',
				'num'    => '203',
				'isd'    => '420',
				'name'   => 'Czech Republic',
			),
			'DK' => array(
				'alpha2' => 'DK',
				'alpha3' => 'DNK',
				'num'    => '208',
				'isd'    => '45',
				'name'   => 'Denmark',
			),
			'DJ' => array(
				'alpha2' => 'DJ',
				'alpha3' => 'DJI',
				'num'    => '262',
				'isd'    => '253',
				'name'   => 'Djibouti',
			),
			'DM' => array(
				'alpha2' => 'DM',
				'alpha3' => 'DMA',
				'num'    => '212',
				'isd'    => '1767',
				'name'   => 'Dominica',
			),
			'DO' => array(
				'alpha2' => 'DO',
				'alpha3' => 'DOM',
				'num'    => '214',
				'isd'    => '1809',
				'name'   => 'Dominican Republic',
			),
			'EC' => array(
				'alpha2' => 'EC',
				'alpha3' => 'ECU',
				'num'    => '218',
				'isd'    => '593',
				'name'   => 'Ecuador',
			),
			'EG' => array(
				'alpha2' => 'EG',
				'alpha3' => 'EGY',
				'num'    => '818',
				'isd'    => '20',
				'name'   => 'Egypt',
			),
			'SV' => array(
				'alpha2' => 'SV',
				'alpha3' => 'SLV',
				'num'    => '222',
				'isd'    => '503',
				'name'   => 'El Salvador',
			),
			'GQ' => array(
				'alpha2' => 'GQ',
				'alpha3' => 'GNQ',
				'num'    => '226',
				'isd'    => '240',
				'name'   => 'Equatorial Guinea',
			),
			'ER' => array(
				'alpha2' => 'ER',
				'alpha3' => 'ERI',
				'num'    => '232',
				'isd'    => '291',
				'name'   => 'Eritrea',
			),
			'EE' => array(
				'alpha2' => 'EE',
				'alpha3' => 'EST',
				'num'    => '233',
				'isd'    => '372',
				'name'   => 'Estonia',
			),
			'ET' => array(
				'alpha2' => 'ET',
				'alpha3' => 'ETH',
				'num'    => '231',
				'isd'    => '251',
				'name'   => 'Ethiopia',
			),
			'FK' => array(
				'alpha2' => 'FK',
				'alpha3' => 'FLK',
				'num'    => '238',
				'isd'    => '500',
				'name'   => 'Falkland Islands (Malvinas)',
			),
			'FO' => array(
				'alpha2' => 'FO',
				'alpha3' => 'FRO',
				'num'    => '234',
				'isd'    => '298',
				'name'   => 'Faroe Islands',
			),
			'FJ' => array(
				'alpha2' => 'FJ',
				'alpha3' => 'FJI',
				'num'    => '243',
				'isd'    => '679',
				'name'   => 'Fiji',
			),
			'FI' => array(
				'alpha2' => 'FI',
				'alpha3' => 'FIN',
				'num'    => '246',
				'isd'    => '238',
				'name'   => 'Finland',
			),
			'FR' => array(
				'alpha2' => 'FR',
				'alpha3' => 'FRA',
				'num'    => '250',
				'isd'    => '33',
				'name'   => 'France',
			),
			'GF' => array(
				'alpha2' => 'GF',
				'alpha3' => 'GUF',
				'num'    => '254',
				'isd'    => '594',
				'name'   => 'French Guiana',
			),
			'PF' => array(
				'alpha2' => 'PF',
				'alpha3' => 'PYF',
				'num'    => '258',
				'isd'    => '689',
				'name'   => 'French Polynesia',
			),
			'TF' => array(
				'alpha2' => 'TF',
				'alpha3' => 'ATF',
				'num'    => '260',
				'isd'    => '262',
				'name'   => 'French Southern Territories',
			),
			'GA' => array(
				'alpha2' => 'GA',
				'alpha3' => 'GAB',
				'num'    => '266',
				'isd'    => '241',
				'name'   => 'Gabon',
			),
			'GM' => array(
				'alpha2' => 'GM',
				'alpha3' => 'GMB',
				'num'    => '270',
				'isd'    => '220',
				'name'   => 'Gambia',
			),
			'GE' => array(
				'alpha2' => 'GE',
				'alpha3' => 'GEO',
				'num'    => '268',
				'isd'    => '995',
				'name'   => 'Georgia',
			),
			'DE' => array(
				'alpha2' => 'DE',
				'alpha3' => 'DEU',
				'num'    => '276',
				'isd'    => '49',
				'name'   => 'Germany',
			),
			'GH' => array(
				'alpha2' => 'GH',
				'alpha3' => 'GHA',
				'num'    => '288',
				'isd'    => '233',
				'name'   => 'Ghana',
			),
			'GI' => array(
				'alpha2' => 'GI',
				'alpha3' => 'GIB',
				'num'    => '292',
				'isd'    => '350',
				'name'   => 'Gibraltar',
			),
			'GR' => array(
				'alpha2' => 'GR',
				'alpha3' => 'GRC',
				'num'    => '300',
				'isd'    => '30',
				'name'   => 'Greece',
			),
			'GL' => array(
				'alpha2' => 'GL',
				'alpha3' => 'GRL',
				'num'    => '304',
				'isd'    => '299',
				'name'   => 'Greenland',
			),
			'GD' => array(
				'alpha2' => 'GD',
				'alpha3' => 'GRD',
				'num'    => '308',
				'isd'    => '1473',
				'name'   => 'Grenada',
			),
			'GP' => array(
				'alpha2' => 'GP',
				'alpha3' => 'GLP',
				'num'    => '312',
				'isd'    => '590',
				'name'   => 'Guadeloupe',
			),
			'GU' => array(
				'alpha2' => 'GU',
				'alpha3' => 'GUM',
				'num'    => '316',
				'isd'    => '1871',
				'name'   => 'Guam',
			),
			'GT' => array(
				'alpha2' => 'GT',
				'alpha3' => 'GTM',
				'num'    => '320',
				'isd'    => '502',
				'name'   => 'Guatemala',
			),
			'GG' => array(
				'alpha2' => 'GG',
				'alpha3' => 'GGY',
				'num'    => '831',
				'isd'    => '44',
				'name'   => 'Guernsey',
			),
			'GN' => array(
				'alpha2' => 'GN',
				'alpha3' => 'GIN',
				'num'    => '324',
				'isd'    => '224',
				'name'   => 'Guinea',
			),
			'GW' => array(
				'alpha2' => 'GW',
				'alpha3' => 'GNB',
				'num'    => '624',
				'isd'    => '245',
				'name'   => 'Guinea-bissau',
			),
			'GY' => array(
				'alpha2' => 'GY',
				'alpha3' => 'GUY',
				'num'    => '328',
				'isd'    => '592',
				'name'   => 'Guyana',
			),
			'HT' => array(
				'alpha2' => 'HT',
				'alpha3' => 'HTI',
				'num'    => '332',
				'isd'    => '509',
				'name'   => 'Haiti',
			),
			'HM' => array(
				'alpha2' => 'HM',
				'alpha3' => 'HMD',
				'num'    => '334',
				'isd'    => '672',
				'name'   => 'Heard Island and Mcdonald Islands',
			),
			'VA' => array(
				'alpha2' => 'VA',
				'alpha3' => 'VAT',
				'num'    => '336',
				'isd'    => '379',
				'name'   => 'Holy See (Vatican City State)',
			),
			'HN' => array(
				'alpha2' => 'HN',
				'alpha3' => 'HND',
				'num'    => '340',
				'isd'    => '504',
				'name'   => 'Honduras',
			),
			'HK' => array(
				'alpha2' => 'HK',
				'alpha3' => 'HKG',
				'num'    => '344',
				'isd'    => '852',
				'name'   => 'Hong Kong',
			),
			'HU' => array(
				'alpha2' => 'HU',
				'alpha3' => 'HUN',
				'num'    => '348',
				'isd'    => '36',
				'name'   => 'Hungary',
			),
			'IS' => array(
				'alpha2' => 'IS',
				'alpha3' => 'ISL',
				'num'    => '352',
				'isd'    => '354',
				'name'   => 'Iceland',
			),
			'IN' => array(
				'alpha2' => 'IN',
				'alpha3' => 'IND',
				'num'    => '356',
				'isd'    => '91',
				'name'   => 'India',
			),
			'ID' => array(
				'alpha2' => 'ID',
				'alpha3' => 'IDN',
				'num'    => '360',
				'isd'    => '62',
				'name'   => 'Indonesia',
			),
			'IR' => array(
				'alpha2' => 'IR',
				'alpha3' => 'IRN',
				'num'    => '364',
				'isd'    => '98',
				'name'   => 'Iran',
			),
			'IQ' => array(
				'alpha2' => 'IQ',
				'alpha3' => 'IRQ',
				'num'    => '368',
				'isd'    => '964',
				'name'   => 'Iraq',
			),
			'IE' => array(
				'alpha2' => 'IE',
				'alpha3' => 'IRL',
				'num'    => '372',
				'isd'    => '353',
				'name'   => 'Ireland',
			),
			'IM' => array(
				'alpha2' => 'IM',
				'alpha3' => 'IMN',
				'num'    => '833',
				'isd'    => '44',
				'name'   => 'Isle of Man',
			),
			'IL' => array(
				'alpha2' => 'IL',
				'alpha3' => 'ISR',
				'num'    => '376',
				'isd'    => '972',
				'name'   => 'Israel',
			),
			'IT' => array(
				'alpha2' => 'IT',
				'alpha3' => 'ITA',
				'num'    => '380',
				'isd'    => '39',
				'name'   => 'Italy',
			),
			'JM' => array(
				'alpha2' => 'JM',
				'alpha3' => 'JAM',
				'num'    => '388',
				'isd'    => '1876',
				'name'   => 'Jamaica',
			),
			'JP' => array(
				'alpha2' => 'JP',
				'alpha3' => 'JPN',
				'num'    => '392',
				'isd'    => '81',
				'name'   => 'Japan',
			),
			'JE' => array(
				'alpha2' => 'JE',
				'alpha3' => 'JEY',
				'num'    => '832',
				'isd'    => '44',
				'name'   => 'Jersey',
			),
			'JO' => array(
				'alpha2' => 'JO',
				'alpha3' => 'JOR',
				'num'    => '400',
				'isd'    => '962',
				'name'   => 'Jordan',
			),
			'KZ' => array(
				'alpha2' => 'KZ',
				'alpha3' => 'KAZ',
				'num'    => '398',
				'isd'    => '7',
				'name'   => 'Kazakhstan',
			),
			'KE' => array(
				'alpha2' => 'KE',
				'alpha3' => 'KEN',
				'num'    => '404',
				'isd'    => '254',
				'name'   => 'Kenya',
			),
			'KI' => array(
				'alpha2' => 'KI',
				'alpha3' => 'KIR',
				'num'    => '296',
				'isd'    => '686',
				'name'   => 'Kiribati',
			),
			'KP' => array(
				'alpha2' => 'KP',
				'alpha3' => 'PRK',
				'num'    => '408',
				'isd'    => '850',
				'name'   => 'Democratic People\'s Republic of Korea',
			),
			'KR' => array(
				'alpha2' => 'KR',
				'alpha3' => 'KOR',
				'num'    => '410',
				'isd'    => '82',
				'name'   => 'Republic of Korea',
			),
			'KW' => array(
				'alpha2' => 'KW',
				'alpha3' => 'KWT',
				'num'    => '414',
				'isd'    => '965',
				'name'   => 'Kuwait',
			),
			'KG' => array(
				'alpha2' => 'KG',
				'alpha3' => 'KGZ',
				'num'    => '417',
				'isd'    => '996',
				'name'   => 'Kyrgyzstan',
			),
			'LA' => array(
				'alpha2' => 'LA',
				'alpha3' => 'LAO',
				'num'    => '418',
				'isd'    => '856',
				'name'   => 'Lao People\'s Democratic Republic',
			),
			'LV' => array(
				'alpha2' => 'LV',
				'alpha3' => 'LVA',
				'num'    => '428',
				'isd'    => '371',
				'name'   => 'Latvia',
			),
			'LB' => array(
				'alpha2' => 'LB',
				'alpha3' => 'LBN',
				'num'    => '422',
				'isd'    => '961',
				'name'   => 'Lebanon',
			),
			'LS' => array(
				'alpha2' => 'LS',
				'alpha3' => 'LSO',
				'num'    => '426',
				'isd'    => '266',
				'name'   => 'Lesotho',
			),
			'LR' => array(
				'alpha2' => 'LR',
				'alpha3' => 'LBR',
				'num'    => '430',
				'isd'    => '231',
				'name'   => 'Liberia',
			),
			'LY' => array(
				'alpha2' => 'LY',
				'alpha3' => 'LBY',
				'num'    => '434',
				'isd'    => '218',
				'name'   => 'Libya',
			),
			'LI' => array(
				'alpha2' => 'LI',
				'alpha3' => 'LIE',
				'num'    => '438',
				'isd'    => '423',
				'name'   => 'Liechtenstein',
			),
			'LT' => array(
				'alpha2' => 'LT',
				'alpha3' => 'LTU',
				'num'    => '440',
				'isd'    => '370',
				'name'   => 'Lithuania',
			),
			'LU' => array(
				'alpha2' => 'LU',
				'alpha3' => 'LUX',
				'num'    => '442',
				'isd'    => '352',
				'name'   => 'Luxembourg',
			),
			'MO' => array(
				'alpha2' => 'MO',
				'alpha3' => 'MAC',
				'num'    => '446',
				'isd'    => '853',
				'name'   => 'Macao',
			),
			'MK' => array(
				'alpha2' => 'MK',
				'alpha3' => 'MKD',
				'num'    => '807',
				'isd'    => '389',
				'name'   => 'Macedonia',
			),
			'MG' => array(
				'alpha2' => 'MG',
				'alpha3' => 'MDG',
				'num'    => '450',
				'isd'    => '261',
				'name'   => 'Madagascar',
			),
			'MW' => array(
				'alpha2' => 'MW',
				'alpha3' => 'MWI',
				'num'    => '454',
				'isd'    => '265',
				'name'   => 'Malawi',
			),
			'MY' => array(
				'alpha2' => 'MY',
				'alpha3' => 'MYS',
				'num'    => '458',
				'isd'    => '60',
				'name'   => 'Malaysia',
			),
			'MV' => array(
				'alpha2' => 'MV',
				'alpha3' => 'MDV',
				'num'    => '462',
				'isd'    => '960',
				'name'   => 'Maldives',
			),
			'ML' => array(
				'alpha2' => 'ML',
				'alpha3' => 'MLI',
				'num'    => '466',
				'isd'    => '223',
				'name'   => 'Mali',
			),
			'MT' => array(
				'alpha2' => 'MT',
				'alpha3' => 'MLT',
				'num'    => '470',
				'isd'    => '356',
				'name'   => 'Malta',
			),
			'MH' => array(
				'alpha2' => 'MH',
				'alpha3' => 'MHL',
				'num'    => '584',
				'isd'    => '692',
				'name'   => 'Marshall Islands',
			),
			'MQ' => array(
				'alpha2' => 'MQ',
				'alpha3' => 'MTQ',
				'num'    => '474',
				'isd'    => '596',
				'name'   => 'Martinique',
			),
			'MR' => array(
				'alpha2' => 'MR',
				'alpha3' => 'MRT',
				'num'    => '478',
				'isd'    => '222',
				'name'   => 'Mauritania',
			),
			'MU' => array(
				'alpha2' => 'MU',
				'alpha3' => 'MUS',
				'num'    => '480',
				'isd'    => '230',
				'name'   => 'Mauritius',
			),
			'YT' => array(
				'alpha2' => 'YT',
				'alpha3' => 'MYT',
				'num'    => '175',
				'isd'    => '262',
				'name'   => 'Mayotte',
			),
			'MX' => array(
				'alpha2' => 'MX',
				'alpha3' => 'MEX',
				'num'    => '484',
				'isd'    => '52',
				'name'   => 'Mexico',
			),
			'FM' => array(
				'alpha2' => 'FM',
				'alpha3' => 'FSM',
				'num'    => '583',
				'isd'    => '691',
				'name'   => 'Micronesia',
			),
			'MD' => array(
				'alpha2' => 'MD',
				'alpha3' => 'MDA',
				'num'    => '498',
				'isd'    => '373',
				'name'   => 'Moldova',
			),
			'MC' => array(
				'alpha2' => 'MC',
				'alpha3' => 'MCO',
				'num'    => '492',
				'isd'    => '377',
				'name'   => 'Monaco',
			),
			'MN' => array(
				'alpha2' => 'MN',
				'alpha3' => 'MNG',
				'num'    => '496',
				'isd'    => '976',
				'name'   => 'Mongolia',
			),
			'ME' => array(
				'alpha2' => 'ME',
				'alpha3' => 'MNE',
				'num'    => '499',
				'isd'    => '382',
				'name'   => 'Montenegro',
			),
			'MS' => array(
				'alpha2' => 'MS',
				'alpha3' => 'MSR',
				'num'    => '500',
				'isd'    => '1664',
				'name'   => 'Montserrat',
			),
			'MA' => array(
				'alpha2' => 'MA',
				'alpha3' => 'MAR',
				'num'    => '504',
				'isd'    => '212',
				'name'   => 'Morocco',
			),
			'MZ' => array(
				'alpha2' => 'MZ',
				'alpha3' => 'MOZ',
				'num'    => '508',
				'isd'    => '258',
				'name'   => 'Mozambique',
			),
			'MM' => array(
				'alpha2' => 'MM',
				'alpha3' => 'MMR',
				'num'    => '104',
				'isd'    => '95',
				'name'   => 'Myanmar',
			),
			'NA' => array(
				'alpha2' => 'NA',
				'alpha3' => 'NAM',
				'num'    => '516',
				'isd'    => '264',
				'name'   => 'Namibia',
			),
			'NR' => array(
				'alpha2' => 'NR',
				'alpha3' => 'NRU',
				'num'    => '520',
				'isd'    => '674',
				'name'   => 'Nauru',
			),
			'NP' => array(
				'alpha2' => 'NP',
				'alpha3' => 'NPL',
				'num'    => '524',
				'isd'    => '977',
				'name'   => 'Nepal',
			),
			'NL' => array(
				'alpha2' => 'NL',
				'alpha3' => 'NLD',
				'num'    => '528',
				'isd'    => '31',
				'name'   => 'Netherlands',
			),
			'AN' => array(
				'alpha2' => 'AN',
				'alpha3' => 'ANT',
				'num'    => '530',
				'isd'    => '599',
				'name'   => 'Netherlands Antilles',
			),
			'NC' => array(
				'alpha2' => 'NC',
				'alpha3' => 'NCL',
				'num'    => '540',
				'isd'    => '687',
				'name'   => 'New Caledonia',
			),
			'NZ' => array(
				'alpha2' => 'NZ',
				'alpha3' => 'NZL',
				'num'    => '554',
				'isd'    => '64',
				'name'   => 'New Zealand',
			),
			'NI' => array(
				'alpha2' => 'NI',
				'alpha3' => 'NIC',
				'num'    => '558',
				'isd'    => '505',
				'name'   => 'Nicaragua',
			),
			'NE' => array(
				'alpha2' => 'NE',
				'alpha3' => 'NER',
				'num'    => '562',
				'isd'    => '227',
				'name'   => 'Niger',
			),
			'NG' => array(
				'alpha2' => 'NG',
				'alpha3' => 'NGA',
				'num'    => '566',
				'isd'    => '234',
				'name'   => 'Nigeria',
			),
			'NU' => array(
				'alpha2' => 'NU',
				'alpha3' => 'NIU',
				'num'    => '570',
				'isd'    => '683',
				'name'   => 'Niue',
			),
			'NF' => array(
				'alpha2' => 'NF',
				'alpha3' => 'NFK',
				'num'    => '574',
				'isd'    => '672',
				'name'   => 'Norfolk Island',
			),
			'MP' => array(
				'alpha2' => 'MP',
				'alpha3' => 'MNP',
				'num'    => '580',
				'isd'    => '1670',
				'name'   => 'Northern Mariana Islands',
			),
			'NO' => array(
				'alpha2' => 'NO',
				'alpha3' => 'NOR',
				'num'    => '578',
				'isd'    => '47',
				'name'   => 'Norway',
			),
			'OM' => array(
				'alpha2' => 'OM',
				'alpha3' => 'OMN',
				'num'    => '512',
				'isd'    => '968',
				'name'   => 'Oman',
			),
			'PK' => array(
				'alpha2' => 'PK',
				'alpha3' => 'PAK',
				'num'    => '586',
				'isd'    => '92',
				'name'   => 'Pakistan',
			),
			'PW' => array(
				'alpha2' => 'PW',
				'alpha3' => 'PLW',
				'num'    => '585',
				'isd'    => '680',
				'name'   => 'Palau',
			),
			'PS' => array(
				'alpha2' => 'PS',
				'alpha3' => 'PSE',
				'num'    => '275',
				'isd'    => '970',
				'name'   => 'Palestinia',
			),
			'PA' => array(
				'alpha2' => 'PA',
				'alpha3' => 'PAN',
				'num'    => '591',
				'isd'    => '507',
				'name'   => 'Panama',
			),
			'PG' => array(
				'alpha2' => 'PG',
				'alpha3' => 'PNG',
				'num'    => '598',
				'isd'    => '675',
				'name'   => 'Papua New Guinea',
			),
			'PY' => array(
				'alpha2' => 'PY',
				'alpha3' => 'PRY',
				'num'    => '600',
				'isd'    => '595',
				'name'   => 'Paraguay',
			),
			'PE' => array(
				'alpha2' => 'PE',
				'alpha3' => 'PER',
				'num'    => '604',
				'isd'    => '51',
				'name'   => 'Peru',
			),
			'PH' => array(
				'alpha2' => 'PH',
				'alpha3' => 'PHL',
				'num'    => '608',
				'isd'    => '63',
				'name'   => 'Philippines',
			),
			'PN' => array(
				'alpha2' => 'PN',
				'alpha3' => 'PCN',
				'num'    => '612',
				'isd'    => '870',
				'name'   => 'Pitcairn',
			),
			'PL' => array(
				'alpha2' => 'PL',
				'alpha3' => 'POL',
				'num'    => '616',
				'isd'    => '48',
				'name'   => 'Poland',
			),
			'PT' => array(
				'alpha2' => 'PT',
				'alpha3' => 'PRT',
				'num'    => '620',
				'isd'    => '351',
				'name'   => 'Portugal',
			),
			'PR' => array(
				'alpha2' => 'PR',
				'alpha3' => 'PRI',
				'num'    => '630',
				'isd'    => '1',
				'name'   => 'Puerto Rico',
			),
			'QA' => array(
				'alpha2' => 'QA',
				'alpha3' => 'QAT',
				'num'    => '634',
				'isd'    => '974',
				'name'   => 'Qatar',
			),
			'RE' => array(
				'alpha2' => 'RE',
				'alpha3' => 'REU',
				'num'    => '638',
				'isd'    => '262',
				'name'   => 'Reunion',
			),
			'RO' => array(
				'alpha2' => 'RO',
				'alpha3' => 'ROU',
				'num'    => '642',
				'isd'    => '40',
				'name'   => 'Romania',
			),
			'RU' => array(
				'alpha2' => 'RU',
				'alpha3' => 'RUS',
				'num'    => '643',
				'isd'    => '7',
				'name'   => 'Russian Federation',
			),
			'RW' => array(
				'alpha2' => 'RW',
				'alpha3' => 'RWA',
				'num'    => '646',
				'isd'    => '250',
				'name'   => 'Rwanda',
			),
			'SH' => array(
				'alpha2' => 'SH',
				'alpha3' => 'SHN',
				'num'    => '654',
				'isd'    => '290',
				'name'   => 'Saint Helena',
			),
			'KN' => array(
				'alpha2' => 'KN',
				'alpha3' => 'KNA',
				'num'    => '659',
				'isd'    => '1869',
				'name'   => 'Saint Kitts and Nevis',
			),
			'LC' => array(
				'alpha2' => 'LC',
				'alpha3' => 'LCA',
				'num'    => '662',
				'isd'    => '1758',
				'name'   => 'Saint Lucia',
			),
			'PM' => array(
				'alpha2' => 'PM',
				'alpha3' => 'SPM',
				'num'    => '666',
				'isd'    => '508',
				'name'   => 'Saint Pierre and Miquelon',
			),
			'VC' => array(
				'alpha2' => 'VC',
				'alpha3' => 'VCT',
				'num'    => '670',
				'isd'    => '1784',
				'name'   => 'Saint Vincent and The Grenadines',
			),
			'WS' => array(
				'alpha2' => 'WS',
				'alpha3' => 'WSM',
				'num'    => '882',
				'isd'    => '685',
				'name'   => 'Samoa',
			),
			'SM' => array(
				'alpha2' => 'SM',
				'alpha3' => 'SMR',
				'num'    => '674',
				'isd'    => '378',
				'name'   => 'San Marino',
			),
			'ST' => array(
				'alpha2' => 'ST',
				'alpha3' => 'STP',
				'num'    => '678',
				'isd'    => '239',
				'name'   => 'Sao Tome and Principe',
			),
			'SA' => array(
				'alpha2' => 'SA',
				'alpha3' => 'SAU',
				'num'    => '682',
				'isd'    => '966',
				'name'   => 'Saudi Arabia',
			),
			'SN' => array(
				'alpha2' => 'SN',
				'alpha3' => 'SEN',
				'num'    => '686',
				'isd'    => '221',
				'name'   => 'Senegal',
			),
			'RS' => array(
				'alpha2' => 'RS',
				'alpha3' => 'SRB',
				'num'    => '688',
				'isd'    => '381',
				'name'   => 'Serbia',
			),
			'SC' => array(
				'alpha2' => 'SC',
				'alpha3' => 'SYC',
				'num'    => '690',
				'isd'    => '248',
				'name'   => 'Seychelles',
			),
			'SL' => array(
				'alpha2' => 'SL',
				'alpha3' => 'SLE',
				'num'    => '694',
				'isd'    => '232',
				'name'   => 'Sierra Leone',
			),
			'SG' => array(
				'alpha2' => 'SG',
				'alpha3' => 'SGP',
				'num'    => '702',
				'isd'    => '65',
				'name'   => 'Singapore',
			),
			'SK' => array(
				'alpha2' => 'SK',
				'alpha3' => 'SVK',
				'num'    => '703',
				'isd'    => '421',
				'name'   => 'Slovakia',
			),
			'SI' => array(
				'alpha2' => 'SI',
				'alpha3' => 'SVN',
				'num'    => '705',
				'isd'    => '386',
				'name'   => 'Slovenia',
			),
			'SB' => array(
				'alpha2' => 'SB',
				'alpha3' => 'SLB',
				'num'    => '090',
				'isd'    => '677',
				'name'   => 'Solomon Islands',
			),
			'SO' => array(
				'alpha2' => 'SO',
				'alpha3' => 'SOM',
				'num'    => '706',
				'isd'    => '252',
				'name'   => 'Somalia',
			),
			'ZA' => array(
				'alpha2' => 'ZA',
				'alpha3' => 'ZAF',
				'num'    => '729',
				'isd'    => '27',
				'name'   => 'South Africa',
			),
			'SS' => array(
				'alpha2' => 'SS',
				'alpha3' => 'SSD',
				'num'    => '710',
				'isd'    => '211',
				'name'   => 'South Sudan',
			),
			'GS' => array(
				'alpha2' => 'GS',
				'alpha3' => 'SGS',
				'num'    => '239',
				'isd'    => '500',
				'name'   => 'South Georgia and The South Sandwich Islands',
			),
			'ES' => array(
				'alpha2' => 'ES',
				'alpha3' => 'ESP',
				'num'    => '724',
				'isd'    => '34',
				'name'   => 'Spain',
			),
			'LK' => array(
				'alpha2' => 'LK',
				'alpha3' => 'LKA',
				'num'    => '144',
				'isd'    => '94',
				'name'   => 'Sri Lanka',
			),
			'SD' => array(
				'alpha2' => 'SD',
				'alpha3' => 'SDN',
				'num'    => '736',
				'isd'    => '249',
				'name'   => 'Sudan',
			),
			'SR' => array(
				'alpha2' => 'SR',
				'alpha3' => 'SUR',
				'num'    => '740',
				'isd'    => '597',
				'name'   => 'Suriname',
			),
			'SJ' => array(
				'alpha2' => 'SJ',
				'alpha3' => 'SJM',
				'num'    => '744',
				'isd'    => '47',
				'name'   => 'Svalbard and Jan Mayen',
			),
			'SZ' => array(
				'alpha2' => 'SZ',
				'alpha3' => 'SWZ',
				'num'    => '748',
				'isd'    => '268',
				'name'   => 'Swaziland',
			),
			'SE' => array(
				'alpha2' => 'SE',
				'alpha3' => 'SWE',
				'num'    => '752',
				'isd'    => '46',
				'name'   => 'Sweden',
			),
			'CH' => array(
				'alpha2' => 'CH',
				'alpha3' => 'CHE',
				'num'    => '756',
				'isd'    => '41',
				'name'   => 'Switzerland',
			),
			'SY' => array(
				'alpha2' => 'SY',
				'alpha3' => 'SYR',
				'num'    => '760',
				'isd'    => '963',
				'name'   => 'Syrian Arab Republic',
			),
			'TW' => array(
				'alpha2' => 'TW',
				'alpha3' => 'TWN',
				'num'    => '158',
				'isd'    => '886',
				'name'   => 'Taiwan, Province of China',
			),
			'TJ' => array(
				'alpha2' => 'TJ',
				'alpha3' => 'TJK',
				'num'    => '762',
				'isd'    => '992',
				'name'   => 'Tajikistan',
			),
			'TZ' => array(
				'alpha2' => 'TZ',
				'alpha3' => 'TZA',
				'num'    => '834',
				'isd'    => '255',
				'name'   => 'Tanzania, United Republic of',
			),
			'TH' => array(
				'alpha2' => 'TH',
				'alpha3' => 'THA',
				'num'    => '764',
				'isd'    => '66',
				'name'   => 'Thailand',
			),
			'TL' => array(
				'alpha2' => 'TL',
				'alpha3' => 'TLS',
				'num'    => '626',
				'isd'    => '670',
				'name'   => 'Timor-leste',
			),
			'TG' => array(
				'alpha2' => 'TG',
				'alpha3' => 'TGO',
				'num'    => '768',
				'isd'    => '228',
				'name'   => 'Togo',
			),
			'TK' => array(
				'alpha2' => 'TK',
				'alpha3' => 'TKL',
				'num'    => '772',
				'isd'    => '690',
				'name'   => 'Tokelau',
			),
			'TO' => array(
				'alpha2' => 'TO',
				'alpha3' => 'TON',
				'num'    => '776',
				'isd'    => '676',
				'name'   => 'Tonga',
			),
			'TT' => array(
				'alpha2' => 'TT',
				'alpha3' => 'TTO',
				'num'    => '780',
				'isd'    => '1868',
				'name'   => 'Trinidad and Tobago',
			),
			'TN' => array(
				'alpha2' => 'TN',
				'alpha3' => 'TUN',
				'num'    => '788',
				'isd'    => '216',
				'name'   => 'Tunisia',
			),
			'TR' => array(
				'alpha2' => 'TR',
				'alpha3' => 'TUR',
				'num'    => '792',
				'isd'    => '90',
				'name'   => 'Turkey',
			),
			'TM' => array(
				'alpha2' => 'TM',
				'alpha3' => 'TKM',
				'num'    => '795',
				'isd'    => '993',
				'name'   => 'Turkmenistan',
			),
			'TC' => array(
				'alpha2' => 'TC',
				'alpha3' => 'TCA',
				'num'    => '796',
				'isd'    => '1649',
				'name'   => 'Turks and Caicos Islands',
			),
			'TV' => array(
				'alpha2' => 'TV',
				'alpha3' => 'TUV',
				'num'    => '798',
				'isd'    => '688',
				'name'   => 'Tuvalu',
			),
			'UG' => array(
				'alpha2' => 'UG',
				'alpha3' => 'UGA',
				'num'    => '800',
				'isd'    => '256',
				'name'   => 'Uganda',
			),
			'UA' => array(
				'alpha2' => 'UA',
				'alpha3' => 'UKR',
				'num'    => '804',
				'isd'    => '380',
				'name'   => 'Ukraine',
			),
			'AE' => array(
				'alpha2' => 'AE',
				'alpha3' => 'ARE',
				'num'    => '784',
				'isd'    => '971',
				'name'   => 'United Arab Emirates',
			),
			'GB' => array(
				'alpha2' => 'GB',
				'alpha3' => 'GBR',
				'num'    => '826',
				'isd'    => '44',
				'name'   => 'United Kingdom',
			),
			'US' => array(
				'alpha2' => 'US',
				'alpha3' => 'USA',
				'num'    => '840',
				'isd'    => '1',
				'name'   => 'United States',
			),
			'UM' => array(
				'alpha2' => 'UM',
				'alpha3' => 'UMI',
				'num'    => '581',
				'isd'    => '1',
				'name'   => 'United States Minor Outlying Islands',
			),
			'UY' => array(
				'alpha2' => 'UY',
				'alpha3' => 'URY',
				'num'    => '858',
				'isd'    => '598',
				'name'   => 'Uruguay',
			),
			'UZ' => array(
				'alpha2' => 'UZ',
				'alpha3' => 'UZB',
				'num'    => '860',
				'isd'    => '998',
				'name'   => 'Uzbekistan',
			),
			'VU' => array(
				'alpha2' => 'VU',
				'alpha3' => 'VUT',
				'num'    => '548',
				'isd'    => '678',
				'name'   => 'Vanuatu',
			),
			'VE' => array(
				'alpha2' => 'VE',
				'alpha3' => 'VEN',
				'num'    => '862',
				'isd'    => '58',
				'name'   => 'Venezuela',
			),
			'VN' => array(
				'alpha2' => 'VN',
				'alpha3' => 'VNM',
				'num'    => '704',
				'isd'    => '84',
				'name'   => 'Vietnam',
			),
			'VG' => array(
				'alpha2' => 'VG',
				'alpha3' => 'VGB',
				'num'    => '092',
				'isd'    => '1284',
				'name'   => 'Virgin Islands, British',
			),
			'VI' => array(
				'alpha2' => 'VI',
				'alpha3' => 'VIR',
				'num'    => '850',
				'isd'    => '1430',
				'name'   => 'Virgin Islands, U.S.',
			),
			'WF' => array(
				'alpha2' => 'WF',
				'alpha3' => 'WLF',
				'num'    => '876',
				'isd'    => '681',
				'name'   => 'Wallis and Futuna',
			),
			'EH' => array(
				'alpha2' => 'EH',
				'alpha3' => 'ESH',
				'num'    => '732',
				'isd'    => '212',
				'name'   => 'Western Sahara',
			),
			'YE' => array(
				'alpha2' => 'YE',
				'alpha3' => 'YEM',
				'num'    => '887',
				'isd'    => '967',
				'name'   => 'Yemen',
			),
			'ZM' => array(
				'alpha2' => 'ZM',
				'alpha3' => 'ZMB',
				'num'    => '894',
				'isd'    => '260',
				'name'   => 'Zambia',
			),
			'ZW' => array(
				'alpha2' => 'ZW',
				'alpha3' => 'ZWE',
				'num'    => '716',
				'isd'    => '263',
				'name'   => 'Zimbabwe',
			),
		);
	}
}
