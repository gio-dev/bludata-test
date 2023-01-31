const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .styles([
        'node_modules/@k90mirzaei/vue-toast/dist/index.css'
    ], 'public/assets/css/toast.css')
    .sass('resources/sass/app.scss', 'public/css')
;
