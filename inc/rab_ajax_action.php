<?php

	add_action( 'wp_ajax_nopriv_rab_contact', 'rab_contact' );
	add_action( 'wp_ajax_rab_contact', 'rab_contact' );

	function rab_contact(){

		$request = $_POST;
		if( is_null($_POST['user_name']) || is_null($request['user_email']) || is_null($request['content']) ){
			wp_send_json(array('success' => true, 'msg' => __('Please enter your information', RAB_DOMAIN)));
		}
		$ad_email 	= get_option('admin_email');
		$message 	= 'Email from abc.com';
		$message 	.= 'Visitor information:<br />Full name:[user_name].<br /> Phone: [user_phone].<br /> Email: [user_email].<br /> Address: [user_address].<br />Content :[content]';

		$message  	= str_replace("[user_name]", $request['user_name'], $message);
		$message  	= str_replace("[user_address]", $request['user_address'], $message);
		$message  	= str_replace("[user_email]", $request['user_email'], $message);
		$message  	= str_replace("[user_phone]", $request['user_phone'], $message);
		$message  	= str_replace("[content]", $request['content'], $message);

		$headers = array(
			'Reply-To' => $request['user_email']
		);

		$mail = wp_mail($ad_email, 'Contact from website', $message, $headers);

		if ( $mail ){
			$auto = wp_mail($request['user_email'], 'Email auto sent from abc.com. Thak for your time to contact with us.');
			wp_send_json(array('success' => true, 'msg' => __('Email has been sent successfull', RAB_DOMAIN)));

		} else {
			wp_send_json(array('success' => false, 'msg' => __('Send mail fail', RAB_DOMAIN)));
		}
	}

?>