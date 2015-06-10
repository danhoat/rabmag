    <footer class="footer-site">
        <div class="container">
            <div class="row footer-top">
                <div class="col-md-6">
                    <div class="entry-footer-widget">
                        <aside class="widget widget_black_studio_tinymce" id="black-studio-tinymce-2">
                            <?php $text = get_option('rab_coppyright_text',true); ?>
                            <div class="entry-post">
                                <div class="textwidget">
                                    <p style="text-align: justify;"><?php echo $text;?></p>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
                <?php
                    if(is_active_sidebar('footer')){
                        dynamic_sidebar('footer');
                    }
                ?>
            </div>
            <!-- footer-top -->
        </div>
        <?php wp_footer();?>
    </footer>
  </body>
</html>
