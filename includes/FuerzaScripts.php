<?php

	if ( ! class_exists( 'FuerzaScripts' ) ) {
		class FuerzaScripts {

			public function __construct() {

				add_action( 'wp_enqueue_scripts', [ $this, 'add_scripts_fuerza' ] );

			}

			public function add_scripts_fuerza() {

				$css_folder = plugins_url(). '/fuerza-course-try/assets/css';
				$js_folder  = plugins_url(). '/fuerza-course-try/assets/js' ;

				wp_enqueue_style( 'font-icons', $css_folder . '/all.min.css', "", '1.0.1' );
				wp_enqueue_style( 'fuerza-courses', $css_folder . '/fuerza.css', "", '1.0.1' );

				wp_enqueue_script( 'jquery-form' );
				wp_enqueue_script( 'font-icons', $js_folder . '/all.min.js', "", '1.0.1', true );
				wp_enqueue_script( 'fuerza-courses', $js_folder . '/fuerza.js', "", '1.0.1', true );

				$wpVars = [
					'fuerzaUrl' => admin_url( 'admin-ajax.php' ),
				];

				wp_localize_script( 'fuerza-courses', 'wp', $wpVars );

			}

		}
	}