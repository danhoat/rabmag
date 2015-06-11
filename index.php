<?php
/**
 * index template default
 */
?>
<?php get_header(); ?>
<div class="row full-row">
    <div class="container main-page">
        <div class="row">
            <?php get_sidebar();?>
            <div class="col-lg-9 main-content">
                <div class="entry-page">
                    <?php
                    if(is_active_sidebar('top_content')){
                        echo '<div class="row">';
                        dynamic_sidebar('top_content');
                        echo '</div>';
                    }
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

            </div> <!-- end . col-lg-9 !-->
        </div> <!--end .row !-->
        <?php get_template_part('template/block-partner' ); ?>

    </div> <!-- End main-content!-->
</div> <!-- full row !-->

<?php get_footer();?>