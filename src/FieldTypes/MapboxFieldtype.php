<?php

namespace Jimblue\Mapbox\FieldTypes;

use Statamic\Fields\Fieldtype;

class MapboxFieldtype extends Fieldtype
{
    protected $icon = 'earth';

    public function __construct()
    {
        $this->access_token = config('mapbox.access_token');
        $this->style_options = config('mapbox.style_options');
        $this->default_style = $this->getDefaultStyle($this->style_options);
        $this->default_bearing = config('mapbox.default_bearing');
        $this->default_center = $this->formatCoordinates(config('mapbox.default_center'));
        $this->default_pitch = config('mapbox.default_pitch');
        $this->default_zoom_level = config('mapbox.default_zoom_level');
        $this->default_min_zoom_level = config('mapbox.default_min_zoom_level');
        $this->default_max_zoom_level = config('mapbox.default_max_zoom_level');
    }

    public function preload()
    {
        return [
            'access_token' => $this->access_token,
            'style_options' => json_encode($this->style_options),
        ];
    }

    /**
     * The blank/default value
     *
     * @return array
     */
    public function defaultValue()
    {
        return $this->formatData();
    }

    /**
     * Pre-process the data before it gets sent to the publish page
     *
     * @param mixed $data
     * @return array|mixed
     */
    public function preProcess($data)
    {
        $data = $this->formatData($data);

        return $data;
    }

    /**
     * Process the data before it gets saved
     *
     * @param mixed $data
     * @return array|mixed
     */
    public function process($data)
    {
        return $data;
    }

    private function getDefaultStyle($styleOptions)
    {
        if (is_array($styleOptions)) {
            return array_shift($styleOptions);
        }

        return $styleOptions;
    }

    private function formatData(array $data = [])
    {
        $data['style'] = array_get($data, 'style', $this->default_style);
        $data['bearing'] = array_get($data, 'bearing', $this->default_bearing);
        $data['center'] = array_get($data, 'center', $this->default_center);
        $data['pitch'] = array_get($data, 'pitch', $this->default_pitch);
        $data['zoom_level'] = array_get($data, 'zoom_level', $this->default_zoom_level);
        $data['min_zoom_level'] = array_get($data, 'min_zoom_level', $this->default_min_zoom_level);
        $data['max_zoom_level'] = array_get($data, 'max_zoom_level', $this->default_max_zoom_level);
        $data['marker'] = array_get($data, 'marker', []);

        return $data;
    }

    private function formatCoordinates(String $coordinates)
    {
        $coordinates = explode(',', $coordinates);

        return ['lat' => (float) $coordinates[0], 'lng' => (float) $coordinates[1]];
    }
}
