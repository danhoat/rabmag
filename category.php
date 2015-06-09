<?php get_header();?>

    <div class="container main-wrap">
        <div class="main-content">
            <div id="main-content" class="col-sm-8 blog-main">
                <div class="list-item">
                    <?php
                    if(have_posts()){
                        while(have_posts()): the_post();
                            get_template_part('template/item','search');
                        endwhile;
                    }
                    ?>

                </div>
                <div class="row row-paging">
                    <?php echo rab_paging();?>
                </div>

            </div>
            <?php get_sidebar();?>

        </div>
    </div> <!-- End main-content!-->

   <?php get_footer();?>