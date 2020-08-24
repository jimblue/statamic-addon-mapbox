<?php

namespace Jimblue\Mapbox\Tags;

use Statamic\Tags\Tags;

class MapboxTag extends Tags
{
    protected static $handle = 'mapbox';

    /**
     * Top level tag - render a map
     *
     * @return string
     */
    public function template()
    {
        if (!$data = $this->getData()) return;

        return view('mapbox::map', $data);
    }

    /**
     * Return the components of the map as "parts"
     *
     * @return string
     */
    public function parts()
    {
        if (!$data = $this->getData()) return;

        $parsedData = $this->parse([
            'access_token' => $data['access_token'],
            'style' => $data['style'],
            'center' => $data['center'],
            'zoom_level' => $data['zoom_level'],
            'min_zoom_level' => $data['min_zoom_level'],
            'max_zoom_level' => $data['max_zoom_level'],
            'bearing' => $data['bearing'],
            'pitch' => $data['pitch'],
            'marker' => $data['marker'],
        ]);

        return $parsedData;
    }

    /**
     * Return a dump of all the data in the field
     *
     * @return string
     */
    public function json()
    {
        if (!$data = $this->getData()) return;

        return json_encode($data);
    }

    private function getData()
    {
        $data = $this->context->value('mapbox');

        $access_token = config('mapbox.access_token');
        $style = $data['style'];
        $center = $data['center'];
        $zoom_level = $data['zoom_level'];
        $min_zoom_level = $data['min_zoom_level'];
        $max_zoom_level = $data['max_zoom_level'];
        $bearing = $data['bearing'];
        $pitch = $data['pitch'];
        $marker = $data['marker'];

        return compact(
            'access_token',
            'style',
            'center',
            'zoom_level',
            'min_zoom_level',
            'max_zoom_level',
            'bearing',
            'pitch',
            'marker',
        );
    }
}
