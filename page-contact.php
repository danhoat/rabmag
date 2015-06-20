<?php

  /**
  * Template Name: Contact Page Template
  */
?>

<?php get_header(); ?>

<div class="container main-page">
    <div class="row">
        <?php get_sidebar();?>
        <div class="col-lg-9 main-content">
            <div class="entry-page">
                <div class="content">
                <?php


                    if(have_posts()):
                        echo '<h1 class="title">'.get_the_title().'</h1>';
                        the_post();
                        $content = get_the_content();
                        if( empty($content) ){
                            $text = get_option('rab_coppyright_text',true); ?>
                            <p style="text-align: justify;"><?php echo stripslashes($text);?></p>
                        <?php  } else{ the_content();} ?>

                        <div class="post-detail row">
                            <?php get_template_part('template/contact-form');?>
                        </div>
                    <?php
                    else :
                        get_template_part('template/none' );

                    endif;

                    ?>
                    <?php do_action("rab_after_loop") ?>
                </div> <!-- .content !-->

            </div> <!-- .endtry end !-->

        </div>
    </div><!-- .row !-->


</div> <!-- End main-content!-->

<?php get_footer();?>

