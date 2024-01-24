<?php
/**
 * The menus field class file.
 *
 * @package    Mazepress\Core
 * @subpackage Forms\Fields
 */

declare(strict_types=1);

namespace Mazepress\Core\Forms\Fields;

use Mazepress\Core\Forms\Fields\Select;

/**
 * The Menus class.
 */
class Menus extends Select {

	/**
	 * Initiate class.
	 *
	 * @param string $name       The field name.
	 * @param int    $value      The field value.
	 * @param string $empty_text The field empty text.
	 */
	public function __construct( string $name, int $value = 0, string $empty_text = '' ) {

		$menus   = wp_get_nav_menus();
		$options = array();

		foreach ( $menus as $menu ) {
			$options[ absint( $menu->term_id ) ] = $menu->name;
		}

		// Set the required values.
		$this->set_name( $name );
		$this->set_value( $value );
		$this->set_empty_text( $empty_text );
		$this->set_options( $options );
	}
}
