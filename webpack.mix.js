const mix = require('laravel-mix');

const VuetifyLoaderPlugin = require('vuetify-loader/lib/plugin')
const CaseSensitivePathsPlugin = require('case-sensitive-paths-webpack-plugin');
// const flexdatalist = require('../sitePF/resources/js/jquery.flexdatalist');

var webpackConfig = {
    plugins: [
        new CaseSensitivePathsPlugin(),
        new VuetifyLoaderPlugin(),
        // new flexdatalist(),
    ],
    // externals: {
    //     jquery: 'window.jQuery'
    // }
}
mix.webpackConfig( webpackConfig );
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    // .extract(
    //     [
    //         'jquery',

    //         //  jquery: 'window.jQuery'
    //     ],
    //     'public/js/vendor.js'
    // )
    ;

// mix.js("resources/js/app.js", "public/js").vue()
//     .sass("resources/css/app.css", "public/css", [
//     require("tailwindcss")('./tailwind.config.js'),
// ]);
