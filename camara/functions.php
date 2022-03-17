<?php

//ponemos en cola los recursos
function recursos() {
    wp_enqueue_style("style", get_stylesheet_uri(),array(),"1.08");
    wp_enqueue_style("materialize", get_theme_file_uri() . '/assets/css/materialize.css');
    wp_enqueue_style("fa", get_theme_file_uri() . '/assets/css/fa.css');
    wp_enqueue_style("swal", get_theme_file_uri() . '/assets/css/swal.css');
    wp_enqueue_script("jQuery", get_theme_file_uri() . '/assets/js/jQuery.js', array(), "1", true);
    wp_enqueue_script("materialize", get_theme_file_uri() . '/assets/js/materialize.js', array(), "1", true);
    wp_enqueue_script("swal", get_theme_file_uri() . '/assets/js/swal.js', array(), "1", true);
    wp_enqueue_script("template", get_theme_file_uri() . '/assets/js/template.js', array(), "1.02", true);
}

add_action("wp_enqueue_scripts", "recursos");

//registramos los menus

register_nav_menu('menu-principal', 'Menu Principal');
register_nav_menu('menu-footer', 'Menu Footer');


//añadimos custom post

add_action('init', 'custom_post');

function custom_post() {
    $args = array(
        'public' => true,
        'label' => 'Oficinas',
        'menu_icon' => 'dashicons-location',
        'supports' => array('thumbnail', 'title', 'editor')
    );
    register_post_type('oficinas', $args);
    $args = array(
        'public' => true,
        'label' => 'Servicios',
        'menu_icon' => 'dashicons-hammer',
        'supports' => array('thumbnail', 'title', 'editor', 'order', 'page-attributes'),
        'show_in_rest' => true
    );
    register_post_type('servicios', $args);
    $args = array(
        'public' => true,
        'label' => 'Noticias',
        'menu_icon' => 'dashicons-book',
        'show_in_nav_menus' => true,
        'supports' => array('thumbnail', 'title', 'editor', 'order', 'page-attributes')
    );
    register_post_type('noticias', $args);
    register_taxonomy_for_object_type('category', 'page');
    $categories_labels = array(
        'label' => 'Noticias',
        'hierarchical' => true,
        'query_var' => true
    );
}

//añadirmos campos a servicios y oficinas
function registrar_metabox() {
    add_meta_box('intro-text', __('Introducción en el index', 'servicios'), 'display_servicios', 'servicios');
    add_meta_box('intro-text', __('Texto de introducción', 'servicios'), 'display_servicios', 'noticias');
    add_meta_box('slogan', __('Slogan', 'servicios'), 'display_servicios_slogan', 'servicios');
    add_meta_box('imagen-parallax', 'Imagen parallax', 'display_servicios_imagen_parallax', 'servicios');
    add_meta_box('imagen-parallax', 'Imagen parallax', 'display_servicios_imagen_parallax', 'page');
    add_meta_box('direccion', __('Datos oficina', 'oficinas'), 'display_oficinas', 'oficinas');
}

function display_servicios($post) {
    $introText = get_post_meta($post->ID, 'intro-text', true);
    echo '<input style="width:100%" type="text" value="' . $introText . '" name="intro-text" />';
}

function display_servicios_slogan($post) {
    $slogan = get_post_meta($post->ID, 'slogan', true);
    echo '<input style="width:100%" type="text" value="' . $slogan . '" name="slogan" />';
}

function display_servicios_imagen_parallax($post) {
    wp_enqueue_script('gallery-js', get_template_directory_uri() . '/assets/js/subirImagen.js', array('jquery'), null, true);
    $imagen = get_post_meta($post->ID, 'parallax', true);
    $image = 'Subir';
    $button = 'button';
    $image_size = 'full'; // it would be better to use thumbnail size here (150x150 or so)
    $display = 'none'; // display state of the "Remove image" button
    ?>

    <label>
        <div class="gallery-screenshot clearfix">
            <?php {
                $ids = explode(',', $value);
                foreach ($ids as $attachment_id) {
                    $img = wp_get_attachment_image_src($imagen, 500);
                    echo '<div  class="screen-thumb"><img style="height:150px" src="' . esc_url($img[0]) . '" /></div>';
                }
            }
            ?>
        </div>

        <input id="edit-gallery" class="button upload_gallery_button" type="button"
               value="<?php esc_html_e('Seleccionar Imagen', 'mytheme') ?>"/>
        <input id="clear-gallery" class="button upload_gallery_button" type="button"
               value="<?php esc_html_e('Borrar', 'mytheme') ?>"/>
        <input type="hidden" name="parallax" id="parallax-input" class="gallery_values" value="<?php echo $imagen; ?>">
    </label>
    <?php
}

