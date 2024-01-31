<?php
/**
 * The FieldsetTest class file.
 *
 * @package    Mazepress\Core
 * @subpackage Tests\Helper
 */

declare(strict_types=1);

namespace Mazepress\Core\Tests\Helper;

use WP_Mock\Tools\TestCase;
use Mazepress\Core\Forms\Field\Fieldset;
use Mazepress\Core\Forms\Field\Input;

/**
 * The FieldsetTest class.
 *
 * @group Forms
 */
class FieldsetTest extends TestCase {

	/**
	 * Test properites.
	 *
	 * @return void
	 */
	public function test_properties(): void {

		$fieldset = new Fieldset( 'test' );

		$slug = 'new-test';
		$this->assertEquals( 'test', $fieldset->get_slug() );
		$this->assertInstanceOf( Fieldset::class, $fieldset->set_slug( $slug ) );
		$this->assertEquals( $slug, $fieldset->get_slug() );

		$title = 'Test title';
		$this->assertInstanceOf( Fieldset::class, $fieldset->set_title( $title ) );
		$this->assertEquals( $title, $fieldset->get_title() );

		$description = 'Test description';
		$this->assertInstanceOf( Fieldset::class, $fieldset->set_description( $description ) );
		$this->assertEquals( $description, $fieldset->get_description() );

		$field1 = ( new Input( 'one' ) )->set_description( 'Test one description' );
		$this->assertInstanceOf( Fieldset::class, $fieldset->set_fields( array( $field1 ) ) );
		$fields = $fieldset->get_fields();
		$this->assertTrue( 1 === count( $fields ) );

		$field2 = ( new Input( 'two' ) )
			->set_description( 'Test two description' )
			->add_attributes( 'class', 'test-class' );
		$this->assertInstanceOf( Fieldset::class, $fieldset->add_fields( $field2 ) );
		$fields = $fieldset->get_fields();
		$this->assertTrue( 2 === count( $fieldset->get_fields() ) );

		$this->assertEquals( 'Test one description', $fields[0]->get_description() );
		$this->assertEquals( 'Test two description', $fields[1]->get_description() );
		$this->assertNotEmpty( $fields[1]->get_attributes() );
	}
}
