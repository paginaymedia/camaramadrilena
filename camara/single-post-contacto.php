<?php
get_header();
?>
<style>
    #mapaoficinas{
        height: 500px
    }
    label{
        position: relative !important
    }
</style>
<article class="oficina">
    <div class="container">
        <div class="row">
            <h3 class="col s12 center">Contacta con nosotros</h3>

        </div>
        <div class="row valign-wrapper">
            <div class="col s12 m6 l6">
                <p>Envianos un mensaje y te contestaremos tan pronto como sea posible</p>

            </div>
            <div class="col s12 m6 l6">
                <form id="formulariocontacto" method="POST">
                    <div class="input-field">
                        <input placeholder="Nombre" class="validate" id="nombre" name="nombre" type="text" class="validate">                   
                    </div>
                    <div class="input-field">
                        <input placeholder="Email" class="validate" id="remiteEmail" name="remiteEmail" type="text" class="validate">                   
                    </div>
                    <div class="input-field">
                        <input placeholder="Teléfono" class="" id="telefono" name="telefono" type="text" class="validate">                   
                    </div>
                    <div class="input-field">
                        <input placeholder="Asunto" class="validate" id="asunto" name="asunto" type="text" class="validate">                   
                    </div>
                    <div class="input-field">
                        <input placeholder="Mensaje" class="validate" id="mensaje" name="mensaje" type="text" class="validate">                   
                    </div>
                                        <div class="input-field">
                        <label>
                            <input type="checkbox" id="tos"  class="filled-in" checked="" />
                            <span>He leido y acepto la <a href="http://www.camaramadrilena.org/politica-privacidad/">Policita de privacidad</a></span>
                        </label>           
                    </div>
                    <div class="botonenviarmail"><a class="btn waves-effect btn-large" onclick="enviarMail()">Enviar</a></div>

                    <input type="hidden" name="toEmail" value="info@camaramadrilena.org" /> 
                    <input type="hidden" name="gcaptcha" id="gcaptcha" value="" />

                </form>
            </div>
        </div>
    </div>
</article>
<div class="container">&nbsp;</div>
<div id="mapaoficinas"></div>
<?php 
function getInfoWindow($oficina, $showLink = false) {
    $html = '<h4><strong>' . $oficina->nombre . '</strong></h4>';
   
    $html .= '<br><i class="fas fa-phone-alt"></i> ' . $oficina->telefono . '</p>';
    $html .= '<p style="font-size:1.2rem"><i class="fas fa-at"></i> ' . $oficina->email . '</p>';
    $html .= '<p style="font-size:1.2rem">' . $oficina->direccion . ', ' . $oficina->cp . ', ' . $oficina->localidad . ' (' . $oficina->provincia . ')</p>';
    if ($showLink) {
        $html .= '<p style="font-size:1.2rem"><i class="fas fa-envelope"></i><strong> <a style="color:#ffab40" href="' . get_permalink($oficina->id) . '">Contactar </a></strong></p>';
    }
    return $html;
}

;

$_oficinas = get_posts(array('post_type' => 'oficinas', 'post_status' => 'publish', 'numberposts' => -1));

foreach ($_oficinas as $o) {

    $oficina = new stdclass;
    $oficina->id = $o->ID;
    $oficina->nombre = $o->post_title;
    $oficina->direccion = get_post_meta($o->ID, 'direccion', true);
    $oficina->responsable = get_post_meta($o->ID, 'responsable', true);
    $oficina->telefono = get_post_meta($o->ID, 'telefono', true);
    $oficina->email = get_post_meta($o->ID, 'email', true);
    $oficina->tipo = get_post_meta($o->ID, 'tipo', true);
    $oficina->cp = get_post_meta($o->ID, 'cp', true);
    $oficina->localidad = get_post_meta($o->ID, 'localidad', true);
    $oficina->provincia = get_post_meta($o->ID, 'provincia', true);
    $oficina->lat = get_post_meta($o->ID, 'lat', true);
    $oficina->lng = get_post_meta($o->ID, 'lng', true);
    if ($oficina->lat == '' || $oficina->lng == '')
        continue;
    $oficina->infowindow = getInfoWindow($oficina,true);

    $oficinas[] = $oficina;
}
?>

