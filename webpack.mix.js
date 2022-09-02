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

 mix.sass('resources/scss/normalize.scss', 'public/css')
    .sass('resources/scss/custom.scss', 'public/css')
    .js('resources/js/custom.js', 'public/js');

// mix.js('resources/js/custom.js', 'public/js')
//     .sass('resources/scss/custom.scss', 'public/css', [
//         //
//     ]);
