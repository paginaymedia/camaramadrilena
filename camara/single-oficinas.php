<?php
get_header();
$oficina = new stdclass;
$oficina->id = get_the_ID();
$oficina->nombre = get_the_title();
$oficina->direccion = get_post_meta($oficina->id, 'direccion', true);
$oficina->telefono = get_post_meta($oficina->id, 'telefono', true);
$oficina->email = get_post_meta($oficina->id, 'email', true);
$oficina->tipo = get_post_meta($oficina->id, 'tipo', true);
$oficina->cp = get_post_meta($oficina->id, 'cp', true);
$oficina->localidad = get_post_meta($oficina->id, 'localidad', true);
$oficina->provincia = get_post_meta($oficina->id, 'provincia', true);
$oficina->lat = get_post_meta($oficina->id, 'lat', true);
$oficina->lng = get_post_meta($oficina->id, 'lng', true);
?>
<style>
    #mapaoficina{
        height: 500px
    }
</style>
<article class="oficina">
    <div class="container">
        <div class="row">
            <h1 class="col s12 center">Oficina <?php echo $oficina->nombre; ?></h1>

        </div>
        <div class="row">
            <div class="col s12 m6 l6">
                Teléfono: <?php echo $oficina->telefono; ?><br><?php echo $oficina->email; ?></p>
                <p><?php echo $oficina->direccion . ', ' . $oficina->cp; ?><br><?php echo $oficina->localidad; ?></p>
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
                    <div class="botonpresupuesto"><a class="btn waves-effect btn-large" onclick="enviarMail()">Enviar</a></div>
                    <input type="hidden" name="toEmail" value="<?php echo $oficina->email; ?>" /> 
                    <input type="hidden" name="gcaptcha" id="gcaptcha" value="" />
                    
                </form>
            </div>
        </div>
    </div>
</article>
<div id="mapaoficina"></div>

<script src="https://www.google.com/recaptcha/api.js?render=6LcOZOgUAAAAAIGy9FIRjJRW3m4iOA5OtrNw3lkO"></script>
<script>
                        function initMap() {
                            var style = [{"featureType": "administrative", "elementType": "all", "stylers": [{"saturation": "-100"}]}, {"featureType": "administrative.country", "elementType": "labels.text.fill", "stylers": [{"color": "#303030"}]}, {"featureType": "administrative.province", "elementType": "all", "stylers": [{"visibility": "off"}]}, {"featureType": "administrative.locality", "elementType": "geometry.fill", "stylers": [{"color": "#dcc3c3"}]}, {"featureType": "administrative.locality", "elementType": "labels.text.fill", "stylers": [{"color": "#303030"}]}, {"featureType": "administrative.locality", "elementType": "labels.text.stroke", "stylers": [{"color": "#ffffff"}]}, {"featureType": "administrative.neighborhood", "elementType": "labels.text.fill", "stylers": [{"visibility": "off"}, {"color": "#e7d6d6"}]}, {"featureType": "administrative.neighborhood", "elementType": "labels.text.stroke", "stylers": [{"color": "#5c5959"}]}, {"featureType": "administrative.land_parcel", "elementType": "geometry.stroke", "stylers": [{"color": "#4a1818"}, {"visibility": "off"}]}, {"featureType": "administrative.land_parcel", "elementType": "labels.text.fill", "stylers": [{"color": "#f2f2f2"}]}, {"featureType": "administrative.land_parcel", "elementType": "labels.text.stroke", "stylers": [{"color": "#e7e7e7"}]}, {"featureType": "landscape", "elementType": "all", "stylers": [{"saturation": -100}, {"lightness": 65}, {"visibility": "on"}]}, {"featureType": "poi", "elementType": "all", "stylers": [{"saturation": -100}, {"lightness": "50"}, {"visibility": "simplified"}]}, {"featureType": "road", "elementType": "all", "stylers": [{"saturation": "-100"}]}, {"featureType": "road.highway", "elementType": "all", "stylers": [{"visibility": "simplified"}]}, {"featureType": "road.arterial", "elementType": "geometry.fill", "stylers": [{"color": "#999292"}]}, {"featureType": "road.arterial", "elementType": "labels.text.fill", "stylers": [{"color": "#323131"}]}, {"featureType": "road.arterial", "elementType": "labels.text.stroke", "stylers": [{"color": "#ffffff"}]}, {"featureType": "road.local", "elementType": "all", "stylers": [{"color": "#d9d2d2"}]}, {"featureType": "road.local", "elementType": "labels.text.fill", "stylers": [{"color": "#303030"}]}, {"featureType": "transit", "elementType": "all", "stylers": [{"saturation": -100}, {"visibility": "simplified"}]}, {"featureType": "water", "elementType": "geometry", "stylers": [{"hue": "#ffff00"}, {"lightness": -25}, {"saturation": -97}]}, {"featureType": "water", "elementType": "labels", "stylers": [{"lightness": -25}, {"saturation": -100}]}]
                            var map = new google.maps.Map(document.getElementById('mapaoficina'), {
                                center: {lat: <?php echo $oficina->lat; ?>, lng: <?php echo $oficina->lng; ?>},
                                zoom: 15,
                                styles: style,
                                streetViewControl: false,
                                disableDefaultUI: true,
                            });
                            var marker = new google.maps.Marker({
                                position: {lat: parseFloat(<?php echo $oficina->lat; ?>), lng: parseFloat(<?php echo $oficina->lng; ?>)},
                                map: map,
                                icon: 'http://www.camaramadrilena.org/wp-content/themes/camara/assets/images/marker-oficina.png',
                            })
                        }
                        function enviarMail() {
                            if (validar()) {
                                jQuery.ajax({
                                    method: 'POST',
                                    cache: 'false',
                                    url: '/wp-content/themes/camara/mailer.php',
                                    data: {
                                        form: jQuery('#formulariocontacto').serialize()
                                    },
                                    success: function (json) {
                                        swal.fire(json.title,json.message,json.status);
                                    }
                                })
                            }
                        }
                        function ValidateEmail(mail)
                        {
                            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
                            {
                                return (true)
                            }
                            
                            return (false)
                        }
                        function validar() {
                            var valid = true;
                            jQuery('.validate').each(function () {
                                if (jQuery(this).val() == '') {
                                    valid = false;
                                    jQuery(this).addClass('invalid')
                                } else
                                {
                                    jQuery(this).removeClass('invalid')
                                }
                            })
                            if (ValidateEmail(jQuery('#remiteEmail').val()) == false) {
                                jQuery('#email').addClass('invalid');
                                valid = false;
                            } else
                            {
                                jQuery('#email').removeClass('invalid');
                            }
                            return valid;
                        }
                        grecaptcha.ready(function () {
                            grecaptcha.execute('6LcOZOgUAAAAAIGy9FIRjJRW3m4iOA5OtrNw3lkO', {action: 'homepage'}).then(function (token) {
                                jQuery('#gcaptcha').val(token)
                            });
                        });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAJW0dIKZL3NDGEP06_sDEXA-pFwGIhDw&callback=initMap"  async defer></script>
<?php
get_footer();
wp_footer()
?>