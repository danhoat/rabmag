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
  	<div class="main-header container">
        <div class="main-content">
        <!-- Logo -->
            <div class="col-sm-3">
                <a href="<?php echo home_url();?>">
                <img class="logo" src="<?php echo get_logo_url();?>" alt="<?php echo  get_bloginfo('name');?>" title ="<?php echo  get_bloginfo('name');?>"></a>      	
                <br />
                <?php
                if(is_home() || is_front_page() ){ ?>
                <h1 class="title clearfix" style="margin:0;padding:0; position:relative; bottom:10px; font-size:18px; display:none;">
                    <?php echo  get_bloginfo('name');?>
                </h1>
            	<?php } else {?>
             	<h2 class="title clearfix" style="margin:0;padding:0; position:relative; bottom:10px; font-size:18px; display:none;">
                    <?php echo  get_bloginfo('name');?>
                </h2>

           		<?php }?>
            </div>
            <div class="header-ads-728 col-sm-9">
              <a href="#"><img src="<?php echo TEMPLATEURL ;?>/images/728.gif" alt="banner" height="90" width="728"></a>
            </div>
             <nav class="navbar clearfix">
                <div class="navbar-inner">
                    <?php wp_nav_menu(array( 'theme_location' => apply_filters( RAB_DOMAIN, 'header' ) ,'menu_class' => 'nav' ,'container_class' => 'navbar-inner' ));?>
                </div>
            </nav>

            </div>

  	</div>

    <?php
    if(is_active_sidebar('header')):
        echo '<div class="row">';
        dynamic_sidebar('header');
        echo '</div>';
    endif;
    ?>