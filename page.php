<?php
/**
 * index template default
 */
?>
<?php get_header(); ?>

<div class="container main-page">

    <?php get_sidebar();?>
    <div class="col-lg-9 main-content">
        <div class="entry-page">
            <?php

            do_action("rab_before_loop");

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

        </div> <!-- .endtry end !-->

    </div>


</div> <!-- End main-content!-->

<?php get_footer();?>