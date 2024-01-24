<?php
/**
 * The taxonomy field class file.
 *
 * @package    Mazepress\Core
 * @subpackage Forms\Fields
 */

declare(strict_types=1);

namespace Mazepress\Core\Forms\Fields;

use Mazepress\Core\Forms\Fields\Field;

/**
 * The Taxonomy class.
 */
class Taxonomy extends Field {

	/**
	 * The taxonomy.
	 *
	 * @var string $taxonomy
	 */
	protected $taxonomy;

	/**
	 * Initiate class.
	 *
	 * @param string $taxonomy   The taxonomy.
	 * @param string $name       The field name.
	 * @param string $value      The field value.
	 * @param string $empty_text The field empty text.
	 */
	public function __construct( string $taxonomy, string $name, string $value = '', string $empty_text = '' ) {

		// Set the required values.
		$this->set_type( 'taxonomy' );
		$this->set_taxonomy( $taxonomy );
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
				'taxonomy'          => esc_attr( $this->get_taxonomy() ),
				'name'              => esc_attr( $this->get_name() ),
				'id'                => '',
				'class'             => '',
				'show_option_none'  => esc_html( $this->get_empty_text() ),
				'option_none_value' => '',
				'selected'          => $this->get_value(),
				'required'          => false,
				'orderby'           => 'name',
				'hierarchical'      => 1,
				'hide_empty'        => 0,
				'echo'              => 0,
				'value_field'       => 'slug',
			),
			$this->get_attributes()
		);

		$html = wp_dropdown_categories( $settings );

		if ( $print ) {
			echo $html; //phpcs:ignore WordPress.Security.EscapeOutput
		}

		return $html;
	}

	/**
	 * Get the taxonomy.
	 *
	 * @return string
	 */
	public function get_taxonomy(): string {
		return $this->taxonomy;
	}

	/**
	 * Set the taxonomy.
	 *
	 * @param string $taxonomy The taxonomy.
	 *
	 * @return self
	 */
	public function set_taxonomy( string $taxonomy ): self {
		$this->taxonomy = $taxonomy;
		return $this;
	}
}
