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

// const subFolder = mix.inProduction() ? '/build' : '';
const subFolder = '';

mix.js('resources/js/app.js', `public${subFolder}/js`).extract([
        'vue', 'vuex',
        'axios',
        'jquery',
        'lodash',
        'bootstrap', 'popper.js',
        'v-jsoneditor'
    ])
    .sass('resources/sass/app.scss', `public${subFolder}/css`);

if (mix.inProduction()) {
    mix.version();
}
