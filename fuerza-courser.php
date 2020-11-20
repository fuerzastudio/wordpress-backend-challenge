<?php
	/**
	 * Plugin Name: Fuerza Cursos
	 * Plugin URI: https://www.fuerzastudio.com.br/
	 * Description: Adds custom post divulgação de cursos em qualquer tema que esteja sendo utilizado no site onde o plugin for ativado the Fuerza Courses type.
	 * Version: 1.0.1
	 * Author: Mayon-Queiroz
	 * Author URI: https://github.com/maycon-queiroz
	 * License:  GPL2
	 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
	 * Text Domain: fuerza
	 * Requires PHP: >= 7.4
	 */

	defined( 'ABSPATH' ) || exit;

	if ( ! defined( 'WC_PLUGIN_FILE' ) ) {
		define( 'WC_PLUGIN_FILE', __FILE__ );
	}

	if ( ! defined( 'WC_TABLE_FUERZA' ) ) {
		define( 'WC_TABLE_FUERZA', 'fuerza_courser');
	}

	require __DIR__ . '/Fuerza_lib/autoload.php';

	if(!class_exists('FuerzaCursos')){
		class FuerzaCursos
		{
			private static FuerzaCursos $instance;

			public static function getInstance(): FuerzaCursos {
				if ( ! self::$instance ){
					self::$instance = new self;
				}
				return self::$instance;
			}

			private function __construct(){

				add_action('init', 'FuerzaCursos::fuerza_register_post_type');

				add_action('template_include',[$this,'add_cpt_templates']);
				add_action('wp_enqueue_scripts',[$this,'add_scripts_fuerza']);

			}

			public static function fuerza_register_post_type(){

				if (post_type_exists('fuerza_courses')) {
					return;
				}

				$slug = 'fuerza-courses';

				$rewrite = $slug ? array('slug' => sanitize_title($slug), 'with_front' => false, 'feeds' => false) : false;

				register_post_type('fuerza_courses',
					[
						'labels' => [

							'name' => __('Fuerza Courses', 'fuerza'),

							'singular_name' => __('Fuerza Course', 'fuerza'),

							'add_new' => __('Add new course', 'fuerza'),

							'add_new_item' => __('Add Course', 'fuerza'),

							'edit' => __('Edit', 'fuerza'),

							'edit_item' => __('Edit Course', 'fuerza'),

							'new_item' => __('Nova Course', 'fuerza'),

							'view' => __('View', 'fuerza'),

							'view_item' => __('Ver Course', 'fuerza'),

							'search_items' => __('Search Course', 'fuerza'),

							'not_found' => __('Course not found', 'fuerza'),

							'not_found_in_trash' => __('Course not found in the trash', 'fuerza'),

							'parent' => __('Parent Course', 'fuerza'),

						],

						'description' => __('Adds custom post of the Fuerza Courses type.', 'fuerza'),

						'public' => true,

						'has_archive' => ['archive_slug', 'fuerza_courses'],

						'menu_icon' => 'dashicons-edit-page',

						'rewrite' => $rewrite,

						'can_export' => true,

						'menu_position' => 5,

						'supports' => ['title', 'editor', 'excerpt', 'thumbnail' ],

					]

				);

			}

			public function activation(){
				self::fuerza_register_post_type();
				flush_rewrite_rules();
			}

			public function add_cpt_templates($template): string {

				if(is_singular( 'fuerza_courses' )){

					if(file_exists(get_stylesheet_directory() . 'templates/single-fuerza-courses.php')){

						return get_stylesheet_directory() . 'templates/single-fuerza-courses.php';

					}

					return plugin_dir_path(__FILE__) .  'templates/single-fuerza-courses.php';

				}

				return $template;

			}

			public function add_scripts_fuerza(){

				$css_folder =  plugins_url() . '/fuerza-course-try/assets/css';
				$js_folder =  plugins_url() . '/fuerza-course-try/assets/js';

				wp_enqueue_style('font-icons', $css_folder . '/all.min.css', "",'1.0.1');
				wp_enqueue_style('fuerza-courses', $css_folder . '/fuerza.css', "",'1.0.1');

				wp_enqueue_script('jquery-form');
				wp_enqueue_script('font-icons', $js_folder . '/all.min.js', "", '1.0.1', true);
				wp_enqueue_script('fuerza-courses', $js_folder . '/fuerza.js', "", '1.0.1', true);

				$wpVars = [
					'fuerzaUrl' => admin_url('admin-ajax.php'),
				];

				wp_localize_script('fuerza-courses', 'wp', $wpVars);

			}

		}

		FuerzaCursos::getInstance();


		register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
		register_activation_hook( __FILE__, 'FuerzaCursos::activation' );

	}
