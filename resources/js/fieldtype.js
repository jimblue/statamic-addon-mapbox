import MapboxFieldtype from './mapbox-fieldtype.vue'

Statamic.booting(() => {
  Statamic.$components.register('mapbox-fieldtype', MapboxFieldtype)
})
