<?php
/**
 * The Form class file.
 *
 * @package    Mazepress\Core
 * @subpackage Forms
 */

declare(strict_types=1);

namespace Mazepress\Core\Forms;

use Mazepress\Core\Forms\Fields\Input;
use Mazepress\Core\Forms\Fields\Textarea;
use Mazepress\Core\Forms\Fields\Button;
use Mazepress\Core\Forms\Fields\Label;
use Mazepress\Core\Forms\Fields\Editor;
use Mazepress\Core\Forms\Fields\Pages;
use Mazepress\Core\Forms\Fields\Taxonomy;
use Mazepress\Core\Forms\Fields\Select;
use Mazepress\Core\Forms\Fields\Checkbox;
use Mazepress\Core\Forms\Fields\Radio;

/**
 * The Form class.
 */
class Form {

	/**
	 * Render form start.
	 *
	 * @param string       $name   The form name.
	 * @param string       $action The form action.
	 * @param array<mixed> $attrs  The form attributes.
	 * @param bool         $print  Print the output.
	 *
	 * @return string
	 */
	public static function start( string $name, string $action, array $attrs = array(), bool $print = false ): string {

		$attrs = shortcode_atts(
			array(
				'id'      => sanitize_html_class( sanitize_title( $name ) ),
				'class'   => '',
				'method'  => 'post',
				'enctype' => '',
			),
			$attrs
		);

		$attributes      = '';
		$attrs['action'] = $action;

		foreach ( $attrs as $key => $value ) {
			if ( ! empty( $value ) ) {
				$attributes .= sprintf( '%s="%s" ', $key, $value );
			}
		}

		$html = sprintf( '<form %s>', $attributes );

		if ( $print ) {
			echo $html; //phpcs:ignore WordPress.Security.EscapeOutput
		}

		return $html;
	}

	/**
	 * Render form start.
	 *
	 * @param string $action  The action name.
	 * @param string $wpnonce The action hidden field name.
	 * @param bool   $print   Print the output.
	 *
	 * @return string
	 */
	public static function end( string $action = '', string $wpnonce = '', bool $print = false ): string {

		$html = '';

		if ( ! empty( $wpnonce ) ) {
			$html = wp_nonce_field( $action, $wpnonce, true, false );
		}

		if ( ! empty( $action ) ) {
			$html .= ( new Input( 'action', $action ) )->set_type( 'hidden' )->render();
		}

		$html .= '</form>';

		if ( $print ) {
			echo $html; //phpcs:ignore WordPress.Security.EscapeOutput
		}

		return $html;
	}

	/**
	 * Render form label.
	 *
	 * @param string $label The label.
	 * @param string $class The class.
	 *
	 * @return Label
	 */
	public static function label( string $label, string $class = '' ): Label {

		$field = new Label( $label );

		if ( ! empty( $class ) ) {
			$field->add_attributes( 'class', $class );
		}

		return $field;
	}

	/**
	 * Render form button.
	 *
	 * @param string $type  The type.
	 * @param string $name  The name.
	 * @param string $label The label.
	 * @param string $value The value.
	 * @param string $class The class.
	 *
	 * @return Button
	 */
	public static function button(
		string $type,
		string $name,
		string $label,
		string $value = '',
		string $class = ''
	): Button {

		$field = ( new Button( $name, $label, $value ) )->set_type( $type );

		if ( ! empty( $class ) ) {
			$field->add_attributes( 'class', $class );
		}

		return $field;
	}

	/**
	 * Render form button.
	 *
	 * @param string $type     The type.
	 * @param string $name     The name.
	 * @param string $value    The value.
	 * @param string $class    The class.
	 * @param string $label    The placeholder label.
	 * @param bool   $required The required flag.
	 *
	 * @return Input
	 */
	public static function input(
		string $type,
		string $name,
		string $value = '',
		string $class = '',
		string $label = '',
		bool $required = false
	): Input {

		$field = ( new Input( $name, $value ) )->set_type( $type );

		if ( ! empty( $class ) ) {
			$field->add_attributes( 'class', $class );
		}

		if ( ! empty( $label ) ) {
			$field->add_attributes( 'placeholder', $label );
		}

		if ( $required ) {
			$field->add_attributes( 'required', 'required' );
		}

		return $field;
	}

	/**
	 * Render form textarea.
	 *
	 * @param string $name     The name.
	 * @param string $value    The value.
	 * @param string $class    The class.
	 * @param string $label    The placeholder label.
	 * @param bool   $required The required flag.
	 *
	 * @return Textarea
	 */
	public static function textarea(
		string $name,
		string $value = '',
		string $class = '',
		string $label = '',
		bool $required = false
	): Textarea {

		$field = new Textarea( $name, $value );

		if ( ! empty( $class ) ) {
			$field->add_attributes( 'class', $class );
		}

		if ( ! empty( $label ) ) {
			$field->add_attributes( 'placeholder', $label );
		}

		if ( $required ) {
			$field->add_attributes( 'required', 'required' );
		}

		return $field;
	}

