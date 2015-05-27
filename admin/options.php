<?php
class RAB_Option{

	const RAB_SITE_OPTION 			= 'rab_sites';
	const RAB_SITE_SOCIALS 	 		= 'rab_socials';
	const RAB_SLIDER 	 			= 'rab_slider';
	protected static 	$df_options = null;

	function __construct(){
		self::$df_options = array(
						'site_title' 			=> __(get_option('blogname'),RAB_DOMAIN ),
						'site_description' 		=> __(get_option('blogdescription'),RAB_DOMAIN),
						'rab_logo'				=> get_template_directory().'/images/logo.png',
						'site_google_script' 	=> '',
						'site_google_font' 		=> array('title'=>'PT Sans','url'=> 'http://fonts.googleapis.com/css?family=Open+Sans'),
						'rab_google_analytic' 	=> '',
					);		
		add_action('wp_ajax_save-option',array($this,'rab_save_option') );
		add_action('wp_ajax_save-slider',array($this,'rab_save_slider') );
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
			case 'site_google_font' :
				$option[$name] = array('title'=>$html,'url'=>$value);			
			default:
				# code...
				break;
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
	function get_option_slider(){
		return get_option(self::RAB_SLIDER,array());
	}
	public static function get_slider(){
		return get_option(self::RAB_SLIDER,array());
	}
	function set_option_slider($slider){

		$options 		=	 $this->get_option_slider();	
		$options[$slider['slide_name']] 	= $slider['slide_title'];
		update_option(self::RAB_SLIDER,$options);

	}
	function rab_save_slider(){
		$this->set_option_slider($_POST);
		$resp = array('success'=>false,'msg'=>__('Save slider successfull!',RAB_DOMAIN));
		wp_send_json($resp);
	}
}
function get_logo_url(){
	$options = new RAB_Option();
	return $options->get_logo_url();	
}

?>