<?php

	add_action( 'wp_ajax_nopriv_rab_contact', 'rab_contact' );
	add_action( 'wp_ajax_rab_contact', 'rab_contact' );

	function rab_contact(){

		$request = $_POST;
		if( is_null($_POST['user_name']) || is_null($request['user_email']) ){
			wp_send_json(array('success' => true, 'msg' => __('Vui long nhap thong tin', RAB_DOMAIN)));
		}
		$ad_email 	= get_option('admin_email');

		$mail 		= wp_mail($ad_email, 'Contact from website', ' noi dung');

		if($mail)
			wp_send_json(array('success' => true, 'msg' => __('The email has been sent successfull', RAB_DOMAIN)));
		else
			wp_send_json(array('success' => false, 'msg' => __('Send mail fail', RAB_DOMAIN)));
	}

?>