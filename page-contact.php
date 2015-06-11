<?php

  /**
  * Template Name: Register Page Template
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
                echo '<h2>'.get_the_title().'</h2>';
                the_post();
                the_content(); 
                ?>
                <div class="post-detail row">
                    <form role="form">
                        <div class="form-group">
                            <div class="col-xs-2">
                                <label for="email">Ho ten:</label>
                            </div>
                            <div class="col-xs-9">
                                <input type="email" class="form-control" id="email">
                            </div>
                        </div>
                         <div class="form-group">
                            <div class="col-xs-2">
                                <label for="email">Dia chi:</label>
                            </div>
                            <div class="col-xs-9">
                                <input type="email" class="form-control" id="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-2">
                                <label for="pwd">Email :</label>
                            </div>
                            <div class="col-xs-9">
                                <input type="password" class="form-control" id="pwd">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-2">
                                <label for="pwd">Nội dung</label>
                            </div>
                            <div class="col-xs-9">
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-9">
                            </div>
                            <div class="col-xs-2">
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            <?php
            else :
                get_template_part('template/none' );

            endif;

            ?>
            <?php do_action("rab_after_loop") ?>

        </div> <!-- .endtry end !-->

    </div>


</div> <!-- End main-content!-->

<?php get_footer();?>



                    
