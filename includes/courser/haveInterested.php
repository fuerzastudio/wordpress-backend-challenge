<?php

	if (!defined('ABSPATH')) {
		exit;
	}

	if ( !class_exists( 'haveInterested' ) ) {
		class haveInterested
		{
			private array $data;

			private InsertInterested $save;

			public function __construct(array $data)
			{
				$this->data = $data;
				$this->save = new InsertInterested($this->data);

				$this->init();
			}

			/**
			 * init
			 *
			 * @return void
			 */
			public function init(): void
			{
				$this->save->save();

			}

		}

	}