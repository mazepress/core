<?php
/**
 * The textarea field class file.
 *
 * @package    Mazepress\Core
 * @subpackage Forms\Field
 */

declare(strict_types=1);

namespace Mazepress\Core\Forms\Field;

use Mazepress\Core\Forms\Field\BaseField;

/**
 * The Textarea class.
 */
class Textarea extends BaseField {

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
	 * @return void
	 */
	public function render(): void {

		$attributes = array();

		foreach ( $this->get_attributes() as $key => $value ) {
			$attributes[] = sprintf( '%1$s="%2$s"', $key, $value );
		}

		$html = sprintf(
			'<textarea name="%1$s" %2$s rows="4">%3$s</textarea>',
			$this->get_name(),
			implode( ' ', $attributes ),
			! empty( $this->get_value() ) ? $this->get_value() : '',
		);

		echo $html; //phpcs:ignore WordPress.Security.EscapeOutput
	}
}
