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
					 	<label><?php _e('Website title', RAB_DOMAIN);?></label>
					 	<input type="text" value="<?php echo $site_title;?>"  class="option" name="site_title" />
					</div>

					<div class="form-item" style="display:none;">
						<div id="container">
						    <a id="pickfiles" href="#">[<?php _e('Select files',RAB_DOMAIN);?>]</a>
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
						<label> <?php _e('Website Description', RAB_DOMAIN);?></label>
					 	<textarea type="text"   class="option" name="site_description" /><?php echo $site_description;?></textarea>
					</div>

					<div class="form-item">
						<label> <?php _e('Copyright footer',RAB_DOMAIN);?></label>
					 	<textarea type="text"   class="option" name="rab_coppyright_text" /><?php echo stripslashes($rab_coppyright_text);?></textarea>
					</div>

					<div class="form-item">
						<label><?php _e('Google Font For  Title',RAB_DOMAIN);?></label>

						<?php		$google_fonts = ra_list_google_fonts();			?>
						<select name="ra_google_font" class="option select" >
							<option value="0">Select Google Font</option>
							<?php
					 		foreach ($google_fonts as $key => $font) { ?>

					 			<option <?php selected( $key, ra_get_google_key_name() ) ?>  value="<?php echo $key;?>"> <?php echo $font['title'];?></option>

					 		<?php	}	?>
						</select>

					</div>

					<div class="form-item">
						<label><?php _e('Google Analytics Script', RAB_DOMAIN);?></label>
					 	<textarea class="option" cols="36"  rows="10" name="<?php echo RAB_Option::RA_GOOLE_ANALYTIC;?>"><?php echo stripslashes($rab_google_analytic);?></textarea> 
					</div>
					<div class="form-item">
						<button class="btn button"> <?php _e('Save',RAB_DOMAIN);?> </button>
					</div>

				</form>
			</div>
		</div>
	   	<?php
	}

}
new RAB_Settings();