<?php
/**
 * index template default
 */
//$link = get_post_type_archive_link('product');

?>
<?php get_header(); ?>
<?php
    global $number_column, $col_bootrap, $content_class;

?>
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

            <?php  ra_sidebar();?>
            <div class="<?php echo $content_class;?> main-content">
               
                    <?php
                    do_action("rab_before_loop");
                    query_posts( 'post_type=product&posts_per_page=9' );
                    if(have_posts()):
                        $i = 0;

                        echo '<h3 class ="title">'.__('Products', RAB_DOMAIN).'</h3>';
                        while(have_posts()): the_post();

                            if( $i % $number_column == 0)
                                $class =$col_bootrap." col-left-product";

                            else if($i % $number_column == $number_column -1)
                                $class = $col_bootrap."col-right-product";

                            else
                                $class =$col_bootrap.'col-center-product';

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

    

            </div> <!-- end . col-lg-9 !-->
        </div> <!--end .row !-->
        <?php get_template_part('template/block-partner' ); ?>

    </div> <!-- End main-content!-->
</div> <!-- full row !-->

<?php get_footer();?>