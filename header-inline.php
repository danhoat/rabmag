<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	   <title><?php wp_title( '|', true, 'right' ); ?></title>

	    <?php wp_head();?>

	  	</head>
  	<body <?php body_class();?>>
        <div class="row full-row top-row">
            <div class="container">
                    <div class="row">
                        <div class="pd-right-none col-md-3 ">
                            <?php if (  get_header_image()  != '' ) { ?>
                                <a href="<?php echo home_url();?>">    <img src="<?php echo get_header_image() ; ?>" alt="<?php echo( get_bloginfo( 'title' ) ); ?>" /> </a>
                        <?php } ?>
                        </div>
                        <div class="col-md-9">
                            <nav class="menu-main">
                                <?php wp_nav_menu(array( 'theme_location' => apply_filters( RAB_DOMAIN, 'main_menu' ) ,'menu_class' => 'main-menu' ,'container_class' => 'menu-main-menu-container' ));?>
                            </nav>
                        </div>
                    </div>
          	</div>
        </div>
        <?php
            if(is_active_sidebar('header')):
                echo '<div class="row">';
                dynamic_sidebar('header');
                echo '</div>';
            endif;
        ?>