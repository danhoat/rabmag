<?php

Class RAB_Settings extends RAB_Add_Menu_Backend{


	public function __construct(){
		$args = array(
		  		'page_title' 	=> __('Rab Settings',RAB_DOMAIN),
		  		'menu_title' 	=> __('Rab Settings',RAB_DOMAIN),
		  		'slug' 			=> 'rab-settings',
	  		);
		parent::__construct($args);

	}

	function page_load_scripts(){
		global $plugin_page;

		if($this->slug == $plugin_page){
			//wp_enqueue_script('rab-settings',get_stylesheet_directory_uri().'/js/admin/settings.js',array('backbone','rab.js') );
		}

	}

	function rab_main(){
		$default =$this->get_current_arg();
		$option = RAB_Option::get_option();
		extract($option);

	   	?>
		<div class="rab-content">
			<div class="general">
				<form>
					<div class="form-item">
					 	<label><?php _e('Website title',RAB_DOMAIN);?></label>
					 	<input type="text" value="<?php echo $site_title;?>"  class="option" name="site_title" />
					</div>

					<div class="form-item">
						<div id="container">
						    <a id="pickfiles" href="#">[Select files]</a>
						</div>
					 	<div id="filelist">
					 	<?php
					 		if(is_numeric($rab_logo)){
								$logo = wp_get_attachment_image_src($rab_logo,'thumbnail',false);
								echo '<img src="'.$logo[0].'">';
							}
						?>

					 	</div>
					</div>

					<div class="form-item">
						<label> Website Description</label>
					 	<textarea type="text"   class="option" name="site_description" /><?php echo $site_description;?></textarea>
					</div>

					<div class="form-item">
						<label> Copyright footer</label>
					 	<textarea type="text"   class="option" name="rab_coppyright_text" /><?php echo $rab_coppyright_text;?></textarea>
					</div>

					<div class="form-item">
						<label><?php _e('Google Font For  Title',ET_DOMAIN);?></label>
					 	<select name="site_google_font" class="option select" >
					 		<option <?php if($site_google_font['url'] == 'http://fonts.googleapis.com/css?family=PT+Sans') echo 'selected="selected"';?> value="http://fonts.googleapis.com/css?family=PT+Sans">PT Sans</option>
					 		<option <?php if($site_google_font['url'] == 'http://fonts.googleapis.com/css?family=Open+Sans') echo 'selected="selected"';?> value="http://fonts.googleapis.com/css?family=Open+Sans">Open Sans</option>
					 		<option <?php if($site_google_font['url'] == 'http://fonts.googleapis.com/css?family=Droid+Sans') echo 'selected="selected"';?> value="http://fonts.googleapis.com/css?family=Droid+Sans">Droid Sans</option>					 	
					 	</select>
					</div>

					<div class="form-item">
						<label>Google Analytics Script</label>
					 	<textarea class="option" cols="36"  rows="10" name="site_google_script"><?php echo stripslashes($rab_google_analytic);?></textarea> 
					</div>
					<div class="form-item">
						<button class="btn button"> Save </button>
					</div>

				</form>
			</div>
		</div>
	   	<?php
	}

}
new RAB_Settings();