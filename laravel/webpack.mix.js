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
        'axios', 'moment',
        'jquery',
        'lodash',
        'bootstrap', 'popper.js',
        'v-jsoneditor'
    ])
    .sass('resources/sass/app.scss', `public${subFolder}/css`);

// module change
mix.js('resources/modules/change/js/app.js', `public/modules/change/js`)
    .sass('resources/modules/change/sass/app.scss', `public/modules/change/css`);

if (mix.inProduction()) {
    mix.version();
}
