<?php

	if ( ! class_exists( 'FuerzaCursos' ) ) {
		class FuerzaCursos {

			private static FuerzaCursos $instance;

			private $course;

			public static function getInstance(): FuerzaCursos {
				if ( ! self::$instance ) {
					self::$instance = new self;
				}

				return self::$instance;
			}

			private function __construct() {

				$this->course =  new CourseFuerza();

				new FuerzaTemplate();

				new FuerzaScripts();

				CourseTable::init();

			}

			public function activation() {
				$this->course->fuerza_register_post_type();
				flush_rewrite_rules();
			}


		}

		register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
		register_activation_hook( __FILE__, 'FuerzaCursos::activation' );

	}