<?php
/**
 * The textarea field class file.
 *
 * @package    Mazepress\Core
 * @subpackage Forms\Fields
 */

declare(strict_types=1);

namespace Mazepress\Core\Forms\Fields;

use Mazepress\Core\Forms\Fields\Field;

/**
 * The Textarea class.
 */
class Textarea extends Field {

	/**
	 * Initiate class.
	 *
	 * @param string $name  The field name.
	 * @param mixed  $value The field value.
	 */
	public function __construct( string $name, $value = null ) {

		// Set the required values.
		$this->set_type( 'textarea' );
		$this->set_name( $name );
		$this->set_value( $value );
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
			'<textarea name="%1$s" %2$s rows="4">%3$s</textarea>',
			$this->get_name(),
			$attributes,
			! empty( $this->get_value() ) ? $this->get_value() : '',
		);

		if ( $print ) {
			echo $html; //phpcs:ignore WordPress.Security.EscapeOutput
		}

		return $html;
	}
}
