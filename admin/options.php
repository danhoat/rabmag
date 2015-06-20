<?php
class RAB_Option{

	const RAB_SITE_OPTION 			= 'rab_sites';
	const RAB_SITE_SOCIALS 	 		= 'rab_socials';
	const RAB_SLIDER 	 			= 'rab_slider';
	const RA_GOOLE_ANALYTIC     	= 'rab_google_analytic';
	const RA_GOOLE_FONT         	= 'ra_google_font';
	protected static 	$df_options = null;

	function __construct(){

		self::$df_options = array(
						'site_title' 			=> __(get_option('blogname'),RAB_DOMAIN ),
						'site_description' 		=> __(get_option('blogdescription'),RAB_DOMAIN),
						'rab_logo'				=> get_template_directory().'/images/logo.png',
						'rab_coppyright_text' 	=>'',
						'site_google_script' 	=> '',
						self::RA_GOOLE_FONT 	=> '',
						self::RA_GOOLE_ANALYTIC => '',
					);
		add_action( 'wp_ajax_save-option', array( $this, 'rab_save_option') );
		add_action( 'wp_ajax_save-slider', array( $this, 'rab_save_slider') );
	}

	public function rab_get_option(){
		$options 	= get_option(self::RAB_SITE_OPTION,array(), false);
		$args 		= wp_parse_args( $options, self::$df_options);

		return $args;
	}

	public static function get_option(){
		$rab_option = new RAB_Option();
		return $rab_option->rab_get_option();

	}

	function set_option($name, $value,$html = ''){

		$option 		= self::get_option();
		$option[$name] 	= $value;

		switch ($name) {
			case 'site_title':
				update_option('blogname', $value);
				break;
			case 'site_description':
				update_option('blogdescription', $value);
				break;


			default:

			update_option($name, $value);

		}

		update_option(self::RAB_SITE_OPTION, $option);

	}

	function rab_save_option(){
		$request = $_POST;
		$this->set_option($request['name'],$request['value'],$request['html']);
		$resp = array('success' => true,'msg' => __('Save option success',RAB_DOMAIN));
		wp_send_json($resp);
	}

	function get_options_sites(){
		$option 		= self::get_option();;
		return $option;
	}

	function save_options_sites($name,$value){
		$options = $this->get_options_sites();
		$options[$name] = $value;
		update_option(self::RAB_SITE_OPTION,$options);
	}

	function get_option_socials(){
		$default = array(
					'google'	=> '',
					'facebook'	=> '',
					'twitter'	=> '',
					'printest'	=> '',
					'flick'		=> ''
					);
		$options = get_option(self::RAB_SITE_SOCIALS,array());

		return wp_parse_args($options,$default);
	}
	function save_option_socials($name,$value){
		$options = $this->get_option_socials();
		$options[$name] = $value;
		update_option(self::RAB_SITE_SOCIALS,$options);
	}
	function get_logo_url(){

		$options = $this->get_options_sites();
		extract($options);
		$attach = wp_get_attachment_image_src($rab_logo,'full');

		if(isset($attach[0]))
			return $attach[0];

		return get_template_directory().'/images/logo.png';

	}

}
function get_logo_url(){

	$options = new RAB_Option();
	return $options->get_logo_url();
}
function ra_get_google_script(){
	return get_option(RAB_Option::RA_GOOLE_ANALYTIC,'');
}
function ra_get_google_key_name(){
	return  get_option(RAB_Option::RA_GOOLE_FONT,'');
}
function ra_get_google_font(){
	$index_key = ra_get_google_key_name();
	/*
	* when has not set a google font.
	 */
	if ( empty($index_key) )
		return 0;
	/*
	* return google font value in  list google font
	 */
	return ra_list_google_fonts( ra_get_google_key_name() );
}

?>