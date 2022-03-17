<?php
$mainmenu = array(
    'menu' => 'principal',
    'container' => 'nav',
    'container_class' => 'collapse navbar-collapse',
    'container_id' => 'navbarResponsive',
    'menu_class' => 'navbar-nav ml-auto',
    'menu_id' => '',
    'echo' => true,
    'fallback_cb' => 'wp_page_menu',
    'before' => '',
    'after' => '',
    'link_before' => '',
    'link_after' => '',
    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
    'item_spacing' => 'preserve',
    'depth' => 0,
    'walker' => '',
    'theme_location' => '',
);
?>
<!-- creado por paginayMedia.com -->
<!DOCTYPE html>
<html lang="es"> 
    <head> 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="author" content="paginaymedia.com">
        <?php wp_head(); ?>  
    </head>
    <body>
        <header>
            <div class="franjasuperior">
                <div class="container">
                    <div class="row">
                        <div class="col s6">
                            <a href="https://private.tucomunidad.com/#/login" target="blank"><i class="fas fa-lock"></i> Acceder</a>
                        </div>
                        <div class="col s6 right-align">
                            <a href="mailto:info@camaramadrilena.org"><i class="far fa-envelope"></i> info@camaramadrilena.org </a>&nbsp;<a href="tel:+34914565205"><i class="fas fa-phone-alt"></i> 914 565 202</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="franjainferior">
                <div class="container">
                    <div class="row">
                        <div class="col s9 m9 l3 logocontainer"><a href="/"><img id="logo" src="<?php echo get_theme_file_uri(); ?>/assets/images/logo.png" /></a></div>
                        <div class="col s7 l6 menucontainer hide-on-med-and-down"><?php wp_nav_menu($mainmenu); ?> </div>
                        <div class="col l3 m9 hide-on-med-and-down"><div class="botonpresupuesto"><a class="btn waves-effect btn-large botonpresupuesto">Solicitar presupuesto</a></div></div>
                        <div class="col s3 m0 l0 hide-on-extra-large-only right-align"><a href="#" data-target="slide-out" class="sidenav-trigger"><i class="fas fa-bars"></i></a></div></div>
                </div>
            </div>
        </header>
