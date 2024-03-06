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
	<?php $mazepresscore_code = ( empty( $args['code'] ) || 'danger' === $args['code'] ) ? 'error' : $args['code']; ?>
	<div class="notice notice-<?php echo esc_attr( $mazepresscore_code ); ?> is-dismissible">
		<p><?php echo wp_kses_post( $args['message'] ); ?></p>
	</div>
<?php endif; ?>
