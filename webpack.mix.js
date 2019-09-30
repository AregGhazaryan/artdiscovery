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

mix.js('resources/js/app.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css');

mix.copy('node_modules/@ckeditor/ckeditor5-build-classic/', 'resources/js/@ckeditor/ckeditor5-build-classic/', false);
mix.copy('node_modules/@ckeditor/ckeditor5-upload/', 'resources/js/@ckeditor/ckeditor5-upload/', false);
mix.copy('node_modules/@ckeditor/ckeditor5-image/', 'resources/js/@ckeditor/ckeditor5-image/', false);
mix.copy('node_modules/@ckeditor/ckeditor5-ui/', 'resources/js/@ckeditor/ckeditor5-ui/', false);
