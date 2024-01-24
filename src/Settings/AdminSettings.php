<?php
/**
 * The AdminSettings class file.
 *
 * @package    Mazepress\Core
 * @subpackage Settings
 */

declare(strict_types=1);

namespace Mazepress\Core;

use Mazepress\Core\Forms\Fields\Fieldset;
use Mazepress\Core\Forms\Fields\Field;

/**
 * The AdminSettings class.
 */
abstract class AdminSettings {

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
	 * Get the fieldsets.
	 *
	 * @return Fieldset[]
	 */
	abstract public function get_fieldsets(): array;

	/**
	 * Register class features.
	 *
	 * @return self
	 */
	public function init(): self {

		// Add admin menu and sections.
		add_action( 'admin_init', array( $this, 'render_section' ) );
		add_action(
			'admin_menu',
			function () {
				add_options_page(
					$this->get_description(),
					$this->get_title(),
					'manage_options',
					$this->get_slug(),
					array( $this, 'render_page' )
				);
			}
		);

		return $this;
	}

	/**
	 * Render the settings page.
	 *
	 * @phpcs:disable WordPress.Security.EscapeOutput
	 * @phpcs:disable WordPress.Security.NonceVerification
	 *
	 * @return void
	 */
	public function render_page(): void {

		$active    = ( ! empty( $_GET['tab'] ) ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : '';
		$fieldsets = $this->get_fieldsets();

		if ( ! empty( $fieldsets ) && empty( $active ) ) {
			$active = array_key_first( $fieldsets );
		}

		echo '<div class="wrap"><h1>' . esc_html( get_admin_page_title() ) . '</h1>';
		echo '<h2 class="nav-tab-wrapper wp-clearfix">';

		array_walk(
			$fieldsets,
			function ( Fieldset $fieldset ) use ( $active ) {
				$class = ( $fieldset->get_slug() === $active ) ? ' nav-tab-active' : '';
				$href  = wp_sprintf( '?page=%1$s&tab=%2$s', $this->get_slug(), $fieldset->get_slug() );
				echo wp_sprintf(
					'<a class="nav-tab %1$s" href="%2$s">%3$s</a>',
					esc_attr( $class ),
					esc_attr( $href ),
					esc_html( $fieldset->get_title() )
				);
			}
		);

		echo '</h2>';
		echo '<form method="post" enctype="multipart/form-data" action="options.php">';

		$field = wp_sprintf( '%1$s_%2$s', $this->get_slug(), $active );

		settings_fields( $field );
		do_settings_sections( $field );
		submit_button();

		echo '</form>';
	}

	/**
	 * Register settings options.
	 *
	 * @return void
	 */
	public function render_section(): void {

		$fieldsets = $this->get_fieldsets();

		array_walk(
			$fieldsets,
			function ( Fieldset $fieldset ) {

				$page    = wp_sprintf( '%1$s_%2$s', $this->get_slug(), $fieldset->get_slug() );
				$section = wp_sprintf( '%1$s_settings_%2$s', $this->get_slug(), $fieldset->get_slug() );

				register_setting( $page, $section );

				add_settings_section(
					$section,
					$fieldset->get_description(),
					'__return_false',
					$page
				);

				$fields = $fieldset->get_fields();

				array_walk(
					$fields,
					function ( Field $field ) use ( $page, $section ) {

						$field_name = $field->get_name();
						$post_fix   = '';

						if ( ! empty( $field_name ) && false !== strpos( $field_name, '[]', -2 ) ) {
							$field_name = \str_replace( '[]', '', $field_name );
							$post_fix   = '[]';
						}

						$field->set_name( wp_sprintf( '%1$s[%2$s]%3$s', $section, $field_name, $post_fix ) );

						add_settings_field(
							$field->get_name(),
							$field->get_label(),
							array( $this, 'render_field' ),
							$page,
							$section,
							array( 'field' => $field )
						);
					}
				);
			}
		);
	}

	/**
	 * Render the form fields.
	 *
	 * @param array<mixed> $args The field.
	 *
	 * @return void
	 */
	public function render_field( array $args ): void {

		if ( ! empty( $args['field'] ) && $args['field'] instanceof Field ) {

			$html = $args['field']->render();

			if ( ! empty( $args['field']->get_description() ) ) {
				$html .= wp_sprintf(
					'<p class="form-info-text">%1$s</p>',
					esc_html( $args['field']->get_description() )
				);
			}

			echo $html; //phpcs:ignore WordPress.Security.EscapeOutput
		}
	}

	/**
	 * Get the settings options
	 *
	 * @param string $fieldset The field fieldset.
	 *
	 * @return array<mixed>
	 */
	public function get_options( string $fieldset ): array {

		$options = array();

		if ( empty( $fieldset ) ) {
			return $options;
		}

		$settings = get_option( wp_sprintf( '%1$s_settings_%2$s', $this->get_slug(), $fieldset ) );

		if ( is_array( $settings ) ) {
			$options = $settings;
		}

		return $options;
	}

	/**
	 * Get the settings option
	 *
	 * @param string $fieldset The field fieldset.
	 * @param string $field The field name.
	 *
	 * @return mixed
	 */
	public function get_option( string $fieldset, string $field ) {

		$value = null;

		if ( empty( $fieldset ) || empty( $field ) ) {
			return $value;
		}

		$options = $this->get_options( $fieldset );

		if ( array_key_exists( $field, $options ) ) {
			$value = $options[ $field ];
		}

		return $value;
	}

	/**
	 * Get slug.
	 *
	 * @return string
	 */
	public function get_slug(): string {
		return $this->slug;
	}

	/**
	 * Set slug.
	 *
	 * @param String $slug The slug.
	 *
	 * @return self
	 */
	public function set_slug( string $slug ): self {
		$this->slug = $slug;
		return $this;
	}

	/**
	 * Get title.
	 *
	 * @return string
	 */
	public function get_title(): string {
		return $this->title;
	}

	/**
	 * Set title.
	 *
	 * @param String $title The title.
	 *
	 * @return self
	 */
	public function set_title( string $title ): self {
		$this->title = $title;
		return $this;
	}

	/**
	 * Get description.
	 *
	 * @return string
	 */
	public function get_description(): string {
		return $this->description;
	}

	/**
	 * Set description.
	 *
	 * @param String $description The description.
	 *
	 * @return self
	 */
	public function set_description( string $description ): self {
		$this->description = $description;
		return $this;
	}
}
