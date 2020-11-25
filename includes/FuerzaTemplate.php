<?php


	final class FuerzaTemplate {

		public function __construct() {

			add_action( 'template_include', [ $this, 'add_cpt_templates' ], 99 );

		}

		public function add_cpt_templates( $template ): string {

			if ( is_singular( 'fuerza_courses' ) ) {

				if ( file_exists( get_stylesheet_directory() . '/templates/single-fuerza-courses.php' ) ) {

					return get_stylesheet_directory() . '/templates/single-fuerza-courses.php';

				}

				return plugin_dir_path(__FILE__) .  'templates/single-fuerza-courses.php';

			}

			return $template;

		}

	}