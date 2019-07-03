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


mix
  .js('resources/assets/js/admin/admin.js', 'public/js')
  .sass('resources/assets/scss/admin/admin.scss', 'public/css')
  .js('resources/assets/js/home/home.js', 'public/js');

mix.webpackConfig({
	resolve: {
		alias: {
			'@': path.resolve('resources/assets/scss/admin'),
      //'@': path.resolve('resources/assets/scss/home'),
		}
	},
});

mix.browserSync('newspaper.test');
