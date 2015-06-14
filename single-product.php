<?php ob_start(); ?>
  <?php get_header();?>
    <div class="container main-wrap">
        <div class="main-content">
            <?php get_sidebar();?>
            <div id="main-content" class="col-sm-8 blog-main">
                <div class="single-content">
                    <?php
                    the_post();
                    echo '<h1 class="post-title title">'.get_the_title().'</h1>';
                    echo'<div class="post-headding">';
                    the_author().' &nbsp;  '.the_date();
                    comments_number( 'no comments', '%s comment', '% comments' );
                    echo '</div>';
                    echo '<div class="post-content ">';
                    if(has_post_thumbnail())
                        the_post_thumbnail();
                    the_content();
                    echo '</div>';
                    // echo '<div class="post-comment">';
                    //     comments_template();
                    // echo'</div>';
                    ?>

                </div>

            </div>


        </div>
    </div> <!-- End main-content!-->

   <?php get_footer();?>