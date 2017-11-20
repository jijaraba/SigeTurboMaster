'use strict"';

let mix = require('laravel-mix');


/*
 |--------------------------------------------------------------------------
 | BOWER LIBRARIES
 | Copy in new folder
 |--------------------------------------------------------------------------
*/

//Global
mix
    .scripts([
        'bower_components/jquery/dist/jquery.min.js',
        'bower_components/intro.js/minified/intro.min.js',
        'bower_components/sweetalert/dist/sweetalert.min.js',
    ], 'public/js/vendor/vendor.js')
    .version();

//Socket
mix
    .scripts([
        'bower_components/socket.io-client/dist/socket.io.js'
    ], 'public/js/vendor/socket.io.js');

/*
 |--------------------------------------------------------------------------
 | STYLESHEETS LIBRARIES
 | STYLES - SASS
 |--------------------------------------------------------------------------
*/

mix
    .sass('resources/assets/sass/login.scss', 'public/css')
    .sass('resources/assets/sass/default.scss', 'public/css')
    .sass('resources/assets/sass/dashboard.scss', 'public/css')
    .sass('resources/assets/sass/admissions.scss', 'public/css')
    .sass('resources/assets/sass/communications.scss', 'public/css')
    .sass('resources/assets/sass/financials.scss', 'public/css')
    .sass('resources/assets/sass/formation.scss', 'public/css')
    .sass('resources/assets/sass/parents.scss', 'public/css')
    .sass('resources/assets/sass/resources.scss', 'public/css')
    .sass('resources/assets/sass/roles.scss', 'public/css')
    .sass('resources/assets/sass/tasks.scss', 'public/css')
    .sass('resources/assets/sass/inventories.scss', 'public/css')
    .sass('resources/assets/sass/payments.scss', 'public/css')
    .version();


/*
 |--------------------------------------------------------------------------
 | EXTERNAL LIBRARIES
 | Vendors
 |--------------------------------------------------------------------------
*/
mix
    .styles([
        'bower_components/intro.js/minified/introjs.min.css',
        'bower_components/sweetalert/dist/sweetalert.css',
    ], 'public/css/vendor/vendor.css');

/*
 |--------------------------------------------------------------------------
 | ANGULAR
 | Vendors
 |--------------------------------------------------------------------------
*/
mix
    .js('resources/assets/js/sigeturbo_angular/dashboard/dashboard.js', 'public/js/angular')
    .js('resources/assets/js/sigeturbo_angular/admissions/admissions.js', 'public/js/angular')
    .webpackConfig({
        module: {
            rules: [
                {test: /\.js$/, loader: ['ng-annotate-loader']}
            ]
        }
    });

/*
 |--------------------------------------------------------------------------
 | INTERNAL LIBRARIES
 | Coffee Script
 |--------------------------------------------------------------------------
*/
mix
    .js('resources/assets/coffee/Homework.coffee', 'public/js')
    .js('resources/assets/coffee/Login.coffee', 'public/js')
    .js('resources/assets/coffee/Roles.coffee', 'public/js')
    .js('resources/assets/coffee/SigeTurbo.coffee', 'public/js')
    .js('resources/assets/coffee/Stream.coffee', 'public/js')
    .js('resources/assets/coffee/Utils.coffee', 'public/js')
    .webpackConfig({
        module: {
            rules: [
                {test: /\.coffee$/, loader: 'coffee-loader'}
            ]
        }
    })
    .version();
