<?php
class Rab_Post {
	
	private $post_views = 'post_views';	
	private $post_likes = 'post_likes';
	private $post_votes = 'post_votes';
	private $ID;

	public function __construct($post_id){
		$this->ID = $post_id;		
	}

	public function get_post_meta($type){		
		return get_post_meta($this->ID, $this->post_views, true);		
	}

	public function get_post_views(){
		return get_post_meta($this->ID, $this->post_views, true);
	}
	
	public function get_post_like(){
		return get_post_meta($this->ID, $this->post_likes, true);	
	}
	public function get_post_votes(){
		return get_post_meta($this->ID, $this->post_votes, true);	
	}

	public function set_post_views($value = 0){
		if($value == 0){
			$views = $this->get_post_views() + 1;			
			$this->set_post_views($views);
		} else 		
			update_post_meta($this->ID,$this->post_views,$value);
	}

	public function set_post_likes($value){		
		update_post_meta($this->ID,$this->post_likes,$value);
	}
	
	public function set_post_votes($value){		
		update_post_meta($this->ID,$this->post_votes,$value);
	}

}
?>