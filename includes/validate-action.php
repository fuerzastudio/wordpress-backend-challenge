<?php

	if (!defined('ABSPATH')) {
		exit;
	}

	function haveInterested()
	{
		$postData = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);
		$postData = array_map('strip_tags', array_map('trim', $postData));

		isEmpty($postData);

		validateEmail($postData['email']);

		$class = $postData['action'];
		unset($postData['action']);

		$data = $postData;

		$updated = (new $class($data));

		exit;
	}

	add_action('wp_ajax_haveInterested', 'haveInterested');
	add_action('wp_ajax_nopriv_haveInterested', 'haveInterested');


	function validateEmail($email){

		if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !is_email($email)){

			$json['field'] = 'email';
			$json[ 'message'] = "Por favor digite um email valido";

			return wp_send_json_error($json);
		}
	}

	function isEmpty($data){

		foreach ($data as $key => $item){

			if(empty($item)){

				$json['field'] = $key;
				$json[ 'message'] = "Este campo está em branco, você precisa preencher para continuar";

				return wp_send_json_error($json);
			}
		}

	}
