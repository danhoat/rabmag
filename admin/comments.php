<?php 
Class RAB_Commenting extends RAB_Add_Menu_Backend{

	public function __construct(){	
	 	$comment = array(
		  		'page_title' 	=> 'Comments Settings',
		  		'menu_title' 	=> 'Comments Settings',
		  		'slug' 			=> 'rab-comments'		  		
	  		);
		parent::__construct($comment);
			
	}
	
	function rab_main(){
		
	}

	function page_load_scripts(){
		global $plugin_page;		
		if($this->slug == $plugin_page){	        		
			wp_enqueue_script('rab-settings',get_stylesheet_directory_uri().'/js/admin/comments.js',array('backbone') );
		}
	}
	function load_wp_admin_rab_style(){
		// wp_register_style( 'admin.css', get_template_directory_uri() . '/css/admin/admin.css' );
  //       wp_enqueue_style( 'admin.css' );
  //       wp_enqueue_script('backbone');
		// wp_enqueue_script('underscore');
		// wp_enqueue_script('backend',get_stylesheet_directory_uri().'/js/rab.js');
		// wp_enqueue_script('rab-settings',get_stylesheet_directory_uri().'/js/admin/settings.js',array('backbone') );

	}

}
new RAB_Commenting();