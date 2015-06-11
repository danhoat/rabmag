<?php

  /**
  * Template Name: Register Page Template
  */
?>

  <?php get_header();?>
    <div class="container main-wrap">
        <div class="main-content">
            <div id="main-content" class="col-sm-8 ">
                <div class="page-content row">
                   <?php
                    the_post();
                    echo '<h1 class="title page-title">'.get_the_title().'</h1>';
                    echo '<div class="post-detail">';
                    the_content();
                    echo '</div>';
                   ?>

                </div>
                <?php
                if( is_active_sidebar('sidebar-content') )
                    dynamic_sidebar('sidebar-content');
                ?>
            </div>
            <?php get_sidebar();?>
        </div>
    </div> <!-- End main-content!-->

   <?php get_footer();?>