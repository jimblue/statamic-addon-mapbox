const mix = require('laravel-mix')
const webpack = require('webpack')

require('laravel-mix-clean')

mix.setPublicPath('public')
mix.options({
  terser: {
    extractComments: false,
    terserOptions: {
      compress: {
        drop_debugger: true,
        drop_console: true,
        dead_code: true,
      },
    },
  },
})
mix.webpackConfig({
  plugins: [
    new webpack.optimize.LimitChunkCountPlugin({
      maxChunks: 1,
    }),
  ],
  optimization: {
    runtimeChunk: false,
    splitChunks: {
      cacheGroups: {
        default: false,
      },
    },
  },
})
mix.js('resources/js/fieldtype.js', 'public/js/statamic-mapbox.js')
mix.sass('resources/scss/fieldtype.scss', 'public/css/statamic-mapbox.css')
mix.clean()
