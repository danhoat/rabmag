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
	            <?php
	            echo '<h1 class ="title">'.__('Our products',RAB_DOMAIN).'</h3>';

	            do_action("rab_before_loop");

	            echo '<div class="row">';

	                    if(have_posts()):
	                        $i = 0;
	                        $class ='col-md-3 ';

	                        while(have_posts()): the_post();
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
	        </div> <!-- .main-content end !-->
	    </div> <!-- end . col-lg-9 !-->

    </div> <!-- End main-content!-->
</div> <!-- full row !-->

<?php get_footer();?>