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
                    echo '<div class="post-comment">';
                        comments_template();
                    echo'</div>';
                    ?>

                </div>
                <div class="full-width">
                    <?php
                    query_posts('post_type=post&post_status=publish&posts_per_page=8');
                    if(have_posts()):
                        echo '<h2>'.__('Related Post', RAB_DOMAIN).'</h2>';
                        echo '<ul class="list-unstyled">';
                        while(have_posts()): the_post();
                            echo '<li><h5><a href="'.get_the_title().'"> '.get_the_title().'</a></h5></li>';
                        endwhile;
                        echo '</ul>';
                    endif;
                    ?>

                </div>

            </div>


        </div>
    </div> <!-- End main-content!-->

   <?php get_footer();?>