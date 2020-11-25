<?php
	/**
	 * Plugin Name: Fuerza Cursos
	 * Plugin URI: https://www.fuerzastudio.com.br/
	 * Description: Adds personalized post dissemination of courses in any theme that is being used on the site where the plugin for activated the Fuerza Courses type.
	 * Version: 1.0.1
	 * Author: Maycon-Queiroz
	 * Author URI: https://github.com/maycon-queiroz
	 * License:  GPL2
	 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
	 * Text Domain: fuerza
	 * Requires PHP: >= 7.4
	 */
	// If this file is called directly, abort.
	if ( ! defined( 'WPINC' ) ) {
		die;
	}

	defined( 'ABSPATH' ) || exit;

	if ( ! defined( 'WC_PLUGIN_FILE' ) ) {
		define( 'WC_PLUGIN_FILE', __FILE__ );
	}

	if ( ! defined( 'WC_TABLE_FUERZA' ) ) {
		define( 'WC_TABLE_FUERZA', 'fuerza_courser' );
	}


	/**
	 * The core plugin class that is used to define internationalization,
	 * admin-specific hooks, and public-facing site hooks.
	 */
	require plugin_dir_path( WC_PLUGIN_FILE ) . 'includes/Fuerza_lib/autoload.php';

	/**
	 * Begins execution of the plugin.
	 *
	 * Since everything within the plugin is registered via hooks,
	 * then kicking off the plugin from this point in the file does
	 * not affect the page life cycle.
	 *
	 * @since    1.0.0
	 */
	function run_fuerza_courses() {

		FuerzaCursos::getInstance();

	}

	run_fuerza_courses();
