<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title><?php  if( empty( $title ) && ( is_home() || is_front_page() ) ) {
            echo  get_bloginfo('name').' | ' . get_bloginfo( 'description' );
          } else
            wp_title(" "); ?>
        </title>

	    <?php wp_head();?>

	  	</head>
  	<body <?php body_class();?>>
  	<div class="main-header header-site">
         <div class="container">
            <img src="<?php echo( get_header_image() ); ?>" alt="<?php echo( get_bloginfo( 'title' ) ); ?>" />
         </div>
         <nav class="menu-main">

           <div class="container">
                   <?php wp_nav_menu(array( 'theme_location' => apply_filters( RAB_DOMAIN, 'header' ) ,'menu_class' => 'main-menu' ,'container_class' => 'menu-main-menu-container' ));?>
           </div>

         </nav>

  	</div>
  

    <?php
    if(is_active_sidebar('header')):
        echo '<div class="row">';
        dynamic_sidebar('header');
        echo '</div>';
    endif;
    ?>