<?php
/**
 * The pages field class file.
 *
 * @package    Mazepress\Core
 * @subpackage Forms\Field
 */

declare(strict_types=1);

namespace Mazepress\Core\Forms\Field;

use Mazepress\Core\Forms\Field\BaseField;

/**
 * The Pages class.
 */
class Pages extends BaseField {

	/**
	 * Initiate class.
	 *
	 * @param string $name       The field name.
	 * @param int    $value      The field value.
	 * @param string $empty_text The field empty text.
	 */
	public function __construct( string $name, int $value = 0, string $empty_text = '' ) {

		// Set the required values.
		$this->set_type( 'pages' );
		$this->set_name( $name );
		$this->set_value( $value );
		$this->set_empty_text( $empty_text );
	}

	/**
	 * Render the input field.
	 *
	 * @return void
	 */
	public function render(): void {

		$settings = \wp_parse_args(
			$this->get_attributes(),
			array(
				'selected'         => (int) $this->get_value(),
				'name'             => \esc_attr( $this->get_name() ),
				'show_option_none' => \esc_html( $this->get_empty_text() ),
			)
		);

		\wp_dropdown_pages( $settings ); //phpcs:ignore WordPress.Security.EscapeOutput
	}
}
