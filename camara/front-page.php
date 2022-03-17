<?php
get_header();
wp_enqueue_script("slick", get_theme_file_uri() . '/assets/js/slick.js', array(), "1", true);
wp_enqueue_style("slick", get_theme_file_uri() . '/assets/css/slick.css');
?>
<div class="parallax-container">
    <div class="container">
        <div class="row">
            <div class="col s12 m6 l5 slogan"><?php echo get_theme_mod('slogan_parallax'); ?></div>
        </div>
    </div>
    <div class="parallax"><img src="<?php echo wp_get_attachment_url(get_theme_mod('imagen_parallax')); ?>" /></div>
</div>
<div class="container">
    <div class="row">
        <div class="col s12 slogan2"><h3><?php echo get_theme_mod('slogan_parallax2'); ?></h3></div>
    </div>
</div>

<?php
dynamic_sidebar('servicios index');
$colorFranja1 = get_theme_mod('color_franja1');
$imagenFranja1 = get_theme_mod('imagenFront1');
$textoFranja1 = get_theme_mod('textoFront1');
?>

<div class="franja1 franja" style="background:<?php echo $colorFranja1;?>">
    <div class="container">
        <div class="row flex">
            <div class="col s12 m12 l6">
                <img src="<?php echo wp_get_attachment_image_url($imagenFranja1,600); ?>" />
            </div>
            <div class="col s12 m12 l6 valign-wrapper">
                <h4><?php echo $textoFranja1; ?></h4>
            </div>
        </div>
    </div>
</div>
<?php 
dynamic_sidebar('noticias index');
?>
<?php
get_footer();
?>