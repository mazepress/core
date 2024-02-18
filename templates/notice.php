<?php
/**
 * The message template
 *
 * @package    Mazepress\Core
 * @subpackage Template
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>
<?php if ( ! empty( $args['message'] ) ) : ?>
<div class="alert alert-<?php echo ! empty( $args['code'] ) ? esc_attr( $args['code'] ) : 'warning'; ?>
	alert-dismissible my-4" role="alert">
	<?php echo wp_kses_post( $args['message'] ); ?>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<?php endif; ?>
