<?php

	if (!defined('ABSPATH')) {
		exit;
	}

	if(!class_exists( 'CourseTable' )){
		class CourseTable
		{
			/**
			 * __construct
			 */
			public function __construct()
			{
				$this->init();
			}

			/**
			 * createTable
			 *
			 * @return void
			 */
			public static function init(): void
			{
				require_once ABSPATH . 'wp-admin/includes/upgrade.php';
				global $wpdb;

				$sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}".WC_TABLE_FUERZA." (
                id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                courser_id bigint(20) NOT NULL,
                courser varchar(100) NOT NULL,
                name varchar(255) NULL,
                email varchar(100) NULL,           
                created_at TIMESTAMP DEFAULT current_timestamp() NOT NULL,
                updated_at TIMESTAMP DEFAULT current_timestamp() on update current_timestamp() NOT NULL,
                PRIMARY KEY (id)
                )
                ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

				$wpdb->query($sql);

			}


		}

	}