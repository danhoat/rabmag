<?php
if(class_exists('WooCommerce')){
	class RAB_Woo{
		function __construct(){
			add_filter( "pre_get_posts", array($this,'pre_get_posts'), 10000 );
			add_filter( "post_format_default", array($this,"rab_get_post_format"));
			add_action( "rab_before_loop", array($this,"rab_before_loop"));
			add_action( "rab_after_loop", array($this,"rab_after_loop"));
			add_filter( "woocommerce_enqueue_styles", array($this,"woocommerce_enqueue_styles_override"),12 );
			add_filter('body_class', array($this,'multisite_body_classes') );

			add_filter("woocommerce_output_related_products_args", array($this, "woocommerce_output_related_products_args_custom") );

			
		}

		function woocommerce_output_related_products_args_custom($args){

			    $args["posts_per_page"] = 4;

			    $args["columns"] = 4;

			    return $args;

			}
		function multisite_body_classes($classes) {		      
		        $classes[] = 'woocommerce';
		      
		        return $classes;
		}

		function rab_before_loop(){
			?>
			<div class="content-product row">
				<div class="products">
			<?php 
		}
		function rab_after_loop(){
			?>
				</div>
			</div>
			<?php 
		}
		
		function woocommerce_enqueue_styles_override($args){
		  
		            $args['woocommerce-general'] =  array(
		                'src'     => str_replace( array( 'http:', 'https:' ), '', get_template_directory_uri() ) . '/woocommerce.css',
		                'deps'    => '',
		                'version' => WC_VERSION,
		                'media'   => 'all'
		            );
		        return $args;
		}


		function rab_get_post_format(){
			return "product";
		}
		// danng 
		function pre_get_posts( $query ) {

		  

		    if( !$query->is_main_query()  ) 

		        return $query;

		    if( is_home() || is_search()  )    	
		    	$query->set('post_type','product');

		    $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : '';
		    switch ($orderby) {
		    	case 'views':
		    		
		    	 	//add_filter('posts_orderby', 'posts_orderby_for_search' );
		    		$query->set("orderby","meta_value_num");
		    		$query->set("meta_key","post_views");

		    		$query->set('meta_query', array(
		                                        'relation' => 'OR',
		                                        array(
		                                            'key'       => 'post_views',
		                                            'compare'   => '',
		                                            'value'     => 0
		                                        ),

		                                        array(
		                                            'key'       => 'post_views',
		                                            'compare'   => 'NOT EXISTS'                        
		                                        ),
		                                        
		                                    )
		                        );
		            $query->set("order","DESC");
								
		    		break;

		    	case 'price' :
		    		$query->set("orderby","meta_value_num");
		    		$query->set("meta_key","_price");
		    		$query->set("order","ASC");
		    		break;


		    	case 'price-desc' :    	
		    		$query->set("orderby","meta_value_num");
		    		$query->set("meta_key","_price");
		    		$query->set("order","DESC");

		    		break;
		    	
		    	default:
		    		# code...
		    		break;
		    }
		    
			$tax_id = (int) isset($_GET["p_cat"]) ? $_GET["p_cat"] : "";
			if(!empty($tax_id) && $tax_id > 0 )
		        $query->set('tax_query',array(array("taxonomy"=>"product_cat", "terms"=>$tax_id, "field" => "id")));



		    return $query;

		}
	}
	new RAB_Woo();
}

?>