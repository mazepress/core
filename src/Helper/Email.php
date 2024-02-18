<?php
/**
 * The Email class file.
 *
 * @package    Mazepress\Core
 * @subpackage Helper
 */

declare(strict_types=1);

namespace Mazepress\Core\Helper;

use Mazepress\Core\App;

/**
 * The Email trait class.
 */
trait Email {

	/**
	 * Send email with template.
	 *
	 * @param string   $recipient   The email recipient.
	 * @param string   $subject     The email subject.
	 * @param string   $body        The email body.
	 * @param string[] $headers     The email headers.
	 * @param string[] $attachments The email attachments.
	 *
	 * @return void
	 */
	public function send_email(
		string $recipient,
		string $subject,
		string $body,
		array $headers = array(),
		array $attachments = array()
	): void {

		if ( empty( $headers['type'] ) ) {
			$headers['type'] = 'Content-Type: text/html; charset=UTF-8';
		}

		if ( empty( $headers['from'] ) ) {
			$headers['from'] = wp_sprintf(
				'From: %1$s <%2$s>',
				get_bloginfo( 'name' ),
				get_bloginfo( 'admin_email' )
			);
		}

		$logo = '';

		/**
		 * Get the email logo.
		 *
		 * @param string $logo The logo path.
		 */
		$logo = \apply_filters( 'mazepresscore_email_logo', $logo );

		ob_start();
		App::instance()->get_template_part(
			'email',
			null,
			array(
				'body' => $body,
				'logo' => $logo,
			)
		);
		$body = ob_get_clean();

		wp_mail( $recipient, $subject, $body, $headers, $attachments );
	}
}