	/**
	 * Render form editor.
	 *
	 * @param string $name     The name.
	 * @param string $value    The value.
	 * @param string $class    The class.
	 * @param bool   $required The required flag.
	 *
	 * @return Editor
	 */
	public static function editor(
		string $name,
		string $value = '',
		string $class = '',
		bool $required = false
	): Editor {

		$field = new Editor( $name, $value );

		if ( ! empty( $class ) ) {
			$field->add_attributes( 'editor_class', $class );
		}

		if ( $required ) {
			$field->add_attributes( 'required', 'required' );
		}

		return $field;
	}

	/**
	 * Render form pages dropdown.
	 *
	 * @param string $name       The name.
	 * @param int    $value      The value.
	 * @param string $empty_text The empty text.
	 * @param string $class      The class.
	 * @param bool   $required   The required flag.
	 *
	 * @return Pages
	 */
	public static function pages(
		string $name,
		int $value = 0,
		string $empty_text = '',
		string $class = '',
		bool $required = false
	): Pages {

		$field = new Pages( $name, $value, $empty_text );

		if ( ! empty( $class ) ) {
			$field->add_attributes( 'class', $class );
		}

		if ( $required ) {
			$field->add_attributes( 'required', 'required' );
		}

		return $field;
	}

	/**
	 * Render form taxonomy dropdown.
	 *
	 * @param string $taxonomy   The taxonomy name.
	 * @param string $name       The name.
	 * @param string $value      The value.
	 * @param string $empty_text The empty text.
	 * @param string $class      The class.
	 * @param bool   $required   The required flag.
	 *
	 * @return Taxonomy
	 */
	public static function taxonomy(
		string $taxonomy,
		string $name,
		string $value = '',
		string $empty_text = '',
		string $class = '',
		bool $required = false
	): Taxonomy {

		$field = new Taxonomy( $taxonomy, $name, $value, $empty_text );

		if ( ! empty( $class ) ) {
			$field->add_attributes( 'class', $class );
		}

		if ( $required ) {
			$field->add_attributes( 'required', 'required' );
		}

		return $field;
	}

	/**
	 * Render form select dropdown.
	 *
	 * @param string       $name       The field name.
	 * @param mixed        $value      The value.
	 * @param string       $empty_text The empty text.
	 * @param array<mixed> $options    The options.
	 * @param string       $class      The class.
	 * @param bool         $required   The required flag.
	 * @param bool         $multiple   The multiple flag.
	 *
	 * @return Select
	 */
	public static function select(
		string $name,
		$value = null,
		string $empty_text = '',
		array $options = array(),
		string $class = '',
		bool $required = false,
		bool $multiple = false
	): Select {

		$field = ( new Select( $name, $value, $empty_text ) )->set_options( $options );

		if ( ! empty( $class ) ) {
			$field->add_attributes( 'class', $class );
		}

		if ( $required ) {
			$field->add_attributes( 'required', 'required' );
		}

		if ( $multiple ) {
			$field->add_attributes( 'multiple', 'multiple' );
		}

		return $field;
	}

	/**
	 * Render form checkbox.
	 *
	 * @param string       $name     The field name.
	 * @param mixed        $value    The value.
	 * @param array<mixed> $options  The options.
	 * @param string       $class    The class.
	 * @param bool         $required The required flag.
	 *
	 * @return Checkbox
	 */
	public static function checkbox(
		string $name,
		$value = null,
		array $options = array(),
		string $class = '',
		bool $required = false
	): Checkbox {

		$field = ( new Checkbox( $name, $value ) )->set_options( $options );

		if ( ! empty( $class ) ) {
			$field->add_attributes( 'class', $class );
		}

		if ( $required ) {
			$field->add_attributes( 'required', 'required' );
		}

		return $field;
	}

	/**
	 * Render form radio.
	 *
	 * @param string       $name     The field name.
	 * @param mixed        $value    The value.
	 * @param array<mixed> $options  The options.
	 * @param string       $class    The class.
	 * @param bool         $required The required flag.
	 *
	 * @return Radio
	 */
	public static function radio(
		string $name,
		$value = null,
		array $options = array(),
		string $class = '',
		bool $required = false
	): Radio {

		$field = ( new Radio( $name, $value ) )->set_options( $options );

		if ( ! empty( $class ) ) {
			$field->add_attributes( 'class', $class );
		}

		if ( $required ) {
			$field->add_attributes( 'required', 'required' );
		}

		return $field;
	}
}
