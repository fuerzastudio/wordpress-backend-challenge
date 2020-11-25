<?php

	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	if ( ! function_exists( 'haveInterested' ) ) {
		function haveInterested():void {
			$postData = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRIPPED );
			$postData = array_map( 'strip_tags', array_map( 'trim', $postData ) );

			isEmpty( $postData );

			validateEmail( $postData['email'] );

			$class = $postData['action'];
			unset( $postData['action'] );

			$data = $postData;
			unset( $postData );

			new $class( $data );

			exit;
		}

		add_action( 'wp_ajax_haveInterested', 'haveInterested' );
		add_action( 'wp_ajax_nopriv_haveInterested', 'haveInterested' );
	}


	if ( ! function_exists( 'validateEmail' ) ) {
		function validateEmail( $email ): void {

			if ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) && ! is_email( $email ) ) {

				$json['field']   = 'email';
				$json['message'] = "Por favor digite um email valido.";

				wp_send_json_error( $json );
			}
		}
	}


	if ( ! function_exists( 'isEmpty' ) ) {
		function isEmpty( $data ): void {

			foreach ( $data as $key => $item ) {

				if ( empty( $item ) ) {

					$json['field']   = $key;
					$json['message'] = "Este campo está em branco, você precisa preencher para continuar.";

					wp_send_json_error( $json );
				}
			}
		}
	}
