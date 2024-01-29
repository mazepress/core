<?php
/**
 * The Template class file.
 *
 * @package    Mazepress\Core
 * @subpackage Helper
 */

declare(strict_types=1);

namespace Mazepress\Core\Helper;

use Mazepress\Core\PackageInterface;

/**
 * The Template trait class.
 */
trait Template {

	/**
	 * Load template part from theme or plugin.
	 *
	 * @phpcs:disable Generic.CodeAnalysis.UnusedFunctionParameter
	 *
	 * @param PackageInterface $package The package object.
	 * @param string           $slug    The template slug.
	 * @param string           $name    The template name.
	 * @param array<mixed>     $args    The additional arguments.
	 *
	 * @return void
	 */
	public static function get_template(
		PackageInterface $package,
		string $slug,
		string $name = null,
		array $args = array()
	): void {

		$templates = array();

		if ( ! empty( $name ) ) {
			$templates[] = "{$slug}-{$name}.php";
		}

		$templates[] = "{$slug}.php";
		$located     = '';

		foreach ( $templates as $template ) {
			$located = self::locate_template( $package, $template );
			if ( ! empty( $located ) ) {
				require_once $located;
				break;
			}
		}
	}

	/**
	 * Retrieves the name of the highest priority template file that exists.
	 *
	 * @param PackageInterface $package The package object.
	 * @param string           $template The template.
	 *
	 * @return string
	 */
	public static function locate_template( PackageInterface $package, string $template ): string {

		$paths         = array();
		$template_path = 'templates';
		$active_theme  = trailingslashit( get_stylesheet_directory() );
		$parent_theme  = trailingslashit( get_template_directory() );

		if ( ! empty( $package->get_path() ) ) {
			$paths[] = trailingslashit( $package->get_path() ) . $template_path;
		}

		if ( ! empty( $package->get_parent() ) ) {
			$parent_app    = $package->get_parent();
			$active_theme .= $parent_app->get_slug() . '/' . $package->get_slug();
			$parent_theme .= $parent_app->get_slug() . '/' . $package->get_slug();

			if ( ! empty( $parent_app->get_path() ) ) {
				$path    = trailingslashit( $parent_app->get_path() ) . $template_path . '/' . $package->get_slug();
				$paths[] = $path;
			}
		} else {
			$active_theme .= $package->get_slug();
			$parent_theme .= $package->get_slug();

			if ( ! empty( $package->get_path() ) ) {
				$path = trailingslashit( $package->get_path() ) . $template_path;
				if ( ! in_array( $path, $paths, true ) ) {
					$paths[] = $path;
				}
			}
		}

		$paths[] = $active_theme;

		if ( $active_theme !== $parent_theme ) {
			$paths[] = $parent_theme;
		}

		/**
		 * Filters the paths for additional locations.
		 *
		 * @param string[] $paths The arguments for the admin notice.
		 */
		$paths = apply_filters( 'mazepress_core_locate_template', $paths );

		$paths   = array_reverse( $paths );
		$located = '';

		foreach ( $paths as $path ) {
			$file_path = trailingslashit( $path ) . $template;
			if ( file_exists( $file_path ) ) {
				$located = $file_path;
				break;
			}
		}

		return $located;
	}
}
