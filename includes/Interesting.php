<?php

	if(!class_exists('Interesting')){
		final class Interesting{

			public static function getTotalCount(int $courser_id = null): int {
				global $wpdb;

				$prepare = "SELECT count(a.id) as total FROM {$wpdb->prefix}fuerza_courser a 
      						WHERE courser_id = {$courser_id}";

				$results = $wpdb->get_results($prepare, OBJECT );

				if (sizeof($results) > 0) {
					return intval($results[0]->total);
				} else {
					return 0;
				}

			}

		}

	}