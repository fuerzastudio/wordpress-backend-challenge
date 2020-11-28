<?php

	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	if ( ! class_exists( 'haveInterested' ) ) {
		/**
		 * Class haveInterested
		 */
		class haveInterested {

			/**
			 * @var array
			 */
			private array $data;

			/**
			 * @var InsertInterested
			 */
			private InsertInterested $save;

			/**
			 * haveInterested constructor.
			 *
			 * @param array $data
			 */
			public function __construct( array $data ) {
				$this->data = $data;
				$this->save = new InsertInterested( $this->data );

				$this->init();
			}

			/**
			 * init
			 *
			 * @return void
			 */
			public function init(): void {
				$this->save->save();

			}

		}

	}