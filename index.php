<?php
/**
 * index template default
 */
?>
<?php get_header(); ?>

<div class="container">
    <div class="main-banner row">
        <?php get_sidebar();?>
        <div class="col-lg-9 main-content">
            <?php
            if(is_active_sidebar('top_content')){
                echo '<div class="row">';
                dynamic_sidebar('top_content');
                echo '</div>';
            }
            ?>

            <div class="row">
                <?php do_action("rab_before_loop") ?>
                <?php

                    if(have_posts()):

                        while(have_posts()): the_post();

                            $format     = apply_filters("post_format_default",get_post_format() );
                            get_template_part( 'content', $format );

                        endwhile;
                        rab_pagination();

                    else :
                        get_template_part('template/none' );

                    endif;

                ?>
                <?php do_action("rab_after_loop") ?>

            </div>

        </div>

    </div>
</div> <!-- End main-content!-->

<?php get_footer();?>