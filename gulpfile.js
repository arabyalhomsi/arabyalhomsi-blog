var elixir = require('laravel-elixir');
			
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

var PTV = '../vendor';

elixir(function(mix) {
    mix.sass('app.scss')
    	
    	.browserify('app.js', 'public/js/app.js')
		
		.styles([
			PTV + '/normalize-css/normalize.css',
			PTV + '/font-awesome/css/font-awesome.css'
		], 'public/css/vendor.css')

		.scripts([
			PTV + '/jquery/dist/jquery.min.js',
			PTV + '/underscore/underscore-min.js',
			PTV + '/backbone/backbone-min.js',
		], 'public/js/vendor.js')

		.copy('resources/assets/images', 'public/images')
		.copy('resources/assets/vendor/font-awesome/fonts', 'public/fonts')
});
