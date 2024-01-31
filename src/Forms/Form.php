<?php
/**
 * The Form class file.
 *
 * @package    Mazepress\Core
 * @subpackage Forms
 */

declare(strict_types=1);

namespace Mazepress\Core\Forms;

use Mazepress\Core\Forms\Field\Input;
use Mazepress\Core\Forms\Field\Textarea;
use Mazepress\Core\Forms\Field\Button;
use Mazepress\Core\Forms\Field\Label;
use Mazepress\Core\Forms\Field\Editor;
use Mazepress\Core\Forms\Field\Pages;
use Mazepress\Core\Forms\Field\Taxonomy;
use Mazepress\Core\Forms\Field\Select;
use Mazepress\Core\Forms\Field\Checkbox;
use Mazepress\Core\Forms\Field\Radio;

/**
 * The Form class.
 */
class Form {

	/**
	 * Render form start.
	 *
	 * @param string[] $attrs The form attributes.
	 *
	 * @return void
	 */
	public static function start( array $attrs = array() ): void {

		$attrs = \wp_parse_args(
			$attrs,
			array(
				'method' => 'post',
				'action' => '',
			)
		);

		$attributes = array();

		foreach ( $attrs as $key => $value ) {
			$attributes[] = sprintf( '%1$s="%2$s"', $key, $value );
		}

		printf( '<form %s>', implode( ' ', $attributes ) ); //phpcs:ignore WordPress.Security.EscapeOutput
	}

	/**
	 * Render form start.
	 *
	 * @param string $action  The action name.
	 * @param string $wpnonce The action hidden field name.
	 *
	 * @return void
	 */
	public static function end( string $action = '', string $wpnonce = '_wpnonce' ): void {

		\wp_nonce_field( $action, $wpnonce );

		if ( ! empty( $action ) ) {
			( new Input( 'action', $action, 'hidden' ) )->render();
		}

		echo '</form>'; //phpcs:ignore WordPress.Security.EscapeOutput
	}

	/**
	 * Render form label.
	 *
	 * @param string   $label The label.
	 * @param string[] $attrs The attributes.
	 *
	 * @return void
	 */
	public static function label( string $label, array $attrs = array() ): void {
		( new Label( $label ) )->set_attributes( $attrs )->render();
	}

	/**
	 * Render form button.
	 *
	 * @param string   $name  The name.
	 * @param string   $label The label.
	 * @param string   $value The value.
	 * @param string[] $attrs The attributes.
	 * @param string   $type  The type.
	 *
	 * @return void
	 */
	public static function button(
		string $name,
		string $label,
		string $value = '',
		array $attrs = array(),
		string $type
	): void {
		( new Button( $name, $label, $value, $type ) )->set_attributes( $attrs )->render();
	}

	/**
	 * Render form input.
	 *
	 * @param string   $name  The name.
	 * @param string   $value The value.
	 * @param string[] $attrs The attributes.
	 * @param string   $type  The type.
	 *
	 * @return void
	 */
	public static function input( string $name, string $value = '', array $attrs = array(), string $type ): void {
		( new Input( $name, $value, $type ) )->set_attributes( $attrs )->render();
	}

	/**
	 * Render form textarea.
	 *
	 * @param string   $name  The name.
	 * @param string   $value The value.
	 * @param string[] $attrs The attributes.
	 *
	 * @return void
	 */
	public static function textarea( string $name, string $value = '', array $attrs = array() ): void {
		( new Textarea( $name, $value ) )->set_attributes( $attrs )->render();
	}

	/**
	 * Render form editor.
	 *
	 * @param string   $name  The name.
	 * @param string   $value The value.
	 * @param string[] $attrs The attributes.
	 *
	 * @return void
	 */
	public static function editor( string $name, string $value = '', array $attrs = array() ): void {
		( new Editor( $name, $value ) )->set_attributes( $attrs )->render();
	}

	/**
	 * Render form pages dropdown.
	 *
	 * @param string   $name  The name.
	 * @param int      $value The value.
	 * @param string   $text  The empty text.
	 * @param string[] $attrs The attributes.
	 *
	 * @return void
	 */
	public static function pages( string $name, int $value = 0, string $text = '', array $attrs = array() ): void {
		( new Pages( $name, $value, $text ) )->set_attributes( $attrs )->render();
	}

	/**
	 * Render form taxonomy dropdown.
	 *
	 * @param string   $taxonomy The taxonomy name.
	 * @param string   $name     The name.
	 * @param string   $value    The value.
	 * @param string   $text     The empty text.
	 * @param string[] $attrs    The attributes.
	 *
	 * @return void
	 */
	public static function taxonomy(
		string $taxonomy,
		string $name,
		string $value = '',
		string $text = '',
		array $attrs = array()
	): void {
		( new Taxonomy( $taxonomy, $name, $value, $text ) )->set_attributes( $attrs )->render();
	}

	/**
	 * Render form select dropdown.
	 *
	 * @param string       $name    The field name.
	 * @param mixed        $value   The value.
	 * @param string       $text    The empty text.
	 * @param array<mixed> $options The options.
	 * @param string[]     $attrs   The attributes.
	 *
	 * @return void
	 */
	public static function select(
		string $name,
		$value = null,
		string $text = '',
		array $options = array(),
		array $attrs = array()
	): void {
		( new Select( $name, $value, $text ) )->set_options( $options )->set_attributes( $attrs )->render();
	}

	/**
	 * Render form checkbox.
	 *
	 * @param string       $name    The field name.
	 * @param mixed        $value   The value.
	 * @param array<mixed> $options The options.
	 * @param string[]     $attrs   The attributes.
	 *
	 * @return void
	 */
	public static function checkbox(
		string $name,
		$value = null,
		array $options = array(),
		array $attrs = array()
	): void {
		( new Checkbox( $name, $value ) )->set_options( $options )->set_attributes( $attrs )->render();
	}

	/**
	 * Render form radio.
	 *
	 * @param string       $name    The field name.
	 * @param mixed        $value   The value.
	 * @param array<mixed> $options The options.
	 * @param string[]     $attrs   The attributes.
	 *
	 * @return void
	 */
	public static function radio(
		string $name,
		$value = null,
		array $options = array(),
		array $attrs = array()
	): void {
		( new Radio( $name, $value ) )->set_options( $options )->set_attributes( $attrs )->render();
	}
}
