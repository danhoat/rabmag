<?php 
Class RAB_Languages extends RAB_Add_Menu_Backend{

	public function __construct(){	
	 	$comment = array(
		  		'page_title' 	=> 'Languages Settings',
		  		'menu_title' 	=> 'Languages Settings',
		  		'slug' 			=> 'rab-languages',
		  		
	  		);
		parent::__construct($comment);
		//add_action('admin_enqueue_scripts',array($this,'load_wp_admin_rab_style'));		
	}
	function page_load_scripts(){

	}
	
	function rab_main(){
		echo ' noi dung cua language';		
	}

	function load_wp_admin_rab_style(){
		wp_register_style( 'admin.css', get_template_directory_uri() . '/css/admin/admin.css' );
        wp_enqueue_style( 'admin.css' );
        wp_enqueue_script('backbone');
		wp_enqueue_script('underscore');
		wp_enqueue_script('backend',get_stylesheet_directory_uri().'/js/rab.js');
		wp_enqueue_script('rab-settings',get_stylesheet_directory_uri().'/js/admin/settings.js',array('backbone') );

	}

}
new RAB_Languages();