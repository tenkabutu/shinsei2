require('dotenv').config();
const mix = require('laravel-mix');
mix.setResourceRoot(process.env.MIX_URL);
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
   .postCss('resources/css/app.css', 'public/css', [
       require('postcss-import'),
       require('autoprefixer'),
   ]);
mix.js('resources/js/jquery.tablesorter.js', 'public/js');
mix.webpackConfig({
    externals: {
        jquery: 'jQuery'
    }
});
mix.version();