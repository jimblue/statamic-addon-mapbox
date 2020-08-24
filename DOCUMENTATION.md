## Installation

1. Install Mapbox from the `Tools > Addons` section of your control panel, or via composer:

    ```
    composer require jimblue/mapbox
    ```

## Usage

To enable Mapbox you need to add your Mapbox access token your `.env`
If you don't already have one, you can sign up for [Mapbox](https://account.mapbox.com/auth/signup/), it's free!

```bash
MAPBOX_ACCESS_TOKEN="your_mapbox_access_token"
```

You can also define your own map style by editing Mapbox default config.
