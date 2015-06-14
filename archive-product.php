<?php
/**
 * index template default
 */
//$link = get_post_type_archive_link('product');

?>
<?php get_header(); ?>
<div class="row full-row">
    <div class="container main-page">


            <div class=" main-content">
                <div class="entry-page1">
                    <?php
                    echo '<h3 class ="main-title widget-title">Sản phẩm</h3>';
                    do_action("rab_before_loop");
                    echo '<div class="row">';
		                    if(have_posts()):
		                        $i = 0;
		                        $class ='col-md-3 ';
		                        
		                        while(have_posts()): the_post();
		                            // if( $i%4 == 3)
		                            //     $class ="col-md-3 col-right-product";
		                            // else if($i%4 == 2 || $i%3 == 1)
		                            //     $class = "col-md-3 col-center-product";
		                            // else
		                            //     $class ='col-md-3 col-left-product';

		                            $format     = apply_filters("post_format_default",get_post_format() );
		                            get_template_part( 'content', $format );
		                            $i ++;
		                        endwhile;
		                        rab_pagination();

		                    else :
		                        get_template_part('template/none' );

		                    endif;

		                    ?>
		                    <?php do_action("rab_after_loop") ?>
					</div>
                </div> <!-- .endtry end !-->

            </div> <!-- end . col-lg-9 !-->

        <?php get_template_part('template/block-partner' ); ?>

    </div> <!-- End main-content!-->
</div> <!-- full row !-->

<?php get_footer();?>