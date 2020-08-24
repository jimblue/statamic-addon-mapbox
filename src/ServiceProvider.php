<?php

namespace Jimblue\Mapbox;

use Statamic\Providers\AddonServiceProvider;
use Jimblue\Mapbox\FieldTypes\MapboxFieldtype;
use Jimblue\Mapbox\Tags\MapboxTag;

class ServiceProvider extends AddonServiceProvider
{
    protected $tags = [
        MapboxTag::class,
    ];

    protected $fieldtypes = [
        MapboxFieldtype::class,
    ];

    protected $scripts = [
        __DIR__ . '/../public/js/statamic-mapbox.js',
    ];

    protected $stylesheets = [
        __DIR__ . '/../public/css/statamic-mapbox.css',
    ];

    public function boot()
    {
        parent::boot();

        $this->bootAddonConfig();
    }

    protected function bootAddonConfig()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/mapbox.php', 'mapbox');

        $this->publishes([
            __DIR__.'/../config/mapbox.php' => config_path('statamic/mapbox.php'),
        ], 'mapbox');

        return $this;
    }
}
