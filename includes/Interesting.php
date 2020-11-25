<?php

	if ( ! class_exists( 'Interesting' ) ) {

		/**
		 * Class Interesting
		 */
		final class Interesting {

			/**
			 * @param int|null $courser_id
			 *
			 * @return int
			 */
			public static function getTotalCount( int $courser_id = null ): int {
				global $wpdb;

				$prepare = "SELECT count(a.id) as total FROM {$wpdb->prefix}fuerza_courser a 
      						WHERE courser_id = {$courser_id}";

				$results = $wpdb->get_results( $prepare, OBJECT );

				if ( sizeof( $results ) > 0 ) {
					return intval( $results[0]->total );
				} else {
					return 0;
				}
			}


			/**
			 * @param int $courser_id
			 *
			 * @return object|null
			 */
			public static function findAll( int $courser_id): ?array {
				global $wpdb;

				$prepare = "SELECT * FROM {$wpdb->prefix}fuerza_courser
      						WHERE courser_id = {$courser_id}";

				$results = $wpdb->get_results( $prepare, OBJECT );

				if ( sizeof( $results ) > 0 ) {
					return $results;
				} else {
					return null;
				}

			}

		}

	}