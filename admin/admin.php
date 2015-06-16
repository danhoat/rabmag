<?php 
//require get_template_directory() . '/admin/functions.php';

require get_template_directory() . '/admin/functions.php';
require get_template_directory() . '/admin/settings.php';
require get_template_directory() . '/admin/comments.php';
require get_template_directory() . '/admin/socials.php';
//require get_template_directory() . '/admin/slider.php';
//require get_template_directory() . '/admin/languages.php';

// init all js,style, global value for Rab Mag backend.
new RM_BackEnd();
//new RAB_Option();
?>