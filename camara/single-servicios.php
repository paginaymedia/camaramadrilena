<?php
get_header();
$imagenId = get_post_meta($post->ID, 'parallax', true);
$slogan = get_post_meta($post->ID, 'slogan', true);

$imgsrc = wp_get_attachment_image_src($imagenId, 'full');
?>
<article>
    <div class="container">
        <h1 class="serviciotitle slogan"><?php the_title(); ?></h1>
    </div>
    <div id="imagenintro">   
        <img class="parallax" alt="<?php the_title(); ?>" src="<?php echo $imgsrc[0]; ?>" />
    </div>
    <div class="container">
        <?php the_post(); ?>
        <div class="row">
            <div class="col s12">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</article>
<?php
get_footer();
wp_footer()
?>
