<?php
/**
 * The button field class file.
 *
 * @package    Mazepress\Core
 * @subpackage Forms\Field
 */

declare(strict_types=1);

namespace Mazepress\Core\Forms\Field;

use Mazepress\Core\Forms\Field\BaseField;

/**
 * The Button class.
 */
class Button extends BaseField {

	/**
	 * Initiate class.
	 *
	 * @param string $name  The button name.
	 * @param string $label The button label.
	 * @param string $value The button value.
	 * @param string $type  The button type.
	 */
	public function __construct( string $name, string $label, string $value = '', $type = 'submit' ) {

		// Set the required values.
		$this->set_name( $name );
		$this->set_label( $label );
		$this->set_value( $value );
		$this->set_type( $type );
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
			'<button type="%1$s" name="%2$s" value="%3$s" %4$s>%5$s</button>',
			$this->get_type(),
			$this->get_name(),
			! empty( $this->get_value() ) ? $this->get_value() : '',
			implode( ' ', $attributes ),
			$this->get_label()
		);

		echo $html; //phpcs:ignore WordPress.Security.EscapeOutput
	}
}
