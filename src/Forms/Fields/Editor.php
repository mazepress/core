<?php
/**
 * The editor field class file.
 *
 * @package    Mazepress\Core
 * @subpackage Forms\Fields
 */

declare(strict_types=1);

namespace Mazepress\Core\Forms\Fields;

use Mazepress\Core\Forms\Fields\Field;

/**
 * The Editor class.
 */
class Editor extends Field {

	/**
	 * Initiate class.
	 *
	 * @param string $name  The field name.
	 * @param mixed  $value The field value.
	 */
	public function __construct( string $name, $value = null ) {

		// Set the required values.
		$this->set_type( 'editor' );
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

		$id = sanitize_html_class( sanitize_title( $this->get_name() ) );

		$settings = shortcode_atts(
			array(
				'textarea_name' => esc_attr( $this->get_name() ),
				'textarea_rows' => get_option( 'default_post_edit_rows', 10 ),
				'editor_class'  => '',
				'media_buttons' => false,
				'quicktags'     => false,
			),
			$this->get_attributes()
		);

		ob_start();
		wp_editor( wp_kses_post( $this->get_value() ), esc_attr( $id ), $settings );
		$html = ob_get_clean();

		if ( $print ) {
			echo $html; //phpcs:ignore WordPress.Security.EscapeOutput
		}

		return $html;
	}
}