<script>
    var oficinas = <?php echo json_encode($oficinas); ?>;
    var style = [{"featureType":"administrative", "elementType":"all", "stylers":[{"saturation":"-100"}]}, {"featureType":"administrative.country", "elementType":"labels.text.fill", "stylers":[{"color":"#303030"}]}, {"featureType":"administrative.province", "elementType":"all", "stylers":[{"visibility":"off"}]}, {"featureType":"administrative.locality", "elementType":"geometry.fill", "stylers":[{"color":"#dcc3c3"}]}, {"featureType":"administrative.locality", "elementType":"labels.text.fill", "stylers":[{"color":"#303030"}]}, {"featureType":"administrative.locality", "elementType":"labels.text.stroke", "stylers":[{"color":"#ffffff"}]}, {"featureType":"administrative.neighborhood", "elementType":"labels.text.fill", "stylers":[{"visibility":"off"}, {"color":"#e7d6d6"}]}, {"featureType":"administrative.neighborhood", "elementType":"labels.text.stroke", "stylers":[{"color":"#5c5959"}]}, {"featureType":"administrative.land_parcel", "elementType":"geometry.stroke", "stylers":[{"color":"#4a1818"}, {"visibility":"off"}]}, {"featureType":"administrative.land_parcel", "elementType":"labels.text.fill", "stylers":[{"color":"#f2f2f2"}]}, {"featureType":"administrative.land_parcel", "elementType":"labels.text.stroke", "stylers":[{"color":"#e7e7e7"}]}, {"featureType":"landscape", "elementType":"all", "stylers":[{"saturation": - 100}, {"lightness":65}, {"visibility":"on"}]}, {"featureType":"poi", "elementType":"all", "stylers":[{"saturation": - 100}, {"lightness":"50"}, {"visibility":"simplified"}]}, {"featureType":"road", "elementType":"all", "stylers":[{"saturation":"-100"}]}, {"featureType":"road.highway", "elementType":"all", "stylers":[{"visibility":"simplified"}]}, {"featureType":"road.arterial", "elementType":"geometry.fill", "stylers":[{"color":"#999292"}]}, {"featureType":"road.arterial", "elementType":"labels.text.fill", "stylers":[{"color":"#323131"}]}, {"featureType":"road.arterial", "elementType":"labels.text.stroke", "stylers":[{"color":"#ffffff"}]}, {"featureType":"road.local", "elementType":"all", "stylers":[{"color":"#d9d2d2"}]}, {"featureType":"road.local", "elementType":"labels.text.fill", "stylers":[{"color":"#303030"}]}, {"featureType":"transit", "elementType":"all", "stylers":[{"saturation": - 100}, {"visibility":"simplified"}]}, {"featureType":"water", "elementType":"geometry", "stylers":[{"hue":"#ffff00"}, {"lightness": - 25}, {"saturation": - 97}]}, {"featureType":"water", "elementType":"labels", "stylers":[{"lightness": - 25}, {"saturation": - 100}]}]
    var map;
    function initMap() {
    var bounds = new google.maps.LatLngBounds();
    map = new google.maps.Map(document.getElementById('mapaoficinas'), {
    center: {lat: 40.41902212620495, lng: - 3.7216215501953087},
            zoom: 12,
            styles: style,
            streetViewControl: false,
            disableDefaultUI: true,
    });
    for (i = 0; i < oficinas.length; i++){
    var marker = new google.maps.Marker({
    position: {lat: parseFloat(oficinas[i].lat), lng: parseFloat(oficinas[1].lng)},
            map: map,
            icon: 'http://www.camaramadrilena.org/wp-content/themes/camara/assets/images/marker-oficina.png',
            html : oficinas[i].infowindow
    })
            var infowindow = new google.maps.InfoWindow({
            content: "Cargando"
            })
            marker.addListener('click', function(event){
            infowindow.setContent(this.html)
                    infowindow.open(map, this)
            })
            bounds.extend({lat: parseFloat(oficinas[i].lat), lng: parseFloat(oficinas[1].lng)});
    }
    map.fitBounds(bounds)

    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAJW0dIKZL3NDGEP06_sDEXA-pFwGIhDw&callback=initMap"  async defer></script>
<div class="container">
    <div class="row">
        <?php foreach ($oficinas as $oficina) {
            ?>
            <div class="col l3 m6 s12">
                <?php echo getInfoWindow($oficina,false); ?>
                <div class="card-action">
                    <div class="row linea-naranja">
                        <div class="col s6"><div class="linea">&nbsp;</div></div>
                        <div class="col s6 enlace"><a href="<?php echo get_permalink($oficina->id); ?>">&nbsp;Ver más</a></div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>


    </div>

</div>




<?php
get_footer();
wp_footer()
?>