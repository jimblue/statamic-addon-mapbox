<?php
return [
    'access_token' => env('MAPBOX_ACCESS_TOKEN', false),
    'style_options' => env('MAPBOX_STYLE_OPTIONS', [
        'Outdoors' => 'mapbox://styles/mapbox/outdoors-v11',
        'Dark' => 'mapbox://styles/mapbox/dark-v10',
        'Light' => 'mapbox://styles/mapbox/light-v10',
        'Streets' => 'mapbox://styles/mapbox/streets-v11',
        'Satellite' => 'mapbox://styles/mapbox/satellite-v9',
    ]),
    'default_bearing' => env('MAPBOX_DEFAULT_BEARING', 0),
    'default_center' => env('MAPBOX_DEFAULT_CENTER', '52.6318051, 1.296734'),
    'default_pitch' => env('MAPBOX_DEFAULT_PITCH', 0),
    'default_zoom_level' => env('MAPBOX_DEFAULT_ZOOM', 8),
    'default_min_zoom_level' => env('MAPBOX_DEFAULT_MIN_ZOOM', null),
    'default_max_zoom_level' => env('MAPBOX_DEFAULT_MAX_ZOOM', null),
];
