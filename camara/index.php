<?php
/*
  Theme Name: Camara
  Theme URI: https://paginaymedia.es

 */
get_header();
if (have_posts()):
    while (have_posts()):
        the_title() ;
        the_post();
    endwhile;

endif;

get_footer();
wp_footer() ?>



