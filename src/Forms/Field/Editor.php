<?php
/**
 * The editor field class file.
 *
 * @package    Mazepress\Core
 * @subpackage Forms\Field
 */

declare(strict_types=1);

namespace Mazepress\Core\Forms\Field;

use Mazepress\Core\Forms\Field\BaseField;

/**
 * The Editor class.
 */
class Editor extends BaseField {

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
	 * @return void
	 */
	public function render(): void {

		$settings = \wp_parse_args(
			$this->get_attributes(),
			array(
				'textarea_name' => \esc_attr( $this->get_name() ),
				'textarea_rows' => \get_option( 'default_post_edit_rows', 10 ),
				'media_buttons' => false,
				'quicktags'     => false,
			)
		);

		\wp_editor( (string) $this->get_value(), $this->get_name(), $settings );
	}
}
