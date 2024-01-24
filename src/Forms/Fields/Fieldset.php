<?php
/**
 * The Fieldset class file.
 *
 * @package    Mazepress\Core
 * @subpackage Forms\Fields
 */

declare(strict_types=1);

namespace Mazepress\Core\Forms\Fields;

use Mazepress\Core\Forms\Fields\Field;

/**
 * The Fieldset class.
 */
class Fieldset {

	/**
	 * The slug.
	 *
	 * @var string $slug
	 */
	protected $slug;

	/**
	 * The title.
	 *
	 * @var string $title
	 */
	protected $title;

	/**
	 * The description.
	 *
	 * @var string $description
	 */
	protected $description;

	/**
	 * The fields.
	 *
	 * @var Field[] $fields
	 */
	protected $fields = array();

	/**
	 * Initiate class.
	 *
	 * @param string $slug The slug.
	 */
	public function __construct( string $slug ) {

		// Set the required values.
		$this->set_slug( $slug );
	}

	/**
	 * Get the slug.
	 *
	 * @return string|null
	 */
	public function get_slug(): ?string {
		return $this->slug;
	}

	/**
	 * Set the slug.
	 *
	 * @param string $slug the slug.
	 *
	 * @return self
	 */
	public function set_slug( string $slug ): self {
		$this->slug = $slug;
		return $this;
	}

	/**
	 * Get the title.
	 *
	 * @return string|null
	 */
	public function get_title(): ?string {
		return $this->title;
	}

	/**
	 * Set the title.
	 *
	 * @param string $title The title.
	 *
	 * @return self
	 */
	public function set_title( string $title ): self {
		$this->title = $title;
		return $this;
	}

	/**
	 * Get the description.
	 *
	 * @return string|null
	 */
	public function get_description(): ?string {
		return $this->description;
	}

	/**
	 * Set the description.
	 *
	 * @param string $description The description.
	 *
	 * @return self
	 */
	public function set_description( string $description ): self {
		$this->description = $description;
		return $this;
	}

	/**
	 * Get the fields.
	 *
	 * @return Field[]
	 */
	public function get_fields(): array {
		return $this->fields;
	}

	/**
	 * Set the fields.
	 *
	 * @param Field[] $fields the field.
	 *
	 * @return self
	 */
	public function set_fields( array $fields ): self {
		$this->fields = $fields;
		return $this;
	}

	/**
	 * Add or append the field.
	 *
	 * @param Field $field the field.
	 *
	 * @return self
	 */
	public function add_field( Field $field ): self {
		$this->fields[] = $field;
		return $this;
	}
}
