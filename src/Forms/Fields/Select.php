<?php
/**
 * The select field class file.
 *
 * @package    Mazepress\Core
 * @subpackage Forms\Fields
 */

declare(strict_types=1);

namespace Mazepress\Core\Forms\Fields;

use Mazepress\Core\Forms\Fields\Field;

/**
 * The Select class.
 */
class Select extends Field {

	/**
	 * Initiate class.
	 *
	 * @param string $name       The field name.
	 * @param mixed  $value      The field value.
	 * @param string $empty_text The field empty text.
	 */
	public function __construct( string $name, $value = null, string $empty_text = '' ) {

		// Set the required values.
		$this->set_type( 'select' );
		$this->set_name( $name );
		$this->set_value( $value );
		$this->set_empty_text( $empty_text );
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
			'<select name="%1$s" %2$s>',
			$this->get_name(),
			$attributes
		);

		if ( ! empty( $this->get_empty_text() ) ) {
			$html .= sprintf(
				'<option value="">%1$s</option>',
				esc_html( $this->get_empty_text() )
			);
		}

		foreach ( $this->get_options() as $key => $value ) {

			if ( is_array( $this->get_value() ) ) {
				$selected = in_array( $key, $this->get_value(), true ) ? 'selected' : '';
			} elseif ( is_string( $this->get_value() ) ) {
				$selected = ( $this->get_value() === $key ) ? 'selected' : '';
			} else {
				$selected = ( absint( $this->get_value() ) === $key ) ? 'selected' : '';
			}

			$option_attributes = '';

			if ( is_array( $value ) && ! empty( $value['text'] ) ) {

				foreach ( $value as $option_key => $option_value ) {
					if ( 'value' !== $option_key && 'text' !== $option_key ) {
						$option_attributes .= sprintf( '%1$s="%2$s" ', $option_key, esc_attr( $option_value ) );
					}
				}

				$field_value = ! empty( $value['value'] ) ? $value['value'] : $key;
				$field_text  = $value['text'];
			} else {
				$field_value = $key;
				$field_text  = $value;
			}

			$html .= sprintf(
				'<option %1$s %2$s value="%3$s">%4$s</option>',
				esc_attr( $selected ),
				$option_attributes,
				esc_attr( $field_value ),
				esc_html( $field_text )
			);
		}

		$html .= '</select>';

		if ( $print ) {
			echo $html; //phpcs:ignore WordPress.Security.EscapeOutput
		}

		return $html;
	}
}
