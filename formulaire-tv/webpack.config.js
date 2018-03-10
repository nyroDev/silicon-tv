var Encore = require('@symfony/webpack-encore');
const webpack = require('webpack');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const copyWebpackPlugin = require('copy-webpack-plugin');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning()

    // uncomment to define the assets of the project
    .addEntry('js/main', './assets/main.js')
    .addStyleEntry('css/app', './assets/global.scss')

    .addEntry('js/screen', './assets/screen.js')
    .addStyleEntry('css/screen', './assets/screen.scss')

    // uncomment if you use Sass/SCSS files
    .enableSassLoader(function(sassOptions) {}, {
      resolveUrlLoader: false
    })

    .addPlugin(new copyWebpackPlugin([
      { from: './node_modules/tinymce/plugins', to: './plugins' },
      { from: './node_modules/tinymce/themes', to: './themes' },
      { from: './node_modules/tinymce/skins', to: './skins' },
    ]))

    // uncomment for legacy applications that require $/jQuery as a global variable
    // .autoProvidejQuery()
;

const config = Encore.getWebpackConfig();

if (Encore.isProduction()) {
  config.plugins = config.plugins.filter(plugin => !(plugin instanceof webpack.optimize.UglifyJsPlugin));
  config.plugins.push(new UglifyJsPlugin({
    exclude: /vendor/,
    parallel: true,
    uglifyOptions: {
      ie8: true,
      ecma: 6,
      warnings: false,
    },
    output: {
      ascii_only: true,
    },
  }));
}

module.exports = Encore.getWebpackConfig();