function display_oficinas($post) {
    
    $telefono = get_post_meta($post->ID, 'telefono', true);
    $email = get_post_meta($post->ID, 'email', true);
    $direccion = get_post_meta($post->ID, 'direccion', true);
    $cp = get_post_meta($post->ID, 'cp', true);
    $localidad = get_post_meta($post->ID, 'localidad', true);
    $provincia = get_post_meta($post->ID, 'provincia', true);
    $tipo = get_post_meta($post->ID, 'tipo', true);
    $lat = get_post_meta($post->ID, 'lat', true);
    $lng = get_post_meta($post->ID, 'lng', true);
    echo '<div style="display:flex;justify-content:space-around">';
    echo '<div style="width:48%">';

    echo '<p class="form-field"><label for="tel">Teléfono:</label>';
    echo '<input id="tel" name="telefono" style="width:100%" type="text" value="' . $telefono . '"  /></p>';
    echo '<p class="form-field"><label for="tel">email:</label>';
    echo '<input id="email" name="email" style="width:100%" type="text" value="' . $email . '"  /></p>';
    echo '<label for="tipo">Tipo oficina:</label>';
    echo '<select id="tipo" style="width:100%" name="tipo">';
    echo '<option value="miembro" ';
    if ($tipo == 'miembro')
        echo 'selected';
    echo '>Miembro confederación Cámaras Propiedad</option>';
    echo '<option value="delegacion" ';
    if ($tipo == 'delegacion')
        echo 'selected';
    echo '>Delegación Cámara Madrileña</option>';
    echo '<option value="colaborador" ';
    if ($tipo == 'colaborador')
        echo 'selected';
    echo '>Colaboradores Cámara Madrileña</option>';
    echo '</select>';
    echo '</div>';
    echo '<div style="width:48%">';
    echo '<p class="form-field"><label for="direccion-input">Direcion:</label>';
    echo '<input id="direccion-input" name="direccion" style="width:100%" type="text" value="' . $direccion . '"  /></p>';
    echo '<p class="form-field"><label for="cp">Código Postal:</label>';
    echo '<input id="cp" name="cp" style="width:100%" type="text" value="' . $cp . '"  /></p>';
    echo '<p class="form-field"><label for="localidad">Localidad:</label>';
    echo '<input id="localidad" name="localidad" style="width:100%" type="text" value="' . $localidad . '"  /></p>';
    echo '<p class="form-field"><label for="provincia">Provincia:</label>';
    echo '<input id="provincia" name="provincia" style="width:100%" type="text" value="' . $provincia . '"  /></p>';
    echo '<input id="lat" name="lat" style="width:100%" type="hidden" value="' . $lat . '"  /></p>';
    echo '<input id="lng" name="lng" style="width:100%" type="hidden" value="' . $lng . '"  /></p>';
    echo '<input name="save" type="button" class="button button-primary button-large" onclick="geoPosicionar()" value="GeoPosicionar">';
    echo '</div>';
    echo '</div><div id="mapa"></div>';
    echo '<script src="/wp-content/themes/camara/assets/js/maps-backend.js?ver=1"></script>';
    echo '<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAJW0dIKZL3NDGEP06_sDEXA-pFwGIhDw"></script>';
}

function save_servicios_intro($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    // Comprobamos si el usuario actual no puede editar el post
    if (!current_user_can('edit_post'))
        return;
    // Guardamos...
    if (isset($_POST['intro-text']))
        update_post_meta($post_id, 'intro-text', $_POST['intro-text']);
    if (isset($_POST['parallax']))
        update_post_meta($post_id, 'parallax', $_POST['parallax']);
    if (isset($_POST['slogan']))
        update_post_meta($post_id, 'slogan', $_POST['slogan']);
}

