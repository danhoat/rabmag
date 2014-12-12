<?php
if(class_exists('RAB_Add_Menu_Backend')){

	Class RAB_Slider extends RAB_Add_Menu_Backend{
		protected $list_slider = null;
		public function __construct(){	
		 	$slider = array(
			  		'page_title' 	=> 'Slider',
			  		'menu_title' 	=> 'Slider Settings',
			  		'slug' 			=> 'rab-slider',
			  		
		  		);
		 	$this->list_slider = RAB_Option::get_slider();
			parent::__construct($slider);
			add_action('admin_enqueue_scripts',array($this,'load_wp_admin_rab_style'));		
		}
		function page_load_scripts(){

		}
		
		function rab_main(){ ?>
			<div class="rab-content">
				<div class="general">
					<?php
					$slider = $this->list_slider;
					
					if(count($slider) > 0 && is_array($slider)){
						
						foreach ($slider as $key=>$value) {
							
							echo '<div class="form-item">';
								echo $key; 
								echo $value;
							echo '</div>';
							
						}
					}
					?>
					<form class="save-opt-slider" method="_POST">
						<div class="form-item">
						 	<label><?php _e('Slider Title',RAB_DOMAIN);?></label>
						 	<input type="text" value=""   name="slide_title" />
						 	<input type="hidden" name="action" value="save-slider" />
						</div>
						<div class="form-item">
						 	<label><?php _e('Slider Name',RAB_DOMAIN);?></label>
						 	<input type="text" value=""   name="slide_name" />
						 	<input type="hidden" name="action" value="save-slider" />
						</div>

						<div class="form-item">
							<button class="btn button"> <?php _e('Save Slider',RAB_DOMAIN);?></button>
						</div>
					</form>
				</div>
			</div>	
		<?php    		
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


	new RAB_Slider();	
}

?>