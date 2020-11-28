<?php

	if ( ! class_exists( 'FuerzaCursos' ) ) {
		final class FuerzaCursos {

			private static $instance;

			protected static CourseFuerza $course;


			public static function getInstance() {
				if ( ! self::$instance ) {
					self::$instance = new self;
				}

				return self::$instance;
			}

			private function __construct() {

				self::$course =  new CourseFuerza();

				new FuerzaTemplate();

				new FuerzaScripts();

				CourseTable::init();

			}

			public static function activation() {
				self::$course->fuerza_register_post_type();
				flush_rewrite_rules();
			}

		}

		register_deactivation_hook( WC_PLUGIN_FILE, 'flush_rewrite_rules' );
		register_activation_hook( WC_PLUGIN_FILE, 'FuerzaCursos::activation' );

	}