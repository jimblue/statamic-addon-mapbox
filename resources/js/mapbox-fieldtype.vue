<template>
  <div>
    <div v-if="meta.access_token">
      <div class="map-container">
        <div id="map" ref="map"></div>
      </div>
    </div>
    <div class="p-3 bg-red-lighter rounded-md text-sm text-red" v-else>Please add your <strong>MAPBOX_ACCESS_TOKEN</strong> to <strong>.env</strong>.</div>
  </div>
</template>

<script>
import mapboxgl from 'mapbox-gl'
import MapboxGeocoder from '@mapbox/mapbox-gl-geocoder'
import MapboxMapSelector from './components/mapbox-map-selector'

export default {
  mixins: [Fieldtype],

  data() {
    return {
      data: this.value,
    }
  },

  watch: {
    data(value) {
      this.update(value)
    },
    value(value) {
      this.data = value
    },
  },

  created() {
    this.map = null
    this.styleOptions = JSON.parse(this.meta.style_options)
  },

  mounted() {
    this.mapInit()
    this.mapResize()
    this.mapEvents()
    this.mapControls()
  },

  methods: {
    mapInit() {
      mapboxgl.accessToken = this.meta.access_token

      this.map = new mapboxgl.Map({
        container: this.$refs.map,
        style: this.data.style,
        center: this.data.center,
        zoom: this.data.zoom_level,
        minZoom: this.data.min_zoom_level,
        maxZoom: this.data.max_zoom_level,
        bearing: this.data.bearing,
        pitch: this.data.pitch,
        attributionControl: false,
        scrollZoom: false,
        keyboard: false,
        marker: false,
        logoPosition: 'bottom-left',
      })
    },
    mapResize() {
      const tabs = document.querySelectorAll('.publish-tabs a')

      tabs.forEach(tab => tab.addEventListener('click', event => this.map.resize()))
    },
    mapEvents() {
      this.map.on('zoomend', () => (this.data.zoom_level = this.map.getZoom()))
      this.map.on('dragend', () => (this.data.center = this.map.getCenter()))
      this.map.on('rotateend', () => (this.data.bearing = this.map.getBearing()))
      this.map.on('pitchend', () => (this.data.pitch = this.map.getPitch()))
      if (typeof this.styleOptions === 'object') {
        this.map.on('styledata', () => (this.data.style = this.map.getStyle().sprite))
      }
    },
    mapControls() {
      this.addGeocoderControl()
      this.addNavigationControl()
      this.addGeolocateControl()
      this.addMapSelectorControl()
    },
    addGeocoderControl() {
      const geocoder = new MapboxGeocoder({
        accessToken: this.meta.access_token,
        mapboxgl: mapboxgl,
        trackProximity: false,
        marker: false,
      })

      this.map.addControl(geocoder, 'top-left')
    },
    addNavigationControl() {
      const navigation = new mapboxgl.NavigationControl({
        showCompass: true,
        showZoom: true,
        visualizePitch: true,
      })

      this.map.addControl(navigation, 'top-right')
    },
    addGeolocateControl() {
      const geolocate = new mapboxgl.GeolocateControl({
        positionOptions: {
          enableHighAccuracy: true,
        },
      })

      this.map.addControl(geolocate, 'top-right')
    },
    addMapSelectorControl() {
      if (typeof this.styleOptions !== 'object') return

      const mapSelector = new MapboxMapSelector(this.styleOptions)

      this.map.addControl(mapSelector, 'top-right')
    },
    createMarker() {
      const marker = new mapboxgl.Marker({
        draggable: true,
      })

      const center = e.result.center

      this.data.center = center
      this.data.marker = center

      marker.setLngLat(center)
      marker.addTo(this.map)

      marker.on('dragend', e => {
        this.data.marker = e.target._lngLat
      })
    },
  },
}
</script>
