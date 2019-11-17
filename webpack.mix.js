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
// mix.autoload({
//         'jquery': ['public/js', '$']
// });

// mix.styles([
//     'node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'

// ], 'public/bootstrap-datepicker/css/bootstrap-datepicker.min.css');

// mix.js([
//     'node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'

// ], 'public/bootstrap-datepicker/js/bootstrap-datepicker.js');

mix
    .js('resources/assets/js/app.js', 'public/js')

    .sass('resources/assets/sass/app.scss', 'public/css')
    // .sass('node_modules/@fortawesome/fontawesome-free/scss/fontawesome.sass', 'public/css')

    // .version()
    ;
   


