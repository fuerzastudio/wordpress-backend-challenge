<?php

	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	if ( ! class_exists( 'InsertInterested' ) ) {
		/**
		 * Class InsertInterested
		 */
		final class InsertInterested {

			/**
			 * @var mixed
			 */
			protected $data;
			/**
			 * @var string
			 */
			protected string $tableName;
			/**
			 * @var wpdb
			 */
			protected $global;

			/**
			 * @var mixed
			 */
			protected $id;

			/**
			 * __construct
			 *
			 * @param mixed $data
			 *
			 * @return void
			 */
			public function __construct( $data ) {
				global $wpdb;

				$this->global = $wpdb;

				$this->tableName = $this->global->prefix . WC_TABLE_FUERZA;

				$this->id = $data['courser_id'];

				$this->data = $data;

				$this->emailExists();
			}

			/**
			 * save
			 *
			 * @return void
			 */
			public function save(): void {
				$format = [ '%s', '%s', '%s', '%s' ];
				$result = $this->global->insert( $this->tableName, $this->data, $format );

				$this->getResults( $result );
			}

			/**
			 * @param $result
			 */
			public function getResults( $result ): void {
				if ( $result === 1 ) {

					$data = json_decode( get_post_meta( $this->id, '_fuerza_settings', true ), false );

					$link = $data->_fuerza_link;

					$this->data['link']   = $link;
					$this->data['action'] = "UserValidated";

					wp_send_json_success( $this->data );
				}

			}

			/**
			 *
			 */
			private function emailExists(): void {
				$result = $this->global->get_results(
					"SELECT * FROM " . $this->tableName .
					" WHERE courser_id = '" . $this->id . "' AND email = '" .
					$this->data['email'] . "'", OBJECT );

				if ( $result ) {
					$json['field']   = 'email';
					$json['message'] = "Este mail já existe em nossa base de dados, por favor tente com um novo email";

					wp_send_json_error( $json );
				}

			}

		}

	}