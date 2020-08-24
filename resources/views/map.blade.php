<script src='https://api.mapbox.com/mapbox-gl-js/v1.10.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v1.10.1/mapbox-gl.css' rel='stylesheet' />
<div id='map' style='width: 100%; height: 400px;'></div>
<script>
mapboxgl.accessToken ='{{ $access_token }}';
var map = new mapboxgl.Map({
    container: 'map',
    style: '{{ $style }}',
    center: @json($center),
    zoom: {{ $zoom_level }},
    minZoom: {{ $min_zoom_level }},
    maxZoom: {{ $max_zoom_level }},
    bearing: {{ $bearing }},
    pitch: {{ $pitch }},
    marker: @json($marker),
});
</script>
