<?php
/**
 * The FormTest class file.
 *
 * @package    Mazepress\Core
 * @subpackage Tests\Helper
 */

declare(strict_types=1);

namespace Mazepress\Core\Tests\Helper;

use WP_Mock\Tools\TestCase;
use Mazepress\Core\Forms\Form;
use WP_Mock;

/**
 * The FormTest class.
 *
 * @group Forms
 */
class FormTest extends TestCase {

	/**
	 * Test start function.
	 *
	 * @return void
	 */
	public function test_start(): void {
		Form::start();
		$this->expectOutputString( '<form method="post" action="">' );
	}

	/**
	 * Test end function.
	 *
	 * @return void
	 */
	public function test_end(): void {
		WP_Mock::passthruFunction( 'wp_nonce_field' );
		Form::end( 'testaction' );
		$this->expectOutputString( '<input type="hidden" name="action" value="testaction" /></form>' );
	}

	/**
	 * Test label function.
	 *
	 * @return void
	 */
	public function test_label(): void {
		Form::label( 'Test Label', array( 'class' => 'test-class' ) );
		$this->expectOutputString( '<label class="test-class">Test Label</label>' );
	}

	/**
	 * Test button function.
	 *
	 * @return void
	 */
	public function test_button(): void {
		Form::button( 'submit', 'Test Label', 'dosubmit', array( 'class' => 'test-class' ), 'button' );
		$this->expectOutputString(
			'<button type="button" name="submit" value="dosubmit" class="test-class">Test Label</button>'
		);
	}

	/**
	 * Test input function.
	 *
	 * @return void
	 */
	public function test_input(): void {
		Form::input( 'testname', 'testvalue', array( 'class' => 'test-class' ), 'text' );
		$this->expectOutputString(
			'<input type="text" name="testname" value="testvalue" class="test-class"/>'
		);
	}

	/**
	 * Test textarea function.
	 *
	 * @return void
	 */
	public function test_textarea(): void {
		Form::textarea( 'testname', 'testvalue', array( 'class' => 'test-class' ) );
		$this->expectOutputString(
			'<textarea name="testname" class="test-class" rows="4">testvalue</textarea>'
		);
	}

	/**
	 * Test editor function.
	 *
	 * @return void
	 */
	public function test_editor(): void {
		WP_Mock::passthruFunction( 'get_option' );
		WP_Mock::echoFunction( 'wp_editor' );
		Form::editor( 'testname', 'testvalue' );
		$this->expectOutputString( 'testvalue' );
	}

	/**
	 * Test pages function.
	 *
	 * @return void
	 */
	public function test_pages(): void {
		WP_Mock::passthruFunction( 'wp_dropdown_pages' );
		Form::pages( 'testname', 1, 'Select', array( 'class' => 'test-class' ) );
		$this->expectOutputString( '' );
	}

	/**
	 * Test taxonomy function.
	 *
	 * @return void
	 */
	public function test_taxonomy(): void {
		WP_Mock::passthruFunction( 'wp_dropdown_categories' );
		Form::taxonomy( 'taxonomy', 'testname', 'texttax', 'Select', array( 'class' => 'test-class' ) );
		$this->expectOutputString( '' );
	}

	/**
	 * Test select function.
	 *
	 * @return void
	 */
	public function test_select(): void {
		Form::select( 'test', 1, 'Select', array( 1 => 'Option 1' ), array( 'class' => 'test-class' ) );
		$this->expectOutputString(
			//phpcs:ignore Generic.Files.LineLength.TooLong
			'<select name="test" class="test-class"><option value="">Select</option><option selected  value="1">Option 1</option></select>'
		);
	}

	/**
	 * Test select function.
	 *
	 * @return void
	 */
	public function test_select_multiple(): void {
		Form::select(
			'test',
			array( 1, 2 ),
			'Select',
			array(
				1 => 'Option 1',
				2 => array(
					'text'       => 'Option 2',
					'data-extra' => '3',
				),
			),
			array( 'multiple' => 'multiple' )
		);

		$this->expectOutputString(
			//phpcs:ignore Generic.Files.LineLength.TooLong
			'<select name="test" multiple="multiple"><option value="">Select</option><option selected  value="1">Option 1</option><option selected data-extra="3" value="2">Option 2</option></select>'
		);
	}

	/**
	 * Test checkbox function.
	 *
	 * @return void
	 */
	public function test_checkbox(): void {
		Form::checkbox(
			'test',
			1,
			array( 1 => 'Option 1' ),
			array(
				'class' => 'test-class',
				'id'    => 'test-id',
			)
		);
		$this->expectOutputString(
			//phpcs:ignore Generic.Files.LineLength.TooLong
			'<label class="form-check-label"><input type="checkbox" name="test" checked class="test-class" id="test-id-1" value="1"/>Option 1<span class="form-check-icon"></span></label>'
		);
	}

	/**
	 * Test checkbox function.
	 *
	 * @return void
	 */
	public function test_checkbox_multiple(): void {
		Form::checkbox(
			'test',
			array( 1, 2 ),
			array(
				1 => 'Option 1',
				2 => array(
					'text'       => 'Option 2',
					'data-extra' => '3',
				),
			)
		);

		$this->expectOutputString(
			//phpcs:ignore Generic.Files.LineLength.TooLong
			'<label class="form-check-label"><input type="checkbox" name="test[]" checked   value="1"/>Option 1<span class="form-check-icon"></span></label><label class="form-check-label"><input type="checkbox" name="test[]" checked  data-extra="3" value="2"/>Option 2<span class="form-check-icon"></span></label>'
		);
	}

	/**
	 * Test radio function.
	 *
	 * @return void
	 */
	public function test_radio(): void {
		Form::radio(
			'test',
			1,
			array( 1 => 'Option 1' ),
			array(
				'class' => 'test-class',
				'id'    => 'test-id',
			)
		);
		$this->expectOutputString(
			//phpcs:ignore Generic.Files.LineLength.TooLong
			'<label class="form-check-label"><input type="radio" name="test" checked class="test-class" id="test-id-1" value="1"/>Option 1<span class="form-check-icon"></span></label>'
		);
	}

	/**
	 * Test radio function.
	 *
	 * @return void
	 */
	public function test_radio_multiple(): void {
		Form::radio(
			'test',
			array( 1, 2 ),
			array(
				1 => 'Option 1',
				2 => array(
					'text'       => 'Option 2',
					'data-extra' => '3',
				),
			)
		);

		$this->expectOutputString(
			//phpcs:ignore Generic.Files.LineLength.TooLong
			'<label class="form-check-label"><input type="radio" name="test" checked   value="1"/>Option 1<span class="form-check-icon"></span></label><label class="form-check-label"><input type="radio" name="test" checked  data-extra="3" value="2"/>Option 2<span class="form-check-icon"></span></label>'
		);
	}
}
