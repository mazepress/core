<?php
/**
 * The label field class file.
 *
 * @package    Mazepress\Core
 * @subpackage Forms\Field
 */

declare(strict_types=1);

namespace Mazepress\Core\Forms\Field;

use Mazepress\Core\Forms\Field\BaseField;

/**
 * The Label class.
 */
class Label extends BaseField {

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
	 * @return void
	 */
	public function render(): void {

		$attributes = array();

		foreach ( $this->get_attributes() as $key => $value ) {
			$attributes[] = sprintf( '%1$s="%2$s"', $key, $value );
		}

		$html = sprintf(
			'<label %1$s>%2$s</label>',
			implode( ' ', $attributes ),
			$this->get_label()
		);

		echo $html; //phpcs:ignore WordPress.Security.EscapeOutput
	}
}
