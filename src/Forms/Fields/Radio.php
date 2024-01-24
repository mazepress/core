<?php
/**
 * The radio field class file.
 *
 * @package    Mazepress\Core
 * @subpackage Forms\Fields
 */

declare(strict_types=1);

namespace Mazepress\Core\Forms\Fields;

use Mazepress\Core\Forms\Fields\Field;

/**
 * The Radio class.
 */
class Radio extends Field {

	/**
	 * Initiate class.
	 *
	 * @param string $name  The field name.
	 * @param mixed  $value The field value.
	 */
	public function __construct( string $name, $value = null ) {

		// Set the required values.
		$this->set_type( 'radio' );
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
		$attrid     = '';

		foreach ( $this->get_attributes() as $key => $value ) {

			if ( 'id' === $key && ! empty( $value ) ) {
				$attrid = $value;
				continue;
			}

			$attributes .= sprintf( '%1$s="%2$s" ', $key, $value );
		}

		$html = '';

		foreach ( $this->get_options() as $key => $value ) {

			if ( is_array( $this->get_value() ) ) {
				$checked = in_array( $key, $this->get_value(), true ) ? 'checked' : '';
			} elseif ( is_string( $this->get_value() ) ) {
				$checked = ( $this->get_value() === $key ) ? 'checked' : '';
			} else {
				$checked = ( absint( $this->get_value() ) === $key ) ? 'checked' : '';
			}

			$option_attributes = '';

			if ( ! empty( $attrid ) ) {
				$option_attributes .= sprintf(
					'id="%1$s-%2$s" ',
					esc_attr( $attrid ),
					esc_attr( $key )
				);
			}

			if ( is_array( $value ) && ! empty( $value['value'] ) && ! empty( $value['text'] ) ) {

				foreach ( $value as $option_key => $option_value ) {
					if ( 'value' !== $option_key && 'text' !== $option_key ) {
						$option_attributes .= sprintf( '%1$s="%2$s" ', $option_key, esc_attr( $option_value ) );
					}
				}

				$field_value = $value['value'];
				$field_text  = $value['text'];
			} else {
				$field_value = $key;
				$field_text  = $value;
			}

			$html .= sprintf(
				'<label class="form-check-label">
					<input type="radio" name="%1$s" %2$s %3$s %4$s value="%5$s"/>%6$s
					<span class="form-check-icon"></span>
				</label>',
				$this->get_name(),
				esc_attr( $checked ),
				$attributes,
				$option_attributes,
				esc_attr( $field_value ),
				esc_html( $field_text )
			);
		}

		if ( $print ) {
			echo $html; //phpcs:ignore WordPress.Security.EscapeOutput
		}

		return $html;
	}
}
