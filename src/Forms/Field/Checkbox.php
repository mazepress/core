<?php
/**
 * The checkbox field class file.
 *
 * @package    Mazepress\Core
 * @subpackage Forms\Field
 */

declare(strict_types=1);

namespace Mazepress\Core\Forms\Field;

use Mazepress\Core\Forms\Field\BaseField;

/**
 * The Checkbox class.
 */
class Checkbox extends BaseField {

	/**
	 * Initiate class.
	 *
	 * @param string $name  The field name.
	 * @param mixed  $value The field value.
	 */
	public function __construct( string $name, $value = null ) {

		// Set the required values.
		$this->set_type( 'checkbox' );
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
		$attrid     = '';

		foreach ( $this->get_attributes() as $key => $value ) {

			if ( 'id' === $key && ! empty( $value ) ) {
				$attrid = $value;
				continue;
			}

			$attributes[] = sprintf( '%1$s="%2$s"', $key, $value );
		}

		$html = '';
		$name = $this->get_name();

		if ( 1 < count( $this->get_options() ) ) {
			$name .= '[]';
		}

		foreach ( $this->get_options() as $key => $value ) {

			if ( is_array( $this->get_value() ) ) {
				$checked = in_array( $key, $this->get_value(), true ) ? 'checked' : '';
			} else {
				$checked = ( $this->get_value() === $key ) ? 'checked' : '';
			}

			$option_attributes = array();

			if ( ! empty( $attrid ) ) {
				$option_attributes[] = sprintf(
					'id="%1$s-%2$s"',
					\esc_attr( $attrid ),
					\esc_attr( $key )
				);
			}

			if ( is_array( $value ) && ! empty( $value['text'] ) ) {

				foreach ( $value as $option_key => $option_value ) {
					if ( 'text' !== $option_key ) {
						$option_attributes[] = sprintf( '%1$s="%2$s"', $option_key, \esc_attr( $option_value ) );
					}
				}

				$field_value = ! empty( $value['value'] ) ? $value['value'] : $key;
				$field_text  = $value['text'];
			} else {
				$field_value = $key;
				$field_text  = $value;
			}

			$html .= sprintf(
				'<label class="form-check-label">
					<input type="checkbox" name="%1$s" %2$s %3$s %4$s value="%5$s"/>%6$s
					<span class="form-check-icon"></span>
				</label>',
				$name,
				\esc_attr( $checked ),
				implode( ' ', $attributes ),
				implode( ' ', $option_attributes ),
				\esc_attr( $field_value ),
				\esc_html( $field_text )
			);
		}

		echo $html; //phpcs:ignore WordPress.Security.EscapeOutput
	}
}
