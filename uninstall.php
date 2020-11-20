<?php

// if uninstall.php is not called by WordPress, die
	if (!defined('WP_UNINSTALL_PLUGIN')) {
		die;
	}

	register_deactivation_hook( __FILE__, 'fuerza_remove_database' );
	function fuerza_remove_database() {
		// Delete posts + data.
		CourseTable::dropTable();
	}
	// Clear any cached data that has been removed.
	wp_cache_flush();

