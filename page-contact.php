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
                <?php
                do_action("rab_before_loop");

                if(have_posts()):
                    echo '<h2>'.get_the_title().'</h2>';
                    the_post();
                    the_content();
                    ?>
                    <div class="post-detail row">
                        <?php get_template_part('template/contact-form');?>
                    </div>
                <?php
                else :
                    get_template_part('template/none' );

                endif;

                ?>
                <?php do_action("rab_after_loop") ?>

            </div> <!-- .endtry end !-->

        </div>
    </div><!-- .row !-->


</div> <!-- End main-content!-->

<?php get_footer();?>

