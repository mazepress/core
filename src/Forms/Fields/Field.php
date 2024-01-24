<?php
/**
 * The Field class file.
 *
 * @package    Mazepress\Core
 * @subpackage Forms\Fields
 */

declare(strict_types=1);

namespace Mazepress\Core\Forms\Fields;

/**
 * The Field class.
 */
abstract class Field {

	/**
	 * The type.
	 *
	 * @var string $type
	 */
	protected $type;

	/**
	 * The name.
	 *
	 * @var string $name
	 */
	protected $name;

	/**
	 * The label.
	 *
	 * @var string $label
	 */
	protected $label;

	/**
	 * The value.
	 *
	 * @var mixed $value
	 */
	protected $value;

	/**
	 * The description.
	 *
	 * @var string $description
	 */
	protected $description;

	/**
	 * The empty text.
	 *
	 * @var string $empty_text
	 */
	protected $empty_text;

	/**
	 * The options.
	 *
	 * @var array<mixed> $options
	 */
	protected $options = array();

	/**
	 * The attributes.
	 *
	 * @var array<mixed> $attributes
	 */
	protected $attributes = array();

	/**
	 * Render the form field.
	 *
	 * @return string
	 */
	abstract public function render(): string;

	/**
	 * Get the type.
	 *
	 * @return string
	 */
	public function get_type(): string {
		return $this->type;
	}

	/**
	 * Set the type.
	 *
	 * @param string $type The type.
	 *
	 * @return static
	 */
	public function set_type( string $type ): self {
		$this->type = $type;
		return $this;
	}

	/**
	 * Get the name.
	 *
	 * @return string
	 */
	public function get_name(): string {
		return $this->name;
	}

	/**
	 * Set the name.
	 *
	 * @param string $name The name.
	 *
	 * @return static
	 */
	public function set_name( string $name ): self {
		$this->name = $name;
		return $this;
	}

	/**
	 * Get the label.
	 *
	 * @return string|null
	 */
	public function get_label(): ?string {
		return $this->label;
	}

	/**
	 * Set the label.
	 *
	 * @param string $label The label.
	 *
	 * @return static
	 */
	public function set_label( string $label ): self {
		$this->label = $label;
		return $this;
	}

	/**
	 * Get the value.
	 *
	 * @return mixed
	 */
	public function get_value() {
		return $this->value;
	}

	/**
	 * Set the value.
	 *
	 * @param mixed $value The value.
	 *
	 * @return static
	 */
	public function set_value( $value ): self {
		$this->value = $value;
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
	 * @return static
	 */
	public function set_description( string $description ): self {
		$this->description = $description;
		return $this;
	}

	/**
	 * Get the empty text.
	 *
	 * @return string|null
	 */
	public function get_empty_text(): ?string {
		return $this->empty_text;
	}

	/**
	 * Set the empty text.
	 *
	 * @param string $empty_text The empty text.
	 *
	 * @return static
	 */
	public function set_empty_text( string $empty_text ): self {
		$this->empty_text = $empty_text;
		return $this;
	}

	/**
	 * Get the options.
	 *
	 * @return array<mixed>
	 */
	public function get_options(): array {
		return $this->options;
	}

	/**
	 * Set the options.
	 *
	 * @param array<mixed> $options The options.
	 *
	 * @return static
	 */
	public function set_options( array $options ): self {
		$this->options = $options;
		return $this;
	}

	/**
	 * Get the attributes.
	 *
	 * @return array<mixed>
	 */
	public function get_attributes(): array {
		return $this->attributes;
	}

	/**
	 * Set the attributes.
	 *
	 * @param array<mixed> $attributes The attributes.
	 *
	 * @return static
	 */
	public function set_attributes( array $attributes ): self {
		$this->attributes = $attributes;
		return $this;
	}

	/**
	 * Add or append the field.
	 *
	 * @param mixed $key   The key.
	 * @param mixed $value The value.
	 *
	 * @return static
	 */
	public function add_attributes( $key, $value ): self {
		$this->attributes[ $key ] = $value;
		return $this;
	}
}
