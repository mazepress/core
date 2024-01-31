<?php
/**
 * The PhpUnit bootstrap file.
 *
 * @phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
 *
 * @package    Mazepress\Core
 * @subpackage Tests
 */

/**
 * Appends a trailing slash.
 *
 * @param string $value The value.
 *
 * @return string
 */
function trailingslashit( string $value ): string {
	return untrailingslashit( $value ) . '/';
}

/**
 * Removes trailing forward slashes and backslashes if they exist.
 *
 * @param string $value The value.
 *
 * @return string
 */
function untrailingslashit( string $value ): string {
	return rtrim( $value, '/\\' );
}

/**
 * Merges user defined arguments into defaults array.
 *
 * @param mixed        $args     The args.
 * @param array<mixed> $defaults The defaults.
 *
 * @return array<mixed>
 */
function wp_parse_args( $args, $defaults = array() ): array {

	if ( is_object( $args ) ) {
		$parsed_args = get_object_vars( $args );
	} elseif ( is_array( $args ) ) {
		$parsed_args =& $args;
	} else {
		parse_str( (string) $args, $parsed_args );
	}

	if ( is_array( $defaults ) && $defaults ) {
		return array_merge( $defaults, $parsed_args );
	}

	return $parsed_args;
}
