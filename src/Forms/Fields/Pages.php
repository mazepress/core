<?php
/**
 * The pages field class file.
 *
 * @package    Mazepress\Core
 * @subpackage Forms\Fields
 */

declare(strict_types=1);

namespace Mazepress\Core\Forms\Fields;

use Mazepress\Core\Forms\Fields\Field;

/**
 * The Pages class.
 */
class Pages extends Field {

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
	 * @param bool $print Print the output.
	 *
	 * @return string
	 */
	public function render( bool $print = false ): string {

		$settings = shortcode_atts(
			array(
				'depth'             => 0,
				'child_of'          => 0,
				'selected'          => absint( $this->get_value() ),
				'echo'              => 0,
				'name'              => esc_attr( $this->get_name() ),
				'id'                => '',
				'class'             => '',
				'show_option_none'  => esc_html( $this->get_empty_text() ),
				'option_none_value' => '',
			),
			$this->get_attributes()
		);

		$html = wp_dropdown_pages( $settings ); //phpcs:ignore WordPress.Security.EscapeOutput

		if ( $print ) {
			echo $html; //phpcs:ignore WordPress.Security.EscapeOutput
		}

		return $html;
	}
}
