<?php get_header(); ?>

<div class="container main-page">
    <div class="row">
        <?php get_sidebar();?>
        <div class="col-lg-9 main-content">
            <div class="entry-page">

                <?php

                if(have_posts()):
                    echo '<h1 class="title">'.get_the_title().'</h2>';
                    the_post();
                    get_template_part('template/product-image');
                    echo '<div class="content">';
                    the_content();
                    echo '</div>';
                else :
                    get_template_part('template/none' );

                endif;

                ?>

            </div> <!-- .endtry end !-->

        </div>
    </div> <!-- .row !-->

</div> <!-- End main-content!-->

<?php get_footer();?>