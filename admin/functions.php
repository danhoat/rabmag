<?php
class RM_BackEnd{
	protected $rab_opt = null;


	function __construct(){

		if($this->rab_opt == null)
        	$this->rab_opt = new RAB_Option();

		add_action('admin_init', array($this,'rab_backend_init') );

		add_action('admin_head',array($this,'reab_admin_header') );

		add_action('admin_enqueue_scripts', array($this,'rab_admin_scripts') );

		add_action('wp_ajax_rab_upload_logo',array($this,'rab_upload_logo'));

		add_action('edit_attachment', array($this,'save_our_attachment_meta') );
	}
	function rab_backend_init(){

		wp_register_style('admin.css', get_template_directory_uri().'/css/admin/admin.css' );
		wp_register_script('rab.js', get_template_directory_uri().'/js/rab.js',array('jquery','backbone','underscore', 'plupload-all'),false,true);		
		wp_register_script('admin.js', get_template_directory_uri().'/js/admin/admin.js',array('jquery','backbone','underscore','rab.js'),false,true);	
		$this->add_our_attachment_meta();

	}

	function add_our_attachment_meta(){
		   add_meta_box( 'custom-attachment-meta-box',
		                 'Select Slider',
		                 array($this,'our_attachment_meta_box_callback'),
		                 'attachment',
		                 'normal',
		                 'low');
	}

	function save_our_attachment_meta(){
	     global $post;
	     if( isset( $_POST['rab_slider'] ) ){
	           update_post_meta( $post->ID, 'rab_slider', $_POST['rab_slider'] );
	     }
	}

	function our_attachment_meta_box_callback(){
		global $post;
		$slider = $this->rab_opt->get_option_slider();
		$value = get_post_meta($post->ID, 'rab_slider', 1);
		?>
		<select name="rab_slider">
		<?php foreach ($slider as $key => $title) { ?>
			<option value="<?php echo $key;?>" <?php selected( $key, $value ); ?> ><?php echo $title;?> </option>

		<?php } ?>
		</select>
		<?php
	}

	function reab_admin_header(){

		wp_enqueue_style('admin.css');
		$rab_globals = array(
			'ajaxUrl' 				=>	admin_url('admin-ajax.php'),
			'flash_swf_url'       	=> includes_url( 'js/plupload/plupload.flash.swf' ),
			'silverlight_xap_url'	=> includes_url( 'js/plupload/plupload.silverlight.xap' ),
		);

		?>
		<script type="text/javascript">
		var rab_globals = <?php echo json_encode($rab_globals);?>;
		</script>
		<?php
	}


	function rab_admin_scripts(){
		wp_enqueue_script('jquery');
		wp_enqueue_script('plupload-all');
		wp_enqueue_script('rab.js');
		wp_enqueue_script('admin.js');

	}
	public function rab_upload_logo(){

		check_admin_logged();
		$resp = array('success'=> false,'msg'=>__('Upload file fail',RAB_DOMAIN));

		$att_id = rab_access_upload_file($_FILES['file']);

		if(!is_wp_error($att_id)){
			$this->rab_opt->set_option('rab_logo',$att_id);
			wp_send_json(array('success' => true,'msg'=>__('Uplaoded file success',RAB_DOMAIN),'attach' => wp_get_attachment_image_src($att_id,'full') ));
		}
		wp_send_json($resp);
	}

}

function check_admin_logged(){
	if(!is_admin() || !current_user_can('manage_options'))
		wp_send_json(array('success' => false,'msg'=> __('You don\'t allow access!')));
}
abstract class RAB_Add_Menu_Backend {
	private $default = array();
	protected $slug;

	function __construct($args = array()){
		$this->slug 	= $args['slug'];
		$this->default 	= $args;
		add_action( 'admin_menu', array( $this,'add_sub_menu' ) );
		add_action( 'rab_left_menu',array( $this,'rab_left_menu' ) );
		if(isset($_GET['page']) == $args['slug'])
		add_action('admin_head', array($this,'page_load_scripts') );

	}
	abstract function page_load_scripts();
	function rab_left_menu(){

		$url 	= admin_url('admin.php');
		$args 	= $this->default;
		extract($args);
		$url = add_query_arg(array('page'=>$slug ),$url);
		echo '<li><a href="'.$url.'"> '.$menu_title.' </a></li>';

	}

	function get_current_arg(){
	    return $this->default;
	}

	function add_sub_menu(){
		$args = $this->default;
		extract($args);
		if($slug == "rab-settings")
			add_menu_page( __('Rab Settings',RAB_DOMAIN),  __('Rab Settings',RAB_DOMAIN), 'manage_options', 'rab-settings', array($this,'menu_view'), '' , 4 );	
		else
			add_submenu_page( 'rab-settings', $page_title , $menu_title , 'manage_options', $slug, array($this,'menu_view') ); 
	}

	public function rab_left(){
		$default = $this->default;
		?>
	 	<div class="wrap" id="rab_backend">
	   		<div class="wrap-rab">
		   		<div class="rab-left">
		   			<ul>
		   			 <?php do_action('rab_left_menu');?>
		   			</ul>
		   		</div>
		   		<div class="wrap-right-rab">
		   			<div class="row heading">
						<h2 class="title"> <?php printf(__('%s',RAB_DOMAIN), $default['page_title']);?></h2>
						<span><?php _e('Describe the function of menu','RAB_DOMAIN');?></span>
						<?php  _e('About Us','RAB_DOMAIN'); ?>
					</div>
		   		<?php
	}

	public function rab_right(){ ?>
				</div>
			</div>
	   	</div>
	   	<?php
	}

	abstract function rab_main();


	function menu_view($default = array()){
		$this->rab_left();
		$this->rab_main();
		$this->rab_right();
	}

}
?>