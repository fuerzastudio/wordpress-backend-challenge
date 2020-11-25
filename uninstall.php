<?php

// if uninstall.php is not called by WordPress, die
	if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
		die;
	}

	/**
	 * Deactivation hook.
	 */
	register_deactivation_hook( __FILE__, 'fuerza_remove_database' );

	function fuerza_remove_database() {
		// Delete posts + data.
		CourseTable::dropTable();

		// Unregister the post type, so the rules are no longer in memory.
		unregister_post_type( 'book' );
		// Clear the permalinks to remove our post type's rules from the database.
		flush_rewrite_rules();

	}

	// Clear any cached data that has been removed.
	wp_cache_flush();