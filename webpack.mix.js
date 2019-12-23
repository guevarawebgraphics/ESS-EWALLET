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
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/ewallet.scss', 'public/css');

mix.scripts([
    'public/str_dash/js/vendor/modernizr-2.8.3.min.js',
    'public/str_dash/js/vendor/jquery-2.2.4.min.js',
    'public/str_dash/js/popper.min.js',
    'public/str_dash/js/bootstrap.min.js',
    'public/str_dash/js/owl.carousel.min.js',
    'public/str_dash/js/metisMenu.min.js',
    'public/str_dash/js/jquery.slimscroll.min.js',
    'public/str_dash/js/jquery.slicknav.min.js',
    // Datatable
    'public/data_table/js/jquery.dataTables.js',
    'public/data_table/js/jquery.dataTables.min.js',
    'public/data_table/js/dataTables.bootstrap4.min.js',
    'public/data_table/js/dataTables.responsive.min.js',
    'public/data_table/js/responsive.bootstrap.min.js',
    // Other Plugins
    'public/str_dash/js/plugins.js',
    'public/str_dash/js/scripts.js',
], 'public/js/ewallet.js');