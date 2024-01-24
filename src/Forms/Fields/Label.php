<?php
/**
 * The label field class file.
 *
 * @package    Mazepress\Core
 * @subpackage Forms\Fields
 */

declare(strict_types=1);

namespace Mazepress\Core\Forms\Fields;

use Mazepress\Core\Forms\Fields\Field;

/**
 * The Label class.
 */
class Label extends Field {

	/**
	 * Initiate class.
	 *
	 * @param string $label The field label.
	 * @param string $name  The field name.
	 */
	public function __construct( string $label, string $name = '' ) {

		// Set the required values.
		$this->set_type( 'label' );
		$this->set_name( $name );
		$this->set_label( $label );
	}

	/**
	 * Render the input field.
	 *
	 * @param bool $print Print the output.
	 *
	 * @return string
	 */
	public function render( bool $print = false ): string {

		$attributes = '';

		foreach ( $this->get_attributes() as $key => $value ) {
			$attributes .= sprintf( '%1$s="%2$s" ', $key, $value );
		}

		$html = sprintf(
			'<label %1$s>%2$s</label>',
			$attributes,
			$this->get_label()
		);

		if ( $print ) {
			echo $html; //phpcs:ignore WordPress.Security.EscapeOutput
		}

		return $html;
	}
}
