<?php
/**
 * The email master template
 *
 * @phpcs:disable Generic.Files.LineLength.TooLong
 *
 * @package    Mazepress\Core
 * @subpackage Template
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>
<table align="center" width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top" bgcolor="#f9f9f9" style="background-color:#f9f9f9;padding-top:10px;">
			<table align="center" width="600px" border="0" cellspacing="0" cellpadding="25" style="max-width:600px;">
				<tr>
					<td align="center">
						<a href="<?php echo esc_url( home_url() ); ?>">
							<?php if ( ! empty( $args['logo'] ) ) : ?>
								<img style="max-height:100px;" alt="" src="<?php echo esc_url( $args['logo'] ); ?>"/>
							<?php else : ?>
								<h1><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1>
							<?php endif; ?>
						</a>
					</td>
				</tr>
				<tr>
					<td bgcolor="#ffffff" style="height:300px;vertical-align:top;padding:40px;background-color:#ffffff;color:#424242;line-height:1.5;font-size:1rem;font-family:-apple-system,blinkmacsystemfont,roboto,'Segoe UI',ubuntu,cantarell,'Helvetica Neue',sans-serif;border:1px solid #efefef;border-radius:8px;">
						<?php
						if ( ! empty( $args['body'] ) ) {
							echo wp_kses_post( $args['body'] );
						}
						?>
					</td>
				</tr>
				<tr>
					<td align="center" style="padding:40px;font-size:0.875rem;font-family:-apple-system,blinkmacsystemfont,roboto,'Segoe UI',ubuntu,cantarell,'Helvetica Neue',sans-serif;color:#666666;">
						<?php echo wp_sprintf( '&copy; %1$s %2$s.', esc_html( date_i18n( 'Y' ) ), esc_html( get_bloginfo( 'name' ) ) ); ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
