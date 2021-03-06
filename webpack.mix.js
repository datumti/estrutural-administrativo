let mix = require('laravel-mix');

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

mix.scripts([
    'node_modules/moment/min/moment.min.js',
    'node_modules/moment/min/locales.min.js',
    'node_modules/inputmask/dist/jquery.inputmask.bundle.js',
    'node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
    'node_modules/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js',
    'node_modules/tableexport/src/v2/v2.1/Export2Excel.js',
    'node_modules/dropzone/dist/dropzone.js'
    ],
    'public/js/app.js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .styles([
        'node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
        'node_modules/eonasdan-bootstrap-datetimepicker/src/sass/_bootstrap-datetimepicker.scss',
        'node_modules/eonasdan-bootstrap-datetimepicker/src/sass/bootstrap-datetimepicker-build.scss',
        'node_modules/tableexport/src/stable/css/tableexport.min.css',
        'node_modules/dropzone/dist/basic.css',
        'node_modules/dropzone/dist/dropzone.css',
    ], 'public/css/app.css')
    .copyDirectory('resources/assets/img', 'public/img');
