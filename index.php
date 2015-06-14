<?php
/**
 * index template default
 */
//$link = get_post_type_archive_link('product');

?>
<?php get_header(); ?>
<div class="row full-row">
    <div class="container main-page">
        <div class="row">
        <?php
            if(is_active_sidebar('top_content')){
                echo '<div class="col-lg-12 top-sidebar">';
                    dynamic_sidebar('top_content');
                echo '</div>';
            }
        ?>

        <?php get_sidebar();?>
            <div class="col-lg-9 main-content">
                <div class="entry-page">
                    <?php

                    do_action("rab_before_loop");
                    query_posts( 'post_type=product&posts_per_page=9' );
                    if(have_posts()):
                        $i = 0;
                        $class ='col-md-4 ';
                        echo '<h3 class ="title">Sản phẩm</h3>';
                        while(have_posts()): the_post();
                            if( $i%3 == 2)
                                $class ="col-md-4 col-right-product";
                            else if($i%3 == 1)
                                $class = "col-md-4 col-center-product";
                            else
                                $class ='col-md-4 col-left-product';

                            $format     = apply_filters("post_format_default",get_post_format() );
                            get_template_part( 'content', $format );
                            $i ++;
                        endwhile;
                       // rab_pagination();

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