function save_oficinas_data($post_id) {
    // Comprobamos si es auto guardado
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    // Comprobamos si el usuario actual no puede editar el post
    if (!current_user_can('edit_post'))
        return;
    // Guardamos...

    if (isset($_POST['telefono']))
        update_post_meta($post_id, 'telefono', $_POST['telefono']);
    if (isset($_POST['email']))
        update_post_meta($post_id, 'email', $_POST['email']);
    if (isset($_POST['direccion']))
        update_post_meta($post_id, 'direccion', $_POST['direccion']);
    if (isset($_POST['cp']))
        update_post_meta($post_id, 'cp', $_POST['cp']);
    if (isset($_POST['localidad']))
        update_post_meta($post_id, 'localidad', $_POST['localidad']);
    if (isset($_POST['provincia']))
        update_post_meta($post_id, 'provincia', $_POST['provincia']);
    if (isset($_POST['tipo']))
        update_post_meta($post_id, 'tipo', $_POST['tipo']);
    if (isset($_POST['lat']))
        update_post_meta($post_id, 'lat', $_POST['lat']);
    if (isset($_POST['lng']))
        update_post_meta($post_id, 'lng', $_POST['lng']);
}

add_action('add_meta_boxes', 'registrar_metabox');
add_action('save_post', 'save_servicios_intro');
add_action('save_post', 'save_oficinas_data');

//damos soporte para las imagenes destacadas
add_theme_support('post-thumbnails');

//registramos widgets
register_sidebar(array(
    'name' => 'servicios index',
    'description' => 'Muestra los servidios en la portada de la web'
));
register_sidebar(array(
    'name' => 'noticias index',
    'description' => 'Muestra las ultimas noticias en el index'
));
require_once(get_theme_file_path() . '/widgets/class-wp-widget-servicios.php');
require_once(get_theme_file_path() . '/widgets/class-wp-widget-noticias.php');
register_widget('WP_Widget_Servicios');
register_widget('WP_Widget_Noticias');

//funciones de configuracion del theme
function camara_customize_register($wp_customize) {
    $wp_customize->add_section('parallax-image', array("title" => "Imagen Parallax intro"));
    $wp_customize->add_section('franja1', array("title" => "Franja horizontal 1"));
    $wp_customize->add_setting('slogan_parallax', array(
        'default' => 'Slogan para el parallax'
    ));
    $wp_customize->add_setting('imagen_parallax', array(
        'default' => ''
    ));
    $wp_customize->add_setting('slogan_parallax2', array(
        'default' => ''
    ));
    $wp_customize->add_setting('imagenFront1', array(
        'default' => ''
    ));
    $wp_customize->add_setting('textoFront1', array(
        'default' => ''
    ));
    $wp_customize->add_setting('color_franja1', array(
        'default' => '#000000'
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'slogan_parallax', array(
        'label' => "Slogan Imagen Parallax",
        'section' => "parallax-image",
        'settings' => 'slogan_parallax'
    )));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'slogan_parallax2', array(
        'label' => "Slogan Imagen Parallax 2",
        'section' => "parallax-image",
        'settings' => 'slogan_parallax2'
    )));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'textoFront1', array(
        'label' => "Texto franja 1",
        'section' => "franja1",
        'settings' => 'textoFront1'
    )));
    $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'imagen_parallax', array(
        'label' => "Imagen",
        'section' => "parallax-image",
        'settings' => 'imagen_parallax',
        'width' => 1920,
        'height' => 650
    )));
    $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'imagenFront1', array(
        'label' => "Imagen Franja 1",
        'section' => "franja1",
        'settings' => 'imagenFront1',
        'width' => 800,
        'height' => 533
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'color_franja1',array(
        'label' => "Color fondo franja 1",
        'section' => "franja1",
        'setting' =>'color_franja1',
       
    )));
}

add_action('customize_register', 'camara_customize_register');


