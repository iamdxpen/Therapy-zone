const mix = require("laravel-mix");
let minifier = require("minifier");

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

mix.js("resources/js/app.js", "public/js")
    .sass("resources/frontend-scss/app.scss", "public/frontend/css")
    // .sass('resources/admin-scss/app.scss', 'public/admin-theme/css')
    .sourceMaps();

mix.then(() => {
    minifier.minify("public/frontend/css/app.css");
    // minifier.minify('public/admin-theme/css/app.css')
});
