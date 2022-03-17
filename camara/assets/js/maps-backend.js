function geoPosicionar() {
    var direccion = jQuery('#direccion-input').val();
    var cp = jQuery('#cp').val();
    var localidad = jQuery('#localidad').val();
    var direccionString = direccion + ',' + cp + ',' + localidad;
    jQuery.getJSON({
        url: 'https://maps.googleapis.com/maps/api/geocode/json',
        data: {
            sensor: false,
            address: direccionString,
            key: 'AIzaSyAAJW0dIKZL3NDGEP06_sDEXA-pFwGIhDw'
        },
        success: function (data, status) {
            if (status == 'success') {
                jQuery('#lat').val(data.results[0].geometry.location.lat)
                jQuery('#lng').val(data.results[0].geometry.location.lng)
            }
            initMap()
        }
    });
}
function initMap() {
    var _lat = parseFloat(jQuery('#lat').val());
    var _lng = parseFloat(jQuery('#lng').val());
    if (lat == '')
        return;
    if (lng == '')
        return;
    jQuery('#mapa').css('width', '100%');
    jQuery('#mapa').css('height', '400px');
    var map = new google.maps.Map(document.getElementById('mapa'),
            {center: {lat: _lat, lng: _lng},
                zoom: 16
            })
    var marker = new google.maps.Marker({
        position: {lat: _lat, lng: _lng},
        map: map,
        draggable: true,

    });
    google.maps.event.addListener(marker,'drag',function(event){
        jQuery('#lat').val(event.latLng.lat())
        jQuery('#lng').val(event.latLng.lng())
    })

}

jQuery(document).ready(function(){
    initMap()
})