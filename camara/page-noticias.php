<?php
get_header();


$noticias = get_posts(array('post_type' => 'noticias', 'post_status' => 'publish', 'numberposts' => -1));


?>
<div class="center"><h1>Noticias</h1></div>
<div class="container">
    <div class="row">
        <?php
        $i = 1;
        foreach ($noticias as $noticia) {

            $s = get_post($noticia);
            $image = get_the_post_thumbnail_url($s, 'medium');
            $introText = get_post_meta($s->ID, 'intro-text', true);
            $output .= '<div class="col s12 m6 l3">
                <div class="card card-servicio">
                    <div class = "card-image">
                        <img src = "' . $image . '">
                    </div>
                    <div class="card-title">' . $s->post_title . '</div>
                    <div class="card-content">
                        <div class="servicio-desc">' . $introText . '</div>
                    </div>
                    <div class="card-action">
                        <div class="row linea-naranja">
                            <div class="col s6"><div class="linea">&nbsp;</div></div>
                            <div class="col s6 enlace"><a href="' . get_permalink($noticia->ID) . '">&nbsp;Ver más</a></div>
                        </div>
                    </div>
                 </div>
                 </div>';
        }
        echo $output;
        ?>
    </div>
    <?php
    get_footer();
    wp_footer()
    ?>