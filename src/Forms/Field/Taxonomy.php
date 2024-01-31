<?php
/**
 * The taxonomy field class file.
 *
 * @package    Mazepress\Core
 * @subpackage Forms\Field
 */

declare(strict_types=1);

namespace Mazepress\Core\Forms\Field;

use Mazepress\Core\Forms\Field\BaseField;

/**
 * The Taxonomy class.
 */
class Taxonomy extends BaseField {

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
	 * @return void
	 */
	public function render(): void {

		$settings = \wp_parse_args(
			$this->get_attributes(),
			array(
				'taxonomy'         => \esc_attr( $this->get_taxonomy() ),
				'name'             => \esc_attr( $this->get_name() ),
				'show_option_none' => \esc_html( $this->get_empty_text() ),
				'selected'         => $this->get_value(),
				'orderby'          => 'name',
				'hierarchical'     => 1,
				'hide_empty'       => 0,
				'value_field'      => 'slug',
			)
		);

		\wp_dropdown_categories( $settings );
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
