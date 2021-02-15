const mix = require('laravel-mix');

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

mix.sass('resources/sass/app.scss', 'public/css')
   .sass('resources/assets/sass/_base.scss', '../resources/assets/build/css')
   .sass('resources/assets/sass/style.scss', 'public/css/style.css')
   .js('resources/js/app.js', 'public/js')
   .js('resources/js/test.js', 'public/js')
   .js('resources/assets/js/main.js', 'public/js')
   .js('resources/js/two_factor_auth.js', 'public/js');
