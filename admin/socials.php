<?php 
Class RAB_Socials extends RAB_Add_Menu_Backend{

	public function __construct(){	
	 	$comment = array(
		  		'page_title' 	=> 'Socials Settings',
		  		'menu_title' 	=> 'Social Settings',
		  		'slug' 			=> 'rab-social'		  		
	  		);
		parent::__construct($comment);
		//add_action('admin_enqueue_scripts',array($this,'load_wp_admin_rab_style'));		
	}
	
	function rab_main(){ 				
		?>		
		<div class="rab-content">
			<div class="general">
				<form>
					<div class="form-item">
					 	<label> Facebook</label>
					 	<input type="text"  class="option" name="text" name="site_title" />
					</div>

					<div class="form-item">
					 	<label> Twitter</label>
					 	<input type="text" name="text" class="option" name="site_logo" />
					</div>

					<div class="form-item">
						<label> Google Plus</label>
					 	<input type="text" class="option" name="text" name="site_des" />
					</div>
					<div class="form-item">
						<label>Dripble</label>
					 	<input type="text" class="option" name="text" name="site_des" />
					</div>
					<div class="form-item">
						<label>Linked</label>
					 	<input type="text" class="option" name="text" name="site_des" />
					</div>
					

				</form>
			</div>
		</div>	
		<?php		
	}
	function page_load_scripts(){
		
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
new RAB_Socials();