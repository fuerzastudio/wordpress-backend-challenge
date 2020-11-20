<?php

	if (!defined('ABSPATH')) {
		exit;
	}
	if(!class_exists('InsertInterested')){
		/**
		 * Class InsertInterested
		 */
		final class InsertInterested
		{
			/**
			 * @var mixed
			 */
			protected $data;
			/**
			 * @var string
			 */
			protected $tableName;
			/**
			 * @var wpdb
			 */
			protected $global;

			protected $id;

			/**
			 * __construct
			 *
			 * @param  mixed $data
			 * @return void
			 */
			public function __construct($data)
			{
				global $wpdb;

				$this->global = $wpdb;

				$this->tableName = $this->global->prefix . WC_TABLE_FUERZA;

				$this->id = $data['courser_id'];

				$this->data = $data;


			}

			/**
			 * save
			 *
			 * @return void
			 */
			public function save(): void
			{
				$format = ['%s', '%s', '%s', '%s'];
				$result =  $this->global->insert($this->tableName, $this->data, $format);

				$this->getResults($result);
			}


			public function getResults($result)
			{
				if ($result === 1) {

					$data = json_decode(get_post_meta($this->id, '_fuerza_settings', true), false);

					$link = $data->_fuerza_link;

					$this->data['link'] = $link;
					$this->data['action'] = "UserValidated";


					return wp_send_json_success($this->data);
				}

			}


		}

	}